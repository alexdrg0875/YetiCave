    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="promo__item promo__item--attachment">
                <a class="promo__link" href="all-lots.html">Крепления</a>
            </li>
            <li class="promo__item promo__item--boots">
                <a class="promo__link" href="all-lots.html">Ботинки</a>
            </li>
            <li class="promo__item promo__item--clothing">
                <a class="promo__link" href="all-lots.html">Одежда</a>
            </li>
            <li class="promo__item promo__item--tools">
                <a class="promo__link" href="all-lots.html">Инструменты</a>
            </li>
            <li class="promo__item promo__item--other">
                <a class="promo__link" href="all-lots.html">Разное</a>
            </li>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php
            $index = 0;
            $num_count = count($lots);
            while ($index < $num_count){?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="img/<?=$lots[$index]['image_name'];?>" width="350" height="260" alt="<?=htmlspecialchars($lots[$index]['alt']);?>">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=$lots[$index]['category'];?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$index; ?>"><?=htmlspecialchars($lots[$index]['name']);?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=format_amount(htmlspecialchars($lots[$index]['price']));?></span>
                            </div>
                            <div class="lot__timer timer">
                                <?=lot_life_time (); ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php $index++; } ?>
        </ul>
    </section>