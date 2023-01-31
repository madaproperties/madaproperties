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

class PropertyDubizzleXmlController extends Controller
{

  function propertyDubizzleXml(){
    $properties = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->whereIn('property_portals.portal_id',[2,3])
    ->where('status',1)
    ->get();
    
    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<dubizzlepropertyfeed>";
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
      
      if($sale_rent==1) { $offering_type1="SP"; }
      
      else if($sale_rent==2) { $offering_type1="RP"; }
      
      $offering_type=$offering_type2.$offering_type1;
      
      //$category=$property->category->category_name;
      
      $get_property_type=isset($property->category->pfix) ? $property->category->pfix : "";
      $price=$property->price;
      $dte=date('d');
      if($dte % 2 == 0){ 
        $price=$price-1;      
      }

      $price=str_replace(".00","",$price);
      //$city_text = $property->city->name_en;
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
      <property>";
      if($property->stage){
        $xml.="<status>vacant</status>";
      }

      if($offering_type){
        $xml.="<type>".$offering_type."</type>";
      }

      if($get_property_type){
        $xml.="<subtype>".$get_property_type."</subtype>";
      }else{
        $xml.="<subtype>AP</subtype>";
      }

      if($get_property_type == 'CO'){
        $xml.="<commercialtype>".$get_property_type."</commercialtype>";
      }      

      if($property->crm_id){
        $xml.="<refno>".$property->crm_id."</refno>";
      }

      if($permit_number){
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }

      
      
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



      $xml.="<city><![CDATA[2]]></city>";
      if($property->project_name){
        $xml.="<locationtext><![CDATA[".$property->project_name."]]></locationtext>";
      }else{
        $xml.="<locationtext><![CDATA[Dubai]]></locationtext>";
      }
      $xml.="<building><![CDATA[".$property->building_name."]]></building>
      <title><![CDATA[".$property->title."]]></title>
      <description><![CDATA[".$property->description."]]></description>";
      if($privateamenities){
        $xml.="<privateamenities>".$privateamenities."</privateamenities>";
      }
      if($commercialamenities){
        $xml.="<commercialamenities>".$commercialamenities."</commercialamenities>";
      }
      
      $measure_unit = '';
      if($property->measure_unit == '1'){
        $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
      }else if($property->measure_unit == '2'){
        $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
      }

      $xml.="<size>".$property->buildup_area."</size>
      <sizeunits>".$measure_unit."</sizeunits>
      <bedrooms>".__('config.bedrooms.'.$property->bedrooms)."</bedrooms>
      <bathrooms>".$property->bathrooms."</bathrooms>";
      if($property->agent && $property->agent->is_rera_active){
        $xml .="<contactemail>".$property->agent->name."</contactemail>
          <contactnumber>".$property->agent->mobile_no."</contactnumber>";
      }else{
        if($defaultAgent){
          $xml .="<contactemail>".$defaultAgent->name."</contactemail>
          <contactnumber>".$defaultAgent->mobile_no."</contactnumber>";
        }
      }
      $xml .="<lastupdated>".($property->last_updated)."</lastupdated>";
      
      if($property->developer){
       // $xml .="<developer>".($property->developer)."</developer>";
      }
      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
      }
      if($property->video){
        $xml .="<video_url>".($property->video)."</video_url>";
      }
      if($property->images && count($property->images)){
        $xml .="<photos>";
        $x=0;
        $photo=[];
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $photo[]= s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image->images_link);          
        }
        $xml.= implode("|",$photo);
        $xml.="</photos>";
      }

      $xml .="<furnished>".($property->furnished == 1 ? '1' : '0')."</furnished>";

      if($property->geopoints){
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $xml.="</property>";
    }
    
    $xml.="</dubizzlepropertyfeed>";    
    echo $xml;  
    die;
  }

  
  function propertyDubizzleHourlyXml(){
    $properties = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',3)
    ->where('status',1)
    ->where('last_updated','>', Carbon::now()->subDay())
    ->limit(10)
    ->get();
    
    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<dubizzlepropertyfeed>";
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
      
      if($sale_rent==1) { $offering_type1="SP"; }
      
      else if($sale_rent==2) { $offering_type1="RP"; }
      
      $offering_type=$offering_type2.$offering_type1;
      
      //$category=$property->category->category_name;
      
      $get_property_type=isset($property->category->pfix) ? $property->category->pfix : "";
      $price=$property->price;
      $dte=date('d');
      if($dte % 2 == 0){ 
        $price=$price-1;      
      }

      $price=str_replace(".00","",$price);
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
      <property>";
      if($property->stage){
        $xml.="<status>vacant</status>";
      }

      if($offering_type){
        $xml.="<type>".$offering_type."</type>";
      }

      if($get_property_type){
        $xml.="<subtype>".$get_property_type."</subtype>";
      }else{
        $xml.="<subtype>AP</subtype>";
      }

      if($get_property_type == 'CO'){
        $xml.="<commercialtype>".$get_property_type."</commercialtype>";
      }      

      if($property->crm_id){
        $xml.="<refno>".$property->crm_id."</refno>";
      }

      if($permit_number){
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }

      
      
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


      $xml.="<city><![CDATA[2]]></city>";

      if($property->project_name){
        $xml.="<locationtext><![CDATA[".$property->project_name."]]></locationtext>";
      }else{
        $xml.="<locationtext><![CDATA[Dubai]]></locationtext>";
      }
      
      $xml.="<building><![CDATA[".$property->building_name."]]></building>
      <title><![CDATA[".$property->title."]]></title>
      <description><![CDATA[".$property->description."]]></description>";
      if($privateamenities){
        $xml.="<privateamenities>".$privateamenities."</privateamenities>";
      }
      if($commercialamenities){
        $xml.="<commercialamenities>".$commercialamenities."</commercialamenities>";
      }
      
      $measure_unit = '';
      if($property->measure_unit == '1'){
        $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
      }else if($property->measure_unit == '2'){
        $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
      }

      $xml.="<size>".$property->buildup_area."</size>
      <sizeunits>".$measure_unit."</sizeunits>
      <bedrooms>".__('config.bedrooms.'.$property->bedrooms)."</bedrooms>
      <bathrooms>".$property->bathrooms."</bathrooms>";
      if($property->agent && $property->agent->is_rera_active){
        $xml .="<contactemail>".$property->agent->name."</contactemail>
          <contactnumber>".$property->agent->mobile_no."</contactnumber>";
      }else{
        if($defaultAgent){
          $xml .="<contactemail>".$defaultAgent->name."</contactemail>
          <contactnumber>".$defaultAgent->mobile_no."</contactnumber>";
        }
      }
      $xml .="<lastupdated>".($property->last_updated)."</lastupdated>";
      if($property->developer){
        $xml .="<developer>".($property->developer)."</developer>";
      }
      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
      }
      if($property->video){
        $xml .="<video_url>".($property->video)."</video_url>";
      }
      if($property->images && count($property->images)){
        $xml .="<photos>";
        $x=0;
        $photo=[];
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $photo[]= s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image->images_link);          
        }
        $xml.= implode("|",$photo);
        $xml.="</photos>";
      }

      $xml .="<furnished>".($property->furnished == 1 ? '1' : '0')."</furnished>";

      if($property->geopoints){
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $xml.="</property>";
    }
    
    $xml.="</dubizzlepropertyfeed>";    
    echo $xml;  
    die;
  }
}
