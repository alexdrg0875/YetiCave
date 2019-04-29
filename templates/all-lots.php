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
        <h2>Все лоты в категории «<span><?=$search_string; ?></span>»</h2>
        <ul class="lots__list">
          <?php
          foreach ($lots as $value) {
            print(renderTemplate('templates/_lots_block.php', ['value' => $value]));
          } ?>
        </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a <?php if($cur_page != 1) { print('href="all-lots.php?page='.($cur_page - 1).'&cat='.$search_id.'"'); } ?>>Назад</a></li>
      <?php foreach ($pages as $page) {
        if ($page == $cur_page) { ?>
            <li class="pagination-item pagination-item-active"><a><?= $page; ?></a></li>
        <?php } else { ?>
            <li class="pagination-item"><a href="all-lots.php?page=<?= $page.'&cat='.$search_id; ?>"><?= $page; ?></a></li>
        <?php }
      }?>
        <li class="pagination-item pagination-item-next"><a <?php if($cur_page < $pages_count) { print('href="all-lots.php?page='.($cur_page + 1).'&cat='.$search_id.'"'); } ?>>Вперед</a></li>
</div>
    <?php } else {?>
        <div class="container"><section class="lots"><h2>Товара в данной категории не существует</h2></section></div>
    <?php }?>