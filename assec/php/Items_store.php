<div class="spisok__items_block text-g" onclick="locations('product&article=<?php echo $article_product ?>')">
    <div class="item_img_box"><img src="assec/images/product/<? echo explode("|", $img_product)[0]  ?>" alt=""></div>
    <div class="item_contens_box">
        <p class="item_content_artc"><a href="product&article=<?php echo $article_product ?>">Артикуль <span id="articule"><?php echo $article_product ?></span></a></p>
        <p class="item_content_name"><?php echo str_replace("PL", "+", $titles_product) ?></p>
        <table>
            <? if ($type == 'opt') { ?>
                <tr>
                    <td>В упаковке:</td>
                    <td class="item_content_count"><?php echo $count_product ?> шт. — 1 размep</td>

                </tr>
            <? } ?>
            <tr>
                <td>Ткань</td>
                <td class="elements_content_textile">
                    <?php

                    $tkan = json_decode($GLOBALS['sorters'], true)[0];
                    for ($i = 0; $i < count($tkan); $i++) {
                        if ($textile_product == $i) {
                            echo $tkan[$i];
                        }
                    }

                    ?></td>
            </tr>
            <tr>
                <td>Цена</td>
                <?
                if ($type == "roz") {
                ?>
                    <td class="elements_content_sostav"><?php echo $price_roz_product ?> ₽</td>
                <? } else { ?>
                    <td class="elements_content_sostav"><?php echo $price_opt_product ?> ₽</td>
                <? } ?>
            </tr>

            <tr>
                <td>Размеры</td>
                <td> <?
                        $si = explode("|", $size_product);
                        if (count($si) > 1)
                            print($si[0] . " - " . $si[count($si) - 1]);
                        else
                            print($si[0]);

                        ?></td>
            </tr>
        </table>
        <input type="hidden" name="catecoties_product" value="<? $catecorian_product ?>">
        <input type="hidden" name="size_product" value="<? $size_product ?>">
        <input type="hidden" name="pod_catecoties_product" value="<? $pod_catecorian_product ?>">
    </div>
    <!--     <?php if (isset($_SESSION['prof']) && $_SESSION['prof'] == "opt") { ?>
        <div class="item_content_button">
            <button class="item_content_buttons" data-art="<?php echo $article_product ?>" onclick="open_modal_product()">Добавить</button>
        </div>
    <?php } else { ?>
        <div class="item_content_button">
            <button class="item_content_buttons1" data-art="<?php echo $article_product ?>" onclick="document.location='product&article=<?php echo $article_product ?>'">Посмотреть</button>
        </div>
    <?php } ?> -->
</div>