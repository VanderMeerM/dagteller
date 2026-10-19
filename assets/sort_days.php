
<?php 

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/


// Enkele variabelen en arrays..

$array_filter_sp = []; 
$feestdagen_chr_NL_sorted = [];

$days = ['', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag'];
$months = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];

$date_today = date('d-m-Y');
$current_year = date('Y'); 
$Easter = date('d-m-Y', easter_date($current_year)); 

$prinsjesdag; 
$start_ramadan;


// Array met vaste data vanaf september..

$feestdagen_from_sept = array (
    array ("month" => 11, "date" => 3, "class" => "orange", "text" => 'Mijn verjaardag'),
	array ("month" => 12, "date" => 5, "text" => 'Sinterklaas'),
	array ("month" => 12, "date" => 25, "text" => 'Kerst'),
	array ("month" => 12, "date" => 31, "text" => 'Oudjaar')
);


// Bepaal datum Prinsjesdag en voeg toe aan bovenstaande array..

$date_ps = date_create();
date_date_set($date_ps, $current_year,9,1);
$first_september = date_format($date_ps,"d-m-Y");

$diff_first_tuesday_september = date('N', strtotime($first_september)) - 2;

($diff_first_tuesday_september > 0) ?
	$prinsjesdag = 22 - $diff_first_tuesday_september :
	$prinsjesdag = 15 - $diff_first_tuesday_september;

 array_unshift($feestdagen_from_sept, array("month" => 9, "date" => $prinsjesdag, "text" => 'Prinsjesdag'));
 

 // Array met 'Nederlandse' feestdagen..

   $new_years_day = array ("month" => 1, "date" => 1, "text" => 'Nieuwjaarsdag');
   $queensday = array ("month" => 4, "date" => 27, "class" => "orange", "text" => 'Koningsdag');
   $lib_day = array ("month" => 5, "date" => 5, "class" => "orange", "text" => 'Bevrijdingsdag'); 


// Bepaal Pasen, Hemelvaart & Pinksteren en zet ze  in array..

$easter_day = array("month" => (date('n', strtotime($Easter))), "date" => intval((date('d', strtotime($Easter)))), "text" => 'Pasen');

$ascension_day = date('d-m-Y', (strtotime($Easter) + (39 * 24 * 3600)));
$penteCost = date('d-m-Y', (strtotime($Easter) + (49 * 24 * 3600))); // + (49 * 86400000))));

$chr_feestdagen = array(
array("month" => (date('n', strtotime($ascension_day))), "date" => (date('d', strtotime($ascension_day))), "text" => 'Hemelvaart'),
array("month" => (date('n', strtotime($penteCost))), "date" => (date('d', strtotime($penteCost))), "text" => 'Pinksteren')
);

// Voeg Pasen als eerste toe aan de gesorteerde array..

array_push ($feestdagen_chr_NL_sorted, $easter_day); 

// Indien Koningsdag na Pasen valt, komt deze als tweede.. 

if (($easter_day['month'] <= $queensday['month']) && ($easter_day['date'] < $queensday['date'])) {
    array_push($feestdagen_chr_NL_sorted, $queensday);

// ..en anders als eerste..
} else {
 array_unshift($feestdagen_chr_NL_sorted, $queensday);
}

// En dan komen Bevrijdingsdag.. 

array_push($feestdagen_chr_NL_sorted, $lib_day);

// ..Hemelvaart & Pinksteren.. 

array_push($feestdagen_chr_NL_sorted, $chr_feestdagen);

// Zet alles bij elkaar...

$feestdagen = array_merge($feestdagen_chr_NL_sorted, $feestdagen_from_sept);

// En voeg als laatste nog Nieuwjaarsdag toe.. 

array_unshift($feestdagen, $new_years_day);


// Ramadan bepalen..

include ('./assets/get_ramadan_date.php');

array_push($feestdagen, array("month" => intval(explode('-', $start_ramadan)[1]), 
"date" => intval(explode('-', $start_ramadan)[0]), "text" => 'Ramadan'));


// Zet Ramadan op juiste 'plek' in feestdagen..

$feestdagen_bf_ramadan = [];
$feestdagen_at_ramadan = [];

for ($i=0; $i <sizeof($feestdagen); $i++) {

   if ($feestdagen[$i]['month'] <= intval(explode('-', $start_ramadan)[1])) 
   {
     array_push($feestdagen_bf_ramadan, $feestdagen[$i]);
    }
    else {
         array_push($feestdagen_at_ramadan, $feestdagen[$i]);
    }
}

$feestdagen = array_merge($feestdagen_bf_ramadan, $feestdagen_at_ramadan);

