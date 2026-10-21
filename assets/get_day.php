
<?php 

 $valt; 
 $num_days;

 include ('./assets/special_dates.php');

  // Controleren op gebeurtenissen op de geselecteerde datum... 

       for ($i=0; $i < sizeof($special_dates); $i++) {

       if ( 
        ($_POST['select_date'] == explode('-', $special_dates[$i]['date'])[0] && 
        $_POST['select_month'] == explode('-', $special_dates[$i]['date'])[1] ))
        
        {
       array_push($array_filter_sp, $special_dates[$i]);

       }
       }

// Datum selecteren en dag bepalen...

echo '

<div class="color2" '. (sizeof($array_filter_sp) == 0 ? 'style=height:33vh;': null) . '>

<h2> Of voer een eigen datum in om de dag te achterhalen...</h2>

 <div class="tooneigeninvoer">

   <form method="post"> 

    <select name="select_date" id="select_date" onchange="this.form.submit()">
    <option disabled selected>Kies een datum</option>';

    for ($i=1; $i <= 31; $i++) {
        echo '<option value='.$i.' '. ($i == date('d') ? 'selected': null) .'>'.$i.' </option>';
    }
     
    echo '</select>';

   echo ' 

    <select name="select_month" id="select_month" onchange="this.form.submit()">
    <option disabled selected>Kies een maand</option>';

    for ($i=0; $i < sizeof($months); $i++) {
        echo '<option value='. ($i + 1) .' '. ( ($i+1) == date('m') ? 'selected': null).'>'.$months[$i].' </option>';
    }
     
    echo '</select>
    
     <select name="select_year" id="select_year" onchange="this.form.submit()">';

     for ($i= 1900; $i < ($current_year + 500); $i++) {
        echo '<option '. ($i == $current_year ? 'selected' : null) .'>' . $i . '</option>';
     };
    
    echo '
    </select>     
    </form>
    </div>';

      
 if  ( (!empty($_POST['select_date'])) || 
       (!empty($_POST['select_month'])) || 
       (!empty($_POST['select_year']))) 
       
       {
       
    if (
        ($_POST['select_month'] == 2 || $_POST['select_month'] == 4 || 
        $_POST['select_month'] == 6 || $_POST['select_month'] == 9 || 
        $_POST['select_month'] == 11) && $_POST['select_date'] == 31) {
        echo '<div class="container_events">Ongeldige datum</div>';
        }
        else {
                 
        $date_selday = date_create();
        date_date_set($date_selday, $_POST['select_year'], $_POST['select_month'], $_POST['select_date']);
        $date_set_sel_day = strtotime(date_format($date_selday, 'd-m-Y')); 

        $day_difference = strtotime($date_today) - $date_set_sel_day; 
  
       if ($day_difference == 0) {
            $num_days = ' (is vandaag)'; 
        } 
        else if ($day_difference == 86400) {
            $num_days = ' (was gisteren)'; 
        } 
        else if ( ($day_difference * -1) == 86400) {
            $num_days = ' (is morgen)'; 
        }
         else if ( ($day_difference > 86400) && ($current_year == $_POST['select_year']) ){
            $num_days = ' ('. round($day_difference/86400) .' dagen geleden)'; 
        } 
         else if ( (($day_difference * -1) > 86400) && ($current_year == $_POST['select_year']) ){
            $num_days = ' (over '. round(($day_difference/86400) * -1) .' dagen)'; 
        }     

        ($date_set_sel_day >= strtotime($date_today) ? $valt = 'valt' : $valt= 'viel');

        echo '<div id="toondag"> ' . $_POST['select_date'] . ' ' . $months[$_POST['select_month']-1] . ' ' . $_POST['select_year'] . ' ' .$valt. ' op ' . $days[date('N', $date_set_sel_day)] . $num_days. '.</div>';
        
        }
       }

    // Speciale gebeurtenis(sen) tonen (indien ze er zijn)...
      
       if (sizeof($array_filter_sp) > 0) {

      echo '
       
      <div id="onthisday">Op deze dag in...</div>
      
      <div class="main_container_events">'; 

       foreach ($array_filter_sp as $af) {

     echo '
     <div class="container_events">'
     .explode('-', $af['date'])[2] . ' ('. ($current_year - explode('-', $af['date'])[2]) .' jaar geleden)
    
     <div id="specialdates">
     <a target = "blank" href= "https://nl.wikipedia.org/wiki/'. $af['link'] .'"> '.$af['event'].''; 

 
    echo '    
     <div class="img_event">
     <img src=./images/' .$af['image'].'>
     </div></a>';

    if ($af['sound']) {
    echo '<img id="playstop" src="./assets/play_white.png">
    <audio id="sound" type="audio/mpeg" src="./sound/'.$af['sound'].'.mp3"></audio>';

    ?>
    <script>
    document.getElementById('playstop').addEventListener('click', () => {
    document.getElementById('sound').play();
    })
    </script>

    <?php 
    }
    
    echo '
     </div>
     </div>';

    }

     echo '
     </div>
     </div>';
       }

      
     echo '
     </div>';
?>

<script>

let blinkOnThisDay = setInterval(showBlinking, 300);

let onThisDay = document.getElementById('onthisday');

		function showBlinking() {

        if (onThisDay) {
			onThisDay.classList.toggle('unvisible');
			onThisDay.style.display = 'block';
		}

		setTimeout(stopBlinking, 2700);

		function stopBlinking() {
			clearInterval(blinkOnThisDay);
		}}

</script>

 <script>

// Selectie aanhouden..

let selectedYear = <?php echo json_encode($_POST['select_year']); ?>
</script>

<script>
let selectedMonth = <?php echo json_encode($_POST['select_month']); ?>
</script>

<script>
let months_sel = <?php echo json_encode($months); ?>
</script>

<script>
let selectedDate = <?php echo json_encode($_POST['select_date']); ?>


    selectField('select_year', selectedYear);
    selectField('select_month', selectedMonth);
    selectField('select_date', selectedDate);


    function selectField(sel, sf) {

    let selectField = document.getElementById(sel);
    
    for (let i=0; i < selectField.length; i++ ) {

    if (sf) {

            if (sf === selectedMonth) {
                if (selectField[i].text === months_sel[selectedMonth-1]) {
                 selectField[i].selected = true;
                }
            }

            else if (selectField[i].text === sf) {
            selectField[i].selected = true;
        }
    };
    }
}
   </script>

