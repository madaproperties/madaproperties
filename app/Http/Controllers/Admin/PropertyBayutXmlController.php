<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Property;
use Spatie\Permission\Models\Role;
use App\City;
use App\Campaing;
use App\Source;
use App\Country;
use App\PurposeType;
use App\User;
use App\PropertyDocuments;
use App\PropertyImages;
use App\PropertyPortals;
use App\Categories;
use Image;
use Mail;
use App\Mail\PropertyNotification;

class PropertyBayutXmlController extends Controller
{

  public function propertyBayutXml(Request $request){
    $properties = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->whereIn('property_portals.portal_id',[2,3])
    ->where('status',1)
    ->get();
    
    header('Content-Type: text/xml');

    $xw = xmlwriter_open_memory();
    xmlwriter_set_indent($xw, 1);
    $res = xmlwriter_set_indent_string($xw, ' ');
    
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
    
    // A first element
    xmlwriter_start_element($xw, 'Properties');
    $i = 1;

    $defaultAgent = User::where('email','omar.ali@madaproperties.com')->first();
    foreach ($properties as $property) {
      // Start a child element
      xmlwriter_start_element($xw, 'Property');
          
        // CDATA
        xmlwriter_start_element($xw, 'Property_Ref_No');
        xmlwriter_write_cdata($xw,$property->crm_id);
        xmlwriter_end_element($xw); // Count

        $sale_rent = '';
        if($property->sale_rent == '1'){
          $sale_rent = 'Buy';
        }else if($property->sale_rent == '2'){
          $sale_rent = 'Rent';
        }
        xmlwriter_start_element($xw, 'Property_purpose');
        xmlwriter_write_cdata($xw, $sale_rent);
        xmlwriter_end_element($xw); // Count
        
        if($property->category){
          xmlwriter_start_element($xw, 'Property_Type');
          xmlwriter_write_cdata($xw, $property->category->category_name);
          xmlwriter_end_element($xw); // Count
        }
        
        $status=''; 
        if($property->status == '1'){
          $status = 'live';
        }else if($property->status == '5'){
          $status = 'archive';
        }
        xmlwriter_start_element($xw, 'Property_Status');
        xmlwriter_write_cdata($xw, $status);
        xmlwriter_end_element($xw); // Count


        if($property->city){
          xmlwriter_start_element($xw, 'City');
          xmlwriter_write_cdata($xw, $property->city->name_en);
          xmlwriter_end_element($xw); // Count
        }

        if($property->area_name){
          xmlwriter_start_element($xw, 'Locality');
          xmlwriter_write_cdata($xw, $property->area_name);
          xmlwriter_end_element($xw); // Count
        }

        if($property->project_name){
          xmlwriter_start_element($xw, 'Sub_Locality');
          xmlwriter_write_cdata($xw, $property->project_name);
          xmlwriter_end_element($xw); // Count
        }

        if($property->building_name){
          xmlwriter_start_element($xw, 'Tower_Name');
          xmlwriter_write_cdata($xw, $property->building_name);
          xmlwriter_end_element($xw); // Count
        }

        xmlwriter_start_element($xw, 'Property_Size');
        xmlwriter_write_cdata($xw, $property->buildup_area);
        xmlwriter_end_element($xw); // Count

        $measure_unit = '';
        if($property->measure_unit == '1'){
          $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
        }else if($property->measure_unit == '2'){
          $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
        }
        xmlwriter_start_element($xw, 'Property_Size_Unit');
        xmlwriter_write_cdata($xw, $measure_unit);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Bedrooms');
        xmlwriter_write_cdata($xw, !empty($property->bedrooms) ? __('config.bedrooms.'.$property->bedrooms) : 0);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Bathroom');
        xmlwriter_write_cdata($xw, !empty($property->bathrooms) ? $property->bathrooms : -1);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Price');
        $price = $property->price;
        if($property->yprice){
          $price = $property->yprice;
        }
        xmlwriter_write_cdata($xw, $price);
        xmlwriter_end_element($xw); // Count

        if($property->agent && $property->agent->is_rera_active){
          xmlwriter_start_element($xw, 'Listing_Agent');
          xmlwriter_write_cdata($xw, $property->agent->username);
          xmlwriter_end_element($xw); // Count
            
          xmlwriter_start_element($xw, 'Listing_Agent_Phone');
          xmlwriter_write_cdata($xw, $property->agent->mobile_no);
          xmlwriter_end_element($xw); // Count
            
          xmlwriter_start_element($xw, 'Listing_Agent_Email');
          xmlwriter_write_cdata($xw, $property->agent->email);
          xmlwriter_end_element($xw); // Count
        }else{
          if($defaultAgent){
            xmlwriter_start_element($xw, 'Listing_Agent');
            xmlwriter_write_cdata($xw, $defaultAgent->username);
            xmlwriter_end_element($xw); // Count
              
            xmlwriter_start_element($xw, 'Listing_Agent_Phone');
            xmlwriter_write_cdata($xw, $defaultAgent->mobile_no);
            xmlwriter_end_element($xw); // Count
              
            xmlwriter_start_element($xw, 'Listing_Agent_Email');
            xmlwriter_write_cdata($xw, $defaultAgent->email);
            xmlwriter_end_element($xw); // Count
          }
        }  

        

        if($property->features && count($property->features)){
          xmlwriter_start_element($xw, 'Facilities');
          foreach($property->features as $feature){
            xmlwriter_start_element($xw, 'Facility');
              xmlwriter_write_cdata($xw, getFeatureName($feature->feature_id));
            xmlwriter_end_element($xw); // Facility
          }
          xmlwriter_end_element($xw); // Facilities
        }


        if($property->images && count($property->images)){
          xmlwriter_start_element($xw, 'Images');
          foreach($property->images as $image){
            xmlwriter_start_element($xw, 'ImageUrl');
              xmlwriter_write_cdata($xw, s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image->images_link));
              //xmlwriter_write_cdata($xw, $image->temp_image);
            xmlwriter_end_element($xw); // ImageUrl
          }
          xmlwriter_end_element($xw); // Images
        }
                  
        if($property->floorplan){
          xmlwriter_start_element($xw, 'Floor_Plans');
          xmlwriter_write_cdata($xw, $property->floorplan);
          xmlwriter_end_element($xw); // Count
        }

        xmlwriter_start_element($xw, 'Last_Updated');
        xmlwriter_write_cdata($xw, $property->last_updated);
        xmlwriter_end_element($xw); // Count

        // CDATA
        xmlwriter_start_element($xw, 'Permit_Number');
        xmlwriter_write_cdata($xw, $property->str_no);
        xmlwriter_end_element($xw); // Count


        if($property->video){
          xmlwriter_start_element($xw, 'Videos');
          xmlwriter_write_cdata($xw, $property->video);
          xmlwriter_end_element($xw); // Video
        }

        if($property->is_exclusive){
          xmlwriter_start_element($xw, 'Off_plan');
          xmlwriter_write_cdata($xw, $property->is_exclusive == '1' ? 'Yes' : 'No');
          xmlwriter_end_element($xw); // Count
        }

        xmlwriter_start_element($xw, 'Rent_Frequency');
        xmlwriter_write_cdata($xw, 'yearly');
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Property_Title');
        xmlwriter_write_cdata($xw, $property->title);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Property_Description');
        xmlwriter_write_cdata($xw, $property->description);
        xmlwriter_end_element($xw); // Count


        // xmlwriter_start_element($xw, 'No_of_Rooms');
        // xmlwriter_write_cdata($xw, $property->rooms);
        // xmlwriter_end_element($xw); // Count

        // xmlwriter_start_element($xw, 'No_of_Bathrooms');
        // xmlwriter_write_cdata($xw, $property->bathrooms);
        // xmlwriter_end_element($xw); // Count

        // xmlwriter_start_element($xw, 'Property_Title');
        // xmlwriter_write_cdata($xw, $property->title);
        // xmlwriter_end_element($xw); // Count

        // xmlwriter_start_element($xw, 'Web_Remarks');
        // xmlwriter_write_cdata($xw, $property->description);
        // xmlwriter_end_element($xw); // Count

        

        
        // xmlwriter_start_element($xw, 'Listing_Date');
        // xmlwriter_write_cdata($xw, $property->created_at);
        // xmlwriter_end_element($xw); // Listing_Date
          
        // xmlwriter_start_element($xw, 'Last_Updated');
        // xmlwriter_write_cdata($xw, $property->updated_at);
        // xmlwriter_end_element($xw); // Last_Updated
          
        
          
        // xmlwriter_start_element($xw, 'unit_measure');
        // xmlwriter_write_cdata($xw, $property->measure_unit);
        // xmlwriter_end_element($xw); // unit_measure
          
        // xmlwriter_start_element($xw, 'Permit_Id');
        // xmlwriter_write_cdata($xw, $property->str_no);
        // xmlwriter_end_element($xw); // Permit_Id
          
        // xmlwriter_start_element($xw, 'featured_on_companywebsite');
        // xmlwriter_write_cdata($xw, $property->forma_noc_slform);
        // xmlwriter_end_element($xw); // featured_on_companywebsite
          
        // xmlwriter_start_element($xw, 'under_construction');
        // xmlwriter_write_cdata($xw, $property->updated_at);
        // xmlwriter_end_element($xw); // under_construction
          
        // xmlwriter_start_element($xw, 'Off_Plan');
        // if($property->project_status=='1'){ 
        //   xmlwriter_write_cdata($xw, "off_plan");
        // }else{
        //   xmlwriter_write_cdata($xw, "completed");
        // }
        // xmlwriter_end_element($xw); // Off_Plan
          
        // xmlwriter_start_element($xw, 'Cheques');
        // xmlwriter_write_cdata($xw, $property->cheques);
        // xmlwriter_end_element($xw); // Cheques
          
        // xmlwriter_start_element($xw, 'Exclusive_Rights');
        // xmlwriter_write_cdata($xw, $property->is_exclusive ? 'Yes' : 'No');
        // xmlwriter_end_element($xw); // Exclusive_Rights
          
      
      
      xmlwriter_end_element($xw); // Listing
    }
    xmlwriter_end_element($xw); // Listings   

    xmlwriter_end_document($xw);
      
    echo xmlwriter_output_memory($xw);

    die;
  }
}
