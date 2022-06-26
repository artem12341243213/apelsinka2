<?

$css = ['admin'];
hedeer("Админ панель", $css);

function buckInput()
{
    if (isset($_GET['backPages'])) { ?>
        <button class="ad_elements_item" onclick="buttons('<? echo code($_GET['backPages']) ?>')">Назад</button>
    <? } ?>
    <button class="ad_elements_item" onclick="buttons('back')">На главную</button>
<? }
?>
<div class="panelsRim">
    <div class="global">
        <div class="h1 text-g">
            <h1>Админ Панель</h1>
        </div>
        <div class="ad_elements_list">
            <? if (isset($_GET['adminPages'])) $pageAdmin = code($_GET['adminPages']);
            else $pageAdmin = "";

            switch ($pageAdmin) {

                case 'add_nowProduct': //Добавить товар
                    require_once("block/add_nowProduct.php");
                    buckInput();
                    break;
                case "editProduct": //Редактировать товар
                    require_once("block/editProduct.php");
                    buckInput();
                    break;
                case 'addNowPromoCode': //Добавление промокодов
                    require_once("block/addNowPromoCode.php");
                    buckInput();
                    break;
                case 'editPromoCode': //Редактирование промокодов
                    require_once("block/editPromoCode.php");
                    buckInput();
                    break;
                case 'editDataSite': //Изменение данных
                    require_once("block/editDataSite.php");
                    buckInput();
                    break;
                case 'switchUserAccount': //Переключение акаунта пользователя
                    require_once("block/switchUserAccount.php");
                    buckInput();
                    break;
                case 'addNowPrice': //Загрузить прайс лист
                    require_once("block/addNowPrice.php");
                    buckInput();
                    break;
                case 'all_items' || 'sertch': //все товары
                    require_once("block/all_items.php");
                    buckInput();
                    break;
                case 'all_itemsProduct':
                    require_once("block/all_itemsProduct.php");
                    buckInput();
                    break;

                default: {
            ?>
                        <button class="ad_elements_item" onclick="buttons('add_nowProduct')">Добавить товар</button>
                        <button class="ad_elements_item" onclick="buttons('editProduct')">Редактировать товар</button>
                        <button class="ad_elements_item" onclick="buttons('addNowPromoCode')" disabled>Добавление промокодов</button>
                        <button class="ad_elements_item" onclick="buttons('editPromoCode')" disabled>Редактирование промокодов</button>
                        <button class="ad_elements_item" onclick="buttons('switchUserAccount')">Переключение акаунта пользователя</button>
                        <button class="ad_elements_item" onclick="buttons('editDataSite')">Изменение данных</button>
                        <button class="ad_elements_item" onclick="buttons('addNowPrice')">Загрузить прайс лист</button>
                        <button class="ad_elements_item" onclick="locations('home')">Выход</button>
            <?
                        break;
                    }
            }             ?>
        </div>
    </div>
</div>
</div>

<?
footer(['admin_js']);
?>