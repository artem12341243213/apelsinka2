<? hedeer("Оплата");

?>
<div class="comments_box">
    <div class="global">
        <div class="h1 text-g">
            <h1>Оплата</h1>
            <input type="hidden" value="-1" id="article_product">
        </div>
        <div class="pade_list_box">
            <? $active = 3;
            include "assec/php/block/page_list_box.php" ?>
            <div class="box">
                <div class="paument_box">
                    <div class="paument_box_n1">
                        <div class="h3">
                            <h3>БЕЗНАЛИЧНЫЙ РАСЧЕТ</h3>
                        </div>
                        <p>После согласования заказа, менеджер выставляет счет, который должен быть оплачен в течение 3
                            банковских дней. Если в течение этого времени Вы не произвели оплату, счет становится недействительным.
                            Для выставления нового счета Вам необходимо созвониться со своим менеджером.</p>
                    </div>
                    <div class="paument_box_n2">
                        <div class="h3">
                            <h3>НАЛИЧНЫЙ РАСЧЕТ</h3>
                        </div>
                        <p>Оплата заказа производится наличными денежными средствами при самовывозе.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<? footer() ?>