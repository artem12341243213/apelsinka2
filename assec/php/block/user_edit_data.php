<div class="edit_user_box">
    <div class="heders">
        <div class="h2 text-g">
            <h2>Редактирование данных</h2>
        </div>
    </div>
    <div class="body_user">
        <p id="opis">Если данных для некоторых полей нет, поставте "-"</p>
        <div class="input_body_user">
            <div class="last_name">
                <p>Фамилия</p>
                <div class="chek"><input type="text" placeholder="Фамилия*" id="last_name"><span id="last_name_s"></span></div>
            </div>
            <div class="name">
                <p>Имя</p>
                <div class="chek"><input type="text" placeholder="Имя*" id="name"><span id="name_s"></span></div>
            </div>
            <div class="first_name">
                <p>Отчество</p>
                <div class="chek"><input type="text" placeholder="Отчество" id="first_name"><span id="first_name_s"></span></div>
            </div>

            <div class="phone">
                <p>Телефон</p>
                <div class="chek"><input type="text" placeholder="Телефон*" id="phone"><span id="phone_s"></span></div>
            </div>

            <div class="obl">
                <p>Область</p>
                <div class="chek"><input type="text" placeholder="Область*" id="obl"><span id="obl_s"></span></div>
            </div>

            <div class="sity">
                <p>Город</p>
                <div class="chek"><input type="text" placeholder="Город*" id="sity"><span id="sity_s"></span></div>
            </div>

            <div class="starsse">
                <p>Улица</p>
                <div class="chek"><input type="text" placeholder="Улица*" id="starsse"><span id="starsse_s"></span></div>
            </div>

            <div class="home">
                <p>Дом</p>
                <div class="chek"><input type="text" placeholder="Дом*" id="home"><span id="home_s"></span></div>
            </div>

            <div class="homeV">
                <p>Квартира</p>
                <div class="chek"><input type="text" placeholder="Квартира" id="homeV"><span id="home_s_s"></span></div>
            </div>

            <div class="Address_ZipPostalCode">
                <p>Индекс</p>
                <div class="chek"><input type="text" placeholder="Индекс" id="Address_ZipPostalCode"> <span id="index_s"></span></div>
            </div>
        </div>
        <div class="button_body_user">
            <button onclick="profil_chek_save()">Сохранить</button>
            <button onclick="locations('profil')">Отмена</button>
        </div>
    </div>
</div>
<!-- /*document.getElementById('include_box').innerHTML='';
document.getElementById('include_box').style.display='none'; */ -->