<div class="header_box">
    <!-- Пк версия шапки -->
    <div class="global">
        <div class="header_box--box">

            <div class="header_box--box--leftPonel">
                <p class="header_box-leftPonel--text">
                    <a href="mailto:<? echo $GLOBALS['kontakts']["mail"] ?>"><? echo $GLOBALS['kontakts']["mail"] ?></a>
                </p>
                <p class="header_box-leftPonel--text">
                    <a href="tel:<? echo $GLOBALS['kontakts']["phone_one"] ?>"><? echo $GLOBALS['kontakts']["phone_one"] ?></a>
                </p>
                <p class="header_box-leftPonel--text">
                    <a href="tel:<? echo $GLOBALS['kontakts']["phone_two"] ?>"><? echo $GLOBALS['kontakts']["phone_two"] ?></a>
                </p>

            </div>
            <div class="header_box--box--Logo">
                <a href="/" class="dididi">
                    <span class="logo">Апельсинка</span>
                    <div class="logo_did"></div>
                </a>
            </div>

            <div class="header_box--box--rightPanel">

                <div class="header_box--box--rightPanel_users">
                    <? if (!isset($_SESSION['id'])) {
                        if (array_key_first($_GET) != 'authorization') {
                            if ($_GET == null) $lo = 'home';
                            else $lo = substr(array_key_first($_GET), 1);
                            if (array_key_exists("article", $_GET)) $lo .= "&article=" . $_GET['article'];
                            if (array_key_exists("items", $_GET)) $lo .= "&items=" . $_GET['items'];
                    ?>
                            <a href="authorization&lye=<? echo $lo ?>" class="header_box-rightPanel_href" title="Переход на страницу авторизации">
                            <? } else { ?>
                                <a href="authorization" class="header_box-rightPanel_href" title="Переход на страницу авторизации">
                                <? } ?>
                                <p class="header_box-rightPanel_logoUser svg "></p> <!-- img-user -->
                                <p class="header_box-rightPanel_auth">Вход/Регистрация</p>
                                </a>
                            <? } else { ?>
                                <a href="profil" class="header_box-rightPanel_href" title="Переход на страницу профилья">
                                    <p class="header_box_logoUser">
                                        <img src="assec/images/users/<? echo $_SESSION['img'] ?>" alt=""> <!-- img-user -->
                                    </p>
                                    <p class="header_box-rightPanel_auth">Профиль</p>
                                </a>
                            <? } ?>
                            <a href="profil&favorites">
                                <p class="header_box-rightPanel_favorites svg" title="Избранное"> <span class="text-g">0</span></p>
                            </a>

                            <div class="header_box-rightPanel_cart svg" title="Корзина">
                                <span class="text-g">0</span>
                            </div>
                </div>

                <div class="backet_box hidden_items">
                    <div class="header_backet">
                        <div class="header_backet_heders">
                            <p>Твоя корзина</p>
                        </div>
                        <div class="header_backet_counts">
                            <p>Кол-во: <span id="header_backet_count">0</span></p>
                        </div>
                    </div>
                    <div class="body_backet ">
                        <!--    <div class="noneitems_cart"  none_items>
                    <p> Здесь пока ничего нет</p>
                    <p onclick="locations('store&items=bous')">Начни покупять прямо сейчас </p>
                </div> -->

                        <div class="items_backet">
                            <div class="items_img_backet"><img src="assec/images/product/PHOTO-2022-02-20-12-03-40.jpg" alt=""></div>
                            <div class="items_backet_body">
                                <div class="items_titles_backet"><a href="product&amp;article=100061"> Футболка
                                        <div class="items_artiecle_backet"> Артикул: 100061</div>
                                    </a>
                                </div>
                                <div class="items_size_backet">Размер: 80</div>
                                <div class="items_counts_backet">
                                    <div class="items_counts_button_backet">
                                        <div class="buttons_backet">
                                            <button><span class="button_backet_up" data-src="100061" data-lis="0" onclick="button_backet_up('100061','0')"></span></button>
                                            <p id="counts_button_backet">1 Упк</p>
                                            <button><span class="button_backet_down" data-src="100061" data-lis="0" onclick="button_backet_down('100061','0')"></span></button>
                                        </div>
                                        <p>x123 за шт.</p>
                                    </div>
                                    <div class="count_all_price"> ИТОГО:1750</div>
                                </div>
                                <div class="button_mobil_delet_items"><button>Удалить</button></div>
                            </div>
                        </div>

                    </div>

                    <div class="footer_backet">
                        <div class="footer_backet_all">Итого: <span id="footer_backet_all_count">0</span> ₽</div>
                        <div class="footer_backet_button">
                            <button style="cursor:pointer" onclick="locations('cart')">Перейти</button>
                        </div>
                    </div>
                </div>
                <div class="header_box--box--rightPanel_search" title="Поиск товара по сайту">
                    <form action="store" method="post">
                        <input type="text" name="search" id="search" class="search" placeholder="Поиск...">
                        <button class="button_search" tabindex="0" value=""> </button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>