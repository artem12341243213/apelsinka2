<?
$article_product;
$l = explode("|", $size_product);
if (count($l) > 1)
    $size_product = $l[0] . " — " . $l[count($l) - 1];
else $size_product = $l[0];
$count_product;
$catecorian_product;
$pod_catecorian_product;
$sostav_product;
$textile_product;


$tkan = json_decode($GLOBALS['sorters'], true)[0];


$disables_product;
$price_opt_product;
$price_roz_product;
?>
<div class="__element">
    <span title="Добавить в избранное" onclick="addFavoritesUser(<? echo $article_product; ?>)"></span>
    <div class="element_containers" onclick="locations('product&article=<? echo $article_product; ?>')">
        <div class="element__img">
            <img src="assec/images/product/<? echo $img ?> " alt="">
        </div>

        <div class="bode__element">

            <h3> <a href="product&article=<? echo $article_product; ?>"><? echo str_replace("PL", "+", $titles_product) ?> </a></h3>

            <p>Артикуль: <? echo $article_product ?> </p>
            <p>Ткань: <? for ($i = 0; $i < count($tkan); $i++) {
                            if ($textile_product == $i) {
                                echo $tkan[$i];
                            }
                        } ?></p>
            <p>Размер: <? echo $size_product  ?></p>
            <? if ($type == 'opt') { ?>
                <p>В упаковке: <? echo $count_product; ?> шт. — 1 размер</p>
            <? } ?>

        </div>

    </div>
    <p class="href">
        <span>
            <a href='product&article=<? echo $article_product; ?>' title='Переход на страницу товара'>Перейти к товару</a> </span>
    </p>
</div>