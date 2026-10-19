
<?php 

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// Islamitisch jaar bepalen.. 

$curl_gtoh = curl_init();

$cur_url_gtoh = 'https://api.aladhan.com/v1/currentIslamicYear';

curl_setopt_array($curl_gtoh, array(
  CURLOPT_URL => $cur_url_gtoh,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    ),
));


// (curl_init verwacht sinds PHP 8 een PHP object..)

$response_gtoh = curl_exec($curl_gtoh);

$response_gtoh = json_decode($response_gtoh, true); 

$isl_year = $response_gtoh['data'];


// Begin aankomende Ramadan bepalen...

function getRamadan($year, $month) {
    
$curl_st_ram = curl_init();

$cur_url_st_ram = 'https://api.aladhan.com/v1/hToG/01-'.$month.'-'.$year.'?calendarMethod=UAQ';

curl_setopt_array($curl_st_ram, array(
  CURLOPT_URL => $cur_url_st_ram,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    ),
));

$response_st_ram = curl_exec($curl_st_ram);

$response_st_ram = json_decode($response_st_ram, true); 

return $response_st_ram['data']['gregorian']['date'];

}

$start_ramadan = getRamadan($isl_year, 9);
$end_ramadan = getRamadan($isl_year, 10);

if ( date('Y', strtotime($response_st_ram['data']['gregorian']['date'])) != date('Y')) {
  $start_ramadan = getRamadan(($isl_year-1), 9);
  $end_ramadan = getRamadan(($isl_year-1), 10);
} else {
 $start_ramadan = getRamadan($isl_year, 9);
 $end_ramadan = getRamadan(($isl_year-1), 10);
};



