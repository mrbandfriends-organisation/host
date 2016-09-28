<?php

function esc_html( $text ) {
	return $text;
}

function esc_attr( $text ) {
	return str_replace('"', "&quot;", $text);
}

// https://codex.wordpress.org/Function_Reference/_e
function _e( $text, $domain ) {
	echo __($text, $domain);
}

// https://codex.wordpress.org/Function_Reference/esc_html_e
function esc_html_e( $text, $domain ) {
	echo $text;
}

function antispambot( $email, $hex_encoding=0) {
	return $email;
}

function wp_kses ($string, $allowed_html, $allowed_protocols = ['http', 'https']) {
	return html_entity_decode($string);
}

// https://codex.wordpress.org/Function_Reference/_e
function __( $text, $domain ) {
	if (empty($domain)) {
		throw new Exception("Please provide the correct text domain for this site. Ask the Lead Dev");
	}
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// https://codex.wordpress.org/Function_Reference/esc_attr_e
function esc_attr__( $text, $domain ) {
	if (empty($domain)) {
		throw new Exception("Please provide the correct text domain for this site. Ask the Lead Dev");
	}
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// https://codex.wordpress.org/Function_Reference/esc_attr_e
function esc_attr_e( $text, $domain ) {
	echo esc_attr__( $text, $domain );
}

// https://codex.wordpress.org/Function_Reference/esc_url
function esc_url($url) {
	echo $url;
}

/**
 * Gets list of months between two dates
 * @param  int $start Unix timestamp
 * @param  int $end Unix timestamp
 * @return array
 */
function month_between_dates( $start, $end, $format="F Y" ){

	$rtn = [];

	$date1 = new DateTime( $start );
	$date1->modify('first day of this month');

	$date2 = new DateTime( $end );
	$date2->modify('first day of next month');

	$interval = DateInterval::createFromDateString('1 month');
	$period  = new DatePeriod($date1, $interval, $date2);

	foreach ($period as $dt) {
	    array_push( $rtn, $dt->format( $format ) );
	}

	return $rtn;
}

function get_countries() {

	return array(
		"United States"                                => "us",
		"Spain"                                        => "es",
		"Italy"                                        => "it",
		"France"                                       => "fr",
		"United Kingdom"                               => "gb",
		"-----"										   => "",
		"Afghanistan"                                  => "af",
		"Albania"                                      => "al",
		"Algeria"                                      => "dz",
		"American Samoa"                               => "as",
		"Andorra"                                      => "ad",
		"Angola"                                       => "ad",
		"Anguilla"                                     => "ai",
		"Antarctica"                                   => "aq",
		"Antigua and Barbuda"                          => "ag",
		"Argentina"                                    => "ar",
		"Armenia"                                      => "am",
		"Aruba"                                        => "aw",
		"Australia"                                    => "au",
		"Austria"                                      => "at",
		"Azerbaijan"                                   => "az",
		"Bahamas"                                      => "bs",
		"Bahrain"                                      => "bh",
		"Bangladesh"                                   => "bd",
		"Barbados"                                     => "bb",
		"Belarus"                                      => "by",
		"Belgium"                                      => "be",
		"Belize"                                       => "bz",
		"Benin"                                        => "bj",
		"Bermuda"                                      => "bm",
		"Bhutan"                                       => "bt",
		"Bolivia"                                      => "bo",
		"Bosnia and Herzegowina"                       => "ba",
		"Botswana"                                     => "bw",
		"Bouvet Island"                                => "bv",
		"Brazil"                                       => "br",
		"British Indian Ocean Territory"               => "io",
		"Brunei Darussalam"                            => "bn",
		"Bulgaria"                                     => "bg",
		"Burkina Faso"                                 => "bf",
		"Burundi"                                      => "bi",
		"Cambodia"                                     => "kh",
		"Cameroon"                                     => "cm",
		"Canada"                                       => "ca",
		"Cabo Verde"                                   => "cv",
		"Cayman Islands"                               => "ky",
		"Central African Republic"                     => "cf",
		"Chad"                                         => "td",
		"Chile"                                        => "cl",
		"China"                                        => "cn",
		"Christmas Island"                             => "cx",
		"Cocos (Keeling) Islands"                      => "cc",
		"Colombia"                                     => "co",
		"Comoros"                                      => "km",
		"Congo"                                        => "cg",
		"Congo, the Democratic Republic of the"        => "cd",
		"Cook Islands"                                 => "ck",
		"Costa Rica"                                   => "cr",
		"Cote d'Ivoire"                                => "ci",
		"Croatia (Hrvatska)"                           => "hr",
		"Cuba"                                         => "cu",
		"Cyprus"                                       => "cy",
		"Czech Republic"                               => "cz",
		"Denmark"                                      => "dk",
		"Djibouti"                                     => "dj",
		"Dominica"                                     => "dm",
		"Dominican Republic"                           => "do",
		"East Timor"                                   => "tl",
		"Ecuador"                                      => "ec",
		"Egypt"                                        => "eg",
		"El Salvador"                                  => "sv",
		"Equatorial Guinea"                            => "gq",
		"Eritrea"                                      => "er",
		"Estonia"                                      => "ee",
		"Ethiopia"                                     => "et",
		"Falkland Islands (Malvinas)"                  => "fk",
		"Faroe Islands"                                => "fo",
		"Fiji"                                         => "fj",
		"Finland"                                      => "fi",
		"French Guiana"                                => "gf",
		"French Polynesia"                             => "pf",
		"French Southern Territories"                  => "tf",
		"Gabon"                                        => "ga",
		"Gambia"                                       => "gm",
		"Georgia"                                      => "ge",
		"Germany"                                      => "de",
		"Ghana"                                        => "gh",
		"Gibraltar"                                    => "gi",
		"Greece"                                       => "gr",
		"Greenland"                                    => "gl",
		"Grenada"                                      => "gd",
		"Guadeloupe"                                   => "gp",
		"Guam"                                         => "gu",
		"Guatemala"                                    => "gt",
		"Guinea"                                       => "gn",
		"Guinea-Bissau"                                => "gw",
		"Guyana"                                       => "gy",
		"Haiti"                                        => "ht",
		"Heard and Mc Donald Islands"                  => "hm",
		"Holy See (Vatican City State)"                => "va",
		"Honduras"                                     => "hn",
		"Hong Kong"                                    => "hk",
		"Hungary"                                      => "hu",
		"Iceland"                                      => "is",
		"India"                                        => "in",
		"Indonesia"                                    => "id",
		"Iran (Islamic Republic of)"                   => "ir",
		"Iraq"                                         => "iq",
		"Ireland"                                      => "ie",
		"Israel"                                       => "il",
		"Jamaica"                                      => "jm",
		"Japan"                                        => "jp",
		"Jordan"                                       => "jo",
		"Kazakhstan"                                   => "kz",
		"Kenya"                                        => "ke",
		"Kiribati"                                     => "ki",
		"Korea, Democratic People's Republic of"       => "kp",
		"Korea, Republic of"                           => "kr",
		"Kuwait"                                       => "kw",
		"Kyrgyzstan"                                   => "kg",
		"Lao, People's Democratic Republic"            => "la",
		"Latvia"                                       => "lv",
		"Lebanon"                                      => "lb",
		"Lesotho"                                      => "ls",
		"Liberia"                                      => "lr",
		"Libyan Arab Jamahiriya"                       => "ly",
		"Liechtenstein"                                => "li",
		"Lithuania"                                    => "lt",
		"Luxembourg"                                   => "lu",
		"Macao"                                        => "mo",
		"Macedonia, The Former Yugoslav Republic of"   => "mk",
		"Madagascar"                                   => "mg",
		"Malawi"                                       => "mw",
		"Malaysia"                                     => "my",
		"Maldives"                                     => "mv",
		"Mali"                                         => "ml",
		"Malta"                                        => "mt",
		"Marshall Islands"                             => "mh",
		"Martinique"                                   => "mq",
		"Mauritania"                                   => "mr",
		"Mauritius"                                    => "mu",
		"Mayotte"                                      => "yt",
		"Mexico"                                       => "mx",
		"Micronesia, Federated States of"              => "fm",
		"Moldova, Republic of"                         => "md",
		"Monaco"                                       => "mc",
		"Mongolia"                                     => "mn",
		"Montserrat"                                   => "ms",
		"Morocco"                                      => "ma",
		"Mozambique"                                   => "mz",
		"Myanmar"                                      => "mm",
		"Namibia"                                      => "na",
		"Nauru"                                        => "nr",
		"Nepal"                                        => "np",
		"Netherlands"                                  => "nl",
		"Netherlands Antilles"                         => "an",
		"New Caledonia"                                => "nc",
		"New Zealand"                                  => "nz",
		"Nicaragua"                                    => "ni",
		"Niger"                                        => "ne",
		"Nigeria"                                      => "ng",
		"Niue"                                         => "nu",
		"Norfolk Island"                               => "nf",
		"Northern Mariana Islands"                     => "mp",
		"Norway"                                       => "no",
		"Oman"                                         => "om",
		"Pakistan"                                     => "pk",
		"Palau"                                        => "pw",
		"Panama"                                       => "pa",
		"Papua New Guinea"                             => "pg",
		"Paraguay"                                     => "py",
		"Peru"                                         => "pe",
		"Philippines"                                  => "ph",
		"Pitcairn"                                     => "pn",
		"Poland"                                       => "pl",
		"Portugal"                                     => "pt",
		"Puerto Rico"                                  => "pr",
		"Qatar"                                        => "qa",
		"Reunion"                                      => "re",
		"Romania"                                      => "ro",
		"Russian Federation"                           => "ru",
		"Rwanda"                                       => "rw",
		"Saint Kitts and Nevis"                        => "kn",
		"Saint Lucia"                                  => "lc",
		"Saint Vincent and the Grenadines"             => "vc",
		"Samoa"                                        => "ws",
		"San Marino"                                   => "sm",
		"Sao Tome and Principe"                        => "st",
		"Saudi Arabia"                                 => "sa",
		"Senegal"                                      => "sn",
		"Seychelles"                                   => "sc",
		"Sierra Leone"                                 => "sl",
		"Singapore"                                    => "sg",
		"Slovakia (Slovak Republic)"                   => "sk",
		"Slovenia"                                     => "si",
		"Solomon Islands"                              => "sb",
		"Somalia"                                      => "so",
		"South Africa"                                 => "za",
		"South Georgia and the South Sandwich Islands" => "gs",
		"Sri Lanka"                                    => "lk",
		"St. Helena"                                   => "sh",
		"St. Pierre and Miquelon"                      => "pm",
		"Sudan"                                        => "sd",
		"Suriname"                                     => "sr",
		"Svalbard and Jan Mayen Islands"               => "sj",
		"Swaziland"                                    => "sz",
		"Sweden"                                       => "se",
		"Switzerland"                                  => "ch",
		"Syrian Arab Republic"                         => "sy",
		"Taiwan, Province of China"                    => "tw",
		"Tajikistan"                                   => "tj",
		"Tanzania, United Republic of"                 => "tz",
		"Thailand"                                     => "th",
		"Togo"                                         => "tg",
		"Tokelau"                                      => "tk",
		"Tonga"                                        => "to",
		"Trinidad and Tobago"                          => "tt",
		"Tunisia"                                      => "tn",
		"Turkey"                                       => "tr",
		"Turkmenistan"                                 => "tm",
		"Turks and Caicos Islands"                     => "tc",
		"Tuvalu"                                       => "tv",
		"Uganda"                                       => "ug",
		"Ukraine"                                      => "ua",
		"United Arab Emirates"                         => "ae",
		"United States Minor Outlying Islands"         => "um",
		"Uruguay"                                      => "uy",
		"Uzbekistan"                                   => "uz",
		"Vanuatu"                                      => "vu",
		"Venezuela"                                    => "ve",
		"Vietnam"                                      => "vn",
		"Virgin Islands (British)"                     => "vg",
		"Virgin Islands (U.S.)"                        => "vi",
		"Wallis and Futuna Islands"                    => "wf",
		"Western Sahara"                               => "eh",
		"Yemen"                                        => "ye",
		"Serbia"                                       => "yu",
		"Zambia"                                       => "zm",
		"Zimbabwe"                                     => "zw"
	);
}


function get_nationalities() {
	return array(
        'Afghan',
        'Albanian',
        'Algerian',
        'American',
        'Andorran',
        'Angolan',
        'Antiguans',
        'Argentinean',
        'Armenian',
        'Australian',
        'Austrian',
        'Azerbaijani',
        'Bahamian',
        'Bahraini',
        'Bangladeshi',
        'Barbadian',
        'Barbudans',
        'Batswana',
        'Belarusian',
        'Belgian',
        'Belizean',
        'Beninese',
        'Bhutanese',
        'Bolivian',
        'Bosnian',
        'Brazilian',
        'British',
        'Bruneian',
        'Bulgarian',
        'Burkinabe',
        'Burmese',
        'Burundian',
        'Cambodian',
        'Cameroonian',
        'Canadian',
        'Cape Verdean',
        'Central African',
        'Chadian',
        'Chilean',
        'Chinese',
        'Colombian',
        'Comoran',
        'Congolese',
        'Costa Rican',
        'Croatian',
        'Cuban',
        'Cypriot',
        'Czech',
        'Danish',
        'Djibouti',
        'Dominican',
        'Dutch',
        'East Timorese',
        'Ecuadorean',
        'Egyptian',
        'Emirian',
        'Equatorial Guinean',
        'Eritrean',
        'Estonian',
        'Ethiopian',
        'Fijian',
        'Filipino',
        'Finnish',
        'French',
        'Gabonese',
        'Gambian',
        'Georgian',
        'German',
        'Ghanaian',
        'Greek',
        'Grenadian',
        'Guatemalan',
        'Guinea-Bissauan',
        'Guinean',
        'Guyanese',
        'Haitian',
        'Herzegovinian',
        'Honduran',
        'Hungarian',
        'I-Kiribati',
        'Icelander',
        'Indian',
        'Indonesian',
        'Iranian',
        'Iraqi',
        'Irish',
        'Israeli',
        'Italian',
        'Ivorian',
        'Jamaican',
        'Japanese',
        'Jordanian',
        'Kazakhstani',
        'Kenyan',
        'Kittian and Nevisian',
        'Kuwaiti',
        'Kyrgyz',
        'Laotian',
        'Latvian',
        'Lebanese',
        'Liberian',
        'Libyan',
        'Liechtensteiner',
        'Lithuanian',
        'Luxembourger',
        'Macedonian',
        'Malagasy',
        'Malawian',
        'Malaysian',
        'Maldivan',
        'Malian',
        'Maltese',
        'Marshallese',
        'Mauritanian',
        'Mauritian',
        'Mexican',
        'Micronesian',
        'Moldovan',
        'Monacan',
        'Mongolian',
        'Moroccan',
        'Mosotho',
        'Motswana',
        'Mozambican',
        'Namibian',
        'Nauruan',
        'Nepalese',
        'New Zealander',
        'Nicaraguan',
        'Nigerian',
        'Nigerien',
        'North Korean',
        'Northern Irish',
        'Norwegian',
        'Omani',
        'Pakistani',
        'Palauan',
        'Panamanian',
        'Papua New Guinean',
        'Paraguayan',
        'Peruvian',
        'Polish',
        'Portuguese',
        'Qatari',
        'Romanian',
        'Russian',
        'Rwandan',
        'Saint Lucian',
        'Salvadoran',
        'Samoan',
        'San Marinese',
        'Sao Tomean',
        'Saudi',
        'Scottish',
        'Senegalese',
        'Serbian',
        'Seychellois',
        'Sierra Leonean',
        'Singaporean',
        'Slovakian',
        'Slovenian',
        'Solomon Islander',
        'Somali',
        'South African',
        'South Korean',
        'Spanish',
        'Sri Lankan',
        'Sudanese',
        'Surinamer',
        'Swazi',
        'Swedish',
        'Swiss',
        'Syrian',
        'Taiwanese',
        'Tajik',
        'Tanzanian',
        'Thai',
        'Togolese',
        'Tongan',
        'Trinidadian/Tobagonian',
        'Tunisian',
        'Turkish',
        'Tuvaluan',
        'Ugandan',
        'Ukrainian',
        'Uruguayan',
        'Uzbekistani',
        'Venezuelan',
        'Vietnamese',
        'Welsh',
        'Yemenite',
        'Zambian',
        'Zimbabwean'
	);
}

function allowed_kses_markup () {
		return array(
				'a' => array(
						'href' => array()
				),
				'img'	=> array(
						'src' => array(),
						'srcset' => array(),
						'alt' => array(),
				),
				'p'	=> array(
				),
				'table'	=> array(
				),
				'tr'	=> array(
				),
				'td'	=> array(
				),
				'th'	=> array(
				),
		);
}

function generate_row_group_pricelist_tutition($hide_rows = "", $alt_row_group = "") {

    $row_group = array();

    if ($alt_row_group != null) {
        $number_of_rows = 2;
    }
    else {
        $number_of_rows = 3;
    }

    for ($i = 0; $i < $number_of_rows; $i++) {

        // Course Number
        $course_number       = rand(10, 30);
        $course_number_round = round($course_number, -1);

        // Total Number Hours
        $time = array(
            15,
            20,
            25,
            30
        );
        $time_key = array_rand($time);


        // Time
        $hours = array(
            "08:45 - 12:00",
            "12:05 - 15:15",
            "15:20 - 18:30",
        );
        $hours_key = array_rand($hours);


        // Adiitonal Hours
        if ($hide_rows == "hide-rows") {
            $additional_hours = '1 hour between ' . $hours[$hours_key];
        }
        else {
            $additional_hours = "";
        }


        // Hours Per Week
        $hours_per_week       = rand(40, 175);
        $hours_per_week_round = round($hours_per_week, -1);


        if ($alt_row_group != "alt_row_group") {
            // Array of data
            $row_group[] = array(
                'Course Name A' . $course_number_round,
                $time[$i],
                $hours[$hours_key],
                $additional_hours,
                $hours_per_week_round,
                $hours_per_week_round,
                $hours_per_week_round,
                $hours_per_week_round,
                $hours_per_week_round
            );
        }
        else {
            // Alt Array of data
            $row_group[] = array(
                'One to One',
                "",
                "",
                "",
                $hours_per_week_round,
                $hours_per_week_round,
                $hours_per_week_round,
                $hours_per_week_round,
                $hours_per_week_round
            );
        }
    }

    return $row_group;
}

function generate_row_group_pricelist_accomodation($number_of_rows = 3, $number_of_columns = 2) {

    $row_group = array();

    if ($number_of_rows == 3) {
        $number_of_rows = 3;
    }
    elseif ($number_of_rows == 7) {
        $number_of_rows = 7;
    }
    else {
        $number_of_rows = 6;
    }

    for ($i = 0; $i < $number_of_rows; $i++) {

        // Accommodation Fee Prices
        $accommodation_fee       	= rand(140, 250);
        $accommodation_fee_rounded 	= round($accommodation_fee, -1);


        // Additonal Fee
		$additonal_fee       	= rand(25, 40);
        $additonal_fee_rounded 	= round($additonal_fee, -1);


        // Transfer Prices
        $transfer_fee       	= rand(25, 105);
        $transfer_fee_rounded 	= round($transfer_fee, -1);

        //// Adiitonal Hours
        //if ($hide_rows == "hide-rows") {
        //    $additional_hours = '1 hour between ' . $hours[$hours_key];
        //}
        //else {
        //    $additional_hours = "";
        //}


        // Hours Per Week
        $hours_per_week       = rand(40, 175);
        $hours_per_week_round = round($hours_per_week, -1);


        if ($number_of_columns == 6) {
            // Array of data
            $row_group[] = array(
            	'Single Room',
                $accommodation_fee_rounded,
                $accommodation_fee_rounded,
                $accommodation_fee_rounded,
                $accommodation_fee_rounded,
                $accommodation_fee_rounded
            );
        }
        elseif($number_of_columns == 3){
        	$row_group[] = array(
				'Example Station',
				$transfer_fee_rounded,
				20
			);
        }
        else {
            // Alt Array of data
            $row_group[] = array(
                'Additional Fee',
                $transfer_fee_rounded
            );
        }
    }

    return $row_group;
}
