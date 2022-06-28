<? $favoris_user = "";
if (isset($_SESSION['favorits'])) {
    foreach ($_SESSION['favorits'] as $item) {
        if ($item == $article_product)
            $favoris_user = "add_favor";
    }
} ?>

<div class="spisok__items_block text-g">
    <? if (isset($_SESSION['id'])) { ?>
        <span title="Добавить в избранное" onclick="addFavoritesUser(<? echo $article_product; ?>)" id="ls_<? echo $article_product; ?>" class="<? echo $favoris_user ?>"></span>
    <? } ?>
    <div onclick="locations('product&article=<?php echo $article_product ?>')">
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

                        $tkan = json_decode($sorters, true)[0];
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
    </div>
</div>