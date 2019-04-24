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
    <h2>История просмотров</h2>
    <ul class="lots__list">
      <?php
      if (isset($lots_viewed)) {
        foreach($lots_viewed as $value):?>
          <li class="lots__item lot">
            <div class="lot__image">
              <img src="<?=$lots[$value]['image_path']; ?>" width="350" height="260" alt="<?=htmlspecialchars($lots[$value]['alt']); ?>">
            </div>
            <div class="lot__info">
              <span class="lot__category"><?=$lots[$value]['category']; ?></span>
              <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$value; ?>"><?=htmlspecialchars($lots[$value]['name']); ?></a></h3>
              <div class="lot__state">
                <div class="lot__rate">
                  <span class="lot__amount">Стартовая цена</span>
                  <span class="lot__cost"><?=format_amount(htmlspecialchars($lots[$value]['price']));?></span>
                </div>
                <div class="lot__timer timer">
                  16:54:12
                </div>
              </div>
            </div>
          </li>
      <?php endforeach; } ?>
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