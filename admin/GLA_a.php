<?
session_start();



/* 
 для бонусов
INSERT INTO `bonus` (`id`, `sid`, `dels`) VALUES (NULL, 'HOT22S', '5');
*/
if (isset($_POST['adminis_f']) && $_POST['adminis_f'] == 1) {
    if (!isset($_SESSION['ADMIN_LOGIN_IN'])) {
        $_SESSION['ADMIN_LOGIN_IN'] = 1;
        message('Админ права', 1, 'Админ права выданы');
    } else {
        unset($_SESSION['ADMIN_LOGIN_IN']);
        //unset($_SESSION['IMG_PRODUCT']);
        $GLOBALS['_SESSION']['IMG_PRODUCT'] = '';
        message('Админ права', 1, 'Админ права отозваны');
    }
};

if (isset($_POST['timen_f']) && $_POST['timen_f'] == 1) {
    //print_r($_POST);
    // res.deff
    if ($_POST['ot'] == null && $_POST['do'] != null) {
        $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product` LIMIT " . $_POST['do']));
        $miste  = [];
        foreach ($array as $key => $data) {
            if ($data[0] != "-1") {
                array_push($miste, $data);
            }
        }
        print json_encode(["array" => $miste]);
    } else if ($_POST['do'] != null && $_POST['ot'] != null) {

        $num = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT COUNT(*) as 'num' FROM `product`"))['num'];
        if (($_POST['ot'] + $_POST['do']) <= $num) {

            $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product` LIMIT " . $_POST['ot'] . "," . $_POST['do']));
            $miste  = [];
            foreach ($array as $key => $data) {
                if ($data[0] != "-1") {
                    array_push($miste, $data);
                }
            }
            print json_encode(["array" => $miste]);
        } else {
            $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product` LIMIT " . $_POST['ot'] . "," . $_POST['do']));
            $miste  = [];
            foreach ($array as $key => $data) {
                if ($data[0] != "-1") {
                    array_push($miste, $data);
                }
            }
            print json_encode(["array" => $miste, "deff" => "1"]);
        }
    }
    /*  else {
        $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product`"));
    } */
}

if (isset($_POST['jefvsk_f']) && $_POST['jefvsk_f'] == 1) {
    include 'all/cart.php';
}

if (isset($_POST['edit_items_f']) && $_POST['edit_items_f'] == 1) {
    if (!isset($_POST['edit_item'])) {
        $search = code($_POST['sertch']);
        if (preg_match('/^[0-9]{3,15}$/', $search)) {
            $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE  `articl` LIKE '%$search%'"));
        } else {
            $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE  `title` LIKE '%$search%'"));
        }

        $miste  = [];
        foreach ($array as $key => $data) {
            if ($data[0] != "-1") {
                array_push($miste, $data);
            }
        }
        print json_encode(["array" => $miste]);
    } else {
        $art = $_POST['edit_item'];
        switch ($_POST['elems_t']) {
            case 'hidden':
                $array = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `disable` FROM `product` WHERE `articl` = " . $art))['disable'];
                if ($array == 0) $se = 1;
                else $se = 0;
                mysqli_query($CONNECT, "UPDATE `product` SET `disable` = $se WHERE `articl` = " . $art);
                if ($se == 0) print_r('{"edit_i":"f_s_i_' . $art . '","typ":"off"}');
                else print_r('{"edit_i":"f_s_i_' . $art . '","typ":"on"}');
                //  $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product` LIMIT " . $_POST['do']));
                break;
            case 'remove':
                $img =  mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `images` FROM `product` WHERE `product`.`articl` =" . $art))['images'];

                $img =  explode("|", $img);
                foreach ($img as $filename) {
                    if ($filename != "noFoto.jpg") {
                        if (file_exists("assec/images/product/" . $filename)) {
                            unlink("assec/images/product/" . $filename);
                        }
                    }
                }

                mysqli_query($CONNECT, "DELETE FROM `product` WHERE `product`.`articl` =" . $art);
                $se = mysqli_fetch_assoc(mysqli_query(
                    $CONNECT,
                    "SELECT `count_item` AS 'm' FROM `categories` WHERE `categories`.`id` = " . $_POST['id_t']
                ))['m'] - 1;

                mysqli_query($CONNECT, "UPDATE `categories` SET `count_item` = '$se' WHERE `categories`.`id` = " . $_POST['id_t']);

                print_r('{"edit_i_r":"Is_Id_' . $art . '"}');
                break;
            case 'edit':
                $array = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE `articl` = $art"));
                $arr2 = ['red_i' => $array];
                //$array = array_merge($array, $arr2);
                print json_encode($arr2);
                break;
        }
    }
}


if (isset($_POST['add_items_now']) && $_POST['add_items_now'] == 1) {

    $article = $_POST['article'];
    $title = $_POST['name'];
    $count_lk = $_POST['count'];
    $textelen = $_POST['tkan'];
    $sostaw = $_POST['sostaw'];
    $prise_opt = $_POST['opt'];
    $prise_roz = $_POST['roz'];
    $group = $_POST['pol'];
    $page = $_POST['page'];
    $disable = $_POST['disable'];
    $catecogr = explode("-", $_POST['categor']);
    $size = str_replace(',', "|", $_POST['size']);
    $img_mass = '';
    if ($_FILES != null) {
        $img_product = '';
        foreach ($_FILES as $item) {
            $uploads = 'assec/images/product';
            if ($item["error"] == 0) {
                $tmp_name = $item["tmp_name"];
                $name = basename($item["name"]);
                move_uploaded_file($tmp_name, "$uploads/$name");
                $file = $item["name"];
                $img_product .= "|" . $file;
            }
        }
        $img_mass = $img_product;
    }

    $se = mysqli_fetch_assoc(mysqli_query(
        $CONNECT,
        "SELECT `count_item` AS 'm' FROM `categories` WHERE `categories`.`id` = $catecogr[1]"
    ))['m'] + 1;

    $aaa = "INSERT INTO `product` 
    (`articl`,`title`, `images`, `size`, `count`, `categories`, `podcategories`, `sostav`,
    `textile`, `disable`, `elements_sorters`, `price_opt`, `price_roz`,`pol`) 
    VALUES ('$article','$title', '" . trim($img_mass, "|") . "', '$size', '$count_lk', '$catecogr[0]',
    '$catecogr[1]','$sostaw','$textelen','$disable','$page',' $prise_opt',' $prise_roz','$group')";

    if (mysqli_query($CONNECT, $aaa)) {
        mysqli_query($CONNECT, "UPDATE `categories` SET `count_item` = '$se' WHERE `categories`.`id` = $catecogr[1];");
        message("Товар", 1, "Товар успешно добавлен");
    } else
        message("Товар", 2, "Возникли ошибки при добавлении товара");
}


if (isset($_POST['edit_items']) && $_POST['edit_items'] == 1) {
    $title = $_POST['name'];
    $article = $_POST['article_prof'];
    $article_now = $_POST['article'];
    $count_lk = $_POST['count'];
    $textelen = $_POST['tkan'];
    $sostaw = $_POST['sostaw'];
    $prise_opt = $_POST['opt'];
    // UPDATE `product` SET `articl` = '136545' WHERE `product`.`articl` = 136543;
    $prise_roz = $_POST['roz'];
    $group = $_POST['pol'];
    $page = $_POST['page'];
    $disable = $_POST['disable'];
    $catecogr = explode("-", $_POST['categor']);
    $size = str_replace(',', "|", $_POST['size']);


    if ($article !=  $article_now)
        $prof = ",`articl` = '$article_now',";
    else  $prof = ",";


    $saves_img = "";
    if (isset($_POST['saves_img'])) {
        $saves_img = '|' . $_POST['saves_img'];
    }

    if (isset($_POST['remove_img'])) {
        $remove_img =  explode("|", $_POST['remove_img']);
        foreach ($remove_img as $filename) {
            if (file_exists("assec/images/product/" . $filename)) {
                unlink("assec/images/product/" . $filename);
            }
        }
    }

    $img_mass = '';

    if ($_FILES != null) {
        $img_product = '';
        foreach ($_FILES as $item) {
            if (file_exists("assec/images/product/" . $item["name"])) {
                $file = $item["name"];
                $img_product .= "|" . $file;
                continue;
            } else {
                $uploads = 'assec/images/product';
                if ($item["error"] == 0) {
                    $tmp_name = $item["tmp_name"];
                    $name = basename($item["name"]);
                    move_uploaded_file($tmp_name, "$uploads/$name");
                    $file = $item["name"];
                    $img_product .= "|" . $file;
                }
            }
        }
        $img_mass = $img_product;
    }

    $img_mass .= $saves_img;

    $aaa = "UPDATE `product` SET `size` = '$size' $prof `title`='$title',`images`='" . trim($img_mass, "|") . "',
    `count`='$count_lk', `categories` = '$catecogr[0]',
    `podcategories`= '$catecogr[1]',
    `sostav`='$sostaw',`textile`='$textelen',`disable`='$disable',`elements_sorters`='$page',
    `price_opt`=' $prise_opt',
    `price_roz`=' $prise_roz',`pol`='$group' WHERE `product`.`articl` = $article";

    if (mysqli_query($CONNECT, $aaa)) {
        message("Товар", 1, "Товар успешно сохранен");
    } else
        message("Товар", 2, "Возникли ошибки при сохранении товара");
}

if (isset($_POST['edit_json_auth']) && $_POST['edit_json_auth'] == 1) {

    $file = file_get_contents('assec/data/auth_forms.json');     // Открыть файл data.json

    $taskList = json_decode($file, TRUE);              // Декодировать в массив 

    $taskList['mail']          = $_POST['email'];
    $taskList['phone_one']     = str_replace("pl", "+", $_POST['phone_n1']);
    $taskList['phone_two']     = str_replace("pl", "+", $_POST['phone_n2']);
    $taskList['phone_three']   = str_replace("pl", "+", $_POST['phone_n3']);

    if (file_put_contents('assec/data/auth_forms.json', json_encode($taskList)))
        message("Сохранение", 1, "Данные успешно сохранен"); // Перекодировать в формат и записать в файл.

    unset($taskList);  // Очистить переменную $taskList 
}

if (isset($_POST['write_json_auth']) && $_POST['write_json_auth'] == 1) {

    $json =  file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '../assec/data/auth_forms.json');
    $json = json_decode($json, true);
    $mail =   $json['mail'];
    $phone_one = $json['phone_one'];
    $phone_two = $json['phone_two'];
    $phone_three = $json['phone_three'];
?>
    <div class="lowion">
        <div><input type='text' id='email' value='<? echo $mail ?>'> <label for='email'>Почта</label></div>
        <div><input type='text' id='phone_n1' value='<? echo $phone_one ?>'> <label for='phone_n1'>Карина</label></div>
        <div><input type='text' id='phone_n2' value='<? echo $phone_two ?>'> <label for='phone_n2'>Светлана</label></div>
        <div><input type='text' id='phone_n3' value='<? echo $phone_three ?>'> <label for='phone_n3'>Александр</label></div>
        <button onclick="reader_data_li('email.phone_n1.phone_n2.phone_n3')">Сохранить</button>
        <button onclick="buttons('bu_back')"> Назад</button>
    </div>
<?

}
if (isset($_POST['prise_reload']) && $_POST['prise_reload'] == 1) {

    if (file_exists("assec/data/prise.xls")) {
        unlink("assec/data/prise.xls");
    }
    if (file_exists("assec/data/prise.xlsx")) {
        unlink("assec/data/prise.xlsx");
    }
    $uploads = 'assec/data';
    $item = $_FILES['exel'];
    if ($item["error"] == 0) {
        $tmp_name = $item["tmp_name"];
        $name = basename($item["name"]);
        if (move_uploaded_file($tmp_name, "$uploads/$name")) {
            $doc = explode(".", $name);
            rename("$uploads/$name", "$uploads/prise." . $doc[1]);

            print('{"titel":"Прайс успешно сохранен",
                "tip":"1",
                "headers":"Сохранение",
                "type":"' . $doc[1] . '"
            }');
        }
    }
}
if (isset($_POST['prise_reload_n']) && $_POST['prise_reload_n'] == 1) {
?>
    <div class="lowion">

        <div><input type="file" id="files"><label for='files'>Прайс лист</label></div>
        <? if (file_exists("assec/data/prise.xls")) {
        ?><div> <a href="assec/data/prise.xls" id="files_prise">Прайс-Лист</a></div>
        <? } ?>
        <? if (file_exists("assec/data/prise.xlsx")) {
        ?><div> <a href="assec/data/prise.xlsx" id="files_prise">Прайс-Лист</a></div><? } ?>
        <button onclick="fil('files')">Обновить</button>
        <button onclick="buttons('bu_back')"> Назад</button>
    </div>
<?
}
