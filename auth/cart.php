<? hedeer("Корзина");

if (isset($_SESSION['id'])) {
    $cart_item_user = mysqli_query($CONNECT, "Select * From `cart_users` WHERE `id_user`=" . $_SESSION['id'] . "");

    if (($cart_item_user->num_rows) > 0) {
        $cart_item_user = mysqli_fetch_assoc($cart_item_user)['item'];

        if (strlen($cart_item_user) != 2) {
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


            $array_codes = json_encode($cart_item_user, JSON_UNESCAPED_UNICODE);
            unset($disables_items);

            mysqli_query($CONNECT, "UPDATE `cart_users` SET `item` = '" . $array_codes . "' WHERE `id_user` = " .  $_SESSION['id'] . ";");
        }
    }
}
?>


<div class="cart">
    <div class="global">
        <div class="headers_cart">
            <ul>
                <li class="header_li active">
                    <div class="list_cart active">
                        <div class="cvg cart_svg_n1"></div>
                        <div class="box_n">
                            <div class="headers none_items_mobil">1. Ваша корзина</div>
                            <div class="opisanie">Проверьте товары, которые Вы добавили в корзину</div>
                        </div>
                    </div>
                </li>
                <li class="header_li none_items_mobil">
                    <div class="list_cart">
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
                            <div class="headers none_items_mobil">3. Заказ оформлен</div>
                            <div class="opisanie">Спасибо! Ваш заказ принят в работу</div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="body_cart">
            <div class="header_body">
                <div class="header_tables">
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
            </div>
            <div class="body_cart_box">
                <div class="cart_none_imtes hidden_items">
                    <p>
                        Здесь пока ничего нет <br>
                        <a href="store">Вперед за покупками</a>
                    </p>
                </div>
            </div>
        </div>
        <?
        if (isset($_SESSION['id'])) { ?>
            <div class="footer_cart">
                <div class="footer_cart_box">
                    <div class="footer_cart_bonus"><input type="text" id="bonuse" placeholder="Введите промодок для скидки">
                        <button onclick="bonus_activiti('bonuse')" class="button_dels_bonus">Активировать</button>
                    </div>
                    <div class="mobil_flex_footer">
                        <div class="footer_cart_margin"><button onclick="locations('orderchek')">Оформить заказ</button></div>
                        <div class="footer_cart_allPrice">
                            <p><span style="text-decoration: underline;">Итог</span> <span id="cart_allPritse">0</span></p>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</div>

<script>
    <?
    if (isset($_SESSION['id'])) { ?>
        var s = <? print_r($array_codes) ?>;
        localStorage.setItem('cart', JSON.stringify(s));
    <? } ?>
</script>
<? footer(['page_cart']) ?>
<!-- [{"article" : 100064,"disables" : 0,"id_cartItems" : 0,"prise" : 330,"count_s" : 1,"count_f" : 1,"title" : Комбинезоны с лапкой,"img" : PHOTO-2022-02-20-12-05-19.jpg,"Opt" :0,"size" : 68,"dels" : 0,"price_all" : 330,}{"article" : 100079,"disables" : 0,"id_cartItems" : 0,"prise" : 550,"count_s" : 1,"count_f" : 1,"title" : Толстовка с капюшоном,"img" : PHOTO-2022-03-06-08-56-53.jpg,"Opt" :0"size" : 116,"dels" : 0,"price_all" : 550,}{"article" : 100081,"disables" : 0,"id_cartItems" : 0,"prise" : 420,"count_s" : 1,"count_f" : 1,"title" : Комбинезон манжет,"img" : PHOTO-2022-03-06-09-00-02 3.jpg,"Opt" : 0,"size" : 68,"dels" : 0,"price_all" : 0}]
 -->