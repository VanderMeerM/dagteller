
<?php 

// Prinsjesdag..

$date_ps = date_create();
date_date_set($date_ps, $current_year,9,1);
$first_september = date_format($date_ps,"d-m-Y");

$diff_first_tuesday_september = date('N', strtotime($first_september)) - 2;

($diff_first_tuesday_september > 0) ?
	$prinsjesdag = 22 - $diff_first_tuesday_september :
	$prinsjesdag = 15 - $diff_first_tuesday_september;


// Hemelvaart & Pinksteren 

$ascension_day = date('d-m-Y', (strtotime($Easter) + (39 * 24 * 3600)));
$penteCost = date('d-m-Y', (strtotime($Easter) + (49 * 24 * 3600))); // + (49 * 86400000))));


// Pasen, Hemelvaart, Pinksteren & Prinsjesdag op goede plek in selectie met feestdagen zetten.. 

$feestdagen_bf_sept = [];
$feestdagen_at_sept = [];

for ($i=0; $i <sizeof($feestdagen); $i++) {

    if ($feestdagen[$i]['month'] < 9) {
        array_push($feestdagen_bf_sept, $feestdagen[$i]);
    }
    else {
         array_push($feestdagen_at_sept, $feestdagen[$i]);
    }
}

array_push($feestdagen_bf_sept, 

array("month" => (date('n', strtotime($Easter))), "date" => (date('d', strtotime($Easter))), "text" => 'Pasen'),
array("month" => (date('n', strtotime($ascension_day))), "date" => (date('d', strtotime($ascension_day))), "text" => 'Hemelvaart'),
array("month" => (date('n', strtotime($penteCost))), "date" => (date('d', strtotime($penteCost))), "text" => 'Pinksteren'),
array("month" => 9, "date" => $prinsjesdag, "text" => 'Prinsjesdag')
);

$feestdagen = array_merge($feestdagen_bf_sept, $feestdagen_at_sept);


// Ramadan.. 

function get_Ramadan_date() {

$date = date('d-m-Y');

$curl = curl_init();

$curl_url = 'https://api.aladhan.com/v1/gToH/'.$date.'?calendarMethod=UAQ';

curl_setopt_array($curl, array(
  CURLOPT_URL => $curl_url,  
  CURLOPT_CUSTOMREQUEST => 'GET'
 ));

$response = curl_exec($curl);

}

//get_Ramadan_date();

echo '
    <form method="post"> 

    <select name="feestdag" id="select_feestdag" onchange="this.form.submit()">
    <option label="Selecteer feestdag" disabled selected>Selecteer feestdag</option>';

    foreach ($feestdagen as $fd) {
        echo '<option value = "'.$fd['date'].'-'.$fd['month'].'-'. $fd['text'].'" style="color: '.$fd['class'].'">'. $fd['text'] . '</option>';
    } 

echo '</select>

    </form>

        <div id="schrijfdag">';

           
        if (!empty($_POST['feestdag'])) {

        $date_fs = date_create();
        date_date_set($date_fs, $current_year,(explode('-', $_POST['feestdag'])[1]), (explode('-', $_POST['feestdag'])[0]));
        $date_set_ts = strtotime(date_format($date_fs, 'd-m-Y')); 


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
  
echo '
   </div>
   </div>';

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
