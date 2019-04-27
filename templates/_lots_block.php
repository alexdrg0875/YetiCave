<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.04.2019
 * Time: 2:55
 */

if ($value['count_bets']) { // проверяем по наличию ставок тип отображаемой цены и наименования цены лота
  $price_title = $value['count_bets'] . ' ставок';
  $price = $value['max_price'];
} else {
  $price_title = 'Стартовая цена';
  $price = $value['price'];
}
if (((int)lot_life_time($value['dt_end']) < 1) && (lot_life_time($value['dt_end']) != 'Торги окончены')) {    // если осталось время жизни лота менее часа, устанавливаем соотв. class
  $timer_class = 'timer--finishing';
}?>
<li class="lots__item lot">
  <div class="lot__image">
    <img src="<?=$value['image_path'];?>" width="350" height="260" alt="<?=htmlspecialchars($value['alt']);?>">
  </div>
  <div class="lot__info">
    <span class="lot__category"><?=$value['category'];?></span>
    <h3 class="lot__title">
      <a class="text-link" href="lot.php?id=<?=$value['id']; ?>"><?=htmlspecialchars($value['name']); ?></a>
    </h3>
    <div class="lot__state">
      <div class="lot__rate">
        <span class="lot__amount"><?=$price_title; ?></span>
        <span class="lot__cost"><?=format_amount(htmlspecialchars($price)); ?></span>
      </div>
      <div class="lot__timer timer <?=$timer_class; ?>">
        <?=lot_life_time($value['dt_end']); ?>
      </div>
    </div>
  </div>
</li>
