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
            <div class="divTableRow" id="Is_Id_100061">
                <div class="divTableCell imagesMas">
                    <div class="divTableRow wadwadwad pobrlawd">
                        <div class="divTableCell no_line IMg_wafegvrd">
                            <? ?>
                            <img src="assec/images/product/photo_2022-06-16_15-18-42 (2).jpg">
                        </div>
                        <div class="divTableCell no_line wiogsoilwnd PhoneStyle">
                            <div class="img_phone"><img src="assec/images/product/photo_2022-06-16_15-18-42 (2).jpg"></div>
                            <div class="img_phone"><img src="assec/images/product/photo_2022-06-16_15-18-43.jpg"></div>
                        </div>
                    </div>
                </div>
                <div class="divTableCell">
                    <div class="divTableRow">
                        <div class="divTableCell no_line PhoneStyle">
                            <div>Артикль</div>
                        </div>
                        <div class="divTableCell no_line">
                            <div>100061</div>
                        </div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell no_line PhoneStyle">
                            <div>Название</div>
                        </div>
                        <div class="divTableCell no_line">
                            <div>Футболка</div>
                        </div>
                    </div>
                </div>
                <div class="divTableCell">
                    <div class="divTableRow">
                        <div class="divTableCell no_line PhoneStyle">Размер</div>
                        <div class="divTableCell no_line">
                            <div class="size">
                                <p>68</p>
                                <p>74</p>
                                <p>80</p>
                                <p>86</p>
                                <p>92</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divTableCell">
                    <div class="divTableRow">
                        <div class="divTableCell no_line PhoneStyle">Размер</div>
                        <div class="divTableCell no_line">
                            <div class="count">5 Шт</div>
                        </div>
                    </div>
                </div>
                <div class="divTableCell">
                    <div class="divTableRow">
                        <div class="divTableCell no_line PhoneStyle">Категория</div>
                        <div class="divTableCell no_line"></div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell no_line PhoneStyle">Тип</div>
                        <div class="divTableCell no_line">
                            <div class="categor">
                                <p>Категория</p>
                                <p>Футболки</p>
                            </div>
                            <p>Мальчик</p>
                        </div>
                    </div>
                </div>
                <div class="divTableCell">
                    <div class="divTableRow">
                        <div class="divTableCell no_line PhoneStyle">Ткань</div>
                        <div class="divTableCell no_line">
                            <div>
                                <p>Мальчик</p>
                            </div>
                        </div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell no_line PhoneStyle">Состав</div>
                        <div class="divTableCell no_line">
                            <div>
                                <p>Хлопок 100%</p>
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
                                <p>350&nbsp;Роз</p>
                                <p>160&nbsp;Опт</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divTableCell">
                    <div>
                        <p><button onclick="R_E_H('100061', 'hidden')" class="hidden disables_button_td" id="f_s_i_100061">Скрыть товар</button></p>
                        <p><button onclick="locations('product&amp;article=100061')">Перейти</button></p>
                        <p><button onclick="R_E_H('100061', 'edit')" class="edit_button_td">Редактировать</button></p>
                        <p><button onclick="R_E_H('100061', 'remove','5')" class="remove_button_td">Удалить</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="buttons_menu">
    <? if (!$poisk) { ?>
        <button type="button" id="load_items_ad">Загрузить еще</button>

    <? } else { ?>
        <div class="ad_lestions">
            <div class="edit_a_times">
                <input type="text" name="seahc" id="ssertch" placeholder="Название или артикль" autofocus>
                <span id="cleer_ad" onclick=" document.getElementById('ssertch').value = '';" title="Очисть">X</span>
            </div>
        </div>
        <button type="button" onclick="buttons('ssertch')">Найти</button>
    <? } ?>
    <button type="button" onclick="buttons('editProduct')">Назад</button>