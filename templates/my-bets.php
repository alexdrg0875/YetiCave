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
<section class="rates container">
  <h2>Мои ставки</h2>
  <table class="rates__list">
    <?php
    foreach ($lots as $value) {
      print(renderTemplate('templates/_my_lots_block.php', ['value' => $value]));
    } ?>
  </table>
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

<?php } else {?>
    <div class="container"><section class="lots"><h2>У вас еще нет ставок</h2></section></div>
<?php }?>

