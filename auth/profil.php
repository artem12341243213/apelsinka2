<? hedeer("Профиль");

if ($_GET)
?>
<div class="users_profil_section">
    <div class="global">
        <div class="h1 text-g">
            <h1>Профиль</h1>
        </div>
        <div class="users_profil_box">
            <div class="users_profil_leftSection">
                <div class="users_profil_leftSection-box">
                    <div class="Users_leftSection_img">
                        <div class="users_img">
                            <div class="il">
                                <img src="assec/images/users/<? echo $_SESSION['img'] ?>" alt="Фотография пользователя">
                            </div>
                            <p><input type="file" name="now_img" id="now_img" style="display:none ;" onchange="loaditems('now_img','userform')"> <label for="now_img">обновить</label> </p>
                        </div>
                    </div>
                    <div class="Users_leftSection_content">
                        <p class="name"><?
                                        if ((($_SESSION['last_name'] != '-' &&  $_SESSION['name'] != '-') || ($_SESSION['name'] != '-' && $_SESSION['first_name'] != '-')) && $_SESSION['name'] != "NULL") {
                                            if ($_SESSION['last_name'] != '-')  echo $_SESSION['last_name'] . " ";
                                            if ($_SESSION['name'] != '-')  echo $_SESSION['name'] . " ";
                                            if ($_SESSION['first_name'] != '-')  echo $_SESSION['first_name'];
                                        } else if (($_SESSION['last_name'] == 'NULL' && $_SESSION['name'] == 'NULL' && $_SESSION['first_name'] == 'NULL')) {
                                            echo 'Пользователь  #' . $_SESSION['id'];
                                        }
                                        ?></p>
                        <p class="mail"><? echo ($_SESSION['email']) ?></p>
                        <p class="phone">Телефон - <span class="phone"><? if (decode($_SESSION['phone']) != NULL) echo decode($_SESSION['phone']);
                                                                        else echo 'Неизвестно <span class="ob_posl">*</span>';
                                                                        ?></span> </p>
                        <p class="city"><? if (decode($_SESSION['region']) != '-') echo decode($_SESSION['region']) . " ";
                                        if (decode($_SESSION['sity']) != '-') echo decode($_SESSION['sity']) . " ";
                                        else echo 'Город - Неизвестно <span class="ob_posl">*</span>';
                                        ?></p>
                        <p class="adres">
                            <span class="adre_ul"> ул. <? if (decode($_SESSION['strasse']) != '-') {
                                                            print(decode($_SESSION['strasse']));
                                                        } else echo 'Неизвестно ><span class="ob_posl">*</span>'; ?>
                                <span class="adre_dom">д. <? if (decode($_SESSION['home']) != '-') {
                                                                print decode($_SESSION['home']);
                                                            } else echo 'Неизвестно <span class="ob_posl">*</span>';
                                                            ?>
                                    <span class="adre_kv"> <? if (decode($_SESSION['kvart']) != '-') {
                                                                print decode($_SESSION['kvart']);
                                                            };
                                                            ?>
                                    </span>
                                </span>
                            </span>


                        </p>
                    </div>
                    <? if ($_SESSION['type'] == 0) {
                    ?>
                        <div class="users_status text-g <? echo "roz"; ?> ">
                            <p><? echo "Розница"; ?> </p>
                        </div>
                    <? } else if ($_SESSION['type'] == 1) {  ?>
                        <div class="users_status text-g <? echo "opt"; ?> ">
                            <p><? echo "Оптовик" ?> </p>
                        </div>

                    <? } else if ($_SESSION['type'] == 2) {  ?>
                        <div class="users_status text-g <? echo "roz"; ?> ">
                            <p><? echo "Админ" ?> </p>

                        </div>
                    <? } else {  ?>
                        <div class="users_status text-g <? echo "opt"; ?> ">
                            <p><? echo "Удален" ?> </p>
                        </div>
                    <? } ?>


                </div>
                <? if (isset($_GET['sot'])) {
                ?>
                    <div class=" box_include " id="include_box">
                        <?
                        $m = code($_GET['sot']);
                        switch ($m) {

                            case "beak_backet":
                                require('assec/php/table_raz.php');
                                break;

                                /*  case "prise":include  ; break;*/
                            case "editor_user":
                                require('assec/php/block/user_edit_data.php');
                                break;
                        }

                        ?>
                    </div>
            </div>
        <?
                } else { ?>
            <div class=" box_include hidden_items" id="include_box">

                <!--     <div class="moi_z">
                    <div class="heder_d">
                        <div class="h2">
                            <h2>Мои заказы</h2>
                        </div>
                    </div>
                    <div class="body_z">
                        <? ?>
                        Ну тут типа заказы коорые были
                    </div>
                </div> -->

            </div>
        </div>
    <? } ?>
                    
    <div class="users_profil_rightSection">
        <ul class="box_user_">
            <li class="el">
                <p>Ваш идентификатор  <span><? echo $_SESSION['id'] ?></span></p>
            </li>
        </ul>
        <ul class="users_profil_right_top">
            <!--  <li class="url_link_item"><a data-src="user_data">Данные пользователя</a></li> -->
            <li class="url_link_item"><a data-src="table_razmers">Таблица размеров</a></li>
            <li class="url_link_item"><a data-src="prise">Прайс - лист</a></li>
            <li class="url_link_item"><a data-src="beak_backet">Мои заказы</a></li>
            <li class="url_link_item"><a data-src="favorits">Избранное</a></li>
        </ul>
        <div class="lein"></div>
        <ul class="users_profil_right_bottom">
            <li class="url_link_item"> <a data-src="editor_user">Редактировать даные</a></li>
            <li class="url_link_item"> <a data-src="exit">Выход</a> </li>
        </ul>
    </div>

    </div>
</div>
</div>
<!-- Корзина ///////////////////////////ц   -->



<?
$mi = ['profil'];

footer($mi) ?>