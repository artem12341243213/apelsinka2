<? hedeer("Сотрудничество");

?>
<div class="comments_box">
    <div class="global">
        <div class="h1 text-g">
            <h1>Сотрудничество</h1>
            <input type="hidden" value="-1" id="article_product">
        </div>
        <div class="pade_list_box">
            <? $active = 2;
            include "assec/php/block/page_list_box.php" ?>
            <div class="box">
                <div class="paument_box">
                    <div class="paument_box_n1">
                        <div class="h3">
                            <h3>УСЛОВИЯ СОТРУДНИЧЕСТВА</h3>
                        </div>
                        <ol>
                            <li>Заказы от <strong>10 000 рублей</strong></li>
                            <li>Мы сотрудничаем как с юридическими, так и с физическими лицами.</li>
                            <li>Работаем на территории РФ.</li>
                            <li>Продажа продукции осуществляется упаковками. Можно делать заказ на те размеры, которые нужны.
                                Нет необходимости брать весь размерный ряд!</li>
                        </ol>
                    </div>
                    <div class="paument_box_n2">
                        <div class="h3">
                            <h3>КАК СДЕЛАТЬ ЗАКАЗ</h3>
                        </div>
                        <p>У нас Вы можете сделать заказ любым удобным для Вас способом:</p>
                        <ul>
                            <li>отправить Ваш заказ на электронную почту <a href="mailto:<? echo $GLOBALS['kontakts']['mail']; ?>"><? echo $GLOBALS['kontakts']['mail']; ?></a></li>
                            <li>по телефону <a href="tel:<? echo $GLOBALS['kontakts']['phone_one']; ?>"><? echo $GLOBALS['kontakts']['phone_one']; ?></a></li>
                            <li>сформировать корзину с заказом на нашем сайте.</li>
                        </ul>
                    </div>
                    <div class="paument_box_n3">
                        <div class="h3">
                            <h3>ФОРМИРОВАНИЕ ЗАКАЗА</h3>
                        </div>
                        <ol>
                            <li>После получения заявки заказ передается на склад.</li>
                            <li>После уточнения наличия товара Вам будет выслан предварительный счёт на почту.</li>
                            <li>Для уточнения и подтверждения заказа с Вами свяжется наш менеджер.</li>
                            <li>После подтверждения заказа Вам будет выслан окончательный счет.</li>
                            <li>После согласование счета и оплаты, мы делаем отправку транспортной компанией.</li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<? footer() ?>