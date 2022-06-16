<? if (!isset($_SESSION['confirm']['code']) ) not_found(403);
hedeer("Подтверждение действий");
?>

<div class="autorin">
    <div class="global">
        <pre><?print_r($_SESSION)?></pre>
        <div class="h1 text-g">
            <h1>Подтверждение действий</h1>
        </div>
        <div class="autorin_contents">
            <div class="autorin_input">
                <form action="#" method="post">
                    <div class="confirm_input_contents">
                        <label for="code">Введите код, который был отправлен вам на почту</label>
                        <p>
                            <input type="text" name="code"  id="code" placeholder="Код отправлен Вам на почты" required>
                        </p>
                        <input type="button" class="confirm_input--button" value="Подтвердить" onclick="formes('GLA','confirm','code')">
                </form>
            </div>
        </div>
    </div>
</div>


<? footer() ?>