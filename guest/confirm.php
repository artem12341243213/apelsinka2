<? if (!isset($_SESSION['confirm']['code'])) not_found();
hedeer("Подтверждение действий");
?>


<div class="autorin">
    <div class="global">
        <div class="h1 text-g">
            <h1>Подтверждение действий</h1>
        </div>
        <div class="autorin_contents">
            <div class="autorin_input">
                <form action="#" method="post">
                    <div class="autorin_input_contents">
                        <label for="code">Введите код, который был отправлен вам на почту</label>
                        <p>
                            <input type="text" name="code" style='margin: auto;' id="code" placeholder="Код отправлен Вам на почты" required>
                        </p>
                        <input type="button" class="autorin_input--button" value="Подтвердить" onclick="formes('GLA','confirm','code')">
                </form>
            </div>
        </div>
    </div>
</div>


<? footer() ?>