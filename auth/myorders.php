<?
$items_Array = mysqli_query($CONNECT, "SELECT * FROM `past_orders` WHERE `id_user` = 35 ORDER BY `id` DESC"); //. $_SESSION['id']);

?>


<div class="myorders">
    <div class="header_orders">
        <div class="h2 text-g">
            <h2>Заказы</h2>
        </div>
    </div>

    <div class="body_orders">

        <div class="list_orders">
            <? if ($items_Array->num_rows != 0) {
                $array =  mysqli_fetch_all($items_Array);
                for ($i = 0; $i < count($array); $i++) {
                    $item = $array[$i];
                    $id = $item[0];
                    $id_user = $item[1];
                    $name_product = explode("|", $item[2]); //
                    $size = explode("|", $item[3]); //
                    $img = explode("|", $item[4]); //
                    $count = explode("|", $item[5]); //
                    $prise = $item[6];
                    $status = $item[7];
                    $delivery = $item[8];
                    $codeitems = $item[9]; ?>
                    <div class="item_list_orders" id="order_s_">
                        <div>
                            <?
                            $array_itm = count($name_product);
                            for ($k = 0; $k < $array_itm - 1; $k++) { ?>
                                <div class="items_orders_ovit">
                                    <div class="body_items_orders">
                                        <div class="img">
                                            <img src="assec/images/product/<? echo $img[$k] ?>" alt="обложка товара">
                                        </div>
                                        <div class="heders_items_oreders">
                                            <p> Название: <? echo   explode("&", $name_product[$k])[0] ?></p>
                                            <p> Артикл: <a href="product&article=<? echo   explode("&", $name_product[$k])[1] ?>">
                                                    <? echo   explode("&", $name_product[$k])[1] ?></a></p>
                                            <p> Размеp: <? echo  $size[$k] ?></p>
                                            <p> Доставка: <? echo $delivery  ?></p>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                        <div class="button_meneu">
                            <? switch ($status) {
                                case 'ovit':
                                    echo  '<div class="yesorder_o"> Заказ на подтверждении</div>';
                                    break;
                                case 'process':
                                    echo  '<div class="yesorder_y"> Заказ подтвержден</div>';
                                    break;
                                case 'yesorders':
                                    echo  '<div class="yesorder_i"> Заказ доставлен</div>';
                                    break;
                                case 'noorders':
                                    echo  '<div class="yesorder_n"> Заказ отменён</div>';
                                    break;
                            } ?>
                            <div> Кoд заказа: <b><? echo $codeitems ?></b></div>
                        </div>
                    </div>
            <? }
            } //<!--   <div class="elements not_faf_r"> -->
            ?>
        </div>
    </div>
</div>