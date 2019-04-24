<nav class="nav">
  <ul class="nav__list container">
    <?php
    foreach ($categories as $value) { ?>
        <li class="nav__item">
            <a href="all-lots.html"><?=htmlspecialchars($value['name']); ?></a>
        </li>
    <?php } ?>
  </ul>
</nav>
<div class="container">
  <section class="lots">
    <h2>Результаты поиска по запросу «<span><?=$search_string; ?></span>»</h2>
    <ul class="lots__list">
      <?php
      foreach ($lots as $value) {
        if ($value['count_bets']) { // проверяем по наличию ставок тип отображаемой цены и наименования цены лота
          $price_title = $value['count_bets'] . ' ставок';
          $price = $value['max_price'];
        } else {
          $price_title = 'Стартовая цена';
          $price = $value['price'];
        }
        if ((int)lot_life_time() < 1) {    // если осталось время жизни лота менее часа, устанавливаем соотв. class
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
                        <?=lot_life_time (); ?>
                      </div>
                  </div>
              </div>
          </li>
      <?php } ?>
    </ul>
  </section>
  <ul class="pagination-list">
    <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
    <li class="pagination-item pagination-item-active"><a>1</a></li>
    <li class="pagination-item"><a href="#">2</a></li>
    <li class="pagination-item"><a href="#">3</a></li>
    <li class="pagination-item"><a href="#">4</a></li>
    <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
  </ul>
</div>