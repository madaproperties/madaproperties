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

class PropertyFinderXmlController extends Controller
{

  function propertyFinderXml(){
    $properties = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',1)
    ->where('status',1)->get();
    $count = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',1)
    ->where('status',1)->count();
    $last_update = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',1)
    ->where('status',1)->orderBy('last_updated','desc')->first();

    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<list last_update='".$last_update->last_updated."' listing_count='".$count."'>";
    $i = 1;

    $defaultAgent = User::where('email','omar.ali@madaproperties.com')->first();

    foreach ($properties as $property) {
      $amenities = get_amenities($property->id);
      $privateamenities = $amenities['privateamenities'];
      $commercialamenities = $amenities['commercialamenities'];
      $features = $amenities['features'];

      $completion_status="completed";
      if($property->project_status=='1') { $completion_status="off_plan"; }
      
      $permit_number=$property->str_no;

      $sale_rent=$property->sale_rent;
      
      $main_category_id=isset($property->category->main_category_id) ? $property->category->main_category_id : 0;
      $offering_type1=$offering_type2="";
      
      if($sale_rent==1) { $offering_type1="S"; }
      
      else if($sale_rent==2) { $offering_type1="R"; }
      
      if($main_category_id==1) { $offering_type2="R"; }
      
      else if($main_category_id==2) { $offering_type2="C"; }
      
      $offering_type=$offering_type2.$offering_type1;
      
      //$category=$property->category->category_name;
      
      $get_property_type=isset($property->category->pfix) ? $property->category->pfix : "";
      $price=$property->price;
      $dte=date('d');
      if($dte % 2 == 0){ 
        $price=$price-1;      
      }

      $price=str_replace(".00","",$price);
      $city_text = $property->city->name_en;
      $community=$property->area_name;
      $project_name=$property->project_name;
      $building_name=$property->bname;
      
      if($project_name=='Not Specified') { $project_name=""; }
      if($building_name=='Not Specified') { $building_name=""; }
      $longitute=$property->longitute;      
      $latitude=$property->latitude;
      
      $long_lat="";
      if($longitute!="" && $latitude!="") {
        $long_lat=$longitute.",".$latitude;
      }
      


      $xml.="
      <property last_update='".$property->last_updated."'>";
      if($property->crm_id){
        $xml.="<reference_number>".$property->crm_id."</reference_number>";
      }

      if($permit_number){
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }

      if($offering_type){
        $xml.="<offering_type>".$offering_type."</offering_type>";
      }

      if($get_property_type){
        $xml.="<property_type>".$get_property_type."</property_type>";
      }
      $xml.="<price_on_application>".($property->price_on_application == 1 ? 'Yes' : 'No' )."</price_on_application>";
      
    $xml.="<price>";
      if($property->yprice){
        $xml.="<yearly>".$property->yprice."</yearly>";
      }
      if($property->mprice){
        $xml.="<monthly>".$property->mprice."</monthly>";
      }
      if($property->price && $property->mprice ==0 && $property->yprice == 0){
        $xml.=$property->price;
      }
      $xml.="</price>";



      $xml.="<city><![CDATA[".$city_text."]]></city>
      <community><![CDATA[".$community."]]></community>
      <sub_community><![CDATA[".$property->project_name."]]></sub_community>
      <property_name><![CDATA[".$property->building_name."]]></property_name>
      <title_en><![CDATA[".$property->title."]]></title_en>
      <description_en><![CDATA[".$property->description."]]></description_en>";
      if($privateamenities){
        $xml.="<private_amenities>".$privateamenities."</private_amenities>";
      }
      if($commercialamenities){
        $xml.="<commercial_amenities>".$commercialamenities."</commercial_amenities>";
      }
      $xml.="<features>".$features."</features>
      <plot_size>".$property->plot_size."</plot_size>
      <size>".$property->buildup_area."</size>
      <bedroom>".__('config.bedrooms.'.$property->bedrooms)."</bedroom>
      <bathroom>".$property->bathrooms."</bathroom>";
      if($property->agent && $property->agent->is_rera_active){
        $xml .="<agent>
          <id>".$property->agent->id."</id>
          <name><![CDATA[".$property->agent->name."]]></name>
          <email>".$property->agent->name."</email>
          <phone>".$property->agent->mobile_no."</phone>
        </agent>";
      }else{
        if($defaultAgent){
          $xml .="<agent>
            <id>".$defaultAgent->id."</id>
            <name><![CDATA[".$defaultAgent->username."]]></name>
            <email>".$defaultAgent->name."</email>
            <phone>".$defaultAgent->mobile_no."</phone>
          </agent>";
        }
      }
      $xml .="<parking>".$property->parking_areas."</parking>
      <furnished>".($property->furnished == 1 ? 'Yes' : 'No')."</furnished>";

      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
      }
      $xml .="<photo>";
      $x=0;
      $photos="";
      if($property->images && count($property->images)){
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
        }
      }
      $xml.="</photo>";
      if($property->geopoints){
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $xml.="</property>";
    }
    
    $xml.="</list>";    
    echo $xml;  
    die;
  }  
  
}