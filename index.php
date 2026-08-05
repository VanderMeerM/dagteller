<!DOCTYPE html>
<html lang="nl">

<head>
  <title>Dag bepalen</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./dagteller.css" rel="stylesheet" type="text/css" />
  <script defer src="./dagteller.js"></script>

</head>

<?php 

echo '

<body>

  <div class="color1">

    <h2> Hoeveel dagen resteren / is het geleden tot de geselecteerde feestdag in het lopende jaar <nav
        style="display: inline" id="currentyear">
      </nav> <br>
      En op welke dag valt/viel die dag?
    </h2>


    <select id="dagen" onchange="bepaalFeestdag(this);">

    </select>

    <main>

      <p>
      <div id="schrijfdag"></div>
      </p>

  </div>';

  $currentYear = date('Y');
  $Easter = date('M-d-Y', easter_date($currentYear)); 

  ?>
   
  <script> 
  const Easter = <?php echo json_encode($Easter) ?>;

  </script>
  
  <?php 

  echo 
  
  '<div class="color2">

    <h2> Of voer een eigen datum in om de dag te achterhalen...</h2>

    <div class="tooneigeninvoer">
      <div id="datumkiezer"></div>
      <div id="maandkiezer"></div>
      <input type="number" id="jaarkiezer" min="1900">

      <br>
      <p>
      <div id="toondag"> </div>
      <div id="dagenverschil"> </div>

      <div id="onthisday">Op deze dag in...<p></p>
      </div>
      <div id="specialdates"></div>
      </p>

      <audio id="sound" type="audio/mpeg"></audio>

    </div>

  </div>

 

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