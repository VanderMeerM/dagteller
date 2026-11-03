
<?php

$selected_extra_days = array(

   array("month" => 10, "date" => 4, "text" => 'Dierendag'), 

   array("month" => 5, "date" => 4, "text" => 'Dodenherdenking', "since" => 1946), 
   
   array("month" => 10, "date" => 3, "text" => 'Leids Ontzet & Tag der deutschen Einheit'),

   array("month" => 5, "date" => 1, "text" => 'Dag van de Arbeid'), 
   
   array("month" => 8, "date" => 15, "text" => 'Ferragosto'), 
   
   array("month" => 12, "date" => 26, "text" => 'Tweede Kerstdag'), 

   array("month" => 3, "date" => 21, "text" => 'Lente'), 
   
   array("month" => 6, "date" => 21, "text" => 'Zomer'), 

   array("month" => 9, "date" => 23, "text" => 'Herfst'), 

   array("month" => 12, "date" => 21, "text" => 'Winter'),

);

//   Pasen en gerelateerde feestdagen worden alleen berekend tussen 1970 en tien jaar na huidige datum - 
//  ivm conflictering dat easter_date alleen vanaf 1970 werkt en elf jaar na huidige datum...

if ( ($_POST['select_year']) &&  
  (($_POST['select_year'] < 1970) || ($_POST['select_year'] > (date('Y') + 10)))
   )  {
      return; 
   } else {
 
 $selected_extra_easter_days = array( 

   array("month" => (date('n', (easter_date($_POST['select_year']) - (49 * 24 * 3600)))), 
   "date" => date('d', (easter_date($_POST['select_year']) - (49 * 24 * 3600))), "text" => 'Carnaval'),

 array("month" => date('n', easter_date($_POST['select_year'])), 
  "date" => intval((date('d', easter_date($_POST['select_year'])))), "text" => 'Pasen'),
   
   array("month" => date('n', (easter_date($_POST['select_year']) + 86400)), 
  "date" => intval((date('d', (easter_date($_POST['select_year']) + 86400)))), "text" => 'Tweede Paasdag'),

  array("month" => (date('n', (easter_date($_POST['select_year']) + (39 * 24 * 3600)))), 
   "date" => date('d', (easter_date($_POST['select_year']) + (39 * 24 * 3600))), "text" => 'Hemelvaart'), 

  array("month" => (date('n', (easter_date($_POST['select_year']) + (49 * 24 * 3600)))), 
   "date" => date('d', (easter_date($_POST['select_year']) + (49 * 24 * 3600))), "text" => 'Pinksteren'), 

   array("month" => (date('n', (easter_date($_POST['select_year']) + (50 * 24 * 3600)))), 
   "date" => date('d', (easter_date($_POST['select_year']) + (50 * 24 * 3600))), "text" => 'Tweede Pinksterdag')
 
   );
  
   } 
 
   $selected_extra_days = array_merge($selected_extra_days, $selected_extra_easter_days);


