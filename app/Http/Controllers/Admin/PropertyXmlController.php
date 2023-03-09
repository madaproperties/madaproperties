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
use App\Features;
use App\PropertyFeatures;
use App\PropertyPortals;
use App\Categories;
use Image;
use Mail;
use App\Mail\PropertyNotification;
use App\Community;

class PropertyXmlController extends Controller
{
  function propertyXmlDubai(){
    $users = User::select('id')
    ->where('active','1')
    ->where('time_zone','Asia/Dubai')
    ->get();
    $usersIds = $users->pluck('id')->toArray();
    $property = Property::whereIn('user_id',$usersIds);
    
    $properties = $property->get();
    $count = $property->count();
    $last_update = Property::orderBy('last_updated','desc')->first();

    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<list last_update='".$last_update->last_updated."' listing_count='".$count."'>";
    $i = 1;
    $defaultAgent = User::where('email','omar.ali@madaproperties.com')->first();
    $tempArray=[];
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
      $city_text = isset($property->city) ? $property->city->name_en : 'Dubai';
      $community = isset($property->communityId) ? $property->communityId->name_en : 'N/A';
      $sub_community = isset($property->subCommunity) ? $property->subCommunity->name_en : 'N/A';
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
        $tempArray['crm_id'] = $property->crm_id;
        $xml.="<reference_number>".$property->crm_id."</reference_number>";
      }

      if($permit_number){
        $tempArray['str_no'] = $property->str_no;
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }

      if($offering_type){
        $tempArray['sale_rent'] = $property->sale_rent;
        $xml.="<offering_type>".$offering_type."</offering_type>";
      }

      if($get_property_type){
        $tempArray['get_property_type'] = $property->get_property_type;
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
      $tempArray['price'] = $property->price;
      $tempArray['yprice'] = $property->yprice;
      $tempArray['mprice'] = $property->mprice;



      $xml.="<city><![CDATA[".$city_text."]]></city>
      <community><![CDATA[".$community."]]></community>
      <sub_community><![CDATA[".$sub_community."]]></sub_community>
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
      <bedroom>".$property->bedrooms."</bedroom>
      <bathroom>".$property->bathrooms."</bathroom>";

      $tempArray['city_text'] = $property->city;
      $tempArray['communityId'] = $community;
      $tempArray['subCommunity'] = $sub_community;
      $tempArray['building_name'] = $property->building_name;
      $tempArray['title'] = $property->title;
      $tempArray['description'] = $property->description;
      $tempArray['plot_size'] = $property->plot_size;
      $tempArray['buildup_area'] = $property->buildup_area;
      $tempArray['bedrooms'] = $property->bedrooms;
      $tempArray['bathrooms'] = $property->bathrooms;

      if($property->agent && $property->agent->is_rera_active){
        $xml .="<agent>
          <id>".$property->agent->id."</id>
          <name><![CDATA[".$property->agent->name."]]></name>
          <email>".$property->agent->name."</email>
          <phone>".$property->agent->mobile_no."</phone>
          <license_no>".$property->agent->rera_number."</license_no>
        </agent>";
      }else{
        if($defaultAgent){
          $xml .="<agent>
            <id>".$defaultAgent->id."</id>
            <name><![CDATA[".$defaultAgent->username."]]></name>
            <email>".$defaultAgent->name."</email>
            <phone>".$defaultAgent->mobile_no."</phone>
            <license_no>".$defaultAgent->rera_number."</license_no>
          </agent>";
        }
      }
      $xml .="<parking>".$property->parking_areas."</parking>
      <furnished>".($property->furnished == 1 ? 'Yes' : 'No')."</furnished>";

      $tempArray['parking_areas'] = $property->parking_areas;
      $tempArray['furnished'] = $property->furnished;

      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
        $tempArray['virtual_360'] = $property->virtual_360;
      }
      $xml .="<photo>";
      $x=0;
      $photos="";
      if($property->images && count($property->images)){
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $xml.="<url last_updated='".$image->date."' watermark='yes'>".s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
        }
      }
      $xml.="</photo>";
      if($property->floorplan){
        $tempArray['floorplan'] = $property->floorplan;        
        $xml.="<floor_plan><url last_updated='".$property->last_updated."'>".s3AssetUrl('uploads/'.$image->floorplan)."</url></floor_plan>"; 
      }
      if($property->geopoints){
        $tempArray['geopoints'] = $property->geopoints;        
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $tempArray['id'] = $property->id;        
      $tempArray['status'] = $property->status;        
      $tempArray['property_type'] = $property->property_type;        
      $tempArray['created_by'] = $property->created_by;        
      $tempArray['user_id'] = $property->user_id;        
      $tempArray['category_id'] = $property->category_id;        
      $tempArray['city_id'] = $property->city_id;        
      $tempArray['country_id'] = $property->country_id;        
      $tempArray['currency'] = $property->currency;        
      $tempArray['price_type'] = $property->price_type;        
      $tempArray['status_photographer'] = $property->status_photographer;        
      $tempArray['community'] = $property->community;        
      $tempArray['latitude'] = $property->latitude;        
      $tempArray['longitude'] = $property->longitude;        
      $tempArray['created_at'] = $property->created_at;        
      $tempArray['last_updated'] = $property->last_updated;        
      $tempArray['area_name'] = $property->area_name;        
      $tempArray['project_name'] = $property->project_name;        
      $tempArray['video'] = $property->video;        
      $temp = $property->toArray();
      foreach ($temp as $key=>$value) {
        if(!is_array($value) && !array_key_exists($key,$tempArray)){
          $xml.= "<".trim($key).">".(!empty($temp[$key]) ? (($temp[$key] == 0)? '0' : $temp[$key]) : 'N/A')."</".trim($key).">";
          //$xml.= "<".trim($key).">".$temp[$key]."</".trim($key).">";
        }
      }
      $xml.="</property>";
    }


    
    $xml.="</list>";    
    echo $xml;  
    die;
  }
  function propertyXmlSaudi(){
    $users = User::select('id')
    ->where('active','1')
    ->where('time_zone','Asia/Riyadh')
    ->get();
    $usersIds = $users->pluck('id')->toArray();
    $property = Property::whereIn('user_id',$usersIds);

    $properties = $property->get();
    $count = $property->count();
    $last_update = Property::orderBy('last_updated','desc')->first();

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

      $sub_community = 'N/A';
      $price=str_replace(".00","",$price);
      $city_text = isset($property->city) ? $property->city->name_en : 'Saudi';

      if($property->zone){
        $community = $property->zone->zone_name;
      }else{
        $community = $property->area_name;          
      }

      if($property->district){
        $sub_community = $property->district->name;
      }else if($property->project_name){
        $sub_community = $property->project_name;          
      }
      
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
        $tempArray['crm_id'] = $property->crm_id;
        $xml.="<reference_number>".$property->crm_id."</reference_number>";
      }

      if($permit_number){
        $tempArray['str_no'] = $property->str_no;
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }

      if($offering_type){
        $tempArray['sale_rent'] = $property->sale_rent;
        $xml.="<offering_type>".$offering_type."</offering_type>";
      }

      if($get_property_type){
        $tempArray['get_property_type'] = $property->get_property_type;
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
      $tempArray['price'] = $property->price;
      $tempArray['yprice'] = $property->yprice;
      $tempArray['mprice'] = $property->mprice;



      $xml.="<city><![CDATA[".$city_text."]]></city>
      <community><![CDATA[".$community."]]></community>
      <sub_community><![CDATA[".$sub_community."]]></sub_community>
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
      <bedroom>".$property->bedrooms."</bedroom>
      <bathroom>".$property->bathrooms."</bathroom>";

      $tempArray['city_text'] = $property->city;
      $tempArray['communityId'] = $community;
      $tempArray['subCommunity'] = $sub_community;
      $tempArray['building_name'] = $property->building_name;
      $tempArray['title'] = $property->title;
      $tempArray['description'] = $property->description;
      $tempArray['plot_size'] = $property->plot_size;
      $tempArray['buildup_area'] = $property->buildup_area;
      $tempArray['bedrooms'] = $property->bedrooms;
      $tempArray['bathrooms'] = $property->bathrooms;

      if($property->agent && $property->agent->is_rera_active){
        $xml .="<agent>
          <id>".$property->agent->id."</id>
          <name><![CDATA[".$property->agent->name."]]></name>
          <email>".$property->agent->name."</email>
          <phone>".$property->agent->mobile_no."</phone>
          <license_no>".$property->agent->rera_number."</license_no>
        </agent>";
      }else{
        if($defaultAgent){
          $xml .="<agent>
            <id>".$defaultAgent->id."</id>
            <name><![CDATA[".$defaultAgent->username."]]></name>
            <email>".$defaultAgent->name."</email>
            <phone>".$defaultAgent->mobile_no."</phone>
            <license_no>".$defaultAgent->rera_number."</license_no>
          </agent>";
        }
      }
      $xml .="<parking>".$property->parking_areas."</parking>
      <furnished>".($property->furnished == 1 ? 'Yes' : 'No')."</furnished>";

      $tempArray['parking_areas'] = $property->parking_areas;
      $tempArray['furnished'] = $property->furnished;

      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
        $tempArray['virtual_360'] = $property->virtual_360;
      }
      $xml .="<photo>";
      $x=0;
      $photos="";
      if($property->images && count($property->images)){
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $xml.="<url last_updated='".$image->date."' watermark='yes'>".s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
        }
      }
      $xml.="</photo>";
      if($property->floorplan){
        $tempArray['floorplan'] = $property->floorplan;        
        $xml.="<floor_plan><url last_updated='".$property->last_updated."'>".s3AssetUrl('uploads/'.$image->floorplan)."</url></floor_plan>"; 
      }
      if($property->geopoints){
        $tempArray['geopoints'] = $property->geopoints;        
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $tempArray['id'] = $property->id;        
      $tempArray['status'] = $property->status;        
      $tempArray['property_type'] = $property->property_type;        
      $tempArray['created_by'] = $property->created_by;        
      $tempArray['user_id'] = $property->user_id;        
      $tempArray['category_id'] = $property->category_id;        
      $tempArray['city_id'] = $property->city_id;        
      $tempArray['country_id'] = $property->country_id;        
      $tempArray['currency'] = $property->currency;        
      $tempArray['price_type'] = $property->price_type;        
      $tempArray['status_photographer'] = $property->status_photographer;        
      $tempArray['community'] = $property->community;        
      $tempArray['latitude'] = $property->latitude;        
      $tempArray['longitude'] = $property->longitude;        
      $tempArray['created_at'] = $property->created_at;        
      $tempArray['last_updated'] = $property->last_updated;        
      $tempArray['area_name'] = $property->area_name;        
      $tempArray['project_name'] = $property->project_name;        
      $tempArray['video'] = $property->video;        
      $temp = $property->toArray();
      foreach ($temp as $key=>$value) {
        if(!is_array($value) && !array_key_exists($key,$tempArray)){
          $xml.= "<".trim($key).">".(!empty($temp[$key]) ? (($temp[$key] == 0)? '0' : $temp[$key]) : 'N/A')."</".trim($key).">";
          //$xml.= "<".trim($key).">".$temp[$key]."</".trim($key).">";
        }
      }


      $xml.="</property>";
    }    
    $xml.="</list>";    
    echo $xml;  
    die;
  }
  function propertyXml(){
    $properties = Property::where('status',1)->get();
    $count = Property::where('status',1)->count();
    $last_update = Property::where('status',1)->orderBy('last_updated','desc')->first();

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
      
      if($sale_rent==1){ 
        $offering_type1="Sale"; 
      }else if($sale_rent==2){ 
        $offering_type1="Rent"; 
      }
      $offering_type=$offering_type2.$offering_type1;
      
      //$category=$property->category->category_name;
      
      $get_property_type=isset($property->category->category_name) ? $property->category->category_name : "";
      $price=$property->price;
      $dte=date('d');
      if($dte % 2 == 0){ 
        $price=$price-1;      
      }

      $price=str_replace(".00","",$price);
      $city_text = isset($property->city->name_en) ? $property->city->name_en : "Dubai";
      $community = isset($property->community) ? $property->community->name_en : 'N/A';
      $sub_community = isset($property->subCommunity) ? $property->subCommunity->name_en : 'N/A';

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
      $xml.="<title><![CDATA[".$property->title."]]></title>
      <description><![CDATA[".$property->description."]]></description>";

      if($property->crm_id){
        $xml.="<reference_number>".$property->crm_id."</reference_number>";
      }
      if($permit_number){
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }
      if($get_property_type){
        $xml.="<type>".$get_property_type."</type>";
      }

      if($offering_type){
        $xml.="<property_type>".$offering_type."</property_type>";
      }

      $xml.="<features>".$features."</features>
      <plot_size>".$property->plot_size."</plot_size>
      <size>".$property->buildup_area."</size>
      <bedroom>".$property->bedrooms."</bedroom>
      <bathroom>".$property->bathrooms."</bathroom>";

      $xml.="<city><![CDATA[".$city_text."]]></city>
      <community><![CDATA[".$community."]]></community>
      <sub_community><![CDATA[".$property->project_name."]]></sub_community>
      <property_name><![CDATA[".$property->building_name."]]></property_name>";

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



      if($privateamenities){
        $xml.="<private_amenities>".$privateamenities."</private_amenities>";
      }
      if($commercialamenities){
        $xml.="<commercial_amenities>".$commercialamenities."</commercial_amenities>";
      }
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
          $xml.="<url last_updated='".$image->date."' watermark='yes'>".s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
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


  public function readXml(){
    // Loading the XML file
    $xml = simplexml_load_file(url("public/property-finder-xml-21022023.xml")); //Staging 
    //$xml = simplexml_load_file("public\property-finder.xml"); //Local

    echo "<h2>".$xml->attributes()->last_update."</h2><br />";
    $propertArray = [];
    $i=0;
    foreach ($xml->children() as $row) {
      $property = [];
      $property['updated_at'] = $row->attributes()->updated_at;
      $property['crm_id'] = $row->reference_number;
      $property['str_no'] = $row->permit_number;
      $offering_type = strpos($row->offering_type, '-', strpos($row->offering_type, '-') + 1);
      if($row->offering_type == 'RS' || $row->offering_type == 'CS'){
        $property['sale_rent'] = '1';
      }else{
        $property['sale_rent'] = '2';
      }
      if(substr($row->offering_type, 0, 1) == 'R'){
        $property['property_type'] = '1';
      }else{
        $property['property_type'] = '2';
      }

      if(isset(Categories::where('pfix',trim($row->property_type))->first()->id)){
        $property['category_id'] = Categories::where('pfix',trim($row->property_type))->first()->id;
      }
      $city_id = 0;
      if(isset(City::where('name_en','LIKE', '%'.trim($row->city).'%')->first()->id)){
        $city_id = City::where('name_en','LIKE', '%'.trim($row->city).'%')->first()->id;
      }
      $community=0;
      if(isset(Community::where('name_en','LIKE', '%'.trim($row->community).'%')->first()->id)){
        $community = Community::where('name_en','LIKE', '%'.trim($row->community).'%')->first()->id;
      }
      $sub_community=0;
      if(isset(Community::where('name_en','LIKE', '%'.trim($row->sub_community).'%')->first()->id)){
        $sub_community = Community::where('name_en','LIKE', '%'.trim($row->sub_community).'%')->first()->id;
      }

      $property['title_deed'] = $row->title_deed;
      $property['price_on_application'] = $row->price_on_application;
      $property['price'] = $row->price;
      $property['yprice'] = $row->price->yearly;
      if($row->price->yearly){
        $property['default_price'] = 'year';
      }
      $property['mprice'] = $row->price->monthly;
      if($row->price->monthly){
        $property['default_price'] = 'month';
      }
      $property['city_id'] = $city_id;
      $property['community'] = $community;
      $property['sub_community'] = $sub_community;
      $property['area_name'] = $row->community;
      $property['project_name'] = $row->sub_community;
      $property['building_name'] = $row->property_name;
      //$property['location_id'] = $row->location_id;
      $property['title'] = $row->title_en;
      $property['description'] = $row->description_en;
      $property['buildup_area'] = $row->size;
      $property['bedrooms'] = $row->bedroom;
      $property['bathrooms'] = $row->bathroom;
      if($userData = User::where('email',$row->agent->email)->first()){
        $property['user_id'] = $userData->id;
      }else{
        $property['user_id'] = $row->agent->id;
      }
      $property['parking_areas'] = $row->parking;
      $property['furnished'] = ($row->furnished == 'Yes' ? '1' : '0');
      if(!empty($row->geopoints)){
        $property['geopoints'] = $row->geopoints;
        $loc = explode(",",$row->geopoints);
        if(isset($loc[0]) && isset($loc[1])){
          $property['latitude'] = $loc[0];
          $property['longitude'] = $loc[1];
        }
      }

      $property['virtual_360'] = $row->view360;
      $property['developer'] = $row->developer;
      $property['video'] = $row->video_tour_url;

      //dd($property);
      $property = Property::create($property);

      if($row->photo){
        $urls = (((array)$row->photo)['url']);
        if(count($urls)){
          for($i=0; $i < count($urls); $i++){
            $fileName = $urls[$i];
            $nameArray = explode('/',$fileName);
            $destinationPath = 'public/uploads/property/'.$property->id.'/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }
            copy($fileName,$destinationPath.'/'.end($nameArray));

            PropertyImages::create([
              'property_id' => $property->id,
              'images_link' => end($nameArray),
              'temp_image' => $urls[$i]
            ]);
          }          
        }
      }
      $temp = [];
      if($row->private_amenities){
        $features = explode(",",$row->private_amenities);
        for($j=0; $j < count($features); $j++) {
          if($tempFea = Features::where('feature_prefix','LIKE','%'.$features[$j].'%')->first()){
            $temp[$i]['property_id'] = $property->id;
            $temp[$i++]['feature_id'] = $tempFea->id;
          }
        }
      }
      \DB::table("property_features")->insert($temp);

      \DB::table("property_portals")->insert(['property_id'=>$property->id,'portal_id'=>1]);  

    }
    echo "<pre>";
    print_r($propertArray);
    die;
  }

  public function readBayutXml(){
    // Loading the XML file
    $xml = simplexml_load_file(url("public/bayut-xml-10022023.xml")); //Staging 
    //$xml = simplexml_load_file("public\property-finder.xml"); //Local

    $propertArray = [];
    $i=0;
    foreach ($xml->children() as $row) {
      $property = [];
      $property['updated_at'] = $row->Last_Updated;
      $property['crm_id'] = $row->Property_Ref_No;
      $property['str_no'] = $row->Permit_Id;
      if($row->Ad_Type == 'Rent'){
        $property['sale_rent'] = '2';
      }else{
        $property['sale_rent'] = '1';
      }
      if(isset(Categories::where('category_name',trim($row->Unit_Type))->first()->id)){
        $property['category_id'] = Categories::where('category_name',trim($row->Unit_Type))->first()->id;
      }
      $property['price'] = $row->Price;
      if($row->Frequency == 'yearly'){
        $property['yprice'] = $row->Price;
        $property['default_price'] = 'year';
        $property['price'] = 0;
      }else if($row->Frequency == 'monthly'){
        $property['mprice'] = $row->Price;
        $property['default_price'] = 'month';
        $property['yprice'] = 0;
        $property['price'] = 0;
      }

      $city_id = 0;
      if(isset(City::where('name_en','LIKE', '%'.trim($row->Emirate).'%')->first()->id)){
        $city_id = City::where('name_en','LIKE', '%'.trim($row->Emirate).'%')->first()->id;
      }
      $community=0;
      if(isset(Community::where('name_en','LIKE', '%'.trim($row->Community).'%')->first()->id)){
        $community = Community::where('name_en','LIKE', '%'.trim($row->Community).'%')->first()->id;
      }
      

      $property['city_id'] = $city_id;
      $property['community'] = $community;
      $property['area_name'] = $row->Community;
      $property['project_name'] = $row->Property_Name;
      //$property['location_id'] = $row->location_id;
      $property['title'] = $row->Property_Title;
      $property['description'] = $row->Web_Remarks;
      $property['measure_unit'] = $row->unit_measure;
      $property['bedrooms'] = $row->No_of_Rooms;
      $property['bathrooms'] = $row->No_of_Bathrooms;
      $property['user_id'] = 43;
      $property['cheques'] = $row->Cheques;
      $property['latitude'] = $row->Geopoints->Latitude;
      $property['longitude'] = $row->Geopoints->Longitude;
      $property['is_exclusive'] = $row->Off_Plan == 'YES' ? 1 : 0;
      $property['developer'] = $row->developer;
      $property['virtual_360'] = $row->view360;
      $property['video'] = $row->video_url;
      $property['buildup_area'] = $row->Unit_Builtup_Area;

      $property = Property::create($property);

      if($row->Images){
        $urls = (((array)$row->Images)['ImageUrl']);
        if(count($urls)){
          for($i=0; $i < count($urls); $i++){
            $fileName = $urls[$i];
            $nameArray = explode('/',$fileName);
            $firstNameArray = explode('?',$fileName);
            $destinationPath = 'public/uploads/property/'.$property->id.'/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }
            if(isset($firstNameArray[0]) && !empty($firstNameArray[0])){
              $nameArray = explode('/',$firstNameArray[0]);
              copy(trim($firstNameArray[0]),$destinationPath.'/'.trim(end($nameArray)));
            }else{
              copy(trim($fileName),$destinationPath.'/'.trim(end($nameArray)));
            }
            PropertyImages::create([
              'property_id' => $property->id,
              'images_link' => trim(end($nameArray)),
              'temp_image' => $urls[$i]
            ]);
          }          
        }
      }
      if($row->Facilities){
        if(isset((((array)$row->Facilities)['Facility']))){
          $facilities = (((array)$row->Facilities)['Facility']);
          if(count($facilities)){
            for($i=0; $i < count($facilities); $i++){
              $feature = Features::where('feature_name',$facilities[$i])->first();
              if($feature){
                $data = ['property_id'=>$property->id,'feature_id'=>$feature->id];
                PropertyFeatures::create($data);
              }
            }
          }
        }
      }

      \DB::table("property_portals")->insert(['property_id'=>$property->id,'portal_id'=>2]);  

    }
    echo "<pre>";
    print_r($propertArray);
    die;
  }  

  public function readDubizzleXml(){
    // Loading the XML file
    $xml = simplexml_load_file(url("public/dubizzle-xml-29012023.xml")); //Staging 
    //$xml = simplexml_load_file("public\property-finder.xml"); //Local

    $propertArray = [];
    $i=0;
    foreach ($xml->children() as $row) {
      $property = [];
      $property['updated_at'] = $row->lastupdated;
      $property['crm_id'] = $row->refno;
      $property['str_no'] = $row->permit_number;
      if($row->type == 'SP'){
        $property['sale_rent'] = '1';
      }else{
        $property['sale_rent'] = '2';
      }
      if(isset(Categories::where('pfix',trim($row->subtype))->first()->id)){
        $property['category_id'] = Categories::where('pfix',trim($row->subtype))->first()->id;
      }
      $property['price'] = $row->price;
      if($row->type == 'RP'){
        $property['yprice'] = $row->price;
        $property['price'] = 0;
      }
      $property['city_id'] = $row->city;
      $property['area_name'] = $row->community;
      $property['project_name'] = $row->sub_community;
      $property['building_name'] = $row->building;
      //$property['location_id'] = $row->location_id;
      $property['title'] = $row->title;
      $property['description'] = $row->description;
      $property['buildup_area'] = $row->size;
      $property['measure_unit'] = $row->sizeunits;
      $property['bedrooms'] = $row->bedrooms;
      $property['bathrooms'] = $row->bathrooms;
      $property['user_id'] = 43;
      if(!empty($row->geopoint)){
        $property['geopoints'] = $row->geopoint;
        $loc = explode(",",$row->geopoint);
        if(isset($loc[0]) && isset($loc[1])){
          $property['latitude'] = $loc[0];
          $property['longitude'] = $loc[1];
        }
      }
      $property['developer'] = $row->developer;
      $property['virtual_360'] = $row->view360;
      $property['video'] = $row->video_url;
      $property['furnished'] = $row->furnished;

      $property = Property::create($property);

      if($row->photos){
        $urls = explode("|",$row->photos);
        if(count($urls)){
          for($i=0; $i < count($urls); $i++){
            $fileName = $urls[$i];
            $nameArray = explode('/',$fileName);
            $firstNameArray = explode('?',$fileName);
            $destinationPath = 'public/uploads/property/'.$property->id.'/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }
            if(isset($firstNameArray[0]) && !empty($firstNameArray[0])){
              $nameArray = explode('/',$firstNameArray[0]);
              copy(trim($firstNameArray[0]),$destinationPath.'/'.trim(end($nameArray)));
            }else{
              copy(trim($fileName),$destinationPath.'/'.trim(end($nameArray)));
            }
            PropertyImages::create([
              'property_id' => $property->id,
              'images_link' => trim(end($nameArray)),
              'temp_image' => $urls[$i]
            ]);
          }          
        }      
      }
      $temp = [];
      if($row->privateamenities){
        $features = explode("|",$row->privateamenities);
        for($j=0; $j < count($features); $j++) {
          if($tempFea = Features::where('feature_prefix','LIKE','%'.$features[$j].'%')->first()){
            $temp[$i]['property_id'] = $property->id;
            $temp[$i++]['feature_id'] = $tempFea->id;
          }
        }
      }
      $temp = [];
      if($row->commercialamenities){
        $features = explode("|",$row->commercialamenities);
        for($j=0; $j < count($features); $j++) {
          if($tempFea = Features::where('feature_prefix','LIKE','%'.$features[$j].'%')->first()){
            $temp[$i]['property_id'] = $property->id;
            $temp[$i++]['feature_id'] = $tempFea->id;
          }
        }
      }

      \DB::table("property_portals")->insert(['property_id'=>$property->id,'portal_id'=>3]);  

    }
    echo "<pre>";
    print_r($propertArray);
    die;
  }   
}
