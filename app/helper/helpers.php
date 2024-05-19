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

    if(in_array($zone,timeZones()))
    {
        return $row->timezone($zone);
    }

    return  $row->timezone('Asia/Riyadh');

}

use App\Activity;
use App\Status;
use App\History;

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
       " 0 - 1,000,000",
        "1,000,000 - 2,000,000",
        "2,000,000 - 3,000,000",
        "3,000,000 - 4,000,000",
        "4,000,000 - 5,000,000",
        "> 5,000,000    ",
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
  if(userRole() == 'sales director'){
    if(auth()->user()->time_zone == 'Asia/Riyadh'){
      return false;
    }
    return true;
  }
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
  if(userRole() == 'sales director'){
    if(auth()->user()->time_zone == 'Asia/Dubai'){
      return false;
    }
    return true;
  }

  if(userRole() != 'sales admin uae'){
  
    if(userRole() == 'other' && auth()->user()->time_zone == 'Asia/Dubai'){
      return false;
    }
    return true;
  }else{
    return false;
  }  
}


function addHistory($module_name,$module_id,$request_type,$update_data=null,$old_data=null,$other_details=null){

  if(isset($old_data['id'])){
    //unset($old_data['id']);
    //unset($old_data['created_at']);
    $old_data = json_encode($old_data,JSON_PRETTY_PRINT);
    $update_data = json_encode($update_data,JSON_PRETTY_PRINT);
  }else if($request_type == 'added'){
    $update_data = json_encode($update_data,JSON_PRETTY_PRINT);   
  }
  $data = [
    'module_name' => $module_name,
    'module_id' => $module_id,
    'user_id' => auth()->id(),
    'request_type' => $request_type,
    'old_data' => $old_data,
    'update_data' => $update_data,
    'other_details' => $other_details,
    'created_at' => \Carbon\Carbon::now(),
    'ip_address'  => $_SERVER['REMOTE_ADDR'], //added by fazal on 27-09-23
  ];
  History::create($data);

}

function selectOptions($data,$form_value,$custom=0){
  if($custom){
    $html = "<option value=''>".__('site.choose')."</option>";
  }else{
    //$html = "<option value='0'>".__('site.choose')."</option>";
    $html = "";
  }
  foreach($data as $key => $value){
    $selected = (($form_value == $key) ? 'selected' : '');
    $html .= "<option value='".$key."' ".$selected.">".$value."</option>";
  }
  return $html;
}

use App\User;
function getSellers() {
  $sellers = [];
  //updated by fazal on 09-01-23
  if(userRole() == 'leader' || userRole() == 'commercial leader' || userRole() == 'business developement leader'){ 
    $id = auth()->id();
    $sellers = User::where(function($q) use($id){
                      $q->where('leader',$id);
                      $q->OrWhere('id',$id);
                    })->orderBy('email','asc')
                    ->where('active','1')->get();
  }elseif(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' || userRole() == 'digital marketing' || userRole() == 'ceo'){ //Updated by Javed

    if(userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' ){
      $whereCountry = '';
      if(userRole() == 'sales admin uae'){
        $whereCountry = 'Asia/Dubai';
        $sellers = User::where(function($q){
          $q->where('rule','sales');
          $q->orWhere('rule','leader');
          $q->orWhere('rule','sales director');
          $q->orWhere('rule','sales admin'); // added by fazal 05-09-23
          $q->orWhere('rule','commercial leader');
          $q->orWhere('rule','commercial sales');
          $q->orWhere('rule','business developement leader');
          $q->orWhere('rule','business developement sales');

        })
        ->where('active','1')
        ->where('time_zone','like','%'.$whereCountry.'%')
        ->orderBy('email','asc')
        ->get();
      }else{
        $whereCountry = 'Asia/Riyadh';
        $sellers = User::where(function($q){
          $q->where('rule','sales');
          $q->orWhere('rule','leader');
          $q->orWhere('rule','sales director');
          $q->orWhere('rule','sales admin'); // added by fazal 05-09-23
          $q->orWhere('rule','sales admin saudi');      
          $q->orWhere('rule','ceo');
          $q->orWhere('rule','commercial leader');
          $q->orWhere('rule','commercial sales');
          $q->orWhere('rule','business developement leader');
          $q->orWhere('rule','business developement sales');
        })
        ->where('time_zone','like','%'.$whereCountry.'%')
        ->where('active','1')
        ->orderBy('email','asc')
        ->get();

      }        
  
    }else{
      $sellers = User::where('active','1')->orderBy('email','asc')->get();
    }

  }elseif(userRole() == 'sales admin'){
      // $whereCountry = 'Asia/Riyadh';
      // $leader = auth()->user()->leader;
      // if($leader){
      //   $sellers = User::where('active','1')
      //   ->where('time_zone','like','%'.$whereCountry.'%')
      //       ->where(function($q) use($leader){
      //         $q->where('id','!=',auth()->id())
      //          ->where('rule','sales')
      //         ->orWhere('rule','sales admin saudi')
      //         ->orWhere('id',$leader);
      //       })->orderBy('email','asc')->get();
      // }else{
      //     $sellers = [];
      // }
    //added by fazal on 19-01-24
    $leader = auth()->user()->leader;
           $id = auth()->id();
          if($leader){
          $sellers = User::where(function($q) use($leader){
                      $q->where('leader',$leader);
                      $q->OrWhere('id',auth()->id());
                    })->orderBy('email','asc')
                    ->where('active','1')->get();
      }else{
          $sellers = [];
      }


  }elseif(userRole() == 'sales director'){
    $userloc=User::where('id',auth()->id())->first();
    if($userloc->time_zone=='Asia/Dubai'){
      $sellers = User::where('time_zone','Asia/Dubai')
        ->where('active','1')
        ->where(function($q){
          $q->where('rule','sales')
          ->orWhere('rule','leader')
          ->orWhere('rule','sales director');
        })->orderBy('email','asc')->get();
    }else{
      $sellers = User::where('time_zone','Asia/Riyadh')
        ->where('active','1')
        ->where(function($q){
          $q->where('rule','sales')
          ->orWhere('rule','leader')
          ->orWhere('rule','sales director');
        })->orderBy('email','asc')->get();
    }
  }else {
    $sellers = [];
  }
  return $sellers;
}
function getSalesDirectorCountryId(){
  if(userRole() == 'sales director'){
    if(auth()->user()->time_zone == 'Asia/Riyadh'){
      return 1;
    }
    return 2;
  }
}

function s3AssetUrl($url){
  //return env('APP_URL').'/public/'.$url;
  return env('S3_URL').$url;
}

function getCommercialSellers() {
  $sellers = [];
  if(userRole() == 'commercial leader'){
    $id = auth()->id();
    $sellers = User::where(function($q) use($id){
                      $q->where('leader',$id);
                      $q->OrWhere('id',$id);
                    })->orderBy('email','asc')
                    ->where('active','1')->get();
  }elseif(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' || userRole() == 'digital marketing' || userRole() == 'ceo' || userRole() == 'it' ){ //Updated by Javed

    if(userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' ){
      $whereCountry = '';
      if(userRole() == 'sales admin uae'){
        $whereCountry = 'Asia/Dubai';
        $sellers = User::where(function($q){
          $q->where('rule','commercial sales');
          $q->orWhere('rule','commercial leader');
        })
        ->where('active','1')
        ->where('time_zone','like','%'.$whereCountry.'%')
        ->orderBy('email','asc')
        ->get();
      }else{
        $whereCountry = 'Asia/Riyadh';
        $sellers = User::where(function($q){
          $q->where('rule','commercial sales');
          $q->orWhere('rule','commercial leader');
        })
        ->where('time_zone','like','%'.$whereCountry.'%')
        ->where('active','1')
        ->orderBy('email','asc')
        ->get();

      }        
  
    }else{
      $sellers = User::where(function($q){
        $q->where('rule','commercial sales');
        $q->orWhere('rule','commercial leader');
      })->where('active','1')->orderBy('email','asc')->get();
    }

  }elseif(userRole() == 'sales admin'){
      $whereCountry = 'Asia/Riyadh';
      $leader = auth()->user()->leader;
      if($leader){
        $sellers = User::where('active','1')
        ->where('time_zone','like','%'.$whereCountry.'%')
            ->where(function($q) use($leader){
              $q->where('id','!=',auth()->id())
              ->where('rule','commercial sales')
              ->orWhere('rule','commercial leader')
              ->orWhere('id',$leader);
            })->orderBy('email','asc')->get();
      }else{
          $sellers = [];
      }


  }elseif(userRole() == 'sales director'){
    $userloc=User::where('id',auth()->id())->first();
    if($userloc->time_zone=='Asia/Dubai'){
      $sellers = User::where('time_zone','Asia/Dubai')
        ->where('active','1')
        ->where(function($q){
          $q->where('rule','commercial sales');
          $q->orWhere('rule','commercial leader');
        })->orderBy('email','asc')->get();
    }else{
      $sellers = User::where('time_zone','Asia/Riyadh')
        ->where('active','1')
        ->where(function($q){
          $q->where('rule','commercial sales');
          $q->orWhere('rule','commercial leader');
        })->orderBy('email','asc')->get();
    }
  }else {
    $sellers = [];
  }
  return $sellers;
}

function getBusinessSellers() {
  $sellers = [];
  if(userRole() == 'business developement leader'){
    $id = auth()->id();
    $sellers = User::where(function($q) use($id){
                      $q->where('leader',$id);
                      $q->OrWhere('id',$id);
                    })->orderBy('email','asc')
                    ->where('active','1')->get();
  }elseif(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' || userRole() == 'digital marketing' || userRole() == 'ceo' || userRole() == 'it' ){ //Updated by Javed

    if(userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' ){
      $whereCountry = '';
      if(userRole() == 'sales admin uae'){
        $whereCountry = 'Asia/Dubai';
        $sellers = User::where(function($q){
          $q->where('rule','business developement sales');
          $q->orWhere('rule','business developement leader');
        })
        ->where('active','1')
        ->where('time_zone','like','%'.$whereCountry.'%')
        ->orderBy('email','asc')
        ->get();
      }else{
        $whereCountry = 'Asia/Riyadh';
        $sellers = User::where(function($q){
          $q->where('rule','business developement sales');
          $q->orWhere('rule','business developement leader');
        })
        ->where('time_zone','like','%'.$whereCountry.'%')
        ->where('active','1')
        ->orderBy('email','asc')
        ->get();

      }        
  
    }else{
      $sellers = User::where(function($q){
        $q->where('rule','business developement sales');
        $q->orWhere('rule','business developement leader');
      })->where('active','1')->orderBy('email','asc')->get();
    }

  }elseif(userRole() == 'sales admin'){
      $whereCountry = 'Asia/Riyadh';
      $leader = auth()->user()->leader;
      if($leader){
        $sellers = User::where('active','1')
        ->where('time_zone','like','%'.$whereCountry.'%')
            ->where(function($q) use($leader){
              $q->where('id','!=',auth()->id())
              ->where('rule','business developement sales')
              ->orWhere('rule','business developement leader')
              ->orWhere('id',$leader);
            })->orderBy('email','asc')->get();
      }else{
          $sellers = [];
      }


  }elseif(userRole() == 'sales director'){
    $userloc=User::where('id',auth()->id())->first();
    if($userloc->time_zone=='Asia/Dubai'){
      $sellers = User::where('time_zone','Asia/Dubai')
        ->where('active','1')
        ->where(function($q){
          $q->where('rule','business developement sales');
          $q->orWhere('rule','business developement leader');
        })->orderBy('email','asc')->get();
    }else{
      $sellers = User::where('time_zone','Asia/Riyadh')
        ->where('active','1')
        ->where(function($q){
          $q->where('rule','business developement sales');
          $q->orWhere('rule','business developement leader');
        })->orderBy('email','asc')->get();
    }
  }else {
    $sellers = [];
  }
  return $sellers;
}

