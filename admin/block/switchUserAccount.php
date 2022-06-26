<?
if (isset($_GET['data_lim']) && $_GET['data_lim'] != 0) {
    $mar = code($_GET['data_lim']) + 50;
    $UserArray = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT `id`,`type`,`email` FROM `user` LIMIT $mar,50"));
} else {
    $mar = 50;
    $UserArray = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT `id`,`type`,`email` FROM `user` LIMIT 0,$mar"));
}
$count = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT count(*) as 'm' FROM `user`"))['m'];


?>
<div class="userpoisk">

    <div>
        <p>Поик пользователя по данным почты или идентификатора</p>
        <div class="boxion_userpoisk">
            <? if ($mar > 50) { ?>
                <div class="box_item_userpoisks" id="prev-s" onclick="locations('adminPanels&adminPages=switchUserAccount&data_lim=<? print($mar - 100) ?>')">Назад <? echo $mar - 50 . '-' . $mar ?>
                </div>
            <? } ?>
            <div class="box_items_userpoisk">
                <input type="text" list="spisok_items_em" id="inputUserCount" placeholder="Email" oninput="sorter_user_acunt()">
                <datalist id="spisok_items_em">
                </datalist>
            </div>
            <? if ($count > 50) { ?>
                <div class="box_items_userpoisk" id="next-s" onclick="locations('adminPanels&adminPages=switchUserAccount&data_lim=<? echo  $mar ?>')"> Дальше <? echo $mar . '-' . $mar + 50 ?>
                </div>
            <? } ?>
        </div>

    </div>

</div>
<div class="switchUser">
    <div class="switchUser__items_box">

        <?
        for ($i = 0; $i < count($UserArray); $i++) {
            $item = $UserArray[$i];
        ?>
            <div class="user_box_switch" id="identif_user_<? echo $item[0] ?>_numbers" data-ids="<? echo $item[0] ?>" data-ems="<? echo $item[2] ?>">
                <div class="user_box_info">
                    <div class="item_box_elemants">
                        <div class="itex_box_elements_infos  PhoneStyle">
                            <div>Индентификатор</div>
                        </div>
                        <div class="itex_box_elements_data">
                            <div><? echo $item[0] ?></div>
                        </div>
                    </div>
                    <div class="item_box_elemants">
                        <div class="itex_box_elements_infos  PhoneStyle">
                            <div>Тип аккаунта</div>
                        </div>
                        <div class="itex_box_elements_data">
                            <? if ($item[1] == 1) { ?>
                                <p class="opt_user_bg ">Оптовик</p>
                            <? } else if ($item[1] == 0) { ?>
                                <p class="roz_user_bg">Розница</p>
                            <? } else if ($item[1] == 2) { ?>
                                <p class="adm_user_bg">Админ</p>
                            <? } ?>

                        </div>
                    </div>
                    <div class="item_box_elemants">
                        <div class="itex_box_elements_infos PhoneStyle">
                            <div>email</div>
                        </div>
                        <div class="itex_box_elements_data">
                            <div><? echo $item[2] ?></div>
                        </div>
                    </div>
                </div>
                <div class="user_box_interact">
                    <div>
                        <p>
                            <? if ($item[1] == 1) { ?>
                                <button onclick="U_E_A('<? echo $item[0] ?>', 'roz')" class="hidden disables_button_td" id="f_s_i_<? echo $item[0] ?>">Перевести на розницу</button>
                            <? } else if ($item[1] == 0) { ?>
                                <button onclick="U_E_A('<? echo $item[0] ?>', 'opt')" class="hidden disables_button_td" id="f_s_i_<? echo $item[0] ?>">Перевести на опт</button>
                            <? } else if ($item[1] == 2) { ?>
                                <button onclick="U_E_A('<? echo $item[0] ?>', 'noadmin')" class="hidden disables_button_td" id="f_s_i_<? echo $item[0] ?>">Убрать админку</button>
                            <? } ?>
                        </p>
                        <p>
                            <button onclick="U_E_A('100061', 'edit')" class="edit_button_td" disabled>Заблокировать</button>
                        </p>
                        <p>
                            <button onclick="U_E_A('<? echo $item[0] ?>', 'removeAccount')" class="remove_button_td" id="f_s_r_<? echo $item[0] ?>" >Удалить Аккаунт</button>
                        </p>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</div>