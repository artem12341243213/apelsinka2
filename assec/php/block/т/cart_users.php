<div class='users_cart_box'>
    <div class='cart_headers_items'>
        <span class='cart_headers'>Корзина</span>
        <span class='cart_buttons_cleer'>Очистить</span>
    </div>

    <div class='cart_box_contents' id='cart'>

        <? /* if (decode($_SESSION['type']) == 0) {
            include 'cart_item_roz.php';
        } else if (decode($_SESSION['type']) == 1) {
            include 'cart_item_opt.php';
        } */


        $j = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '../../../data.json'); // в примере все файлы в корне
        $data = json_decode($j,true);
        print_r($data);
        $mi = array('alex' => 15);
        array_push($data, $mi);
        print_r($data);
        ?>

    </div>
    <div class="footer_cart">
        <div class='cart_box_footer_cart_buttons'><button id='buttons_cart'>Купить</button></div>
        <div class='cart_box_footer_cart_price'>Итог <span id="cart_all_price">9999999</span></div>
    </div>

</div>