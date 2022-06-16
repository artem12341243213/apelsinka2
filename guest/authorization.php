<? hedeer("Вход /Регистрация");
$pi = "home";
if (isset($_GET['lye'])) $pi = $_GET['lye'];
if (array_key_exists("article", $_GET)) $pi .= "&article=" . $_GET['article'];
if (array_key_exists("items", $_GET)) $pi .= "&items=" . $_GET['items'];


?>

<div class="autorin">
    <div class="global">
        <div class="h1 text-g">
            <h1>Авторизация</h1>
        </div>
        <div class="autorin_contents">
            <div class="autorin_input">
                <form action="#" method="post">
                    <div class="autorin_input_contents">
                        <label for="email">e-mail</label>
                        <p>
                            <input type="email" id="email" placeholder="Е-mail" oninput="mail_valid('email','elements_error')">
                            <span id="elements_error" class="hidden error">
                                <span class="elements_error_emai">Проверте правильность введенной почты</span>
                            </span>
                        </p>

                        <label for="password">Пароль</label>
                        <p id="p2" class="hiden">

                            <input type="password" id="password" placeholder="Пароль">
                            <span class="pasword_hiddens hiden" id="button_hidens" onclick="show_hide_password('password','button_hidens')"> </span>
                        </p>
                        <input type="checkbox" name="auth_auto" id="auth_auto"> <label for="auth_auto">Запомнить меня</label>
                        <input type="hidden" id="get" value="<? echo $pi ?>">
                    </div>
                    <input type="button" class="autorin_input--button" value="Вход" onclick="formes('GLA','auth','email.password.get.auth_auto')">

                </form>
                <div class="rewrite_password  text-g">
                    <a href="rewritePaswords" class="a_auth">Восстановить пароль</a>
                </div>
            </div>

            <div class="registers">
                <div class="register_box">
                    <p>Впервые у нас?</p>
                    <a href="registers<? echo "&" . $pi ?>">
                        <input type="button" class="register_box--button" value="Регистрация">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<? footer() ?>