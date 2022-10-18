<?php ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$path_without_params = explode('?', $_SERVER['REQUEST_URI'])[0];

if($path_without_params == '/' || $path_without_params == '/en' || $path_without_params == '/en/') {
    $lang = 'en';
    $title = 'Invest in Dubai property with 0% purchase tax and&nbsp;5%- 8% return on investments';
} else if($path_without_params == '/ru' || $path_without_params == '/ru/') {
    $lang = 'ru';
    $title = 'Инвестируйте в&nbsp;недвижимость Дубая с&nbsp;нулевым налогом на&nbsp;покупку и&nbsp;доходностью от&nbsp;5% до&nbsp;8%';
} else {
    echo '<h1 class="error__404">Error 404. Page not found</h1>';
    die;
}

require_once 'SxGeo.php';

$SxGeo = new SxGeo('SxGeo.dat', SXGEO_BATCH | SXGEO_MEMORY);

$country_iso = $SxGeo->getCountry($_SERVER['REMOTE_ADDR']);

$countries = [
    'GB' => ['code' => '+44', 'country' => 'UK'],
    'NL' => ['code' => '+31', 'country' => 'Netherlands'],
    'AF' => ['code' => '+93', 'country' => 'Afghanistan'],
    'AL' => ['code' => '+355', 'country' => 'Albania'],
    'DZ' => ['code' => '+213', 'country' => 'Algeria'],
    'AS' => ['code' => '+1-684', 'country' => 'American Samoa'],
    'AD' => ['code' => '+376', 'country' => 'Andorra'],
    'AO' => ['code' => '+244', 'country' => 'Angola'],
    'AI' => ['code' => '+1264', 'country' => 'Anguilla'],
    'AQ' => ['code' => '+672', 'country' => 'Antarctica'],
    'AG' => ['code' => '+1268', 'country' => 'Antigua &amp; Barbuda'],
    'AR' => ['code' => '+54', 'country' => 'Argentina'],
    'AM' => ['code' => '+374', 'country' => 'Armenia'],
    'AW' => ['code' => '+297', 'country' => 'Aruba'],
    'AU' => ['code' => '+61', 'country' => 'Australia'],
    'AT' => ['code' => '+43', 'country' => 'Austria'],
    'AZ' => ['code' => '+994', 'country' => 'Azerbaijan'],
    'BS' => ['code' => '+1242', 'country' => 'Bahamas'],
    'BH' => ['code' => '+973', 'country' => 'Bahrain'],
    'BD' => ['code' => '+880', 'country' => 'Bangladesh'],
    'BB' => ['code' => '+1246', 'country' => 'Barbados'],
    'BY' => ['code' => '+375', 'country' => 'Belarus'],
    'BE' => ['code' => '+32', 'country' => 'Belgium'],
    'BZ' => ['code' => '+501', 'country' => 'Belize'],
    'BJ' => ['code' => '+229', 'country' => 'Benin'],
    'BM' => ['code' => '+1441', 'country' => 'Bermuda'],
    'BT' => ['code' => '+975', 'country' => 'Bhutan'],
    'BO' => ['code' => '+591', 'country' => 'Bolivia'],
    'BA' => ['code' => '+387', 'country' => 'Bosnia Herzegovina'],
    'BW' => ['code' => '+267', 'country' => 'Botswana'],
    'BR' => ['code' => '+55', 'country' => 'Brazil'],
    'BN' => ['code' => '+673', 'country' => 'Brunei'],
    'BG' => ['code' => '+359', 'country' => 'Bulgaria'],
    'BF' => ['code' => '+226', 'country' => 'Burkina Faso'],
    'BI' => ['code' => '+257', 'country' => 'Burundi'],
    'KH' => ['code' => '+855', 'country' => 'Cambodia'],
    'CM' => ['code' => '+237', 'country' => 'Cameroon'],
    'CA' => ['code' => '+1', 'country' => 'Canada'],
    'CV' => ['code' => '+238', 'country' => 'Cabo Verde Islands'],
    'KY' => ['code' => '+1345', 'country' => 'Cayman Islands'],
    'CF' => ['code' => '+236', 'country' => 'Central African Republic'],
    'CL' => ['code' => '+56', 'country' => 'Chile'],
    'CN' => ['code' => '+86', 'country' => 'China'],
    'CC' => ['code' => '+61', 'country' => 'Cocos Islands'],
    'CO' => ['code' => '+57', 'country' => 'Colombia'],
    'CG' => ['code' => '+242', 'country' => 'Congo'],
    'CK' => ['code' => '+682', 'country' => 'Cook Islands'],
    'CR' => ['code' => '+506', 'country' => 'Costa Rica'],
    'HR' => ['code' => '+385', 'country' => 'Croatia'],
    'CU' => ['code' => '+53', 'country' => 'Cuba'],
    'CY' => ['code' => '+90392', 'country' => 'Cyprus North'],
    'CY' => ['code' => '+357', 'country' => 'Cyprus'],
    'CZ' => ['code' => '+42', 'country' => 'Czech Republic'],
    'DK' => ['code' => '+45', 'country' => 'Denmark'],
    'DJ' => ['code' => '+253', 'country' => 'Djibouti'],
    'DM' => ['code' => '+1-767', 'country' => 'Dominica'],
    'DO' => ['code' => '+1809', 'country' => 'Dominican Republic'],
    'EC' => ['code' => '+593', 'country' => 'Ecuador'],
    'EG' => ['code' => '+20', 'country' => 'Egypt'],
    'SV' => ['code' => '+503', 'country' => 'El Salvador'],
    'GQ' => ['code' => '+240', 'country' => 'Equatorial Guinea'],
    'ER' => ['code' => '+291', 'country' => 'Eritrea'],
    'EE' => ['code' => '+372', 'country' => 'Estonia'],
    'ET' => ['code' => '+251', 'country' => 'Ethiopia'],
    'FK' => ['code' => '+500', 'country' => 'Falkland Islands'],
    'FO' => ['code' => '+298', 'country' => 'Faroe Islands'],
    'FJ' => ['code' => '+679', 'country' => 'Fiji'],
    'FI' => ['code' => '+358', 'country' => 'Finland'],
    'FR' => ['code' => '+33', 'country' => 'France'],
    'GF' => ['code' => '+594', 'country' => 'French Guiana'],
    'PF' => ['code' => '+689', 'country' => 'French Polynesia'],
    'GA' => ['code' => '+241', 'country' => 'Gabon'],
    'GM' => ['code' => '+220', 'country' => 'Gambia'],
    'GE' => ['code' => '+995', 'country' => 'Georgia'],
    'DE' => ['code' => '+49', 'country' => 'Germany'],
    'GH' => ['code' => '+233', 'country' => 'Ghana'],
    'GI' => ['code' => '+350', 'country' => 'Gibraltar'],
    'GR' => ['code' => '+30', 'country' => 'Greece'],
    'GL' => ['code' => '+299', 'country' => 'Greenland'],
    'GD' => ['code' => '+1473', 'country' => 'Grenada'],
    'GP' => ['code' => '+590', 'country' => 'Guadeloupe'],
    'GU' => ['code' => '+671', 'country' => 'Guam'],
    'GT' => ['code' => '+502', 'country' => 'Guatemala'],
    'GN' => ['code' => '+224', 'country' => 'Guinea'],
    'GW' => ['code' => '+245', 'country' => 'Guinea - Bissau'],
    'GY' => ['code' => '+592', 'country' => 'Guyana'],
    'HT' => ['code' => '+509', 'country' => 'Haiti'],
    'HN' => ['code' => '+504', 'country' => 'Honduras'],
    'HK' => ['code' => '+852', 'country' => 'Hong Kong'],
    'HU' => ['code' => '+36', 'country' => 'Hungary'],
    'IS' => ['code' => '+354', 'country' => 'Iceland'],
    'IN' => ['code' => '+91', 'country' => 'India'],
    'ID' => ['code' => '+62', 'country' => 'Indonesia'],
    'IR' => ['code' => '+98', 'country' => 'Iran'],
    'IQ' => ['code' => '+964', 'country' => 'Iraq'],
    'IE' => ['code' => '+353', 'country' => 'Ireland'],
    'IL' => ['code' => '+972', 'country' => 'Israel'],
    'IT' => ['code' => '+39', 'country' => 'Italy'],
    'JM' => ['code' => '+1876', 'country' => 'Jamaica'],
    'JP' => ['code' => '+81', 'country' => 'Japan'],
    'JE' => ['code' => '+44-1534', 'country' => 'Jersey'],
    'JO' => ['code' => '+962', 'country' => 'Jordan'],
    'KZ' => ['code' => '+7', 'country' => 'Kazakhstan'],
    'KE' => ['code' => '+254', 'country' => 'Kenya'],
    'KI' => ['code' => '+686', 'country' => 'Kiribati'],
    'KW' => ['code' => '+965', 'country' => 'Kuwait'],
    'KG' => ['code' => '+996', 'country' => 'Kyrgyzstan'],
    'LA' => ['code' => '+856', 'country' => 'Laos'],
    'LV' => ['code' => '+371', 'country' => 'Latvia'],
    'LB' => ['code' => '+961', 'country' => 'Lebanon'],
    'LS' => ['code' => '+266', 'country' => 'Lesotho'],
    'LR' => ['code' => '+231', 'country' => 'Liberia'],
    'LY' => ['code' => '+218', 'country' => 'Libya'],
    'LI' => ['code' => '+417', 'country' => 'Liechtenstein'],
    'LT' => ['code' => '+370', 'country' => 'Lithuania'],
    'LU' => ['code' => '+352', 'country' => 'Luxembourg'],
    'MO' => ['code' => '+853', 'country' => 'Macao'],
    'MK' => ['code' => '+389', 'country' => 'Macedonia'],
    'MG' => ['code' => '+261', 'country' => 'Madagascar'],
    'MW' => ['code' => '+265', 'country' => 'Malawi'],
    'MY' => ['code' => '+60', 'country' => 'Malaysia'],
    'MV' => ['code' => '+960', 'country' => 'Maldives'],
    'ML' => ['code' => '+223', 'country' => 'Mali'],
    'MT' => ['code' => '+356', 'country' => 'Malta'],
    'MH' => ['code' => '+692', 'country' => 'Marshall Islands'],
    'MQ' => ['code' => '+596', 'country' => 'Martinique'],
    'MR' => ['code' => '+222', 'country' => 'Mauritania'],
    'MU' => ['code' => '+230', 'country' => 'Mauritius'],
    'YT' => ['code' => '+269', 'country' => 'Mayotte'],
    'MX' => ['code' => '+52', 'country' => 'Mexico'],
    'FM' => ['code' => '+691', 'country' => 'Micronesia'],
    'MD' => ['code' => '+373', 'country' => 'Moldova'],
    'MC' => ['code' => '+377', 'country' => 'Monaco'],
    'MN' => ['code' => '+976', 'country' => 'Mongolia'],
    'MS' => ['code' => '+1664', 'country' => 'Montserrat'],
    'MA' => ['code' => '+212', 'country' => 'Morocco'],
    'MZ' => ['code' => '+258', 'country' => 'Mozambique'],
    'MM' => ['code' => '+95', 'country' => 'Myanmar'],
    'NA' => ['code' => '+264', 'country' => 'Namibia'],
    'NR' => ['code' => '+674', 'country' => 'Nauru'],
    'NP' => ['code' => '+977', 'country' => 'Nepal'],
    'NC' => ['code' => '+687', 'country' => 'New Caledonia'],
    'NZ' => ['code' => '+64', 'country' => 'New Zealand'],
    'NI' => ['code' => '+505', 'country' => 'Nicaragua'],
    'NE' => ['code' => '+227', 'country' => 'Niger'],
    'NG' => ['code' => '+234', 'country' => 'Nigeria'],
    'NU' => ['code' => '+683', 'country' => 'Niue'],
    'NF' => ['code' => '+672', 'country' => 'Norfolk Islands'],
    'KP' => ['code' => '+850', 'country' => 'North Korea'],
    'MP' => ['code' => '+1-670', 'country' => 'Northern Mariana Islands'],
    'MP' => ['code' => '+670', 'country' => 'Northern Marianas'],
    'NO' => ['code' => '+47', 'country' => 'Norway'],
    'OM' => ['code' => '+968', 'country' => 'Oman'],
    'PK' => ['code' => '+92', 'country' => 'Pakistan'],
    'PW' => ['code' => '+680', 'country' => 'Palau'],
    'PS' => ['code' => '+970', 'country' => 'Palestine'],
    'PA' => ['code' => '+507', 'country' => 'Panama'],
    'PG' => ['code' => '+675', 'country' => 'Papua New Guinea'],
    'PY' => ['code' => '+595', 'country' => 'Paraguay'],
    'PE' => ['code' => '+51', 'country' => 'Peru'],
    'PH' => ['code' => '+63', 'country' => 'Philippines'],
    'PN' => ['code' => '+64', 'country' => 'Pitcairn Islands'],
    'PL' => ['code' => '+48', 'country' => 'Poland'],
    'PT' => ['code' => '+351', 'country' => 'Portugal'],
    'PR' => ['code' => '+1787', 'country' => 'Puerto Rico'],
    'QR' => ['code' => '+974', 'country' => 'Qatar'],
    'CD' => ['code' => '+242', 'country' => 'Republic of the Congo'],
    'RE' => ['code' => '+262', 'country' => 'Reunion'],
    'RO' => ['code' => '+40', 'country' => 'Romania'],
    'RU' => ['code' => '+7', 'country' => 'Russia'],
    'RW' => ['code' => '+250', 'country' => 'Rwanda'],
    'LC' => ['code' => '+1-758', 'country' => 'Saint Lucia'],
    'MF' => ['code' => '+590', 'country' => 'Saint Martin'],
    'PM' => ['code' => '+508', 'country' => 'Saint Pierre and Miquelon'],
    'WC' => ['code' => '+1-784', 'country' => 'Saint Vincent and the Grenadines'],
    'WS' => ['code' => '+685', 'country' => 'Samoa'],
    'SM' => ['code' => '+378', 'country' => 'San Marino'],
    'ST' => ['code' => '+239', 'country' => 'Sao Tome &amp; Principe'],
    'SA' => ['code' => '+966', 'country' => 'Saudi Arabia'],
    'SN' => ['code' => '+221', 'country' => 'Senegal'],
    'RS' => ['code' => '+381', 'country' => 'Serbia'],
    'SC' => ['code' => '+248', 'country' => 'Seychelles'],
    'SL' => ['code' => '+232', 'country' => 'Sierra Leone'],
    'SG' => ['code' => '+65', 'country' => 'Singapore'],
    'SX' => ['code' => '+1-721', 'country' => 'Sint Maarten'],
    'SK' => ['code' => '+421', 'country' => 'Slovak Republic'],
    'SL' => ['code' => '+386', 'country' => 'Slovenia'],
    'SB' => ['code' => '+677', 'country' => 'Solomon Islands'],
    'SO' => ['code' => '+252', 'country' => 'Somalia'],
    'ZA' => ['code' => '+27', 'country' => 'South Africa'],
    'KR' => ['code' => '+82', 'country' => 'South Korea'],
    'SS' => ['code' => '+211', 'country' => 'South Sudan'],
    'ES' => ['code' => '+34', 'country' => 'Spain'],
    'LK' => ['code' => '+94', 'country' => 'Sri Lanka'],
    'SH' => ['code' => '+290', 'country' => 'St. Helena'],
    'KN' => ['code' => '+1869', 'country' => 'St. Kitts'],
    'LC' => ['code' => '+1758', 'country' => 'St. Lucia'],
    'SD' => ['code' => '+249', 'country' => 'Sudan'],
    'SR' => ['code' => '+597', 'country' => 'Suriname'],
    'SG' => ['code' => '+47', 'country' => 'Svalbard and Jan Mayen'],
    'SZ' => ['code' => '+268', 'country' => 'Swaziland'],
    'SE' => ['code' => '+46', 'country' => 'Sweden'],
    'CH' => ['code' => '+41', 'country' => 'Switzerland'],
    'SY' => ['code' => '+963', 'country' => 'Syria'],
    'TW' => ['code' => '+886', 'country' => 'Taiwan'],
    'TJ' => ['code' => '+992', 'country' => 'Tajikistan '],
    'TZ' => ['code' => '+255', 'country' => 'Tanzania'],
    'TH' => ['code' => '+66', 'country' => 'Thailand'],
    'TG' => ['code' => '+228', 'country' => 'Togo'],
    'TK' => ['code' => '+690', 'country' => 'Tokelau'],
    'TO' => ['code' => '+676', 'country' => 'Tonga'],
    'TT' => ['code' => '+1868', 'country' => 'Trinidad &amp; Tobago'],
    'TN' => ['code' => '+216', 'country' => 'Tunisia'],
    'TR' => ['code' => '+90', 'country' => 'Turkey'],
    'TM' => ['code' => '+993', 'country' => 'Turkmenistan'],
    'TC' => ['code' => '+1649', 'country' => 'Turks &amp; Caicos Islands'],
    'TV' => ['code' => '+688', 'country' => 'Tuvalu'],
    'UG' => ['code' => '+256', 'country' => 'Uganda'],
    'UA' => ['code' => '+380', 'country' => 'Ukraine'],
    'AE' => ['code' => '+971', 'country' => 'United Arab Emirates'],
    'US' => ['code' => '+1', 'country' => 'United States'],
    'UY' => ['code' => '+598', 'country' => 'Uruguay'],
    'UZ' => ['code' => '+998', 'country' => 'Uzbekistan'],
    'VU' => ['code' => '+678', 'country' => 'Vanuatu'],
    'VA' => ['code' => '+379', 'country' => 'Vatican City'],
    'VE' => ['code' => '+58', 'country' => 'Venezuela'],
    'VN' => ['code' => '+84', 'country' => 'Vietnam'],
    'VI' => ['code' => '+1340', 'country' => 'Virgin Islands - US'],
    'WF' => ['code' => '+681', 'country' => 'Wallis &amp; Futuna'],
    'EH' => ['code' => '+212', 'country' => 'Western Sahara'],
    'YE' => ['code' => '+969', 'country' => 'Yemen (North)'],
    'YE' => ['code' => '+967', 'country' => 'Yemen (South)'],
    'ZM' => ['code' => '+260', 'country' => 'Zambia'],
    'ZW' => ['code' => '+263', 'country' => 'Zimbabwe']
];

$country_select = '<div class="country__select select">
<div class="selected__item center__flex flex" data-input="country">
    <p class="selected__item__val">' . (($country_iso != '' && array_key_exists($country_iso, $countries)) ? $countries[$country_iso]['code'] : '+971') . '</p>
</div>

<div class="options"><div class="smooth__scroll">';

foreach($countries as $country) {
    $country_select .= '<p data-code="' . $country['code'] . '" data-country="' . $country['country'] . '">' . $country['country'] . ' ' .  $country['code'] . '</p>';
}
    
$country_select .= '</div></div></div><input type="hidden" name="country" value="' . (($country_iso != '' && array_key_exists($country_iso, $countries)) ? $countries[$country_iso]['country'] : 'United Arab Emirates') . '">';

$currency_select = '<span class="currency__select select">
    <span class="selected__item">
        <p class="selected__item__val">€</p>
    </span>

    <span class="options">
        <p class="active" data-currency-exchange-rate="1">€</p>
        <p data-currency-exchange-rate="1.004">$</p>
        <p data-currency-exchange-rate="61.03">₽</p>
        <p data-currency-exchange-rate="3.689">AED</p>
    </span>
</span>'; ?>
<!DOCTYPE html>
<html lang="<?php $lang; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo $title; ?></title>

    <meta name="description" content="<?php echo $title; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#9fce30">
    <meta name="msapplication-TileColor" content="#9fce30">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" type="text/css" href="/css/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="/style.css">

</head>
<body>
<div class="overflow">

<header class="header wrap flex pos__fixed">
    <ul class="header__links header__links__left flex">
        <?php if($lang == 'ru') { ?>
            <li><a href="/ru/#districts">Популярные районы</a></li>
            <li><a href="/ru/#profitability">Доходность</a></li>
            <li><a href="/ru/#costs">Стоимость</a></li>
        <?php } else { ?>
            <li><a href="#districts">Popular districts</a></li>
            <li><a href="#profitability">Profitability</a></li>
            <li><a href="#costs">Costs</a></li>
        <?php } ?>
    </ul>

    <a class="header__logo scroll__up"><img src="/img/logo-min.png" srcset="/img/logo-2x-min.png 2x" width="213" height="76" alt="<?php echo $title; ?>"></a>

    <div class="header__right flex">
        <ul class="header__links header__links__right flex">
            <?php if($lang == 'ru') { ?>
                <li><a href="/ru/#about-us">О компании</a></li>
                <li><a href="/ru/#contacts">Контакты</a></li>
            <?php } else { ?>
                <li><a href="#about-us">About us</a></li>
                <li><a href="#contacts">Contacts</a></li>
            <?php } ?>
        </ul>

        <div class="header__right__mob flex">
            <a href="<?php echo ($lang == 'ru' ? '/' : '/ru/'); ?>" class="lang"><?php echo ($lang == 'ru' ? 'En' : 'Ru'); ?></a>

            <a href="https://api.whatsapp.com/send?phone=+971503770780&text=Hello%2C%20I%20am%20intrested%20to%20Buy%20Property%20in%20Dubai" class="whatsapp" target="_blank" rel="nofollow" title="WhatsApp"><img src="/img/whatsapp-min.png" srcset="/img/whatsapp-2x-min.png 2x" width="24" height="24" alt="WhatsApp"></a>
        </div>

        <div class="menu__toggle"></div>
    </div>
</header>

<nav class="nav">
    <div class="menu__wrap flex">
        <div class="menu__header flex">
            <a class="menu__header__logo scroll__up"><img src="/img/logo-min.png" srcset="/img/logo-2x-min.png 2x" width="272" height="97" alt="<?php echo $title; ?>"></a>

            <div class="close__menu"></div>
        </div>

        <div class="smooth__scroll">
            <ul class="menu">
                <?php if($lang == 'ru') { ?>
                    <li><a href="/ru/#about-us">О компании</a></li>
                    <li><a href="/ru/#districts">Районы для покупки недвижимости</a></li>
                    <li><a href="/ru/#popular-projects">Популярные проекты</a></li>
                    <li><a href="/ru/#residence">Получи ВНЖ при покупке жилья</a></li>
                    <li><a href="/ru/#profitability">Рост цен</a></li>
                    <li><a href="/ru/#costs">Дом своей мечты</a></li>
                    <li><a href="/ru/#test">Пройди тест и выбери недвижимость!</a></li>
                    <li><a href="/ru/#form">Подборка подходящих вариантов</a></li>
                    <li><a href="/ru/#articles">Статьи</a></li>
                    <li><a href="/ru/#faq">Вопрос-ответ</a></li>
                    <li><a href="/ru/#contacts">Контакты</a></li>
                <?php } else { ?>
                    <li><a href="#about-us">About company</a></li>
                    <li><a href="#districts">Areas to buy real estate</a></li>
                    <li><a href="#popular-projects">Featured projects</a></li>
                    <li><a href="#residence">Get a residence permit when buying a home</a></li>
                    <li><a href="#profitability">Price rise</a></li>
                    <li><a href="#costs">House of your dreams</a></li>
                    <li><a href="#test">Take the test and choose a property!</a></li>
                    <li><a href="#form">A selection of suitable options</a></li>
                    <li><a href="#articles">Articles</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contacts">Contacts</a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="menu__footer flex">
            <div class="menu__lang flex">
                <?php if($lang == 'ru') { ?>
                    <p>Ru</p>
                    <div class="separator"></div>
                    <a href="/en">En</a>
                <?php } else { ?>
                    <a href="/">Ru</a>
                    <div class="separator"></div>
                    <p>En</p>
                <?php } ?>
            </div>

            <a href="https://api.whatsapp.com/send?phone=+971503770780&text=Good%20Day,%20%20I%20am%20intrested%20to%20Buy%20Property%20in%20Dubai" class="menu__whatsapp" target="_blank" rel="nofollow" title="WhatsApp"><img src="/img/whatsapp-min.png" srcset="/img/whatsapp-2x-min.png 2x" width="45" height="45" alt="WhatsApp"></a>
        </div>
    </div>
</nav>

<main class="main" id="home">
    <section class="main__block wrap">
        <h1 class="main__title"><?php echo $title; ?></h1>

        <ul class="advantages flex">
            <li><?php echo ($lang == 'ru' ? 'Не облагаемая налогом <br>недвижимость в&nbsp;собственности' : 'Tax-free Freehold properties'); ?></li>
            <li><?php echo ($lang == 'ru' ? 'Безопасный <br>и&nbsp;стабильный город' : 'Safe & Stable City'); ?></li>
            <li><?php echo ($lang == 'ru' ? 'Инфраструктура <br>мирового класса' : 'World Class Infrastructures '); ?></li>
            <li><?php echo ($lang == 'ru' ? 'Резидентские <br>визы' : 'Residency Visas'); ?></li>
        </ul>

        <a class="main__block__btn btn open__popup" data-popup="contact-form-popup"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'GET A CATALOG'); ?></a>

        <div class="main__block__img img">
            <img src="/img/main-block-img-min.jpg" srcset="/img/main-block-img-2x-min.jpg 2x" width="1600" height="800" alt="<?php echo $title; ?>">
        </div>
    </section>

    <section class="about__us wrap flex" id="about-us">
        <div class="about__us__content">
            <p class="about__us__subtitle"><?php echo ($lang == 'ru' ? 'О компании' : 'About us'); ?></p>

            <h2 class="about__us__title title"><?php echo ($lang == 'ru' ? '<span class="green">Одна из&nbsp;лучших компаний по&nbsp;недвижимости в&nbsp;Дубае</span> которая&nbsp;предоставляет решения и&nbsp;услуги путем принятия различных творческих идей и&nbsp;инновационных стратегий для&nbsp;рынка недвижимости ОАЭ и&nbsp;во&nbsp;всем&nbsp;мире' : '<span class="green">One of the top Dubai real estate companies</span> that&nbsp;provides solutions and&nbsp;services through&nbsp;adopting creative different ideas and&nbsp;innovative strategies for&nbsp;UAE\'s real estate market and&nbsp;all&nbsp;over&nbsp;the&nbsp;world'); ?></h2>

            <div class="about__us__wrap flex">
                <div class="about__us__text">
                    <div class="content">
                        <?php if($lang == 'ru') { ?>
                            <p>За нашу полную веру в&nbsp;способность нашей высококвалифицированной команды достичь быстрый рост инвестиций со&nbsp;стороны наших партнеров, потребности которых являются для&nbsp;нас главным приоритетом. Мы в&nbsp;Mada Properties считаем, что&nbsp;удовлетворенность клиентов это причина, по&nbsp;которой мы сосредоточены на&nbsp;поиске решений и&nbsp;услуг в&nbsp;сфере недвижимости и&nbsp;использовании современных маркетинговых технологий, которые&nbsp;гарантируют успех наших клиентов.</p>

                            <p>С&nbsp;самого начала наши стратегические планы включали формирование прочного партнерства, предоставление всего&nbsp;нашего опыта и&nbsp;знаний, чтобы&nbsp;помочь нашим партнерам расти, чтобы&nbsp;их проекты стали заметным брендом в&nbsp;сфере недвижимости за&nbsp;счет предоставления всех возможностей современных маркетинговых исследований. Исследования и&nbsp;методы, а&nbsp;также инновационные методы продаж, которые обеспечивают показ своих проектов в&nbsp;нужном виде и&nbsp;получение высокой прибыли.</p>
                        <?php } else { ?>
                            <p>At Mada Properties, we are&nbsp;always gearing to&nbsp;be&nbsp;the&nbsp;trusted guide for&nbsp;our partners all&nbsp;over the&nbsp;world; thus we&nbsp;were so&nbsp;careful to&nbsp;build a&nbsp;highly experienced team to&nbsp;offer all&nbsp;real estate services and&nbsp;advice standards of&nbsp;professionalism that&nbsp;guarantee the&nbsp;highest return of&nbsp;investment.</p>

                            <p>From the&nbsp;beginning, our strategy contained formation of&nbsp;a&nbsp;strong partnership with&nbsp;our clients to&nbsp;assist them reach the&nbsp;required growth through the&nbsp;provision, all&nbsp;capabilities, solutions, researches, creative sales methods and&nbsp;modern marketing studies to&nbsp;make successful investment come true.</p>
                        <?php } ?>
                    </div>
                    
                    <a class="about__us__btn btn open__popup" data-popup="contact-form-popup"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'GET A CATALOG'); ?></a>
                </div>
            </div>
        </div>

        <div class="about__us__img">
            <img src="/img/big-logo-min.png" srcset="/img/big-logo-2x-min.png 2x" width="326" height="606" alt="<?php echo ($lang == 'ru' ? 'О компании' : 'About us'); ?>">
        </div>
    </section>

    <section class="districts wrap flex" id="districts">
        <div class="districts__bg bg img">
            <img src="/img/districts-bg-min.png" srcset="/img/districts-bg-2x-min.png 2x" width="1920" height="1000" alt="<?php echo ($lang == 'ru' ? 'В каких районах покупать недвижимость в Дубае?' : 'In what areas to buy property in Dubai?'); ?>">
        </div>

        <div class="districts__content">
            <h2 class="districts__title title"><?php echo ($lang == 'ru' ? 'В каких районах покупать недвижимость в&nbsp;Дубае?' : 'In what areas to&nbsp;buy property in&nbsp;Dubai?'); ?></h2>

            <div class="district__titles__slider">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <h3 class="district__slide__title"><a><?php echo ($lang == 'ru' ? 'Дубай Марина' : 'Dubai Marina'); ?></a></h3>
                        </div>

                        <div class="swiper-slide">
                            <h3 class="district__slide__title"><a><?php echo ($lang == 'ru' ? 'Бизнес Бэй' : 'Business Bay'); ?></a></h3>
                        </div>

                        <div class="swiper-slide">
                            <h3 class="district__slide__title"><a><?php echo ($lang == 'ru' ? 'Пальма Джумейра' : 'Palm Jumeirah'); ?></a></h3>
                        </div>

                        <div class="swiper-slide">
                            <h3 class="district__slide__title"><a><?php echo ($lang == 'ru' ? 'Дубай Крик Харбор' : 'Dubai Creek Harbor'); ?></a></h3>
                        </div>
                    </div>
                </div>

                <div class="swiper__nav">
                    <a class="swiper__prev"></a>
                    
                    <a class="swiper__next"></a>
                </div>

                <div class="district__titles__pagination swiper-pagination"></div>
            </div>

            <div class="district__contents__slider">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="district__content__text content">
                                <?php if($lang == 'ru') { ?>
                                    <p><strong>Дубай Марина</strong> – крупный фрихолд-район и&nbsp;одно из&nbsp;самых популярных мест для&nbsp;жизни в&nbsp;Дубае. Развитая инфраструктура с&nbsp;доступными чистейшими пляжами и&nbsp;ключевыми городскими точками, чарующие виды и&nbsp;лучшие объекты недвижимости – все это притягивает внимание туристови бизнесменов со&nbsp;всего мира.</p>

                                    <p>Покупка жилья в&nbsp;Дубай Марина станет оптимальным вариантом как&nbsp;для&nbsp;отдыхающих туристов, так&nbsp;и&nbsp;для&nbsp;тех, кто&nbsp;ищет недвижимость на&nbsp;постоянное место жительства. Здесь представлен широкий ассортимент квартир: от&nbsp;скромных «однушек» до&nbsp;роскошных пентхаусов с&nbsp;панорамными окнами, функциональными планировками и&nbsp;современным дизайном. Помимо квартир в&nbsp;новостройках, есть также&nbsp;виллы и&nbsp; таунхаусы.</p>
                                <?php } else { ?>
                                    <p><strong>Dubai Marina</strong> is a large freehold area and&nbsp;one of&nbsp;the&nbsp;most popular residential areas in&nbsp;Dubai. Well-developed infrastructure with&nbsp;accessible clean beaches and&nbsp;key locations, charming views and&nbsp;the&nbsp;best real estate - all&nbsp;this attracts the&nbsp;attention of&nbsp;tourists and&nbsp;businessmen from&nbsp;all&nbsp;over&nbsp;the&nbsp;world.</p>

                                    <p>Purchasing real estate in&nbsp;Dubai Marina is&nbsp;the&nbsp;best option for&nbsp;tourists as&nbsp;well&nbsp;as&nbsp;for&nbsp;those searching for&nbsp;a&nbsp;permanent place of&nbsp;residence. The&nbsp;extensive range of&nbsp;apartments is&nbsp;presented here - from&nbsp;humble studios to&nbsp;luxurious penthouses with&nbsp;panoramic windows, functional layouts and&nbsp;modern design. In&nbsp;addition to&nbsp;apartments in&nbsp;new buildings there&nbsp;are&nbsp;villas, duplexes and&nbsp;semi-detached houses.</p>
                                <?php } ?>
                            </div>

                            <div class="district__advantages flex">
                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-1-min.png" srcset="/img/district-advantage-1-2x-min.png 2x" width="52" height="60" alt="<?php echo ($lang == 'ru' ? '200 м до метро' : '200 m to the subway'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">200 <?php echo ($lang == 'ru' ? 'м<span>до метро' : 'm<span>To the subway'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-2-min.png" srcset="/img/district-advantage-2-2x-min.png 2x" width="56" height="60" alt="<?php echo ($lang == 'ru' ? '2.1 км до парка' : '2.1 km to the park'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">2.1 <?php echo ($lang == 'ru' ? 'км<span>до парка' : 'km<span>To the park'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-3-min.png" srcset="/img/district-advantage-3-2x-min.png 2x" width="51" height="60" alt="<?php echo ($lang == 'ru' ? '300 м до ТЦ' : '300 m To the mall'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">300 <?php echo ($lang == 'ru' ? 'м<span>до ТЦ' : 'm<span>To the mall'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-4-min.png" srcset="/img/district-advantage-4-2x-min.png 2x" width="65" height="60" alt="<?php echo ($lang == 'ru' ? '400 м до пляжа' : '400 m to the beach'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">400 <?php echo ($lang == 'ru' ? 'м<span>до пляжа' : 'm<span>To the beach'); ?></span></h3>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="district__content__text content">
                                <?php if($lang == 'ru') { ?>
                                    <p><strong>Business Bay</strong> - это постоянно развивающийся район, спроектированный по образцу Нью-Йоркского Манхэттена и Токийского Гиндза. Занимает площадь 6 кв. км и, согласно плану, будет включать более 240 жилых, коммерческих и многофункциональных башен. Район находится в нескольких минутах езды от квартала Dubai Design District, Международного финансового центра DIFC и Всемирного центра DWTC. Вся территория Business Bay расположена на побережье бухты Дубая и на прилегающем 2,8-километровом канале, где расположены девять новых судоходных станций для паромного сообщения.</p>
                                <?php } else { ?>
                                    <p><strong>Business Bay</strong> is an ever-evolving neighborhood modeled after New York Manhattan and Tokyo Ginza. Occupies an area of 6 sq. km and, according to the plan, will include more than 240 residential, commercial and multifunctional towers. The area is within driving distance of the Dubai Design District, the DIFC International Financial Center and the DWTC World Centre. The entire Business Bay area is located on the coast of Dubai Creek and on the adjacent 2.8 km channel, where nine new shipping stations for ferry traffic are located.</p>
                                <?php } ?>
                            </div>

                            <div class="district__advantages flex">
                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-1-min.png" srcset="/img/district-advantage-1-2x-min.png 2x" width="52" height="60" alt="<?php echo ($lang == 'ru' ? '800 м до метро' : '800 m to the subway'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">800 <?php echo ($lang == 'ru' ? 'м<span>до метро' : 'm<span>To the subway'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-2-min.png" srcset="/img/district-advantage-2-2x-min.png 2x" width="56" height="60" alt="<?php echo ($lang == 'ru' ? '2.5 км до парка' : '2.5 km to the park'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">2.5 <?php echo ($lang == 'ru' ? 'км<span>до парка' : 'km<span>To the park'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-3-min.png" srcset="/img/district-advantage-3-2x-min.png 2x" width="51" height="60" alt="<?php echo ($lang == 'ru' ? '1.2 км до ТЦ' : '1.2 km to the mall'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">1.2 <?php echo ($lang == 'ru' ? 'км<span>до ТЦ' : 'km<span>to the mall'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-4-min.png" srcset="/img/district-advantage-4-2x-min.png 2x" width="65" height="60" alt="<?php echo ($lang == 'ru' ? '5.8 км до пляжа' : '5.8 km to the beach'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">5.8 <?php echo ($lang == 'ru' ? 'км<span>до пляжа' : 'km<span>To the beach'); ?></span></h3>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="district__content__text content">
                                <?php if($lang == 'ru') { ?>
                                    <p><strong>Пальма Джумейра</strong> — рукотворный остров, расположенный в Объединенных Арабских Эмиратах. Настоящее чудо света, созданное гениальным человеческим разумом с использованием уникальных технологий. На его территории находятся роскошные отели, виллы, развлекательные и торговые центры, великолепные песчаные пляжи.</p>
                                    
                                    <p>Очертания острова напоминают дерево пальмы. Благодаря такому силуэту значительно увеличена полезная площадь насыпи. От ствола отходят 16 «веток», создавая суммарную протяженность береговой линии в 56 км. По всей окружности остров защищен волнорезом в форме полумесяца. Здесь же есть коралловый риф с двумя затонувшими самолетами, который привлекает на побережье любителей дайвинга.</p>
                                <?php } else { ?>
                                    <p><strong>Palm Jumeirah</strong> is a man-made island located in the United Arab Emirates. A real wonder of the world, created by the ingenious human mind using unique technologies. On its territory there are luxury hotels, villas, entertainment and shopping centers, magnificent sandy beaches.</p>

                                    <p>The outlines of the island resemble a palm tree. Thanks to this silhouette, the usable area of the embankment is significantly increased. 16 "branches" depart from the trunk, creating a total length of the coastline of 56 km. The entire circumference of the island is protected by a crescent-shaped breakwater. There is also a coral reef with two sunken planes, which attracts diving enthusiasts to the coast.</p>
                                <?php } ?>
                            </div>

                            <div class="district__advantages flex">
                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-1-min.png" srcset="/img/district-advantage-1-2x-min.png 2x" width="52" height="60" alt="<?php echo ($lang == 'ru' ? '2.8 км до метро' : '2.8 km to the subway'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">2.8 <?php echo ($lang == 'ru' ? 'км<span>до метро' : 'km<span>To the subway'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-2-min.png" srcset="/img/district-advantage-2-2x-min.png 2x" width="56" height="60" alt="<?php echo ($lang == 'ru' ? '1.6 км до парка' : '1.6 km to the park'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">1.6 <?php echo ($lang == 'ru' ? 'км<span>до парка' : 'km<span>To the park'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-3-min.png" srcset="/img/district-advantage-3-2x-min.png 2x" width="51" height="60" alt="<?php echo ($lang == 'ru' ? '200 м до ТЦ' : '200 m to the mall'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">200 <?php echo ($lang == 'ru' ? 'м<span>до ТЦ' : 'm<span>to the mall'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-4-min.png" srcset="/img/district-advantage-4-2x-min.png 2x" width="65" height="60" alt="<?php echo ($lang == 'ru' ? '100 м до пляжа' : '100 m to the beach'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">100 <?php echo ($lang == 'ru' ? 'м<span>до пляжа' : 'm<span>To the beach'); ?></span></h3>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="district__content__text content">
                                <?php if($lang == 'ru') { ?>
                                    <p><strong>Dubai Creek Harbour</strong> ― это новый район жилой и коммерческой застройки, расположенный в 10 минутах езды от центра Дубая.</p>

                                    <p>Площадь проекта составляет 6 квадратных километров, что в два раза превышает площадь района Downtown Dubai. В Dubai Creek Harbour расположена живописная набережная, многочисленные рестораны с террасами и элегантный отель Vida Creek Harbour. В скором времени здесь также запланировано открытие ряда других объектов.</p>

                                    <p>Застройщики проекта объявили о начале строительстве суперсовременного торгового комплекса Dubai Square. Общая площадь комплекса, включая торговый центр, отель и апартаменты, составит 2,6 миллиона квадратных метров. На его территории также построят китайский квартал Chinatown.</p>
                                <?php } else { ?>
                                    <p><strong>Dubai Creek Harbor</strong> is a new residential and commercial development located 10 minutes drive from downtown Dubai.</p>
                                    
                                    <p>The project covers an area of 6 square kilometers, which is twice the area of Downtown Dubai. Dubai Creek Harbor features a picturesque waterfront, numerous terraced restaurants and the elegant Vida Creek Harbor Hotel. A number of other facilities are also scheduled to open soon.</p>
                                    
                                    <p>The developers of the project announced the start of construction of the ultra-modern Dubai Square shopping complex. The total area of the complex, including the shopping center, hotel and apartments, will be 2.6 million square meters. Chinatown will also be built on its territory.</p>
                                <?php } ?>
                            </div>

                            <div class="district__advantages flex">
                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-1-min.png" srcset="/img/district-advantage-1-2x-min.png 2x" width="52" height="60" alt="<?php echo ($lang == 'ru' ? '5.9 км до метро' : '5.9 km to the subway'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">5.9 <?php echo ($lang == 'ru' ? 'км<span>до метро' : 'km<span>To the subway'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-2-min.png" srcset="/img/district-advantage-2-2x-min.png 2x" width="56" height="60" alt="<?php echo ($lang == 'ru' ? '1.2 км до парка' : '1.2 km to the park'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">1.2 <?php echo ($lang == 'ru' ? 'км<span>до парка' : 'km<span>To the park'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-3-min.png" srcset="/img/district-advantage-3-2x-min.png 2x" width="51" height="60" alt="<?php echo ($lang == 'ru' ? '2.8 км до ТЦ' : '2.8 km to the mall'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">2.8 <?php echo ($lang == 'ru' ? 'км<span>до ТЦ' : 'km<span>to the mall'); ?></span></h3>
                                </div>

                                <div class="district__advantage flex">
                                    <div class="district__advantage__img center__flex flex">
                                        <img src="/img/district-advantage-4-min.png" srcset="/img/district-advantage-4-2x-min.png 2x" width="65" height="60" alt="<?php echo ($lang == 'ru' ? '16.5 км до пляжа' : '16.5 km to the beach'); ?>">
                                    </div>

                                    <h3 class="district__advantage__title">16.5 <?php echo ($lang == 'ru' ? 'км<span>до пляжа' : 'km<span>To the beach'); ?></span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a class="districts__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Дубай Марина' : 'Dubai Marina'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'GET A CATALOG'); ?></a>
        </div>

        <div class="district__imgs__slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="district__img__slide img">
                            <img src="/img/Dubai-Marina.jpg" alt="<?php echo ($lang == 'ru' ? 'Дубай Марина' : 'Dubai Marina'); ?>">
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="district__img__slide img">
                            <img src="/img/Business-Bay.jpg" alt="<?php echo ($lang == 'ru' ? 'Бизнес Бэй' : 'Business Bay'); ?>">
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="district__img__slide img">
                            <img src="/img/Palm-Jumeirah.jpg" alt="<?php echo ($lang == 'ru' ? 'Пальма Джумейра' : 'Palm Jumeirah'); ?>">
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="district__img__slide img">
                            <img src="/img/Dubai-Creek-Harbour.jpg" alt="<?php echo ($lang == 'ru' ? 'Дубай Крик Харбор' : 'Dubai Creek Harbor'); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="popular__projects wrap" id="popular-projects">
        <div class="popular__projects__img bg center__flex flex">
            <img src="/img/grey-logo-min.png" srcset="/img/grey-logo-2x-min.png 2x" width="315" height="587" alt="<?php echo ($lang == 'ru' ? 'Популярные проекты в Дубае' : 'Featured Projects in Dubai'); ?>">
        </div>

        <h2 class="pupular__projects__title title"><?php echo ($lang == 'ru' ? 'Популярные проекты в&nbsp;Дубае' : 'Featured Projects in&nbsp;Dubai'); ?></h2>

        <div class="popular__projects__header flex">
            <div class="popular__projects__tabs flex">
                <a class="popular__projects__tab active" data-popular-project-group="0"><?php echo ($lang == 'ru' ? 'Апартаменты' : 'Apartments'); ?></a>
                <a class="popular__projects__tab" data-popular-project-group="1"><?php echo ($lang == 'ru' ? 'Виллы' : 'Villas'); ?></a>
            </div>

            <div class="popular__projects__nav swiper__nav flex">
                <a class="swiper__prev"></a>
                
                <a class="swiper__next"></a>
            </div>
        </div>

        <div class="popular__projects__slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-popular-project-group="0">
                        <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-0">
                            <span class="popular__project__img img">
                                <p class="popular__project__id"></p>

                                <img src="/img/Binghatti-Luna_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Апартаменты в Бингхатти Луна' : 'Apartments in Binghatti Luna'); ?>">
                            </span>

                            <span class="popular__project__cost__wrap flex">
                                <p class="popular__project__cost" data-cost="165500">165,500</p>

                                <?php echo $currency_select; ?>
                            </span>

                            <span class="popular__project__content flex">
                                <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Апартаменты в&nbsp;Бингхатти&nbsp;Луна' : 'Apartments in&nbsp;Binghatti&nbsp;Luna'); ?></h3>

                                <span class="popular__project__description">
                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Джумейра Вилладж Серкл' : 'JVC'); ?></p>
                                    </span>

                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Бингхатти' : 'Binghatti'); ?></p>
                                    </span>
                                </span>

                                <span class="popular__project__footer">
                                    <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                                    <p class="popular__project__val">64<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div class="swiper-slide" data-popular-project-group="0">
                        <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-1">
                            <span class="popular__project__img img">
                                <p class="popular__project__id"></p>

                                <img src="/img/Binghatti-Canal_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Апартаменты в Бизнес Бэй' : 'Apartments in Business Bay'); ?>">
                            </span>

                            <span class="popular__project__cost__wrap flex">
                                <p class="popular__project__cost" data-cost="512500">512,500</p>

                                <?php echo $currency_select; ?>
                            </span>

                            <span class="popular__project__content flex">
                                <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Апартаменты в&nbsp;Бизнес&nbsp;Бэй' : 'Apartments in&nbsp;Business&nbsp;Bay'); ?></h3>

                                <span class="popular__project__description">
                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Бизнес Бэй' : 'Business Bay'); ?></p>
                                    </span>

                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Бингхатти' : 'Binghatti'); ?></p>
                                    </span>
                                </span>

                                <span class="popular__project__footer">
                                    <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                                    <p class="popular__project__val">136<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div class="swiper-slide" data-popular-project-group="0">
                        <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-2">
                            <span class="popular__project__img img">
                                <p class="popular__project__id"></p>

                                <img src="/img/Palm-Beach-Towers_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Апартаменты в Башне Палм Бич' : 'Apartments in Palm Beach Tower'); ?>">
                            </span>

                            <span class="popular__project__cost__wrap flex">
                                <p class="popular__project__cost" data-cost="950000">950,000</p>

                                <?php echo $currency_select; ?>
                            </span>

                            <span class="popular__project__content flex">
                                <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Апартаменты в&nbsp;Башне Палм&nbsp;Бич' : 'Apartments in&nbsp;Palm&nbsp;Beach&nbsp;Tower'); ?></h3>

                                <span class="popular__project__description">
                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Пальма Джумейра' : 'Palm Jumeirah'); ?></p>
                                    </span>

                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Нахил' : 'Nakheel'); ?></p>
                                    </span>
                                </span>

                                <span class="popular__project__footer">
                                    <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                                    <p class="popular__project__val">146<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div class="swiper-slide" data-popular-project-group="0">
                        <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-3">
                            <span class="popular__project__img img">
                                <p class="popular__project__id"></p>

                                <img src="/img/Harbour-Gate_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Апартаменты в Портовых Воротах' : 'Apartments in Harbour Gate'); ?>">
                            </span>

                            <span class="popular__project__cost__wrap flex">
                                <p class="popular__project__cost" data-cost="868000">868,000</p>

                                <?php echo $currency_select; ?>
                            </span>

                            <span class="popular__project__content flex">
                                <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Апартаменты в&nbsp;Портовых&nbsp;Воротах' : 'Apartments in&nbsp;Harbour&nbsp;Gate'); ?></h3>

                                <span class="popular__project__description">
                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Дубай Крик Харбор' : 'Dubai Creek Harbour'); ?></p>
                                    </span>

                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Эмаар' : 'Emaar'); ?></p>
                                    </span>
                                </span>

                                <span class="popular__project__footer">
                                    <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                                    <p class="popular__project__val">160<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div class="swiper-slide" data-popular-project-group="0">
                        <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-4">
                            <span class="popular__project__img img">
                                <p class="popular__project__id"></p>

                                <img src="/img/Jumeirah-Living_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Апартаменты в Jumeirah Living' : 'Apartments in Jumeirah Living'); ?>">
                            </span>

                            <span class="popular__project__cost__wrap flex">
                                <p class="popular__project__cost" data-cost="2030000">2,030,000</p>

                                <?php echo $currency_select; ?>
                            </span>

                            <span class="popular__project__content flex">
                                <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Апартаменты в&nbsp;Jumeirah&nbsp;Living' : 'Apartments in&nbsp;Jumeirah&nbsp;Living'); ?></h3>

                                <span class="popular__project__description">
                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Бизнес Бэй' : 'Business Bay'); ?></p>
                                    </span>

                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                        <p class="popular__project__val">Select Group</p>
                                    </span>
                                </span>

                                <span class="popular__project__footer">
                                    <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                                    <p class="popular__project__val">206<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div class="swiper-slide" data-popular-project-group="0">
                        <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-5">
                            <span class="popular__project__img img">
                                <p class="popular__project__id"></p>

                                <img src="/img/Crest-Grande_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Апартаменты в Крест Гранде' : 'Apartments in Crest Grande'); ?>">
                            </span>

                            <span class="popular__project__cost__wrap flex">
                                <p class="popular__project__cost" data-cost="447420">447,420</p>

                                <?php echo $currency_select; ?>
                            </span>

                            <span class="popular__project__content flex">
                                <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Апартаменты в&nbsp;Крест&nbsp;Гранде' : 'Apartments in&nbsp;Crest&nbsp;Grande'); ?></h3>

                                <span class="popular__project__description">
                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Собха Хартленд' : 'Sobha Hartland'); ?></p>
                                    </span>

                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Собха' : 'Sobha'); ?></p>
                                    </span>
                                </span>

                                <span class="popular__project__footer">
                                    <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                                    <p class="popular__project__val">88.2<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div class="swiper-slide" data-popular-project-group="0">
                        <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-6">
                            <span class="popular__project__img img">
                                <p class="popular__project__id"></p>

                                <img src="/img/Oakley-Square_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Апартаменты в Окли' : 'Apartments in Oakley'); ?>">
                            </span>

                            <span class="popular__project__cost__wrap flex">
                                <p class="popular__project__cost" data-cost="246300">246,300</p>

                                <?php echo $currency_select; ?>
                            </span>

                            <span class="popular__project__content flex">
                                <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Апартаменты в&nbsp;Окли' : 'Apartments in&nbsp;Oakley'); ?></h3>

                                <span class="popular__project__description">
                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Джумейра Вилладж Серкл' : 'JVC'); ?></p>
                                    </span>

                                    <span class="popular__project__description__item flex">
                                        <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                        <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Эллингтон' : 'Ellington'); ?></p>
                                    </span>
                                </span>

                                <span class="popular__project__footer">
                                    <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                                    <p class="popular__project__val">78<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden__popular__project__slides">
            <div class="swiper-slide" data-popular-project-group="1">
                <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-7">
                    <span class="popular__project__img img">
                        <p class="popular__project__id"></p>

                        <img src="/img/Hill Crest_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дубай Хиллз' : 'Villa in Dubai Hills'); ?>">
                    </span>

                    <span class="popular__project__cost__wrap flex">
                        <p class="popular__project__cost" data-cost="6000000">6,000,000</p>

                        <?php echo $currency_select; ?>
                    </span>

                    <span class="popular__project__content flex">
                        <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Дубай&nbsp;Хиллз' : 'Villa in&nbsp;Dubai&nbsp;Hills'); ?></h3>

                        <span class="popular__project__description">
                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Дубай&nbsp;Хиллз' : 'Dubai&nbsp;Hills'); ?></p>
                            </span>

                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Эмаар' : 'Emaar'); ?></p>
                            </span>
                        </span>

                        <span class="popular__project__footer">
                            <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                            <p class="popular__project__val">990<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                        </span>
                    </span>
                </a>
            </div>

            <div class="swiper-slide" data-popular-project-group="1">
                <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-8">
                    <span class="popular__project__img img">
                        <p class="popular__project__id"></p>

                        <img src="/img/Alaya Garden_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                    </span>

                    <span class="popular__project__cost__wrap flex">
                        <p class="popular__project__cost" data-cost="2840000">2,840,000</p>

                        <?php echo $currency_select; ?>
                    </span>

                    <span class="popular__project__content flex">
                        <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Алая&nbsp;Гарденс' : 'Villa in&nbsp;Alaya&nbsp;Gardens'); ?></h3>

                        <span class="popular__project__description">
                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Тилаль&nbsp;Аль&nbsp;Гаф' : 'Tilal&nbsp;Al&nbsp;Ghaf'); ?></p>
                            </span>

                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Тилаль&nbsp;Аль&nbsp;Гаф' : 'Tilal&nbsp;Al&nbsp;Ghaf'); ?></p>
                            </span>
                        </span>

                        <span class="popular__project__footer">
                            <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                            <p class="popular__project__val">569<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                        </span>
                    </span>
                </a>
            </div>

            <div class="swiper-slide" data-popular-project-group="1">
                <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-9">
                    <span class="popular__project__img img">
                        <p class="popular__project__id"></p>

                        <img src="/img/Damac Lagoons Malta_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                    </span>

                    <span class="popular__project__cost__wrap flex">
                        <p class="popular__project__cost" data-cost="478200">478,200</p>

                        <?php echo $currency_select; ?>
                    </span>

                    <span class="popular__project__content flex">
                        <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Дамак&nbsp;Лагунс&nbsp;Мальта' : 'Villa in&nbsp;Damac&nbsp;Lagoons&nbsp;Malta'); ?></h3>

                        <span class="popular__project__description">
                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Дамак&nbsp;Лагунс' : 'Damac&nbsp;Lagoons'); ?></p>
                            </span>

                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Дамак' : 'Damac'); ?></p>
                            </span>
                        </span>

                        <span class="popular__project__footer">
                            <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                            <p class="popular__project__val">211<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                        </span>
                    </span>
                </a>
            </div>

            <div class="swiper-slide" data-popular-project-group="1">
                <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-10">
                    <span class="popular__project__img img">
                        <p class="popular__project__id"></p>

                        <img src="/img/Elie Saab_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Мухаммед Бин Рашед Сити, Район 11' : 'Villa in MBR City District 11'); ?>">
                    </span>

                    <span class="popular__project__cost__wrap flex">
                        <p class="popular__project__cost" data-cost="968000">968,000</p>

                        <?php echo $currency_select; ?>
                    </span>

                    <span class="popular__project__content flex">
                        <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Мухаммед&nbsp;Бин&nbsp;Рашед&nbsp;Сити, Район&nbsp;11' : 'Villa in&nbsp;MBR&nbsp;City District&nbsp;11'); ?></h3>

                        <span class="popular__project__description">
                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Мухаммед&nbsp;Бин&nbsp;Рашед&nbsp;Сити, Район&nbsp;11' : 'MBR&nbsp;City District&nbsp;11'); ?></p>
                            </span>

                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Окта' : 'Octa'); ?></p>
                            </span>
                        </span>

                        <span class="popular__project__footer">
                            <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                            <p class="popular__project__val">350<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                        </span>
                    </span>
                </a>
            </div>

            <div class="swiper-slide" data-popular-project-group="1">
                <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-11">
                    <span class="popular__project__img img">
                        <p class="popular__project__id"></p>

                        <img src="/img/Damac Lagoons Venice_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                    </span>

                    <span class="popular__project__cost__wrap flex">
                        <p class="popular__project__cost" data-cost="1490000">1,490,000</p>

                        <?php echo $currency_select; ?>
                    </span>

                    <span class="popular__project__content flex">
                        <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Дамак&nbsp;Лагунс&nbsp;Венеция' : 'Villa in&nbsp;Damac&nbsp;Lagoons&nbsp;Venice'); ?></h3>

                        <span class="popular__project__description">
                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Дамак&nbsp;Лагунс' : 'Damac&nbsp;Lagoons'); ?></p>
                            </span>

                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Дамак' : 'Damac'); ?></p>
                            </span>
                        </span>

                        <span class="popular__project__footer">
                            <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                            <p class="popular__project__val">400<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                        </span>
                    </span>
                </a>
            </div>

            <div class="swiper-slide" data-popular-project-group="1">
                <a class="popular__project__slide flex open__popup" data-popup="popular-project-popup-12">
                    <span class="popular__project__img img">
                        <p class="popular__project__id"></p>

                        <img src="/img/Expo Villas_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Экспо Виллы Эмаар Юг' : 'Villa in Expo Villas Emaar South'); ?>">
                    </span>

                    <span class="popular__project__cost__wrap flex">
                        <p class="popular__project__cost" data-cost="398000">398,000</p>

                        <?php echo $currency_select; ?>
                    </span>

                    <span class="popular__project__content flex">
                        <h3 class="popular__project__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Экспо&nbsp;Виллы Эмаар&nbsp;Юг' : 'Villa in&nbsp;Expo&nbsp;Villas Emaar&nbsp;South'); ?></h3>

                        <span class="popular__project__description">
                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Экспо&nbsp;Виллы Эмаар&nbsp;Юг' : 'Expo&nbsp;Villas Emaar&nbsp;South'); ?></p>
                            </span>

                            <span class="popular__project__description__item flex">
                                <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?>:</p>
                                <p class="popular__project__val"><?php echo ($lang == 'ru' ? 'Эмаар' : 'Emaar'); ?></p>
                            </span>
                        </span>

                        <span class="popular__project__footer">
                            <p class="popular__project__label"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>

                            <p class="popular__project__val">200<?php echo ($lang == 'ru' ? 'м' : 'm'); ?>2</p>
                        </span>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <section class="residence wrap" id="residence">
        <div class="residence__bg bg img">
            <img src="/img/residence-bg-min.png" srcset="/img/residence-bg-2x-min.png 2x" width="1920" height="1000" alt="<?php echo ($lang == 'ru' ? 'Получи ВНЖ при покупке жилья' : 'Get Residence Visa at the time of buying real estate'); ?>">
        </div>

        <div class="residence__wrap flex">
            <div class="residence__content flex">
                <h2 class="residence__title main__title"><?php echo ($lang == 'ru' ? 'Получи ВНЖ при&nbsp;покупке жилья' : 'Get Residence Visa at&nbsp;the&nbsp;time of&nbsp;buying real&nbsp;estate'); ?></h2>

                <div class="residence__text content">
                    <?php echo ($lang == 'ru' ? '<p>При покупке жилья в&nbsp;новостройке от застройщика от&nbsp;<strong class="green">$200.000</strong> покупатель получает&nbsp;ВНЖ</p>' : '<p>Purchase a home in Dubai worth <strong class="green">$200,000</strong> and be eligible for a 3-year residency visa.</p>'); ?>
                </div>

                <a class="residence__btn btn open__popup" data-popup="contact-form-popup"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'GET A CATALOG'); ?></a>
            </div>

            <div class="residence__img img">
                <img src="/img/residence-img-min.jpg" srcset="/img/residence-img-2x-min.jpg 2x" width="" height="" alt="<?php echo ($lang == 'ru' ? 'Получи ВНЖ при покупке жилья' : 'Get Residence Visa at the time of buying real estate'); ?>">
            </div>
        </div>
    </section>

    <section class="profitability wrap" id="profitability">
        <h2 class="profitability__title title"><?php echo ($lang == 'ru' ? 'Как растут цены на&nbsp;недвижимость в&nbsp;Дубае?' : 'How is the price of real estate in Dubai growing?'); ?></h2>

        <div class="profitability__header flex">
            <div class="profitability__tabs flex">
                <a class="profitability__tab active"><?php echo ($lang == 'ru' ? 'Все транзакции' : 'Total transaction'); ?></a>
                <a class="profitability__tab"><?php echo ($lang == 'ru' ? 'Общая стоимость' : 'Total worth'); ?></a>
                <a class="profitability__tab"><?php echo ($lang == 'ru' ? 'Общее, Квартиры, Участки' : 'Unit, Buildings, Lands'); ?></a>
            </div>

            <div class="profitability__labels">
                <div class="profitability__labels__content flex">
                    <p class="profitability__label flex"><?php echo ($lang == 'ru' ? 'Общее' : 'Units'); ?></p>
                    <p class="profitability__label flex"><?php echo ($lang == 'ru' ? 'Квартиры' : 'Buildings'); ?></p>
                    <p class="profitability__label flex"><?php echo ($lang == 'ru' ? 'Участки' : 'Lands'); ?></p>
                </div>
            </div>
        </div>

        <div class="profitability__chart">
            <canvas id="chart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </section>

    <section class="costs wrap flex" id="costs">
        <div class="costs__content">
            <h2 class="costs__title title"><?php echo ($lang == 'ru' ? 'Собственный дом своей мечты в&nbsp;лучших районах&nbsp;Дубая' : 'Own your dream home in&nbsp;the&nbsp;best areas in&nbsp;Dubai'); ?></h2>

            <div class="costs__text content">
                <?php if($lang == 'ru') { ?>
                    <p>Во всем мире нет такого светящегося города, как Дубай. Дубай предлагает вам множество безопасных и&nbsp;красивых вариантов жилья на&nbsp;выбор.</p>

                    <p>Итак, мы в&nbsp;Mada Properties составили список некоторых из&nbsp;самых популярных мест для проживания в&nbsp;Дубае, чтобы облегчить поиск дома вашей мечты и&nbsp;получить лучшие предложения.</p>
                <?php } else { ?>
                    <p>There is no glowing city ever like Dubai all over the world. Dubai offers you a plethora of safe and lovely residential options to choose from.</p>

                    <p>So, we at Mada Properties have put a list of some  of the most popular places to live in Dubai to make your dream home hunting journey easier, and to get the best offers.</p>
                <?php } ?>
            </div>

            <a class="costs__btn btn open__popup" data-popup="contact-form-popup"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'GET FREE CONSULTATION'); ?></a>
        </div>
        
        <div class="costs__table table__wrap">
            <div class="table__scroll">
                <table>
                    <thead>
                        <tr>
                            <th><?php echo ($lang == 'ru' ? 'Комьюнити' : 'Community'); ?></th>

                            <th><?php echo ($lang == 'ru' ? 'Средняя стоимость - USD' : 'Average Price - USD'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Business Bay</td>
                            <td>299K</td>
                        </tr>

                        <tr>
                            <td>Downtown Dubai</td>
                            <td>871K</td>
                        </tr>

                        <tr>
                            <td>Dubai Creek Harbour</td>
                            <td>544K</td>
                        </tr>

                        <tr>
                            <td>Dubai Marina</td>
                            <td>381K</td>
                        </tr>

                        <tr>
                            <td>Palm Jumeirah</td>
                            <td>789K</td>
                        </tr>

                        <tr>
                            <td>Dubai Harbour</td>
                            <td>816K</td>
                        </tr>

                        <tr>
                            <td>Jumeirah Village Circle</td>
                            <td>183K</td>
                        </tr>

                        <tr>
                            <td>Sobha Hartland</td>
                            <td>326K</td>
                        </tr>

                        <tr>
                            <td>Al Furjan</td>
                            <td>155K</td>
                        </tr>

                        <tr>
                            <td>Arjan</td>
                            <td>173K</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <a class="costs__btn__mob btn open__popup" data-popup="contact-form-popup"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'GET FREE CONSULTATION'); ?></a>
    </section>

    <section class="test wrap" id="test">
        <div class="test__bg bg img">
            <img src="/img/residence-bg-min.png" srcset="/img/residence-bg-2x-min.png 2x" width="1920" height="1000" alt="<?php echo ($lang == 'ru' ? 'Пройди тест и выбери недвижимость!' : 'Take the test and pick up a property!'); ?>">
        </div>

        <div class="test__wrap flex">
            <div class="test__content flex">
                <h2 class="test__title main__title"><?php echo ($lang == 'ru' ? 'Пройди тест и&nbsp;выбери недвижимость!' : 'Take the test and&nbsp;pick&nbsp;up a&nbsp;property!'); ?></h2>

                <div class="test__text content">
                    <?php echo ($lang == 'ru' ? '<p>Пройдите этот тест за <strong class="green">1 минуту</strong> и&nbsp;сэкономьте <strong class="green">95% своего времени</strong> на&nbsp;поиск недвижимости!</p>' : '<p>Complete this test in <strong class="green">1 minute</strong> and save <strong class="green">95% of your time</strong> on property search!</p>'); ?>
                </div>

                <a class="test__btn btn open__fullpage__popup" data-fullpage-popup="quiz-popup"><?php echo ($lang == 'ru' ? 'НАЧАТЬ ТЕСТ' : 'START THE TEST'); ?></a>
            </div>

            <div class="test__img img">
                <img src="/img/test-img-min.jpg" srcset="/img/test-img-2x-min.jpg 2x" width="" height="" alt="<?php echo ($lang == 'ru' ? 'Пройди тест и выбери недвижимость!' : 'Take the test and pick up a property!'); ?>">
            </div>
        </div>
    </section>

    <section class="form__block wrap flex" id="form">
        <div class="form__block__bg bg img">
            <img src="/img/form-block-bg-min.jpg" srcset="/img/form-block-bg-2x-min.jpg 2x" width="" height="" alt="<?php echo ($lang == 'ru' ? 'Получите подборку подходящих вариантов и&nbsp;спецпредложений' : 'Get a selection of suitable options and special offers'); ?>">
        </div>

        <h2 class="form__block__title title"><?php echo ($lang == 'ru' ? 'Получите подборку подходящих вариантов и&nbsp;спецпредложений' : 'Get a selection of suitable options and special offers'); ?></h2>

        <form action="/send.php" method="post" class="f contact__form" novalidate>
            <input type="hidden" name="form_id" value="contact-form">
            <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
            <input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source']; ?>">
            <input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium']; ?>">
            <input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign']; ?>">
            <input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content']; ?>">

            <div class="communication__methods flex">
                <input type="radio" name="communication_method" id="communication-method-1" value="<?php echo ($lang == 'ru' ? 'Звонок' : 'Call'); ?>" checked>

                <label class="communication__method flex" for="communication-method-1">
                    <span class="communication__method__img">
                        <svg width="13" height="18" viewBox="0 0 13 18" xmlns="http://www.w3.org/2000/svg"><path d="M2.47714 1.03267L3.37381 0.746C4.21464 0.477667 5.11298 0.911834 5.47298 1.76017L6.18964 3.45017C6.50131 4.186 6.32798 5.05183 5.76131 5.59017L4.18214 7.0885C4.27964 7.98517 4.58131 8.86767 5.08631 9.736C5.56587 10.5761 6.20912 11.3115 6.97798 11.8985L8.87464 11.2652C9.59298 11.026 10.3763 11.3018 10.8163 11.9493L11.8438 13.4577C12.3563 14.211 12.2638 15.2493 11.628 15.8877L10.9471 16.5718C10.2688 17.2527 9.29964 17.5002 8.40381 17.2202C6.28714 16.5602 4.34298 14.601 2.56798 11.3427C0.790476 8.07933 0.162976 5.30933 0.686309 3.036C0.906309 2.07933 1.58714 1.31683 2.47714 1.03267Z"/></svg>
                    </span>

                    <p class="communication__method__title"><?php echo ($lang == 'ru' ? 'Звонок' : 'Call'); ?></p>
                </label>

                <input type="radio" name="communication_method" id="communication-method-2" value="WhatsApp">

                <label class="communication__method flex" for="communication-method-2">
                    <span class="communication__method__img">
                        <svg width="17" height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg"><path d="M15.7993 3.69988C13.3993 -0.000122309 8.49929 -1.10012 4.69929 1.19988C0.999291 3.49988 -0.200709 8.49988 2.19929 12.1999L2.39929 12.4999L1.59929 15.4999L4.59929 14.6999L4.89929 14.8999C6.19929 15.5999 7.59929 15.9999 8.99929 15.9999C10.4993 15.9999 11.9993 15.5999 13.2993 14.7999C16.9993 12.3999 18.0993 7.49988 15.7993 3.69988ZM13.6993 11.3999C13.2993 11.9999 12.7993 12.3999 12.0993 12.4999C11.6993 12.4999 11.1993 12.6999 9.19929 11.8999C7.49929 11.0999 6.09929 9.79988 5.09929 8.29988C4.49929 7.59988 4.19929 6.69988 4.09929 5.79988C4.09929 4.99988 4.39929 4.29988 4.89929 3.79988C5.09929 3.59988 5.29929 3.49988 5.49929 3.49988H5.99929C6.19929 3.49988 6.39929 3.49988 6.49929 3.89988C6.69929 4.39988 7.19929 5.59988 7.19929 5.69988C7.29929 5.79988 7.29929 5.99988 7.19929 6.09988C7.29929 6.29988 7.19929 6.49988 7.09929 6.59988C6.99929 6.69988 6.89929 6.89988 6.79929 6.99988C6.59929 7.09988 6.49929 7.29988 6.59929 7.49988C6.99929 8.09988 7.49929 8.69988 7.99929 9.19988C8.59929 9.69988 9.19929 10.0999 9.89929 10.3999C10.0993 10.4999 10.2993 10.4999 10.3993 10.2999C10.4993 10.0999 10.9993 9.59988 11.1993 9.39988C11.3993 9.19988 11.4993 9.19988 11.6993 9.29988L13.2993 10.0999C13.4993 10.1999 13.6993 10.2999 13.7993 10.3999C13.8993 10.6999 13.8993 11.0999 13.6993 11.3999Z"/></svg>
                    </span>

                    <p class="communication__method__title">WhatsApp</p>
                </label>

                <input type="radio" name="communication_method" id="communication-method-3" value="Viber">

                <label class="communication__method flex" for="communication-method-3">
                    <span class="communication__method__img">
                        <svg width="18" height="19" viewBox="0 0 18 19" xmlns="http://www.w3.org/2000/svg"><path d="M8.79418 0.75C7.48793 0.75 4.25668 0.8875 2.53793 2.5375C1.30043 3.70625 0.819183 5.49375 0.750433 7.625C0.612933 10.9937 1.36918 13.125 2.60668 14.225C2.88168 14.4313 3.56918 14.9812 4.87543 15.3937V17.1125C4.87543 17.1125 4.87543 17.8 5.28793 17.9375C5.35668 17.9375 5.42543 18.0063 5.49418 18.0063C5.90668 18.0063 6.25043 17.525 6.73168 17.0438C7.14418 16.5625 7.48793 16.2188 7.69418 15.875H9.20668C10.5129 15.875 13.7442 15.7375 15.4629 14.0875C16.7004 12.85 17.1817 11.0625 17.1817 8.79375C17.2504 8.45 17.2504 8.0375 17.2504 7.625C17.1817 5.08125 16.4254 3.3625 15.3942 2.4C14.9817 2.05625 13.1942 0.75 9.34418 0.75H8.79418ZM8.65668 2.05625H9.27543C12.9192 2.05625 14.2942 3.225 14.4317 3.3625C15.2567 4.05 15.7379 5.5625 15.8067 7.55625V7.83125C15.8754 8.24375 15.8754 8.5875 15.8754 8.79375C15.8067 10.8562 15.3942 12.2312 14.5692 13.125C13.1254 14.4312 10.1004 14.5 9.27543 14.5H7.96918L6.86918 15.7375L6.18168 16.4937L6.04418 16.7C5.90668 16.8375 5.70043 17.1125 5.56293 17.1812V14.0875C4.18793 13.7437 3.63793 13.2625 3.50043 13.125C2.53793 12.3 1.98793 10.3062 2.12543 7.625V6.9375C2.26293 5.2875 2.67543 4.1875 3.36293 3.43125C4.80668 2.125 7.83168 2.05625 8.65668 2.05625ZM8.58793 3.56875C8.24418 3.56875 8.24418 4.05 8.58793 4.05C11.1317 4.05 13.3317 5.76875 13.3317 9C13.3317 9.34375 13.8129 9.34375 13.8129 9C13.8129 5.49375 11.4754 3.5 8.58793 3.56875ZM5.86337 4.20469C5.7076 4.18602 5.55069 4.22895 5.42612 4.32431C4.73862 4.66806 4.05043 5.35694 4.25668 6.11319C4.25668 6.11319 4.39418 6.73125 5.15043 8.0375C5.56293 8.65625 5.90668 9.20625 6.25043 9.61875C6.59418 10.1 7.14418 10.65 7.69418 11.0625C8.79418 11.9563 10.5129 12.85 11.2692 13.0562C11.9567 13.2625 12.7129 12.575 13.0567 11.8875C13.1942 11.6125 13.1254 11.2688 12.8504 11.0625C12.4379 10.65 11.7504 10.1687 11.2692 9.89375C10.9254 9.6875 10.5129 9.825 10.3754 10.0312L10.0317 10.4438C9.89418 10.65 9.55043 10.65 9.55043 10.65C7.28168 10.0312 6.66293 7.69375 6.66293 7.69375C6.66293 7.69375 6.66293 7.41875 6.86918 7.2125L7.28168 6.86875C7.48793 6.73125 7.62543 6.31875 7.41918 5.975C7.28168 5.76875 7.07543 5.35625 6.86918 5.15C6.66293 4.875 6.25043 4.39375 6.25043 4.39375C6.14613 4.2893 6.00987 4.22275 5.86337 4.20469ZM9.06918 4.94375C8.72543 4.875 8.65668 5.425 9.00043 5.425C10.9254 5.5625 12.0254 6.86875 11.9567 8.51875C11.8879 8.8625 12.4379 8.8625 12.4379 8.51875C12.5067 6.59375 11.2692 5.0125 9.06918 4.94375ZM9.27543 6.25C8.93168 6.18125 8.93168 6.73125 9.27543 6.73125C10.1004 6.73125 10.5129 7.2125 10.5129 8.0375C10.5817 8.38125 11.0629 8.38125 11.0629 8.0375C10.9942 6.9375 10.3754 6.25 9.27543 6.25Z"/></svg>
                    </span>

                    <p class="communication__method__title">Viber</p>
                </label>

                <input type="radio" name="communication_method" id="communication-method-4" value="Telegram">

                <label class="communication__method flex" for="communication-method-4">
                    <span class="communication__method__img">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g><path d="M10 0C7.34844 0 4.80312 1.05422 2.92969 2.92891C1.05432 4.80434 0.000519484 7.34778 0 10C0 12.6511 1.05469 15.1964 2.92969 17.0711C4.80312 18.9458 7.34844 20 10 20C12.6516 20 15.1969 18.9458 17.0703 17.0711C18.9453 15.1964 20 12.6511 20 10C20 7.34891 18.9453 4.80359 17.0703 2.92891C15.1969 1.05422 12.6516 0 10 0Z"/><path class="svg__path__2" d="M4.52572 9.89453C7.44135 8.62453 9.3851 7.78719 10.357 7.38266C13.1351 6.2275 13.7117 6.02688 14.0882 6.02008C14.171 6.01875 14.3554 6.03922 14.4757 6.13648C14.5757 6.21852 14.6038 6.32945 14.6179 6.40734C14.6304 6.48516 14.6476 6.6625 14.6335 6.80094C14.4835 8.38219 13.832 12.2194 13.5007 13.9905C13.3617 14.7398 13.0851 14.9911 12.8179 15.0156C12.2367 15.0691 11.796 14.6319 11.2335 14.2633C10.3538 13.6862 9.85697 13.3272 9.00229 12.7642C8.01478 12.1136 8.65541 11.7559 9.21791 11.1716C9.36479 11.0186 11.9242 8.69125 11.9726 8.48016C11.9788 8.45375 11.9851 8.35531 11.9257 8.30344C11.8679 8.25141 11.782 8.26922 11.7195 8.28328C11.6304 8.30328 10.2257 9.23266 7.50072 11.0713C7.10228 11.3453 6.74135 11.4789 6.41635 11.4719C6.0601 11.4642 5.3726 11.27 4.86166 11.1041C4.23666 10.9005 3.73822 10.7928 3.78197 10.447C3.80385 10.267 4.05229 10.0828 4.52572 9.89453Z"/></g></svg>
                    </span>

                    <p class="communication__method__title">Telegram</p>
                </label>
            </div>

            <input type="text" name="first_name" class="required" placeholder="<?php echo ($lang == 'ru' ? 'Имя' : 'Name'); ?>">
            
            <div class="phone__number__wrap">
                <input type="tel" name="phone_number" class="required" placeholder="<?php echo ($lang == 'ru' ? 'Телефон' : 'Phone Number'); ?>">

                <?php echo $country_select; ?>
            </div>

            <label class="form__footnote flex">
                <input type="checkbox" name="privacy_policy" checked>

                <p><?php echo ($lang == 'ru' ? 'Я прочитал и&nbsp;принял <a href="/Privacy_policy_en.pdf" target="_blank" rel="nofollow">Политику конфиденциальности</a>' : 'I have read and accepted the&nbsp;<a href="/Privacy_policy_en.pdf" target="_blank" rel="nofollow">Privacy Policy</a>'); ?></p>
            </label>

            <input type="submit" class="btn" value="<?php echo ($lang == 'ru' ? 'Получить каталог' : 'GET A CATALOG'); ?>">
        </form>
    </section>

    <section class="articles wrap" id="articles">
        <div class="articles__bg bg img">
            <img src="/img/districts-bg-min.png" srcset="/img/districts-bg-2x-min.png 2x" width="1920" height="1000" alt="<?php echo ($lang == 'ru' ? 'Статьи' : 'Articles'); ?>">
        </div>

        <div class="articles__header flex">
            <h2 class="articles__title title"><?php echo ($lang == 'ru' ? 'Статьи' : 'Articles'); ?></h2>

            <div class="articles__nav swiper__nav flex">
                <a class="swiper__prev"></a>
                
                <a class="swiper__next"></a>
            </div>
        </div>

        <div class="articles__slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a class="article open__popup" data-popup="article-popup-0">
                            <span class="article__img img">
                                <img src="/img/dubai-attract-visitor-article.jpg" alt="<?php echo ($lang == 'ru' ? 'В период с января по июнь Дубай посетили 7,12 миллиона человек из-за рубежа: DET' : 'Dubai Attracts 7.12 Million International Visitors Between January And June: DET'); ?>">
                            </span>

                            <h3 class="article__title"><?php echo ($lang == 'ru' ? 'В период с января по июнь Дубай посетили 7,12 миллиона человек из-за рубежа: DET' : 'Dubai Attracts 7.12 Million International Visitors Between January And June: DET'); ?></h3>

                            <p class="article__excerpt"><?php echo ($lang == 'ru' ? 'Согласно данным DET, число туристов в Дубае приблизилось к допандемическому уровню, увеличившись более чем на 183% в годовом исчислении в первом полугодии 2022 года.' : 'Dubai tourist numbers closed in on pre-pandemic levels with a growth of more than 183 per cent year-on-year in H1 2022, according to data from DET.'); ?></p>
                        </a>
                    </div>

                    <div class="swiper-slide">
                        <a class="article open__popup" data-popup="article-popup-1">
                            <span class="article__img img">
                                <img src="/img/dubai-named-most-popular-destination.jpg" alt="<?php echo ($lang == 'ru' ? 'Дубай назван самым популярным туристическим направлением 2022 года по версии Tripadvisor' : 'Dubai Named Most Popular Travel Destination Of 2022 By Tripadvisor'); ?>">
                            </span>

                            <h3 class="article__title"><?php echo ($lang == 'ru' ? 'Дубай назван самым популярным туристическим направлением 2022 года по версии Tripadvisor' : 'Dubai Named Most Popular Travel Destination Of 2022 By Tripadvisor'); ?></h3>

                            <p class="article__excerpt"><?php echo ($lang == 'ru' ? 'Эмират возглавил список благодаря сочетанию «современной культуры с историей, приключений с первоклассными магазинами и развлечениями»' : 'The emirate topped the list thanks to its blend of "modern culture with history, adventure with world-class shopping and entertainment"'); ?></p>
                        </a>
                    </div>

                    <div class="swiper-slide">
                        <a class="article open__popup" data-popup="article-popup-2">
                            <span class="article__img img">
                                <img src="/img/uae-golden-visa-scheme.jpg" alt="<?php echo ($lang == 'ru' ? 'Расширение программы «Золотая виза» в ОАЭ; Объявлены новые категории и преимущества' : 'UAE Golden Visa Scheme Expanded; New Categories, Benefits Announced'); ?>">
                            </span>

                            <h3 class="article__title"><?php echo ($lang == 'ru' ? 'Расширение программы «Золотая виза» в ОАЭ; Объявлены новые категории и преимущества' : 'UAE Golden Visa Scheme Expanded; New Categories, Benefits Announced'); ?></h3>

                            <p class="article__excerpt"><?php echo ($lang == 'ru' ? 'ОАЭ объявили о существенных поправках к своей схеме «Золотая виза». Поправки упрощают критерии приемлемости и расширяют категории бенефициаров.' : 'The UAE has announced substantial amendments to its Golden Visa scheme. The amendments simplify the eligibility criteria and expand the categories of beneficiaries.'); ?></p>
                        </a>
                    </div>

                    <div class="swiper-slide">
                        <a class="article open__popup" data-popup="article-popup-3">
                            <span class="article__img img">
                                <img src="/img/dubai-slashes-minimum-property.jpg" alt="<?php echo ($lang == 'ru' ? 'Дубай снижает минимальную стоимость недвижимости для визы инвестора, продлевает сроки действия' : 'Dubai slashes minimum property value for investor visa, extends validity'); ?>">
                            </span>

                            <h3 class="article__title"><?php echo ($lang == 'ru' ? 'Дубай снижает минимальную стоимость недвижимости для визы инвестора, продлевает сроки действия' : 'Dubai slashes minimum property value for investor visa, extends validity'); ?></h3>

                            <p class="article__excerpt"><?php echo ($lang == 'ru' ? 'Трехлетние инвесторские визы будут выдаваться Дубаем, если покупатель продемонстрирует инвестиции в недвижимость на сумму 750 000 дирхамов.' : 'Three-year investor visas will be issued by Dubai if the buyer shows a property investment of Dh750,000.'); ?></p>
                        </a>
                    </div>

                    <div class="swiper-slide">
                        <a class="article open__popup" data-popup="article-popup-4">
                            <span class="article__img img">
                                <img src="/img/burjkhalifa-names-most-popular.jpg" alt="<?php echo ($lang == 'ru' ? 'Бурдж-Халифа назван самой популярной достопримечательностью в мире' : 'Burj Khalifa named most popular landmark in the world'); ?>">
                            </span>

                            <h3 class="article__title"><?php echo ($lang == 'ru' ? 'Бурдж-Халифа назван самой популярной достопримечательностью в мире' : 'Burj Khalifa named most popular landmark in the world'); ?></h3>

                            <p class="article__excerpt"><?php echo ($lang == 'ru' ? 'Исследование компании Kuoni показывает, что небоскреб является самой популярной достопримечательностью в 66 странах.' : 'A new study from Kuoni reveals that the skyscraper is the most searched for landmark in the 66 countries.'); ?></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq wrap" id="faq">
        <h2 class="faq__title title"><?php echo ($lang == 'ru' ? 'Вопрос-ответ' : 'Frequently Asked Questions'); ?></h2>

        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Насколько подорожала недвижимость в&nbsp;Дубае?' : 'How Much Does Dubai Real Estate Appreciate in Value?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p>Помимо того, что Дубай является одной из главных туристических достопримечательностей в мире, ценность Дубая во многом зависит от развития его инфраструктуры. Поскольку Дубай является одним из самых развитых рынков в мире, стоимость недвижимости растет с увеличением времени ожидания. Стоимость жизни в Дубае значительно ниже, чем в Сан-Франциско, Шанхае или даже Лондоне. В результате стоимость недвижимости может увеличиться до 50%.</p>
                <?php } else { ?>
                    <p>Besides being one of the top tourist attractions in the world, Dubai's appreciation value is largely influenced by its infrastructure development. Since Dubai is one of the most mature markets in the world, property values surge with increased waiting times. The cost of living in Dubai is significantly lower than that in San Francisco, Shanghai, or even London. As a result, property values can increase by up to 50%.</p>
                <?php } ?>
            </div>
        </div>

        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Какие налоги должен платить владелец недвижимости в Дубае?' : 'What Kind Of Taxes Does The Dubai Property Owner Need To Pay?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p>Инвестировать и жить в Дубае привлекает его «безналоговый» статус. Благодаря своим доходам от нефти и торговли Дубаю не нужно полагаться на прямое налогообложение для получения дохода. Тем не менее, он обходит налог на недвижимость, взимая ежемесячную «плату за жилье» (также известную как муниципальный налог) и 4% комиссию за перевод.</p>

                    <p>При передаче собственности все владельцы недвижимости должны заплатить 5% от средней арендной платы в своем районе.</p>
                <?php } else { ?>
                    <p>Investing and living in Dubai are attracted to its 'no tax' status. As a result of its oil and trade revenues, Dubai doesn't have to rely on direct taxation to generate income. Nevertheless, it goes around the property tax by charging a monthly "housing fee" (also known as a municipality tax) and a 4% transfer fee.</p>

                    <p>On the transfer of a property, all property owners must pay 5% of the average rental value in their area.</p>
                <?php } ?>
            </div>
        </div>

        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Может ли Mada Properties помочь с арендой недвижимости?' : 'Can Mada Properties Help With The Rental Of Real Estate?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p>Вы можете сдать свою квартиру в аренду в соответствии с законодательством Дубая и назначить агента для поиска арендатора. Перечисляя вашу существующую недвижимость в Mada Properties, мы можем предоставить вам совет, руководство и защиту. Обеспечение легкой и беспроблемной покупки и аренды жилья является одной из наших основных целей.</p>
                <?php } else { ?>
                    <p>You can rent out your unit as per Dubai law, and appoint an agent to find the tenant. By listing your existing property with Mada Properties, we are able to provide you with advice, guidance, and protection. Providing easy and hassle-free home buying and renting is one of our main goals.</p>
                <?php } ?>
            </div>
        </div>

        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Возможно&nbsp;ли провести сделку без привлечения агентов по&nbsp;недвижимости в&nbsp;Дубае?' : 'Is&nbsp;It&nbsp;Possible To&nbsp;Conduct A&nbsp;Deal Without Involving Real Estate Agents in&nbsp;Dubai?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p>Купить недвижимость в&nbsp;ОАЭ можно, не&nbsp;пользуясь услугами риелтора. Однако, хотя экономия на&nbsp;2-процентной комиссии может показаться привлекательной, хотя экономия на&nbsp;2-процентной комиссии может показаться привлекательной, важно понимать, как брокер требует свои комиссионные.</p>

                    <p>Для большинства людей покупка недвижимости&nbsp;&mdash; это самые большие финансовые затраты, поэтому очень важно убедиться, что все сделано правильно. Mada Properties является экспертом рынка и&nbsp;располагает самой последней информацией об&nbsp;отрасли и&nbsp;может помочь как владельцам недвижимости, так и&nbsp;покупателям или арендаторам договориться и&nbsp;найти лучшее предложение без каких-либо усилий.</p>
                <?php } else { ?>
                    <p>It&nbsp;is&nbsp;possible to&nbsp;buy a&nbsp;property in&nbsp;the UAE without using the services of&nbsp;a&nbsp;real estate agent. However, while it&nbsp;may seem attractive to&nbsp;save on&nbsp;the 2&nbsp;per cent fee, though saving on&nbsp;a&nbsp;2% fee may seem attractive, it&nbsp;is&nbsp;important to&nbsp;understand how a&nbsp;broker claims their commissions.</p>

                    <p>For most people, buying a&nbsp;property is&nbsp;the largest financial outlay, so&nbsp;it&rsquo;s crucial to&nbsp;make sure things are done properly. Mada Properties are market experts and have up-to-date information on&nbsp;the industry and can help both property owners and buyers or&nbsp;tenants to&nbsp;negotiate and find the best deal without any effort.</p>
                <?php } ?>
            </div>
        </div>

        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Могут ли иностранцы покупать недвижимость в Дубае?' : 'Can Foreigners Buy Properties in Dubai?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p>ОАЭ разрешают иностранным гражданам, в том числе экспатриантам и инвесторам-нерезидентам, покупать недвижимость на правах собственности. В рамках этого процесса недвижимость может быть куплена, продана или сдана в аренду иностранными гражданами. Однако имейте в виду, что покупка недвижимости в Дубае в качестве иностранца на правах собственности разрешена только в определенных зонах, как указано правительством.</p>
                <?php } else { ?>
                    <p>The UAE allows foreign nationals, including expatriates and non-resident investors, to buy property on a freehold basis. Property can be bought, sold or leased by foreign nationals through this process. However, bear in mind that buying property in Dubai as foreigners on a freehold basis is allowed only in designated zones, as outlined by the government.</p>
                <?php } ?>
            </div>
        </div>

        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Как происходит процесс покупки недвижимости в Дубае?' : 'What is The Process of Buying a Property in Dubai?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p>Купить недвижимость в Дубае относительно просто, независимо от того, хотите ли вы идеальный дом для жизни или выгодную инвестицию.Процесс покупки недвижимости в Дубае включает четыре основных юридических шага. Чтобы ответить на вопрос, как купить недвижимость в Дубае, мы разберем юридические аспекты в хронологическом порядке.</p>
            
                    <h4>1. ЗАКЛЮЧЕНИЕ ДОГОВОРА МЕЖДУ ПОКУПАТЕЛЕМ И ПРОДАВЦОМ</h4>

                    <p>Когда дело доходит до покупки недвижимости в Дубае и ОАЭ, у вас есть два варианта: заплатить наличными или подать заявку на ипотеку. Возможность вести переговоры, пожалуй, самое большое преимущество, которое вы получаете, когда покупаете недвижимость за наличные, а не за ипотеку. Покупатели за наличные имеют лучшее представление о своем бюджете, и поэтому они могут торговаться по более низкой цене.</p>

                    <p>Вы можете пройти этот этап без помощи агента по недвижимости или юриста. Остальное должно быть обработано любым авторитетным агентством недвижимости Дубая или юридической фирмой.</p>

                    <h4>2. ПОДПИСАНИЕ ДОГОВОРА ПРОДАЖИ</h4>

                    <p>Подписание договора купли-продажи, также называемого Меморандумом о взаимопонимании (MOU), является вторым юридическим шагом при покупке недвижимости в Дубае.</p>

                    <p>Меморандум о взаимопонимании или форма F – это одна из форм RERA в отношении недвижимости в Дубае. Форма/контракт F доступна на официальном сайте Земельного департамента Дубая. Обычно агент по недвижимости готовит для вас договор.</p>

                    <p>Как только договор будет готов, и покупатель, и продавец должны подписать его в присутствии свидетеля (обычно агента) в офисе доверенного лица по регистрации.</p>

                    <p>Покупатель также должен заплатить стандартный залог в размере 10% от собственности Регистрационному доверенному лицу, который возвращается после завершения передачи собственности.</p>

                    <h4>3. ЗАЯВЛЕНИЕ НА СВИДЕТЕЛЬСТВО ОБ ОТСУТСТВИИ ВОЗРАЖЕНИЙ</h4>

                    <p>Ваш следующий шаг – встреча с застройщиком, продавцом и агентом по недвижимости.<br>Цель этой встречи — подать заявку и оплатить Сертификат об отсутствии возражений (NOC) для передачи права собственности. Застройщик выдает NOC только в том случае, если в собственности нет непогашенной платы за обслуживание.</p>

                    <h4>4. ОСУЩЕСТВЛЕНИЕ ПЕРЕДАЧИ СОБСТВЕННОСТИ С DLD</h4>

                    <p>После того, как вы получили NOC, последним юридическим шагом при покупке недвижимости в Дубае является встреча с продавцом в офисе Земельного департамента Дубая, чтобы передача вступила в силу.</p>

                    <p>Чтобы передача имущества вступила в силу, перед посещением офиса DLD необходимо иметь при себе следующие документы:</p>

                    <ul>
                        <li>Чек менеджера на цену недвижимости, подлежащую уплате продавцу</li>
                        <li>Оригиналы документов, удостоверяющих личность покупателя и продавца (Emirates ID, паспорт и виза)</li>
                        <li>Оригинальный NOC, выданный разработчиком</li>
                        <li>Подписаннный контракт F (MOU)<br> Новый документ о праве собственности будет выдан на ваше имя после завершения формальностей, и вы станете официальным владельцем недвижимости в Дубае.</li>
                    </ul>
                <?php } else { ?>
                    <p>Buying a property in Dubai is relatively straightforward, regardless of whether you want the perfect home to live in or a lucrative investment.</p>

                    <p>The process of buying property in Dubai involves four primary legal steps. To answer how to buy a property in Dubai, we will chronologically break down the legal aspects.</p>

                    <h4>1. FORMULATING A CONTRACT BETWEEN THE BUYER AND THE SELLER</h4>

                    <p>When it comes to purchasing property in Dubai and the UAE, you have two options: pay cash or apply for a mortgage. The ability to negotiate is perhaps the biggest benefit you have when you buy a property on cash vs mortgage. Cash buyers have a better idea of their budget and that’s why they can barter for a lower price.</p>

                    <p>You can complete this stage without the assistance of a real estate agent or a lawyer. The rest should be handled by any reputable Dubai real estate agency or legal compliance firm.</p>
                    
                    <h4>2. SIGNING THE AGREEMENT OF SALE</h4>

                    <p>Signing the sale agreement, also called the Memorandum of Understanding (MOU), is the second legal step in buying property in Dubai.</p>

                    <p>The MOU or Form F is one of the RERA real estate forms in Dubai. Form/Contract F is available on the official website of the Dubai Land Department. Usually, the real estate agent will get the contract ready for you.</p>

                    <p>Once the contract is ready, both the buyer and the seller have to sign it before a witness (usually the agent) at the Registration Trustee office.</p>

                    <p>The buyer also needs to pay a standard 10% security deposit on the property to the Registration Trustee, which is returned once the property transfer is finalized.</p>
                    
                    <h4>3. APPLICATION FOR A NO OBJECTION CERTIFICATE</h4>

                    <p>Your next step is to meet with the developer, the seller, and the real estate agent. The objective of this meeting is to apply and pay for a No Objection Certificate (NOC) to transfer the ownership. The developer will issue the NOC only if there are no outstanding service charges on the property.</p>
                    
                    <h4>4. EFFECTING THE OWNERSHIP TRANSFER WITH DLD</h4>

                    <p>Once you’ve obtained the NOC, the last legal step of buying a property in Dubai is meeting the seller at the Dubai Land Department office for the transfer to become effective.</p>

                    <p>For the property transfer to take effect, you must have the following documents ready with you before visiting the DLD office:</p>

                    <ul>
                        <li>A manager’s cheque for the property price payable to the seller</li>
                        <li>The original identification documents of buyer and seller (Emirates ID, passport and visa)</li>
                        <li>The original NOC issued by the developer</li>
                        <li>Signed Contract F (MOU)<br> The new title deed will be issued in your name after the formalities have been completed, and you will become an official property owner in Dubai.</li>
                    </ul>
                <?php } ?>
            </div>
        </div>

        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Где лучше всего покупать недвижимость в Дубае?' : 'What is The Best Location for Buying a Property in Dubai?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p>Рынок недвижимости в Дубае предлагает множество вариантов. Для начала вам нужно определить, каковы ваши потребности и приоритеты. Вы предпочитаете апартаменты, таунхаусы или виллы? Какое количество спален? Вы предпочитаете, чтобы ваш дом был рядом с вашей работой, школой, больницами или достопримечательностями, которые вы хотите посетить? К тому времени, когда вы ответите на эти вопросы, вы обнаружите, что ваша домашняя охота будет очень легкой. После того, как вы определились с тем, что именно вы ищете, мы можем помочь вам указать лучшее место, где вы можете купить свой новый дом.</p>
                <?php } else { ?>
                    <p>The real estate market in Dubai has a variety of options. To begin with, you need to determine what your needs and priorities are. Do you prefer apartments, townhouses, or villas? What is the number of bedrooms? Do you prefer your home close to your work, school, hospitals, or the landmarks you want to visit? By the time you answer these questions, you will find your home hunting journey would very easy. Once you’ve finalized on what exactly you are looking for, we can help you point out the best location where you can buy your new home.</p>
                <?php } ?>
            </div>
        </div>

        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Насколько увеличивается стоимость недвижимости в Дубае из года в год?' : 'How Much Does Dubai Real Estate Increase in Value From Year to Year?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p>Дубай быстро превращается в международный торговый и туристический центр. Это один из самых безопасных городов мира с одной из самых быстрорастущих экономик в регионе. Среднегодовая доходность инвестиций в Дубае колеблется от 5% до 8,4%.</p>

                    <ul>
                        <li>В мае 2022 года на рынке недвижимости Дубая было зарегистрировано 6 652 сделки купли-продажи, что на 51,60% больше, чем в мае 2021 года, что является самым высоким показателем за май за последние 10 лет.</li>
                        <li>В первом квартале 2022 г. было зарегистрировано самое большое количество сделок с недвижимостью с 2010 г. за один квартал – 25 972 сделки.</li>
                        <li>В 2021 году компания Dubai Real Estate провела более 84 196 сделок с недвижимостью на сумму почти 300 миллиардов дирхамов ОАЭ. Стоимость этих транзакций является самой высокой за всю историю Дубайской недвижимости. По сравнению с 2020 годом объем транзакций вырос на 66,3%, а стоимость транзакций выросла на 72%.</li>
                    </ul>
                <?php } else { ?>
                    <p>Dubai is quickly growing in becoming an international trading and tourism center. It is one of the safest cities globally and has one of the region’s fastest-growing economies. The average annual return on investment in Dubai varies between 5% and 8.4%.</p>

                    <ul>
                        <li>In May 2022, Dubai’s real estate market registered 6,652 sales transactions, with a significant increase of 51.60 percent compared to May 2021, which recorded the highest performance for May ever recorded in the last 10 years.</li>
                        <li>Q1 2022 had the highest number of real estate transactions since 2010 registered in a single quarter with a total of 25,972 transactions</li>
                        <li>Dubai Real Estate had over 84,196 real estate transactions in 2021 worth almost AED 300 billion. The value of these transactions is the highest its ever been in the recorded history of Dubai Real Estate. Compared to 2020, the volume of transactions grew by 66.3 percent and the value of transactions grew by 72%.</li>
                    </ul>
                <?php } ?>
            </div>
        </div>
        
        <div class="faq__item">
            <h3 class="question"><?php echo ($lang == 'ru' ? 'Какие способы оплаты вы можете использовать при покупке недвижимости в Дубае?' : 'What Payment Methods Can I Use When Purchasing a Dubai Property?'); ?></h3>

            <div class="answer content">
                <?php if($lang == 'ru') { ?>
                    <p> В том случае, если вы определили интересующий вас тип недвижимости, вы можете связаться с доверенным агентом, чтобы совершить экскурсию и обсудить варианты оплаты.  Иностранцам также следует учитывать колебания обменных курсов.</p>
                    
                    <p> Вот несколько способов оплаты, которые помогут вам решить, какие варианты оплаты наиболее подходят для вас при покупке недвижимости в Дубае.</p>

                    <ul>
                        <li>Наличный расчет</li>
                        <li>Оплата кредитной/дебетовой картой</li>
                        <li>Кредиты/ипотека в местных банках</li>
                        <li>Банковский перевод</li>
                    </ul>
                <?php } else { ?>
                    <p>In the event that you have identified the type of property that interests you, you can contact a trusted agent to take a tour and discuss the payment options.  Foreigners should also take into account the fluctuations in exchange rates.</p>
                    
                    <p> Here are some payment methods that will help you decide which payment options are most suitable for you when buying a property in Dubai.</p>

                    <ul>
                        <li> Cash Payment</li>
                        <li>Credit / Debit Card Payment</li>
                        <li>Local Bank Loans / Mortgage</li>
                        <li>Bank Transfer</li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php $address_label_text = ($lang == 'ru' ? 'Адрес' : 'Address');
    $phone_label_text = ($lang == 'ru' ? 'Телефон' : 'Phone'); ?>

    <section class="contacts wrap" id="contacts">
        <h2 class="contacts__title title"><?php echo ($lang == 'ru' ? 'Контакты' : 'Contacts'); ?></h2>

        <div class="contacts__content flex">
            <div class="contact">
                <h3 class="contact__title"><?php echo ($lang == 'ru' ? 'Дубай' : 'Dubai'); ?></h3>

                <div class="contact__item">
                    <p class="contact__label"><?php echo $address_label_text; ?>:</p>
                    <p class="contact__val">Opal Tower - Office 1106 - Business Bay - Dubai</p>
                </div>

                <div class="contact__item">
                    <p class="contact__label"><?php echo $phone_label_text; ?>:</p>
                    <a href="tel:+971503770780" class="contact__val">+971 50 377 0780</a>
                </div>
            </div>

            <div class="contact">
                <h3 class="contact__title"><?php echo ($lang == 'ru' ? 'Эр-Рияд' : 'Riyadh'); ?></h3>

                <div class="contact__item">
                    <p class="contact__label"><?php echo $address_label_text; ?>:</p>
                    <p class="contact__val">Al Aqiq, Office 15, 2nd floor, Riyadh 13515</p>
                </div>

                <div class="contact__item">
                    <p class="contact__label"><?php echo $phone_label_text; ?>:</p>
                    <a href="tel:+966550088601" class="contact__val">+966 55 008 8601</a>
                </div>
            </div>

            <div class="contact">
                <h3 class="contact__title"><?php echo ($lang == 'ru' ? 'Амстердам' : 'Amsterdam'); ?></h3>

                <div class="contact__item">
                    <p class="contact__label"><?php echo $address_label_text; ?>:</p>
                    <p class="contact__val">Rembrandtplein 22, 1017 CV Amsterdam, The Netherlands</p>
                </div>

                <div class="contact__item">
                    <p class="contact__label"><?php echo $phone_label_text; ?>:</p>
                    <a href="tel:+971503770780" class="contact__val">+971 50 377 0780</a>
                </div> 
            </div>

            <div class="contact">
                <h3 class="contact__title"><?php echo ($lang == 'ru' ? 'Москва' : 'Moscow'); ?></h3>

                <div class="contact__item">
                    <p class="contact__label"><?php echo $address_label_text; ?>:</p>
                    <p class="contact__val">Petrovka st., 19 building 4, Moscow, Russia, 107031</p>
                </div>

                <div class="contact__item">
                    <p class="contact__label"><?php echo $phone_label_text; ?>:</p>
                    <a href="tel:+971503770780" class="contact__val">+971 50 377 0780</a>
                </div>
            </div>
        </div>

        <div class="map img">
            <img src="/img/map-<?php echo $lang; ?>-min.png" srcset="/img/map-<?php echo $lang; ?>-2x-min.png 2x" width="1600" height="700" alt="<?php echo ($lang == 'ru' ? 'Контакты' : 'Contacts'); ?>">

            <img src="/img/map-<?php echo $lang; ?>-tablet-min.png" srcset="/img/map-<?php echo $lang; ?>-tablet-2x-min.png 2x" width="744" height="400" alt="<?php echo ($lang == 'ru' ? 'Контакты' : 'Contacts'); ?>">

            <img src="/img/map-<?php echo $lang; ?>-mob-min.png" srcset="/img/map-<?php echo $lang; ?>-mob-2x-min.png 2x" width="375" height="400" alt="<?php echo ($lang == 'ru' ? 'Контакты' : 'Contacts'); ?>">
        </div>
    </section>
</main>

<div class="footer wrap flex">
    <div class="footer__left">
        <?php echo ($lang == 'ru' ? '<a href="/Privacy_policy_en.pdf" target="_blank" rel="nofollow">Политика конфиденциальности</a>' : '<a href="/Privacy_policy_en.pdf" target="_blank" rel="nofollow">Privacy Policy</a>'); ?>
    </div>

    <a class="footer__logo scroll__up"><img src="/img/logo-min.png" srcset="/img/logo-2x-min.png 2x" width="213" height="76" alt="<?php echo $title; ?>"></a>

    <div class="footer__right">
        <?php echo ($lang == 'ru' ? '<a href="https://finik.ae" target="_blank" rel="nofollow">Сайт сделан в FINIK</a>' : '<a href="https://finik.ae" target="_blank" rel="nofollow">Website made in FINIK</a>'); ?>
    </div>
</div>

<div class="popup__overlay flex">
    <div class="popup" id="contact-form-popup">
        <div class="popup__bg bg img">
            <img src="/img/popup-form-bg-min.jpg" srcset="/img/popup-form-bg-2x-min.jpg 2x" width="1408" height="900" alt="<?php echo ($lang == 'ru' ? 'Остались вопросы?' : 'Do you have any questions?'); ?>">
        </div>

        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popup__left">
                    <h3 class="popup__form__title main__title"><?php echo ($lang == 'ru' ? 'Остались вопросы?' : 'Do you have any questions?'); ?></h3>

                    <p class="popup__form__text"><?php echo ($lang == 'ru' ? 'Наш специалист свяжется с вами и&nbsp;ответит на все интересующие вас&nbsp;вопросы.' : 'Our specialist will contact you and answer all your questions.'); ?></p>
                </div>
                

                <form action="/send.php" method="post" class="f contact__form" novalidate>
                    <input type="hidden" name="form_id" value="contact-form">
                    <input type="hidden" name="subject" value="">
                    <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                    <input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source']; ?>">
                    <input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium']; ?>">
                    <input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign']; ?>">
                    <input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content']; ?>">

                    <input type="text" name="first_name" class="required" placeholder="<?php echo ($lang == 'ru' ? 'Имя' : 'First Name'); ?>">

                    <input type="text" name="last_name" class="required" placeholder="<?php echo ($lang == 'ru' ? 'Фамилия' : 'Last Name'); ?>">

                    <div class="phone__number__wrap">
                        <input type="tel" name="phone_number" class="required" placeholder="<?php echo ($lang == 'ru' ? 'Телефон' : 'Phone Number'); ?>">

                        <?php echo $country_select; ?>
                    </div>

                    <input type="email" name="email" class="required" placeholder="Email">

                    <textarea name="message" rows="4" placeholder="<?php echo ($lang == 'ru' ? 'Комментарий' : 'Message'); ?>"></textarea>

                    <label class="form__footnote flex">
                        <input type="checkbox" name="privacy_policy" checked>

                        <p><?php echo ($lang == 'ru' ? 'Я прочитал и&nbsp;принял <a href="/Privacy_policy_en.pdf" target="_blank" rel="nofollow">Политику конфиденциальности</a>' : 'I have read and accepted the&nbsp;<a href="/Privacy_policy_en.pdf" target="_blank" rel="nofollow">Privacy Policy</a>'); ?></p>
                    </label>

                    <input type="submit" class="btn" value="<?php echo ($lang == 'ru' ? 'Отправить' : 'Send'); ?>">
                </form>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>

    <div class="popup popular__project__popup" id="popular-project-popup-0">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti-Luna_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti-Luna_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti-Luna_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti-Luna_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti-Luna_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti-Luna_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti-Luna_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti-Luna_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti-Luna_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti-Luna_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti-Luna_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti-Luna_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti-Luna_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti-Luna_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в&nbsp;Бингхатти&nbsp;Луна' : '1-Bedroom apartment in&nbsp;Binghatti&nbsp;Luna'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Джумейра Вилладж Серкл' : 'JVC'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Бингхатти Луна' : 'Binghatti Luna'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Бингхатти' : 'Binghatti'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">64 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">2,770 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">5</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">19</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">1</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="165500">165,500</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Бингхатти Луна' : '1-Bedroom apartment in Binghatti Luna'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>

    <div class="popup popular__project__popup" id="popular-project-popup-1">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti-Canal_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti Canal_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti Canal_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti Canal_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti Canal_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti Canal_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Binghatti Canal_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti-Canal_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti Canal_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti Canal_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti Canal_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti Canal_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti Canal_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Binghatti Canal_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в&nbsp;Канал&nbsp;Бингхатти' : '2-Bedroom apartment in&nbsp;Binghatti&nbsp;Canal'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Бизнес Бей' : 'Business Bay'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Канал Бингхатти' : 'Binghatti Canal'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Бингхатти' : 'Binghatti'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">136 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">3,770 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">4</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">19</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="512500">512,500</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Канал Бингхатти' : '2-Bedroom apartment in Binghatti Canal'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-2">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Palm-Beach-Towers_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Palm Beach Towers_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Palm Beach Towers_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Palm Beach Towers_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Palm Beach Towers_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Palm Beach Towers_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Palm Beach Towers_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Palm-Beach-Towers_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Palm Beach Towers_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Palm Beach Towers_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Palm Beach Towers_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Palm Beach Towers_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Palm Beach Towers_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Palm Beach Towers_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в&nbsp;Башне Палм-Бич' : '2-Bedroom apartment in&nbsp;Palm Beach Tower'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Пальма Джумейра' : 'Palm Jumeirah'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Башня Палм-Бич' : 'Palm Beach Tower'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Нахил' : 'Nakheel'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">146 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val"></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val"></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">51</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="950000">950,000</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Башне Палм-Бич' : '2-Bedroom apartment in Palm Beach Tower'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-3">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Harbour-Gate_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Harbour-Gate_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Harbour Gate_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Harbour Gate_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Harbour Gate_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Harbour Gate_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Harbour Gate_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Harbour-Gate_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Harbour-Gate_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Harbour Gate_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Harbour Gate_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Harbour Gate_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Harbour Gate_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Harbour Gate_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты в Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты вв Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Дубай Крик Харбор' : 'Dubai Creek Harbour'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Портовые Ворота' : 'Harbour Gate'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Эмаар' : 'Emaari'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">160 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">5,443 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">11</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">38</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">4</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="868000">868,000</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Трехкомнатные апартаменты вв Портовых Воротах' : '3-Bedroom apartment in Harbour Gate'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>

    <div class="popup popular__project__popup" id="popular-project-popup-4">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Jumeirah Living_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Jumeirah-Living_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Jumeirah Living_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Jumeirah-Living_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Jumeirah Living_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Jumeirah Living_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Jumeirah Living_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Jumeirah Living_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Jumeirah-Living_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Jumeirah Living_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Jumeirah-Living_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Jumeirah Living_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Jumeirah Living_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Jumeirah Living_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Бизнесс Бей' : 'Business Bay'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Джумейра Ливинг Бизнес Бей' : 'Jumeirah Living Business Bay'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Select Group' : 'Select Group'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">206 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">10,000 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">8</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">38</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="2030000">2,030,000</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Двухкомнатные апартаменты в Джумейра Ливинг Бизнес Бей' : '2-Bedroom apartment in Jumeirah Living Business Bay'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-5">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Crest-Grande_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Crest Grande_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Crest Grande_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Crest Grande_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Crest Grande_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Crest Grande_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Crest Grande_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Crest-Grande_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Crest Grande_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Crest Grande_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Crest Grande_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Crest Grande_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Crest Grande_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Crest Grande_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в&nbsp;Крест&nbsp;Гранде' : '1-Bedroom apartment in&nbsp;Crest&nbsp;Grande'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Собха Хартленд' : 'Sobha Hartland'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Крест Гранде' : 'Crest Grande'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Собха' : 'Sobha'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">88,2<?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">448,407 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">43</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">1</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="447420">447,420</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Крест Гранде' : '1-Bedroom apartment in Crest Grande'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-6">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Oakley-Square_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Oakley Square_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Oakley Square_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Oakley Square_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Oakley Square_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Oakley Square_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Oakley Square_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Oakley-Square_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Oakley Square_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Oakley Square_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Oakley Square_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Oakley Square_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Oakley Square_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Oakley Square_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в&nbsp;Окли' : '1-Bedroom apartment in&nbsp;Oakley'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Джумейра Вилладж Серкл' : 'JVC'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Окли' : 'Oakley'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Эллингтон' : 'Ellington'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">78 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">3,148 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">11</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">11</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">1</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="246300">246,300</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Однокомнатные апартаменты в Окли' : '1-Bedroom apartment in Oakley'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-7">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Hill Crest_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Hill Crest_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Hill Crest_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Hill Crest_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Hill Crest_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Hill Crest_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Hill Crest_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Hill Crest_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Hill Crest_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Hill Crest_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Hill Crest_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Hill Crest_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Hill Crest_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Hill Crest_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Адрес&nbsp;Хиллкрест' : 'Villa in&nbsp;Address&nbsp;Hillcrest'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Дубай Хиллз' : 'Dubai Hills'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Адрес Хиллкрест' : 'Address Hillcrest'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Эмаар' : 'Emaar'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">990 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">6,071 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">4</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">4</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">6</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">7</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="6000000">6,000,000</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Вилла в Адрес Хиллкрест' : 'Villa in Address Hillcrest'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-8">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Alaya Garden_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Alaya Garden_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Alaya Garden_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Alaya Garden_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Alaya Garden_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Alaya Garden_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Alaya Garden_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Alaya Garden_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Alaya Garden_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Alaya Garden_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Alaya Garden_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Alaya Garden_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Alaya Garden_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Alaya Garden_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Алая&nbsp;Гарденс' : 'Villa in&nbsp;Alaya&nbsp;Gardens'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Тилаль Аль Гаф' : 'Tilal Al Ghaf'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Алая Гарденс' : 'Alaya Gardens'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Тилаль Аль Гаф' : 'Tilal Al Ghaf'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">569 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val"></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">5</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">7</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="2840000">2,840,000</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Вилла в Алая Гарденс' : 'Villa in Alaya Gardens'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-9">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Malta_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Malta_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Malta_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Malta_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Malta_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Malta_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Malta_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Malta_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Malta_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Malta_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Malta_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Malta_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Malta_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Malta_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Дамак Лагунс Мальта' : 'Villa in&nbsp;Damac Lagoons Malta'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Дамак Лагунс' : 'Damac Lagoons'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Дамак Лагунс Мальта' : 'Damac Lagoons Malta'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Дамак' : 'Damac'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">211 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">2,345 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">G+1</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">G+1</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">4</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="478200">478,200</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Мальта' : 'Villa in Damac Lagoons Malta'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-10">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Elie Saab_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Elie Saab_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Elie Saab_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Elie Saab_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Elie Saab_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Elie Saab_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Elie Saab_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Elie Saab_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Elie Saab_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Elie Saab_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Elie Saab_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Elie Saab_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Elie Saab_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Elie Saab_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Вилла во&nbsp;Вью&nbsp;Эли&nbsp;Сааб' : 'Villa in&nbsp;Vie&nbsp;Elie&nbsp;Saab'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Мухаммед Бин Рашед Сити, Район 11' : 'MBR City District 11'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Вью Эли Сааб' : 'Vie Elie Saab'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Окта' : 'Octa'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">350 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">2,860 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">G+1</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">G+1</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">4</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">4</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="968000">968,000</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Вилла во Вью Эли Сааб' : 'Villa in Vie Elie Saab'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-11">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Venice_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Venice_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Venice_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Venice_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Venice_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Venice_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Damac Lagoons Venice_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Venice_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Venice_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Venice_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Venice_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Venice_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Venice_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Damac Lagoons Venice_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                    <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Дамак Лагунс Венеция' : 'Villa in&nbsp;Damac Lagoons Venice'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Дамак Лагунс' : 'Damac Lagoons'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Дамак Лагунс Венеция' : 'Damac Lagoons Venice'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Дамак' : 'Damac'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">400 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">4,250 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">6</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">6</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="1490000">1,490,000</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Вилла в Дамак Лагунс Венеция' : 'Villa in Damac Lagoons Venice'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
    
    <div class="popup popular__project__popup" id="popular-project-popup-12">
        <div class="smooth__scroll">
            <div class="popup__content flex">
                <div class="popular__project__popup__left">
                    <div class="popular__project__popup__main__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Expo Villas_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Expo Villas_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Expo Villas_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Expo Villas_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Expo Villas_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Expo Villas_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                            </div>

                            <div class="popular__project__popup__main__slide img swiper-slide">
                                <img src="/img/Expo Villas_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="popular__project__popup__thumbnails__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Expo Villas_4.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Expo Villas_1.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Expo Villas_2.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Expo Villas_3.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Expo Villas_5.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Expo Villas_6.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="popular__project__popup__thumbnail__slide img">
                                        <img src="/img/Expo Villas_7.jpg" alt="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper__nav">
                            <a class="swiper__prev"></a>
                            <a class="swiper__next"></a>
                        </div>
                    </div>
                </div>

                <div class="popular__project__popup__right flex">
                      <p class="popular__project__popup__id"></p>

                    <h3 class="popular__project__popup__title"><?php echo ($lang == 'ru' ? 'Вилла в&nbsp;Зеленом&nbsp;Виде&nbsp;3' : 'Villa in&nbsp;Green&nbsp;View&nbsp;3'); ?></h3>

                    <div class="popular__project__popup__description">
                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Район' : 'District'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Экспо Виллы Эмаар Юг' : 'Expo Villas Emaar South'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Проект' : 'Project'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Зеленый вид 3' : 'Damac Green View 3'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Застройщик' : 'Developer'); ?></p>
                            <p class="popular__project__popup__description__val"><?php echo ($lang == 'ru' ? 'Эмаап' : 'Emaar'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Площадь' : 'Square'); ?></p>
                            <p class="popular__project__popup__description__val">200 <?php echo ($lang == 'ru' ? 'м²' : 'm²'); ?></p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Цена за м²' : 'Price per m²'); ?></p>
                            <p class="popular__project__popup__description__val">2,000 USD</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этаж' : 'Floor'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Этажность' : 'Number of floors'); ?></p>
                            <p class="popular__project__popup__description__val">2</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Спален' : 'Bedrooms'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>

                        <div class="popular__project__popup__description__item flex">
                            <p class="popular__project__popup__description__label flex"><?php echo ($lang == 'ru' ? 'Ванн' : 'Bathrooms'); ?></p>
                            <p class="popular__project__popup__description__val">3</p>
                        </div>
                    </div>

                    <div class="popular__project__popup__cost__wrap flex">
                        <p class="popular__project__popup__cost" data-cost="398000">398,000</p>

                        <?php echo $currency_select; ?>
                    </div>

                    <a class="popular__project__popup__btn btn open__popup" data-popup="contact-form-popup" data-subject="<?php echo ($lang == 'ru' ? 'Вилла в Зеленом Виде 3' : 'Villa in Green View 3'); ?>"><?php echo ($lang == 'ru' ? 'Получить консультацию' : 'BOOK THE UNIT'); ?></a>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>

    <div class="popup article__popup" id="article-popup-0">
        <div class="smooth__scroll">
            <div class="popup__content">
                <h2 class="article__popup__title"><?php echo ($lang == 'ru' ? 'В период с января по июнь Дубай посетили 7,12 миллиона человек из-за рубежа: DET' : 'Dubai Attracts 7.12 Million International Visitors Between January And June: DET'); ?></h2>

                <div class="article__popup__content flex">
                    <div class="article__popup__img img">
                        <img src="/img/dubai-attract-visitor-article.jpg" alt="<?php echo ($lang == 'ru' ? 'В период с января по июнь Дубай посетили 7,12 миллиона человек из-за рубежа: DET' : 'Dubai Attracts 7.12 Million International Visitors Between January And June: DET'); ?>">
                    </div>

                    <div class="arcticle__popup__text content">
                        <div class="smooth__scroll">
                            <?php if($lang == 'ru') { ?>
                                <p><strong>Согласно данным DET, число туристов в Дубае приблизилось к допандемическому уровню, увеличившись более чем на 183% в годовом исчислении в первом полугодии 2022 года.</strong></p>

                                <p>Согласно последним данным Департамента экономики и туризма Дубая, в период с января по июнь 2022 года Дубай привлек 7,12 миллиона иностранных посетителей, что на 183% больше, чем 2,52 миллиона туристов, посетивших Дубай за тот же период в 2021 году (DET).</p>

                                <p>Шейх Хамдан бин Мохаммед бин Рашид Аль Мактум, наследный принц Дубая и председатель Исполнительного совета Дубая, сказал: «Видение Его Высочества шейха Мохаммеда бин Рашида Аль Мактума, вице-президента и премьер-министра ОАЭ и правителя Дубая, сделать Дубай городом будущего и лучшим местом в мире для жизни, работы и инвестиций, привело к возрождению туристического сектора Дубая. Рост числа туристов отражает устойчивость и динамизм экономики эмирата.</p>

                                <p>«Быстрый рост числа международных туристов ставит Дубай на путь достижения своей амбициозной цели — стать самым посещаемым направлением в мире. В предстоящие годы Дубай будет продолжать развиваться как направление, которое предлагает привлекательные возможности для международных путешественников».</p>

                                <p>Согласно отчету Dubai Media Office, количество туристов, зарегистрированное в первом полугодии 2022 года, было близко к цифрам, достигнутым за первые шесть месяцев 2019 года, когда в Дубай прибыло 8,36 миллиона туристов.</p>

                                <p><strong>Доля регионального рынка</strong></p>

                                <p>На Западную Европу приходилось значительная доля прибытий туристов, составляющая 22% от общего числа международных посетителей за первые шесть месяцев 2022 года. На БВСА и страны Персидского залива в совокупности пришлось 34% от общего числа международных посетителей. За этими регионами следует Южная Азия с долей 16%, а Россия, СНГ и Восточная Европа вместе составляют 11% от общего числа посетителей в первом полугодии 2022 года.</p>

                                <p><strong>Статистика заполняемости отеля</strong></p>

                                <p>Широкий спектр гостиничных заведений в Дубае показал хорошие результаты по всем показателям гостеприимства в первой половине 2022 года. Средняя заполняемость гостиничного сектора в период с января по июнь 2022 года составляла 74 процента, что является одним из самых высоких показателей в мире, по сравнению с 62 процентами в первом полугодии 2021 года, что составляет разницу в 12 процентных пунктов и чуть меньше 76-процентного уровня загрузки, зарегистрированного в течение допандемический период первого полугодия 2019 года. Это особенно примечательно, поскольку было достигнуто, несмотря на увеличение вместимости номеров более чем на 19% по сравнению с тем же периодом 2019 года.</p>

                                <p>На конец июня 2022 года отельный парк Дубая насчитывал 140 778 номеров, открытых в 773 гостиничных заведениях, по сравнению с 118 345 номерами, доступными на конец июня 2019 года в 714 заведениях. Между тем, общее количество отелей в первом полугодии 2022 года отражало 8-процентный рост по сравнению с первым полугодием 2021 года, что свидетельствует о сохраняющемся сильном доверии инвесторов к туристическому сектору Дубая.</p>

                                <p>Гостиничный сектор превзошел показатели до пандемии по всем другим ключевым параметрам — количеству занятых номеров в сутки, средней дневной ставке (ADR) и доходу от доступного номера (RevPAR). В гостиничных заведениях Дубая за первые шесть месяцев года в общей сложности было занято 18,47 млн ночей, что на 30,4% больше, чем в предыдущем году, и более чем на 18% больше, чем в предпандемический период первого полугодия 2019 года, что дало 15,71 млн занятых номеров.</p>

                                <p>ADR 567 дирхамов в первой половине года превзошли ADR как за первое полугодие 2021 года (382 дирхама), так и за 2019 год (444 дирхама), с ростом на 48,5% и 28% в годовом исчислении соответственно. <br>Высокие показатели гостиничного сектора были очевидны в росте RevPAR — рост более чем на 76% по сравнению с первыми шестью месяцами 2021 года (417 дирхамов против 237 дирхамов) и рост на 24% по сравнению с допандемическим периодом в 2019 году (RevPAR 336 дирхамов).</p>

                                <p>По данным аналитической компании STR, Дубай занимает третье место в мире по RevPAR (147 долларов США) после Парижа (195 долларов США) и Нью-Йорка (172 доллара США).</p>
                            <?php } else { ?>
                                <p><strong>Dubai tourist numbers closed in on pre-pandemic levels with a growth of more than 183 per cent year-on-year in H1 2022, according to data from DET</strong></p>

                                <p>Dubai attracted 7.12 million international overnight visitors between January and June 2022, recording more than 183 per cent growth in visitors compared to the 2.52 million tourists who visited Dubai during the same period in 2021, according to the latest data from Dubai’s Department of Economy and Tourism (DET).</p>

                                <p>Sheikh Hamdan bin Mohammed bin Rashid Al Maktoum, Crown Prince of Dubai and Chairman of The Executive Council of Dubai, said: “The vision of HH Sheikh Mohammed bin Rashid Al Maktoum, Vice President and Prime Minister of the UAE and Ruler of Dubai, to make Dubai the city of the future and the world’s best place to live, work and invest in has resulted in a resurgence of Dubai’s tourism sector. The growth in tourists reflects the resilience and dynamism of the emirate’s economy.</p>

                                <p>“The rapid rise in international tourist arrivals puts Dubai on track to achieving its ambitious target of becoming the world’s most visited destination. In the years ahead, Dubai will continue to develop itself further as a destination that offers compelling value to international travellers.”</p>

                                <p>According to a Dubai Media Office report, the number of tourists recorded in H1 2022 was close to the numbers achieved in the first six months of 2019, which saw 8.36 million tourists arriving in Dubai.</p>

                                <p><strong>Regional market share</strong></p>

                                <p>Western Europe accounted for a significant share of tourist arrivals, making up 22 per cent of total international visitors in the first six months of 2022. MENA and GCC collectively contributed 34 per cent of total international visitors.</p>

                                <p>These regions were followed closely by South Asia with a share of 16 per cent and Russia, CIS and Eastern Europe together accounting for 11 per cent of total visitors in H1 2022.</p>

                                <p>The wide geographic spread reflects Dubai’s diversified strategy aimed at attracting traffic from a broad spectrum of countries and visitor segments.</p>

                                <p><strong>Hotel occupancy stats</strong></p>

                                <p>The wide range of hotel establishments in Dubai performed well across all hospitality metrics during the first half of 2022.</p>

                                <p>Average occupancy for the hotel sector between January and June 2022 stood at 74 per cent, one of the world’s highest, compared to 62 per cent in H1 2021, a difference of 12 percentage points and just short of the 76 per cent occupancy level registered during the pre-pandemic period of H1 2019. This is particularly noteworthy as it was achieved in spite of an over 19 per cent increase in room capacity over the same period in 2019.</p>

                                <p>Dubai’s hotel inventory by the end of June 2022 comprised 140,778 rooms open at 773 hotel establishments, compared to 118,345 rooms available at the end of June 2019 across 714 establishments. Meanwhile, the total number of hotels in H1 2022 reflected an 8 per cent growth over H1 2021, highlighting continued strong investor confidence in Dubai’s tourism sector.</p>

                                <p>The hotel sector outperformed pre-pandemic levels across all other key measurements – occupied room nights, average daily rate (ADR) and revenue per available room (RevPAR). Dubai hotel establishments delivered a combined 18.47million occupied room nights during the first six months of the year, an over 30.4 per cent YoY growth, and an over 18 per cent increase over the pre-pandemic period of H1 2019, which yielded 15.71 million occupied room nights</p>

                                <p>The ADR of Dhs567 in the first half of the year surpassed the ADRs for both H1 2021 (Dhs382) and 2019 (Dhs444), with 48.5 per cent and 28 per cent YoY growth, respectively.</p>

                                <p>The strong performance of the hotel sector was evident in RevPAR growth – a surge of over 76 per cent compared to the first six months of 2021 (Dhs417 versus Dhs237) and an increase of 24 per cent over the pre-pandemic period in 2019 (RevPAR of Dhs336).</p>

                                <p>According to hotel analytics firm STR, Dubai ranks number three globally on RevPAR (U$147), after Paris ($195) and New York ($172).</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>

    <div class="popup article__popup" id="article-popup-1">
        <div class="smooth__scroll">
            <div class="popup__content">
                <h2 class="article__popup__title"><?php echo ($lang == 'ru' ? 'Дубай назван самым популярным туристическим направлением 2022 года по версии Tripadvisor' : 'Dubai Named Most Popular Travel Destination Of 2022 By Tripadvisor'); ?></h2>

                <div class="article__popup__content flex">
                    <div class="article__popup__img img">
                        <img src="/img/dubai-named-most-popular-destination.jpg" alt="<?php echo ($lang == 'ru' ? 'Дубай назван самым популярным туристическим направлением 2022 года по версии Tripadvisor' : 'Dubai Named Most Popular Travel Destination Of 2022 By Tripadvisor'); ?>">
                    </div>

                    <div class="arcticle__popup__text content">
                        <div class="smooth__scroll">
                            <?php if($lang == 'ru') { ?>
                                <p><strong>Эмират возглавил список благодаря сочетанию «современной культуры с историей, приключений с первоклассными магазинами и развлечениями».</strong></p>

                                <p>«Посмотрите представление в Дубайской опере, посмотрите на центр города с вершины Бурдж-Халифа и проведите день вдоль Дубайского залива, исследуя рынки золота, тканей и специй», — сообщает Tripadvisor. «Если вы ищете острых ощущений, вы можете парить над дюнами пустыни на воздушном шаре, подняться на борт высокоскоростного аттракциона в IMG Worlds of Adventure или прыгнуть с парашютом над Пальмой Джумейра». <br>На втором месте Лондон, за ним Канкун, Бали и Крит в первой пятерке. <br>Из региона Стамбул занимает восьмое место, Хургада в Египте - номер 10, Марракеш был назван 12-м по популярности, а в преддверии чемпионата мира по футболу в этом году Доха была названа 22-й. Из Индии в список попали Нью-Дели и Джайпур.<br>TripAdvisor называет 25 мест в своем списке самых популярных направлений.</p>

                                <p>В рамках премии Travellers' Choice Awards Tripadvisor также выделяет самые популярные направления со всего мира, в первую тройку вошли Майорка, Каир и Родос, а также лучшие направления для любителей города, которые также возглавляет Дубай, за которым следуют Лондон и Рим. В категории «Лучшие направления для искателей солнца» доминировали Канкун, Бали и Крит, а Рим, Лондон и Париж были названы лучшими направлениями для любителей еды. Также признаны лучшие направления для любителей активного отдыха, в первую тройку вошли национальный парк вулкана Ареналь в Коста-Рике, национальный парк Джима Корбетта в Индии и национальный парк Серенгети в Танзании. Лучшими направлениями для катания на лыжах были Церматт, Швейцария, за ним следуют два горнолыжных курорта в Северной Америке – Джексон, штат Вайоминг, США, и Банф, провинция Альберта, Канада.</p>

                                <p><strong>Самые популярные направления Tripadvisor в 2022 году:</strong></p>

                                <ul>
                                    <li>Дубай, ОАЭ</li>
                                    <li>Лондон, Великобритания</li>
                                    <li>Канкун, Мексика</li>
                                    <li>Бали, Индонезия</li>
                                    <li>Крит, Греция</li>
                                    <li>Рим, Италия</li>
                                    <li>Кабо-Сан-Лукас, Мексика</li>
                                    <li>Стамбул, Турция</li>
                                    <li>Париж, Франция</li>
                                    <li>Хургада, Египет</li>
                                    <li>Барселона, Испания</li>
                                    <li>Марракеш, Марокко</li>
                                    <li>Тенерифе, Канарские острова</li>
                                    <li>Корсика, Франция</li>
                                    <li>Нью-Дели, Индия</li>
                                    <li>Сингапур</li>
                                    <li>Эдинбург, Великобритания</li>
                                    <li>Флоренция, Италия</li>
                                    <li>Джайпур, Индия</li>
                                    <li>Куско, Перу</li>
                                    <li>Бангкок, Тайланд</li>
                                    <li>Доха, Катар</li>
                                    <li>Пхукет, Таиланд</li>
                                    <li>Рио-де-Жанейро, Бразилия</li>
                                    <li>Лас-Вегас, Невада</li>
                                </ul>
                            <?php } else { ?>
                                <p><strong>Dubai has been named the Most Popular Destination of 2022 in Tripadvisor's Travellers' Choice Awards.</strong></p>

                                <p>The emirate topped the list thanks to its blend of "modern culture with history, adventure with world-class shopping and entertainment".</p>

                                <p>"Catch a show at the dubai opera, see downtown from atop the Burj Khalifa and spend an afternoon along Dubai Creek exploring the gold, textile and spice souqs," Tripadvisor says. "If you’re looking for thrills, you can float above the desert dunes in a hot-air balloon, climb aboard a high-speed ride at IMG Worlds of adventure or skydive over the Palm Jumeirah." In second place is London, followed by Cancun, Bali and Crete in the top five.</p>

                                <p>From the region, Istanbul comes in eighth, Hurghada in Egypt is number 10, Marrakesh was named 12th most popular and ahead of the Fifa World Cup later this year, Doha was named 22nd. From India, both New Delhi and Jaipur made the list. TripAdvisor names 25 locations in its list of most popular destinations.</p>

                                <p>As part of its Travellers' Choice Awards, Tripadvisor also spotlights global Trending Destinations, with Majorca, Cairo and Rhodes named as the top three, and Top Destinations for City Lovers, which Dubai also topped, followed by London and Rome. The Top Destinations for Sun Seekers category was dominated by Cancun, Bali and Crete, while Rome, London and Paris were named Top Destinations for Food Lovers.</p>

                                <p>Also recognised are Top Destinations for Outdoor Enthusiasts, with Arenal Volcano National Park in Costa Rica, Jim Corbett National Park in India and the Serengeti National Park, Tanzania making the top three. The best skiing destinations were Zermatt, Switzerland, followed by two North American ski resorts –Jackson, Wyoming in the US and Banff in Alberta, Canada.</p>

                                <p><strong>Tripadvisor's Most Popular Destinations of 2022:</strong></p>

                                <ul>
                                    <li>Dubai, UAE</li>
                                    <li>London, UK</li>
                                    <li>Cancun, Mexico</li>
                                    <li>Bali, Indonesia</li>
                                    <li>Crete, Greece</li>
                                    <li>Rome, Italy</li>
                                    <li>Cabo San Lucas, Mexico</li>
                                    <li>Istanbul, Turkey</li>
                                    <li>Paris, France</li>
                                    <li>Hurghada, Egypt</li>
                                    <li>Barcelona, Spain</li>
                                    <li>Marrakesh, Morocco</li>
                                    <li>Tenerife, Canary Islands</li>
                                    <li>Corsica, France</li>
                                    <li>New Delhi, India</li>
                                    <li>Singapore</li>
                                    <li>Edinburgh, UK</li>
                                    <li>Florence, Italy</li>
                                    <li>Jaipur, India</li>
                                    <li>Cusco, Peru</li>
                                    <li>Bangkok, Thailand</li>
                                    <li>Doha, Qatar</li>
                                    <li>Phuket, Thailand</li>
                                    <li>Rio de Janeiro, Brazil</li>
                                    <li>Las Vegas, Ne</li>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>

    <div class="popup article__popup" id="article-popup-2">
        <div class="smooth__scroll">
            <div class="popup__content">
                <h2 class="article__popup__title"><?php echo ($lang == 'ru' ? 'Расширение программы «Золотая виза» в ОАЭ; Объявлены новые категории и преимущества' : 'UAE Golden Visa Scheme Expanded; New Categories, Benefits Announced'); ?></h2>

                <div class="article__popup__content flex">
                    <div class="article__popup__img img">
                        <img src="/img/uae-golden-visa-scheme.jpg" alt="<?php echo ($lang == 'ru' ? 'Расширение программы «Золотая виза» в ОАЭ; Объявлены новые категории и преимущества' : 'UAE Golden Visa Scheme Expanded; New Categories, Benefits Announced'); ?>">
                    </div>

                    <div class="arcticle__popup__text content">
                        <div class="smooth__scroll">
                            <?php if($lang == 'ru') { ?>
                                <p><strong>ОАЭ объявили о существенных поправках к своей схеме «Золотая виза». Поправки упрощают критерии приемлемости и расширяют категории бенефициаров.</strong></p>

                                <p>Обладатели заветной визы могут оставаться за пределами ОАЭ столько, сколько им нужно, без ущерба для их проживания. Ранее резиденты, которые оставались за пределами ОАЭ в течение шести и более месяцев, теряли вид на жительство.</p>

                                <p>Эта долгосрочная 10-летняя резиденция предоставляется инвесторам, предпринимателям, исключительным талантам, ученым и специалистам, выдающимся студентам и выпускникам, пионерам гуманитарной деятельности и героям на передовой.</p>

                                <p>Поправки позволяют обладателям «Золотой визы» спонсировать членов своей семьи, включая супруга и детей, независимо от их возраста. Они могут спонсировать неограниченное количество вспомогательных услуг (помощь по дому).</p>

                                <p>Другие льготы для членов семьи позволяют им оставаться в ОАЭ в случае смерти обладателя Золотой визы.</p>

                                <p>Инвесторы в недвижимость могут получить Golden Residence при покупке недвижимости стоимостью не менее 2 миллионов дирхамов. Согласно новым поправкам, инвесторы также имеют право на получение долгосрочной визы при покупке недвижимости с кредитом в определенных местных банках. Инвесторы также могут получить резиденцию при покупке одного или нескольких объектов вне плана на сумму не менее 2 миллионов дирхамов у утвержденных местных компаний по недвижимости.</p>
                            <?php } else { ?>
                                <p><strong>The UAE has announced substantial amendments to its Golden Visa scheme. The amendments simplify the eligibility criteria and expand the categories of beneficiaries.</strong></p>

                                <p>Holders of the coveted visa can stay outside the UAE for as long as they need, without it affecting their residence. Previously, residents who stayed outside the UAE for six months or more lost their residency.</p>

                                <p>This long-term, 10-year residency is granted to investors, entrepreneurs, exceptional talents, scientists and professionals, outstanding students and graduates, humanitarian pioneers and the frontline heroes.</p>

                                <p>The amendments allow the Golden Visa holders to sponsor his/her family members including spouse and children regardless of their age. They can sponsor unlimited number of support services (domestic help).</p>

                                <p>Other benefits for family members allow them to stay in the UAE in the event of the death of the Golden Visa holder. Real estate investors can obtain Golden Residence when purchasing a property that is worth no less than Dh2 million.</p>

                                <p>As per new amendments, investors are also entitled to obtain the long-term visa when purchasing a property with a loan from specific local banks. Investors can also get the residence when buying one or more off-plan properties of no less than Dh2 million from approved local real estate companies.</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>

    <div class="popup article__popup" id="article-popup-3">
        <div class="smooth__scroll">
            <div class="popup__content">
                <h2 class="article__popup__title"><?php echo ($lang == 'ru' ? 'Дубай снижает минимальную стоимость недвижимости для визы инвестора, продлевает сроки действия' : 'Dubai slashes minimum property value for investor visa, extends validity'); ?></h2>

                <div class="article__popup__content flex">
                    <div class="article__popup__img img">
                        <img src="/img/dubai-slashes-minimum-property.jpg" alt="<?php echo ($lang == 'ru' ? 'Дубай снижает минимальную стоимость недвижимости для визы инвестора, продлевает сроки действия' : 'Dubai slashes minimum property value for investor visa, extends validity'); ?>">
                    </div>

                    <div class="arcticle__popup__text content">
                        <div class="smooth__scroll">
                            <?php if($lang == 'ru') { ?>
                                <p><strong>Трехлетние инвесторские визы будут выдаваться Дубаем, если покупатель продемонстрирует инвестиции в недвижимость на сумму 750 000 дирхамов по сравнению с лимитом в 1 миллион дирхамов ранее, согласно ведущим источникам в отрасли. А прежняя виза инвестора была на два года.</strong></p>

                                <p>Этот шаг связан с тем, что рынок недвижимости Дубая демонстрирует все больше признаков восстановления, начиная с сегмента элитной недвижимости. Благодаря этому шагу, направленному на снижение уровня требуемых инвестиций, Дубай ожидает роста интереса покупателей на начальном уровне. Для девелоперов Дубая это станет еще одним важным стимулом для очистки своих запасов и стимулом для запуска новых проектов.</p>

                                <p>«Инвесторские визы, привязанные к покупке недвижимости, стали причиной бума фригольда в Дубае в 2003–2008 годах», — сказал источник в застройщике. «Сейчас, после пяти лет относительно слабого рынка, Дубай снова привлекает внимание к визам для инвесторов для новой базы инвесторов из-за рубежа.</p>

                                <p>«Верхний сегмент рынка недвижимости продается сам по себе, и конечные пользователи-резиденты проявляют большой интерес к домам среднего класса. Если Дубай сможет привлечь инвесторов на начальном уровне, это добавит глубины». Этот шаг также следует рассматривать в контексте использования ОАЭ «золотых» и «зеленых» виз, ориентированных на различные профили инвесторов/профессионалов.</p>

                                <p><strong>Требования для получения визы</strong></p>

                                <p>«Снижение пороговой суммы инвестиций — это еще один шаг правительства по расширению базы в сфере недвижимости, а также увеличению численности населения. Это послужит увеличению спроса на недвижимость, особенно в доступном сегменте, и привлечению талантов со всего мира».</p>

                                <p><strong>Новая демография</strong></p>

                                <p>Источники на рынке говорят о том, что на рынке труда Дубая в ближайшие три-пять лет появится больше молодежи. Это означает потребность в большем количестве студий и квартир с одной спальней, будь то в поселках или в многоэтажках. Это также была единственная жилая подкатегория, которая находилась под давлением, потому что нынешние жители переселялись в более просторные жилые помещения, будь то арендованные или собственные.</p>

                                <p>Изменение с 1 миллиона дирхамов до 750 000 дирхамов также связано со снижением стоимости недвижимости за последние пять лет, особенно в нижней части рынка жилой недвижимости. Наряду с усилиями разработчиков по созданию условий для совместной работы и совместной жизни, новый шаг правительства позволит Дубаю принять новую демографическую группу.</p>

                                <p>«Стремление Дубая привлечь лучших и самых ярких людей не ослабевает», — сказал Лахани. «Исторически талант перемещался в области, связанные с более высоким уровнем творчества в сочетании с простотой владения активами и проживания. Это уравнение — то, что правительство совершенствует».</p>
                            <?php } else { ?>
                                <p><strong>Three-year investor visas will be issued by Dubai if the buyer shows a property investment of Dh750,000 compared to a Dh1 million limit earlier, according to top industry sources. And the earlier investor visa was for a two-year period.</strong></p>

                                <p>The move comes as Dubai’s property market shows more signs of recovery, starting with the luxury end. With this move to bring down the level of investments required, Dubai expects to see more buyer interest develop at the entry level. For Dubai’s developers, this will be another major booster to clearing their inventory – and a prompt to launch new projects.</p>

                                <p>“Investor visas tied to property purchases was what set off the Dubai freehold boom of 2003-08,” said a developer source. “Now, after five years of a relatively soft market, Dubai is again drawing attention to the investor visas for a new base of investors from overseas.</p>

                                <p>“The top-end of the property market is selling on its own, and there is a lot of interest from resident end-users for mid-market homes. If Dubai can bring in investors at the entry level, it adds more depth.”</p>

                                <p>The move should also be seen in the context of the UAE using ‘Golden’ and ‘Green’ visas targeted at various investor/professional profiles.</p>

                                <p><strong>Requirements for visa</strong></p>

                                <p>The bare minimum requirement for the investor visa is a Dh750,000 property asset. “In case the property is on mortgage – or at least Dh750,000 is owed to a bank – there must be an no-objection certificate in Arabic along with a mortgage bank statement to proceed with the visa,” according to Sameer Lakhani, Managing Director of Global Capital Partners.</p>

                                <p>“Reducing the threshold investment amount is yet another step by the government to broaden the base in real estate as well as raise the population count. This will serve to increase demand for property, especially in the affordable segment, and attract talent from all over.”</p>

                                <p><strong>New demographic</strong><br>Market sources talk about the Dubai’s job market seeing more youngsters joining in the next three to five years. That means a need for more studio and one-bedroom apartments, whether in communities or high-rises. This was also the one residential sub-category that was under pressure because current residents were upgrading to bigger living spaces, whether rented or owned.</p>

                                <p>The change from Dh1 million to Dh750,000 also addresses the softening of property values in the last five years, most noticeably at the lower end of the residential property market. Along with developers' efforts to offer co-working and co-living environments, the new move by the government will tap a fresh demographic for Dubai to host.</p>

                                <p>"Dubai’s quest to attract the best and the brightest continues unabated," said Lakhani. "Talent, historically, has moved to areas associated with higher levels of creativity conjoined with ease of asset ownership and residency. This equation is what the government is perfecting."</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>

    <div class="popup article__popup" id="article-popup-4">
        <div class="smooth__scroll">
            <div class="popup__content">
                <h2 class="article__popup__title"><?php echo ($lang == 'ru' ? 'Бурдж-Халифа назван самой популярной достопримечательностью в мире' : 'Burj Khalifa named most popular landmark in the world'); ?></h2>

                <div class="article__popup__content flex">
                    <div class="article__popup__img img">
                        <img src="/img/burjkhalifa-names-most-popular.jpg" alt="<?php echo ($lang == 'ru' ? 'Бурдж-Халифа назван самой популярной достопримечательностью в мире' : 'Burj Khalifa named most popular landmark in the world'); ?>">
                    </div>

                    <div class="arcticle__popup__text content">
                        <div class="smooth__scroll">
                            <?php if($lang == 'ru') { ?>
                                <p><strong>Новое исследование компании Kuoni, занимающейся роскошными путешествиями, показывает, что небоскреб является самой популярной достопримечательностью в 66 проанализированных странах, что составляет 37,5% всего мира, что делает его самым популярным.</strong></p>

                                <p>Это самая популярная достопримечательность Индии, Швейцарии и большей части Африки, а также Фиджи, Индонезии и Туркменистана. В ОАЭ, однако, больше всего искали достопримечательности индийский Тадж-Махал, который занимает четвертое место в исследовании вместе с английским Биг-Беном.</p>

                                <p>Второй по популярности является Эйфелева башня во Франции, которая занимает первое место в 29 странах, включая Великобританию, Ирландию, Канаду и Австралию. На третьем месте находится Мачу-Пикчу, который занимает первое место в 19 округах, включая Мексику, Испанию и Чили.</p>

                                <p>Согласно исследованию, «несмотря на продолжающуюся пандемию, количество онлайн-поисков самых известных достопримечательностей мира за последний месяц выросло на 20 процентов».</p>

                                <p><strong>Достопримечательности, которые люди хотят увидеть больше всего в мире:</strong></p>

                                <ol>
                                    <li>Бурдж-Халифа, ОАЭ — 66 стран.</li>
                                    <li>Эйфелева башня, Франция – 29 стран.</li>
                                    <li>Мачу-Пикчу, Перу — 19 стран.</li>
                                    <li>Биг-Бен, Великобритания — 11 стран.</li>
                                    <li>Тадж-Махал, Индия — 11 стран.</li>
                                    <li>Помпеи, Италия – 9 стран.</li>
                                    <li>Альгамбра, Испания — 5 стран.</li>
                                    <li>Нотр-Дам, Франция – 4 страны</li>
                                    <li>Стоунхендж, Великобритания — 4 страны</li>
                                    <li>Петра, Иордания – 3 страны</li>
                                    <li>Великая Китайская стена, Китай — 3 страны.</li>
                                </ol>
                            <?php } else { ?>
                                <p><strong>A new study from luxury travel company Kuoni reveals that the skyscraper is the most searched for landmark in the 66 countries analysed, which accounts for 37.5 per cent of the world, thus making it the most popular.</strong></p>

                                <p>It is the most Googled landmark in India, Switzerland and most of Africa, as well as Fiji, Indonesia and Turkmenistan. In the UAE, however, the most searched for landmark was India's Taj Mahal, which comes joint fourth in the study, with England's Big Ben.</p>

                                <p>The second most popular is France's Eiffel Tower, which ranked top in 29 counties including the UK, Ireland, Canada and Australia. In third place is Machu Picchu, which comes out top in 19 counties, including Mexico, Spain and Chile.</p>

                                <p>According to the study, "despite the ongoing pandemic, online searches for the world’s most famous landmarks have risen by 20 per cent over the past month."</p>

                                <p>The move should also be seen in the context of the UAE using ‘Golden’ and ‘Green’ visas targeted at various investor/professional profiles.</p>

                                <p><strong>Landmarks people want to see most around the world:</strong></p>

                                <ol>
                                    <li>Burj Khalifa, UAE – 66 countries</li>
                                    <li>Eiffel Tower, France – 29 countries</li>
                                    <li>Machu Picchu, Peru – 19 countries</li>
                                    <li>Big Ben, UK – 11 countries</li>
                                    <li>Taj Mahal, India – 11 countries</li>
                                    <li>Pompeii, Italy – 9 countries</li>
                                    <li>Alhambra, Spain – 5 countries</li>
                                    <li>Notre Dame, France – 4 countries</li>
                                    <li>Stonehenge, UK – 4 countries</li>
                                    <li>Petra, Jordan – 3 countries</li>
                                    <li>Great Wall of China, China – 3 countries</li>
                                </ol>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="close__popup"></div>
            </div>
        </div>
    </div>
</div>

<div class="fullpage__popup__overlay">
    <div class="fullpage__popup" id="quiz-popup">
        <div class="fullpage__popup__wrap flex">
            <div class="test__bg bg img">
                <img src="/img/residence-bg-min.png" srcset="/img/residence-bg-2x-min.png 2x" width="1920" height="1000" alt="<?php echo ($lang == 'ru' ? 'Пройди тест и выбери недвижимость!' : 'Take the test and pick up a property!'); ?>">
            </div>

            <div class="smooth__scroll">
                <form action="/send.php" method="post" class="f fullpage__popup__content wrap" novalidate>
                    <input type="hidden" name="form_id" value="quiz-form">
                    <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                    <input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source']; ?>">
                    <input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium']; ?>">
                    <input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign']; ?>">
                    <input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content']; ?>">

                    <div class="quiz__slider swiper">
                        <div class="swiper-wrapper">
                            <div class="quiz__slide quiz__slide___1 swiper-slide">
                                <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Какая услуга вас интересует?' : 'What service are you interested&nbsp;in?'); ?></h3>

                                <div class="quiz__content flex">
                                    <div class="quiz__left">
                                        <input type="radio" name="service" id="service-1" value="<?php echo ($lang == 'ru' ? 'Покупка недвижимости' : 'Buy a property'); ?>">

                                        <label class="quiz__answer quiz__answer__content flex" for="service-1">
                                            <p><?php echo ($lang == 'ru' ? 'Покупка недвижимости' : 'Buy a property'); ?></p>
                                        </label>

                                        <input type="radio" name="service" id="service-2" value="<?php echo ($lang == 'ru' ? 'Продажа недвижимости' : 'Sell a property'); ?>">

                                        <label class="quiz__answer quiz__answer__content flex" for="service-2">
                                            <p><?php echo ($lang == 'ru' ? 'Продажа недвижимости' : 'Sell a property'); ?></p>
                                        </label>

                                        <input type="radio" name="service" id="service-3" value="<?php echo ($lang == 'ru' ? 'Аренда недвижимости' : 'Rent a Property'); ?>">

                                        <label class="quiz__answer quiz__answer__content flex" for="service-3">
                                            <p><?php echo ($lang == 'ru' ? 'Аренда недвижимости' : 'Rent a Property'); ?></p>
                                        </label>
                                    </div>

                                    <div class="quiz__right">
                                        <div class="quiz__img img">
                                            <img src="/img/quiz-img-1-min.jpg" srcset="/img/quiz-img-1-2x-min.jpg 2x" width="780" height="475" alt="<?php echo ($lang == 'ru' ? 'Какая услуга вас интересует?' : 'What service are you interested in?'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="quiz__slide quiz__slide___2 swiper-slide">
                                <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Какая недвижимость вас интересует?' : 'What kind of property are you interested&nbsp;in?'); ?></h3>

                                <div class="quiz__content flex">
                                    <div class="quiz__left">
                                        <input type="radio" name="kind_of_property" id="kind-of-property-1" value="<?php echo ($lang == 'ru' ? 'Новая недвижимость' : 'Off plan Property'); ?>">

                                        <label class="quiz__answer quiz__answer__content flex" for="kind-of-property-1">
                                            <p><?php echo ($lang == 'ru' ? 'Новая недвижимость' : 'Off plan Property'); ?></p>
                                        </label>

                                        <input type="radio" id="kind-of-property-2" name="kind_of_property" value="<?php echo ($lang == 'ru' ? 'Вторичная недвижимость' : 'Secondary Property'); ?>">

                                        <label class="quiz__answer quiz__answer__content flex" for="kind-of-property-2">
                                            <p><?php echo ($lang == 'ru' ? 'Вторичная недвижимость' : 'Secondary Property'); ?></p>
                                        </label>
                                    </div>

                                    <div class="quiz__right">
                                        <div class="quiz__img img">
                                            <img src="/img/quiz-img-2-min.jpg" srcset="/img/quiz-img-2-2x-min.jpg 2x" width="780" height="475" alt="<?php echo ($lang == 'ru' ? 'Какая недвижимость вас интересует?' : 'What kind of property are you interested in?'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="quiz__slide quiz__slide___3 swiper-slide">
                                <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Какой тип недвижимости вас интересует?' : 'What type of property are you interested&nbsp;in?'); ?></h3>

                                <div class="quiz__content flex">
                                    <input type="radio" name="type_of_property" id="type-of-property-1" value="<?php echo ($lang == 'ru' ? 'Квартира' : 'Apartment'); ?>">

                                    <label class="quiz__answer" for="type-of-property-1">
                                        <span class="quiz__answer__img img">
                                            <img src="/img/quiz-img-3-1-min.jpg" srcset="/img/quiz-img-3-1-2x-min.jpg 2x" width="780" height="400" alt="<?php echo ($lang == 'ru' ? 'Квартира' : 'Apartment'); ?>">
                                        </span>

                                        <span class="quiz__answer__content flex">
                                            <p><?php echo ($lang == 'ru' ? 'Квартира' : 'Apartment'); ?></p>
                                        </span>
                                    </label>

                                    <input type="radio" name="type_of_property" id="type-of-property-2" value="<?php echo ($lang == 'ru' ? 'Вилла' : 'Villa'); ?>">

                                    <label class="quiz__answer" for="type-of-property-2">
                                        <span class="quiz__answer__img img">
                                            <img src="/img/quiz-img-3-2-min.jpg" srcset="/img/quiz-img-3-2-2x-min.jpg 2x" width="780" height="400" alt="<?php echo ($lang == 'ru' ? 'Вилла' : 'Villa'); ?>">
                                        </span>

                                        <span class="quiz__answer__content flex">
                                            <p><?php echo ($lang == 'ru' ? 'Вилла' : 'Villa'); ?></p>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="quiz__slide quiz__slide___4 swiper-slide">
                                <div class="quiz__slide__header flex">
                                    <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Какой район Дубая вы бы предпочли?' : 'Which district of Dubai would you prefer?'); ?></h3>

                                    <p class="quiz__subtitle"><?php echo ($lang == 'ru' ? 'Выберите один или несколько' : 'Select one or more'); ?></p>
                                </div>

                                <div class="quiz__content flex">
                                    <input type="checkbox" name="district[]" id="district-1" value="<?php echo ($lang == 'ru' ? 'Дубай Марина' : 'Dubai Marina'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="district-1">
                                        <p><?php echo ($lang == 'ru' ? 'Дубай Марина' : 'Dubai Marina'); ?></p>
                                    </label>

                                    <input type="checkbox" name="district[]" id="district-2" value="<?php echo ($lang == 'ru' ? 'Дубай Крик Харбор' : 'Dubai Creek Harbor'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="district-2">
                                        <p><?php echo ($lang == 'ru' ? 'Дубай Крик Харбор' : 'Dubai Creek Harbor'); ?></p>
                                    </label>

                                    <input type="checkbox" name="district[]" id="district-3" value="<?php echo ($lang == 'ru' ? 'Бизнес Бэй' : 'Business Bay'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="district-3">
                                        <p><?php echo ($lang == 'ru' ? 'Бизнес Бэй' : 'Business Bay'); ?></p>
                                    </label>

                                    <input type="checkbox" name="district[]" id="district-4" value="<?php echo ($lang == 'ru' ? 'Центр Дубая' : 'Downtown Dubai'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="district-4">
                                        <p><?php echo ($lang == 'ru' ? 'Центр Дубая' : 'Downtown Dubai'); ?></p>
                                    </label>

                                    <input type="checkbox" name="district[]" id="district-5" value="<?php echo ($lang == 'ru' ? 'Пальма Джумейра' : 'Palm Jumeirah'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="district-5">
                                        <p><?php echo ($lang == 'ru' ? 'Пальма Джумейра' : 'Palm Jumeirah'); ?></p>
                                    </label>

                                    <input type="checkbox" name="district[]" id="district-6" value="<?php echo ($lang == 'ru' ? 'Другие' : 'Others'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="district-6">
                                        <p><?php echo ($lang == 'ru' ? 'Другие' : 'Others'); ?></p>
                                    </label>
                                </div>
                            </div>

                            <div class="quiz__slide quiz__slide___5 swiper-slide">
                                <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Сколько спален вам нужно?' : 'How many bedrooms do you need?'); ?></h3>

                                <div class="quiz__slide__5__slider for__apartment">
                                    <div class="swiper">
                                        <div class="swiper-wrapper">
                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="apartment_number_of_bedrooms[]" id="apartment-number-of-bedrooms-1" value="<?php echo ($lang == 'ru' ? 'Студия' : 'Studio'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="apartment-number-of-bedrooms-1">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/quiz-img-5-1-min.png" srcset="/img/quiz-img-5-1-2x-min.png 2x" width="288" height="420" alt="<?php echo ($lang == 'ru' ? 'Студия' : 'Studio'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? 'Студия' : 'Studio'); ?></p>
                                                </label>
                                            </div>

                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="apartment_number_of_bedrooms[]" id="apartment-number-of-bedrooms-2" value="<?php echo ($lang == 'ru' ? '1 Спальня' : '1 Bedroom'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="apartment-number-of-bedrooms-2">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/quiz-img-5-2-min.png" srcset="/img/quiz-img-5-2-2x-min.png 2x" width="288" height="420" alt="<?php echo ($lang == 'ru' ? '1 Спальня' : '1 Bedroom'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? '1 Спальня' : '1 Bedroom'); ?></p>
                                                </label>
                                            </div>

                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="apartment_number_of_bedrooms[]" id="apartment-number-of-bedrooms-3" value="<?php echo ($lang == 'ru' ? '2 Спальни' : '2 Bedroom'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="apartment-number-of-bedrooms-3">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/quiz-img-5-3-min.png" srcset="/img/quiz-img-5-3-2x-min.png 2x" width="288" height="420" alt="<?php echo ($lang == 'ru' ? '2 Спальни' : '2 Bedroom'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? '2 Спальни' : '2 Bedroom'); ?></p>
                                                </label>
                                            </div>

                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="apartment_number_of_bedrooms[]" id="apartment-number-of-bedrooms-4" value="<?php echo ($lang == 'ru' ? '3 Спальни' : '3 Bedroom'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="apartment-number-of-bedrooms-4">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/quiz-img-5-4-min.png" srcset="/img/quiz-img-5-4-2x-min.png 2x" width="288" height="420" alt="<?php echo ($lang == 'ru' ? '3 Спальни' : '3 Bedroom'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? '3 Спальни' : '3 Bedroom'); ?></p>
                                                </label>
                                            </div>

                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="apartment_number_of_bedrooms[]" id="apartment-number-of-bedrooms-5" value="<?php echo ($lang == 'ru' ? 'Более 3 Спален' : '5 Bedroom and up'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="apartment-number-of-bedrooms-5">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/quiz-img-5-5-min.png" srcset="/img/quiz-img-5-5-2x-min.png 2x" width="288" height="420" alt="<?php echo ($lang == 'ru' ? 'Более 3 Спален' : '5 Bedroom and up'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? 'Более 3 Спален' : '5 Bedroom and up'); ?></p>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="swiper__nav">
                                            <a class="swiper__prev"></a>
                                            <a class="swiper__next"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="quiz__slide__5__slider for__villa">
                                    <div class="swiper">
                                        <div class="swiper-wrapper">
                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="villa_number_of_bedrooms[]" id="villa-number-of-bedrooms-1" value="<?php echo ($lang == 'ru' ? '3 Спальни' : '3 Bedroom'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="villa-number-of-bedrooms-1">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/3Bedroom-min.jpg" alt="<?php echo ($lang == 'ru' ? '3 Спальни' : '3 Bedroom'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? '3 Спальни' : '3 Bedroom'); ?></p>
                                                </label>
                                            </div>

                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="villa_number_of_bedrooms[]" id="villa-number-of-bedrooms-2" value="<?php echo ($lang == 'ru' ? '4 Спальни' : '4 Bedroom'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="villa-number-of-bedrooms-2">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/4Bedroom-min.jpg" alt="<?php echo ($lang == 'ru' ? '4 Спальни' : '4 Bedroom'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? '4 Спальни' : '4 Bedroom'); ?></p>
                                                </label>
                                            </div>

                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="villa_number_of_bedrooms[]" id="villa-number-of-bedrooms-3" value="<?php echo ($lang == 'ru' ? '5 Спален' : '5 Bedroom'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="villa-number-of-bedrooms-3">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/5Bedroom-min.jpg" alt="<?php echo ($lang == 'ru' ? '5 Спален' : '5 Bedroom'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? '5 Спален' : '5 Bedroom'); ?></p>
                                                </label>
                                            </div>

                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="villa_number_of_bedrooms[]" id="villa-number-of-bedrooms-4" value="<?php echo ($lang == 'ru' ? '6 Спален' : '6 Bedroom'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="villa-number-of-bedrooms-4">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/6Bedroom-min.jpg" alt="<?php echo ($lang == 'ru' ? '6 Спален' : '6 Bedroom'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? '6 Спален' : '6 Bedroom'); ?></p>
                                                </label>
                                            </div>

                                            <div class="quiz__slide__5__slide swiper-slide">
                                                <input type="checkbox" name="villa_number_of_bedrooms[]" id="villa-number-of-bedrooms-5" value="<?php echo ($lang == 'ru' ? '7 Спален и более' : '7 Bedroom and up'); ?>">

                                                <label class="quiz__slide__5__slide__content flex" for="villa-number-of-bedrooms-5">
                                                    <span class="quiz__slide__5__slide__img center__flex flex">
                                                        <img src="/img/7Bedroom-min.jpg" alt="<?php echo ($lang == 'ru' ? '7 Спален и более' : '7 Bedroom and up'); ?>">
                                                    </span>

                                                    <p class="quiz__slide__5__slide__title"><?php echo ($lang == 'ru' ? '7 Спален и более' : '7 Bedroom and up'); ?></p>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="swiper__nav">
                                            <a class="swiper__prev"></a>
                                            <a class="swiper__next"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="quiz__slide quiz__slide___6 swiper-slide">
                                <div class="quiz__slide__header flex">
                                    <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Какой размер квартиры/дома вы бы предпочли?' : 'What size of apartment/house would you prefer?'); ?></h3>

                                    <p class="quiz__subtitle"><?php echo ($lang == 'ru' ? 'Выберите один или несколько' : 'Select one or more'); ?></p>
                                </div>

                                <div class="quiz__content for__apartment flex">
                                    <input type="checkbox" name="apartment_size[]" id="apartment-size-1" value="<?php echo ($lang == 'ru' ? '300 sqft – 700 sqft' : '300 sqft – 700 sqft'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="apartment-size-1">
                                        <p><?php echo ($lang == 'ru' ? '300 sqft – 700 sqft' : '300 sqft – 700 sqft'); ?></p>
                                    </label>

                                    <input type="checkbox" name="apartment_size[]" id="apartment-size-2" value="<?php echo ($lang == 'ru' ? '750 sqft – 1,300 sqft' : '750 sqft – 1,300 sqft'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="apartment-size-2">
                                        <p><?php echo ($lang == 'ru' ? '750 sqft – 1,300 sqft' : '750 sqft – 1,300 sqft'); ?></p>
                                    </label>

                                    <input type="checkbox" name="apartment_size[]" id="apartment-size-3" value="<?php echo ($lang == 'ru' ? '1,350 sqft – 2,000 sqft' : '1,350 sqft – 2,000 sqft'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="apartment-size-3">
                                        <p><?php echo ($lang == 'ru' ? '1,350 sqft – 2,000 sqft' : '1,350 sqft – 2,000 sqft'); ?></p>
                                    </label>

                                    <input type="checkbox" name="apartment_size[]" id="apartment-size-4" value="<?php echo ($lang == 'ru' ? '3,000 sqft. and up' : '3,000 sqft. and up'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="apartment-size-4">
                                        <p><?php echo ($lang == 'ru' ? '3,000 sqft. and up' : '3,000 sqft. and up'); ?></p>
                                    </label>
                                </div>

                                <div class="quiz__content for__villa flex">
                                    <input type="checkbox" name="villa_size[]" id="villa-size-1" value="<?php echo ($lang == 'ru' ? '1,000 sqft – 3,000 sqft' : '1,000 sqft – 3,000 sqft'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="villa-size-1">
                                        <p><?php echo ($lang == 'ru' ? '1,000 sqft – 3,000 sqft' : '1,000 sqft – 3,000 sqft'); ?></p>
                                    </label>

                                    <input type="checkbox" name="villa_size[]" id="villa-size-2" value="<?php echo ($lang == 'ru' ? '3,500 sqft. – 5,000 sqft' : '3,500 sqft. – 5,000 sqft'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="villa-size-2">
                                        <p><?php echo ($lang == 'ru' ? '3,500 sqft. – 5,000 sqft' : '3,500 sqft. – 5,000 sqft'); ?></p>
                                    </label>

                                    <input type="checkbox" name="villa_size[]" id="villa-size-3" value="<?php echo ($lang == 'ru' ? '5,500 sqft – 7,000 sqft' : '5,500 sqft – 7,000 sqft'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="villa-size-3">
                                        <p><?php echo ($lang == 'ru' ? '5,500 sqft – 7,000 sqft' : '5,500 sqft – 7,000 sqft'); ?></p>
                                    </label>

                                    <input type="checkbox" name="villa_size[]" id="villa-size-4" value="<?php echo ($lang == 'ru' ? '7,500 sqft and up' : '7,500 sqft and up'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="villa-size-4">
                                        <p><?php echo ($lang == 'ru' ? '7,500 sqft and up' : '7,500 sqft and up'); ?></p>
                                    </label>
                                </div>
                            </div>

                            <div class="quiz__slide quiz__slide___7 swiper-slide">
                                <div class="quiz__slide__header flex">
                                    <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Какой у вас примерно бюджет?' : 'What is your budget approx?'); ?></h3>

                                    <p class="quiz__subtitle"><?php echo ($lang == 'ru' ? 'Выберите один или несколько' : 'Select one or more'); ?></p>
                                </div>

                                <div class="quiz__content flex">
                                    <input type="checkbox" name="budget[]" id="budget-1" value="<?php echo ($lang == 'ru' ? '300.000 - 500.000 ЕВРО' : 'EUR 300,000 - 500,000'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="budget-1">
                                        <p><?php echo ($lang == 'ru' ? '300.000 - 500.000 ЕВРО' : 'EUR 300,000 - 500,000'); ?></p>
                                    </label>

                                    <input type="checkbox" name="budget[]" id="budget-2" value="<?php echo ($lang == 'ru' ? '500.000 - 750.000 евро' : 'EUR 500,000 - 750,000'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="budget-2">
                                        <p><?php echo ($lang == 'ru' ? '500.000 - 750.000 евро' : 'EUR 500,000 - 750,000'); ?></p>
                                    </label>

                                    <input type="checkbox" name="budget[]" id="budget-3" value="<?php echo ($lang == 'ru' ? '750.000 - 1.000.000 ЕВРО' : 'EUR 750,000 - 1,000,000'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="budget-3">
                                        <p><?php echo ($lang == 'ru' ? '750.000 - 1.000.000 ЕВРО' : 'EUR 750,000 - 1,000,000'); ?></p>
                                    </label>

                                    <input type="checkbox" name="budget[]" id="budget-4" value="<?php echo ($lang == 'ru' ? '1.000.000 - 3.000.000 ЕВРО' : 'EUR 1,000,000 - 3,000,000'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="budget-4">
                                        <p><?php echo ($lang == 'ru' ? '1.000.000 - 3.000.000 ЕВРО' : 'EUR 1,000,000 - 3,000,000'); ?></p>
                                    </label>

                                    <input type="checkbox" name="budget[]" id="budget-5" value="<?php echo ($lang == 'ru' ? 'Более 3.000.000 ЕВРО' : 'More than EUR 3,000,000'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="budget-5">
                                        <p><?php echo ($lang == 'ru' ? 'Более 3.000.000 ЕВРО' : 'More than EUR 3,000,000'); ?></p>
                                    </label>
                                </div>
                            </div>

                            <div class="quiz__slide quiz__slide___8 swiper-slide">
                                <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Какова ваша цель покупки недвижимости?' : 'What is your purpose of buying a property?'); ?></h3>

                                <div class="quiz__content flex">
                                    <input type="radio" name="purpose" id="purpose-1" value="<?php echo ($lang == 'ru' ? 'Для личного использования' : 'For Personal Use'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="purpose-1">
                                        <p><?php echo ($lang == 'ru' ? 'Для личного использования' : 'For Personal Use'); ?></p>
                                    </label>

                                    <input type="radio" name="purpose" id="purpose-2" value="<?php echo ($lang == 'ru' ? 'Для инвестиций' : 'For Investment'); ?>">

                                    <label class="quiz__answer quiz__answer__content flex" for="purpose-2">
                                        <p><?php echo ($lang == 'ru' ? 'Для инвестиций' : 'For Investment'); ?></p>
                                    </label>
                                </div>
                            </div>

                            <div class="quiz__slide quiz__form__slide swiper-slide">
                                <h3 class="quiz__title title"><?php echo ($lang == 'ru' ? 'Пожалуйста, укажите ваши контактные данные' : 'Please provide your contact detailes'); ?></h3>

                                <p class="quiz__subtitle"><?php echo ($lang == 'ru' ? 'Мы вышлем вам доступные варианты' : 'We will send you available options'); ?></p>

                                <div class="quiz__slide__form">
                                    <input type="text" name="first_name" class="required" placeholder="<?php echo ($lang == 'ru' ? 'Имя' : 'First Name'); ?>">

                                    <input type="text" name="last_name" class="required" placeholder="<?php echo ($lang == 'ru' ? 'Фамилия' : 'Last Name'); ?>">
                                    
                                    <input type="email" name="email" class="required" placeholder="Email">

                                    <div class="phone__number__wrap">
                                        <input type="tel" name="phone_number" class="required" placeholder="<?php echo ($lang == 'ru' ? 'Телефон' : 'Phone Number'); ?>">

                                        <?php echo $country_select; ?>
                                    </div>

                                    <label class="form__footnote flex">
                                        <input type="checkbox" name="privacy_policy" checked>

                                        <p><?php echo ($lang == 'ru' ? 'Я прочитал и&nbsp;принял <a href="/Privacy_policy_en.pdf" target="_blank" rel="nofollow">Политику конфиденциальности</a>' : 'I have read and accepted the&nbsp;<a href="/Privacy_policy_en.pdf" target="_blank" rel="nofollow">Privacy Policy</a>'); ?></p>
                                    </label>

                                    <input type="submit" class="btn" value="<?php echo ($lang == 'ru' ? 'ОТПРАВИТЬ ЗАПРОС' : 'SEND A REQUEST'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="quiz__thank__you wrap flex">
                        <div class="quiz__thank__you__bg bg img">
                            <img src="/img/thank-you-bg-min.jpg" srcset="img/thank-you-bg-2x-min.jpg 2x" width="" height="" alt="<?php echo ($lang == 'ru' ? 'Спасибо!' : 'Thank You!'); ?>">
                        </div>

                        <h2 class="quiz__thank__you__title"><?php echo ($lang == 'ru' ? 'Спасибо!' : 'Thank You!'); ?></h2>

                        <p class="quiz__thank__you__subtitle"><?php echo ($lang == 'ru' ? 'Мы свяжемся с вами в ближайшее время' : 'We will contact you soon'); ?></p>
                    </div>

                    <div class="close__popup"></div>
                </form>
            </div>

            <div class="quiz__footer wrap flex">
                <div class="quiz__footer__left">
                    <div class="quiz__count flex">
                        <p class="quiz__count__label"><?php echo ($lang == 'ru' ? 'Выполнено' : 'Progress'); ?>:</p>

                        <p class="quiz__count__value"><span class="from">1</span>/<span class="to">8</span></p>
                    </div>

                    <div class="quiz__pagination swiper-pagination"></div>
                </div>

                <div class="quiz__nav flex">
                    <a class="quiz__prev center__flex flex"><svg width="33" height="16" viewBox="0 0 33 16" xmlns="http://www.w3.org/2000/svg"><path d="M0.292892 7.29289C-0.0976295 7.68342 -0.0976295 8.31658 0.292892 8.70711L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928932C7.68054 0.538408 7.04738 0.538408 6.65685 0.928932L0.292892 7.29289ZM33 7L1 7V9L33 9V7Z"/></svg></a>

                    <a class="quiz__next btn"><?php echo ($lang == 'ru' ? 'ДАЛЬШЕ' : 'NEXT'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

</div><!-- End Overflow -->

<script>
    var lang = '<?php echo $lang; ?>';
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/js/swiper-bundle.min.js"></script>
<script src="/js/smooth-scrollbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="/js/script.min.js"></script>

</body>
</html>