<?php
function format_amount($in_sum) {
    $out_sum = number_format(ceil($in_sum),0,',', ' '). " ₽";
    return $out_sum;
};

?>