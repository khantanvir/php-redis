<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Customdata extends Model
{
    use HasFactory;

    public static function getRandomName(){
        $firstname = array(
        'Johnathon',
        'Anthony',
        'Erasmo',
        'Raleigh',
        'Nancie',
        'Tama',
        'Camellia',
        'Augustine',
        'Christeen',
        'Luz',
        'Diego',
        'Lyndia',
        'Thomas',
        'Georgianna',
        'Leigha',
        'Alejandro',
        'Marquis',
        'Joan',
        'Stephania',
        'Elroy',
        'Zonia',
        'Buffy',
        'Sharie',
        'Blythe',
        'Gaylene',
        'Elida',
        'Randy',
        'Margarete',
        'Margarett',
        'Dion',
        'Tomi',
        'Arden',
        'Clora',
        'Laine',
        'Becki',
        'Margherita',
        'Bong',
        'Jeanice',
        'Qiana',
        'Lawanda',
        'Rebecka',
        'Maribel',
        'Tami',
        'Yuri',
        'Michele',
        'Rubi',
        'Larisa',
        'Wanda',
        'Walter',
        'Wilma',
        'William',
        'Kumiko',
        'Aki',
        'Miharu',
        'Chiaki',
        'Michiyo',
        'Itoe',
        'Nanaho',
        'Reina',
        'Emi',
        'Yumi',
        'Ayumi',
        'Kaori',
        'Sayuri',
        'Rie',
        'Miyuki',
        'Hitomi',
        'Naoko',
        'Miwa',
        'Etsuko',
        'Akane',
        'Kazuko',
        'Miyako',
        'Youko',
        'Sachiko',
        'Mieko',
        'Toshie',
        'Lloyd',
        'Tyisha',
        'Samatha',
    );

    $lastname = array(
        'Mischke',
        'Serna',
        'Pingree',
        'Mcnaught',
        'Pepper',
        'Schildgen',
        'Mongold',
        'Wrona',
        'Geddes',
        'Lanz',
        'Fetzer',
        'Schroeder',
        'Block',
        'Mayoral',
        'Fleishman',
        'Roberie',
        'Latson',
        'Lupo',
        'Motsinger',
        'Drews',
        'Coby',
        'Redner',
        'Culton',
        'Howe',
        'Stoval',
        'Michaud',
        'Mote',
        'Menjivar',
        'Wiers',
        'Paris',
        'Grisby',
        'Noren',
        'Damron',
        'Kazmierczak',
        'Haslett',
        'Guillemette',
        'Buresh',
        'Erin',
        'Edouard',
        'Erika',
        'Earl',
        'Emily',
        'Ernesto',
        'Felix',
        'Fay',
        'Fabian',
        'Frances',
        'Franklin',
        'Florence',
        'Gabielle',
        'Gustav',
        'Grace',
        'Gaston',
        'Gert',
        'Gordon',
        'Humberto',
        'Hanna',
        'Henri',
        'Hermine',
        'Harvey',
        'Helene',
        'Iris',
        'Isidore',
        'Isabel',
        'Ivan',
        'Irene',
        'Isaac',
        'Jerry',
        'Josephine',
        'Juan',
        'Jeanne',
        'Jose',
        'Joyce',
        'Karen',
        'Kyle',
        'Kate',
        'Karl',
        'Katrina',
        'Kirk',
        'Lorenzo',
        'Lili',
        'Larry',
        'Lisa',
        'Lee',
        'Leslie',
        'Michelle',
        'Marco',
        'Mindy',
        'Maria',
        'Michael',
        'Noel',
        'Nana',
        'Nicholas',
        'Nicole',
        'Nate',
        'Nadine',
        'Olga',
        'Omar',
        'Odette',
        'Otto',
        'Ophelia',
        'Oscar',
        'Pablo',
        'Paloma',
        'Peter',
        'Paula',
        'Philippe',
        'Patty',
        'Rebekah',
        'Rene',
        'Rose',
        'Richard',
        'Rita',
        'Rafael',
        'Sebastien',
        'Sally',
        'Sam',
        'Shary',
        'Stan',
        'Sandy',
        'Tanya',
        'Teddy',
        'Teresa',
        'Tomas',
        'Tammy',
        'Tony',
        'Van',
        'Vicky',
        'Victor',
        'Virginie',
        'Vince',
        'Valerie',
        'Wendy',
        'Wilfred',
        'Center',
        'Kucera',
        'Catt',
        'Badon',
        'Grumbles',
        'Antes',
        'Byron',
        'Volkman',
        'Klemp',
        'Pekar',
        'Pecora',
        'Schewe',
        'Ramage',
    );
    $name = $firstname[rand ( 0 , count($firstname) -1)];
    $name .= ' ';
    $name .= $lastname[rand ( 0 , count($lastname) -1)];

    return $name;
    }
    //name data working
    //email structure 
    public static function getRandomEmailCompany(){
        $str = array(
            "@gmail.com",
            "@yahoo.com",
            "@outlook.com",
            "@live.com",
            "@ymail.com",
            "@indiatimes.com",
            "@bdmail.com",
            "@huston.com",
            "@monstar.com",
        );
        $email = $str[rand ( 0 , count($str) -1)];
        return $email;
    }
    //email create function 
    public static function emailCreate($name=NULL){
        if(empty($name)){
            return false;
        }
        $str = strtolower($name);
        $replace = str_replace(" ","_",$str);
        $email = $replace.rand(1,1000).Customdata::getRandomEmailCompany();
        return $email;
    }
    //birthday get 
    public static function getBirthday(){
        $start = '1985-01-31 00:00:00';
        $end = '2005-12-31 00:00:00';
        $min = strtotime($start);
        $max = strtotime($end);
        $getRandDate = rand($min,$max);
        $getDate = date('Y-m-d H:i:s', $getRandDate);
        return $getDate;
    }
    //get country 
    public static function getCountry(){
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        $random = mt_rand(0, count($countries) - 1);
        return $countries[$random];
    }
    //create random ip address
    public static function randomIP(){
        $strIp = array(
            rand(1,9).".".rand(100,999).".".rand(100,999).".".rand(11,99),
            rand(101,999).".".rand(10,99).".".rand(10,99).".".rand(110,999),
            rand(101,999).".".rand(10,99).".".rand(1,9).".".rand(110,999),
            rand(10,99).".".rand(10,99).".".rand(10,99).".".rand(110,999),
            rand(100,999).".".rand(10,99).".".rand(101,999).".".rand(11,99),
        );
        $getIP = $strIp[rand ( 0 , count($strIp) -1)];
        return $getIP;
    }
    //get random phone number 
    public static function getPhoneNumber(){
        $str = rand(1,9)."-".rand(111,999)."-".rand(111,999)."-".rand(1111,9999);
        return $str;
    }
    //get tags 
    public static function getTag(){
        $str = array(
            "customer",
            "customer,vip",
            "customer,old",
        );
        $tag = $str[rand ( 0 , count($str) -1)];
        return $tag;
    }
    //get random address
    public static function getAddress(){
        $str = array(
            "Dhaka Bangladesh",
            "Barisal Sadar",
            "Chittagong Village",
            "Rajshai",
            "Madaripur Sadar",
            "Bhola District",
        );
        $addr = $str[rand ( 0 , count($str) -1)];
        return $addr;
    }
}
