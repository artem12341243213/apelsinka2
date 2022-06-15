<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/mail.php');


session_start();

if (isset($_POST['elem'])) {
    if ($_POST['elem'] == 'exit') {

        unset($_SESSION['type']);
        unset($_SESSION['img']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['name']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['phone']);
        unset($_SESSION['region']);
        unset($_SESSION['sity']);
        unset($_SESSION['strasse']);
        unset($_SESSION['home']);
        unset($_SESSION['inpex_home']);
        unset($_SESSION['token_user_auto']);
        unset($_SESSION['kvart']);

        if (isset($_COOKIE['cart']))        unset($_COOKIE['cart']);

        if (isset($_COOKIE["password_cookie_token"])) {

            $Pasword = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `token_user_auto` FROM `user` WHERE  `id` =  '" . $_SESSION["id"] . "'"));
            $Pasword = explode("|", $Pasword['token_user_auto']);
            $listions = '';
            foreach ($Pasword as $item) {

                if ($item == $_COOKIE["password_cookie_token"])
                    $listions .= '';
                $listions .= $item;
            }
            $update_password_cookie_token = mysqli_query($CONNECT, "UPDATE `user` SET `token_user_auto` = '" . $listions . "' WHERE `id` = '" . $_SESSION["id"] . "'");
            if (!$update_password_cookie_token) {
                echo "Ошибка " . mysqli_error($CONNECT);
            } else {
                setcookie("password_cookie_token", "", time() - 3600);
            }
        }
        unset($_SESSION['id']);

        go('home');
    } else if ($_POST['elem'] == 'beak_backet')      print('В разработке');
    else if ($_POST['elem'] == 'table_razmers')    require('assec/php/table_raz.php');
    else if ($_POST['elem'] == 'favorits') {
        $los = mysqli_query($CONNECT, "SELECT * From `favoritesu`WHERE `id_user` = " . $_SESSION['id']);
        if (($los->num_rows) != 0) {
            $los = mysqli_fetch_all($los);
            $mi = [];
            foreach ($los as $item) {
                array_push($mi, $item[1]);
            }
            $_SESSION['favorits'] = $mi;
        }

        require('assec/php/block/favorits.php');
    } else if ($_POST['elem'] == "prise") {
?>
        <div class="box_pri">
            <p> Ссылка на скачивание прайс листа</p>
            <? if (file_exists("assec/data/prise.xls")) {
            ?><div> <a href="assec/data/prise.xls" id="files_prise">Прайс-Лист</a></div>
            <? } ?>
            <? if (file_exists("assec/data/prise.xlsx")) {
            ?><div> <a href="assec/data/prise.xlsx" id="files_prise">Прайс-Лист</a></div><? } ?>
        </div>

<?

    } else if ($_POST['elem'] == 'cart')              print('В разработке');
    else if ($_POST['elem'] == 'editor_user')       require('assec/php/block/user_edit_data.php');
}

if (isset($_POST['addFav_f']) && $_POST['addFav_f'] == 1) {
    $article_ = code($_POST['articl']);
    $id_users = $_SESSION['id'];

    $los = mysqli_query($CONNECT, "SELECT * From `favoritesu`WHERE `id_user` = $id_users and `product` = $article_");
    if (($los->num_rows) == 1) {
        $sql =  "DELETE FROM `favoritesu` WHERE `id_user` = $id_users and `product` = $article_";

        if (mysqli_query($CONNECT, $sql)) {
            $num = array_search($article_, $_SESSION['favorits']);
            if ($num != false) {
                unset($_SESSION['favorits'][$num]);
                sort($_SESSION['favorits']);
            }
            print_r('{"titel":"Товар удален из избранного",
                "tip": 1,
                "headers"   : "Избранное",
                "items" : "no"}');
        } else message("Избранное", 2,  "Упс ... Что-то пошло не так, пожалуйста повторите попытку позже");
    } else if (($los->num_rows) == 0) {
        $sql = "INSERT INTO `favoritesu` (`id_user`, `product`) VALUES ( $id_users , $article_)";

        if (mysqli_query($CONNECT, $sql)) {

            if (isset($_SESSION['favorits'])) {
                if (array_search($article_, $_SESSION['favorits']))
                    array_push($_SESSION['favorits'], $article_);
            } else {
                $mi = [];
                array_push($mi, $article_);
                $_SESSION['favorits'] = $mi;
            }
            print_r('{ "titel":"Товар успешно добавлен в избранное, посмотреть избранные товары можно в личном кабинете",
            "tip": 1,
            "headers"   : "Избранное",
            "items" : "yes"
        }');
        }
    } else message("Избранное", 2,  "Упс ... Что-то пошло не так, пожалуйста повторите попытку позже");
}

if (isset($_FILES) && $_FILES != null && !isset($_POST['elem'])) {
    if ($_FILES != null) {
        $img_product = '';

        foreach ($_FILES as $item) {
            /* print_r($item); */
            $uploads = 'assec/images/users';
            if ($item["error"] == 0) {


                $tmp_name = $item["tmp_name"];
                // basename() может предотвратить атаку на файловую систему;
                // может быть целесообразным дополнительно проверить имя файла
                $name = basename($item["name"]);
                move_uploaded_file($tmp_name, "$uploads/$name");
                $file = $item["name"];
                $img_product =  $file;
            }
        }
        mysqli_query($CONNECT, "UPDATE `user` SET `img` = '$img_product' WHERE `user`.`id` =" . $_SESSION['id'] . ";");
        $_SESSION['img'] = $img_product;
        message("Картинки", 1, "Картинки были успешно загружены");
    } else {
        message("Картинки", 1, "Картинки не загружены");
    }
}
if (isset($_POST['edit_data_user_f']) && $_POST['edit_data_user_f'] == 1) {

    $last_name = code($_POST['last_name']);
    $name = code($_POST['name']);
    $first_name = code($_POST['first_name']);
    $phone = code($_POST['phone'], 's');
    $obl = code($_POST['obl'], 's');
    $sity = code($_POST['sity'], 's');
    $starsse = code($_POST['starsse'], 's');
    $home = code($_POST['home'], 's');
    $homeV = code($_POST['homeV'], 's');
    $index = code($_POST['Address_ZipPostalCode'], 's');

    $sql = "UPDATE `user` SET 
    `name` = '$name', `first_name` = '$first_name', `last_name` = '$last_name', 
    `phone` = '$phone', `region` = '$obl', `sity` = '$sity', `strasse` = ' $starsse', `home` = '$home', 
    `inpex_home` = '$index', `kvart` = '$homeV' 
    
    WHERE `user`.`id` = " . $_SESSION['id'] . ";";

    if (mysqli_query($CONNECT, $sql)) {
        message("Обновление информации", 1, "Данные были успешно сохранены. После обновления страницы станут видимы", false);
    };

    $lwww = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `user` where `id` = " . $_SESSION['id'] . ";"));

    foreach ($lwww as $key => $value) {
        $_SESSION[$key] = $value;
    };
}

if (isset($_POST['orderPrisesCasec_f']) && $_POST['orderPrisesCasec_f'] == 1) {


    $cart = $_COOKIE['carts'];

    $cart = json_decode($cart, true);

    $number_orders = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT count(`id`) as 'num' FROM `past_orders`"))['num'] + 1;

    //$number_owadwarders =  mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `past_orders` WHERE `id` = 3"));

    $titles = "";
    $images = "";
    $size = "";
    $prise = "";
    $prise = 0;
    // <img src="cid:0.jpg" width="128" height="128">
    $emailX = "orders@apelsinka.tech"; // почта получателя
    $mail = new mail();
    $subject = "Новый заказ #" . $number_orders;
    $html = '<html><head>';
    $html .= "<meta charset='UTF-8'>";
    $html .= "<title>' . $subject . '</title>";
    $html .= "</head><body style = 'width: fit-content;min-width: 21rem;'>";
    $html .= "<div style='background: #ffb100;
         border-radius: 5px;color: #0037ff;padding: 0.5rem;'>";
    $html .= "<h1 style = 'text-align: center;margin: 0.5rem;'> Апельсинка </h1></div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'>";
    $html .= "<h2>Новый заказ</h2>";

    foreach ($cart as $key => $data) {
        $html .= "<div style='border-bottom:1px solid black;'> 
        <p> Название: " . $data['title'] . "</p>";

        $html .= "<p> Артикль: <a href='https://apelsinka.tech/product&article="
            . $data['article'] . "'>" . $data['article'] . "</a></p>";
        $titles .= ($data['title'] . "&" . $data['article']) . "|";

        $html .= "<p> Картинка: <img src='cid:" . ($key + 1) . "' width='128' height='128'></p>";
        $mail->addEmbeddedImage("assec/images/product/" . $data['img'], $key + 1);
        $images .= $data['img'] . "|";


        $html .= "<p> Размер: " . $data['size'] . "</p>";
        $size .=  $data['size'] . "|";

        $count = "";
        $html .= "<p> Колличество: ";
        if ($data['Opt'] != 0) {
            $html .=  $data['count_f'] * $data['count_s'] . "</p>";
            $count .=  ($data['count_f'] * $data['count_s']) . "|";
        } else {
            $html .=   $data['count_s'] . "</p>";
            $count .= $data['count_s'] . "|";
        }


        $html .= "<p> Стоймость: " . $data['price_all'] . "</p>";
        $prise += $data['price_all'];
        $html .=  "</div>";
    }
    $FIO  = code($_POST['FIO']);
    $obl = code($_POST['obl']);
    $sity = code($_POST['sity']);
    $strasse  = code($_POST['strasse']);
    $home  = code($_POST['home']);
    $name_user = code($_POST['name_user']);
    $email = code($_POST['email']);
    $phone  = code($_POST['phone']);
    $dilivery = code($_POST['dilivery']);
    $home_s  = code($_POST['home_s']);
    $index = code($_POST['index']);

    $html .= "<div style = 'text-align: center;margin: 1rem;'> Полная стоймость $prise</div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Пользователь </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> ФИО: $name_user </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Телефон: <a href='tel:$phone'>$phone</a> </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Почта: <a href='mailto:$email'>$email </a></div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Адрес доставки </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> ФИО: $FIO </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Область: $obl </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Город: $sity </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Улица: $strasse </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Дом: $home </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Квартира: $home_s </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Индекс: $index </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Доставка </div>";
    $html .= "<div style = 'text-align: start;margin: 1rem;'> Пользователь выбрал: $dilivery </div>";
    $html .= "</div></body></html>";

    mysqli_query($CONNECT, "INSERT INTO `past_orders` (`id`, `id_user`, `name_product`, `size`, `img`, `count`, `prise`, `status`,`delivery`) 
    VALUES (null, '" . $_SESSION['id'] . "', '$titles', 
    '$size',     '$images',    '$count', '$prise', 'ovit','$dilivery')");

    $mail->addAddress($emailX);
    $mail->Subject = $subject;
    $mail->Body = $html;
    // $mail->addEmbeddedImage("$puti", "$name"); // добавление картинки
    if ($mail->send()) {

        unset($_COOKIE['carts']);
        mysqli_query($CONNECT, "UPDATE `cart_users` SET `item` = '[]'
        WHERE `cart_users`.`id_user` ='" . $_SESSION['id']);

        message('Заказ', 1, "Заказ принят в обработку. Ожидайте звонок для подтверждение заказа", true, "yesorder");
    } else {
        return print($mail->ErrorInfo); //false; //'Ошибка: ' . 
    }
}
//php_value error_reporting 500

/*
ovit -- для админа уведомлени
process -- подтверждение
yesorders -- одобренно


*/