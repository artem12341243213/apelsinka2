<div class="hidden_items nam_menu_headers ">
    <div class="global">
        <?/* Корзина */ ?>
        <div class="backet_box hidden_items">
            <div class="header_backet">
                <div class="header_backet_heders">
                    <p>Твоя корзина</p>
                </div>
                <div class="header_backet_counts">
                    <p>Кол-во: <span id='header_backet_count'>0</span></p>
                </div>
            </div>
            <?  /*Здесть пока ничего нет*/ ?>
            <div class="body_backet none_items">

            </div>
            <div class="footer_backet">
                <div class="footer_backet_all">Итого: <span id="footer_backet_all_count">22000</span></div>
                <div class="footer_backet_button"><a href="cart"><button style="cursor:pointer">Перейти</button></a></div>
            </div>
        </div>
        <?/* /Корзина */ ?>


        <div class="header_box--box--rightPanel_users">
            <? if (!isset($_SESSION['id'])) { ?>
                <a href="authorization" class="header_box-rightPanel_href" title="Переход на страницу авторизации">
                    <p class="header_box-rightPanel_logoUser svg "></p> <!-- img-user -->
                    <p class="header_box-rightPanel_auth">Вход/Регистрация</p>
                </a>
            <? } else { ?>
                <a href="profil" class="header_box-rightPanel_href" title="Переход на страницу профилья">
                    <p class="header_box_logoUser">
                        <img src="assec/images/users/<? echo decode($_SESSION['img']) ?>" alt=""> <!-- img-user -->
                    </p>
                    <p class="header_box-rightPanel_auth">Профиль</p>
                </a>
            <? } ?>
            <a href="profil&favorites">
                <p class="header_box-rightPanel_favorites svg" title="Избранное"> <span class="text-g">0</span></p>
            </a>
            <a>
                <p class="header_box-rightPanel_cart svg" title="Корзина"> <span class="text-g">0</span> </p>
            </a>

        </div>
        <div class="header_box--box--rightPanel_search" title="Поиск товара по сайту">
            <form action="store" method="post">
                <input type="text" name="search" id="search_" class="search" placeholder="Поиск...">
                <button class="button_search" tabindex="0" value=""> </button>
            </form>
        </div>
    </div>
</div>