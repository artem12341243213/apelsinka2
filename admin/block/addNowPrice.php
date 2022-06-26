<div class="lowion">

    <div>
        <input type="file" id="files">
        <label for='files'>Прайс лист</label>
    </div>
    <? if (file_exists("assec/data/prise.xls")) {
    ?>
        <div>
            <a href="assec/data/prise.xls" id="files_prise">Прайс-Лист</a>
        </div>
    <? } ?>
    <? if (file_exists("assec/data/prise.xlsx")) {
    ?>
        <div>
            <a href="assec/data/prise.xlsx" id="files_prise">Прайс-Лист</a>
        </div>
    <? } ?>
    <button onclick="fil('files')">Обновить</button>

</div>