<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
      <?php
      foreach ($categories as $value) { ?>
        <li class="promo__item promo__item--<?=$value['ename']; ?>">
            <a class="promo__link" href="all-lots.php?cat=<?=$value['id']; ?>"><?=$value['name']; ?></a>
        </li>
      <?php } ?>
    </ul>
</section>
<div class="container">
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php
        foreach ($lots as $value) {
            print(renderTemplate('templates/_lots_block.php', ['value' => $value]));
        } ?>
    </ul>
</section>
<ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a <?php if($cur_page != 1) { print('href="index.php?page='.($cur_page - 1).'"'); } ?>>Назад</a></li>
    <?php foreach ($pages as $page) {
      if ($page == $cur_page) { ?>
          <li class="pagination-item pagination-item-active"><a><?= $page; ?></a></li>
      <?php } else { ?>
          <li class="pagination-item"><a href="index.php?page=<?= $page; ?>"><?= $page; ?></a></li>
      <?php }
    }?>
        <li class="pagination-item pagination-item-next"><a <?php if($cur_page < $pages_count) { print('href="index.php?page='.($cur_page + 1).'"'); } ?>>Вперед</a></li>
</ul>