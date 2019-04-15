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

function lot_life_time () {
#    $cur_time = time();
#    $time_zone = 3;
#    $end_time_sec = 86400 - date('H')*3600 - date('i')*60;
#    $end_time_sec = 86400 - $time_zone*3600 - $cur_time%86400;
#    $end_time_hour = floor($end_time_sec / 3600);
#    $end_time_min = floor(($end_time_sec%3600) / 60);
    $end_time_hour = 23 - date(H);
    $end_time_min = 60 - date(i);
    return $end_time_hour.'ч:'.$end_time_min.'м';
#    return date('H:i', $end_time_sec);

};
?>
