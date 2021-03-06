<? hedeer("Регистраия") ?>
<?


$lands = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `land` ORDER BY `title` ASC"));

?>
<div class="registers_content_box">
    <div class="global">
        <div class="h1 text-g">
            <h1>Регистрация</h1>
        </div>
        <div class="registers_content_content">
            <div class="registre_content_verch">
                <div class="register_obz_pole">
                    <fieldset class="register_obz_polefieldset">
                        <legend>Обязаельные поля</legend>
                        <span id="email1" class="error_podpis">Проверте правильность ввода данных</span>
                        <input type="email" placeholder="E-mail" id="email" onclick="not_red('email')" oninput="validateEmail()" value="" patern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required>
                        <span id="passNone1" class="error_podpis">Пароль должен быть от 6 до 10 символов</span>
                        <input type="text" placeholder="Пароль" id="password" title="Пароль должен быть от 6 до 20 символов и состоять из цифр" onclick="not_red('password')" oninput="passchek()" value="" required pattern="[\x1F-\xBF]{6,9}">
                        <span id="passNone" class="error_podpis">Пароли не совпадают</span>
                        <input type="text" placeholder="Повторите пароль" id="password_dubl" onclick="not_red('password_dubl')" oninput="passchek()" value="" required pattern="[\x1F-\xBF]{6,9}">
                    </fieldset>
                </div>
                <div class="register_neob_pole">
                    <fieldset class="register_neob_polefieldset">
                        <legend>Поля которые вы можете заполнить позже</legend>
                        <input type="text" placeholder="Фамилия" id="last_name" onclick="not_red('last_name')" value="" pattern="[А-Яа-я]{0,25}">
                        <input type="text" placeholder="Имя" id="name" onclick="not_red('name')" value="" pattern="[А-Яа-я]{0,25}">
                        <input type="text" placeholder="Отчество" id="first_name" onclick="not_red('first_name')" value="" pattern="[А-Яа-я]{0,25}">
                        <input type="text" placeholder="+7 ___ ___ __ __" id="Phone" onclick="not_red('Phone')" value="" pattern="\+7 | \8\s?[ ]{0,1}9[0-9]{2}[ ]{0,1}\s?\d{3}[ ]{0,1}\d{2}[ ]{0,1}\d{2}">

                        <select name="obl" id="obl" onclick="not_red('obl')">
                            <option value="s"> Выберите край/область</option>
                            <?
                            include "assec/php/block/obl.php";
                            foreach ($obl_list as $key => $item) {
                            ?>
                                <option value="<? echo $key ?>"> <? echo $item ?></option>
                            <? } ?>
                        </select>

                        <input type="text" placeholder="Город" id="sity" onclick="not_red('sity')" value="" pattern="[А-Яа-яA-Za-z]{2,}">
                        <input type="text" placeholder="Улица" id="strasse" onclick="not_red('strasse')" value="">
                        <div class="mex_tions_w">
                            <input type="text" placeholder="Дом" id="home" onclick="not_red('home')" value="">
                            <input type="text" placeholder="Кватира" id="home_s" onclick="not_red('home_s')" value="" pattern="[0-9]{0,5}">
                        </div>
                        <input type="text" placeholder="Индекс" id="Address_ZipPostalCode" onclick="not_red('index')" value="" pattern="[0-9]{6}">
                    </fieldset>
                </div>
            </div>
            <div class="register_soglas_pole">
                <fieldset class="register_soglas_pole_fieldset">
                    <input type="checkbox" id="pod1">
                    <label for="pod1" class="register_soglas_pole_fieldset_pod" id="pod1_label" onclick="not_red('pod1_label')">
                        Подтверждаю, что ознакомился(лась) и принимаю <a href="politconf"> Политику конфиденциальности</a>, а также 
                        <a href="polzowSogls"> Пользовательское соглашения</a> и даю согласие на обработку мои персональный данных.
                        <span class="ob_posl" title="Обязательный элемент">*</span> </label>
                </fieldset>
            </div>

        </div>
        <div class="button_register_box">
            <div class="button_register_box_button rx">
                <button onclick="reg_infos()">Регистрация</button>
            </div>
            <div class="button_register_box_button vx">
                <a href="authorization">
                    У меня есть аккаунт.
                </a>
            </div>
        </div>



    </div>
</div>

<? footer() ?>