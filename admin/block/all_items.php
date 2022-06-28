<div class="element_alls">
    <div class="divTable StaleAdminTable" id="table_all">
        <div class="divTableHeading">
            <div class="divTableRow">
                <div class="divTableHead PcStyle ">Картинка</div>
                <div class="divTableHead PcStyle ">Артикль<br>Название</div>
                <div class="divTableHead PcStyle ">Размеры</div>
                <div class="divTableHead PcStyle ">Штук<br>в<br>упаковке</div>
                <div class="divTableHead PcStyle ">Категория <br>Под Категория <br> Для кого</div>
                <div class="divTableHead PcStyle ">Ткань/Состав</div>
                <div class="divTableHead PcStyle ">Вкладка товара</div>
                <div class="divTableHead PcStyle ">Цена <br>Роз <br>Опт</div>
                <div class="divTableHead PcStyle ">Взаимодействие</div>
            </div>
        </div>

        <?
        $j = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '../../assec/data/categories_sorter.json');
        $sorters_arr  =  json_decode($j, true)[0];

        if (isset($_GET['serich'])) $poisk = true;
        else  $poisk = false;
        $search = code($_GET['serich']);
        if ($search == 'all')
            $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product`"));
        else {
            if (preg_match('/^[0-9]{3,15}$/', $search)) {
                $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE  `articl` LIKE '%$search%'"));
            } else {
                $array = mysqli_fetch_all(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE  `title` LIKE '%$search%'"));
            }
        }

        $miste  = [];
        foreach ($array as $key => $data) {
            if ($data[0] != "-1") {
                array_push($miste, $data);
            }
        }

        ?>
        <div class="divTableBody">
            <? for ($p = 0; $p < count($miste); $p++) {
                $item = $miste[$p];
                $article =  $item[0];
                $title = $item[1];
                $images = explode("|", $item[2]);
                $size = explode("|", $item[3]);
                $count = $item[4];

                $categories = $item[5];
                $pol = $item[13];
                switch ($pol) {
                    case 'girl':
                        $d = "girl";
                        break;
                    case 'boys':
                        $d = "boys";
                        break;
                    case 'kids':
                        $d = "baby";
                        break;
                }

                if ($categories == 1) {
                    foreach ($sorters_arr[$d]['categor'] as $sis) {
                        if ($sis[0] == $item[6])
                            $podcategories = $sis[1];
                    }
                } else {
                    foreach ($sorters_arr[$d]['BiP'] as $sis) {
                        if ($sis[0] == $item[6])
                            $podcategories = $sis[1];
                    }
                }

                $sostav = $item[7];
                $textile = $item[8];
                $disable = $item[9];
                $elements_sorters = $item[10];
                $price_opt = $item[11];
                $price_roz = $item[12];
            ?>
                <div class="divTableRow" id="Is_Id_<? echo $article ?>">
                    <div class="divTableCell imagesMas">
                        <div class="divTableRow wadwadwad pobrlawd">
                            <div class="divTableCell no_line IMg_wafegvrd">
                                <? ?>
                                <img src="assec/images/product/<? echo $images[0] ?>">
                            </div>
                            <div class="divTableCell no_line wiogsoilwnd PhoneStyle">
                                <div class="img_phone">
                                    <?
                                    $array_count_img = count($images);

                                    for ($e = 0; $e < $array_count_img; $e++) { ?>
                                        <img loading="lazy" src="assec/images/product/<? echo $images[$e] ?>">
                                        
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">
                                <div>Артикль</div>
                            </div>
                            <div class="divTableCell no_line">
                                <div><b><? echo  $article ?></b></div>
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">
                                <div>Название</div>
                            </div>
                            <div class="divTableCell no_line">
                                <div><b><? echo  str_replace("PL", "+", $title) ?></b></div>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">Размер</div>
                            <div class="divTableCell no_line">
                                <div class="size">
                                    <?

                                    for ($E = 0; $E < count($size); $E++) { ?>
                                        <p><? echo  $size[$E] ?></p>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">Кол-ва в упаковке</div>
                            <div class="divTableCell no_line">
                                <div class="count"><? echo $count ?> Шт</div>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div class="divTableRow">
                            <div class="divTableCell no_line"></div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">
                                Категория /
                                Под категория/
                                Для кого
                            </div>
                            <div class="divTableCell no_line">
                                <div class="categor">
                                    <p><? if ($categories == 1) echo 'Категория';
                                        else if ($categories == 2) echo 'Белье и пижамы'; ?></p>
                                    <p><? echo $podcategories ?></p>
                                </div>
                                <p><?
                                    switch ($pol) {
                                        case 'girl':
                                            echo "Девочки";
                                            break;
                                        case 'boys':
                                            echo "Мальчики";
                                            break;
                                        case 'kids':
                                            echo "Малыши";
                                            break;
                                    }

                                    ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">Ткань</div>
                            <div class="divTableCell no_line">
                                <div>
                                    <p><?
                                        $midle = json_decode($sorters, false)[0];
                                        foreach ($midle as $key => $item) {
                                            if ($key == $textile) {
                                                echo $item;
                                                break;
                                            }
                                        }
                                        ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">Состав</div>
                            <div class="divTableCell no_line">
                                <div>
                                    <p><? echo $sostav ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">Вкладка</div>
                            <div class="divTableCell no_line">
                                <div>
                                    <p>Мальчики</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div class="divTableRow">
                            <div class="divTableCell no_line PhoneStyle">Цена</div>
                            <div class="divTableCell no_line">
                                <div>
                                    <p><? echo $price_roz ?>&nbsp;Роз</p>
                                    <p><? echo $price_opt ?>&nbsp;Опт</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div>
                            <p><button onclick="R_E_H('<? echo $article ?>', 'hidden')" class="hidden disables_button_td" id="f_s_i_<? echo $article ?>">Скрыть товар</button></p>
                            <p><button onclick="locations('product&amp;article=<? echo $article ?>')">Перейти</button></p>
                            <p><button onclick="R_E_H('<? echo $article ?>', 'edit')" class="edit_button_td">Редактировать</button></p>
                            <p><button onclick="R_E_H('<? echo $article ?>', 'remove','<? echo $podcategories ?>')" class="remove_button_td">Удалить</button></p>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>

</div>

<div class="buttons_menu">
    <? if (!$poisk) { ?>
        <button type="button" id="load_items_ad">Загрузить еще</button>

    <? } else { ?>
        <div class="ad_lestions">
            <div class="edit_a_times">
                <input type="text" name="seahc" id="ssertch" placeholder="Название или артикль">
                <span id="cleer_ad" onclick=" document.getElementById('ssertch').value = '';" title="Очисть">X</span>
            </div>
        </div>
        <button type="button" onclick="buttons('ssertch')">Найти</button>
        <button type="button" onclick="buttons('editProduct')">Назад</button>
    <? } ?>