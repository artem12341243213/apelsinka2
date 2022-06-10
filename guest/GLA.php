<?
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/mail.php');

if (isset($_POST['auth_f']) && $_POST['auth_f'] == 1) {

  $email = code($_POST['email']);
  $pass = code($_POST['password']);
  $chek_auto = $_POST["auth_auto"];

  if ($email == '' or $pass == '') message('Ошибка входа', 2, 'Заполните поля для входа');
  if (!isset($_POST['password'])) message('Ошибка входа', 2, 'Пароль не указан');

  if (isset($_POST['get']))  $GET = code($_POST['get']);
  if (isset($_POST['article']))  $GET .= "&article=" . code($_POST['article']);
  if (isset($_POST['items']))  $GET .= "&items=" . code($_POST['items']);

  $riv = mysqli_query($CONNECT, "select `id`,`password` from `user` where `email` = '" . $email . "'");
  if (($riv->num_rows) == 0) message('Ошибка входа', 2, 'Указаная почта не найдена');
  $riv = mysqli_fetch_assoc($riv);

  if (decode($riv['password']) != $pass) {
    message('Ошибка входа', 2, 'Почта или пароль указаны неверно');
  }

  // Проверяем пользователя 
  $row = mysqli_fetch_assoc(mysqli_query($CONNECT, "Select * From `user` WHERE `email`='" . $email . "'"));

  if ($chek_auto) {
    //Создаём токен
    $password_cookie_token = md5($row['id']  . $pass . time());
    if ($row['token_user_auto'] != null) {
      $miso = $row['token_user_auto'] . "|" . $password_cookie_token;
    } else {
      $miso = $password_cookie_token;
    }
    //Добавляем созданный токен в базу данных
    mysqli_query($CONNECT, "UPDATE `user` SET token_user_auto='" . $miso . "' WHERE email = '" . $email . "'");

    //Устанавливаем куку с токеном
    setcookie("password_cookie_token", $password_cookie_token, time() + (1000 * 60 * 60 * 24 * 30));
  } else {
    //Если галочка "запомнить меня" небыла поставлена, то мы удаляем куки
    if (isset($_COOKIE["password_cookie_token"])) {

      //Очищаем поле password_cookie_token из базы данных
      mysqli_query($CONNECT, "UPDATE `user` SET password_cookie_token = '' WHERE email = '" . $email . "'");

      //Удаляем куку password_cookie_token
      setcookie("password_cookie_token", "", time() - 3600);
    }
  }

  $cart_item_user = mysqli_query($CONNECT, "Select * From `cart_users` WHERE `id_user`='" . $row['id'] . "'");

  if (($cart_item_user->num_rows) > 0) {
    $cart_item_user = mysqli_fetch_assoc($cart_item_user)['item'];
    $cart_item_user = json_decode($cart_item_user, true);

    $articles = "SELECT `articl`,`disable` from `product` WHERE ";

    $length =  count($cart_item_user);

    $sv = 1;

    for ($i = 0; $i < $length; $i++) {
      if ($sv == 0) {
        $articles .= " or ";
      }
      $sv = 1;
      foreach ($cart_item_user[$i] as $key => $data) {
        if ($key == 'article' && $sv == 1) {
          $articles .= "`articl` =" . $data;
          $sv = 0;
        }
      }
    }

    $disables_items = mysqli_query($CONNECT, "$articles");

    if (($disables_items->num_rows)  > 0)
      $disables_items = mysqli_fetch_all($disables_items);
    else {
      $disables_items = [];
      for ($i = 0; $i < $length; $i++) {
        $articles_items = [$cart_item_user[$i]['article'], 1];
        array_push($disables_items, $articles_items);
      }
      unset($articles_items);
    }

    for ($i = 0; $i < $length; $i++) {
      $items = $cart_item_user[$i];
      foreach ($items as $key => $item) {

        if ($key == "disables") {
          for ($s = 0; $s < count($disables_items); $s++) {
            if ($disables_items[$s][0] == $cart_item_user[$i]['article']) {
              $cart_item_user[$i]['disables'] = $disables_items[$s][1];
            }
          }
        } else if ($key == 'title') {
        }
      }
    }
    unset($disables_items);
    $rov = json_encode($cart_item_user, JSON_UNESCAPED_UNICODE);
    mysqli_query($CONNECT, "UPDATE `cart_users` SET `item` = '" . $rov . "' WHERE `id_user` = " . $row['id'] . ";");

    setcookie('cart', $rov);
  }

  $los = mysqli_query($CONNECT, "SELECT * From `favoritesu`WHERE `id_user` = " . $row['id']);

  if (($los->num_rows) != 0) {

    $los = mysqli_fetch_all($los);
    $mi = [];
    foreach ($los as $item) {
      array_push($mi, $item[1]);
    }
    $_SESSION['favorits'] = $mi;
  }

  if ($row['type'] == 2) {
    $lest['id'] = $row['id'];
    unset($row);
    $code = random_str(6, 'admin');

    $mi_code = "<p>Код для подтверждения регистрации</p>
    <p><div style='color: black;
    padding: 0.6rem;
    background: #cececed6;
    border-radius: 5px;
    font-size: 1.2rem;
    max-width: fit-content;
    margin: auto;'>" . $code . "</div></p>  ";

    $lest['code'] = code($code);
    $lest['type'] = "adminauthc";
    $lest['password_coo'] = $password_cookie_token;;

    $_SESSION['confirm'] = $lest;
    if (mail_l($email, "Подтверждения входа в админ панель", 'Код администратора', $mi_code)) {
      message('Вход', 2, 'Ключ подтверждения отправлен на почту', true, 'confirm');
    }
  } else {

    foreach ($row as $key => $value) {
      if ($key == 'token_user_auto') $_SESSION[$key] = $password_cookie_token;
      else
        $_SESSION[$key] = $value;
    };
    go('authorization');
  }
} else if (isset($_POST['registers_f']) && $_POST['registers_f'] == 1) {
  $mas_ses = [];


  $email = code($_POST['email']);
  if (!isset($_POST['email'])) message('Хакерс', 3, 'И как же ты это сделал ?');

  $row2 = mysqli_query($CONNECT, "Select * From `user` WHERE `email`='" . $email . "'");
  if (($row2->num_rows) != 0) {
    message('Ошибка данных', 2, 'Почта уже зарегистрирована');
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    message('Ошибка данных', 2, 'Почта указана неправильно');

  $mas_ses['email'] = $email;

  $password = code($_POST['password']);

  $password_dubl = code($_POST['password_dubl']);

  if ($password  == $password_dubl)
    $mas_ses['password'] = code($password, 's');
  else
    message('Ошибка данных', 2, 'Пароли не одинаковые');


  if (isset($_POST['name'])) {
    $name = code($_POST['name']);
    $mas_ses['name'] = $name;
  }
  if (isset($_POST['first_name'])) {
    $first_name = code($_POST['first_name']);
    $mas_ses['first_name'] = $first_name;
  }
  if (isset($_POST['last_name'])) {
    $last_name = code($_POST['last_name']);
    $mas_ses['last_name'] = $last_name;
  }
  if (isset($_POST['Phone'])) {
    $phone1 = code($_POST['Phone']);
    $phone = explode('+', $phone1);
    $phone = (int) $phone[0];
    if (!preg_match('/^[0-9]{3,15}$/', $phone)) message('Ошибка данных', 2, 'Телефон должен содержать только цифры');
    else if (strlen($phone) != 11) message('Ошибка данных', 2, 'Телефон не соответствует стандартам');
    else
      $mas_ses['phone'] = code($phone1, 's');
  }
  if (isset($_POST['Address_ZipPostalCode'])) {
    $index = code($_POST['Address_ZipPostalCode']);

    if (!ctype_digit($index)) message('Ошибка данных', 2, 'Индекс должен состоять из цифр');
    else
      $mas_ses['index'] = code($index, 's');
  }
  if (isset($_POST['obl'])) {
    $obl = code($_POST['obl'], 's');
    if ($obl == 0) message('Область/Край', 2, "Выберите область или край");
    include "assec/php/block/obl.php";
    for ($i = 0; $i < count($obl_list); $i++) {

      if ($i == $obl) {
        $mas_ses['obl'] = code($obl_list[$i], 's');
        break;
      }
    }
  }
  if (isset($_POST['sity'])) {
    $sity = code($_POST['sity']);
    $mas_ses['sity'] = code($sity, 's');
  }
  if (isset($_POST['strasse'])) {
    $strasse = code($_POST['strasse'], 's');
    $mas_ses['strasse'] = $strasse;
  }
  if (isset($_POST['home'])) {
    $home = code($_POST['home'], 's');
    $mas_ses['home'] = $home;
  }
  if (isset($_POST['home_s'])) {
    $kvart = code($_POST['home_s'], 's');
    $mas_ses['home_s'] = $kvart;
  }

  if ($password !==  $password_dubl)  message("Ошибка данных", 2, "Пароли не совпадают");


  $code = random_str(6);

  $mas_ses['code'] = $code;
  $mas_ses['type'] = "register";


  $_SESSION['confirm'] = $mas_ses;

  $mi_code = "<p>Код для подтверждения регистрации</p>
  <p><div style='color: black;
  padding: 0.6rem;
  background: #cececed6;
  border-radius: 5px;
  font-size: 1.2rem;
  max-width: fit-content;
  margin: auto;'>" . $code . "</div></p>  ";


  if (mail_l($email, "Апельсинка регистрация", 'Код регистрации', $mi_code))
    message("Регистрация", 1, "Письмо с кодом подтверждения было отправлено вам на почту", false, 'confirm');
  else message("Ошибка отправки", 3, "Неудалось отправить сообщение на почту");
} else if (isset($_POST['confirm_f']) && $_POST['confirm_f'] == 1) {

  $datee = $_SESSION['confirm'];
  if ($datee['code'] != code($_POST['code'])) {
    message("Подтверждение", 2, "Kод подтверждения указан не верно");
  } else {
    if ($datee['type'] === 'register') {
      if (isset($datee['email']))       $email = $datee['email'];
      if (isset($datee['password']))    $password = $datee['password'];
      if (isset($datee['name']))        $name = $datee['name'];
      else $name = "NULL";
      if (isset($datee['first_name']))  $first_name = $datee['first_name'];
      else $first_name = "NULL";
      if (isset($datee['last_name']))   $last_name = $datee['last_name'];
      else $last_name = "NULL";
      if (isset($datee['phone']))       $phone = $datee['phone'];
      else $phone = "NULL";
      if (isset($datee['index']))       $index = $datee['index'];
      else $index = "NULL";
      if (isset($datee['obl']))         $obl = $datee['obl'];
      else $obl = "NULL";
      if (isset($datee['sity']))        $sity = $datee['sity'];
      else $sity = "NULL";
      if (isset($datee['strasse']))     $strasse = $datee['strasse'];
      else $strasse = "NULL";
      if (isset($datee['home']))        $home = $datee['home'];
      else $home = "NULL";
      if (isset($datee['home_s']))        $home = $datee['home_s'];
      else $kvart = "NULL";

      $sql = "SELECT max(`id`) AS 'max_id' FROM `user` WHERE `id`";

      $id_max = mysqli_fetch_assoc(mysqli_query($CONNECT, $sql))['max_id']  + 1;
      /*
      echo "<pre>";
      print_r($datee);
      echo "</pre>";
    
      print(mysqli_error($CONNECT));
      */

      $sql =   "INSERT INTO `user` (`id`, `img`,`type`, `email`, `password`, `name`, `first_name`, `last_name`, `phone`, `region`, `sity`, `strasse`, `home`,`kvart`, `inpex_home`) 
      VALUES ('$id_max','noFoto.jpg','0', '$email', '$password', '$name', '$first_name', '$last_name', '$phone', '$obl', '$sity', '$strasse', '$kvart', '$home', '$index')
       ";

      mysqli_query($CONNECT, $sql);




      $sql = "INSERT INTO `cart_users` (`id_user`, `item`) VALUES ('" . $id_max . "', '[]')";
      mysqli_query($CONNECT, $sql);


      unset($_SESSION['confirm']);

      go('authorization');
    } else if ($datee['type'] === 'recovery') {
      $new_password = code($datee['newpassword'], 's');
      mysqli_query($CONNECT, "UPDATE `user` SET `password`='" . $new_password . "'WHERE `email`='" . $datee['email'] . "'");
      mail_l($datee['email'], 'Смена пароля',  'Новый пароль', "На странице был изменен пароль");
      unset($_SESSION['confirm']);
      message("Сброс пароль", 1, "Пароль был сброшен", true, 'authorization');
    } else if ($datee['type'] === 'adminauthc') {
      $los = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * From `user` WHERE `id_user` = " . $datee['id']));
      foreach ($los as $key => $value) {
        if ($key == 'token_user_auto') $_SESSION[$key] = $datee['password_coo'];
        else
          $_SESSION[$key] = $value;
      };
      go("home");
    } else not_found();
  }
} else if (isset($_POST['Rewrite_f']) && $_POST['Rewrite_f'] == 1) {

  if (isset($_POST['email']))       $email = code($_POST['email']);
  if (isset($_POST['rewritePaswords']))    $password = code($_POST['rewritePaswords']);

  $code = random_str(6);

  $mas_ses['code'] = $code;
  $mas_ses['type'] = "recovery";
  $mas_ses['email'] = $email;
  $mas_ses['newpassword'] = $password;


  $_SESSION['confirm'] = $mas_ses;

  $mi_code = "<p>Код для сброса пароля</p>
  <p><div style='color: black;
  padding: 0.6rem;
  background: #cececed6;
  border-radius: 5px;
  font-size: 1.2rem;
  max-width: fit-content;
  margin: auto;'>$code</div></p>  ";


  mail_l($email, "Апельсинка регистрация", 'Код сброса пароля', $mi_code);
  message("Подтверждение", 1, "Письмо с кодом подтверждения было отправленно вам на почту", true, 'confirm');
}



function mail_l($user_meil, $hea, $h1, $text)
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
  // $mail->addAttachment('/путь/к/файлу/файл', 'имя_файла'); // приложить файл, если нужно (можешь даже несколько)
  if ($mail->send()) {
    return true;
  } else {
    return false; //'Ошибка: ' . $mail->ErrorInfo;
  }
}
