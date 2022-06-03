$(document).ready(function () {
    sadfqwdsad()
});


var sll_prise = 0;
var sidions = true;
function sadfqwdsad() {

    if (cart_array.length > 0) {
        $(".cart_none_imtes").addClass("hidden_items");
        $(".cart_body_cart").removeClass("hidden_items");
        tables_ris()
    }
    else {
        $(".cart_none_imtes").removeClass("hidden_items");
        $(".cart_body_cart").addClass("hidden_items");
        $(".footer_cart").addClass("hidden_items")
    }
}
function tables_ris() {
    if (cart_array.length > 0) {
        sll_prise = 0
        cart_array.forEach(item => {

            let skid = item.dels / 100
            let prise = item.price_all = item.prise * (item.count_s * item.count_f);
            let prise2 = prise * skid;
            let pris_s = prise -= prise2;


            var tbody = $(".body_cart_box");

            if ($(tbody).length == 0) {
                $(".cart_none_imtes").removeClass("hidden_items");
                $(".cart_body_cart").addClass("hidden_items");
            }
            let name = item["title"];
            print(name);
            if (name.includes('PL'))
                name = item["title"].replace("PL", "+")

            var itemd = `<div class="cart_items" id="items_n_${item['article']}">`;

            if (item['disables'] == 1) {
                itemd += `<div class="delete_product"><span>Товар недоступен</span></div>`
            }
            itemd += `<div class="items_titles">
                <div class="heders_item_n1"><img src="/assec/images/product/${item['img']}" alt=""></div>
                <div class="heders_item_n2">
                    <div class="titles_header">${name}</div>
                    <div class="article_header">Артикле <span><a href="product&article=${item['article']}">${item['article']}</a></span></div>
                    <div class="remove_header" onclick="remove_cart(${item["article"]},${item["id_cartItems"]})">Удалить</div>
                </div>
            </div>
            <div class="items_size"> <span class="mobil_element">Размер</span> ${item['size']}</div>
            <div class="items_count">
                <span class="mobil_element"> Количество </span>
                <div>
                <button class="button_backet_up" onclick="button_backet_up(${item["article"]},${item["id_cartItems"]})"></button>

                <p> <input type="text" class="item_cart" id="coutns_items_i_${item["article"]}_${item["id_cartItems"]}" onchange="add_count_items(${item["article"]},${item["id_cartItems"]})" value = "${item['count_s']}"> </p>

                <button class="button_backet_down" onclick="button_backet_down(${item["article"]},${item["id_cartItems"]})"></button>
                </div>
            </div>
            <div class="items_prise_orig"><span class="mobil_element"> Цена за 1 шт: </span> ${item['prise']}</div>
            <div class="items_count_orig"><span class="mobil_element"> Колличество в упаковке: </span> ${item['count_f']}</div>
            <div class="items_allPrise"><span class="mobil_element"> Итог: </span>${item['price_all']}</div>
        </div>`
            $(tbody).append(itemd);
            sll_prise += pris_s;
        });
        $("#cart_allPritse").html(sll_prise);

    }


}
sll_prise = 0
// cart_allPritse

//cart_list.innerHTML += cart_items;

//console.log(cart_list);
/* localStorage.setItem('cart', JSON.stringify(cart_array));
show_cart(); */


/* var cart_array =
JSON.parse(localStorage.getItem("cart")) == null
? []
: JSON.parse(localStorage.getItem("cart"));
*/
function bonus_activiti(id) {
    let data = $("#" + id).val()
    $.ajax({
        type: "POST",
        url: "/GLA1",
        data: "bonus_activ_f=1&bonuse=" + data,
        processData: false,
        caches: false,
        success: function (res) {
            let obj = JSON.parse(res)
            if (obj.masive[0] != null) {
                let dels = obj.masive[0].dels;
                dels = Number(dels);
                let nums1 = Number($("#cart_allPritse").html())
                error_mesages('Применена скидка на ' + dels + '%', 1, "Применен промокод")
                cart_array.forEach(item => {
                    item.dels = dels
                })
                let mi = JSON.stringify(cart_array)
                localStorage.setItem('cart', mi);
                $('#cart_body_cart tbody')[0].innerHTML = "";
                show_cart()
                tables_ris()
            }
            else {
                error_mesages('Промкод не существует /Либо истек срок действия', 2, "Ошибка промокода")
            }
        }
    });
}


function dains() {
    locations("cart");
}

function button_backet_up_li(key, id) {
    button_backet_up(key, id)
}

function button_backet_down_li(key, id) {
    button_backet_down(key, id)
}

/* chek_mail_cart
 */
/* yes_chek
non_chek   для спан  */


function valids_mail_page() {

    var email = $("#email").val()
    var span = $("#email")[0].parentNode;
    span = span.childNodes[1];

    var re = /\S+@\S+\.\S+/;
    let mail_length = String(email);
    if (mail_length.length > 0) {
        if (!re.test(email)) {
            span.classList.add('non_chek')
        } else {
            span.classList.add("yes_chek");
            span.classList.remove('non_chek')
            $("#button_mail_p_d").removeAttr("disabled");
            return re.test(email);
        }
    } else {
        span.classList.remove("yes_chek");
        span.classList.remove('non_chek')
    }
}

function code_meil(type = 'osn') {
    var email = $("#email").val()
    var lete = $("#fionns").val();
    if (lete.split(" ")[1] != " ")
        var name = lete.split(" ")[1];
    else var name = " "

    if (lete.split(" ")[2] != " ")
        var last_name = lete.split(" ")[2];
    else var last_name = " "


    if (type == 'osn') {
        var menu = $(".chek_mail_cart")

        $.ajax({
            type: "POST",
            url: "GLA1",
            data: "data_code_pl_chek=" + email + "&names=" + name + "&fio=" + last_name,
            processData: false,
            caches: false,
            success: function (res) {
                let obj = JSON.parse(res)
                error_mesages(obj.titel, Number(obj.tip), obj.headers);
                $(".chek_mail_cart").removeClass("hidden_items")
            }
        });
    }
    else {
        var lete = $("#input_code_le").val();
        $.ajax({
            type: "POST",
            url: "GLA1",
            data: "data_code_pl_chek_cod=" + lete,
            processData: false,
            caches: false,
            success: function (res) {
                if (res == "true") {
                    $("#mail_code_span").removeClass("non_chek")
                    $("#mail_code_span").addClass("yes_chek")
                    setTimeout(() => {
                        $(".chek_mail_cart").addClass("hidden_items");
                    }, 4000)
                }
                else {
                    $("#mail_code_span").addClass("non_chek")
                }
            }
        });
    }
}


function fio_valid() {
    let tel1 = $("input#fionns").val();
    let tel = String(tel1);
    if (tel.length > 3) {
        document.getElementById("fios").classList.remove('non_chek')
        $("#fios").addClass("yes_chek");
    }
    else if (tel.length == 0) {
        document.getElementById("fios").classList.remove("yes_chek");
        document.getElementById("fios").classList.remove('non_chek')
    }
    else {
        document.getElementById("fios").classList.add('non_chek')
    }

}
function phone_valid_s() {
    let tel = $("input#phone_input").val();
    tel = String(tel)
    let res = tel.split("+");
    if (res.length > 1) {
        tel = tel.slice(1)
    }
    tel1 = Number(tel);
    if (tel.length == 11) {
        if (tel1 == tel) {
            $("#phone_span").removeClass('non_chek');
            $("#phone_span").addClass("yes_chek");
        }
    } else {
        $("#phone_span").addClass('non_chek');
    }
}
var listJU_p = '';
function pochta(item) {
    $(".block .text_h2").html("")
    $(".block .text_le").html("")
    $(".block .opisanie").html("")
    $(".block .opisanie_n").html("")
    for (var items in dost) {
        $("#" + items).removeClass("active")
        if (items == item) {
            $("#" + item).addClass("active")
            for (var data in dost[items]) {
                if (dost[items].name != false)
                    $(".block .text_h2").html(dost[items].name)
                if (dost[items].dostavka != false && dost[items].prise != false)
                    $(".block .opisanie").html("<span>" + dost[items].dostavka + " дней </span><span> от " + dost[items].prise + " руб</span>")
                if (dost[items].opisanie != false)
                    $(".block .text_le").html(dost[items].opisanie)
                if (dost[items].raschet != false)
                    $(".block .opisanie_n").html(dost[items].raschet)
            }

        }
    }

}

var dost = {
    "pochta_ru": {
        "opisanie": 'Стоимость и сроки доставки до Вашего города уточняйте у нашего менеджера.',
        "dostavka": "2-4",
        "name": "Почта России",
        "prise": "350",
        "raschet": "*Расчет доставки выполнен до Москвы"
    },

    "pochta_sdek": {
        "opisanie": 'Стоимость и сроки доставки до Вашего города уточняйте у нашего менеджера.',
        "dostavka": "2-4",
        "name": "СДЭК",
        "prise": "350",
        "raschet": "*Расчет доставки выполнен до Москвы"
    },
    "operator": {
        "opisanie": 'Наш менеджер свяжется с Вами, чтобы уточнить детали доставки.',
        "dostavka": false,
        "name": "Узнать у менеджера",
        "prise": false,
        "raschet": false
    }
}