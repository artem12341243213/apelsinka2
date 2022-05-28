<? hedeer("Отзывы");
$comments = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `comments` WHERE `id_product` = '-1' "));
?>
<div class="comments_box">
    <div class="global">
        <div class="h1 text-g">
            <h1>Отзывы</h1>
            <input type="hidden" value="-1" id="article_product">
        </div>
        <div class="pade_list_box">
            <? $active = 6;
            include "assec/php/block/page_list_box.php" ?>
            <div class="box">
                <div class="element_box">
                    <div class="box_eme_button_com">
                        <div class="vert_sort_emen">
                            <button onclick="opens('modal_box_coments');">Оставить комментарий</button>
                        </div>
                    </div>
                </div>
                <div class="modal_box_coments hidden_items">
                    <div class="box_d">
                        <div class="close_modalI"><span class="closse" onclick="closse('modal_box_coments');"></span></div>
                        <div class="headers">Оставить комментарий</div>
                        <div class="box_body">
                            <div class="block_auth">
                                <? if (isset($_SESSION['id'])) { ?>
                                    <textarea name="" id="com_input_s"></textarea>
                                <? } else { ?>
                                    <div class="lest">
                                        <p>Чтобы оставить комментарий, нужно быть <a href="authorization&lye=comments">авторизованным</a>.</p>
                                    </div>
                                <? } ?>
                            </div>
                            <input type="button" value="Отправить" onclick="comments_say('coments_si')" <? if (!isset($_SESSION['id'])) echo 'disabled' ?>>
                        </div>
                    </div>
                </div>
                <div class="element_box">
                    <div class="elements_coments_s">
                        <? if (count($comments) >= 1) {
                            for ($i = 0; $i < count($comments); $i++) {
                                $data = $comments[$i];
                                $time =  explode('-', $data[5]);
                                switch ($time[1]) {
                                    case "01": {
                                            $time[1] = 'Января';
                                            break;
                                        }
                                    case "02": {
                                            $time[1] = 'Февраля';
                                            break;
                                        }
                                    case "03": {
                                            $time[1] = 'Марта';
                                            break;
                                        }
                                    case "04": {
                                            $time[1] = 'Апреля';
                                            break;
                                        }
                                    case " 05": {
                                            $time[1] = 'Мая';
                                            break;
                                        }
                                    case "06": {
                                            $time[1] = 'Июня';
                                            break;
                                        }
                                    case "07": {
                                            $time[1] = 'Июля';
                                            break;
                                        }
                                    case "08": {
                                            $time[1] = 'Августа';
                                            break;
                                        }
                                    case "09": {
                                            $time[1] = 'Сентября';
                                            break;
                                        }
                                    case "10": {
                                            $time[1] = 'Октября';
                                            break;
                                        }
                                    case "11": {
                                            $time[1] = 'Ноября';
                                            break;
                                        }
                                    case "12": {
                                            $time[1] = 'Декабря';
                                            break;
                                        }
                                }

                        ?> <div class="comment_contenst" id="comments_id_<? echo $data[0] ?>" onclick="comments_opens(<? echo $data[0] ?>)">

                                    <div class="comment-items">
                                        <div class="header"><? echo $data[4] ?></div>
                                        <div class="contents"><? echo $data[2] ?></div>
                                        <div class="times_coments">
                                            <span><? echo $time[2] . " " . $time[1] . " " . $time[0] . " " ?></span>
                                        </div>
                                    </div>

                                    <? if (isset($_SESSION['ADMIN_LOGIN_IN'])) { ?><div class="close_modal" onclick="remove_coments('<? echo $data[0] ?>')"></div><? } ?>
                                </div>
                        <? }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<? footer() ?>


<!--    -->