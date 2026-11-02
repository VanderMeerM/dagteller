
<?php

// Enkele variabelen en arrays..

$array_filter_sp = []; 
$feestdagen_chr_NL_sorted = [];

$days = ['', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag'];
$months = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];

$date_today = date('d-m-Y');
$current_year; 
$easter_year;

($_POST['select_year'] ? $current_year = $_POST['select_year'] : $current_year = date('Y')); 

if ( ($_POST['select_year']) && 
	($_POST['select_year'] < 1970) || ($_POST['select_year'] > date('Y') + 10) ) 
	{
	$easter_year == $_POST['select_year'];
} else {
	$easter_year == $current_year;
}

// extra dag erbij tellen; anders klopt de datum niet op de server...
$Easter = date('d-m-Y', easter_date($easter_year) + 86400); 
$Easter_ty = date('d-m-Y', easter_date(date('Y')) + 86400); 

$start_ramadan;


// Array met vaste data vanaf september..

$feestdagen_from_sept = array (
    array ("month" => 11, "date" => 3, "class" => "orange", "text" => 'Mijn verjaardag', 'since' => 1975),
	array ("month" => 12, "date" => 5, "text" => 'Sinterklaas'),
	array ("month" => 12, "date" => 25, "text" => 'Kerst'),
	array ("month" => 12, "date" => 31, "text" => 'Oudjaar')
);
