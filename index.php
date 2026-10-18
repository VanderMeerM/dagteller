<!DOCTYPE html>
<html lang="nl">

<head>
  <title>Dag bepalen</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./assets/dagteller.css" rel="stylesheet" type="text/css" />
 <!-- <script defer src="./assets/JS/ramadan.js"></script> --> 
  <script defer src="./assets/JS/countdown.js"></script> 

</head>

<?php 

// Wishlist: Ramadan toevoegen 

// Enkele variabelen 

// Array met vaste data.. 

$feestdagen = array (
	array ("month" => 1, "date" => 1, "text" => 'Nieuwjaarsdag'),
  array ("month" => 4, "date" => 27, "class" => "orange", "text" => 'Koningsdag'),
  array ("month" => 5, "date" => 5, "class" => "orange", "text" => 'Bevrijdingsdag'),
  array ("month" => 11, "date" => 3, "class" => "orange", "text" => 'Mijn verjaardag'),
	array ("month" => 12, "date" => 5, "text" => 'Sinterklaas'),
	array ("month" => 12, "date" => 25, "text" => 'Kerst'),
	array ("month" => 12, "date" => 31, "text" => 'Oudjaar')
);

$array_filter_sp = []; 

$days = ['', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'zondag'];
$months = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];

$date_today = date('d-m-Y');
$current_year = date('Y'); 
$Easter = date('d-m-Y', easter_date($currentYear)); 
$prinsjesdag; 

echo '
<body>

  <div class="color1">

    <h2> Hoeveel dagen resteren / is het geleden tot de geselecteerde feestdag in het lopende jaar ('. $current_year . ') ?<br>

      En op welke dag valt / viel die dag?
    </h2>';

include('./assets/select_day.php');

  echo '
  
  <div class="color2">

    <h2> Of voer een eigen datum in om de dag te achterhalen...</h2>'; 

    include ('./assets/get_day.php');

  
  echo '

  <div class="color3">

    <h2 style="margin-bottom: 0px">
      Countdown tot het eerstvolgende testalarm 
      <div id="countdown" style="display: inline;"></div> *
    </h2>';

?>
    <div style="color: #ECCFAE">
      * gebaseerd op de eerste maandag van de maand om 12 uur 's middags Nederlandse tijd
    </div>
  
  <?php 
  echo 
  '<h1 id="nextFirstMondayinMonth"></h1>

    </main>

  </div>

</body>';

?>


</html>