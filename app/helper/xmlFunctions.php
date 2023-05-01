<?php

use App\Features;
use App\PropertyFeatures;


function getFeatureName($id){
  return Features::find($id)->feature_name;
}

function get_amenities($property_id){
  $propertyFeature = PropertyFeatures::where('property_id',$property_id)->get();
  $y=0;
  $z=0;
  $privateamenities="";
  $commercialamenities="";
  $features="";
  $pre_features=[];
  foreach ($propertyFeature as $rs) {
    $features.= $rs->feature->feature_name.',';
    $pre_features[]['name'] = $rs->feature->feature_prefix;
    switch ($rs->feature->feature_name) {
        case "Maid's room":
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="MR";
          $y++;
          break;
          case "Covered Parking":
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="CP";
          $y++;
          break;
          case "Maid Service":
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="MS";
          $y++;
          break;
         case "Concierge Service":
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="CS";
          $y++;
          break;
         case "Lobby in Building":
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="LB";
          $y++;
          break;
          case "Children's Play Area":
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="PR";
          $y++;
          break;
          case "Barbecue Area":
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="BR";
          $y++;
          break;
          case "Walk-in Closet":
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="WC";
          $y++;
          break;
        case "Study":
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="ST";    
          $y++;    
          break; 
          case "Children's Pool":
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="CO";    
          $y++;    
          break; 
        case 'Central air conditioning':
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="AC";    
          $y++;    
          break;     
        case 'Balcony':
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="BA";    
          $y++;    
          break;
        case 'More than one Balcony':    
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="BA";    
          $y++;    
          break;
        case 'Private garden':
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="PG";    
          $y++;    
          break;
        case 'Landscaped garden':
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="PG";    
          $y++;    
          break;
        case 'Private swimming pool':    
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="PP";    
          $y++;    
          break;
        case 'Gymnasium':
          if($y!=0) { $privateamenities.=",";}  
          if($z!=0) { $commercialamenities.=",";}  
          $privateamenities.="PY";
          $commercialamenities.="SY";
          $z++;
          $y++;
          break;
        case 'Gym & health club facilities':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="PY";
          $y++;
          break;
        case 'Private Jacuzzi':
          if($y!=0) { $privateamenities.=",";}      
          $privateamenities.="PJ";    
          $y++;
          break;
        case 'Shared swimming pool':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="SP";
          $y++;
          break;
        case '24 hr security desk':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="SE";
          $y++;
          break;
        case 'Covered parking':
          if($y!=0) { $privateamenities.=",";} 
          if($z!=0) { $commercialamenities.=",";} 
          $privateamenities.="CP";
          $commercialamenities.="CP";
          $z++;
          $y++;
          break;	
        case 'Built in wardrobes':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="BW";
          $y++;
          break;
        case 'Fully fitted kitchen':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="BK";
          $y++;
          break;
        case 'View of Landmark':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="BL";
          $y++;
          break;
        case 'View of sea/':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="VW";
          $y++;
          break;
          case 'Vastu-compliant/':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="VC";
          $y++;
          break;
        case 'Pets allowed':
          if($y!=0) { $privateamenities.=",";}  
          $privateamenities.="PA";
          $y++;
          break;		
        case 'Conference room':
          if($z!=0) { $commercialamenities.=",";}  
          $commercialamenities.="CR";
          $z++;
          break;	
            case 'Available Networked':
          if($z!=0) { $commercialamenities.=",";}  
          $commercialamenities.="AN";
          $z++;
          break;
          case 'Dining in building':
          if($z!=0) { $commercialamenities.=",";}  
          $commercialamenities.="DN";
          $z++;
          break;
        case 'Fully furnished':
          if($z!=0) { $commercialamenities.=",";}  
          $commercialamenities.="AF";
          $z++;
          break;		
        case 'Partly furnished':
          if($z!=0) { $commercialamenities.=",";}  
          $commercialamenities.="AF";
          $z++;
          break;		
        case 'Shared gymnasium':
          if($z!=0) { $commercialamenities.=",";}  
          $commercialamenities.="SG";
          $z++;
          break;		
        case 'Shared spa':
          if($z!=0) { $commercialamenities.=",";}  
          $commercialamenities.="SS";
          $z++;
          break;		
        case 'Dining in Building':    
          if($z!=0) { $commercialamenities.=",";}      
          $commercialamenities.="DB";    
          $z++;   
          break;		
        case 'Retail in Building':
          if($z!=0) { $commercialamenities.=",";}      
          $commercialamenities.="RB";    
          $z++;    
          break;		
        default:
        $privateamenities.="";
  
    }
  }
  $return['commercialamenities']=$commercialamenities;
  $return['privateamenities']=$privateamenities;
  $return['features']=$features;
  $return['pre_features']=$pre_features;
  return $return;
}
