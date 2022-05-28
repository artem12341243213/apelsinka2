<?

use function PHPSTORM_META\type;

hedeer("Категории");
include_once('assec/php/conectio.php');

if ((isset($_GET['lis']) && $_GET['lis'] != null) && (isset($_GET['gategories']) && $_GET['gategories'] != null)) {
    $date = code($_GET['lis']);
    $categors = code($_GET['gategories']);
    if (is_numeric($date) && $date <= 2 && $date >= 0 && is_numeric($categors)) {
        $sql = "SELECT * FROM `product` WHERE `podcategories` =  $categors and `elements_sorters` = $date";
        $sqlf = "SELECT * FROM `categories` WHERE `id` = $categors";
        $result =  $connect->query("$sqlf");
        $categoriy_store = mysqli_fetch_array($result)['name'];
    } else if (is_numeric($date) && $date <= 2 && $date >= 0 && $categors == 'all') {

        switch ($date) {
            case '0':
                $categoriy_store = "Девочки";
                $element_sorters = 0;
                $s = 'girl';
                break;
            case '1':
                $categoriy_store = "Мальчики";
                $element_sorters = 1;
                $s = 'boys';
                break;
            case '2':
                $categoriy_store = "Малыши";
                $element_sorters = 2;
                $s = 'kids';
                break;
        }

        $sql = " SELECT * FROM `product` WHERE `pol` = '$s'";
        $result =  $connect->query("$sql");
    } else not_found();
} else if (isset($_POST['search']) && $_POST['search'] != null) {
    $date = code($_POST['search']);
    if (!is_numeric($date)) $sql = "SELECT * FROM `$dbname`.`product` where `title` LIKE ('%$date%')";
    else  $sql = "SELECT * FROM `$dbname`.`product` where `articl` LIKE ('%$date%')";
    $categoriy_store = "Поиск  " . $date;
} else if (isset($_GET['all']) && $_GET['all'] != null) {
    $date = code($_GET['all']);
    switch ($date) {
        case 'girl':
            $categoriy_store = "Девочки";
            $element_sorters = 0;
            break;
        case 'bous':
            $categoriy_store = "Мальчики";
            $element_sorters = 1;
            break;
        case 'kids':
            $categoriy_store = "Малыши";
            $element_sorters = 2;
            break;
    }

    $sql = " SELECT * FROM `product` WHERE `pol` = '$date'";
} else {
    if (isset($_GET['items'])) $items_sait = $_GET['items'];
    else $items_sait = 'bous';
    switch ($items_sait) {
        case 'girle':
            $categoriy_store = "Девочки";
            $element_sorters = 0;
            break;
        case 'bous':
            $categoriy_store = "Мальчики";
            $element_sorters = 1;
            break;
        case 'kids':
            $categoriy_store = "Малыши";
            $element_sorters = 2;
            break;
        case 'new':
            $categoriy_store = "Новинки";
            $element_sorters = 3;
            break;
        case 'collection':
            $categoriy_store = "Коллекция";
            $element_sorters = 4;
            break;
        case 'sale':
            $categoriy_store = "Распродажа";
            $element_sorters = 5;
            break;
        default:
            not_found();
    }

    if ($element_sorters == 3) {
        $sql = "SELECT * FROM (SELECT * FROM `product` ORDER BY `articl` DESC LIMIT 10) t ORDER BY `articl`";
    } else
        $sql = "SELECT * FROM `product` where `elements_sorters` = $element_sorters ";
}

$result =  $connect->query("$sql");
if (($result !== false && $result->num_rows > 0)) {

    $disables   = 0;
    if (($result->num_rows) > 1) {
        $product        = mysqli_fetch_all($result);
        $mix_number     = $result->num_rows;
        $mix_nubmer_min = 0;
        foreach ($product as $items) {
            if ($items[9] == true) {
                $mix_nubmer_min++;
            }
        }
        if ($mix_nubmer_min == $mix_number)
            $disables = 1;
        $inint  = 0;
    } else {
        $product    = mysqli_fetch_array($result);
        $inint      = 1;
        if ($product['disable'] == 1)
            $disables = 1;
    }
} else {
    $disables = 1;
}

?>

<div class="box_store_contents">
    <div class="global">
        <div class="h1 text-g">
            <h1>
                <? echo $categoriy_store ?>
            </h1>
        </div>
        <div class="store__contenst-box">
            <div class="filters-box">
                <div class="filters-content">
                    <div class="filters-content_items" id="categories">
                        <p>Категории</p>
                    </div>
                    <div class="filters-content_items">


                        <div class="filters-content_items__elements text-g">

                            <? include_once("assec/php/block/categories.php"); ?>

                            <div class="filters-content_items_button">
                                <button onclick="document.location='store&items=sale'">Распродажа</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="items-spisok-box">
                <? if ($disables != true) { ?>
                    <div class="items_spisoks">
                        <?php

                        if ($inint == true) {
                            $disabled_product = $product[9];

                            if ($disabled_product != 1) {

                                $article_product           = $product[0];
                                $titles_product            = $product[1];
                                $img_product               = $product[2];
                                $size_product              = $product[3];
                                $count_product             = $product[4];
                                $catecorian_product        = $product[5];
                                $pod_catecorian_product    = $product[6];
                                $sostav_product            = $product[7];
                                $textile_product           = $product[8];
                                $price_opt_product         = $product[11];
                                $price_roz_product         = $product[12];

                                include 'assec/php/Items_store.php';
                            }
                        } else {
                            foreach ($product as $items) {
                                $disabled_product = $items[9];

                                if ($disabled_product != 1) {

                                   
                                    $textile_product           = $items[8];
                                    $article_product           = $items[0];
                                    $titles_product            = $items[1];
                                    $img_product               = $items[2];
                                    $size_product              = $items[3];
                                    $count_product             = $items[4];
                                    $catecorian_product        = $items[5];
                                    $pod_catecorian_product    = $items[6];
                                    $sostav_product            = $items[7];
                                    $price_opt_product         = $items[11];
                                    $price_roz_product         = $items[12];

                                    include 'assec/php/Items_store.php';
                                }
                            }
                        } ?>
                    </div>
                <? } else { ?>
                    <div class="element_notfaund_tables">
                        <p class="text_element_notfaund">Выбранный товар недоступен или же не был добавлен на сайт <span class="Mobil_s" onclick="opens('modal_catalog_b')">Каталог</span></p>
                    </div>
                <? } ?>
            </div>

        </div>
    </div>
</div>



<div class="elements_menu_modal_box hidden_items">
    <div class="elements_menu__box">
        <div class="menu_box_top_elements">
            <div class="elements_img_box"><img src="assec/images/noFoto.jpg" alt=""></div>
            <div class="elements_contens_box">
                <p class="elements_content_name">Боди короткий рукав</p>
                <table>
                    <tr>
                        <td>Артикуль</td>
                        <td class="elements_content_artc">873873</td>
                    </tr>
                    <tr>
                        <td>Штук в упаковке</td>
                        <td class="elements_content_count">5 штук</td>
                    </tr>
                    <tr>
                        <td>Ткань</td>
                        <td class="elements_content_textile">ТЕКС</td>
                    </tr>
                    <tr>
                        <td>Состав</td>
                        <td class="elements_content_sostav">ТЕКСТ</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="elements_menu_contents">
            <div class="elements_menu_razmers">
                <div class="elements_opisanie">
                    <div title="Размер товара">Размер <span class="elements_cart_col_razmers_rezmer" title="Выбранный размер">56</span></div>
                    <div title="Количество упаковок данного размера">Кол-во <span class="elements_cart_col_razmers_numbers">2</span></div>
                </div>
                <div class="modal_cart_razmers_buttons ">
                    <button class="aosdfjk" title="Добавить количество">+</button>
                </div>
                <div class="modal_cart_razmers_buttons ">
                    <button class="aojk" title="Уменьшить количество">-</button>
                </div>
                <div class="modal_cart_razmers_buttons ">
                    <button class="oswagtyjk" title="Удалить размер из списка">DELL</button>
                </div>
            </div>

            <p class="razmers_elements_menu_p"> Выберите размеры</p>
            <button class="razmers_elements_menu_button"> Добавить размер</button>

            <div class="elements_add_razmers">
                <div class="elements_add_box">
                    <p>
                        Размер
                    </p>
                    <div id="Selectors_elements_add_box">
                        <select name="" id="add_elements_box">
                            <option value="54" selected>54</option>
                            <option value="62">62</option>
                            <option value="68">68</option>
                        </select>
                    </div>

                    <p>
                        Количество
                    </p>
                    <input type="numbert" value="1" id="add_count_emenets_box">
                    <button class="razmers_elements_menu_button ewhklngv">Добавить</button>
                </div>
            </div>
        </div>

    </div>
    <div class="elements_content_button">
        <button class="elements_content_buttons">Добавить в корзину</button>
    </div>
</div>

<? footer() ?>