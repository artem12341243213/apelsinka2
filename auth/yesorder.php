<?

if (isset($_SESSION['orders_prise'])) {

    mail_l('orders@apelsinka.tech', 'Заказ', 'ye n', $text, $dop = '', $name = '');
    //mail_l($user_meil, $hea, $h1, $text, $dop = '', $name = '')
    //


    $email = $user_meil; // почта получателя
    $subject = $hea;
    $html = "
      <html><head>
        <meta charset='UTF-8'>
        <title>' . $subject . '</title> 
        </head><body style = 'width: fit-content;
        min-width: 21rem; '>
         <div style='background: #ffb100;
         border-radius: 5px;
         color: #0037ff;
         padding: 0.5rem; '>
              <h1 style = 'text-align: center;
              margin: 0.5rem;'>Апельсинка</h1>
          </div>
          <div style = 'text-align: center;
          margin: 1rem;'>
            <h2>$h1</h2>
              <div>$text</div>
          </div>
        </body> 
      </html>
        ";

    $mail = new mail();
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $html;
    $mail->addAttachment("$dop", "$name"); // приложить файл, если нужно (можешь даже несколько)
    $mail->send();

    //unset($_SESSION['orders_prise']);


    /* Opt: 1
article: 100064
count_f: 1
count_s: 2
dels: 0
disables: "0"
id_cartItems: 0
img: "PHOTO-2022-02-20-12-05-18.jpg"
price_all: 660
prise: 330
size: 56
title: " Комбинезоны с лапкой " */
}

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
