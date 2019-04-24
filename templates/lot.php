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
  <section class="lot-item container">
    <h2><?=htmlspecialchars($lot_name); ?></h2>
    <div class="lot-item__content">
      <div class="lot-item__left">
        <div class="lot-item__image">
          <img src="<?=$lot_image; ?>" width="730" height="548" alt="<?htmlspecialchars($lot_alt); ?>">
        </div>
        <p class="lot-item__category">Категория: <span><?=$lot_category; ?></span></p>
        <p class="lot-item__description"><?=htmlspecialchars($lot_description); ?></p>
      </div>
      <div class="lot-item__right">
        <?php if ($is_auth && ($user_id != $lot_user_id)) {
          if ((int)lot_life_time() < 1) {    // если осталось время жизни лота менее часа, устанавливаем соотв. class
            $timer_class = 'timer--finishing';
          } ?>
        <div class="lot-item__state">
          <div class="lot-item__timer timer <?=$timer_class; ?>">
            <?=lot_life_time(); ?>
          </div>
          <div class="lot-item__cost-state">
            <div class="lot-item__rate">
              <span class="lot-item__amount">Текущая цена</span>
              <span class="lot-item__cost"><?=format_amount(htmlspecialchars($max_bet)); ?></span>
            </div>
            <div class="lot-item__min-cost">
              Мин. ставка <span><?=format_amount(htmlspecialchars($max_bet + $lot_bet_step)); ?></span>
            </div>
          </div>
          <form class="lot-item__form" action="lot.php?id=<?=$lot_id; ?>" method="post">
            <p class="lot-item__form-item">
              <label for="cost">Ваша ставка</label>
              <input id="cost" type="number" name="cost" placeholder="<?=htmlspecialchars($max_bet + $lot_bet_step); ?>">
            </p>
            <button type="submit" class="button">Сделать ставку</button>
          </form>
        </div>
        <?php }; ?>
        <div class="history">
          <h3>История ставок (<span><?=$row_cnt; ?></span>)</h3>
          <table class="history__list">
            <?php foreach ($bets as $value) { ?>
            <tr class="history__item">
              <td class="history__name"><?=htmlspecialchars($value['name']); ?></td>
              <td class="history__price"><?=format_amount(htmlspecialchars($value['bet'])); ?></td>
              <td class="history__time"><?=htmlspecialchars($value['dt_add']); ?></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </section>
