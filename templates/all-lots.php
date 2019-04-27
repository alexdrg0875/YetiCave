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
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
</div>
    <?php } else {?>
        <div class="container"><section class="lots"><h2>Товара в данной категории не существует</h2></section></div>
    <?php }?>