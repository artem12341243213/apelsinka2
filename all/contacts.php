<? hedeer("Контакты");

?>
<div class="comments_box">
    <div class="global">
        <div class="h1 text-g">
            <h1>Контакты</h1>
            <input type="hidden" value="-1" id="article_product">
        </div>
        <div class="pade_list_box">
            <? $active = 9;
            include "assec/php/block/page_list_box.php" ?>
            <div class="box">
                <div class="box_contact">

                    <div class="contact">
                        <div class="h2">
                            <p>Фабрика детской трекотажной одежды</p>
                        </div>
                        <div>
                            <p>ИП <span>Яваровская К.В.</span> </p>

                            <p>ИНН: <span>612603879525</span> </p>

                            <p>ОГРН: <span>320619600162594</span> </p>
                        </div>
                    </div>
                    <div class="cont_box">
                        <div>
                            <span class="cont_svg" id="mail"></span>
                            <span>
                                <p><a href="mailto:<? print $GLOBALS['kontakts']['mail'] ?>"><? print $GLOBALS['kontakts']['mail'] ?></a></p>
                                <p>Для обращений</p>
                            </span>
                        </div>
                        <div>
                            <span class="cont_svg" id="phone"></span>
                            <span>
                                <p><a href="tel:<? print $GLOBALS['kontakts']['phone_one'] ?>"><? print $GLOBALS['kontakts']['phone_one'] ?></a></p>
                                <p>Карина - менеджер</p>
                            </span>
                        </div>
                        <div>
                            <span class="cont_svg" id="phone"></span>
                            <span>
                                <p><a href="tel:<? print $GLOBALS['kontakts']['phone_two'] ?>"><? print $GLOBALS['kontakts']['phone_two'] ?></a></p>
                                <p>Светлана - менеджер</p>
                            </span>
                        </div>
                        <div>
                            <span class="cont_svg" id="phone"></span>
                            <span>
                                <p><a href="tel:<? print $GLOBALS['kontakts']['phone_three'] ?>"><? print $GLOBALS['kontakts']['phone_three'] ?></a></p>
                                <p>Александр - менеджер</p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="box_map"></div>
            </div>
        </div>
    </div>
</div>
</div>
<? footer() ?>