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