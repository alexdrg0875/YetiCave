<nav class="nav">
  <ul class="nav__list container">
    <?php
    foreach ($categories as $value) { ?>
        <li class="nav__item">
            <a href="all-lots.php?cat=<?=$value['id']; ?>"><?=htmlspecialchars($value['name']); ?></a>
        </li>
    <?php } ?>
  </ul>
</nav>
<?php
if($search_result) { ?>
<div class="container">
  <section class="lots">
    <h2>Результаты поиска по запросу «<span><?=$search_string; ?></span>»</h2>
    <ul class="lots__list">
      <?php
      foreach ($lots as $value) {
        print(renderTemplate('templates/_lots_block.php', ['value' => $value]));
      } ?>
    </ul>
  </section>
<ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a <?php if($cur_page != 1) { print('href="search.php?page='.($cur_page - 1).'&search='.$search_string.'"'); } ?>>Назад</a></li>
    <?php foreach ($pages as $page) {
      if ($page == $cur_page) { ?>
          <li class="pagination-item pagination-item-active"><a><?= $page; ?></a></li>
      <?php } else { ?>
          <li class="pagination-item"><a href="search.php?page=<?= $page.'&search='.$search_string; ?>"><?= $page; ?></a></li>
      <?php }
    }?>
        <li class="pagination-item pagination-item-next"><a <?php if($cur_page < $pages_count) { print('href="search.php?page='.($cur_page + 1).'&search='.$search_string.'"'); } ?>>Вперед</a></li>
</ul>
<?php } else {?>
    <div class="container"><section class="lots"><h2>Ничего не найдено по вашему запросу</h2></section></div>
<?php }?>