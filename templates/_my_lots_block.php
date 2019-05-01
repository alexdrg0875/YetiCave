<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.04.2019
 * Time: 2:55
 */

$lot_status = lot_life_time($value['dt_end']);

if (((int)$lot_status < 1) && ($lot_status != 'Торги окончены')) {    // если осталось время жизни лота менее часа, устанавливаем соотв. class
  $timer_class = 'timer--finishing';
} elseif ($lot_status == 'Торги окончены') {
  if ($value['bet_value'] == $value['max_bet']) { // проверка наличия выигрышной ставки по данному лоту
    $lot_status = 'Ставка выиграла';
    $timer_class = 'timer--win';
    $rates_class = 'rates__item--win';
  } else {
    $timer_class = 'timer--end';
    $rates_class = 'rates__item--end';
  }
} ?>

<tr class="rates__item <?=$rates_class; ?>"> <!-- rates__item--end , rates__item--win  -->
    <td class="rates__info">
        <div class="rates__img">
            <img src="<?=$value['image_path']; ?>" width="54" height="40" alt="<?=htmlspecialchars($value['alt']); ?>">
        </div>
        <h3 class="rates__title"><a href="lot.php?id=<?=$value['id']; ?>"><?=htmlspecialchars($value['name']); ?></a></h3>
    </td>
    <td class="rates__category">
      <?=$value['category'];?>
    </td>
    <td class="rates__timer">
        <div class="timer <?=$timer_class; ?>"><?=$lot_status; ?></div> <!-- timer--finishing(время до конца жизни лота), timer--end(Торги окончены), timer--win (Ставка выиграла) -->
    </td>
    <td class="rates__price">
      <?=format_amount(htmlspecialchars($value['bet_value'])); ?>
    </td>
    <td class="rates__time">
      <?=$value['bet_date']; ?>  <!-- 5 минут назад, Вчера, в 21:30, 19.03.17 в 08:21, 20 минут назад, Час назад -->
    </td>
</tr>
