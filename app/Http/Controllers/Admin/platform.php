<?php

if(!session_id()) {
	session_start();
}

$challenge = isset($_REQUEST['hub_challenge']) ? $_REQUEST['hub_challenge'] : "";

$verify_token = isset($_REQUEST['hub_verify_token']) ? $_REQUEST['hub_verify_token'] : "";

//print($verify_token);

if ($verify_token == 'meatyhamhock') {
//	echo $challenge;
}


$input = json_decode(file_get_contents('php://input'), true);


$leadgen_id = $input["entry"][0]["changes"][0]["value"]["leadgen_id"];

//$url = "https://graph.facebook.com/v12.0/$leadgen_id/?fields=campaign_name,is_organic,adset_name,ad_name,platform,field_data&access_token=EAACMZCqe3tzsBAK6QGNsocZBZCQEbken2wKm7yHsNnuf0uRSWw7TYS0lEFiyD6C0dZBox9KTJz7zDdoqj1Ad9JxhaVoboCwNoHxYh9ZCQZB7PFhhifaoSfqjtynsZAlyyYM0u7HjLBLA8QgBxY6YvPHrWeApMnzJuXitzhnx1OZBbF2cRWTxYGfw";
$url = "https://graph.facebook.com/v12.0/$leadgen_id/?fields=campaign_name,is_organic,adset_name,ad_name,platform,field_data&access_token=EAACMZCqe3tzsBADmA4XSukWbzhenELmSTJ2rJrQ9FSaMmuiww0I2ZBTUymRl56iOe0VvlH8PhZCvrs59PlRhJKUsUL1lZBT3Hc2DtYVzhFSoAWKft3K99mDakyML5KW85CuZBZCi0NjzOmiCOlgCZCqHh4UtCwJgZC9airL4ZAWs4zCbqVz5CLt7sB1ZBojxTwUqMZD";


// 1. Open cURL session

    $ch = curl_init();

    // 2. Set options

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // 3. Execute and save response

    $response = curl_exec($ch);

	curl_close($ch);

//print_r($response);
$decod = json_decode($response);


// get your list of country codes
$ccodes = array(
	'93' => 'Afghanistan',
	'355' => 'Albania',
	'213' => 'Algeria',
	'1-684' => 'American Samoa',
	'376' => 'Andorra',
	'244' => 'Angola',
	'1-264' => 'Anguilla',
	'672' => 'Antarctica',
	'1-268' => 'Antigua and Barbuda',
	'54' => 'Argentina',
	'374' => 'Armenia',
	'297' => 'Aruba',
	'61' => 'Australia',
	'43' => 'Austria',
	'994' => 'Azerbaijan',
	'1-242' => 'Bahamas',
	'973' => 'Bahrain',
	'880' => 'Bangladesh',
	'1-246' => 'Barbados',
	'375' => 'Belarus',
	'32' => 'Belgium',
	'501' => 'Belize',
	'229' => 'Benin',
	'1-441' => 'Bermuda',
	'975' => 'Bhutan',
	'591' => 'Bolivia',
	'387' => 'Bosnia and Herzegovina',
	'267' => 'Botswana',
	'55' => 'Brazil',
	'246' => 'British Indian Ocean Territory',
	'1-284' => 'British Virgin Islands',
	'673' => 'Brunei',
	'359' => 'Bulgaria',
	'226' => 'Burkina Faso',
	'257' => 'Burundi',
	'855' => 'Cambodia',
	'237' => 'Cameroon',
	'1' => 'Canada',
	'238' => 'Cape Verde',
	'1-345' => 'Cayman Islands',
	'236' => 'Central African Republic',
	'235' => 'Chad',
	'56' => 'Chile',
	'86' => 'China',
	'61' => 'Christmas Island',
	'61' => 'Cocos Islands',
	'57' => 'Colombia',
	'269' => 'Comoros',
	'682' => 'Cook Islands',
	'506' => 'Costa Rica',
	'385' => 'Croatia',
	'53' => 'Cuba',
	'599' => 'Curacao',
	'357' => 'Cyprus',
	'420' => 'Czech Republic',
	'243' => 'Democratic Republic of the Congo',
	'45' => 'Denmark',
	'253' => 'Djibouti',
	'1-767' => 'Dominica',
	'1-809, 1-829, 1-849' => 'Dominican Republic',
	'670' => 'East Timor',
	'593' => 'Ecuador',
	'20' => 'Egypt',
	'503' => 'El Salvador',
	'240' => 'Equatorial Guinea',
	'291' => 'Eritrea',
	'372' => 'Estonia',
	'251' => 'Ethiopia',
	'500' => 'Falkland Islands',
	'298' => 'Faroe Islands',
	'679' => 'Fiji',
	'358' => 'Finland',
	'33' => 'France',
	'689' => 'French Polynesia',
	'241' => 'Gabon',
	'220' => 'Gambia',
	'995' => 'Georgia',
	'49' => 'Germany',
	'233' => 'Ghana',
	'350' => 'Gibraltar',
	'30' => 'Greece',
	'299' => 'Greenland',
	'1-473' => 'Grenada',
	'1-671' => 'Guam',
	'502' => 'Guatemala',
	'44-1481' => 'Guernsey',
	'224' => 'Guinea',
	'245' => 'Guinea-Bissau',
	'592' => 'Guyana',
	'509' => 'Haiti',
	'504' => 'Honduras',
	'852' => 'Hong Kong',
	'36' => 'Hungary',
	'354' => 'Iceland',
	'91' => 'India',
	'62' => 'Indonesia',
	'98' => 'Iran',
	'964' => 'Iraq',
	'353' => 'Ireland',
	'44-1624' => 'Isle of Man',
	'972' => 'Israel',
	'39' => 'Italy',
	'225' => 'Ivory Coast',
	'1-876' => 'Jamaica',
	'81' => 'Japan',
	'44-1534' => 'Jersey',
	'962' => 'Jordan',
	'7' => 'Kazakhstan',
	'254' => 'Kenya',
	'686' => 'Kiribati',
	'383' => 'Kosovo',
	'965' => 'Kuwait',
	'996' => 'Kyrgyzstan',
	'856' => 'Laos',
	'371' => 'Latvia',
	'961' => 'Lebanon',
	'266' => 'Lesotho',
	'231' => 'Liberia',
	'218' => 'Libya',
	'423' => 'Liechtenstein',
	'370' => 'Lithuania',
	'352' => 'Luxembourg',
	'853' => 'Macau',
	'389' => 'Macedonia',
	'261' => 'Madagascar',
	'265' => 'Malawi',
	'60' => 'Malaysia',
	'960' => 'Maldives',
	'223' => 'Mali',
	'356' => 'Malta',
	'692' => 'Marshall Islands',
	'222' => 'Mauritania',
	'230' => 'Mauritius',
	'262' => 'Mayotte',
	'52' => 'Mexico',
	'691' => 'Micronesia',
	'373' => 'Moldova',
	'377' => 'Monaco',
	'976' => 'Mongolia',
	'382' => 'Montenegro',
	'1-664' => 'Montserrat',
	'212' => 'Morocco',
	'258' => 'Mozambique',
	'95' => 'Myanmar',
	'264' => 'Namibia',
	'674' => 'Nauru',
	'977' => 'Nepal',
	'31' => 'Netherlands',
	'599' => 'Netherlands Antilles',
	'687' => 'New Caledonia',
	'64' => 'New Zealand',
	'505' => 'Nicaragua',
	'227' => 'Niger',
	'234' => 'Nigeria',
	'683' => 'Niue',
	'850' => 'North Korea',
	'1-670' => 'Northern Mariana Islands',
	'47' => 'Norway',
	'968' => 'Oman',
	'92' => 'Pakistan',
	'680' => 'Palau',
	'970' => 'Palestine',
	'507' => 'Panama',
	'675' => 'Papua New Guinea',
	'595' => 'Paraguay',
	'51' => 'Peru',
	'63' => 'Philippines',
	'64' => 'Pitcairn',
	'48' => 'Poland',
	'351' => 'Portugal',
	'1-787, 1-939' => 'Puerto Rico',
	'974' => 'Qatar',
	'242' => 'Republic of the Congo',
	'262' => 'Reunion',
	'40' => 'Romania',
	'7' => 'Russia',
	'250' => 'Rwanda',
	'590' => 'Saint Barthelemy',
	'290' => 'Saint Helena',
	'1-869' => 'Saint Kitts and Nevis',
	'1-758' => 'Saint Lucia',
	'590' => 'Saint Martin',
	'508' => 'Saint Pierre and Miquelon',
	'1-784' => 'Saint Vincent and the Grenadines',
	'685' => 'Samoa',
	'378' => 'San Marino',
	'239' => 'Sao Tome and Principe',
	'966' => 'Saudi Arabia',
	'221' => 'Senegal',
	'381' => 'Serbia',
	'248' => 'Seychelles',
	'232' => 'Sierra Leone',
	'65' => 'Singapore',
	'1-721' => 'Sint Maarten',
	'421' => 'Slovakia',
	'386' => 'Slovenia',
	'677' => 'Solomon Islands',
	'252' => 'Somalia',
	'27' => 'South Africa',
	'82' => 'South Korea',
	'211' => 'South Sudan',
	'34' => 'Spain',
	'94' => 'Sri Lanka',
	'249' => 'Sudan',
	'597' => 'Suriname',
	'47' => 'Svalbard and Jan Mayen',
	'268' => 'Swaziland',
	'46' => 'Sweden',
	'41' => 'Switzerland',
	'963' => 'Syria',
	'886' => 'Taiwan',
	'992' => 'Tajikistan',
	'255' => 'Tanzania',
	'66' => 'Thailand',
	'228' => 'Togo',
	'690' => 'Tokelau',
	'676' => 'Tonga',
	'1-868' => 'Trinidad and Tobago',
	'216' => 'Tunisia',
	'90' => 'Turkey',
	'993' => 'Turkmenistan',
	'1-649' => 'Turks and Caicos Islands',
	'688' => 'Tuvalu',
	'1-340' => 'U.S. Virgin Islands',
	'256' => 'Uganda',
	'380' => 'Ukraine',
	'971' => 'United Arab Emirates',
	'44' => 'UK',
	'1' => 'United States',
	'598' => 'Uruguay',
	'998' => 'Uzbekistan',
	'678' => 'Vanuatu',
	'379' => 'Vatican',
	'58' => 'Venezuela',
	'84' => 'Vietnam',
	'681' => 'Wallis and Futuna',
	'212' => 'Western Sahara',
	'967' => 'Yemen',
	'260' => 'Zambia',
	'263' => 'Zimbabwe'
);

krsort( $ccodes );



$lead_data = $decod->field_data;

$platform = $decod->platform;

foreach ($lead_data as $key) {
	if ($key->name == 'Language') {
		$arg["language"] = $key->values[0];
	} elseif (($key->name == 'first_name') || ($key->name == 'prénom') || ($key->name == 'имя') || ($key->name == 'الاسم_الأول')) {
		$arg["firstname"] = $key->values[0];
	} elseif (($key->name == 'last_name') || ($key->name == 'nom_de_famille') || ($key->name == 'фамилия') || ($key->name == 'اسم_العائلة')) {
		$arg["lastname"] = $key->values[0];
	} elseif (($key->name == 'email') || ($key->name == 'e-mail') || ($key->name == 'эл._адрес') || ($key->name == 'البريد_الإلكتروني')) {
		$arg["email"] = $key->values[0];
	//} elseif (($key->name == 'phone_number') || ($key->name == 'номермобильного') || ($key->name == 'numéro_de_téléphone') || ($key->name == 'номер_телефона') || ($key->name == 'رقم_الهاتف')) {
	} elseif (($key->name == 'phone_number') || ($key->name == '_номер_мобильного:') || ($key->name == 'numéro_de_téléphone') || ($key->name == 'رقم_الهاتف')) {
		$arg["phone"] = $key->values[0];
	} elseif (($key->name == 'full_name') || ($key->name == 'полное_имя') || ($key->name == 'nom et prénom') || ($key->name == 'полное имя') || ($key->name == 'الاسم الكامل') || ($key->name == 'الاسم_بالكامل')){
		$arg["firstname"] = $key->values[0];
	}
}


$arg["phone"] = str_replace('+', '', $arg["phone"]);
$arg["phone"] = str_replace(' ', '', $arg["phone"]);



foreach( $ccodes as $key=>$value )
{
	if ( substr( $arg["phone"], 0, strlen( $key ) ) == $key )
	{
		// match
		$country["value"] = $value;
		$country["key"] = $key;
		break;
	}
}

$arg["phone"] = substr($arg["phone"], strlen($country["key"]));

$adname = $decod->ad_name;
$adname_exp = explode("|", $adname);

$arg["project"] = $adname_exp[2];
$arg["utmcampaign"] = $adname_exp[1];
$arg["utmmedium"] = "paid-social";

if ( $platform == 'ig') {
	$arg["utmsource"] = "instagram";
} else {
	$arg["utmsource"] = "facebook";
}


// CRM Integration

//if ($arg["language"] == "Russian") {
//	$assignedto ="39";
//} else {
//	$assignedto ="13";	
//}

$assignedto ="68";	

$crm_post = array(
	  'first_name' => $arg["firstname"],
	  'last_name' => $arg["lastname"],
	  'country' => $country["value"],
	  'phone' => $arg["phone"],
	  'email' => $arg["email"],
	  'purpose' => 'buy',
	  'assignedto' => $assignedto,
	  'last_mile_conversion' => 'Form',
//	  "country_fromat" => 'iso',
	  'campaign' => $arg["utmcampaign"],
	  'medium' => $arg["utmmedium"],
	  'source' => $arg["utmsource"],
	  'content' => $arg["utmcontent"],
	  'project_id' => $arg["project"],
	  'lang' => $arg["language"]
  );

		  
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
  CURLOPT_POSTFIELDS => $crm_post,
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvbG1zLm1hZGFwcm9wZXJ0aWVzLmNvbVwvYXBpXC9sb2dpbiIsImlhdCI6MTYzMzAzNDg0MywibmJmIjoxNjMzMDM0ODQzLCJqdGkiOiJOalp5ZktDQWtyeEJVSk53Iiwic3ViIjozMywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.-SUTtA8DBPffXy3yu0Pip1GRtYbO49VanqkPL9_V4ow"
  ),
));

//print_r($crm_post);
$response = curl_exec($curl);

curl_close($curl);

$json_response = json_decode($response, true);


if ($json_response['msg'] === 'Created successfully') {

	$file = 'crm-integration.txt';
	$data = file_get_contents($file);
	$data .= "\n ------- \n";
	//$data .= json_encode($crm_post);
	$data .= "\n ------- \n";
	$data .= 'successfully created';
	file_put_contents($file, $data);
	
} elseif (strpos($json_response['msg'][0], 'lead exists before') !== false) {

	$file = 'crm-integration.txt';
	$data = file_get_contents($file);
	$data .= "\n ------- \n";
	$data .= 'lead exists';
	file_put_contents($file, $data);

} else{

	$file = 'crm-integration.txt';
	$data = file_get_contents($file);
	$data .= "\n ------- \n";
	$data .= json_encode($response);
	$data .= json_encode($crm_post);
	file_put_contents($file, $data);
}
?>

