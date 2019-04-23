    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
          <?php
          foreach ($categories as $key) { ?>
            <li class="promo__item promo__item--<?=$key['ename']; ?>">
                <a class="promo__link" href="all-lots.html"><?=$key['name']; ?></a>
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
            foreach ($lots as $key) {?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?=$key['image_path'];?>" width="350" height="260" alt="<?=htmlspecialchars($key['alt']);?>">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=$key['category'];?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$key['id']; ?>"><?=htmlspecialchars($key['name']);?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=format_amount(htmlspecialchars($key['price']));?></span>
                            </div>
                            <div class="lot__timer timer">
                                <?=lot_life_time (); ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </section>