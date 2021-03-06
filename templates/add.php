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
  <form class="form form--add-lot container <?=$form_error; ?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid --> <!--https://echo.htmlacademy.ru-->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?=$name_error; ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$lot_name; ?>" required>
        <span class="form__error">Введите наименование лота</span>
      </div>
      <div class="form__item <?=$category_error; ?>">
        <label for="category">Категория</label>
        <select id="category" name="category" required>
          <option>Выберите категорию</option>
          <?php
          foreach ($categories as $value) { ?>
              <option><?=htmlspecialchars($value['name']); ?></option>
          <?php } ?>
        </select>
        <span class="form__error">Выберите категорию</span>
      </div>
    </div>
    <div class="form__item form__item--wide <?=$message_error; ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" required><?=$message; ?></textarea>
      <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file <?=$file_error; ?>"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="<?=$file_url; ?>" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="file" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?=$rate_error; ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$lot_rate; ?>" required>
        <span class="form__error">Введите начальную цену</span>
      </div>
      <div class="form__item form__item--small <?=$step_error; ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$lot_step; ?>" required>
        <span class="form__error">Введите шаг ставки</span>
      </div>
      <div class="form__item <?=$date_error; ?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$lot_date; ?>" required>
        <span class="form__error">Введите дату завершения торгов</span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
