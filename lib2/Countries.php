<?php

/**
 * Klasa obsługująca listę krajów.
 * 
 * @author Przemysław Furtak <przemyslawf@gmail.com>
 * @version 0.1
 */

class Countries {
 
	/**
	 * Lista krajów
	 * 
	 * @var array
	 */
	private static $_aCountries = array (
		"PL" => "Polska",
		"AF" => "Afganistan",
		"AL" => "Albania",
		"DZ" => "Algieria",
		"AD" => "Andora",
		"AO" => "Angola",
		"AI" => "Anguilla",
		"AG" => "Antigua i Barbuda",
		"AN" => "Antyle Holenderskie",
		"SA" => "Arabia Saudyjska",
		"AR" => "Argentyna",
		"AM" => "Armenia",
		"AW" => "Aruba",
		"AU" => "Australia",
		"AT" => "Austria",
		"AZ" => "Azerbejdżan",
		"BS" => "Bahamy",
		"BH" => "Bahrajn",
		"BD" => "Bangladesz",
		"BB" => "Barbados",
		"BE" => "Belgia",
		"BZ" => "Belize",
		"BM" => "Bermuda",
		"BT" => "Bhutan",
		"BY" => "Białoruś",
		"BO" => "Boliwia",
		"BA" => "Bośnia i Hercegowina",
		"BW" => "Botswana",
		"BR" => "Brazylia",
		"BN" => "Brunei",
		"IO" => "Brytyjskie Terytorium Oceanu Indyjskiego",
		"BG" => "Bułgaria",
		"BF" => "Burkina Faso",
		"BI" => "Burundi",
		"CL" => "Chile",
		"CN" => "Chiny",
		"HR" => "Chorwacja",
		"CY" => "Cypr",
		"TD" => "Czad",
		"CG" => "Czarnogóra",
		"CZ" => "Czechy",
		"DK" => "Dania",
		"DM" => "Dominika",
		"DO" => "Dominikana",
		"DJ" => "Dżibuti",
		"EC" => "Ekwador",
		"EG" => "Egipt",
		"ER" => "Erytrea",
		"EE" => "Estonia",
		"ET" => "Etiopia",
		"FK" => "Falklandy",
		"FJ" => "Fidżi",
		"PH" => "Filipiny",
		"FI" => "Finlandia",
		"FR" => "Francja",
		"GA" => "Gabon",
		"GM" => "Gambia",
		"GS" => "Georgia Południowa i Sandwich Południowy",
		"GH" => "Ghana",
		"GI" => "Gibraltar",
		"GR" => "Grecja",
		"GL" => "Greenlandia",
		"GD" => "Grenada",
		"GE" => "Gruzja",
		"GU" => "Guam",
		"GBG" => "Guernsey",
		"GW" => "Guinea-Bissau",
		"GF" => "Gujana Francuska",
		"GY" => "Guyana",
		"GP" => "Gwadelupa",
		"GT" => "Gwatemala",
		"GN" => "Gwinea",
		"GQ" => "Gwinea Równikowa",
		"HT" => "Haiti",
		"ES" => "Hiszpania",
		"NL" => "Holandia",
		"HN" => "Honduras",
		"HK" => "Hongkong",
		"HU" => "Hungary",
		"IN" => "Indie",
		"ID" => "Indonezja",
		"IR" => "Iran",
		"IQ" => "Irak",
		"IE" => "Irlandia",
		"IS" => "Islandia",
		"IL" => "Izrael",
		"JM" => "Jamajka",
		"JP" => "Japonia",
		"YE" => "Jemen",
		"GBJ" => "Jersey",
		"JO" => "Jordania",
		"KY" => "Kajmany",
		"KH" => "Kambodża",
		"CM" => "Kamerun",
		"CA" => "Kanada",
		"QA" => "Katar",
		"KZ" => "Kazachstan",
		"KE" => "Kenia",
		"KI" => "Kiribati",
		"CO" => "Kolumbia",
		"KM" => "Komory",
		"CD" => "Kongo",
		"KP" => "Korea Północna",
		"KR" => "Korea Południowa",
		"CR" => "Kostaryka",
		"CU" => "Kuba",
		"KW" => "Kuwejt",
		"KG" => "Kirgistan",
		"LA" => "Laos",
		"LV" => "Łotwa",
		"LB" => "Liban",
		"LS" => "Lesotho",
		"LR" => "Liberia",
		"LY" => "Libia",
		"LI" => "Liechtenstein",
		"LT" => "Litwa",
		"LU" => "Luksemburg",
		"MO" => "Makau",
		"MK" => "Macedonia",
		"MG" => "Madagaskar",
		"MW" => "Malawi",
		"MV" => "Malediwy",
		"MY" => "Malezja",
		"ML" => "Mali",
		"MT" => "Malta",
		"MP" => "Mariany Północne",
		"MQ" => "Martynika",
		"MR" => "Mauretania",
		"MU" => "Mauritius",
		"YT" => "Majotta",
		"MX" => "Meksyk",
		"FM" => "Mikronezja",
		"MD" => "Mołdawia",
		"MC" => "Monako",
		"MN" => "Mongolia",
		"MS" => "Montserrat",
		"MA" => "Maroko",
		"MZ" => "Mozambik",
		"MM" => "Myanmar (Birma)",
		"NA" => "Namibia",
		"NR" => "Nauru",
		"NP" => "Nepal",
		"NZ" => "Nowa Zelandia",
		"DE" => "Niemcy",
		"NE" => "Niger",
		"NG" => "Nigeria",
		"NI" => "Nikaragua",
		"UN" => "Niue",
		"NF" => "Norfolk",
		"NO" => "Norwegia",
		"NC" => "Nowa Kaledonia",
		"OM" => "Oman",
		"PK" => "Pakistan",
		"PW" => "Palau",
		"PA" => "Panama",
		"PG" => "Papua-Nowa Gwinea",
		"PY" => "Paragwaj",
		"PE" => "Peru",
		"PR" => "Portoryko",
		"PT" => "Portugalia",
		"CF" => "Republika Środkowoafrykańska",
		"CV" => "Republika Zielonego Przylądka",
		"RE" => "Reunion",
		"RO" => "Rumunia",	
		"RU" => "Rosja",
		"ZA" => "RPA",
		"RW" => "Rwanda",
		"EH" => "Sahara Zachodnia",
		"KN" => "Saint Kitts i Nevis",
		"LC" => "Saint Lucia",	
		"PM" => "Saint-Pierre i Miquelon",
		"VC" => "Saint Vincent i Grenadyny",
		"SV" => "Salvador",
		"WS" => "Samoa",
		"AS" => "Samoa Amerykańskie",
		"SM" => "San Marino",
		"SN" => "Senegal",
		"YU" => "Serbia",
		"SC" => "Seszele",
		"SL" => "Sierra Leone",
		"SG" => "Singapur",
		"SK" => "Słowacja",
		"SI" => "Słowenia",
		"SO" => "Somalia",
		"LK" => "Sri Lanka",
		"VA" => "State of the Vatican City",
		"SD" => "Sudan",
		"DR" => "Surinam",
		"SZ" => "Szwajcaria",
		"SE" => "Szwecja",
		"SH" => "Święta Helena",
		"CH" => "Switzerland",
		"SY" => "Syria",
		"TJ" => "Tadżykistan",
		"TH" => "Tajlandia",
		"TW" => "Tajwan",
		"TZ" => "Tanzania",
		"TP" => "Timor Zachodni",
		"TG" => "Togo",
		"TK" => "Tokelau",	
		"TO" => "Tonga",
		"TN" => "Tunezja",
		"TR" => "Turcja",
		"TM" => "Turkmenistan",
		"TC" => "Turks i Caicos",
		"TV" => "Tuvalu",	
		"TT" => "Trynidad i Tobago",
		"UG" => "Uganda",
		"UA" => "Ukraina",
		"UY" => "Urugwaj",
		"UZ" => "Uzbekistan",
		"US" => "USA",	
		"VU" => "Vanuatu",
		"VE" => "Venezuela",
		"VN" => "Wietnam",
		"WF" => "Wallis i Futuna",
//		"UK" => "Wielka Brytania",
      "EN" => "Wielka Brytania",
		"IT" => "Włochy",
		"CI" => "Wybrzeże Kości Słoniowej",
		"AX" => "Wyspy Alandzkie",
		"BV" => "Wyspa Bouveta",
		"CX" => "Wyspa Bożego Narodzenia",
		"CK" => "Wyspy Cooka",
		"VG" => "Wyspy Dziewicze (Brytyjskie)",
		"VI" => "Wyspy Dziewicze (Stanów Zjednoczonych)",
		"CC" => "Wyspy Kokosowe",
		"GBM" => "Wyspa Man",
		"MH" => "Wyspy Marshalla",
		"FO" => "Wyspy Owcze",
		"PN" => "Wyspy Pitcairn",
		"SB" => "Wyspy Salomona",
		"ST" => "Wyspy Świętego Tomasza i Książęca",
		"ZRCD" => "Zair",
		"ZM" => "Zambia",
		"ZW" => "Zimbabwe",
		"AE" => "Zjednoczone Emiraty Arabskie"
	);
	

	/**
	 * Metoda zwraca kraj po kluczu.
	 * 
	 * @param string klucz
	 * @return bool 
	 */
	public static function retrieveByKey( $sKey )
	{
		if( array_key_exists( $sKey, self::$_aCountries) ) {
			return self::$_aCountries[$sKey];	
		} 
		return false;
	}
	
	
	/**
	 * Metoda zwraca wszystkie kraje.
	 * 
	 * @param string zmienna określa który kraj ma być pierwszy
	 * @return array
	 */
	public static function retrieveAll( $asFirst = null ) {
		if( $asFirst ) {
			if( array_key_exists( $asFirst, self::$_aCountries ) ) {
				$sTmp = self::$_aCountries[ $asFirst ]; 
				unset( self::$_aCountries[ $asFirst ] );
				self::$_aCountries = array_merge( array( $asFirst => $sTmp ), self::$_aCountries );
			}
		}
		
		return self::$_aCountries;
	}

	public static function retrieveAllLangs() {
    $langs = self::retrieveAll();
    $langs2 = array();
    foreach ($langs as $key => $item) {
      $langs2[strtolower($key)] = $item . ' ['.strtolower($key).']';
    }
    return $langs2;
  }

	public static function retrieveAllLangsExcept($except_items) {
    $langs = self::retrieveAllLangs();
    foreach ($except_items as $item) {
      unset ($langs[$item]);
    }
    return $langs;
  }
	
	/**
	 * Metoda zwraca wszystkie kraje w postaci zwykłej tablicy (nie asocjacyjnej!).
	 * 
	 * @return array
	 */
	public static function retrieveAsNumber() {
		return (array_values( self::$_aCountries ) );
	}
	
	
	/**
	 * Metoda dodająca kraj.
	 * 
	 * @param string klucz
	 * @param string wartość
	 * @param string zmienna określa który kraj ma być pierwszy
	 */
	public static function add( $sKey, $sValue, $asFirst = null )
	{
		if( !array_key_exists( $sKey, self::$_aCountries ) )  {
			
			self::$_aCountries[ $sKey ] = $sValue;
			asort( self::$_aCountries );
			
			if( $asFirst ) {
				if( array_key_exists( $asFirst, self::$_aCountries ) ) {
					$sTmp = self::$_aCountries[ $asFirst ]; 
					unset( self::$_aCountries[ $asFirst ] );
					self::$_aCountries = array_merge( array( $asFirst => $sTmp ), self::$_aCountries );
				}
			}
			
			return true;
		}
		return false;
	}
	
	
	/**
	 * Metoda usuwająca dany kraj z listy.
	 * 
	 * @param klucz
	 */
	public static function del( $mKey) {
		if( is_array( $mKey ) ) {
			foreach( $mkey as $key => $value ) {
				unset( self::$_aCountries[ $key ] );
			}
			
		} else {
			unset( self::$_aCountries[ $mKey ] ); 
		}
	}
	
}