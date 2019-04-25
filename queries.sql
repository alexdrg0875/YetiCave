INSERT INTO categories SET name = 'Доски и лыжи', ename = 'boards';
INSERT INTO categories SET name = 'Крепления', ename = 'attachment';
INSERT INTO categories SET name = 'Ботинки', ename = 'boots';
INSERT INTO categories SET name = 'Одежда', ename = 'clothing';
INSERT INTO categories SET name = 'Инструменты', ename = 'tools';
INSERT INTO categories SET name = 'Разное', ename = 'other';

INSERT INTO lots SET title = '2014 Rossignol District Snowboard', category_id = '1', user_id = '1', dt_add = '2019-01-01 00:00:00', dt_end = '2020-01-01 00:00:00', price = '10999', bet_step = '100', path = 'img/lot-1.jpg', description = 'Просто борд';
INSERT INTO lots SET title = 'DC Ply Mens 2016/2017 Snowboard', category_id = '1', user_id = '1', dt_add = '2019-01-01 00:00:00', dt_end = '2020-01-01 00:00:00', price = '159999', bet_step = '100', path = 'img/lot-2.jpg', description = 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
          снег
          мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
          снаряд
          отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
          кэмбер
          позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
          просто
          посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
          равнодушным.';
INSERT INTO lots SET title = 'Крепления Union Contact Pro 2015 года размер L/XL', category_id = '2', user_id = '1', dt_add = '2019-01-01 00:00:00', dt_end = '2020-01-01 00:00:00', price = '8000',  bet_step = '100', path = 'img/lot-3.jpg', description = 'Просто крепление';
INSERT INTO lots SET title = 'Ботинки для сноуборда DC Mutiny Charcoal', category_id = '3', user_id = '1', dt_add = '2019-01-01 00:00:00', dt_end = '2020-01-01 00:00:00', price = '10999',  bet_step = '100', path = 'img/lot-4.jpg', description = 'Просто ботинки';
INSERT INTO lots SET title = 'Куртка для сноуборда DC Mutiny Charcoal', category_id = '4', user_id = '1', dt_add = '2019-01-01 00:00:00', dt_end = '2020-01-01 00:00:00', price = '7500',  bet_step = '100', path = 'img/lot-5.jpg', description = 'Просто куртка';
INSERT INTO lots SET title = 'Маска Oakley Canopy', category_id = '6', user_id = '1', dt_add = '2019-01-01 00:00:00', dt_end = '2020-01-01 00:00:00', price = '5400',  bet_step = '100', path = 'img/lot-6.jpg', description = 'Просто маска';

INSERT INTO users SET dt_add = '2019-01-01 00:00:00', email = 'ignat.v@gmail.com', name = 'Игнат', avatar_path = 'img/user.jpg', password = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka';
INSERT INTO users SET dt_add = '2019-01-01 00:00:00', email = 'kitty_93@li.ru', name = 'Леночка', avatar_path = 'img/user.jpg', password = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa';
INSERT INTO users SET dt_add = '2019-01-01 00:00:00', email = 'warrior07@mail.ru', name = 'Руслан', avatar_path = 'img/user.jpg', password = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW';

INSERT INTO bets SET dt_add = '2019-01-01 00:00:10', user_id = '1', lot_id = '1', bet = '11000';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:20', user_id = '2', lot_id = '1', bet = '11500';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:30', user_id = '1', lot_id = '1', bet = '12000';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:40', user_id = '3', lot_id = '1', bet = '12200';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:10', user_id = '1', lot_id = '2', bet = '161000';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:20', user_id = '2', lot_id = '2', bet = '161500';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:30', user_id = '1', lot_id = '2', bet = '162000';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:40', user_id = '3', lot_id = '2', bet = '162200';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:10', user_id = '1', lot_id = '3', bet = '8000';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:20', user_id = '2', lot_id = '3', bet = '8100';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:30', user_id = '1', lot_id = '3', bet = '8200';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:40', user_id = '3', lot_id = '3', bet = '8300';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:10', user_id = '1', lot_id = '4', bet = '11000';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:20', user_id = '2', lot_id = '4', bet = '11500';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:30', user_id = '1', lot_id = '4', bet = '12000';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:40', user_id = '3', lot_id = '4', bet = '12200';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:10', user_id = '1', lot_id = '5', bet = '8000';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:20', user_id = '2', lot_id = '5', bet = '8100';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:30', user_id = '1', lot_id = '5', bet = '8200';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:40', user_id = '3', lot_id = '5', bet = '8300';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:10', user_id = '1', lot_id = '6', bet = '5400';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:20', user_id = '2', lot_id = '6', bet = '5500';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:30', user_id = '1', lot_id = '6', bet = '5600';
INSERT INTO bets SET dt_add = '2019-01-01 00:00:40', user_id = '3', lot_id = '6', bet = '5700';

SELECT NAME FROM categories ORDER BY id;

SELECT l.title
  , l.price
  , l.path
  , MAX(b.bet)
  , COUNT(b.bet)
  , c.name
FROM lots AS l
JOIN categories AS c
  ON l.category_id = c.id
JOIN bets AS b
  ON b.lot_id = l.id
GROUP BY b.lot_id
ORDER BY l.id ASC;

SELECT l.title
  , c.name
FROM lots AS l
JOIN categories AS c
  ON l.category_id = c.id
WHERE l.id = 1;

UPDATE lots SET title = '2014 Rossignol District Snowboard'
WHERE id = 1;

SELECT u.name
	, b.bet
	, b.dt_add
FROM lots AS l
JOIN bets AS b
ON b.lot_id = l.id
JOIN users AS u
ON b.user_id = u.id
WHERE l.id = 1
ORDER BY b.dt_add DESC
LIMIT 10;

SELECT u.name
  , b.bet
  , DATE_FORMAT(b.dt_add, '%d.%m.%y %H:%i') AS dt_add
FROM bets AS b
JOIN users AS u
ON b.user_id = u.id
WHERE b.lot_id = $_GET[id]
ORDER BY b.bet DESC
LIMIT 10;

SELECT l.id
  , l.title AS name
  , c.name
  , l.price
  , MAX(b.bet) AS max_price
  , l.path AS image_path
  , l.alt_title AS alt
  , l.description
FROM lots AS l
JOIN categories AS c
ON l.category_id = c.id
LEFT JOIN bets AS b
ON b.lot_id=l.id
GROUP BY l.id;



