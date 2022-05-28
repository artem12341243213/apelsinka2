<?
hedeer("Главная", ['chief-slider']);
?>

<!--  Cлайдер блок -->

<!-- <div class="slider-block">
    <div class="global">
        <div class="slider-modul">
            <div class="slider">
                <div class="slider-line">
                    <img src="assec/images/0002126.png" alt="" title="" loading='lazy'>
                    <img src="assec/images/0002053.png" alt="" title="" loading='lazy'>
                    <img src="assec/images/0002125.png" alt="" title="" loading='lazy'>
                    <img src="assec/images/0002053.png" alt="" title="" loading='lazy'>
                </div>
            </div>
            <div class="button-slider">
                <button class="slider-button slider-prev" data-src="prev|header"></button>
                <button class="slider-button slider-next" data-src="next|header"></button>
            </div>
        </div>
    </div>
</div> -->

<!--  Доп меню -->

<div class="dopNawmenu">
    <div class="global">
        <div class="contents">
            <div class="h1 text-g">
                <h1>детская ОДЕЖДА оптом от ПРОИЗВОДИТЕЛЯ</h1>
            </div>
            <div class="contents-list">
                <div class="contents-list__element">
                    <a href="store&items=girle">
                        <div class="bacgraund"></div>
                        <div class="img">
                            <img src="assec/images/dopMenu-element1.png" alt="Девочки">
                        </div>
                        <div class="button text-g"> Девочки</div>
                    </a>
                </div>
                <div class="contents-list__element">
                    <a href="store&items=bous">
                        <div class="bacgraund"></div>
                        <div class="img">
                            <img src="assec/images/dopMenu-element2.png" alt="Мальчики">
                        </div>
                        <div class="button text-g"> Мальчики</div>
                    </a>
                </div>
                <div class="contents-list__element">
                    <a href="store&items=kids">
                        <div class="bacgraund"></div>
                        <div class="img">
                            <img src="assec/images/dopMenu-element3.png" alt="Малыши">
                        </div>
                        <div class="button text-g"> Малыши</div>
                    </a>
                </div>
                <div class="contents-list__element">
                    <a href="store&items=collection">
                        <div class="img">
                            <img src="assec/images/dopMenu-element4.png" alt="Распродажа">
                        </div>
                    </a>
                </div>

                <div class="contents-list__element">
                    <a href="store&items=sale">
                        <div class="img">
                            <img src="assec/images/dopMenu-element5.png" alt="Разное">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--  Новинки-->

    <div class="nowinki">
        <div class="global">
            <div class="h1 text-g">
                <h1>Наши новинки</h1>
            </div>
            <div class="nowinki_list-items">
                <div style="overflow: hidden; padding: 10px 0;">
                    <div class="list" style="transform:translateX(0px);">
                        <!-- min = 0 max = -1486px-->
                        <?
                        /* $max = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT COUNT(`articl`) AS 'i' FROM `product` WHERE `elements_sorters` = 3"))['i'];
                    $max -= 10;*/


                        if (false) {
                            $sit = 0;
                        ?>
                            <div class="none_itemm_sliders">
                                <p>К сожалению товаров на данный момент нет</p>
                            </div>
                        <?
                        } else {






                            $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM (SELECT * FROM `product` ORDER BY `articl` DESC LIMIT 10) t ORDER BY `articl`;"));
                            if (count($array) > 1) {
                                foreach ($array as $item) {

                                    $article_product            =       $item[0];
                                    $titles_product             =       $item[1];
                                    $size_product               =       $item[3];
                                    $count_product              =       $item[4];
                                    $catecorian_product         =       $item[5];
                                    $pod_catecorian_product     =       $item[6];
                                    $sostav_product             =       $item[7];
                                    $textile_product = $item[8];

                                    $disables_product           =       $item[9];
                                    $price_opt_product          =       $item[11];
                                    $price_roz_product          =       $item[12];

                                    $img = explode('|',  $item[2]);
                                    $img = $img[rand(0, count($img) - 1)];

                                    include 'assec/php/block/items_slider_nows.php';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <? if (!isset($sit)) { ?>
                    <div class="nowinki_list-button-slider none_items_mobil">
                        <button class="slider-button slider-prev" data-src="prev|product"></button>
                        <button class="slider-button slider-next" data-src="next|product"></button>
                    </div><? } ?>
            </div>

        </div>
    </div>

    <!--  прайс заявка-->
    <div class="prise-block">
        <div class="global">
            <div class="prise-block-content text-g">
                <div>
                    <h3>Оставьте заявку и получите оптовый прайс на нашу продукцию</h3>
                </div>
                <div class="input">
                    <input type="text" placeholder="ФИО" id="FIO">
                    <input type="text" placeholder="Телефон" id="phone">
                    <input type="text" placeholder="Ваш e-mail" id="email">
                    <input type="button" value="Отправить" onclick="check_box('readm_prise','formes,GLA1,prise_block,FIO.phone.email');">
                </div>
                <div class="cheked-sog"><input type="checkbox" id="readm_prise"> <label for="readm_prise" style="font-family: Sans-Serif;">Даю согласие на
                        обработку моих персональных данных</label></div>
            </div>
        </div>
    </div>

    <!--  Комментарии-->
    <?

    $comments = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `comments` WHERE `id_product` = '-1' and`id_comments` limit 10"));
    ?>
    <div class="comments_block">
        <div class="global">
            <div class="h1 text-g">
                <h1>Комментарии</h1>
            </div>
            <div class="slider comm">
                <div class="slider__container">
                    <div class="slider__wrapper">
                        <div class="slider__items">
                            <? if (count($comments) >= 1) {
                                for ($i = 0; $i < count($comments); $i++) {
                                    $data = $comments[$i];
                            ?>
                                    <div class="slider__item comm">
                                        <div class="conten_item">
                                            <div class="header"><? echo $data[4] ?></div>
                                            <div class="contents"><? echo $data[2] ?></div>
                                            <a href="comments&id=<? echo $data[0] ?>" class="comment_contenst">Комментарий к сайту </a>
                                        </div>
                                    </div>
                            <? }
                            } ?>
                        </div>
                    </div>
                </div>
                <a class="slider__control" data-slide="prev"></a>
                <a class="slider__control" data-slide="next"></a>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = new ChiefSlider('.slider.comm', {
                loop: true,
                autoplay: false,
                interval: 5000,
                swipe: true,
                refresh: true
            });
        });
    </script>
    <? $mi = ['slider_js'] ?>
    <? footer($mi, "assec/js/chief-slider.js", "defer") ?>