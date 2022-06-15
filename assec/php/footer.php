<!--  Футер-->
<div class="footer">
    <div class="global">
        <div class="footer-box">
            <div class="footer-box__column">
                <h4>О компании</h4>
                <div class="footer-box__rov"><a href="mi_s"> О нас </a></div>
                <div class="footer-box__rov"><a href="cooperation"> Сотрудничество </a></div>
                <div class="footer-box__rov"><a href="payment"> Оплата </a></div>
                <div class="footer-box__rov"><a href="delivery"> Доставка </a></div>
                <div class="footer-box__rov"><a href="table_r"> Размерная сетка </a></div>
            </div>
            <div class="footer-box__column">
                <h4>Дополнительно</h4>
                <div class="footer-box__rov"><a href="comments"> Отзывы </a></div>
                <div class="footer-box__rov"><a href="heplorder"> Как сделать заказ </a></div>
                <!--  <div class="footer-box__rov"><a href="#"> Сертификаты </a></div> -->
                <div class="footer-box__rov"><a href="returnsorder"> Возврат товара </a></div>
                <!--  <div class="footer-box__rov"><a href="#"> Наши магазины </a></div> -->
                <div class="footer-box__rov"><a href="contacts"> Контакты </a></div>
                <!--    <div class="footer-box__rov"><a href="help"> Помощь </a></div>-->
            </div>
            <div class="footer-box__column">
                <h4>Персональный раздел</h4>
                <div class="footer-box__rov"><a href="profil"> Личный кабинет </a> </div>
                <div class="footer-box__rov"><a href="#"> История заказов </a></div>
                <div class="footer-box__rov"><a href="#"> Избранное</a></div>
                <? if (isset($_SESSION['ADMIN_LOGIN_IN'])) { ?>
                    <div class="footer-box__rov"><a href="adminPanels"> Админ панель</a></div>
                <? } ?>
            </div>
            <div class="footer-box__column">
                <h4>Контакты</h4>
                <div class="footer-box__rov"><span><a href="https://goo.gl/maps/oPRf9rTyckZF6QU67"> г. Азов</a></span> </div>
                <div class="footer-box__rov">
                    <a href="mailto:<? echo $GLOBALS['kontakts']["mail"] ?>"><? echo $GLOBALS['kontakts']["mail"] ?></a>
                </div>
                <div class="footer-box__rov">
                    <a href="tel:<? echo $GLOBALS['kontakts']["phone_one"] ?>"><? echo $GLOBALS['kontakts']["phone_one"] ?></a>
                </div>
                <div class="footer-box__rov">
                    <a href="tel:<? echo $GLOBALS['kontakts']["phone_two"] ?>"><? echo $GLOBALS['kontakts']["phone_two"] ?></a>
                </div>
            </div>
            <div class="footer-box__column">
                <h4>ПОДПИСАТЬСЯ НА Е-MAIL РАССЫЛКУ</h4>
                <div class="footer-box__rov">
                    <div class="footer_inputs">
                        <input type="text" placeholder="Ваш e-mail" id="input_email_send" oninput="email_valid('input_email_send')">
                        <div class="buttonBlock_footers">
                            <button class="Block_footers__button" onclick="send_email()"></button>
                        </div>
                    </div>
                </div>
                <div class="footer-box__rov"><input type="checkbox" name="" id="sogl">
                    <label for="sogl">
                        Я прочитал(а) и принимаю условия <a href="politconf">Политики конфиденциальности</a> и <a href="polzowSogls">Пользовательского соглашения</a>
                    </label>
                </div>

            </div>
        </div>
    </div>
</div>

<?
if (array_key_first($_GET) != "/table_r") {
    require('assec/php/table_raz.php');
}   ?>
<script src="assec/js/jQuery.js"></script>
<script src="assec/js/index.js"></script>
<script defer src="assec/js/all_cart.js"></script>
<?
if ($script != "") {
?>
    <script <? if ($type != "") echo $type ?> src="<? echo $script ?>"></script>
    <?
}

if (!empty($mi)) {
    for ($i = 0; $i < count($mi); $i++) { ?>
        <script src="assec/js/<? echo $mi[$i] ?>.js"></script>
<? }
} ?>
<script defer src="assec/js/SmoothScroll.js"></script>
<script>
    SmoothScroll({
        // Время скролла 400 = 0.4 секунды
        animationTime: 800,
        // Размер шага в пикселях 
        stepSize: 75,

        // Дополнительные настройки:

        // Ускорение 
        accelerationDelta: 30,
        // Максимальное ускорение
        accelerationMax: 2,

        // Поддержка клавиатуры
        keyboardSupport: false,
        // Шаг скролла стрелками на клавиатуре в пикселях
        arrowScroll: 50,

        // Pulse (less tweakable)
        // ratio of "tail" to "acceleration"
        pulseAlgorithm: true,
        pulseScale: 4,
        pulseNormalize: 1,

        // Поддержка тачпада
        touchpadSupport: true,
    })
</script>