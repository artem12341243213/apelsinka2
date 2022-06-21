<?php
if (isset($_SESSION['ADMIN_LOGIN_IN'])) {
    print_r("<pre>");
    print_r(debug_backtrace());
    echo ("</pre>"); // проверить кто вызывает функцию
}
if ($types == "404") {
    http_response_code($types);
    $text = "<h1>Ошибка $types</h1>
    <p>Искомая страница не существует, либо была перенесена</p>";
} else if ($types == "500") {
    http_response_code($types);
    $text = "<h1>Ошибка $types</h1>
        <p>Ой... что-то сломалось, пожалуйста попробуйте позже</p>";
} else if ($types == "503") {
    http_response_code($types);
    $text = "<h1>Ошибка $types</h1>
        <p>Ой... что-то сломалось, пожалуйста попробуйте позже</p>";
} else if ($types == "408") {
    http_response_code($types);
    $text = "<h1>Ошибка $types</h1>
        <p>Сервер не долждался вашего ответа, пожалуйста попробуйте позже</p>";
} else if ($types == "522") {
    http_response_code($types);
    $text = "<h1>Ошибка $types</h1>
        <p>Соединения с сервером было не установленно</p>";
} else if ($types == "403") {
    http_response_code($types);
    $text = "<h1>Ошибка $types</h1>
        <p>Вам сюда нельзя</p>";
} else {
    http_response_code($types);
    $text = "<h1>Ошибка $types</h1>
        <p>Ой... что-то сломалось, пожалуйста попробуйте позже</p>";
}
//http_response_code(401); // требуется авторизация
hedeer('Ошибка');
?>
<div class="not_found">
    <div class="global">
        <div class="not_found_block text-g">
            <? print($text) ?>
            <p><a href="/">Главная страницы</a></p>
        </div>

    </div>
</div>
<? footer(); ?>