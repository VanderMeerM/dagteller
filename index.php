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
  <script defer src="./assets/JS/countdown.js"></script> 

</head>

<?php 

include ('./assets/sort_days.php');

echo '
<body>

  <div class="color1">

    <h2> Hoeveel dagen resteren / is het geleden tot de geselecteerde feestdag in het lopende jaar ('. $current_year . ') ?<br>

      En op welke dag valt / viel die dag?
    </h2>';


include('./assets/select_day.php');

include ('./assets/get_day.php');

  
  echo '

  <div class="color3">

    <h2>
      Countdown tot het eerstvolgende testalarm 
      <div id="countdown" style="display: inline;"></div> *
    </h2>';

?>
    <div class="based_on">
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