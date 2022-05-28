<?

$css = ['admin'];
hedeer("Админ панель", $css);
?>
<div class="panelsRim">
    <div class="global">
        <div class="h1 text-g">
            <h1>Админ Панель</h1>
        </div>
        <div class="ad_elements_list">
            <button class="ad_elements_item" onclick="buttons('now_tow')">Добавить товар</button>
            <button class="ad_elements_item" onclick="buttons('edit_tow')">Редактировать товар</button>
            <button class="ad_elements_item" onclick="buttons('add_promo')" disabled>Добавление промокодов</button>
            <button class="ad_elements_item" onclick="buttons('edit_promo')" disabled>Редактирование промокодов</button>
            <button class="ad_elements_item" onclick="buttons('switch')" disabled>Переключение акаунта пользователя</button>
            <button class="ad_elements_item" onclick="buttons('edit_data')">Изменение данных</button>
            <button class="ad_elements_item" onclick="buttons('now_price')">Загрузить прайс лист</button>
            <button class="ad_elements_item" onclick="formis('GLA_a','adminis')">Выход</button>
        </div>

    </div>
</div>

<?
footer(['admin_js']);
?>