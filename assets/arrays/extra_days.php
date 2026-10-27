
<?php

$selected_extra_days = array(

   array("month" => 10, "date" => 4, "text" => 'Dierendag'), 

   array("month" => 5, "date" => 4, "text" => 'Dodenherdenking'), 
   
   array("month" => 10, "date" => 3, "text" => 'Leids Ontzet & Tag der deutschen Einheit'),

   array("month" => 5, "date" => 1, "text" => 'Dag van de Arbeid'), 
   
   array("month" => 8, "date" => 15, "text" => 'Ferragosto'), 
   
   array("month" => 12, "date" => 26, "text" => 'Tweede Kerstdag'), 

   array("month" => date('n', (easter_date($current_year) - (49 * 86400))), 
   "date" => intval((date('d', (easter_date($current_year) - (49 * 86400))))), "text" => 'Carnaval'),

   array("month" => (date('n', (strtotime($Easter) + (50 * 24 * 3600)))), "date" => date('d', (strtotime($Easter) + (50 * 24 * 3600))), "text" => 'Tweede Pinksterdag'), 
   
   array("month" => date('n', (easter_date($current_year) + 86400)), 
   "date" => intval((date('d', (easter_date($current_year) + 86400)))), "text" => 'Tweede Paasdag')

);