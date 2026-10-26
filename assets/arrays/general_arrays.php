
<?php



// Enkele variabelen en arrays..

$array_filter_sp = []; 
$feestdagen_chr_NL_sorted = [];

$days = ['', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag'];
$months = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];

$date_today = date('d-m-Y');
$current_year; 

($_POST['select_year'] ? $current_year = $_POST['select_year'] : $current_year = date('Y'));    

$Easter = date('d-m-Y', easter_date($current_year)); 

$start_ramadan;


// Array met vaste data vanaf september..

$feestdagen_from_sept = array (
    array ("month" => 11, "date" => 3, "class" => "orange", "text" => 'Mijn verjaardag'),
	array ("month" => 12, "date" => 5, "text" => 'Sinterklaas'),
	array ("month" => 12, "date" => 25, "text" => 'Kerst'),
	array ("month" => 12, "date" => 31, "text" => 'Oudjaar')
);
