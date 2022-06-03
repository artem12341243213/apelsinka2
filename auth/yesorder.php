<?

/* if (!isset($_SESSION['id'])) {
?>
    <script>
        setTimeout(() => {
            locations("home")
        }, 900)
    </script>
<?
    not_found();
} */

hedeer('Спасибо за заказ')



?>
<div class="headers_cart">
    <ul>
        <li class="header_li active none_items_mobil ">
            <div class="list_cart active">
                <div class="cvg cart_svg_n1"></div>
                <div class="box_n">
                    <div class="headers none_items_mobil">1. Ваша корзина</div>
                    <div class="opisanie">Проверьте товары, которые Вы добавили в корзину</div>
                </div>
            </div>
        </li>
        <li class="header_li active none_items_mobil">
            <div class="list_cart active">
                <div class="cvg cart_svg_n2"></div>
                <div class="box_n">
                    <div class="headers none_items_mobil">2. Оформление заказа</div>
                    <div class="opisanie">Заполните данные, необходимые для оформления заказа</div>
                </div>
            </div>
        </li>
        <li class="header_li active">
            <div class="list_cart active">
                <div class="cvg cart_svg_n3"></div>
                <div class="box_n">
                    <div class="headers none_items_mobil">3. Заказ оформлен</div>
                    <div class="opisanie">Спасибо! Ваш заказ принят в работу</div>
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="yesorder">
    <div class="global">

        <div class="block_yedorders text-g">
            <div class="ma"><span id="yes_order"></span></div>

            <div>
                <div class="h2">
                    <h2>Спасибо за заказ</h2>
                </div>
            </div>

            <div>
                <p>Ваш заказ сформирован и передан на склад. После уточнения наличия товара Вам будет выслан предварительный
                    счёт на почту. Для подтверждения заказа или его корректировки с Вами свяжется наш менеджер.</p>
            </div>

            <div>
                <p> <a href="store">Вернуться в магазин</a></p>
            </div>
        </div>
    </div>
</div>


<? footer();
