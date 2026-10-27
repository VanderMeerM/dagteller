
<?php 

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

include ('./assets/arrays/general_arrays.php');


// Bepaal eerste dinsdag in de maand (voor begin Vierdaagse & Prinsjesdag)..

function get_first_tuesday($month, $year) {
$date_dm = date_create();
date_date_set($date_dm, $year, $month ,1);
$first_day_month = date_format($date_dm,"d-m-Y");

$diff_first_day_month = date('N', strtotime($first_day_month)) - 2;

($diff_first_day_month > 0 ) ?
	$day = 22 - $diff_first_day_month :
	$day = 15 - $diff_first_day_month;
    
    return $day;
}


$prinsjesdag = get_first_tuesday (9, $current_year);
$prinsjesdag_ty = get_first_tuesday (9, date('Y'));


// Data voor Vierdaagse..

$vierdaagse = get_first_tuesday (7, $current_year);
$end_vierdaagse = ($vierdaagse + 3) . '-07-' . $current_year; 

$vierdaagse_ty = get_first_tuesday (7, date('Y'));
$end_vierdaagse_ty = ($vierdaagse + 3) . '-07-' . date('Y'); 


// Zet Prinsjesdag (voor het huidige jaar) in array...

array_unshift($feestdagen_from_sept, array("month" => 9, "date" => $prinsjesdag_ty, "text" => 'Prinsjesdag'));
 

// Array met 'Nederlandse' feestdagen..

$new_years_day = array ("month" => 1, "date" => 1, "text" => 'Nieuwjaarsdag');
$queensday = array ("month" => 4, "date" => 27, "class" => "orange", "text" => 'Koningsdag');
$lib_day = array ("month" => 5, "date" => 5, "class" => "orange", "text" => 'Bevrijdingsdag'); 


// Bepaal Pasen, Hemelvaart & Pinksteren en zet ze in array..

$easter_day = array("month" => (date('n', strtotime($Easter_ty))), "date" => intval((date('d', strtotime($Easter_ty)))), "text" => 'Pasen');
$ascension_day = date('d-m-Y', (strtotime($Easter_ty) + (39 * 24 * 3600)));
$penteCost = date('d-m-Y', (strtotime($Easter_ty) + (49 * 24 * 3600))); 

$chr_feestdagen = array(
array("month" => (date('n', strtotime($ascension_day))), "date" => (date('d', strtotime($ascension_day))), "text" => 'Hemelvaart'),
array("month" => (date('n', strtotime($penteCost))), "date" => (date('d', strtotime($penteCost))), "text" => 'Pinksteren')
);


// Bepaal Pasen, Hemelvaart & Pinksteren voor geselecteerde jaar.. 

$easter_day_sel_year = array("month" => (date('n', strtotime($Easter))), "date" => intval((date('d', strtotime($Easter)))), "text" => 'Pasen');
$ascension_day_sel_year = date('d-m-Y', (strtotime($Easter) + (39 * 24 * 3600)));
$penteCost_sel_year = date('d-m-Y', (strtotime($Easter) + (49 * 24 * 3600))); 

$chr_feestdagen_sel_year = array(
array("month" => (date('n', strtotime($ascension_day_sel_year))), "date" => (date('d', strtotime($ascension_day_sel_year))), "text" => 'Hemelvaart'),
array("month" => (date('n', strtotime($penteCost_sel_year))), "date" => (date('d', strtotime($penteCost_sel_year))), "text" => 'Pinksteren')
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

array_push($feestdagen_chr_NL_sorted, $chr_feestdagen[0], $chr_feestdagen[1]);

// ..en de Vierdaagse..

array_push($feestdagen_chr_NL_sorted, array("month" => 7, "date" => $vierdaagse_ty, "text" => 'Nijmeegse Vierdaagse'));

// Zet alles bij elkaar...

$feestdagen = array_merge($feestdagen_chr_NL_sorted, $feestdagen_from_sept);

// En voeg als laatste nog Nieuwjaarsdag toe.. 

array_unshift($feestdagen, $new_years_day);


// Ramadan bepalen..

include ('./assets/PHP/get_ramadan_date.php');

// Zet Ramadan op juiste 'plek' in feestdagen..

$feestdagen_bf_ramadan = [];
$feestdagen_at_ramadan = [];

for ($i=0; $i <sizeof($feestdagen); $i++) {

   if ( 
    ($feestdagen[$i]['month'] < intval(explode('-', $start_ramadan)[1])) || 

    (($feestdagen[$i]['month'] == intval(explode('-', $start_ramadan)[1])) &&  
    ($feestdagen[$i]['date'] <= intval(explode('-', $start_ramadan)[0])) ) 
    ) 
   {
     array_push($feestdagen_bf_ramadan, $feestdagen[$i]);
    }
    else {
     array_push($feestdagen_at_ramadan, $feestdagen[$i]);
    }
}

array_push($feestdagen_bf_ramadan, array("month" => intval(explode('-', $start_ramadan)[1]), 
"date" => intval(explode('-', $start_ramadan)[0]), "text" => 'Ramadan'));

$feestdagen = array_merge($feestdagen_bf_ramadan, $feestdagen_at_ramadan);

include ('./assets/arrays/extra_days.php'); 

include ('./assets/PHP/build_special_days_sel_year.php');

