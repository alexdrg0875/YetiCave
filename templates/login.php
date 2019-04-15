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
<form class="form container <?=$form_error; ?>" action="login.php" method="post"> <!-- form--invalid -->
  <h2>Вход</h2>
  <div class="form__item <?=$email_error; ?>"> <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$email; ?>" required>
    <span class="form__error"><?=$description_email_err; ?></span>
  </div>
  <div class="form__item form__item--last <?=$pass_error; ?>">
    <label for="password">Пароль*</label>
    <input id="password" type="text" name="password" placeholder="Введите пароль" required>
    <span class="form__error"><?=$description_pass_err; ?></span>
  </div>
  <button type="submit" class="button">Войти</button>
</form>
