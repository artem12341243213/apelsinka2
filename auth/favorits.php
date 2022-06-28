<?
if (isset($_SESSION['favorits']) && $_SESSION['favorits'] != null) {

    $text = "SELECT * FROM `favoritesu` WHERE";
    for ($i = 0; $i < count($_SESSION['favorits']); $i++) {
        $text .= " `product` = " . $_SESSION['favorits'][$i];
        if (isset($_SESSION['favorits'][$i + 1]))  $text .= " or ";
    }

    $mase = mysqli_query($CONNECT, $text);

    if ($mase->num_rows > 0) {
        $text = "SELECT * FROM `product` WHERE";
        for ($i = 0; $i < count($_SESSION['favorits']); $i++) {
            $text .= " `articl` = " . $_SESSION['favorits'][$i];
            if (isset($_SESSION['favorits'][$i + 1]))  $text .= " or ";
        }

        if (mysqli_query($CONNECT, $text)) {
            $mase = mysqli_query($CONNECT, $text);
            $f = true;
        } else  $f = false;
    } else {
        unset($_SESSION['favorits']);
        $f = false;
    }
} else
    $f = false;
$tkan = json_decode($sorters, true)[0];


?>
<div class="box_favorits">
    <div class="h2 text-g">
        <h2>Избранное</h2>
    </div>
    <div class="elements not_faf_r">
        <?
        if ($f == true) {
            if (($mase->num_rows) > 0) {

                $data = mysqli_fetch_all($mase);
                for ($j = 0; $j < count($data); $j++) {
                    $item = $data[$j];
        ?>
                    <div class="box_items" id="box_item_id<? echo $item[0] ?>">
                        <?
                        // print_r($item);

                        ?>
                        <div class="img">
                            <? $fi = explode("|", $item[2]);
                            $s = rand(0, count($fi) - 1) ?>
                            <img src="assec/images/product/<? echo $fi[$s] ?>" alt="обложка товара <? echo $item[0] ?>">
                        </div>
                        <div class="text_item">
                            <div class="title"><? echo $item[1] ?></div>
                            <div class="size_item">
                                <? $l = explode("|", $item[3]);
                                if (count($l) > 1)
                                    $size_product = $l[0] . " — " . $l[count($l) - 1];
                                else $size_product = $l[0];
                                echo  $size_product;
                                ?>
                            </div>
                            <div class="textile_item">
                                <? for ($i = 0; $i < count($tkan); $i++) {
                                    if ($item[8] == $i) {
                                        echo $tkan[$i];
                                    }
                                } ?>
                            </div>
                            <div class="sostav_item">
                                <? echo $item[7]; ?>
                            </div>
                            <div class="prise_item">
                                <?
                                if ($type == 'opt')
                                    echo $item[12] . "руб";
                                else if ($type == 'roz')
                                    echo $item[11] . "руб" ?>
                            </div>
                        </div>
                        <div class="button_menu">
                            <button onclick="locations('product&article=<? echo $item[0] ?>')">Перейти к товару</button>
                            <button onclick="addFavoritesUser(<? echo $item[0]; ?>)">Удалить товар</button>
                        </div>
                    </div>
            <?
                }
            }
        } else { ?>

            <div class="box_items not_faf">
                <div class="nons_faforites_box">
                    <p>Сохранненых товаров нет. Для сохранинея товара, нажмите на сердечко в карточке товара.</p>
                </div>
            </div>
        <? } ?>

    </div>
</div>