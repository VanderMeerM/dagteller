
<?php

// Array opbouwen voor feest- en speciale dagen in het geselecteerde jaar.. 

// eerst 'vaste' dagen vanaf september invoegen.. 
$feestdagen_sel_year = $feestdagen_from_sept;

// .. wel eerst Prinsjesdag van het huidige jaar eruit halen..
array_shift($feestdagen_sel_year);

// .. en vervolgens Prinsjesdag en de Vierdaagse voor het geselecteerde jaar invoegen..
array_push($feestdagen_sel_year, array("month" => 9, "date" => $prinsjesdag, "text" => 'Prinsjesdag'));
array_push($feestdagen_sel_year, array("month" => 7, "date" => $vierdaagse, "text" => 'Vierdaagse'));

// Pasen...
array_push ($feestdagen_sel_year, $easter_day_sel_year);

// ..en Hemelvaart & Pinksteren..
array_push($feestdagen_sel_year, $chr_feestdagen_sel_year[0], $chr_feestdagen_sel_year[1]);

// ..en de 'vaste' feestdagen voor september..
array_push($feestdagen_sel_year, [$new_years_day, $queensday, $lib_day]);

// ..Ramadan in het geselecteerde jaar.. 
array_push($feestdagen_sel_year, array("month" => explode('-', $start_ramadan_sel_year)[1], "date" => explode('-', $start_ramadan_sel_year)[0], "text" => 'Ramadan'));

// ..en tenslotte de extra dagen 
$found_selected_special_day = array_merge($feestdagen_sel_year, $selected_extra_days);
