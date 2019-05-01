<?php
// форматирует сумму в рублях
function format_amount($in_sum) {
    $out_sum = number_format(ceil($in_sum),0,',', ' '). " ₽";
    return $out_sum;
};

// собирает HTML с подстановкой входных данных
function renderTemplate($template, $param = false) {
    ob_start();
    if ($param) {
        extract($param);
    }
    if (file_exists($template)) {
        include($template);
        return ob_get_clean();
    } else {
        return ' ';
    }
};

// подсчет остатка жизни лота
function lot_life_time($date_end) {
    $offset = timezone_offset_get(timezone_open(date_default_timezone_get()), new DateTime()); // расчет смещения от времени GMT в секундах для коррекции расчета
    $lot_life_day = floor((strtotime($date_end) - time()) / 86400); // количество полных дней
    $lot_life_hour = date('G', (strtotime($date_end) - time() - $offset)); // кол-во часов
    $lot_life_min = date('i', (strtotime($date_end) - time() - $offset)); // кол-во мин
    //$lot_life_sec = date('s', (strtotime($date_end) - time() - $offset)); // кол-во сек
    if ($lot_life_day > 0) {   // обработка результата под формат отображения на странице
      $result = $lot_life_day.'д '.$lot_life_hour.'ч:'.$lot_life_min.'м';
    } elseif ((strtotime($date_end) - time()) < 0) {
      $result = 'Торги окончены';
    } else {
      $result = $lot_life_hour.'ч:'.$lot_life_min.'м';
    }
    return $result;
  /*    $end_time_day = date(d, $date_end) - date(d);
    $end_time_hour = date(H, $date_end) - date(H);
    $end_time_min = date(i, $date_end) - date(i);
    return $end_time_day.'д '.$end_time_hour.'ч:'.$end_time_min.'м';
*/
#    return date('H:i', $end_time_sec);

};
?>
