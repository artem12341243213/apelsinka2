<? //print([$_POST]);
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/mail.php');


if (isset($_POST['add_cart_f']) && $_POST['add_cart_f'] == 1 && isset($_SESSION['id'])) {
    $cart_item = $_POST['cart_item'];
    print_r($cart_item);
    mysqli_query($CONNECT, "UPDATE `cart_users` SET `item` = '$cart_item' WHERE `cart_users`.`id_user` ='" . $_SESSION['id'] . "'");
}

if (isset($_POST['bonus_activ_f']) && $_POST['bonus_activ_f'] == 1) {
    $bon = code($_POST['bonuse']);
    if ($bon != null) {
        $tiv = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `bonus` WHERE `sid` LIKE '$bon'"));

        print('{"masive":[' . json_encode($tiv) . ']}');
    }
}


if (isset($_POST['data_code_pl_chek'])) {

    $code = random_str(6);
    $name = code($_POST['names']);
    $first_name = code($_POST['fio']);

    $mas_ses['code'] = $code;
    $email = code($_POST['data_code_pl_chek']);
    $mas_ses['name'] = $name;
    $mas_ses['last_name'] = $first_name;

    $mas_ses['email'] = $email;

    $_SESSION['confirm'] = $mas_ses;

    $mi_code = "<p>Здравствуйте $name $first_name вот ваш код для подтверждение почты</p>
    <p><div style='color: black;
    padding: 0.6rem;
    background: #cececed6;
    border-radius: 5px;
    font-size: 1.2rem;
    max-width: fit-content;
    margin: auto;'>$code</div></p>  ";

    if (mail_l($email, "Апельсинка подтверждение", 'Код подтверждение', $mi_code))
        message("Подтверждение", 1, "Письмо с кодом подтверждения было отправленно вам на почту");
}



if (isset($_POST['data_code_pl_chek_cod'])) {
    $code_input = code($_POST['data_code_pl_chek_cod']);
    $lest = $_SESSION['confirm'];
    if ($lest['code'] = $code_input) {
        print('true');
        $_SESSION['email'] = $lest['email'];
    } else {
        print('false');
    }
}
/* if (isset($_POST['com_input'])) {
    $text = code($_POST['com_input']);
    $bin = '';
    if ($_SESSION['first_name'] == "NULL") {
        $bin = $_SESSION['last_name'] . " " . $_SESSION['name'];
    } else {
        $bin = $_SESSION['name'] . " " . $_SESSION['first_name'];
    }

    mysqli_query($CONNECT, "INSERT INTO `comments` (`id_comments`, `id_product`, `text`, `id_users`, `name_users`) 
    VALUES (NULL, '-1', '$text', '" . $_SESSION['id'] . "', '$bin')
    ");
    print_r('{"titel"     : "Комментарий успешно был оставлен",
        "tip"       : 1,
        "headers"   : "Комментарий",
        "name"       : "' . $bin . '"
     }');
}
 */

if (isset($_POST['com_input_del'])) {
    $id = $_POST['com_input_del'];

    mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `comments`.`id_comments` = $id");
    print_r('{"titel"     : "Комментарий удален",
        "tip"       : 2,
        "headers"   : "Комментарий",
        "id"       : "' . $id . '"
     }');
}

if (isset($_POST['com_input'])) {

    $text = code($_POST['com_input']);
    if (strlen($text) > 300) {
        message("Колличество символов", 2, "БОЛЬШЕ 300 СИМВОЛОВ НЕЛЬЗЯ");
        exit();
    }
    $id_product = code($_POST['id_product']);
    $bin = '';
    if ($_SESSION['first_name'] == "NULL" || $_SESSION['first_name'] == '-') {
        $bin = $_SESSION['last_name'] . " " . $_SESSION['name'];
    } else {
        $bin = $_SESSION['name'] . " " . $_SESSION['first_name'];
    }

    $data = date('Y-m-d');
    mysqli_query($CONNECT, "INSERT INTO `comments` (`id_comments`, `id_product`, `text`, `id_users`, `name_users`,`	data_comments`) 
    VALUES (NULL, '$id_product', '$text', '" . $_SESSION['id'] . "', '$bin',$data)");

    if (isset($_SESSION['type']) && $_SESSION['type']  == 1) {
        $type_m_name = "opt";
        $type_name = "Отповик";
    } else if (isset($_SESSION['type']) && $_SESSION['type']  == 0) {
        $type_m_name = "roz";
        $type_name = "Розница";
    }
    print_r('{  "titel"         : "Комментарий успешно добавлен",
                "tip"           : 1,
                "headers"       : "Комментарий",
                "images"        :"' . $_SESSION["img"] . '",
                "name_user"     :"' . $bin . '",
                "type_m_name"   :"' . $type_m_name . '",
                "type_name"     :"' . $type_name . '"
     }');
}

if (isset($_POST['prise_block_f']) && $_POST['prise_block_f'] == 1) {
    $FIO = code($_POST['FIO']);
    $phone = code($_POST['phone']);
    $user_meil = code($_POST['email']);
    $hea = 'Прайс Лист';
    $h1 = 'Прайс Лист';

    if (file_exists("assec/data/prise.xls")) {
        $ssi = 'prise.xls';
    }
    if (file_exists("assec/data/prise.xlsx")) {
        $ssi = 'prise.xlsx';
    }
    $text = '
        <p>
        Здраствуйте ' . $FIO . ', прикрепил заказанный вами прайс лиск к сообщению. </P>    
   
    ';
    $dop = 'assec/data/' . $ssi;
    $name =  $ssi;

    if (mail_l($user_meil, $hea, $h1, $text,    $dop, $name))  message("Прайс лист", 1, "Прайс лист будет отправлен вам на почту в ближайшее время");;
}











function mail_l($user_meil, $hea, $h1, $text, $dop, $name)
{

    $email = $user_meil; // почта получателя
    $subject = $hea;
    $html = "
      <html><head>
        <meta charset='UTF-8'>
        <title>' . $subject . '</title> 
        </head><body style = 'width: fit-content;
        min-width: 21rem; '>
         <div style='background: #ffb100;
         border-radius: 5px;
         color: #0037ff;
         padding: 0.5rem; '>
              <h1 style = 'text-align: center;
              margin: 0.5rem;'>Апельсинка</h1>
          </div>
          <div style = 'text-align: center;
          margin: 1rem;'>
            <h2>$h1</h2>
              <div>$text</div>
          </div>
        </body> 
      </html>
        ";

    $mail = new mail();
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $html;
    $mail->addAttachment("$dop", "$name"); // приложить файл, если нужно (можешь даже несколько)
    if ($mail->send()) {
        return true;
    } else {
        return false; //'Ошибка: ' . $mail->ErrorInfo;
    }
}
