<?php

function fechas($start, $end, $tipodia) {
    $range = array();

    if (is_string($start) === true) $start = strtotime($start);
    if (is_string($end) === true ) $end = strtotime($end);

    if ($start > $end) return createDateRangeArray($end, $start);

    do {
        $range[] = date('Y-m-d', $start);
        $start = strtotime("+ 1 day", $start);
    } while($start <= $end);
    
    $datos = ordenar_fechas($range, $tipodia);

    return $datos;
}

function ordenar_fechas($range, $tipodia){
    if($tipodia == 1){
        $available_days = [6, 7];
    } elseif($tipodia == 2){
        $available_days = [1, 2, 3, 4, 5, 7];  
    } elseif($tipodia == 3){
        $available_days = [1, 2, 3, 4, 5, 6];
    }
    
    foreach ($range as $date) {
        if (!in_array(date('N', strtotime($date)), $available_days)) {
            $new_range[] = $date;
        }
        
    }
    
    return $new_range;
}

//tipo dias 
//1- Lunes- Viernes, 
//2- Sabados, 
//3- Domingos
print_r(fechas('2018-07-16','2018-07-31', 1));

?>