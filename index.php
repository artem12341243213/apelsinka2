<?

//php_value error_reporting 500

/*
опт - eajlusafsjxd@cutradition.com 123456789 
розница - blwyhomh@cutradition.com 123456789
админ - elshgsc@cutradition.com 123456789
*/
session_start();

function getIp()
{
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
}

$CONNECT = mysqli_connect('localhost', 'admin', '', 'apelsinka');
if (!$CONNECT) exit('Error mysqli');
//ini_set('session.cookie_httponly', 1);
// $CONNECT = mysqli_connect('localhost', 'toropchina', 'rutiAns_2a', 'toropchina');

/* Авторизация */
if ((isset($_COOKIE["password_cookie_token"]) && !empty($_COOKIE["password_cookie_token"])) && !isset($_SESSION['id']) && !isset($_SESSION['confirm'])) {
    $row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `user` WHERE `token_user_auto` LIKE '%" . $_COOKIE["password_cookie_token"] . "%'"));
    foreach ($row as $key => $value) {
        $_SESSION[$key] = $value;
    };
    $rowe = mysqli_fetch_assoc(mysqli_query($CONNECT, "Select * From `cart_users` WHERE `id_user`='" . $_SESSION['id'] . "'"))['item'];
    setcookie('cart', json_encode($rowe));
    unset($row);
    unset($rowe);
}

$j = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'assec/data/auth_forms.json');
$GLOBALS['kontakts'] = json_decode($j, true);

$j = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'assec/data/textilian.json');
$sorters = $j;
unset($j);

if (isset($_SESSION['id'])) {
    if (!isset($_SESSION['favorits'])) {
        $_SESSION['favorits'] = [];
    }
}
/* #Регистрация страницы */
$page_list = [
    'product', 'profil', "table_r", 'delit_user_mail', "help", "yesorder", "mi_s", "polzowSogls", "politconf", "payment", "delivery", "heplorder",
    "returnsorder", "contacts", "cooperation", "orderchek", "comments", "store", 'rewritePaswords',
    'registers', 'store', 'authorization', 'GLA', 'GLA1', 'GLA_a', 'confirm',
    'userform', 'home', 'cart', 'adminPanels'
];

if ($_SERVER["REQUEST_URI"] == '/') $page = 'home';
else {
    $page       =   substr($_SERVER["REQUEST_URI"], 1);
    $page_mas   =   explode("&", "$page");
    $page       =   $page_mas[0];
    unset($page_mas);
    $mixe       =   0;

    if (!preg_match('/^[A-z0-9]{3,15}$/', $page)) not_found();
    else {
        foreach ($page_list as $items) {
            if ($items != $page) {
                $mixe++;
            }
        }
        $nums_length = (int) count($page_list);

        if ($mixe >= $nums_length)
            not_found(404);
    }
    unset($mixe);
    unset($page_list);
}
unset($_SESSION['ADMIN_LOGIN_IN']);
if (!isset($_SESSION['type']) || $_SESSION['type'] == 0) {
    $type = "roz";
} else if (isset($_SESSION['type']) && $_SESSION['type'] == 1) {
    $type = "opt";
} else if (isset($_SESSION['type']) && $_SESSION['type'] == 2) {
    $type = "admin";
    $_SESSION['ADMIN_LOGIN_IN'] = 1;
}


if (file_exists('all/' . $page . '.php')) include('all/' . $page . '.php');

else if ((isset($_SESSION['id']) or isset($_SESSION['ADMIN_LOGIN_IN'])) and file_exists('auth/' . $page . '.php')) include('auth/' . $page . '.php');

else if ((!isset($_SESSION['id']) or isset($_SESSION['ADMIN_LOGIN_IN'])) and file_exists('guest/' . $page . '.php')) include('guest/' . $page . '.php');

else if (isset($_SESSION['ADMIN_LOGIN_IN'])) {
    if (file_exists('admin/' . $page . '.php')) include('admin/' . $page . '.php');
} else if (!isset($_SESSION['id']) and file_exists('auth/' . $page . '.php')) {
    http_response_code(401);
    include('guest/authorization.php');
} else {
    not_found();
}
unset($page);

function go($url)
{
    exit('{"go" : "' . $url . '"}');
}

function not_found($t = '404')
{
    if (isset($_GET['errors'])) $t = code($_GET['errors']);
    include_once 'assec/php/notfound.php';
    exit('');
}

function captch_show()
{
    $questions = array(
        1 => "Столица России",
        2 => "Имя Пушкина",
        3 => "Введите цифру : '1'",
        4 => "Введите цифру : '2'",
        5 => "Введите цифру : '3'",
        6 => "Введите цифру : '4'",
    );

    $num = mt_rand(1, count($questions));

    $_SESSION['captcha'] = $num;
}

function captch_valid()
{
    $answers = array(
        1 => "москва",
        2 => "александр",
        3 => "1",
        4 => "2",
        5 => "3",
        6 => "4",
    );
    $otv = array_search(strtolower($_POST['captcha']), $answers);
    if ($_SESSION['captcha'] != $otv) {
        message('Ответ на капчу', '2', 'ответ на вопрос указан не верно');
    }
}
function random_str($num = 10, $types = 'user')
{
    switch ($types) {
        case "user":
            return substr(str_shuffle('0123456789'), 0, $num);
            break;
        case "admin":
            $listAlpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $listNonAlpha = ',;:!?.$/*-@_;./*?$-!,';
            return str_shuffle(
                substr(str_shuffle($listAlpha), 0, $num) .
                    substr(str_shuffle($listNonAlpha), 0, rand(1, 4))
            );
            break;
    }
}


function code($i, $b = 'i')
{
    switch ($b) {
        case 'i': //поле ввода
            $i    = trim($i, ' ');
            $i    = strip_tags($i);
            $i    = htmlentities($i);
            return $i;
            break;
        case 's':
            $i    = strip_tags($i);
            $i    = htmlentities($i);
            $ei   = base64_encode($i);
            return $ei;
            break;
    }
}

function decode($i)
{
    $m = base64_decode($i);
    $m = strip_tags($m);
    $m = htmlentities($m);
    return $m;
}

function message($heade, $tip, $text, $types = true, $go = '')
{
    if ($go == '') {
        switch ($types) {
            case true: {
                    exit('{"mesg"  : "1",
                        "titel"     : "' . $text . '",
                        "tip"       : ' . $tip . ',
                        "headers"   : "' . $heade . '" }');
                    break;
                }
            case false: {
                    print('{"mesg" : "1",
                        "titel"     : "' . $text . '",
                        "tip"       : ' . $tip . ',
                        "headers"   : "' . $heade . '" }');
                    break;
                }
        }
    } else {
        switch ($types) {
            case true: {
                    exit('{"mesg"      : "1",
                        "titel"         : "' . $text . '",
                        "tip"           : ' . $tip . ',
                        "headers"       : "' . $heade . '" ,
                        "go_i"            : "' . $go . '"}');
                    break;
                }
            case false: {
                    print('{"mesg"     : "1",
                        "titel"         : "' . $text . '",
                        "tip"           : ' . $tip . ',
                        "headers"       : "' . $heade . '" ,
                        "go_i"            : "' . $go . '"}');
                    break;
                }
        }
    }
}



function hedeer($title, $css = [], $href = "")
{


    $css_incl = '';
    if (!empty($css) && $css != null) {
        for ($i = 0; $i < count($css); $i++) {
            $css_incl .= "<link rel='stylesheet' href='assec/css/$css[$i].css'>";
        }
    }
    if ($href != "") {
        $css_incl .= "<link rel='stylesheet' href='$href'>";
    } ?>
    <!DOCTYPE html>
    <html lang="RU-ru">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="assec/css/index.css">
        <meta property="og:title" content="Детская одежда от производителя" />
        <meta property="og:description" content="Детская одежда от производителя. Опт и рознциа по низким ценам." />
        <meta property="og:image" content="https://apelsinka.tech/assec/images/dopMenu-element5.jpg" />
        <meta property="og:locale" content="RU-ru" />
        <meta property="og:url" content="https://apelsinka.tech/authorization" />
        <meta property="og:url" content="https://apelsinka.tech/profil" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <? print($css_incl) ?>

        <link href="assec/css/toat.css" rel="stylesheet">
        <script src="assec/js/toast.js"></script>
        <style>
            .modals_otlid {
                background: white;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                z-index: 99999;
            }

            .otladka button {
                background: #ffe10b;
                padding: 10px;
                border: 1px solid;
                border-radius: 5px;
                cursor: pointer;
                margin-bottom: 13px;
                position: fixed;
                right: 120px;
            }
        </style>
        <meta name="yandex-verification" content="eb2808bf41f96492">
        <meta name="google-site-verification" content="onmBUOCCyHPnLfSkDq5w6sVCY0FOGhy1MtaQwv4kVEc" />
        <title><? print($title) ?></title>
    </head>

    <body>
        <?
        if (isset($_SESSION['ADMIN_LOGIN_IN'])) { ?>
            <div class="modals_otlid hidden_items">
                <div class="otladka">
                    <button onclick="closse('modals_otlid')"> Закрыть </button>
                    <p> Скидка на 5% - <code>HOT22S</code></p>
                    <pre><? print_r($GLOBALS) ?></pre>
                    <input type="text" id="titititit" oninput="fififififi()" onclick="fiiiiiiii()">
                    <input type="text" id="titi">
                    <p>Ширина: <input type="text" id="width"></p>
                    <p>Высота: <input type="text" id="height"></p>
                    <a href="alisa.7z" download>alisa</a>
                </div>
            </div>
            <button onclick="opens('modals_otlid')">Opens</button>
        <? } ?>
        <script>
            window.user_after = <? if (isset($_SESSION['id'])) echo 'true';
                                else echo 'false' ?>;

            <? if (isset($_SESSION['type'])) {

                if ($_SESSION['type'] == 0) { ?>
                    window.optovik = 0;
                <? } else if ($_SESSION['type'] == 1) { ?>
                    window.optovik = 1;
                <?
                } else if ($_SESSION['type'] == 2) { ?>
                    window.optovik = 2;
            <? }
            } ?>

            <? unset($f) ?>
        </script>

        <header>
            <? include_once("assec/php/header.php"); ?>
        </header>
        <main>
        <?
    };


    function footer($mi = [], $script = "", $type = "")
    { ?>
        </main>
        <? if (isset($_SESSION['ADMIN_LOGIN_IN'])) { ?>
            <script>
                function fififififi() {
                    var se = document.getElementById("titititit").value;
                    s = se * 16;
                    document.getElementById("titi").value = s;
                }

                function fiiiiiiii() {
                    document.getElementById("titititit").value = "";
                }

                document.getElementById("width").value = window.outerWidth;
                document.getElementById("height").value = window.outerHeight;
            </script>
        <? } ?>


        <footer>

            <? require_once("assec/php/footer.php"); ?>
            <script async src="assec/js/lazyLoad.js"></script>
            <script async type="text/javascript">
                window.onload = function() {
                    (function(d, w, c) {
                        (w[c] = w[c] || []).push(function() {
                            try {
                                w.yaCounter88782445 = new Ya.Metrika({
                                    id: 88782445,
                                    clickmap: true,
                                    trackLinks: true,
                                    accurateTrackBounce: true
                                });
                            } catch (e) {}
                        });

                        var n = d.getElementsByTagName("script")[0],
                            s = d.createElement("script"),
                            f = function() {
                                n.parentNode.insertBefore(s, n);
                            };
                        s.type = "text/javascript";
                        s.async = true;
                        s.src = "https://mc.yandex.ru/metrika/watch.js";

                        if (w.opera == "[object Opera]") {
                            d.addEventListener("DOMContentLoaded", f, false);
                        } else {
                            f();
                        }
                    })(document, window, "yandex_metrika_callbacks");
                }
            </script>
            </script>
            <noscript>
                <div><img src="https://mc.yandex.ru/watch/88782445" style="position:absolute; left:-9999px;" alt="" /></div>
            </noscript>
            <!-- /Yandex.Metrika counter -->
        </footer>
    </body>

    </html>
<? }
