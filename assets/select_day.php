
<?php 

echo '
    <form method="post"> 

    <select name="feestdag" id="select_feestdag" onchange="this.form.submit()">
    <option label="Selecteer feestdag" disabled selected>Selecteer feestdag</option>';

    foreach ($feestdagen as $fd) {

    if ( (!empty($fd['date'])) && (!empty($fd['month'])) ) {
        echo '<option value = "'.$fd['date'].'-'.$fd['month'].'-'. $fd['text'].'" style="color: '.$fd['class'].'">'. $fd['text'] . '</option>';
    } 
    }

echo '</select>

    </form>

        <div id="schrijfdag">';

           
        if (!empty($_POST['feestdag'])) {

        $date_fs = date_create();
        date_date_set($date_fs, $current_year,(explode('-', $_POST['feestdag'])[1]), (explode('-', $_POST['feestdag'])[0]));
        $date_set_ts = strtotime(date_format($date_fs, 'd-m-Y')); 

         if (explode('-', $_POST['feestdag'])[2] === 'Ramadan') {
            text_ramadan($end_ramadan, $months, $days, $date_today);
        } else {

        // Vandaag 

        if ($date_set_ts == strtotime($date_today)) {
          echo explode('-', $_POST['feestdag'])[2] . ' (' 
          . (explode('-', $_POST['feestdag'])[0]) . ' ' . $months[((explode('-', $_POST['feestdag'])[1])-1)] .') is op ' . $days[date('N', $date_set_ts)] . ' en is vandaag :) ';
        }

        // Gisteren 

        else if (strtotime($date_today) - $date_set_ts == 86400 ) {
            echo explode('-', $_POST['feestdag'])[2] . ' (' 
            . (explode('-', $_POST['feestdag'])[0]) . ' ' . $months[((explode('-', $_POST['feestdag'])[1])-1)] .') was gisteren en viel op ' . $days[date('N', $date_set_ts)] . '.';
        }

        // In het verleden 

         else if ($date_set_ts - strtotime($date_today) < 86400 ) {
            echo explode('-', $_POST['feestdag'])[2] . ' (' 
            . (explode('-', $_POST['feestdag'])[0]) . ' ' . $months[((explode('-', $_POST['feestdag'])[1])-1)] .') was ' . round((strtotime($date_today) - $date_set_ts) / 86400) . ' dagen geleden en viel op ' . $days[date('N', $date_set_ts)] . '.';
        }

         // Morgen 

         else if ($date_set_ts - strtotime($date_today) == 86400) {
          echo explode('-', $_POST['feestdag'])[2] . ' (' 
          . (explode('-', $_POST['feestdag'])[0]) . ' ' . $months[((explode('-', $_POST['feestdag'])[1])-1)] .') is morgen en valt op ' . $days[date('N', $date_set_ts)] . '.';
        }
          
        // Toekomst 

         else if ($date_set_ts - strtotime($date_today) > 86400 ) {
          echo explode('-', $_POST['feestdag'])[2] . ' (' 
          . (explode('-', $_POST['feestdag'])[0]) . ' ' . $months[((explode('-', $_POST['feestdag'])[1])-1)] .') is nog ' . round( ($date_set_ts - strtotime($date_today)) / 86400) . ' nachtjes slapen en valt op ' . $days[date('N', $date_set_ts)] . '.';
        };
          
    }
        echo '</div><div><img id="img_symbol" src=./images/symbols/' . explode('-', $_POST['feestdag'])[2] . '.jpeg></div>';    
    }

  
echo '
   </div>
   </div>';

   function text_ramadan($enddate, $months, $days, $date_today) {
       
    $date_fs = date_create();
    date_date_set($date_fs, date('Y'),(explode('-', $_POST['feestdag'])[1]), (explode('-', $_POST['feestdag'])[0]));
    $date_set_ts = strtotime(date_format($date_fs, 'd-m-Y')); 
    $start_day = $days[date('N', $date_set_ts)];
    
    $start_ramadan = date('d-m-Y', $date_set_ts);
    $begins;
    $ends;

    $end_ramadan = strtotime($enddate);
    $end_day = $days[date('N', $end_ramadan)];
   
 
   // Huidige datum na einddatum...

   if (strtotime(date('d-m-Y')) > $end_ramadan) {
    $begins = 'begon';
    $ends = 'eindigde';
    $in_days;
    $days_ago;
    (strtotime($date_today) - $end_ramadan == 86400 ? $days_ago = ' (gisteren)' : 
    $days_ago = ' (' .round((strtotime($date_today) - $end_ramadan) / 86400) .' dagen geleden)');
   
    }
    
    // Huidige datum voor begindatum... 

    else if (strtotime(date('d-m-Y')) < date($date_set_ts)) {
    $begins= 'begint'; 
    $ends = 'eindigt';
    $days_ago;
    $in_days;
    ($date_set_ts - strtotime($date_today) == 86400 ? $in_days = ' (morgen)' :
    $in_days = ' (over '.round( ($date_set_ts - strtotime($date_today)) / 86400) .' dagen)');
    }

    // Tijdens Ramadan...

    else {
    $begins = 'begon';
    $ends = 'eindigt';
    $in_days;
    $days_ago;

    ($end_ramadan - strtotime($date_today) == 86400 ? $days_ago = ' (morgen)' :
    $days_ago = ' (over '.round( ($end_ramadan - strtotime($date_today)) / 86400) .' dagen)');
    }

   
   echo 'Ramadan '. $begins . ' op ' . $start_day . ' ' . intval(explode('-', $start_ramadan)[0]) . ' ' . $months[intval(explode('-', $start_ramadan)[1])-1] . '' . $in_days .' en '. $ends .' op '. $end_day .' '. intval(date('d', $end_ramadan)) . ' ' . $months[intval(date('m', $end_ramadan))-1] . '' . $days_ago .'.';

    }

   ?>

   <script>

    // Gekozen dag selecteren.. 

    let selectDays = document.getElementById('select_feestdag');

    let selectedDay = <?php echo json_encode($_POST['feestdag']); ?>
   
    for (let i=0; i < selectDays.length; i++ ) {

    if (selectedDay) {

        if (selectDays[i].text === selectedDay.split('-')[2]) {
        selectDays[i].selected = true;
        }
    }; 
 
    }

   </script>
