<?
$article        =   $_GET['article'];

if (!preg_match('/^[0-9]{6,10}$/', $article)) not_found();

$sql            =   "SELECT * FROM `product` where `articl` = $article ";
$product        =   mysqli_query($CONNECT, $sql);
$product        =   mysqli_fetch_assoc($product);

$name_product   =   $product['title'];
hedeer($name_product);



$article_product            =       $product['articl'];
$titles_product             =       $product['title'];
$img_product                =       $product['images'];

$size_product               =       $product['size'];
$count_product              =       $product['count'];
$sostav_product             =       $product['sostav'];

$price_opt_product          =       $product['price_opt'];
$price_roz_product          =       $product['price_roz'];


$miste = json_decode($sorters)[0];
foreach ($miste as $key => $item) {
    if ($key == $product['textile']) {
        $textile_product  = $item;
    }
}

$favorites = mysqli_query(
    $CONNECT,
    "SELECT * FROM `favoritesu` WHERE `id_user` = " . $_SESSION['id'] . " AND `product` = $article"
);
if (($favorites->num_rows) != 0)
    $faf_product =  mysqli_fetch_assoc($favorites);
/*
$disables_product           =       $product['disable'];
$catecorian_product         =       $product['categories'];
$pod_catecorian_product     =       $product['podcategories'];
*/
$arrays_size = explode('|', $size_product);
$arrays_img = explode('|', $img_product);
?>
<div class="bock_product_contents">
    <div class="global">
        <div class="h1_normalDecore text-g">
            <h1 id="titles"> <? echo str_replace("PL", "+", $name_product)    ?> </h1>
        </div>

        <div class="product_box">



            <div class="heade_product_content">

                <div class="product_content_img_product">
                    <img src="assec/images/product/<? echo $arrays_img[0] ?> " alt="" data-img="<? echo $arrays_img[0] ?>">
                </div>

                <div class="product_content_data_product">

                    <div class="elemts_data">
                        <p>?????????????? ????????????</p>
                        <p id="article_product"> <? echo $article_product ?> </p>
                    </div>
                    <? if (($type == 'opt') || (($type == 'admin' || isset($_SESSION['ADMIN_LOGIN_IN'])))) { ?>
                        <div class="elemts_data">
                            <p>???????? ?? ????????????????</p>
                            <p id="count_f_product"> <? echo $count_product ?> </p>
                        </div>
                    <? } ?>
                    <div class="elemts_data">
                        <p>??????????</p>
                        <p><span class="textTip"> <? echo $textile_product ?> <span class="textTip"></td>
                    </div>
                    <div class="elemts_data">
                        <p>????????????</p>
                        <p><span class="textTip"> <? echo $sostav_product ?> </span> </p>
                    </div>
                    </tbody>
                    </table>
                </div>


                <div class="product_content_button_product none_items_mobil">
                    <div class="button_product_price">
                        <? if ($type == 'opt') { ?>
                            <p><span id="product_price"><? echo $price_opt_product ?> </span> ?????? </p>

                        <? } else if ($type == 'roz') { ?>
                            <p><span id="product_price"><? echo $price_roz_product ?> </span> ?????? </p>

                        <? } else if ($type == 'admin' || isset($_SESSION['ADMIN_LOGIN_IN'])) { ?>
                            <p><span id="product_price_1"><? echo $price_roz_product ?> </span> ?????? - ROZ </p>
                            <p><span id="product_price"><? echo $price_opt_product ?> </span> ?????? - OPT</p>
                        <? } ?>
                    </div>

                    <div class="buttons_product_buttons">
                        <?
                        if (isset($faf_product)) { ?>
                            <input type="button" id="button_product_favorites_p" value="??????????????????" onclick="addFavoritesUser(<? echo $article ?>)" class="faforites_a_buttons">
                        <? } else { ?>
                            <input type="button" id="button_product_favorites_p" value="??????????????????" onclick="addFavoritesUser(<? echo $article ?>)" class="">
                        <? } ?>
                        <input type="button" value="???????????????? ?? ??????????????" onclick="add_cart()">

                    </div>
                </div>
            </div>


        </div>
        <div class="product_box">
            <div class="text-g">
                <h3>???????????? ????????????</h3>
                <span class="opisanit_product">
                    ?????????????? ???? ????????????, ?????????? ?????????????? ??????
                </span>
            </div>
            <div class="product_size_box">
                <div class="ul_product_size text-g">
                    <? foreach ($arrays_size as $key => $size) {
                        $min = $key ?>
                        <input type='radio' id='size_i<? echo $min ?>' name="size" class="chek_box_product" value="<? echo $size ?>" onchange="add_cart_elements('size_i<? echo $min ?>')">
                        <label for="size_i<? echo $min ?>" id="size_i<? echo $min ?>" class="li_product_size"> <? echo $size ?></label>
                    <? } ?>
                </div>
            </div>
        </div>


        <div class="product_box">
            <div class="text-g">
                <h3>??????????????????</h3>
                <? if ($type == 'roz') { ?>
                    <span class="opisanit_product">
                        ?????????????? ???? ????????????????, ?????????? ?????????????? ????
                    </span>
                <? } else { ?>
                    <span class="opisanit_product">
                        ?????????????????? ???????????? ?? ????????????????
                    </span>
                <? } ?>
            </div>
            <div class="product_img_box">
                <div class="ul_product_img">
                    <? foreach ($arrays_img as $key => $img) { ?>
                        <div class="li_product_img" id="img_sce_<? echo $key ?>">
                            <!-- style="background:url('assec/images/product/<? echo $img ?>')" -->
                            <div onclick="cheked_img('img_<? echo $key ?>')" id="img_<? echo $key ?>">
                                <img src="assec/images/product/1x1.jpg" data-src="assec/images/product/<? echo $img ?>" data-img="<? echo $img ?>">
                            </div>
                            <button class="mobil_element" onclick="add_cart('<? echo $img ?>')" id="cart_svg">

                            </button>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>

        <div class="product_box mobil_element ">

            <div class="product_content_button_product mt-5">
                <div class="input m-3 fz-4">
                    <span> ???????????????????? ????????????????</span>
                    <input type="text" placeholder="?????????????? ????????????????????" id="count_up" value="1">
                </div>
                <div class="text-g">
                    <h3>??????????</h3>
                </div>
                <div class="button_product_price">
                    <? if ($type == 'opt') { ?>
                        <p><span id="product_price"><? echo $price_opt_product ?> ??
                                <? echo  $count_product ?> &#8212; <? echo $price_opt_product * $count_product ?> </span> ?????? </p>
                    <? } else if ($type == 'roz') { ?>
                        <p><span id="product_price"><? echo $price_roz_product * $count_product ?> </span> ?????? </p>
                    <?
                    } else if ($type == 'admin' || isset($_SESSION['ADMIN_LOGIN_IN'])) { ?>
                        <p><span id="product_price"><? echo $price_opt_product ?> ??
                                <? echo  $count_product ?> &#8212; <? echo $price_opt_product * $count_product ?> </span> ?????? </p>
                    <? } ?>
                </div>
                <div class="buttons_product_buttons">
                    <!-- ?????? ?????????????????? ????????????  -->
                    <input type="button" value="???????????????? ?? ??????????????" onclick="add_cart()">
                    <?
                    if (isset($faf_product)) { ?>
                        <input type="button" id="button_product_favorites_m" value="??????????????????" onclick="addFavoritesUser(<? echo $article ?>)" class="faforites_a_buttons">
                    <? } else { ?>
                        <input type="button" id="button_product_favorites_m" value="??????????????????" onclick="addFavoritesUser(<? echo $article ?>)" class="">
                    <? } ?>
                </div>
            </div>

        </div>

        <div class="product_box" lazy_load>
            <div class="text-g m-2">
                <h2>?????????????????????? ?? ????????????</h2>
            </div>
            <div class="box_coments">
                <div class="conten">
                    <? if (isset($_SESSION['id'])) { ?>
                        <textarea name="" id="com_input_s" placeholder="???????????????? ??????????????????????" oninput="simbuls('com_input_s','numbers_textare')" maxlength="300"></textarea>
                        <span id=numbers_textare>0/300</span>
                    <? } else { ?>
                        <div class="lest">
                            <p>?????????? ???????????????? ??????????????????????, ?????????? ???????? <a href="authorization&lye=product&article=<? echo $article ?>">????????????????????????????</a>.</p>
                        </div>
                    <? } ?>
                </div>
                <input type="button" class="box_coment_button" value="??????????????????" onclick="comments_say('coments_porduct')" <? if (!isset($_SESSION['id'])) echo 'disabled' ?>>
            </div>
            <div class="comments_towar_box" loading="lazy">

                <?
                $comments_block_product = mysqli_fetch_all(mysqli_query(
                    $CONNECT,
                    "SELECT `user`.`type`, `user`.`img` ,`id_comments`,`id_product`,`text`,`name_users`,`user`.`id` 
                    FROM `user`,`comments` WHERE  `comments`.`id_product` = $article and  `user`.`id` = `id_users` GROUP by `comments`.`id_comments`"
                ));

                //print_r($comments_block_product);
                for ($i = 0; $i < count($comments_block_product); $i++) {
                    $data = $comments_block_product[$i];
                    // print_r($data);
                    if ($data[0] == 1) $ope = 'opt';
                    else if ($data[0] == 0) $ope = 'roz';
                    $img = $data[1]; //img
                    $name = $data[5]; // name
                    $text = $data[4];
                    $id = $data[2];
                    $id_user = $data[6];
                    include("assec/php/comments.php");
                }
                ?>


            </div>
        </div>
    </div>

    <? footer(); ?>