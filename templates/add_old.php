  <nav class="nav">
    <ul class="nav__list container">
      <li class="nav__item">
        <a href="all-lots.html">Доски и лыжи</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Крепления</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Ботинки</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Одежда</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Инструменты</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Разное</a>
      </li>
    </ul>
  </nav>
  <form class="form form--add-lot container <?=$form_error; ?>" action="add.php" method="post"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?=$name_error; ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=htmlspecialchars($lot_name); ?>">
        <span class="form__error">Введите наименование лота</span>
      </div>
      <div class="form__item <?=$category_error; ?>">
        <label for="category">Категория</label>
        <select id="category" name="category" >
          <option>Выберите категорию</option>
          <option>Доски и лыжи</option>
          <option>Крепления</option>
          <option>Ботинки</option>
          <option>Одежда</option>
          <option>Инструменты</option>
          <option>Разное</option>
        </select>
        <span class="form__error">Выберите категорию</span>
      </div>
    </div>
    <div class="form__item form__item--wide <?=$message_error; ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота"><?=htmlspecialchars($message); ?></textarea>
      <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="photo2" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?=$rate_serror; ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?=htmlspecialchars($lot_rate); ?>" >
        <span class="form__error">Введите начальную цену</span>
      </div>
      <div class="form__item form__item--small <?=$step_error; ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?=htmlspecialchars($lot_step); ?>" >
        <span class="form__error">Введите шаг ставки</span>
      </div>
      <div class="form__item <?=$date_error; ?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=htmlspecialchars($lot_date); ?>" >
        <span class="form__error">Введите дату завершения торгов</span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
