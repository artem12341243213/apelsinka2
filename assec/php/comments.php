<div class="coments_items" id="comments_id_<? print_r($id) ?>">
    <div class="item_header">
        <div class="img_headers"><img src="assec/images/users/<? print_r($img) ?>" alt=""></div>
        <div class="name_items">
            <p class="Name"><? print_r($name) ?></p>
            <span class="users_status 
            <? echo $ope ?>  ">
                <? if ($ope == 'roz') $div = 'Розница';
                else $div = 'Оптовик';
                echo $div ?>
            </span>
            <?php if (isset($_SESSION['ADMIN_LOGIN_IN']) || $id_user ==$_SESSION['id']) { ?>
                <div class=" panel_admins">
                    <span class="delet_coment">
                        <p onclick="remove_coments(<? print_r($id) ?>)">Удалить</p>
                    </span>
                </div>

            <? } ?>
        </div>
    </div>
    <div class="item_footer">
        <p><? print_r($text) ?></p>
    </div>
</div>