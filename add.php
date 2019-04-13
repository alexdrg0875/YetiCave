<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 30.03.2019
 * Time: 15:30
 */
require_once ('data.php');
require_once ('functions.php');

#print_r($lots[$_GET['id']]);

// Выполняется при отправке формы с последующей валидацией
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    $lot_name = $_POST['lot-name'] ?? '';
    $category = $_POST['category'] ?? 'Выберите категорию';
    $message = $_POST['message'] ?? '';
    $lot_rate = $_POST['lot-rate'] ?? '';
    $lot_step = $_POST['lot-step'] ?? '';
    $lot_date = $_POST['lot-date'] ?? '';

// проверка полей на пустоту
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'form__item--invalid';
            $form_error = 'form--invalid';
        }
    }

// проверка полей на соответствие
    if ($category == 'Выберите категорию') {
        $errors['category'] = 'form__item--invalid';
        $form_error = 'form--invalid';
    }
    if (!is_numeric($lot_rate)) {
        $errors['lot-rate'] = 'form__item--invalid';
        $form_error = 'form--invalid';
    }
    if (!is_numeric($lot_step)) {
        $errors['lot-step'] = 'form__item--invalid';
        $form_error = 'form--invalid';
    }

// проверка загруженного изображеня лота
    if (isset($_FILES['photo2'])) {
        $file_name = $_FILES['photo2']['name'];
        $file_path = __DIR__ . '/img/';
        $file_url = $file_path . $file_name;

        move_uploaded_file($_FILES['photo2']['tmp_name'], $file_path . $file_name);
    }

// Выполняется если нет ошибок
    if ($form_error == '') {
        $page_content = renderTemplate('templates/lot.php', [
            'lot_name' => $lot_name,
            'lot_image' => '',
            'lot_alt' => 'Изображение лота',
            'lot_category' => $category,
            'lot_price' => $lot_rate,
            'lot_description' => $message
        ]);

        $layout_content = renderTemplate('templates/layout.php', [
            'content' => $page_content,
            'categories' => $categories,
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'user_avatar' => $user_avatar,
            'title' => $lot_name,
            'main_class' => ''
        ]);

        print($layout_content);

    }

// Выполняется для исправления ошибок в форме
    if ($form_error != '') {
        $page_content = renderTemplate('templates/add.php', [
            'form_error' => $form_error,
            'name_error' => $errors['lot-name'],
            'category_error' => $errors['category'],
            'message_error' => $errors['message'],
            'rate_error' => $errors['lot-rate'],
            'step_error' => $errors['lot-step'],
            'date_error' => $errors['lot-date'],
            'file_error' => $errors['file'],
            'lot_name' => $lot_name,
            'category' => $category,
            'message' => $message,
            'lot_rate' => $lot_rate,
            'lot_step' => $lot_step,
            'lot_date' => $lot_date
        ]);

        $layout_content = renderTemplate('templates/layout.php', [
            'content' => $page_content,
            'categories' => $categories,
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'user_avatar' => $user_avatar,
            'title' => 'Добавление лота',
            'main_class' => ''
        ]);

        print($layout_content);
}

} else {

// Выполняется при первой загрузке страницы
    $page_content = renderTemplate('templates/add.php');

    $layout_content = renderTemplate('templates/layout.php', [
        'content' => $page_content,
        'categories' => $categories,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'title' => 'Добавление лота',
        'main_class' => ''
    ]);

    print($layout_content);
}

?>