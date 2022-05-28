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
if (isset($_COOKIE["password_cookie_token"]) && !empty($_COOKIE["password_cookie_token"]) && !isset($_SESSION['id'])) {
    $row = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `user` WHERE `token_user_auto` LIKE '%" . $_COOKIE["password_cookie_token"] . "%'"));
    foreach ($row as $key => $value) {
        $_SESSION[$key] = $value;
    };
    $rowe = mysqli_fetch_assoc(mysqli_query($CONNECT, "Select * From `cart_users` WHERE `id_user`='" . $_SESSION['id'] . "'"))['item'];
    setcookie('cart', json_encode($rowe));
}

$j = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'assec/data/auth_forms.json');
$GLOBALS['kontakts'] = json_decode($j, true);

$j = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'assec/data/textilian.json');
$GLOBALS['sorters'] = $j;
unset($j);


require_once 'Mobile-Detect-2.8.39/Mobile_Detect.php';
$detect = new Mobile_Detect;
$is_mobile = ($detect->isMobile() && !$detect->isTablet());

if (!$is_mobile) {
    $_SESSION['phone_s'] = 1;
} else {
    $_SESSION['phone_s'] = 0;
}


/* #Регистрация страницы */
$page_list = [
    'product', 'profil', "table_r", "help", "yesorder", "mi_s", "polzowSogls", "politconf", "payment", "delivery", "heplorder",
    "returnsorder", "contacts", "cooperation", "orderchek", "comments", "store", 'rewritePaswords',
    'registers', 'store', 'authorization', 'GLA', 'GLA1', 'GLA_a', 'confirm',
    'userform', 'home', 'cart', 'adminPanels'
];


if ($_SERVER["REQUEST_URI"] == '/') $page = 'home';
else {
    $page       =   substr($_SERVER["REQUEST_URI"], 1);
    $page_mas   =   explode("&", "$page");
    $page       =   $page_mas[0];
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
            not_found();
    }
}
if (!isset($_SESSION['type']) || $_SESSION['type'] == 0) {
    $type = "roz";
} else if (isset($_SESSION['type']) && $_SESSION['type'] == 1) {
    $type = "opt";
} else if (isset($_SESSION['type']) && $_SESSION['type'] == 2) {
    $type = "admin";
}

$c = 20;


if (file_exists('all/' . $page . '.php')) include('all/' . $page . '.php');

else if ((isset($_SESSION['id']) or isset($_SESSION['ADMIN_LOGIN_IN'])) and file_exists('auth/' . $page . '.php')) include('auth/' . $page . '.php');

else if ((!isset($_SESSION['id']) or isset($_SESSION['ADMIN_LOGIN_IN'])) and file_exists('guest/' . $page . '.php')) include('guest/' . $page . '.php');

else if (isset($_SESSION['ADMIN_LOGIN_IN'])) {
    if (file_exists('admin/' . $page . '.php')) include('admin/' . $page . '.php');
} else if (!isset($_SESSION['id']) and file_exists('auth/' . $page . '.php')) {
    include('guest/authorization.php');
} else {
    not_found();
}

function lysten($data)
{
    exit('{"arr" : "' . $data . '"}');
}
function go($url)
{
    exit('{"go" : "' . $url . '"}');
}

function not_found()
{
    if (isset($_SESSION['ADMIN_LOGIN_IN'])) {
        print_r("<pre>");
        print_r(debug_backtrace());
        echo ("</pre>"); // проверить кто вызывает функцию
    }
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
function random_str($num = 10)
{
    //return substr(str_shuffle('0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'), 0, $num);
    return substr(str_shuffle('0123456789'), 0, $num);
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
    }
?>
    <!DOCTYPE html>
    <html lang="RU-ru">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" href="assec/css/index.css">
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

            <? if (isset($_SESSION['type']) && $_SESSION['type'] == 1) { ?>
                window.optovik = 1;
                <? } else { ?>window.optovik = 0;
            <? } ?>

            <? unset($f) ?>
        </script>
        <header>
            <? include_once("assec/php/header.php"); ?>
        </header>
        <main>
        <?
    }

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
        </footer>
    </body>

    </html>
<? }







/* media="screen and (max-width: 768px)" href="assec/css/style_Mobil.css">
    <link rel="stylesheet" media="screen and (min-width: 769px) and (max-width: 1080px)" href="assec/css/style_PC-center.css">
    <link rel="stylesheet" media="screen and (min-width: 1080px)"*/
