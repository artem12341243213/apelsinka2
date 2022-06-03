<?
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
    } else if ($_POST['elem'] == 'user_data')      print('В разработке');
    else if ($_POST['elem'] == 'beak_backet')        print('В разработке');
    else if ($_POST['elem'] == 'table_razmers')    require('assec/php/table_raz.php');
    else if ($_POST['elem'] == 'favorits') {  require('assec/php/block/favorits.php');
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
