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

                    <?
                    $url = ltrim(array_key_first($_GET), "/");
                    if (!isset($_SESSION['id'])) {

                        if ($_GET == null) $lo = 'home';
                        else if ($url == 'authorization' || $url == 'registers') $lo = 'home';
                        else {
                            $lo = ltrim(array_key_first($_GET), "/");
                        }
                        if (array_key_exists("article", $_GET)) $lo .= "&article=" . $_GET['article'];
                        if (array_key_exists("items", $_GET)) $lo .= "&items=" . $_GET['items'];
                    ?>
                        <a href="authorization&lye=<? echo $lo ?>" class="header_box-rightPanel_href" title="Переход на страницу авторизации">

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
                        <div class="noneitems_cart" none_items>
                            <p> Здесь пока ничего нет</p>
                            <p onclick="locations('store&items=bous')">Начни покупять прямо сейчас </p>
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