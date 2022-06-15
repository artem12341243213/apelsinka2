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
                <form action="#" method="post">
                    <div class="rewrite_input_contents">
                        <p>
                            <Label for="email"> Введите ваш емаил</Label>
                            <input type="text" placeholder="Емаил" name="email" id="email">
                        </p>
                        <p id="code_email">
                            <Label for="email_code"> Введите код отправленный на почту</Label>
                            <input type="text" placeholder="cod" name="code" id="code" maxlength="6">
                        </p>
                        <p>
                            <label for="code">Введите новый пароль</label>
                            <input type="password" name="password" id="rewritePaswords" placeholder="Новый пароль" required maxlength="25">
                        </p>
                        <div class="button_passwod">
                            <input type="checkbox" class="chekeds_rewrite" name="passworduuu" id="passworduuu" style="display:none;" checked>
                            <label for="passworduuu" onclick="chekeds_revrite_password()">
                                <div class="chekbox_password_box_s"></div>
                                <div class="text_chekbox_passwod_box " id="item_on_hid_pas"> Показать пароль</div>
                                <div class="text_chekbox_passwod_box hidden_items" id="item_off_hid_pas"> Скрыть пароль</div>
                            </label>
                        </div>
                        <input type="button" class="rewrite_input--button" value="Обновить" onclick="rewritePassword()">
                </form>
            </div>
        </div>
    </div>
</div>


<? footer() ?>