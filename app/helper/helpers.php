<?php


function active_nav($routeName = '')
{
  $routeName = 'admin.'.$routeName;
  if($routeName == Route::currentRouteName())
  {
    return true;
  }
}

function get_langs()
{
  return [
      'arabic' => 'عربي',
      'english' => 'english',
      'russian' => 'russian',
      'French' => 'French',
  ];
}



//Edited by rezker (http://www.rezker.com)
function code_to_country( $code ){

    $code = strtoupper($code);

    $countryList = array(
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas the',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island (Bouvetoya)',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
        'VG' => 'British Virgin Islands',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros the',
        'CD' => 'Congo',
        'CG' => 'Congo the',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote d\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FO' => 'Faroe Islands',
        'FK' => 'Falkland Islands (Malvinas)',
        'FJ' => 'Fiji the Fiji Islands',
        'FI' => 'Finland',
        'FR' => 'France, French Republic',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia the',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and McDonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyz Republic',
        'LA' => 'Lao',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'AN' => 'Netherlands Antilles',
        'NL' => 'Netherlands the',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn Islands',
        'PL' => 'Poland',
        'PT' => 'Portugal, Portuguese Republic',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russia',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia (Slovak Republic)',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia, Somali Republic',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard & Jan Mayen Islands',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland, Swiss Confederation',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'UK',
        'US' => 'United States',
        'UM' => 'United States Minor Outlying Islands',
        'VI' => 'United States Virgin Islands',
        'UY' => 'Uruguay, Eastern Republic of',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    );

    if( !$countryList[$code] ) {
        return $code   ;
    }

    return $countryList[$code];


}


function lead_types()
{
    return ['Hot','Cold','Warm'];
}

function timeZones()
{
    return [
        'Asia/Riyadh',
        'Asia/Dubai'
    ];
}

function timeZone($row)
{

    $zone = auth()->user()->time_zone ?
                            auth()->user()->time_zone
                                    : 'Asia/Riyadh';

    if(in_array($row,timeZones()))
    {
        return $row->timezone($zone);
    }

    return  $row->timezone('Asia/Riyadh');;

}

use App\Activity;
use App\Status;

function newStatus()
{
    $status = Status::where('name_en','new')->first();
    if(empty($status))
    {
      $status = Status::create([
        'name_ar' => 'جديد',
        'name_en' => 'new',
        'active' => '1'
      ]);
    }
    return $status;
}

function newActivity($contactID,$userID,$action,$model = null,$relatedModelID = null,$activityDate = null,$createdContact = false){

      $data = [
        'contact_id' => $contactID,
        'user_id' => $userID,
        'action' => $action,
        'related_model' => $model,
        'related_model_id' => $relatedModelID,
      ];

      if($activityDate){
        $data['date'] = $activityDate;
      }

      Activity::create($data);
}



function budgets()
{
    return [
       " 0 - 500,000",
        "500,000 - 1,000,000",
        "1,000,000 - 1,500,000",
        "2,000,000 - 2,500,000",
        "3,000,000 - 3,500,000",
        "> 4,000,000    ",
    ];
}


function getvariance($num,$total)
{
    $num = $num < 1 ? 0 : $num;
    $total = $total < 1 ? 1 : $total;

  $number = $num / $total;
  $number=  $number * 100;
  if(strlen($number) > 6)
  {
    $number = number_format($number,2);
  }
  return $number / 2;
}

function get_purposeTypes()
{
  return ['Villa',
                  'Townhouse',
                  'Office',
                  'Showroom',
                  'Land',
                  'Office',
                  'Showroom',
                  'Building',
                  'Commercial'];
}

use App\Setting;
function target_settings()
{
      $coulmns = ['call','meeting','email','whatsapp'];


      // crate them if not exsist
      foreach($coulmns as $coulm)
      {

        $check_status = Setting::where('name',$coulm)->first();

        if(!$check_status)
        {
          Setting::create([
            'name' => $coulm,
            'value' => '1',
          ]);
        }

      }
}

function get_target_byname($search)
{
  return Setting::where('name',$search)->first();
}

function contact_status()
{
  return ['call', 'email', 'meeting', 'whatsapp'];
}

function toCountriess()
{
    return ['Saudi Arabia',
    'United Arab Emirates',
    'Qatar',
    'Bahrain',
    'Kuwait',
    'Oman'];
}

function countriesCodes($search = Null)
{
  $counries =   [
    '966'=>'Saudi Arabia',
    '971'=>'United Arab Emirates',
    '974'=>'Qatar',
    '973'=>'Bahrain',
    '965'=>'Kuwait',
    '968'=>'Oman',
    '213'=>'Algeria',
    '376'=>'Andorra',
    '244'=>'Angola',
    '1264'=>'Anguilla',
    '1268'=>'Antigua & Barbuda',
    '54'=>'Argentina',
    '374'=>'Armenia',
    '297'=>'Aruba',
    '61'=>'Australia',
    '43'=>'Austria',
    '994'=>'Azerbaijan',
    '1242'=>'Bahamas',
    '880'=>'Bangladesh',
    '1246'=>'Barbados',
    '375'=>'Belarus',
    '32'=>'Belgium',
    '501'=>'Belize',
    '229'=>'Benin',
    '1441'=>'Bermuda',
    '975'=>'Bhutan',
    '591'=>'Bolivia',
    '387'=>'Bosnia Herzegovina',
    '267'=>'Botswana',
    '55'=>'Brazil',
    '673'=>'Brunei',
    '359'=>'Bulgaria',
    '226'=>'Burkina Faso',
    '257'=>'Burundi',
    '855'=>'Cambodia',
    '1'=>'Canada',
    '237'=>'Cameroon',
    '238'=>'Cape Verde Islands',
    '1345'=>'Cayman Islands',
    '236'=>'Central African Republic',
    '56'=>'Chile',
    '86'=>'China',
    '57'=>'Colombia',
    '269'=>'Mayotte',
    '242'=>'Congo',
    '682'=>'Cook Islands',
    '506'=>'Costa Rica',
    '385'=>'Croatia',
    '53'=>'Cuba',
    '90392'=>'Cyprus North',
    '357'=>'Cyprus South',
    '42'=>'Czech Republic',
    '45'=>'Denmark',
    '253'=>'Djibouti',
    '1809'=>'Dominican Republic',
    '593'=>'Ecuador',
    '20'=>'Egypt',
    '503'=>'El Salvador',
    '240'=>'Equatorial Guinea',
    '291'=>'Eritrea',
    '372'=>'Estonia',
    '251'=>'Ethiopia',
    '500'=>'Falkland Islands',
    '298'=>'Faroe Islands',
    '679'=>'Fiji',
    '358'=>'Finland',
    '33'=>'France',
    '594'=>'French Guiana',
    '689'=>'French Polynesia',
    '241'=>'Gabon',
    '220'=>'Gambia',
    '7880'=>'Georgia',
    '49'=>'Germany',
    '233'=>'Ghana',
    '350'=>'Gibraltar',
    '30'=>'Greece',
    '299'=>'Greenland',
    '1473'=>'Grenada',
    '590'=>'Guadeloupe',
    '671'=>'Guam',
    '502'=>'Guatemala',
    '224'=>'Guinea',
    '245'=>'Guinea - Bissau',
    '592'=>'Guyana',
    '509'=>'Haiti',
    '504'=>'Honduras',
    '852'=>'Hong Kong',
    '36'=>'Hungary',
    '354'=>'Iceland',
    '91'=>'India',
    '62'=>'Indonesia',
    '98'=>'Iran',
    '964'=>'Iraq',
    '353'=>'Ireland',
    '972'=>'Israel',
    '39'=>'Italy',
    '1876'=>'Jamaica',
    '81'=>'Japan',
    '962'=>'Jordan',
    '7'=>'Uzbekistan',
    '44'=>'UK',
    '254'=>'Kenya',
    '686'=>'Kiribati',
    '850'=>'Korea North',
    '82'=>'Korea South',
    '996'=>'Kyrgyzstan',
    '856'=>'Laos',
    '371'=>'Latvia',
    '961'=>'Lebanon',
    '266'=>'Lesotho',
    '231'=>'Liberia',
    '218'=>'Libya',
    '417'=>'Liechtenstein',
    '370'=>'Lithuania',
    '352'=>'Luxembourg',
    '853'=>'Macao',
    '389'=>'Macedonia',
    '261'=>'Madagascar',
    '265'=>'Malawi',
    '60'=>'Malaysia',
    '960'=>'Maldives',
    '223'=>'Mali',
    '356'=>'Malta',
    '692'=>'Marshall Islands',
    '596'=>'Martinique',
    '222'=>'Mauritania',
    '52'=>'Mexico',
    '691'=>'Micronesia',
    '373'=>'Moldova',
    '377'=>'Monaco',
    '976'=>'Mongolia',
    '1664'=>'Montserrat',
    '212'=>'Morocco',
    '258'=>'Mozambique',
    '95'=>'Myanmar',
    '264'=>'Namibia',
    '674'=>'Nauru',
    '977'=>'Nepal',
    '31'=>'Netherlands',
    '687'=>'New Caledonia',
    '64'=>'New Zealand',
    '505'=>'Nicaragua',
    '227'=>'Niger',
    '234'=>'Nigeria',
    '683'=>'Niue',
    '672'=>'Norfolk Islands',
    '670'=>'Northern Marianas',
    '47'=>'Norway',
    '680'=>'Palau',
    '507'=>'Panama',
    '675'=>'Papua New Guinea',
    '595'=>'Paraguay',
    '51'=>'Peru',
    '63'=>'Philippines',
    '48'=>'Poland',
    '351'=>'Portugal',
    '1787'=>'Puerto Rico',
    '262'=>'Reunion',
    '40'=>'Romania',
    '250'=>'Rwanda',
    '378'=>'San Marino',
    '239'=>'Sao Tome & Principe',
    '221'=>'Senegal',
    '381'=>'Serbia',
    '248'=>'Seychelles',
    '232'=>'Sierra Leone',
    '65'=>'Singapore',
    '421'=>'Slovak Republic',
    '386'=>'Slovenia',
    '677'=>'Solomon Islands',
    '252'=>'Somalia',
    '27'=>'South Africa',
    '34'=>'Spain',
    '94'=>'Sri Lanka',
    '290'=>'St. Helena',
    '1869'=>'St. Kitts',
    '1758'=>'St. Lucia',
    '249'=>'Sudan',
    '597'=>'Suriname',
    '268'=>'Swaziland',
    '46'=>'Sweden',
    '41'=>'Switzerland',
    '963'=>'Syria',
    '886'=>'Taiwan',
    '66'=>'Thailand',
    '228'=>'Togo',
    '676'=>'Tonga',
    '1868'=>'Trinidad & Tobago',
    '216'=>'Tunisia',
    '90'=>'Turkey',
    '993'=>'Turkmenistan',
    '1649'=>'Turks & Caicos Islands',
    '688'=>'Tuvalu',
    '256'=>'Uganda',
    '380'=>'Ukraine',
    '598'=>'Uruguay',
    '678'=>'Vanuatu',
    '379'=>'Vatican City',
    '58'=>'Venezuela',
    '84'=>'Virgin Islands - US (+1340)',
    '681'=>'Wallis & Futuna',
    '969'=>'Yemen (North)',
    '967'=>'Yemen (South)',
    '260'=>'Zambia',
    '263'=>'Zimbabwe',
  ];
  if($search)
  {
    return $counries[$search];
  }
  return $counries;
}

function cities()
{
  return    [
    'Saudi Arabia' => [
      'تبوك' => 'Tabuk',
      'الرياض' => 'Riyadh',
      'الطائف' => 'At Taif',
      'مكة المكرمة' => 'Makkah Al Mukarramah',
      'حائل' => 'Hail',
      'بريدة' => 'Buraydah',
      'الهفوف' => 'Al Hufuf',
      'الدمام' => 'Ad Dammam',
      'المدينة المنورة' => 'Al Madinah Al Munawwarah',
      'ابها' => 'Abha',
      'جازان' => 'Jazan',
      'جدة' => 'Jeddah',
      'المجمعة' => 'Al Majmaah',
      'الخبر' => 'Al Khubar',
      'حفر الباطن' => 'Hafar Al Batin',
      'خميس مشيط' => 'Khamis Mushayt',
      'احد رفيده' => 'Ahad Rifaydah',
      'القطيف' => 'Al Qatif',
      'عنيزة' => 'Unayzah',
      'قرية العليا' => 'Qaryat Al Ulya',
      'الجبيل' => 'Al Jubail',
      'النعيرية' => 'An Nuayriyah',
      'الظهران' => 'Dhahran',
      'الوجه' => 'Al Wajh',
      'بقيق' => 'Buqayq',
      'الزلفي' => 'Az Zulfi',
      'خيبر' => 'Khaybar',
      'الغاط' => 'Al Ghat',
      'املج' => 'Umluj',
      'رابغ' => 'Rabigh',
      'عفيف' => 'Afif',
      'ثادق' => 'Thadiq',
      'سيهات' => 'Sayhat',
      'تاروت' => 'Tarut',
      'ينبع' => 'Yanbu',
      'شقراء' => 'Shaqra',
      'الدوادمي' => 'Ad Duwadimi',
      'الدرعية' => 'Ad Diriyah',
      'القويعية' => 'Quwayiyah',
      'المزاحمية' => 'Al Muzahimiyah',
      'بدر' => 'Badr',
      'الخرج' => 'Al Kharj',
      'الدلم' => 'Ad Dilam',
      'الشنان' => 'Ash Shinan',
      'الخرمة' => 'Al Khurmah',
      'الجموم' => 'Al Jumum',
      'المجاردة' => 'Al Majardah',
      'السليل' => 'As Sulayyil',
      'تثليث' => 'Tathilith',
      'بيشة' => 'Bishah',
      'الباحة' => 'Al Baha',
      'القنفذة' => 'Al Qunfidhah',
      'محايل' => 'Muhayil',
      'ثول' => 'Thuwal',
      'ضبا' => 'Duba',
      'تربه' => 'Turbah',
      'صفوى' => 'Safwa',
      'عنك' => 'Inak',
      'طريف' => 'Turaif',
      'عرعر' => 'Arar',
      'القريات' => 'Al Qurayyat',
      'سكاكا' => 'Sakaka',
      'رفحاء' => 'Rafha',
      'دومة الجندل' => 'Dawmat Al Jandal',
      'الرس' => 'Ar Rass',
      'المذنب' => 'Al Midhnab',
      'الخفجي' => 'Al Khafji',
      'رياض الخبراء' => 'Riyad Al Khabra',
      'البدائع' => 'Al Badai',
      'رأس تنورة' => 'Ras Tannurah',
      'البكيرية' => 'Al Bukayriyah',
      'الشماسية' => 'Ash Shimasiyah',
      'الحريق' => 'Al Hariq',
      'حوطة بني تميم' => 'Hawtat Bani Tamim',
      'ليلى' => 'Layla',
      'بللسمر' => 'Billasmar',
      'شرورة' => 'Sharurah',
      'نجران' => 'Najran',
      'صبيا' => 'Sabya',
      'ابو عريش' => 'Abu Arish',
      'صامطة' => 'Samtah',
      'احد المسارحة' => 'Ahad Al Musarihah',
      'مدينة الملك عبدالله الاقتصادية' => 'King Abdullah Economic City'
      ],
      'United Arab Emirates' => [
        'دبي' => 'Dubai',
        'الشارقة' => 'Sharjah',
        'ظبي' => 'Abu Dhabi',
        'العين' => 'Al ‘Ayn',
        'أجمان' => '‘Ajmān',
        'رأس الخيمة' => 'Ra’s al Khaymah',
        'الفجيرة' => 'Al Fujayrah',
        'أم القيوين' => 'Umm al Qaywayn',
        'مدينة زايد' => 'Madīnat Zāyid',
      ],

  ];

}

















function userRole($get_rule = null)
{

    if($get_rule)
    {
        $rule = $get_rule;
    }else{
        $rule = auth()->user()->rule;
    }


  if($rule == 'manger')
  {
    $rule = 'admin';
  }elseif($rule == 'sales')
  {
    $rule = 'sales';
  }else if($rule == 'sales admin'){
      $rule = 'sales admin';
  }elseif($rule == 'leader') {
    $rule ="leader";
  }

  return $rule;
}


function checkLeader(){
  if(userRole() != 'sales admin saudi'){
    if(userRole() == 'other' && auth()->user()->time_zone == 'Asia/Riyadh'){
      return false;
    }
    return true;
  }else{
    return false;
  }  
}

function checkLeaderUae(){
  if(userRole() != 'sales admin uae'){
  
    if(userRole() == 'other' && auth()->user()->time_zone == 'Asia/Dubai'){
      return false;
    }
    return true;
  }else{
    return false;
  }  
}


// hundel_lang()
// {
//   $langs = [
//     'success' => 'success',
//     'notfound or account not active' => 'notfound or account not active',
//     'confirm' => 'Confirm',
//     'By' => 'By',
//     'update the contact information' => 'update the contact information',
//     'add new' => 'add new',
//     'task' => 'task',
//     'update' => 'update',
//     'create new note with task' => 'create new note with task',
//     'create new note' => 'create new note',
//     'update the note' => 'update the note',
//     'create new email log with task' => 'create new email log with task',
//     'create new email log' => 'create new email log',
//     'create new call log with task' => 'create new call log with task',
//     'create new call log' => 'create new call log',
//     'create new meeting log with task' => 'create new meeting log with task',
//     'create new meeting log' => 'create new meeting log',
//     'create new meeting with task' => 'create new meeting with task',
//     'create new meeting' => 'create new meeting',
//     'create new whatsapp log' => 'create new whatsapp log',
//     'create new whatsapp with task' => 'create new whatsapp with task',
//     'contact created' => 'contact created',
//     'assigned to' => 'assigned to',
//     'status changed to' => 'status changed to',
//     'unknown' => 'unknown',
//     'not contaccted' => 'not contaccted',
//     'New Contacts' => 'New Contacts',
//     'ID' => 'ID',
//     'Name' => 'Name',
//     'Phone' => 'Phone',
//     'Status' => 'Status',
//     'Created' => 'Created',
//     'Assigned To' => 'Assigned To',
//     'Created By' => 'Created By',
//     'Email Address' => 'Email Address',
//     'first Name' => 'First Name',
//     'last name' => 'Last Name',
//     'country' => 'Country',
//     'city' => 'City',
//     'contact phone' => 'Contact Phone',
//     'scound Phone' => 'scound Phone',
//     'budget' => 'Budget',
//     'currencies' => 'currencies',
//     'project' => 'Project',
//     'unit country' => 'Unit Country',
//     'unit city' => 'Unit City',
//     'unit zone' => 'unit Zone',
//     'last mile conversion' => 'Last Mile Conversion',
//     'lead type' => 'Lead Type',
//     'campaign' => 'Campaign',
//     'source' => 'Source',
//     'medium' => 'Medium',
//     'language' => 'Language',
//     'Purpose' => 'Purpose',
//     'purpose type' => 'purpose type',
//     'please include country code' => 'please include country code',
//     'Edit' => 'Edit',
//     'fullname' => 'fullname',
//     'Task' => 'Task',
//     'Note' => 'Note',
//     'meeting' => 'Meeting',
//     'Logs' => 'Logs',
//     'call' => 'Call',
//     'whatsapp' => 'Whatsapp',
//     'contact owner' => 'Contact Owner',
//     'email' => 'Email',
//     'new task' => 'new task',
//     'save' => 'save',
//     'cancel' => 'cancel',
//     'select option' => 'select Option',
//     'type' => 'type',
//     'description' => 'description',
//     'time' => 'time',
//     'date' => 'date',
//     'name' => 'name',
//     'new note' => 'new note',
//     'with Task' => 'with Task',
//     'send notofication' => 'send notofication',
//     'edit contact' => 'edit contact',
//     'select country' => 'select country',
//     'choose' => 'choose',
//     'log email' => 'log email',
//     'type' => 'type',
//     'log call' => 'log call',
//     'call outCome' => 'call outCome',
//     'busy' => 'busy',
//     'connected' => 'connected',
//     'no answer' => 'no Answer',
//     'wrong number' => 'Wrong Number',
//     'log meeting' => 'log meeting',
//     'duration' => 'duration',
//     'meeting outcome' => 'meeting outcome',
//     'completed' => 'completed',
//     'scheduled' => 'scheduled',
//     'no show' => 'no show',
//     'canceled' => 'canceled',
//     'new meeting' => 'new meeting',
//     'log whatsapp' => 'log whatsapp',
//     'activity' => 'activity',
//     'notes' => 'notes',
//     'tasks' => 'tasks',
//     'edit note' => 'edit note',
//     'edit task' => 'edit task',
//     'Account Information' => 'Account Information',
//     'Accounts' => 'Accounts',
//     'Currencies' => 'Currencies',
//     'Notofications' => 'Notofications',
//     'Projects' => 'Projects',
//     'Last Miles' => 'Last Miles',
//     'status' => 'Status',
//     'Purpose Types' => 'Purpose Types',
//     'Sign Out' => 'Sign Out',
//     'Account' => 'Account',
//     'Update Account' => 'Update Account',
//     'New Password' => 'New Password',
//     'Verify Password' => 'Verify Password',
//     'New Account' => 'New Account',
//     'Rule' => 'Rule',
//     'action' => 'action',
//     'Edit Account' => 'Edit Account',
//     'positions' => 'positions',
//     'Leader' => 'Leader',
//     'select leader' => 'select leader',
//     'Password' => 'Password',
//     'In Active' => 'In Active',
//     'Active' => 'Active',
//     'Salles' => 'Salles',
//     'Admin' => 'Admin',
//     'currency' => 'currency',
//     'New Currency' => 'New Currency',
//     'New Project' => 'New Project',
//     'Name AR' => 'Name AR',
//     'Name EN' => 'Name En',
//     'Purpose Type' => 'Purpose Type',
//     'New type' => 'New type',
//     'Last Miles' => 'Last Miles',
//     'New Mile' => 'New Mile',
//     'contacts' => 'contacts',
//     ];
//
//     $arabick = [
//     'نجاح',
//     "غير موجود أو الحساب غير نشط" ,
//     'تؤكد',
//     'بواسطة',
//     "تحديث معلومات الاتصال" ,
//     'اضف جديد',
//     'مهمة',
//     'تحديث',
//     "إنشاء ملاحظة جديدة مع مهمة" ,
//     "إنشاء ملاحظة جديدة" ,
//     "تحديث الملاحظة" ,
//     "إنشاء سجل بريد إلكتروني جديد مع مهمة" ,
//     "إنشاء سجل بريد إلكتروني جديد" ,
//     "إنشاء سجل مكالمات جديد مع مهمة" ,
//     "إنشاء سجل مكالمات جديد" ,
//     "إنشاء سجل اجتماع جديد مع مهمة" ,
//     "إنشاء سجل اجتماع جديد" ,
//     "إنشاء اجتماع جديد مع مهمة" ,
//     "إنشاء اجتماع جديد" ,
//     "إنشاء سجل whatsapp جديد" ,
//     "إنشاء whatsapp جديد بالمهمة" ,
//     "تم إنشاء جهة اتصال" ,
//     'مخصص ل',
//     "تم تغيير الحالة إلى" ,
//     'غير معروف',
//     "غير متصل" ,
//     'اتصالات جديدة',
//     'هوية شخصية',
//     'اسم',
//     'هاتف',
//     'الحالة',
//     'خلقت',
//     'مخصص ل',
//     'انشأ من قبل',
//     'عنوان البريد الإلكتروني',
//     'الاسم الأول',
//     'الكنية',
//     'بلد',
//     'مدينة',
//     'هاتف الاتصال',
//     "الهاتف الوبيل" ,
//     'تبرع',
//     "العملات",
//     'المشروع',
//     "بلد الوحدة",
//     "مدينة الوحدة",
//     "منطقة الوحدة" ,
//     "تحويل الميل الأخير",
//     "نوع الرصاص",
//     'حملة',
//     'مصدر',
//     'متوسط',
//     'لغة',
//     'غرض',
//     "نوع الغرض",
//     "الرجاء تضمين رمز البلد",
//     'تعديل',
//     'الاسم بالكامل',
//     'مهمة',
//     'ملاحظة',
//     'لقاء',
//     'السجلات',
//     'يتصل',
//     'ال WhatsApp',
//     'راسل المالك',
//     'البريد الإلكتروني',
//     'مهمة جديدة',
//     'حفظ',
//     'إلغاء',
//     "حدد الخيار" ,
//     'يكتب',
//     'وصف',
//     'زمن',
//     'تاريخ',
//     'اسم',
//     'ملاحظة جديدة',
//     "مع مهمة",
//     "إرسال notofication" ,
//     "تحرير جهة الاتصال" ,
//     'حدد الدولة',
//     'إختر',
//     "تسجيل البريد الإلكتروني" ,
//     "تسجيل المكالمات" ,
//     "نتيجة المكالمة",
//     'مشغول',
//     "متصل" ,
//     'لا اجابة',
//     'رقم غير صحيح',
//     "سجل الاجتماع" ,
//     'المدة الزمنية',
//     "نتيجة الاجتماع" ,
//     'منجز',
//     'المقرر',
//     "عدم الحضور",
//     'ألغيت',
//     "اجتماع جديد",
//     "تسجيل الواتس اب",
//     'نشاط',
//     'ملاحظات',
//     'مهام',
//     'تحرير مذكرة',
//     "تحرير المهمة",
//     'معلومات الحساب',
//     'حسابات',
//     "العملات",
//     "notofications" ,
//     "المشاريع",
//     "الأميال الأخيرة",
//     'الحالة',
//     "أنواع الغرض" ,
//     'خروج',
//     'الحساب',
//     'تحديث الحساب',
//     'كلمة السر الجديدة',
//     'اكد كلمة المرور',
//     'حساب جديد',
//     'قاعدة',
//     'عمل',
//     "تحرير الحساب",
//     "المناصب" ,
//     'زعيم',
//     "اختيار القائد",
//     'كلمه السر',
//     'غير نشط',
//     'نشيط',
//     "ساليس" ,
//     'مشرف',
//     'عملة',
//     "عملة جديدة",
//     'مشروع جديد',
//     "الاسم ع" ,
//     "name en",
//     "نوع الغرض",
//     'نوع جديد',
//     "ميل جديد",
//     'جهات الاتصال',
//     ];
//     $i = 0;
//
//     foreach($langs as $key => $value)
//     {
//       echo "'" .$key ."'".'=>'."'".$arabick[$i]."'" . ',<br>';
//       $i++;
//     }
//     dd(1);
//   }
