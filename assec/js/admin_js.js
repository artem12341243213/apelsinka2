
/* formis('count_lk.textelen.sostaw.prise_opt.prise_roz.title.group.catecogr') */
function buttons(c, l = '') {
    let b = '';
    switch (c) {

        case 'all_itemsProduct':
            b = 'all_itemsProduct'
            break;
        case "editProduct":
            b = "editProduct"
            break;
        case 'add_nowProduct':
            b = "add_nowProduct"
            break;
        case 'addNowPromoCode':
            b = "addNowPromoCode"
            break;
        case 'editPromoCode':
            b = "editPromoCode"
            break;
        case 'switchUserAccount':
            b = "switchUserAccount"
            break;
        case 'editDataSite':
            b = "editDataSite"
            break;
        case 'addNowPrice':
            b = "addNowPrice"
            break;
        case 'all_items':
            b = "all_items";
            break;
        case 'ssertch':
            b = "sertch";
            l = $("#ssertch").val();
            if (l.length == 0) l = 'all'
            break;
    }

    if (l != '')
        adminPages(b, l);
    else
        adminPages(b);
}

function adminPages(tapes, mox = "") {
    let data = '&item=' + tapes;
    if (mox != '' && tapes != 'sertch')
        data += '&backPages=' + mox;
    if (tapes == 'sertch')
        data += '&serich=' + mox;
    $.ajax({
        type: "POST",
        url: "/GLA_a",
        data: 'button_actives_f=1' + data,
        processData: false,
        caches: false,
        success: function (res) {
            locations('adminPanels' + res);
        }
    });
}

function locations(url) {
    window.location.href = "/" + url;
}


var em = 6;
function list_e() {
    buttons('edit_tow_all');
    indjekt('GLA_a', 'timen', '6');
}

function cleer_inputs(id) {
    id = id.split('.');
    imgmas = [];
    remove_img = []
    imgmas_lest = []
    $('#images_box_reder').html('')
    id.forEach(item => {
        var lem = $("#" + item)[0];
        if (lem.localName == 'input') var name = lem.attributes[0].value
        else var name = lem.localName
        if (name == 'select') {
            Array.from($("#" + item)[0].children).forEach(is => {
                is.selected = false;
            })
        }
        else if (name == 'text' || name == "number") {
            lem.value = '';
        }
        else if (name == 'file') {
            lem.value = '';
            lem.viles = '';
        }
    })
}


function indjekt(url, name, doi = '', ot = '',) {

    $.ajax({ type: "POST", url: "/" + url, data: name + '_f=1&do=' + doi + "&ot=" + ot, caches: false }).done(
        function (res) {
            //console.log(res)
            res = JSON.parse(res);
            if (res.deff != undefined) {
                $("#load_items_ad")[0].remove();
            } else {
                $("#load_items_ad")[0].setAttribute("onclick", "indjekt('GLA_a', 'timen','6', '" + em + "')");
            }
            em += 6;

            otrisovka_d(res.array)
        })

}


function formas(data) {
    data = $('#ssertch').val();
    $.ajax({
        type: "POST",
        url: "/GLA_a",
        data: 'edit_items_f=1&sertch=' + data,
        processData: false,
        caches: false,
        success: function (res) {
            let obj = JSON.parse(res);
            ris_lim_i(obj.array, data)
        }
    });
}

function ris_lim_i(array, i) {
    let sertch1 = `
    <div class="element_alls" style="
        margin-bottom: 25px;
    ">
    <h2 class="text-g" style="margin-bottom: 15px;">??????????: ${i}</h2>
    <div class="element_alls">
    <div class="divTable StaleAdminTable" id = "table_all">
        <div class="divTableHeading">
                <div class="divTableRow">
                <div class="divTableHead PcStyle ">????????????????</div>
                <div class="divTableHead PcStyle ">??????????????<br>????????????????</div>
                <div class="divTableHead PcStyle ">??????????????</div>
                <div class="divTableHead PcStyle ">????????<br>??<br>????????????????</div>
                <div class="divTableHead PcStyle ">?????????????????? <br>?????? ?????????????????? <br> ?????? ????????</div>
                <div class="divTableHead PcStyle ">??????????/????????????</div>
                <div class="divTableHead PcStyle ">?????????????? ????????????</div>
                <div class="divTableHead PcStyle ">???????? <br>?????? <br>??????</div>
                <div class="divTableHead PcStyle ">????????????????????????????</div>
            </div>
        </div>
      
        <div class="divTableBody">
    
        </div>
    </div>
</div> 
    <div class="ad_lestions">
        <div class="edit_a_times">
            <input type="text" name="seahc" id="ssertch" placeholder="???????????????? ?????? ??????????????" autofocus>
            <span id="cleer_ad" onclick=" document.getElementById('ssertch').value = '';" title="????????????">X</span>
            <button type="button" onclick="formas('ssertch')">??????????</button>
            <button type="button" onclick="list_e()">?????? ????????????</button>
            <button type="button" onclick="buttons('back')">??????????</button>
        <div>
    </div>`;

    $(".ad_elements_list").html(sertch1);
    otrisovka_d(array);
}


function R_E_H(id, typ, cat_g = '') {
    id = Number(id)
    var data = '';
    switch (typ) {
        case 'hidden':
            data = 'edit_item=' + id;
            aja(data);
            break;
        case 'remove':
            let di = confirm("?????????????? ?????????? ?? ???????????????? " + id)
            if (di) {
                if (cat_g != "")
                    data = 'edit_item=' + id + "&id_t=" + cat_g;
                else data = 'edit_item=' + id;
                aja(data);
            }
            break;
        case 'edit':
            data = 'edit_item=' + id;
            aja(data);
            break;
    }
    /* 'nohiddin' */

    function aja(data) {
        $.ajax({
            type: "POST",
            url: "/GLA_a",
            data: "edit_items_f=1&elems_t=" + typ + "&" + data,
            processData: false,
            caches: false,
            success: function (res) {
                let obj = JSON.parse(res)
                //
                if (obj.edit_i != undefined) {
                    ris('si', obj.edit_i, obj.typ)
                }
                else if (obj.red_i != undefined) {
                    ris('sa', obj.red_i)
                }
                else if (obj.edit_i_r != undefined) {
                    ris('se', obj.edit_i_r)
                }
            }
        });
    }

    function ris(type, id, typs = '') {

        switch (type) {
            case 'si':
                let it = $("#" + id);
                /* console.log($("#" + id)) */
                if (typs == 'on') {

                    it[0].innerHTML = "???????????????? ??????????";
                    it.addClass('nohiddin');
                    it.removeClass('hidden');
                }

                else {
                    it[0].innerHTML = "???????????? ??????????";
                    it.addClass('hidden');
                    it.removeClass('nohiddin');
                }
                break;
            case 'sa':
                obrabotka_product(id);
                break;
            case 'se':
                error_mesages("?????????? ????????????", 1, "????????????????");
                $("#" + id).remove();
                break;
        }
    }
}

function otrisovka_d(data) { //?????????????? ?? ??????????????
    var tbody = $("#table_all .divTableBody")[0];

    for (item of data) {


        var row = document.createElement("div"); //????????????
        row.classList.add("divTableRow")
        row.id = "Is_Id_" + item[0];

        /* ???????????? ?????????????? */
        var td = document.createElement("div") //1?? ?????????????? ????????????????
        td.classList.add("divTableCell");
        td.classList.add("imagesMas");


        let row2 = document.createElement("div"); // ?????????????? ???????????? ??????????????
        row2.classList.add("divTableRow")
        row2.classList.add("wadwadwad")
        row2.classList.add("pobrlawd")

        var td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ????????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("IMg_wafegvrd")

        let imagese = new Image();
        imagese.src = 'assec/images/product/' + item[2].split("|")[0];
        td1.appendChild(imagese);

        var td2 = document.createElement("div");
        td2.classList.add("divTableCell");
        td2.classList.add("no_line");
        td2.classList.add("wiogsoilwnd");
        td2.classList.add("PhoneStyle");

        item[2].split("|").forEach(items => {
            let div = document.createElement("div");
            div.classList.add("img_phone");
            let imagese1 = new Image();
            imagese1.src = 'assec/images/product/' + items;
            div.appendChild(imagese1);
            td2.appendChild(div);
        });
        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);
        row.appendChild(td);



        /* ???????????? ?????????????? */


        td = document.createElement("div")
        td.classList.add("divTableCell");
        row2 = document.createElement("div");
        row2.classList.add("divTableRow")


        /* div1_1.classList.add("titles");
        div1.classList.add("article"); */

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        var div = document.createElement("div");
        div.innerText = "??????????????";
        td1.appendChild(div);


        td2 = document.createElement("div");
        td2.classList.add("divTableCell");
        td2.classList.add("no_line");
        div = document.createElement("div");
        div.innerText = item[0];

        td2.appendChild(div);

        row2.appendChild(td1);
        row2.appendChild(td2);

        td.appendChild(row2);


        row2 = document.createElement("div");
        row2.classList.add("divTableRow")

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        var div = document.createElement("div");
        div.innerText = "????????????????";

        td1.appendChild(div);

        td2 = document.createElement("div");
        td2.classList.add("divTableCell");
        td2.classList.add("no_line");
        div = document.createElement("div");
        div.innerText = item[1];

        td2.appendChild(div);

        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);
        row.appendChild(td);
        /* tdk = document.createElement("div");
        tdk.classList.add("flex_div_d");*/

        /* ???????????? ?????????????? */

        /* ???? ?????????????? {*/
        td = document.createElement("div")
        td.classList.add("divTableCell");
        row2 = document.createElement("div");
        row2.classList.add("divTableRow")
        /* }*/

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        td1.innerHTML = "????????????"


        td2 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td2.classList.add("divTableCell")
        td2.classList.add("no_line")

        div = document.createElement("div");
        div.classList.add("size");
        let mis = item[3].split("|");

        for (let i = 0; i < mis.length; i++) {
            window['p' + i] = document.createElement("p");
            window['p' + i].innerText = mis[i];
            div.appendChild(window['p' + i]);
        }
        td2.appendChild(div)

        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);
        row.appendChild(td);

        /* ?????????????????? ?????????????? */

        /* ???? ?????????????? {*/
        td = document.createElement("div")
        td.classList.add("divTableCell");
        row2 = document.createElement("div");
        row2.classList.add("divTableRow")
        /* }*/

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        td1.innerHTML = "????????????"

        td2 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td2.classList.add("divTableCell")
        td2.classList.add("no_line")

        div = document.createElement("div");
        div.classList.add("count");
        div.innerText = item[4] + " ????";

        td2.appendChild(div);

        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);
        row.appendChild(td);

        /* ?????????? ???????? */

        td = document.createElement("div")
        td.classList.add("divTableCell");
        row2 = document.createElement("div");
        row2.classList.add("divTableRow")

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        td1.innerHTML = "??????????????????"

        td2 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td2.classList.add("divTableCell")
        td2.classList.add("no_line")

        let div_cat = document.createElement('div');
        div_cat.classList.add("categor");

        let p1_s = document.createElement("p"); // ??????????????????
        let m = '';
        if (item[5] == 1) m = '??????????????????';
        else if (item[5] == 2) m = '?????????? ?? ????????????';
        p1_s.innerText = m;

        div_cat.appendChild(p1_s);
        td1.appendChild(div_cat);
        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);

        row2 = document.createElement("div");
        row2.classList.add("divTableRow")

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        td1.innerHTML = "??????"

        td2 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? 
        td2.classList.add("divTableCell")
        td2.classList.add("no_line")


        let p2_s = document.createElement("p"); // ?????? ??????????????????
        let vFfGs = '';
        let ar = Object.values(mass_sorter)
        div_cat.appendChild(p2_s);

        vFfGs = ar[Number(item[6]) - 1];
        p2_s.innerText = vFfGs;
        let p3_s = document.createElement('p');
        if (item[13] == 'boys') m = '??????????????';
        else if (item[13] == 'girl') m = '??????????????';
        else m = '????????????';
        p3_s.innerText = m;

        td2.appendChild(div_cat);
        td2.appendChild(p3_s);

        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);
        row.appendChild(td);

        /* ?????????? ???????? ????????????*/

        td = document.createElement("div")
        td.classList.add("divTableCell");
        row2 = document.createElement("div");
        row2.classList.add("divTableRow")

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        td1.innerHTML = "??????????"

        td2 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td2.classList.add("divTableCell")
        td2.classList.add("no_line")
        div = document.createElement('div');
        let p_2 = document.createElement('p');
        switch (item[8]) {
            case '1': m = '??????????????'; break;
            case '2': m = '??????????'; break;
            case '3': m = '??????????'; break;
            case '4': m = '??????????'; break;
            case '5': m = '??????????'; break;
            case '6': m = '????????????????'; break;
        }
        p_2.innerText = m;

        div.appendChild(p_2);
        td2.appendChild(div);
        row2.appendChild(td1);
        row2.appendChild(td2);

        td.appendChild(row2);

        row2 = document.createElement("div");
        row2.classList.add("divTableRow")

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        td1.innerHTML = "????????????"

        td2 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td2.classList.add("divTableCell")
        td2.classList.add("no_line")
        div = document.createElement('div');

        let p_3 = document.createElement('p');
        p_3.innerText = item[7];
        div.appendChild(p_3)
        td2.appendChild(div)
        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);
        row.appendChild(td);
        /* ???????? ???????????? ?????????? ?????????????? */

        td = document.createElement("div")
        td.classList.add("divTableCell");
        row2 = document.createElement("div");
        row2.classList.add("divTableRow")

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        td1.innerHTML = "??????????????"

        td2 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td2.classList.add("divTableCell")
        td2.classList.add("no_line")
        div = document.createElement('div');

        switch (item[10]) {
            case '0': m = '??????????????'; break;
            case '1': m = '????????????????'; break;
            case '2': m = '????????????'; break;
            case '3': m = '??????????????'; break;
            case '4': m = '??????????????????'; break;
            case '5': m = '????????????????????'; break;
        }



        p2 = document.createElement('p');
        p2.innerText = m
        div.appendChild(p2)
        td2.appendChild(div)
        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);
        row.appendChild(td);


        /* ???????? ????????????  */

        td = document.createElement("div")
        td.classList.add("divTableCell");
        row2 = document.createElement("div");
        row2.classList.add("divTableRow")

        td1 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td1.classList.add("divTableCell")
        td1.classList.add("no_line")
        td1.classList.add("PhoneStyle")
        td1.innerHTML = "????????"

        td2 = document.createElement("div") // ?????????????? ?? ?????????????? ?? ?????????????? ??????????????
        td2.classList.add("divTableCell")
        td2.classList.add("no_line")
        div = document.createElement('div');

        let p_prise_roz = document.createElement('p');
        let p_prise_opt = document.createElement('p');

        p_prise_opt.innerText = item[11] + "????????"
        p_prise_roz.innerText = item[12] + "????????"


        div.appendChild(p_prise_roz)
        div.appendChild(p_prise_opt)
        td2.appendChild(div)
        row2.appendChild(td1);
        row2.appendChild(td2);
        td.appendChild(row2);
        row.appendChild(td);


        /* ???????????? */
        td = document.createElement("div")
        td.classList.add("divTableCell");
        let div_vi = document.createElement('div');
        let p_disable1 = document.createElement('p');
        let p_disable2 = document.createElement('p');
        let p_disable2_2 = document.createElement('p');
        let p_disable3 = document.createElement('p');
        let button_1 = document.createElement('button');

        let article = '' + String(item[0]);

        button_1.setAttribute('onclick', "R_E_H('" + article + "', 'hidden')");

        if (item[9] == 0) {
            button_1.classList.add('hidden')
            button_1.innerText = '???????????? ??????????';
        }
        else {
            button_1.classList.add('nohiddin')
            button_1.innerText = '???????????????? ??????????';
        }
        button_1.classList.add('disables_button_td')

        button_1.id = "f_s_i_" + item[0];

        p_disable1.appendChild(button_1);


        let button_2_3 = document.createElement('button');

        button_2_3.setAttribute('onclick', "locations('product&article=" + item[0] + "')");
        // button_2_3.classList.add('edit_button_td')
        button_2_3.innerText = '??????????????';
        p_disable2.appendChild(button_2_3);


        let button_2 = document.createElement('button');

        button_2.setAttribute('onclick', "R_E_H('" + article + "', 'edit')");
        button_2.classList.add('edit_button_td')
        button_2.innerText = '??????????????????????????';
        p_disable2_2.appendChild(button_2);


        let button_3 = document.createElement('button');

        button_3.setAttribute('onclick', "R_E_H('" + article + "', 'remove','" + item[6] + "')");
        button_3.classList.add('remove_button_td')
        button_3.innerText = '??????????????';
        p_disable3.appendChild(button_3);

        div_vi.appendChild(p_disable1);
        div_vi.appendChild(p_disable2);
        div_vi.appendChild(p_disable2_2);
        div_vi.appendChild(p_disable3);
        td.appendChild(div_vi)

        row.appendChild(td);
        tbody.appendChild(row);

    }
}


const mass_sorter = {
    1: "????????",
    2: "????????",
    3: "??????????",
    4: "????????????",
    5: "????????????????",
    6: "????????????????????",
    7: "????????????????",
    8: "???????????????????? ????????????",
    9: "????????????",
    10: "????????????????",
    11: "??????????????",
    12: "????????????????",
    13: "??????????????????????",
    14: "?????? ????????????????",
    15: "???????????? ?????? ??????????????",
    16: "????????????????",
    17: "????????????",
    18: "?????????? / ????????????????",
    19: "??????????????????",
    20: "??????????????",
    21: "???????????? / ????????????",
    22: "????????????",
    23: "????????????????",
    24: "?????????????????? / ??????????????",
    25: "??????????",
    26: "??????????????????",
    27: "????????????",
    28: "??????????????",
    29: "??????????",
}
var imgmas = [];
var imgmas_lest = [];
var remove_img = [];

function obrabotka_product(id) {  // ?????????????? ???????????????????? ?? ???????????????????????? ????????????
    imgmas = [];
    imgmas_lest = [];
    remove_img = [];
    var block = $(".ad_elements_list");


    var div_block = document.createElement("div");
    div_block.classList.add('ad_now_items_box');

    if (id == null) { // default
        id = {
            articl: "",
            categories: "",
            count: "",
            disable: "",
            elements_sorters: "1",
            images: "",
            podcategories: "",
            pol: "boys",
            price_opt: "",
            price_roz: "",
            size: "",
            sostav: "???????????? 100%",
            textile: "1",
            title: ""
        }
    }
    let p = document.createElement('p');
    p.innerHTML = '??????????????';
    div_block.appendChild(p);

    let input = document.createElement('input')
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'article');
    input.setAttribute('id', 'article');
    input.setAttribute('value', id.articl);
    div_block.appendChild(input);

    input = document.createElement('input')
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'article_prof');
    input.setAttribute('id', 'article_prof');
    input.setAttribute('value', id.articl);
    div_block.appendChild(input);

    input = document.createElement('input')
    input.setAttribute('type', 'hidden');
    input.setAttribute('id', 'monoh');
    if (id.articl == "") {
        input.setAttribute('value', 9);
    }
    else {
        input.setAttribute('value', 15);
    }
    div_block.appendChild(input);

    p = document.createElement('p');
    p.innerHTML = '????????????';
    div_block.appendChild(p);

    let select = document.createElement('select');
    select.setAttribute('name', 'pol');
    select.setAttribute('id', 'group');
    select.setAttribute('onchange', 'groun_lis()');

    let option = document.createElement('option');
    option.setAttribute('value', 'boys');
    if (id.pol == 'boys') option.setAttribute('selected', '');
    option.innerHTML = "??????????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', 'girl');
    if (id.pol == 'girl') option.setAttribute('selected', '');
    option.innerHTML = "??????????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', 'kids');
    if (id.pol == 'kids') option.setAttribute('selected', '');
    option.innerHTML = "????????????";
    select.appendChild(option);

    div_block.appendChild(select);

    /* ??????????????????*/
    p = document.createElement('p');
    p.innerHTML = '??????????????????';
    div_block.appendChild(p);

    select = document.createElement('select');
    select.setAttribute('name', 'catecogr');
    select.setAttribute('id', 'catecogr');

    lot = id.pol;

    var group = document.createElement('optgroup');

    switch (lot) {

        case 'girl':
            group.setAttribute("label", "??????????????");
            $('#page option[value=0]').prop('selected', true);
            sbors(elements_sorter.girl)
            break;
        case 'boys':
            group.setAttribute("label", "????????????????");
            $('#page option[value=1]').prop('selected', true);
            sbors(elements_sorter.boys)
            break;
        case 'kids':
            group.setAttribute("label", "????????????");
            $('#page option[value=2]').prop('selected', true);
            sbors(elements_sorter.baby)
            break;
    }

    function sbors(mas) {
        var group_cat = document.createElement('optgroup');
        group_cat.setAttribute("label", "??????????????????");

        var group_BP = document.createElement('optgroup');
        group_BP.setAttribute("label", "?????????? ?? ????????????");

        mas.categor.forEach((item, i) => {
            window['p' + i] = document.createElement("option");
            window['p' + i].value = "1 -" + item[0];
            if (item[0] == id.podcategories) window['p' + i].setAttribute('selected', '');
            window['p' + i].innerText = item[1];
            group_cat.appendChild(window['p' + i]);
        });

        mas.BiP.forEach((item, i) => {
            window['f' + i] = document.createElement("option");
            window['f' + i].value = "2 -" + item[0];
            if (item[0] == id.podcategories) window['p' + i].setAttribute('selected', '');
            window['f' + i].innerText = item[1];
            group_BP.appendChild(window['f' + i]);
        });
        select.appendChild(group)
        select.appendChild(group_cat)
        select.appendChild(group_BP)
    }
    div_block.appendChild(select);

    p = document.createElement('p');
    p.innerHTML = '????????????????';
    div_block.appendChild(p);

    input = document.createElement('input')
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'title');
    input.setAttribute('id', 'title');
    input.setAttribute('value', id.title);
    div_block.appendChild(input);

    p = document.createElement('p');
    p.innerHTML = '????????????';
    div_block.appendChild(p);

    select = document.createElement('select');
    select.setAttribute('name', 'sostaw');
    select.setAttribute('id', 'sostaw');

    option = document.createElement('option');
    option.setAttribute('value', '???????????? 100%');
    if (id.sostav == '???????????? 100%') option.setAttribute('selected', '');
    option.innerHTML = "???????????? 100%";
    select.appendChild(option);

    div_block.appendChild(select);

    /*??????????*/

    p = document.createElement('p');
    p.innerHTML = '??????????';
    div_block.appendChild(p);

    select = document.createElement('select');
    select.setAttribute('name', 'textelen');
    select.setAttribute('id', 'textelen');

    option = document.createElement('option');
    option.setAttribute('value', '1');
    if (id.textile == '1') option.setAttribute('selected', '');
    option.innerHTML = "??????????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '2');
    if (id.textile == '2') option.setAttribute('selected', '');
    option.innerHTML = "?????????? 3?? ?????????? ??/??";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '3');
    if (id.textile == '3') option.setAttribute('selected', '');
    option.innerHTML = "??????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '4');
    if (id.textile == '4') option.setAttribute('selected', '');
    option.innerHTML = "?????????? 2?? ?????????? ??/??";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '5');
    if (id.textile == '5') option.setAttribute('selected', '');
    option.innerHTML = "??????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '6');
    if (id.textile == '6') option.setAttribute('selected', '');
    option.innerHTML = "??????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '7');
    if (id.textile == '7') option.setAttribute('selected', '');
    option.innerHTML = "???????????????? ??????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '8');
    if (id.textile == '8') option.setAttribute('selected', '');
    option.innerHTML = "????????????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '9');
    if (id.textile == '9') option.setAttribute('selected', '');
    option.innerHTML = "????????????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '10');
    if (id.textile == '10') option.setAttribute('selected', '');
    option.innerHTML = "????????????";
    select.appendChild(option);

    div_block.appendChild(select);

    /*???????????? */
    p = document.createElement('p');
    p.innerHTML = '????????????';
    div_block.appendChild(p);

    select = document.createElement('select');
    select.setAttribute('name', 'size_id');
    select.setAttribute('id', 'size_id');
    select.setAttribute('multiple', '');
    select.setAttribute('size', '6');
    select.classList.add('form_control');
    var mas = id.size.split('|');
    var met = 0;
    group = document.createElement('optgroup');
    group.setAttribute("label", "????????????");
    select.appendChild(group);
    for (let i = 56; i <= 152; i = i + 6) {
        window['f' + met] = document.createElement("option");
        window['f' + met].value = i;
        mas.forEach((item, key) => {
            if (item == i) {
                window['f' + met].setAttribute('selected', '');
                mas.splice(key, 1)
                return;
            }
        });
        window['f' + met].innerText = i;

        select.appendChild(window['f' + met]);
        met++;
    }
    group = document.createElement('optgroup');
    group.setAttribute("label", "??????????????");
    select.appendChild(group);
    var nov = document.createElement("option");
    nov.value = '1.20??90'
    nov.innerText = '1.20??90'
    select.appendChild(nov);

    group = document.createElement('optgroup');
    group.setAttribute("label", "??????????");
    select.appendChild(group);

    for (let i = 1; i < 4; i++) {
        window['f' + met] = document.createElement("option");
        window['f' + met].value = i;
        window['f' + met].innerText = i;
        select.appendChild(window['f' + met]);
        met++;
    }

    group = document.createElement('optgroup');
    group.setAttribute("label", "??????????????");
    select.appendChild(group);

    for (let i = 0; i < 9; i += 3) {
        window['f' + met] = document.createElement("option");
        window['f' + met].value = i + " - " + (i + 3);
        window['f' + met].innerText = i + " - " + (i + 3);

        select.appendChild(window['f' + met]);
        met++;
    }

    var sssssss = document.createElement("option");
    sssssss.value = '9 - 18';
    sssssss.innerText = "9 - 18";
    select.appendChild(sssssss);
    met = 0;
    div_block.appendChild(select);

    /*???????? */
    p = document.createElement('p');
    p.innerHTML = '????????';
    div_block.appendChild(p);


    input = document.createElement('input')
    input.setAttribute('type', 'number');
    input.setAttribute('name', 'prise_roz');
    input.setAttribute('id', 'prise_roz');
    input.setAttribute('placeholder', '???????? ??????????????');
    input.setAttribute('value', id.price_roz);
    div_block.appendChild(input)

    input = document.createElement('input')
    input.setAttribute('type', 'number');
    input.setAttribute('name', 'prise_opt');
    input.setAttribute('id', 'prise_opt');
    input.setAttribute('placeholder', '???????? ??????');
    input.setAttribute('value', id.price_opt);
    div_block.appendChild(input)

    /*?????????????? */
    p = document.createElement('p');
    p.innerHTML = '??????????????';
    div_block.appendChild(p);

    select = document.createElement('select');
    select.setAttribute('name', 'page');
    select.setAttribute('id', 'page');
    let mi = ['??????????????', '????????????????', '????????????', '??????????????', '??????????????????', '????????????????????'];
    for (i = 0; i <= mi.length - 1; i++) {
        window['f' + i] = document.createElement("option");
        window['f' + i].value = i;
        if (id.elements_sorters == i) window['f' + i].setAttribute('selected', '');
        window['f' + i].innerText = mi[i];
        select.appendChild(window['f' + i]);
    }
    div_block.appendChild(select);

    /*???????? ?? ???????????????? */
    p = document.createElement('p');
    p.innerHTML = '???????? ?? ????????????????';
    div_block.appendChild(p);

    select = document.createElement('select');
    select.setAttribute('name', 'count_lk');
    select.setAttribute('id', 'count_lk');

    option = document.createElement('option');
    option.setAttribute('value', '1');
    if (id.count == '1') option.setAttribute('selected', '');
    option.innerHTML = "1";
    select.appendChild(option);
    div_block.appendChild(select);

    option = document.createElement('option');
    option.setAttribute('value', '2');
    if (id.count == '2') option.setAttribute('selected', '');
    option.innerHTML = "2";
    select.appendChild(option);
    div_block.appendChild(select);


    option = document.createElement('option');
    option.setAttribute('value', '3');
    if (id.count == '3') option.setAttribute('selected', '');
    option.innerHTML = "3";
    select.appendChild(option);
    div_block.appendChild(select);

    option = document.createElement('option');
    option.setAttribute('value', '5');
    if (id.count == '5') option.setAttribute('selected', '');
    option.innerHTML = "5";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '10');
    if (id.count == '10') option.setAttribute('selected', '');
    option.innerHTML = "10";
    select.appendChild(option);
    div_block.appendChild(select);

    /*???????????? */
    p = document.createElement('p');
    p.innerHTML = '???????????????????? ?????????? ??????????';
    div_block.appendChild(p);

    select = document.createElement('select');
    select.setAttribute('name', 'disables');
    select.setAttribute('id', 'disables');

    option = document.createElement('option');
    option.setAttribute('value', '0');
    if (id.disable == '0') option.setAttribute('selected', '');
    option.innerHTML = "????";
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value', '1');
    if (id.disable == '1') option.setAttribute('selected', '');
    option.innerHTML = "??????";
    select.appendChild(option);
    div_block.appendChild(select);

    /*???????????????? */
    p = document.createElement('p');
    p.innerHTML = '????????????????';
    let did_box = document.createElement('div');
    did_box.classList.add('img_box');

    did_box.appendChild(p);

    p = document.createElement('div');
    p.innerHTML = `<p><span id="micutochi"></span>??- ?????????????????? ???? ??????????????</p>
    <p><span id="fixi"></span>??- ??????????????</p>`;

    did_box.appendChild(p);

    input = document.createElement('input');
    input.setAttribute("type", 'file');
    input.setAttribute("name", 'file');
    input.setAttribute("id", 'img');
    input.setAttribute("accept", 'image/x-png,image/jpeg');
    input.setAttribute("multiple", '');
    input.setAttribute("onchange", 'img_ed("d")');
    input.setAttribute("class", 'hidden_item');

    did_box.appendChild(input);

    div_d = document.createElement('div');
    div_d.setAttribute("id", "images_box_reder")

    if (id.articl != "") {
        imgmas_lest = id.images.split("|");

        for (let i = 0; i < imgmas_lest.length; i++) {
            let mist = document.createElement('div');
            mist.classList.add('images_files' + i);
            let imagese = new Image();

            let span = document.createElement('span');
            span.setAttribute('id', "micutochi");
            mist.appendChild(span);

            imagese.src = "assec/images/product/" + imgmas_lest[i];
            imagese.setAttribute('id', 'file' + i);
            mist.appendChild(imagese);

            span = document.createElement('span');
            span.setAttribute('onclick', `delete_imd('images_delet_files${i}','lest2')`);
            span.setAttribute('id', "fixi");
            mist.appendChild(span);
            div_d.appendChild(mist);
        }
    }

    did_box.appendChild(div_d);


    var label = document.createElement('label');
    label.setAttribute("for", 'img');
    label.setAttribute("class", 'img_cle');
    did_box.appendChild(label);

    div_block.appendChild(did_box);

    button = document.createElement('button');
    button.setAttribute("onclick", `files()`);
    button.setAttribute("id", 'liss')
    if (id.articl != "") {
        button.innerHTML = "??????????????????"
    }
    else {
        button.innerHTML = "????????????????"
    }
    div_block.appendChild(button);


    button = document.createElement('button');
    button.setAttribute("onclick", `cleer_inputs('count_lk.textelen.page.disables.sostaw.prise_opt.size_id.prise_roz.title.group.catecogr.img');`);
    button.setAttribute("type", 'button')
    button.innerHTML = "????????????????"
    div_block.appendChild(button);


    button = document.createElement('button');
    button.setAttribute("onclick", `buttons('back')`);

    button.setAttribute("type", 'button')
    button.innerHTML = "??????????"
    div_block.appendChild(button);

    block[0].innerHTML = '';
    block[0].appendChild(div_block);


}

function groun_lis() {

    var de = $("#group").val();
    var les = elements_sorter;
    var str = `<select name="catecogr" id="catecogr"> `;
    switch (de) {
        case "boys": les = les.boys;
            str += ` <optgroup label="??????????????????"> ????????????????</optgroup> `
            $('select#page option[value=1]').prop('selected', true);
            break;
        case "girl": les = les.girl;
            str += ` <optgroup label="??????????????????"> ??????????????</optgroup>`
            $('select#page option[value=0]').prop('selected', true);
            break;
        case "kids": les = les.baby;
            str += ` <optgroup label="??????????????????"> ????????????</optgroup>`
            $('select#page option[value=2]').prop('selected', true);
            break;
    }


    /*  <option option value = "1" selected > ??????????????????</option>
     <option value="2">?????????? ?? ????????????</option> */
    /* <option selected > ??????????????????</option> */

    for (mas in les) {
        if (mas == "categor") {
            str += ` <optgroup label="??????????????????">`
            les.categor.forEach((item, key) => {

                str += `<option value="1-${item[0]}">${item[1]}</option>`
            })
            str += `</optgroup>`
        }

        if (mas == "BiP") {
            str += ` <optgroup label="?????????? ?? ????????????">`
            les.BiP.forEach((item, key) => {
                str += `<option value="2-${item[0]}">${item[1]}</option>`
            })
            str += `</optgroup>`
        }
    }
    str += `</select>`

    $("#catecogr").html(str)
}




function img_ed(fire = 't') {

    var input = $("#img")[0];

    if (input != "" && imgmas.length == 0) {
        var files = input.files || input.currentTarget.files;
    }
    else if (input == "" && imgmas.length != 0) {
        var files2 = input.files || input.currentTarget.files;
        imgmas.push(files2)
        var files = imgmas;
        imgmas = [];
    }
    else if (input != "" && imgmas.length != 0) {
        var filese = input.files || input.currentTarget.files;
        for (var i = 0; i < filese.length; i++) {
            imgmas.push(filese[i])
        }
        var files = imgmas
        imgmas = [];
    }


    for (var i = 0; i < files.length; i++) {
        imgmas.push(files[i])
    }


    readr(imgmas)
}



function readr(files) {
    var images = document.getElementById('images_box_reder');
    images.innerHTML = "";
    var name;
    var reader = [];

    for (var i in files) {
        if (files.hasOwnProperty(i)) {
            name = 'file' + i;
            reader[i] = new FileReader();
            reader[i].readAsDataURL(files[i]);
            images.innerHTML += `<div id="images_${name}">
            <img id="${name}" src="" /> <span id ="fixi" onclick="delete_imd('images_delet_${name}','lest1')"></span> </div>`;
            (function (name) {
                reader[i].onload = function (e) {
                    document.getElementById(name).src = e.target.result;
                };
            })(name);
        }
    }

    if (imgmas_lest.length != 0) {
        for (var i = 0; i < imgmas_lest.length; i++) {
            var data = imgmas_lest[i]
            var name = `files${i}`
            images.innerHTML += `<div id="images_${name}"> <span id="micutochi"></span>
        <img id="" src="assec/images/product/${data}" /> <span id ="fixi" onclick="delete_imd('images_delet_${name}','lest2')"></span> </div>`;

        }
    }

}

function delete_imd(idl, don) {
    if (don == 'lest1') {
        var id = idl.split("images_delet_file")[1]
        imgmas.splice(id, 1)
        readr(imgmas)
    }
    else if (don == 'lest2') {
        var id = idl.split("images_delet_files")[1]
        remove_img.push(imgmas_lest[id])
        $(".images_files" + id).remove()
        imgmas_lest.splice(id, 1)
    }
}

function fil() {

    var files = $("input#files")[0].files;
    if (files == null) return
    var fd = new FormData;
    fd.append('exel', files[0]);
    fd.append('prise_reload', "1");
    $.ajax({
        type: "POST",
        url: "GLA_a",
        data: fd,
        processData: false,
        contentType: false,
        success: function (response) {
            var obj = JSON.parse(response)
            error_mesages(obj.titel, Number(obj.tip), obj.headers);
            $("#files_prise").attr('href', "assec/data/prise." + obj.type)
        }
    });
}
function files() {

    if (imgmas == null) var files = $("#files")[0].files;
    var files = imgmas
    var fd = new FormData;
    for (var i = 0; i < files.length; i++) {
        fd.append('img' + i, files[i]);
    }
    var title = $('#title').val();
    title.replace("+", "PL");



    mas_iputs = [
        ["article", $('#article').val()],
        ["article_prof", $('#article_prof').val()],
        ["pol", $('#group').val()],
        ["categor", $('#catecogr').val()],
        ["name", title],
        ["sostaw", $('#sostaw').val()],
        ["tkan", $('#textelen').val()],
        ["size", $('#size_id').val()],
        ["roz", $('#prise_roz').val()],
        ["opt", $('#prise_opt').val()],
        ["page", $('#page').val()],
        ["count", $('#count_lk').val()],
        ["disable", $('#disables').val()]
    ];

    if (remove_img.length > 0) {
        remove_img = remove_img.join('|');
        mas_iputs.push(["remove_img", remove_img])
    }
    if (imgmas_lest.length > 0) {
        imgmas_lest = imgmas_lest.join('|');
        mas_iputs.push(["saves_img", imgmas_lest])
    }

    mas_iputs.forEach((data) => {
        fd.append(data[0], data[1] == '' ? "0" : data[1]);
    })



    if ($('#monoh').val() == 9) {
        fd.append('add_items_now', "1");
    }
    else {
        fd.append('edit_items', "1");
    }

    $.ajax({
        type: "POST",
        url: "GLA_a",
        data: fd,
        processData: false,
        contentType: false,
        success: function (response) {
            var obj = JSON.parse(response)

            error_mesages(obj.titel, Number(obj.tip), obj.headers);
            if (Number(obj.tip) != 2 || Number(obj.tip) != undefined) {
                cleer_inputs('count_lk.textelen.page.article.disables.sostaw.prise_opt.size_id.prise_roz.title.group.catecogr.img')
            }
        }
    });
}


function edit_datas() {
    $.ajax({
        type: "POST",
        url: "GLA_a",
        data: "write_json_auth=1",
        caches: false,
        success: function (response) {
            $(".ad_elements_list").html(response)
        }
    });
}

function reader_data_li(id) {
    let mix = id.split(".");

    let data = "edit_json_auth=1";

    for (i in mix) {
        let date = mix[i]
        data += "&" + date + "=" + $("input#" + date).val().replace('+', 'pl')
    }
    $.ajax({
        type: "POST",
        url: "GLA_a",
        data: data,
        caches: false,
        success: function (response) {
            var obj = JSON.parse(response)
            error_mesages(obj.titel, Number(obj.tip), obj.headers);
            setTimeout(() => { location.reload() }, 600)
        }
    });
}


$(document).ready(function () {
    if ($(".switchUser")) {
        sorters_users_accoutn()
    }
});

function sorters_users_accoutn() {
    let spis = $("#spisok_items_em");
    let arrayUser = $(".user_box_switch");
    for (i = 0; i < arrayUser.length; i++) {
        let m = arrayUser[i];
        spis.append('<option value = "' + m.dataset.ids + '">' + m.dataset.ems + '</option>');
    }
}

function sorter_user_acunt() {
    let list = $('.switchUser__items_box');
    let itemsArray = $(".user_box_switch");
    let input = $("#inputUserCount").val();
    console.log(input)

    if (input != "")
        for (i = 0; i < itemsArray.length; i++) {
            let m = itemsArray[i];
            if ((m.dataset.ids.indexOf(input) != -1) || (m.dataset.ems.indexOf(input) != -1))
                $(m).css("display", "flex");
            else
                $(m).css("display", "none");

        }
    else
        for (i = 0; i < itemsArray.length; i++) {
            let m = itemsArray[i];
            $(m).css("display", "flex");
        }


}
function U_E_A(i, t) {
    let m = '&id=' + i;
    m += '&type=' + t;
    let box = "#identif_user_" + i + "_numbers";
    let button = $("#f_s_i_" + i);
    let button_r = $("#f_s_r_" + i);
    let class_box = $(box + " .itex_box_elements_data p");
    let name_box = $(box + ".itex_box_elements_data p");
    let nameS = $(box)[0].dataset.ems;
    let sus = false;
    if (t == "removeAccount")
        if (confirm("?????????????? ???????????? " + nameS)) {
            if (confirm(" ?????????? ?????????????? ???????????? " + nameS)) {
                sus = true
            }
        }


    $.ajax({
        type: "POST",
        url: "GLA_a",
        data: "switchUser=1" + m,
        caches: false,
        success: function (r) {
            if (r == 'yes') {
                error_mesages('????????????', 1, "??");
                switch (t) {
                    case "roz": {

                        class_box.removeClass("opt_user_bg")
                        class_box.addClass("roz_user_bg")
                        class_box.html("??????????????")
                        button.attr("onclick", "U_E_A(" + i + ", 'opt')")
                        button.html("?????????????????? ???? ??????")
                        break;
                    }
                    case "opt": {
                        class_box.removeClass("roz_user_bg")
                        class_box.addClass("opt_user_bg")
                        class_box.html("??????????????")
                        button.attr("onclick", "U_E_A(" + i + ", 'roz')")
                        button.html("?????????????????? ???? ??????????????")

                        break;
                    }
                    case "removeAccount": {
                        $(box).remove();
                        break;
                    }
                    case "noadmin": {
                        class_box.removeClass("adm_user_bg")
                        class_box.addClass("roz_user_bg")

                        break;
                    }
                }
            }
            else {

            }
        }
    });
}