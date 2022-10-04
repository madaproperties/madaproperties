<?php

session_start();


include '../inc/conf.php';

$arg=[];
$errors = [];

if(!empty($_POST["first_name"])){
	$arg["firstname"] = trim($_POST["first_name"]);
}else{
	$arg["firstname"] = "";
}
if(!empty($_POST["last_name"])){
	$arg["lastname"] = trim($_POST["last_name"]);
}else{
	$arg["lastname"] = "";
}
if(!empty($_POST["email"])){
	$arg["email"] = trim($_POST["email"]);
}else{
	$arg["email"] = "";
}
if(!empty($_POST["country_code"])){
	$arg["countrycode"] = trim($_POST["country_code"]);
}else{
	$arg["countrycode"] = "";
}
if(!empty($_POST["phone_number"])){
	$arg["phone"] = trim($_POST["phone_number"]);
}else{
	$arg["phone"] = "";
}


$_SESSION["arg"] = $arg;

function isString($value){
	global $errors;
	if (strlen($value) == 0){
		$errors[] =  ["Please enter your name"];	
	}
}

function isNumber($str){
	if ( is_numeric( $str ) && strpos( $str, '.' ) === false ){
		return true;
	}else{
		return false;
	}
}

function isNotEmpty($str) 
{

    $str = trim($str);

    if($str != '')
    {
         return true;
    }

    return false;
}

function isAlphaNumeric($str,$chars='-_@. ,:'){
	return !preg_match('/[^'.$chars.'0-9A-Za-z]/', $str);
}

function isAlphabet($str,$chars='-_@. '){
	return !preg_match('/[^'.$chars.'A-Za-z]/', $str);
}

function isvalidLength($str,$length){
	if ( strlen( $str )<=$length){
		return true;
	}else{
		return false;
	}
}

$pageResponse = [];
$errors = [];
$valid = true;

if( !isNotEmpty($arg["firstname"]) || !isvalidLength($arg["firstname"],40) ){
	$valid = false;
	$errors['firstname'] = 1;
	print $errors['firstname'];
}
if( !isNotEmpty($arg["lastname"]) || !isvalidLength($arg["lastname"],40) ){
	$valid = false;
	$errors['lastname'] = 1;
	print $errors['lastname'];
}
if( !isvalidLength($arg["countrycode"],15) ){
	$valid = false;
	$errors['countrycode'] = 1;
	print $errors['countrycode'];
}
if(!isNumber($arg["phone"]) || !isvalidLength($arg["phone"],15) ){
	$valid = false;
	$errors['phone'] = 1;
	print $errors['phone'];
}

$error_arr = [];
$error_String = "";
foreach($errors as $key=>$value){
	$error_arr[] = $key;
}
$error_String = implode("|",$error_arr);


$pageResponse["error"] =$error_String;

if(!$valid){
	header('location: /landing/'. $page_location .'/en/?error='.$error_String);
	exit();
}


$arg["utmcampaign"] = $_POST['utm_campaign'];
$arg["utmmedium"] = $_POST['utm_medium'];
$arg["utmsource"] = $_POST['utm_source'];
$arg["utmcontent"] = $_POST['utm_content'];
$arg["iso2"] = $_POST['iso2'];
$arg["language"] = $_POST['language'];
$arg["project"] = $_POST['project'];
$arg["date"] = date("Y/m/d h:i:sa");

$content = "<br><b>First name:</b> ". $arg["firstname"]  . PHP_EOL;
$content .= "<br><b>Last name:</b> ". $arg["lastname"] . PHP_EOL;
$content .= "<br><b>Email:</b> ". $arg["email"] . PHP_EOL;
$content .= "<br><b>Phone:</b> " . $arg["countrycode"] . PHP_EOL;
$content .= "<br><b>utm_source:</b> ". $arg["utmsource"] . PHP_EOL;
$content .= "<br><b>utm_medium:</b> ". $arg["utmmedium"] . PHP_EOL;
$content .= "<br><b>utm_campaign:</b> ". $arg["utmcampaign"] . PHP_EOL;
$content .= "<br><b>utm_content:</b> ". $arg["utmcontent"] . PHP_EOL;
$content .= "<br><b>Language:</b> ". $arg["language"] . PHP_EOL;
$content .= "<br><b>Project:</b> ". $arg["project"] . PHP_EOL;
$content .= "<br><b>Date:</b> ". $arg["date"] . PHP_EOL;



$emailAddress = $mailto;


$e_subject = 'New Lead has been submitted';


$e_body = "Submitted on $date <br>Submitted values are:<br>" . PHP_EOL . PHP_EOL;

$e_content = $content;

$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );
$headers = "From: info@madaproperties.com" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "CC: $ccmail" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;
 
if(mail($emailAddress, $e_subject, $msg, $headers)) {
		
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://lms.madaproperties.com/api/new-contact",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array(
	  'first_name' => $arg["firstname"] ,
	  'last_name' => $arg["lastname"],
	  'country' => $arg["iso2"],
	  'phone' => $arg["phone"],
	  'email' => $arg["email"],
	  'purpose' => 'buy',
	  'assignedto' => $assignedto,
	  'last_mile_conversion' => 'Form',
	  "country_fromat" => 'iso',
	  'campaign' => $arg["utmcampaign"],
	  'medium' => $arg["utmmedium"],
	  'source' => $arg["utmsource"],
	  'content' => $arg["utmcontent"],
	  'project_id' => $arg["project"],
	  'lang' => $arg["language"]
  ),
  CURLOPT_HTTPHEADER => array( "$token" ),
));

$response = curl_exec($curl);

curl_close($curl);

$json_response = json_decode($response, true);

if ($json_response['msg'] === 'Created successfully') {
    header('Location: /landing/'. $page_location .'/en/thank-you.php');
} elseif (strpos($json_response['msg'][0], 'lead exists before') !== false) {
		header('Location: /landing/'. $page_location .'/en/thank-you.php');
} else{
	echo "something went wrong";
}

?>