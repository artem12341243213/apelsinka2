/* Проверка корзины в памяти и установка ее для работы с ней */


let kok = getCookie('cart')

if (!!kok) {
    let si = JSON.parse(kok);
    si = JSON.stringify(si)
    localStorage.setItem('cart', si);
    deleteCookie('cart')
}


if (!!localStorage.getItem("cart")) {
    cart_array = JSON.parse(localStorage.getItem("cart"));
    if (typeof cart_array == "string") {
        cart_array = JSON.parse(cart_array);
    }
}


function show_cart() {
    /* Устанавливаем счетчик товаров в корзине */
    var s = 0;
    var cart = '';

    if (cart_array.length == 0) {
        if (
            !document.getElementsByClassName("body_backet")[0].classList.toggle("none_items")
        ) {
            document.getElementsByClassName("body_backet")[0].classList.add("none_items");
        }

        /* Создание элементa отсутствие товаров в корзине */
        cart = `<div class="noneitems_cart">
        <p> Здесь пока ничего нет</p>
        <p><a href="store&items=bous"> Начни покупать прямо сейчас </a></p>
    </div>`;
    } else {
        /* Наполнение корзины товарами */
        $(".body_backet").removeClass("none_items");

        cart_array.forEach(function (items, article) {

            var pris_s = items["price_all"];
            if (items["dels"] > 0) {
                let skid = items["dels"] / 100
                let prise = items["price_all"] = items["prise"] * (items["count_s"] * items["count_f"]);
                let prise2 = prise * skid;
                pris_s = prise -= prise2;
            }
            if (items["price_all"] == 0) {
                pris_s = items["price_all"] = items["prise"] * (items["count_s"] * items["count_f"]);
            }

            let name = items["title"];
            if (name.split('PL').length > 0)
                name = items["title"].replace("PL", "+")
            /*  dels = dels / 100;
          let nums2 = nums1 * dels;
          let ost = nums1 -= nums2; */
            let elements = `<div class="items_backet" id ="items_cart_n_k_${items["article"]}_${items["id_cartItems"]}">`;
            if (items['disables'] == 1) elements += `<div class="disables_item"> <p> <span> Товар недоступен  </span> <span> 
            <a onclick="remove_cart(${items["article"]},${items["id_cartItems"]})"> Удалить товар </a> </span></p> </div>`
            elements += `
        <div class="items_img_backet">
        <img loading="lazy" src="assec/images/product/${items["img"]}" alt="">
        </div>
            <div class="items_backet_body">
                <div class="items_titles_backet"><a href="product&article=${items["article"]}">${name}
                    <div class="items_artiecle_backet"> Артикул: ${items["article"]}</div></a>
                </div>
                <div class="items_size_backet">Размер: ${items["size"]}</div> 
                <div class="items_counts_backet">
                    <div class="items_counts_button_backet">
                        <div class="buttons_backet">
                        <button class="button_backet_up" data-src="${items["article"]}" 
                        data-lis = "${items["id_cartItems"]}" onclick="button_backet_up(${items["article"]},${items["id_cartItems"]})"></button>
`
            if (items["Opt"] == 1) elements += ` <p id = "counts_button_backet" > ${items["count_s"]} Упк</p>`
            else elements += ` <p id = "counts_button_backet" > ${items["count_s"]} Шт</p>`

            elements += `
                        <button class="button_backet_down" data-src="${items["article"]}" 
                        data-lis = "${items["id_cartItems"]}" onclick="button_backet_down(${items["article"]},${items["id_cartItems"]})"></button>
                        </div>
                        <p>x${items["prise"]} за шт.</p>
                    </div>
                    <div class="count_all_price"> ИТОГО:${pris_s}</div>
                </div>
                <div class="button_mobil_delet_items"><button onclick="remove_cart(${items["article"]},${items["id_cartItems"]})")>Удалить</button></div>
            </div>
        </div>
    `;
            cart += elements;
            s += pris_s;

        });
    }

    $("#header_backet_count").html(cart_array.length);
    $(".header_box-rightPanel_cart.svg span.text-g").html(cart_array.length);
    $("#footer_backet_all_count").html(s);
    $(".body_backet").html(cart);
    $(".body_backet").html(cart);
}

function Get_Numbers(mas, key, id) { // поиск индекса элемента в массиве
    var numbers = 0;
    mas.forEach(function (items, articl) {
        if (items.article == key)
            if (items.id_cartItems == id) { numbers = articl }
    });
    return numbers
}

function button_backet_up(key, id) {
    var numbers = Get_Numbers(cart_array, key, id);
    var s = cart_array[numbers].count_s;
    cart_array[numbers].count_s = s + 1;

    cart_array[numbers].price_all = (cart_array[numbers].count_f * cart_array[numbers].count_s) * cart_array[numbers].prise

    let z = JSON.stringify(cart_array)
    add_carts_ajax(z);

    localStorage.setItem('cart', z);
    show_cart();

    if (typeof sidions !== 'undefined') {
        $('.body_cart_box')[0].innerHTML = "";
        tables_ris()
    }
}

function button_backet_down(key, id) {
    var numbers = Get_Numbers(cart_array, key, id);
    var s = cart_array[numbers].count_s;
    if (s - 1 <= 0) {
        if (confirm("Удалить товар " + key)) {
            cart_array.splice(numbers, 1);
        }
    } else {
        cart_array[numbers].count_s = s - 1;
        cart_array[numbers].price_all = (cart_array[numbers].count_f * cart_array[numbers].count_s) * cart_array[numbers].prise
    }
    let z = JSON.stringify(cart_array)
    localStorage.setItem('cart', z);

    if (typeof sidions !== 'undefined') {
        $('.body_cart_box')[0].innerHTML = "";
        tables_ris()
    }
    show_cart();
    add_carts_ajax(z);
}

function add_count_items(id, numberrs) { //добавление количества товара из поля ввода
    var val = Number($("#coutns_items_i_" + id + "_" + numberrs).val());
    if (val == 0) {
        val = 1;
    }
    var numbers = Get_Numbers(cart_array, id, numberrs);

    if (val <= 0) {
        cart_array.splice(numbers, 1);
    } else {
        cart_array[numbers].count_s = val;
        cart_array[numbers].price_all = (cart_array[numbers].count_f * cart_array[numbers].count_s) * cart_array[numbers].prise
    }

    $('.body_cart_box')[0].innerHTML = "";
    let z = JSON.stringify(cart_array)
    localStorage.setItem('cart', z);
    add_carts_ajax(z);
    tables_ris()
    show_cart();
}

function remove_cart(id, numberrs) { //удаление из корзины
    var nubmers = Get_Numbers(cart_array, id, numberrs);
    if (confirm("Удалить товар " + id)) {
        cart_array.splice(nubmers, 1);
        let z = JSON.stringify(cart_array)
        localStorage.setItem('cart', z);

        add_carts_ajax(z);
        show_cart();
    }
}

function add_cart(type = '') { // сам скрипт добавление в корхину

    if (user_after == false) { // выход если пользователь не авторизован. Авторизация в главном файле
        error_mesages("Для добавление товара в корзину нужно авторизоваться", 2, "Корзина");
        return;
    }

    cart_array; // главный массив с корзиной

    var items = {}; // обект с товаром

    var article = Number($('#article_product').html()); // артикль
    items['article'] = article;

    var titles = String($('#titles').html()).replace("+", "PL"); // название
    items['title'] = titles;



    var amount_user = Number($('#count_up').val());// Штук от пользователя
    items['count_s'] = amount_user;

    var amount = Number($('#count_f_product').html());// Штук в упаковке
    if (!!amount) {
        items['count_f'] = amount;
    }
    else items['count_f'] = amount_user;


    var price = Number($('span#product_price').html()); // цена
    items['prise'] = price;
    items['price_all'] = price * amount_user * items['count_f'];

    var size_array = $('.ul_product_size input'); // массив с размерами
    var img_array = $('.ul_product_img button'); // массив с картинками

    var dels = 0; // скидка
    items['dels'] = dels;

    items['disables'] = 0;

    var size = Array.from(size_array); // размер

    if (size.length > 1)
        size.forEach(input => {
            if (input.checked) {
                size = Number($("#" + input.id).val());
                return;
            }
        });
    else {

        size = $(size[0]).val();
    }
    items['size'] = size;
    if (typeof size == "object") {
        error_mesages("Размер не выбран", 2, "Корзина");
        return;
    }

    var img = Array.from(img_array)
    img.forEach(item => {
        var im = $(item)[0].classList.length;
        if (im > 1) {
            img = $(item)[0].children[0].dataset.img; // поправил
            items['img'] = img;
            return
        }
    });

    if (typeof img == "object") {
        error_mesages("Расцетка не выбрана", 2, "Корзина");
        return;
    }
    if (optovik == 1)
        items['Opt'] = 1;
    else
        items['Opt'] = 0;

    // номер товара в корзине
    // console.log(img)
    //  console.log(size);
    //  console.log(cart_array);
    items['id_cartItems'] = 0
    var numbers = 0;
    var block = true;
    var cart_number = 0; // счечик 2 
    for (let i = 0; i < cart_array.length; i++) {
        let array = cart_array[i];
        if (array.article == article) {
            if (array.img == img && array.size == size) {  // работает
                cart_array[i]["count_s"] += 1;
                cart_array[i]['price_all'] = price * cart_array[i]["count_s"] * amount;
                block = false
            }
            else if (array.img != img || array.size != size) {// работает ураааааааа
                items['id_cartItems'] += 1
                numbers = i + 1;
            }
        }
        else {
            numbers = i + 1;
        }
    }
    //console.log("n = " + numbers + " / cn = " + cart_array.length);
    if (numbers == cart_array.length && block == true) {
        cart_array.push(items);
    }
    let cart = JSON.stringify(cart_array);

    add_carts_ajax(cart);

    localStorage.setItem('cart', cart);
    error_mesages("Товар добавлен в корзину", 0, "Корзина");
    show_cart();
}

function cheked_img(id) {
    var s = $('.ul_product_img button');
    s = Array.from(s)
    s.forEach(item => {
        $(item).removeClass('cheked_img');
        $(item).removeClass('scale_items');
    });
    $("#" + id).addClass('cheked_img')
}

function add_cart_elements(er) {
    var s = $(".ul_product_size")[0].children;
    s = Array.from(s);
    for (i = 0; i <= s.length - 1; i++) {
        if (s[i].localName == "label") $(s[i]).removeClass("active");
    }
    $("label#" + er).addClass("active");
}


/* открытие корзины */
$(document).ready(function () {
    show_cart();

    const box_cart = $(".backet_box")

    $(".header_box-rightPanel_cart.svg").mouseenter(() => {
        $(".backet_box").removeClass("hidden_items");
        lazyScrollCheck()
        setTimeout(() => {
            dom.addEventListener('click', listener, false);
        }, 200)
    })

    var dom = $("body")[0];
    $(".header_box-rightPanel_cart.svg").on("click", () => {
        $(".backet_box").removeClass("hidden_items");
        lazyScrollCheck()
        setTimeout(() => {
            dom.addEventListener('click', listener, false);
        }, 200)
    })

    var listener = function (e) {
        var le = getParent($(".items_backet"), e.target)
        if (!le) {
            $(".backet_box").addClass("hidden_items");

            dom.removeEventListener('click', listener, false);
        }
    }




    function getParent(parent, child) {
        child = $(child)[0]
        parent = parent[0]
        var node = child.parentNode;

        while (node != null) {
            if ($(node)[0].className == "items_backet" || $(node)[0].className == "backet_box") {
                return true;
            }
            node = node.parentNode;
        }
        return false;
    }


});


/*  /*  if (cart_array[i + 1] === undefined) soeoe = false
             if ((array["size"] != size || array["img"] != img) && array.article == article && soeoe == false) {
                 cart_number += 1;
             } 

            // if (array.id_cartItems == cart_number || ((cart_array[i + 1] !== undefined) && (cart_array[i + 1].id_cartItems != 0))) { 
                print(cart_number + ' ← Номер внутри функции')
                if (array["img"] == img) {
                    print(' Картинка прошла')
                    if (array["size"] == size) {
                        print('Размер прошел')
                        cart_array[i].count_s++;
                        cart_array[i].price_all = price * cart_array[i].count_s * amount;
                        break;
                    }
                    else {
                        print(' Размер не прошел')
                        items['id_cartItems'] = cart_number + 1;
                        print(items['id_cartItems'] + " m")
                        cart_array.push(items);
                        break;
                    }
                }
                else {
                    print(' Картинка не прошла')
    
                    items['id_cartItems'] = cart_number + 1;
                    print(items['id_cartItems'] + " m")
                    cart_array.push(items);
                    break;
     */