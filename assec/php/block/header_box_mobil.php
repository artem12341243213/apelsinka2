<div class="header_box_mobil">
    <div class="global">
        <div class="header_box_mobil--box">
            <div class="header_box_mobil__catalog items_s" onclick="opens('modal_catalog_b')">
                <!--  location.reload() -->
                <p class="header_box_mobil-rightPanel_catalog svg "></p>
                <span>Каталог</span>
            </div>
            <div class="header_box_mobil--box--Logo items_s" onclick="list_open('menu_header_box')">
                <p class="dididi"></p>
            </div>
            <div class="header_box_mobil__provil items_s" <? if (isset($_SESSION['id'])) { ?> onclick="locations('profil')">
                <? } else {
                                                                if (array_key_first($_GET) != 'authorization') {
                                                                    if ($_GET == null) $lo = 'home';
                                                                    else $lo = substr(array_key_first($_GET), 1);
                                                                    if (array_key_exists("article", $_GET)) $lo .= "&article=" . $_GET['article'];
                                                                    if (array_key_exists("items", $_GET)) $lo .= "&items=" . $_GET['items']; ?>
                    onclick="locations('authorization&lye=<? echo $lo ?>')">
                <? } else { ?> onclick="locations('authorization')"><? }
                                                            } ?>
                    <p class="header_box_mobil-rightPanel_logoUser svg ">
                    </p> <!-- img-user -->
                    <? if (isset($_SESSION['id'])) { ?>
                        <span>Профиль</span>
                    <? } else { ?>
                        <span>Вход</span>
                    <? } ?>
            </div>
        </div>
    </div>
</div>

<div class="menu_header_box   <? if (isset($_SESSION['ADMIN_LOGIN_IN'])) {
                                    echo 'bottom_minus2';
                                } else {
                                    echo 'bottom_minus';
                                } ?> " onclick="list_open('menu_header_box', 'closse')">
    <div class="menu_header_box_row">
        <div class="list_menu_header">
            <div>
                <p><span class="svg" onclick="opens('modal_catalog_b')"></span>Каталог</p>

                <p><span class="svg" onclick="opens('modal_shearch_b')"></span>Поиск</p>

                <? if (isset($_SESSION['id'])) { ?>
                    <p onclick="locations('profil')"> <span class="svg"></span>Профиль</p>
                <? } else { ?>
                    <p onclick="locations('authorization')"> <span class="svg"></span>Вход</p>
                <? } ?>

            </div>
            <div>
                <p><span class="svg" onclick="$('.razmers_block_modal_element').removeClass('hidden_items');"></span>Размеры</p>
                <p onclick="locations('home')"><span class="svg"></span>Главная</p>


                <p><span class="svg"></span>что-то</p>

            </div>
            <div>
                <p onclick="locations('help')"><span class="svg"></span>Помощь </p>

                <p onclick="list_open('menu_header_box', 'closse')"><span class="svg"></span> Закрыть</p>

                <p onclick="locations('cart')"><span class="svg"></span>Корзина</p>
            </div>

            <? if (isset($_SESSION['ADMIN_LOGIN_IN'])) { ?>
                <div>
                    <p onclick="locations('adminPanels')"><span class="svg"></span>Админ_панель</p>
                </div>
            <? } ?>

        </div>
    </div>
</div>

<div class="modal_shearch_b hidden_items">
    <div class="modal_content">
        <form action="store" method="post">
            <input type="text" name="search" id="search" class="search" placeholder="Поиск...">
            <button class="button_search" tabindex="0" value=""> </button>
        </form>
        <button onclick="closse('modal_shearch_b')">Закрыть</button>
    </div>
</div>
<div class="modal_catalog_b hidden_items">
    <div class="catalog_body">
        <div class="catalog_content" id="body_catalogs">
            <p onclick="closse('modal_catalog_b')" class="closens">
                <span class="UPPERCASE">Закрыть</span>
            </p>
            <p onclick="list_catalog_modals('boys')">
                <span class="UPPERCASE">Мальчики</span>
            </p>
            <p onclick="list_catalog_modals('girl')">
                <span class="UPPERCASE">Девочки</span>
            </p>
            <p onclick="list_catalog_modals('baby')">
                <span class="UPPERCASE">Малыши</span>
            </p>
            <p onclick="locations('store&items=new')">
                <span class="UPPERCASE">Новинки</span>
            </p>
            <p onclick="locations('store&items=collection')">
                <span class="UPPERCASE">Коллекция</span>
            </p>
            <p onclick="locations('store&items=sale')">
                <span class="UPPERCASE"> Распродажа</span>
            </p>
        </div>
    </div>
</div>
<script>
    //document.getElementsByClassName("menu_header_box")[0].style.height = "91vw";
    //document.getElementsByClassName("menu_header_box")[0].style.bottom = "91vw";
</script>