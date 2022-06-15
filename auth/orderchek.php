<? hedeer("Корзина");
$lands = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `land` ORDER BY `title` ASC"));

if (!isset($_SESSION['id'])) {
?>
    <script>
        setTimeout(() => {
            locations("home")
        }, 900)
    </script>
<?
    not_found();
}
?>

<div class="headers_cart">
    <ul>
        <li class="header_li active none_items_mobil"><a href="cart">
                <div class="list_cart active">
                    <div class="cvg cart_svg_n1"></div>
                    <div class="box_n">
                        <div class="headers">1. Ваша корзина</div>
                        <div class="opisanie">Проверьте товары, которые Вы добавили в корзину</div>
                    </div>

                </div>
            </a>
        </li>
        <li class="header_li active">
            <div class="list_cart active">
                <div class="cvg cart_svg_n2"></div>
                <div class="box_n">
                    <div class="headers none_items_mobil">2. Оформление заказа</div>
                    <div class="opisanie">Заполните данные, необходимые для оформления заказа</div>
                </div>
            </div>
        </li>
        <li class="header_li none_items_mobil">
            <div class="list_cart">
                <div class="cvg cart_svg_n3"></div>
                <div class="box_n">
                    <div class="headers">3. Заказ оформлен</div>
                    <div class="opisanie">Спасибо! Ваш заказ принят в работу</div>
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="block_data_user">
    <div class="global">
        <? if (isset($_SESSION['id'])) {

            $name = $_SESSION['last_name'] . " " . $_SESSION['name'] . " ";

            if ($_SESSION['first_name'] != "-") $name .= $_SESSION['first_name'];
        ?>
            <div class="car_h1">
                <h1>Контактные данные</h1>
            </div>
            <div class="data_user">
                <!--  -->
                <div class="users_name">
                    <span class="mobil_element">Отредактировать данные можно в <a href="profil">личном кабинете</a></span>
                    <p>
                        <label for="">ФИО: </label><input type="text" placeholder="ФИО" disabled value="<? print($name) ?>">
                    </p>
                    <p>
                        <label for="">Email: </label>
                        <input type="emai" placeholder="Email" id="email" disabled value="<? print($_SESSION['email']) ?>">
                    </p>

                    <p>
                        <label for="">Телефон: </label>
                        <? if (decode($_SESSION['phone']) == NULL) { ?>
                            <input type="phone" placeholder="Телефон" id="phone_input" value="">
                        <? } else { ?>
                            <input type="phone" placeholder="Телефон" id="phone_input" disabled value="<? print(decode($_SESSION['phone'])) ?>">
                        <? } ?>
                    </p>
                </div>

            </div>
        <? } else { ?>
            <div class="car_h1">
                <h1>Контактные данные</h1>
            </div>
            <div class="data_user">
                <div class="users_name">
                    <label for="">Заполните поля ниже</label>
                    <p>
                        <input type="text" placeholder="ФИО" oninput="fio_valid()" id="fionns"><span class="" id="fios"></span>
                    </p>
                    <p><input type="emai" placeholder="Email" id="email" oninput="valids_mail_page()"><span class=""></span></p>
                    <button onclick="code_meil()" disabled id="button_mail_p_d" class="hidden_items"> Отправить код</button>

                    <div class="chek_mail_cart hidden_items">
                        <p>

                            <label for="">Введите код отправленный на указанную вами почту</label>

                            <span class="letions_fwadwaghyu">
                                <input type="text" placeholder="Введите код" id="input_code_le">
                                <span id="mail_code_span"></span>
                            </span>

                            <button onclick="code_meil('dobe')">Подтвердить</button>
                        </p>
                    </div>


                    <p> <input type="phone" placeholder="Телефон" id="phone_input" oninput="phone_valid_s()"> <span class="" id="phone_span"></span></p>
                </div>
                <div class="code_data">
                    <div class="box_date_right_cod">
                        <a href="authorization">Войти</a>
                        <a href="registers">Зарегестрироваться</a>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</div>


<div class="block_data_user">
    <div class="global">

        <div class="car_h1">
            <h1>Служба доставки</h1>
        </div>
        <div class="data_user">
            <div class="block_pochta_in">
                <div style="display:none;">
                    <input type="radio" name="dost" id="pochta_ru_r">
                    <input type="radio" name="dost" id="pochta_sdek_r">
                    <input type="radio" name="dost" id="samvi1_r">
                    <input type="radio" name="dost" id="samvi2_r">
                    <input type="radio" name="dost" id="operator_r" checked>
                </div>

                <label for="operator_r">
                    <div class="box_item_cart active" id="operator" onclick="pochta('operator')">
                        <div class="bloxk_cart">
                            <div class="img_block_cart_item"> <img src="/assec/images/dostavka/manedjer.png" alt=""></div>
                            <div class="text_block_cart_item">
                                <p>Связь с менеджером</p>
                            </div>
                        </div>
                    </div>
                </label>

                <label for="pochta_ru_r">
                    <div class="box_item_cart" id="pochta_ru" onclick="pochta('pochta_ru')">
                        <div class="bloxk_cart">
                            <div class="img_block_cart_item"> <img src="/assec/images/dostavka/Pochta_Ru.png" alt=""></div>
                            <div class="text_block_cart_item">
                                <p>Почта России</p>
                            </div>
                        </div>
                    </div>
                </label>

                <label for="pochta_sdek_r">
                    <div class="box_item_cart" id="pochta_sdek" onclick="pochta('pochta_sdek')">
                        <div class="bloxk_cart">
                            <div class="img_block_cart_item"> <img src="/assec/images/dostavka/Pochta_sdek.jpg" alt=""></div>
                            <div class="text_block_cart_item">
                                <p>CDEK</p>
                            </div>
                        </div>
                    </div>
                </label>
                <label for="samvi1_r">
                    <div class="box_item_cart" id="samvi1" onclick="pochta('samvi1')">
                        <div class="bloxk_cart">
                            <div class="img_block_cart_item"> <img src="/assec/css/svg/cart/order_mi_sami.svg" alt=""></div>
                            <div class="text_block_cart_item">
                                <p>Самовывоз. Точка 1</p>
                            </div>
                        </div>
                    </div>
                </label>
                <label for="samvi2_r">
                    <div class="box_item_cart" id="samvi2" onclick="pochta('samvi2')">
                        <div class="bloxk_cart">
                            <div class="img_block_cart_item"> <img src="/assec/css/svg/cart/order_mi_sami.svg" alt=""></div>
                            <div class="text_block_cart_item">
                                <p>Самовывоз. Точка 2</p>
                            </div>
                        </div>
                    </div>
                </label>

            </div>

            <div class="block_pochta_op">
                <div class="block">
                    <div class="text_h2">Узнать у менеджера</div>
                    <div class="text_le">Наш менеджер свяжется с Вами, чтобы уточнить детали доставки.</div>
                    <div class="opisanie"></div>
                    <div class="opisanie_n"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="block_data_user">
    <div class="global">
        <? if (isset($_SESSION['id'])) { ?>
            <div class="car_h1">
                <h1>Адресс доставки</h1>
            </div>
            <div class="data_user">

                <div class="data_lis_input">

                    <p><label for=""> Фамилия</label>
                        <input type="text" placeholder="Фамилия" id="last_name" value="<? print($_SESSION['last_name']) ?>">
                    </p>
                    <p><label for=""> Имя </label>
                        <input type="text" placeholder="Имя" id="name" value="<? print($_SESSION['name']) ?>">
                    </p>
                    <p><label for=""> Отчество</label>
                        <input type="text" placeholder="Отчество" id="first_name" value="<? print($_SESSION['first_name']) ?>">
                    </p>
                    <p><label for=""> Область</label>
                        <input type="text" placeholder="Область" id="obl" value="<? print(decode($_SESSION['region'])) ?>">
                    </p>
                    <p><label for="">Город </label>
                        <input type="text" placeholder="Город" id="sity" value="<? print(decode($_SESSION['sity'])) ?>">
                    </p>
                    <p><label for=""> Улица</label>
                        <input type="text" placeholder="Улица" id="strasse" value="<? print(decode($_SESSION['strasse'])) ?>">
                    </p>
                    <p><label for="">Дом </label>
                        <input type="text" placeholder="Дом" id="home_strasse" value="<? print(decode($_SESSION['home'])) ?>">
                    </p>
                    <p><label for="">Квартира </label>
                        <input type="text" placeholder="Кватира" id="home" value="<? print(decode($_SESSION['kvart'])) ?>">
                    </p>
                    <p><label for=""> Индекс</label>
                        <input type="text" placeholder="Индекс" id="Address_ZipPostalCode" value="<? print(decode($_SESSION['inpex_home'])) ?>">
                    </p>
                </div>
                <div class="box_dats">
                    <p><label for="">Проверте правильность данных для доставки</label></p>
                    <p><label for="">Поля без значений закрыть "-"</label></p>
                    <p><label for=""><a href=""></a></label></p>
                </div>
            </div>
        <? } else { ?>
            <div class="car_h1">
                <h1>Адресс доставки</h1>
            </div>
            <div class="data_user">

                <div class="data_lis_input">
                    <input type="text" placeholder="Фамилия" id="last_name" onclick="not_red('last_name')" value="">
                    <input type="text" placeholder="Имя" id="name" onclick="not_red('name')" value="">
                    <input type="text" placeholder="Отчество" id="first_name" onclick="not_red('first_name')" value="">
                    <input type="text" placeholder="Область" id="obl" onclick="not_red('obl')" value="">
                    <input type="text" placeholder="Город" id="sity" onclick="not_red('sity')" value="">
                    <input type="text" placeholder="Улица" id="strasse" onclick="not_red('strasse')" value="">
                    <input type="text" placeholder="Дом" id="home_strasse" onclick="not_red('home')" value="">
                    <input type="text" placeholder="Кватира" id="home" onclick="not_red('kvart')" value="">
                    <input type="text" placeholder="Индекс" id="Address_ZipPostalCode" onclick="not_red('index')" value="">
                </div>
            </div>
        <? } ?>
    </div>
</div>

<div class="block_data_user">
    <div class="global">

        <div class="car_h1">
            <h1>Корзина</h1>
        </div>
        <div class="data_user">
            <div class="body_cart">
                <div class="header_body">
                    <? if ($type == 'opt') { ?>
                        <ol class="header_talbes_ol">
                            <li class="bold cor_title_items"> Ваша корзина </li>
                            <li class="none_items_mobil">Размер</li>
                            <li class="none_items_mobil">Количество уп.</li>
                            <li class="none_items_mobil">Цена за 1 шт.</li>
                            <li class="none_items_mobil">Количество в упаковке</li>
                            <li class="none_items_mobil">Итого</li>
                        </ol>
                    <? } else { ?>
                        <ol class="header_talbes_ol">
                            <li class="bold cor_title_items"> Ваша корзина </li>
                            <li class="none_items_mobil">Размер</li>
                            <li class="none_items_mobil">Количество</li>
                            <li class="none_items_mobil">Цена за 1 шт.</li>
                            <li class="none_items_mobil">Количество в упаковке</li>
                            <li class="none_items_mobil">Итого</li>
                        </ol>
                    <? } ?>
                </div>
                <div class="body_cart_box_s">
                    <? $rowe = mysqli_fetch_assoc(mysqli_query($CONNECT, "Select * From `cart_users` WHERE `id_user`='" . $_SESSION['id'] . "'"))['item'];
                    $rowe = json_decode($rowe, true);
                    foreach ($rowe as $item) {
                    ?>
                        <div class="cart_items" id="items_n_<? echo $item['article'] ?>">
                            <?
                            if ($item['disables'] == 1) {
                            ?><div class="delete_product"><span>Товар недоступен</span></div><? } ?>
                            <div class="items_titles">
                                <div class="heders_item_n1"><img src="/assec/images/product/<? echo $item['img'] ?>" alt=""></div>
                                <div class="heders_item_n2">
                                    <div class="titles_header"><? echo str_replace("PL", "+", $item['title']) ?></div>
                                    <div class="article_header">Артикле <span><a href="product&article=<? echo $item['article'] ?>"><? echo $item['article'] ?></a></span></div>
                                </div>
                            </div>
                            <div class="items_size"> <span class="mobil_element">Размер</span> <? echo $item['size'] ?></div>
                            <div class="items_count">
                                <span class="mobil_element"> Количество </span>
                                <div>
                                    <p>
                                        <? echo $item['count_s'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="items_prise_orig"><span class="mobil_element"> цена за 1 шт</span> <? echo $item['prise'] ?></div>
                            <div class="items_count_orig"><span class="mobil_element"> Колличество в упаковке</span> <? echo $item['count_f'] ?></div>
                            <div class="items_allPrise"><span class="mobil_element"> итог</span><? echo $item['price_all'] ?></div>
                        </div>
                    <? } ?>
                </div>

            </div>

        </div>

        <div class="footer_cart order_cheeek">
            <div class="footer_cart_box">
                <div class="mobil_flex_footer">
                    <div class="footer_cart_margin"><button onclick="locations('yesorder')">Оформить</button></div>
                    <div class="footer_cart_allPrice">
                        <p><span style="text-decoration: underline;">Итог</span> <span id="cart_allPritse">0</span></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<? footer(['page_cart']) ?>