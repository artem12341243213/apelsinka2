<?
hedeer("Востановление пароля");

?>
<div class="autorin">
    <div class="global">
        <div class="h1 text-g">
            <h1>Восстановление пароля</h1>
        </div>
        <div class="rewrite_contents">
            <div class="autorin_input">
                <form onsubmit="event.preventDefault();">
                    <div class="rewrite_input_contents">
                        <p>
                            <Label for="email"> Введите ваш емаил</Label>
                            <input type="text" placeholder="Емаил" name="email" id="email" oninput="rewritePassword('lest')">
                            <button id="but_codD" onclick="rewritePassword('send_code')">Подтвердить </button>
                        </p>
                        <p id="code_email">
                            <Label for="code_mous"> Введите код отправленный на почту</Label>
                            <input type="text" placeholder="cod" name="code" id="code_mous" maxlength="6" disabled oninput="rewritePassword('pass')">
                        </p>
                        <p>
                            <label for="code">Введите новый пароль</label>
                            <input type="password" name="password" id="rewritePaswords" placeholder="Новый пароль" maxlength="25" disabled oninput="rewritePassword('pasword')">
                        </p>
                        <div class="button_passwod">
                            <input type="checkbox" class="chekeds_rewrite" name="passworduuu" id="passworduuu" style="display:none;" checked>
                            <label for="passworduuu" onclick="chekeds_revrite_password()">
                                <div class="chekbox_password_box_s"></div>
                                <div class="text_chekbox_passwod_box " id="item_on_hid_pas"> Показать пароль</div>
                                <div class="text_chekbox_passwod_box hidden_items" id="item_off_hid_pas"> Скрыть пароль</div>
                            </label>
                        </div>

                        <input type="button" id="buton_ma" class="rewrite_input--button" value="Обновить" onclick="rewritePassword('send')" disabled>
                    </div>
                </form>
                <a href="authorization&lye=home">Я вспомнил(а) пароль</a>
            </div>
        </div>
    </div>
</div>


<? footer() ?>