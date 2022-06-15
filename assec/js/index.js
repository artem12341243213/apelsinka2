function setcookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(name) {
  var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name) {
  setcookie(name, "", 0);
}

function isset(r) {
  return typeof r !== 'undefined';
}

function sorters(id) {
  var request = new XMLHttpRequest();
  request.open('GET', id);
  request.onloadend = function () {
    elements_sorter = JSON.parse(request.responseText)[0];
  }
  request.send();
}



/* -------------------------- Начало блока "Глобальные переменные  #all"  ---------------------------- */

window.cart_array = [];

window.elements_sorter = sorters("assec/data/categories_sorter.json")


/* -------------------------- Конец  блока "Глобальные переменные"  ------------------------------------ */





/* -------------------------- Начало блока "Корзина  #cart"  ---------------------------- */

/* Был перенесен в all_cart.js */

/* -------------------------- Конец  блока "Корзина"  ------------------------------------ */



/* -------------------------- Начало блока "Фиксированное меню #menu"  ---------------------------- */

/* $(function () {
  // высота "шапки", px
  var h_hght = $('.firstScreen').outerHeight();
  // высота блока с меню, px
  var h_nav = $('#top_nav').outerHeight();
  var top;
  $(window).scroll(function () {
    // отступ сверху
    top = $(this).scrollTop();
    if ((h_hght - top) <= h_nav) {
      $('#top_nav').css('top', '0');
    }
    else if (top < h_hght && top > 0) {
      $('#top_nav').css({ 'bottom': top, 'top': '' });
    }
    else if (top < h_nav) {
      $('#top_nav').css({ 'top': '', 'bottom': '0' });
    }
  });
}); */

/* -------------------------- Конец  блока "Фиксированное меню"  ---------------------------- */


/* -------------------------- Начало блока "Комментариев"  ---------------------------- */


function simbuls(id_block, id_span) {
  '', ''
  var id_block = $("#" + id_block).val();
  var id_span = $("#" + id_span);
  id_span.html(id_block.length + "/300")
}
function remove_coments(id) {
  $.ajax({
    type: "POST",
    url: "GLA1",
    data: "com_input_del=" + id,
    caches: false,
    processData: false,
    success: function (resul) {
      obj = jQuery.parseJSON(resul);
      var del_el = $("#comments_id_" + obj.id)
      error_mesages(obj.titel, Number(obj.tip), obj.headers);
      $(del_el).remove();
    },
  })
}
function comments_say(type) {
  var data = $("#com_input_s").val();
  var lost = '';
  if (data == "") { error_mesages("Пустой коммментарий нельзя оставить", 2, "Комментарий"); return }
  var id_product = $("#article_product").html();
  if (id_product == "") id_product = -1
  $.ajax({
    type: "POST",
    url: "GLA1",
    data: "com_input=" + data + "&id_product=" + id_product,
    caches: false,
    processData: false,
    success: function (resul) {
      obj = jQuery.parseJSON(resul);

      $("#com_input_s").val("");

      switch (type) {

        case "coments_si":
          lost = `
        <a href="#" class="comment_contenst">
          <div class="comment-items">
            <div class="header">${obj.name_user}</div>
            <div class="contents">${data}</div>
            <div class="times_coments"> <span>Определяем дату...</span></div>
          </div>
        </a>
          `;

          $(".modal_box_coments").addClass("hidden_items")
          $(".elements_coments_s").append(lost)
          break;

        case "coments_porduct":
          lost = `
          <div class="coments_items">
          <div class="item_header">
              <div class="img_headers"><img src="assec/images/users/${obj.images}?>" alt=""></div>
              <div class="name_items">
                  <p class="Name">${obj.name_user}</p>
                  <span class="users_status ${obj.type_m_name}">
                      ${obj.type_name}
                  </span>
              </div>
          </div>
          <div class="item_footer">
              <p>${data}</p>
          </div>
      </div>
          `;
          $(".comments_towar_box").append(lost)
          break;
      };
      error_mesages(obj.titel, Number(obj.tip), obj.headers);

    },
    error: function (error) {
      console.log(eval(error));
    }

  })
    ;
}
/* -------------------------- Конец  блока "Комментариев"  ---------------------------- */



/* -------------------------- Начало блока "Ajax #ajax"  ---------------------------- */

function formes(url, name, data) {
  var str = "";
  error_mesages("Данные отправлены, ожидаем ответ", 1, " ")
  $.each(data.split("."), function (k, v) {

    str += "&" + v + "=";
    if ($("#" + v)[0].attributes[0].value != 'checkbox')
      m = $("#" + v).val();
    else
      m = $("#" + v)[0].checked;
    str += m;

  });

  $.ajax({
    url: "/" + url,
    type: "POST",
    data: name + "_f=1" + str,

    caches: false,
    success: function (result) {
      obj = jQuery.parseJSON(result);
      if (obj.go)
        setTimeout(() => {
          locations(obj.go);
        }, 500);
      else if (obj.mesg) {
        if (obj.go_i == undefined) error_mesages(obj.titel, Number(obj.tip), obj.headers);
        else {
          privetst(obj.headers + "." + obj.titel + "." + Number(obj.tip), obj.go_i)
        }
      } else if (obj.otvets) {
        privetst(obj.text, obj.locat);
      } else if (obj.page) {
        $("#" + obj.id).load(obj.text);
      }
      else {
        return obj
      }
    },
    error: function () {
      $("<p>Ошибка при передаче данных !</p>").appendTo(".success");
    },
  });
}
function add_carts_ajax(data) {

  data.replace("+", "\+")
  setTimeout(() => {
    $.ajax({
      type: "POST",
      url: "GLA1",
      data: "add_cart_f=1&cart_item=" + data,
      caches: false,
      processData: false

    })
  }, 100)

}
function formis(url, name, data = '') {

  $.ajax({ type: "POST", url: "/" + url, data: name + '_f=1' + data, caches: false }).done(
    function (res) {
      obj = jQuery.parseJSON(res);
      error_mesages(obj.titel, Number(obj.tip), obj.headers);
      setTimeout(() => {
        location.reload()
      }, 2000);
    })

}

/* -------------------------- Конец  блока "Ajax"  ---------------------------- */


/* -------------------------- Начало блока "Валидация #valid"  ---------------------------- */

function mail_valid(email_id, error_id) {
  var email = $("#" + email_id).val();
  var error_elements = $("#" + error_id);

  if (email == undefined) {
    email = $("#email").val();
  }
  var re = /\S+@\S+\.\S+/;
  let mail_length = String(email);

  if (mail_length.length > 0) {
    $(error_elements).removeClass("error");
    $(error_elements).addClass("hidden");

    if (!re.test(email)) {
      $(error_elements).removeClass("hidden");
      $(error_elements).addClass("error");
    } else {
      $(error_elements).removeClass(" error ");
      $(error_elements).addClass("hidden");
      return re.test(email);
    }
  } else {
    $(error_elements).removeClass("error");
    $(error_elements).addClass("hidden");
  }
}

function validateEmail(email) {
  if (email == undefined) {
    email = $("#email").val();
  }
  var re = /\S+@\S+\.\S+/;
  let mail_length = String(email);
  if (mail_length.length > 0) {
    document.getElementById("email1").style.display = "none";
    if (!re.test(email)) {
      document.getElementById("email").style.outline = "2px solid red";
      document.getElementById("email1").style.display = "inline-block";
    } else {
      document.getElementById("email").style.outline = "0px solid red";
      document.getElementById("email1").style.display = "none";
      return re.test(email);
    }
  } else {
    document.getElementById("email").style.outline = "0px solid red";
    document.getElementById("email1").style.display = "none";
  }
}
function email_valid(id) {
  let email = $("#" + id);
  let email_value = $(email).val();
  let re = /\S+@\S+\.\S+/;
  let mail_length = String(email_value);
  $(email).removeClass('no_valid');
  if (mail_length.length > 0) {
    if (re.test(email_value))
      $(email).addClass('valid');
    else
      $(email).addClass('no_valid');
  }
  else if (mail_length.length == 0)
    $(email).removeClass('no_valid');
  else
    $(email).addClass('no_valid');
}

function phone_valid() {
  let tel_input = $("input#phone");

  let tel_values = $(tel_input).val();
  let tel_str = String(tel_values);
  let tel_array = tel_str.split("+");

  if (tel_array.length > 1) {
    tel_str = tel_str.slice(1)
  }

  $(tel_input).removeClass('no_valid');

  if (tel_str.length == 11) {
    tel_values = Number(tel_values);
    tel_str = Number(tel_str);

    if (tel_values === tel_str) {
      $(tel_input).addClass('valid');
    }
    else {
      $(tel_input).addClass('no_valid');
    }
  } else if (tel_str.length == 0)
    $(tel_input).removeClass('no_valid');
  else
    $(tel_input).addClass('no_valid');

}

function passchek() { passchek1() }

function passchek1() {
  let a = document.getElementById("password").value;
  let c = String(a);
  let b = document.getElementById("password_dubl").value;
  let d = String(b);
  if ((c.length < 6 && c.length != 0) || c.length > 20) {
    document.getElementById("passNone1").style.display = "block";
    document.getElementById("password").style.borderColor = "red";
    if (d.length > 0) {
      if (a != b) {
        document.getElementById("passNone").style.display = "block";
        document.getElementById("password_dubl").style.borderColor = "red";
      } else {
        document.getElementById("passNone").style.display = "none";
        document.getElementById("password_dubl").style.borderColor = "#c1c1c1";
      }
    } else if (d.length == 0) {
      document.getElementById("passNone").style.display = "none";
      document.getElementById("password_dubl").style.borderColor = "#c1c1c1";
    }
  } else if (c.length == 0 || d.length == 0) {
    document.getElementById("passNone1").style.display = "none";
    document.getElementById("password_dubl").style.borderColor = "#c1c1c1";
    document.getElementById("passNone").style.display = "none";
    document.getElementById("password").style.borderColor = "#c1c1c1";
  } else {
    document.getElementById("passNone1").style.display = "none";
    document.getElementById("password").style.borderColor = "#c1c1c1";
    if (d.length > 0) {
      if (a != b) {
        document.getElementById("passNone").style.display = "block";
        document.getElementById("password_dubl").style.borderColor = "red";
      } else {
        document.getElementById("passNone").style.display = "none";
        document.getElementById("password_dubl").style.borderColor = "#c1c1c1";
      }
    } else if (d.length == 0) {
      document.getElementById("passNone").style.display = "none";
      document.getElementById("password_dubl").style.borderColor = "#c1c1c1";
    }
  }

}

function fio_valid(type = 'block') {

  switch (type) {
    case 'block':
      let names = $("input#FIO").val();
      let name = String(names);
      if (name.length < 3 && name.length != 0) {
        document.getElementById("fio").style.display = "block";
        document.getElementById("FIO").style.borderColor = "red";
      } else {
        document.getElementById("fio").style.display = "none";
        document.getElementById("FIO").style.borderColor = "#c1c1c1";
      }
      ; break;

    case "no_block":
      let name_id = $("input#FIO");
      let name_val = $(name_id).val()
      let name_ar = name_val.split(/\s/);

      let re = /[А-Яа-я]/;
      $(name_id).removeClass("no_valid")
      if (name_ar.length == 2) {
        if (re.test(name_ar[0]))
          if (re.test(name_ar[1]))
            $(name_id).addClass('valid');
          else
            $(name_id).addClass('no_valid');
        else
          $(name_id).addClass('no_valid');
      }
      else if (name_ar.length == 3) {
        if (re.test(name_ar[0]))
          if (re.test(name_ar[1]))
            if (re.test(name_ar[2]))
              $(name_id).addClass('valid');
            else
              $(name_id).addClass('no_valid');
          else
            $(name_id).addClass('no_valid');
        else
          $(name_id).addClass('no_valid');
      }
      else if (name_val.length == 0) {
        $(name_id).removeClass('no_valid');
        $(name_id).removeClass('valid');
      }
      else
        $(name_id).addClass('no_valid');
      ; break
  }

}

function sity_valid() {
  let tel1 = $("input#sity").val();
  let tel = String(tel1);
  if (tel.length < 2 && tel.length != 0) {
    document.getElementById("sity_p").style.display = "block";
    document.getElementById("sity").style.borderColor = "red";
  } else {
    document.getElementById("sity_p").style.display = "none";
    document.getElementById("sity").style.borderColor = "#c1c1c1";
  }
}

function not_red(id) {
  id = $("#" + id);
  id.removeClass("red_error");
}

function red(id) {
  id.addClass("red_error");
}

function show_hide_password(targ, targ2) {
  var input_pas = $("#" + targ);
  var buttons_hidden = $("#" + targ2);

  if (input_pas.attr("type") == "password") {
    $(buttons_hidden).removeClass("hiden");
    $(buttons_hidden).addClass("off_hiden");
    input_pas.attr("type", "text");
  } else {
    $(buttons_hidden).removeClass("off_hiden");
    $(buttons_hidden).addClass("hiden");
    input_pas.attr("type", "password");
  }
  return false;
}

/* -------------------------- Конец  блока "Валидация"  ---------------------------- */



/* -------------------------- Начало блока "Системные инструменты #system"  ---------------------------- */


function check_box(id_box, func) {
  var box = $("#" + id_box)[0].checked;
  var button = $("#button_input")
  var phone_input = $("#phone");
  var m = 0;
  var phone_value = phone_input.val()
  var FIO_input = $("#FIO");
  var FIO_value = FIO_input.val()
  var email_input = $("#email");
  var email_value = email_input.val()

  if (phone_value == "" || FIO_value == "" || email_value == "") {
    error_mesages('Все поля должны быть заполнено', 2, "Прайс");
    if (FIO_value == "") $(FIO_input).addClass("no_valid");
    if (phone_value == "") $(phone_input).addClass("no_valid");
    if (email_value == "") $(email_input).addClass("no_valid");
    button_disables(button);
  }
  else {
    if (!$("input#phone")[0].classList.contains('valid')) {
      error_mesages('Не правильно указан телефон', 2, 'Прайс'); button_disables(button);
      return;
    }

    if (!$("input#FIO")[0].classList.contains('valid')) {
      error_mesages('Не правильно указанно ФИО', 2, 'Прайс'); button_disables(button);
      return;
    }

    if (!$("input#email")[0].classList.contains('valid')) {
      error_mesages('Не правильно указанна почта', 3, 'Прайс'); button_disables(button);
      return;
    }

    if (box == true) {
      error_mesages('Заявка оптравлена, ждем ответ', 1, 'Прайс');
      button_disables(button);
      if (phone_value != "" && FIO_value != "" && email_value != "") {
        var funct = func.split(',')[0] + "('" + func.split(',')[1] + "','" + func.split(',')[2] + "','" + func.split(',')[3] + "')"
        eval(funct)
      }
    }
    else {
      error_mesages('Нет согласия на обработку данных', 2, 'Прайс');
      $("#" + id_box).addClass('no_valid')
      button_disables(button);
    }
  }


}

function closse(id, clase = "hidden_items") {
  $("." + id).addClass(clase);
}
function opens(id, clase = "hidden_items") {
  $("." + id).removeClass(clase);
}
function open_menu(t) {
  let m = $("."+t);
  m.removeClass("hiddens");
  setTimeout(() => {
    m.addClass("hiddens");
  }, 4000)
}
function menu_box_mobil(item_menu) {

  if ($(".modal_catalog_b")[0].classList.length == 1) {
    $(".modal_catalog_b").addClass('hidden_items')
  }

  if ($(".razmers_block_modal_element")[0].classList.length == 1) {
    $(".razmers_block_modal_element").addClass('hidden_items')
  }
  if ($(".modal_shearch_b")[0].classList.length == 1) {
    $(".modal_shearch_b").addClass('hidden_items')
  }


  switch (item_menu) {
    case 'cart': locations('cart'); break;
    case 'help': locations('help'); break;
    case 'home': locations('home'); break;
    case 'comments': locations('comments'); break;
    case 'modal_catalog_b': opens('modal_catalog_b'); break;
    case 'modal_shearch_b': opens('modal_shearch_b'); break;
    case 'size': $('.razmers_block_modal_element').removeClass('hidden_items'); break;
  }

}

function button_disables(id) {
  var button = $(id);
  button.attr("disabled", "")
  if (button[0].children.length > 0) {
    var but_span = button[0].children[0];
    but_span = $(but_span)
    but_span.removeClass("hidden_items")
    var i = 4
    let mons = setInterval(() => {
      but_span.html(i)
      i--;
    }, 1000)
    setTimeout(() => {
      button.removeAttr("disabled")
      but_span.html('5')
      but_span.addClass("hidden_items")
      clearInterval(mons);
    }, 5000)
    return
  }
  else {
    setTimeout(() => {
      button.removeAttr("disabled")
    }, 5000)
    return
  }
}

function send_email() { //#тут
  let email = $('#input_email_send');
  let input_email = email.val();
  if (input_email == '') {
    error_mesages("Для подписки на рассылку нужно ввести email", 1, 'Подписка на рассылку')
    email.addClass('no_valid')
    return;
  } else if (email[0].classList.contains('no_valid')) {
    error_mesages("Email не соостветствует требованиям", 2, 'Подписка на рассылку')
    return;
  }
  let box_chek = $('#sogl');
  let box_i = box_chek[0].checked;
  if (box_i == false) {
    error_mesages("Не забудте подтвердить согласие с Политикой конфиденциальности и принимять условия Пользовательского соглашения"
      , 2, "Соглашение")
    box_chek.addClass("no_valid")
    return;
  }
  let button = $(".buttonBlock_footers .Block_footers__button");
  button_disables(button)
  error_mesages("Заявка принята. Ожидаю ответ с сервера", 1, "Email-Рассылка")
  formes('GLA1', 'user_send_email', "input_email_send")
}

function list_open(id, type = "") {

  var count_le = document.getElementsByClassName("list_menu_header")[0].children.length;

  if (count_le > 9) {
    document.getElementsByClassName("menu_header_box")[0].style.height = "90vw";
    if (type == 'open') {
      $("." + id).removeClass("bottom_minu2");
    }
    else if (type == 'closse') {
      $("." + id).addClass("bottom_minus2");
    }
    else { $("." + id).toggleClass('bottom_minus2') }

  }
  else {
    if (type == 'open') {
      $("." + id).removeClass("bottom_minus");
    }
    else if (type == 'closse') {
      $("." + id).addClass("bottom_minus");
    }
    else { $("." + id).toggleClass('bottom_minus') }
  }

}
$(".li_product_img").on("mouseenter", (e) => {

  e.target.classList.add("scale_items")
});

$(".li_product_img").on("mouseleave", (e) => {
  e.target.classList.remove("scale_items")
});

function error_mesages(text, tip = 1, heade = "") {
  switch (tip) {
    case 1:
      var theme = "info";
      break;
    case 3:
      var theme = "danger";
      break;
    case 2:
      var theme = "warning";
      break;
    case 0:
      var theme = "success";
      break;
  }
  if (heade == "") title = true;
  else title = heade;
  text = text.split('"');
  title = title.split('"');
  new Toast({
    title: title,
    text: text,
    theme: theme,
    autohide: true,
    interval: parseInt(000),
  });
}
function privetst(date, locat) {
  var titles = date.split(".")[0];
  var text = date.split(".")[1];
  var type = Number(date.split(".")[2]);
  error_mesages(text, type, titles);

  setTimeout(() => {
    locations(locat);
  }, 6000);
}

function locations(url) {
  window.location.href = "/" + url;
}

$("button.item_content_buttons").on("click", OtkritieMenu);

function OtkritieMenu() {
  var b = this.parentNode;
  var rod = b.parentNode;
  print(rod.getBoundingClientRect());
  var window_Width = window.innerWidth;
  var window_Hieght = window.innerHeight;
  print(window_Width);
  print(window_Hieght);
}

function print(f) {
  console.trace(f);
  //console.log(f);
}


function reg_infos() {
  /* Получение данных после нажатия кнопки */

  /* Основная секция */
  var email = $("#email");

  var password = $("#password");
  var password_dubl = $("#password_dubl");


  /* Дополнительная секция */

  var name = $("#name");
  var first_name = $("#first_name")
  var last_name = $("#last_name");
  var phone = $("#Phone");
  var index = $("#Address_ZipPostalCode");
  var obl = $("#obl");
  var sity = $("#sity");
  var strasse = $("#strasse");
  var home = $("#home");
  var kvart = $("#home_s");

  /* Чек-боксы */
  var pod1 = $("#pod1");

  /* Блокировка кнопки на время проверки  */

  $(".button_register_box_button button").attr("disabled", true);
  setTimeout(() => {
    $(".button_register_box_button button").attr("disabled", false);
  }, 4000);

  /* Сбор данных в массив для удобства проверки */

  var mas_id = [];
  var mas_id_test2 = [
    name, last_name, first_name,
    phone, obl,
    sity, strasse,
    home, kvart,
    index,
  ];
  var mas_id_test1 = [email, password, password_dubl];

  var coins_1 = 0;

  /* Проверка параметров после нажатия кнопки */

  /* Проверем первый блок */

  mas_id_test1.forEach((item) => {
    if (item.val() != "" || item.val() != 0) {
      mas_id.push(item);
    } else {
      red(item);
      coins_1++;
    }
  });
  if (coins_1 != 0) {
    error_mesages("Заполните обязательные поля", 2, "Ошибка");
    return false;
  }

  /* Проверем второй блок */

  mas_id_test2.forEach((item) => {
    if (item.val() != "" && Number(item.val()) != 0) {
      mas_id.push(item);
    }
  });


  /* Проверем третий блок */
  if (!pod1.is(":checked")) {
    red($("#pod1_label"));
    error_mesages(
      "Нужно принять условия соглашения",
      2,
      "Ошибка"
    );
    return false;
  }
  if (password.val() != password_dubl.val()) {
    error_mesages(
      "Пароли не совпадают",
      2,
      "Ошибка"
    );
    return false;
  }

  /* Окончательное решение */


  if (coins_1 == 0) {
    var str = "";
    mas_id.forEach((item, key) => {
      str += item.prop("id");
      if (key < mas_id.length - 1) str += ".";
    });
    formes("GLA", "registers", str);
  }
}

function chekeds_revrite_password() {


  var chek = $("#passworduuu")[0].checked;
  if (chek) {
    $("#item_on_hid_pas").addClass('hidden_items')//Показать пароль
    $("#item_off_hid_pas").removeClass('hidden_items')//Скрыть пароль



    // $(".chekbox_password_box_s")[0].style.background = 'white';

    $(".chekbox_password_box_s").addClass('active')
    $('#rewritePaswords').attr("type", "text");

  }
  else {

    $("#item_off_hid_pas").addClass('hidden_items') //Скрыть пароль
    $("#item_on_hid_pas").removeClass('hidden_items') //Показать пароль
    //$(".chekbox_password_box_s")[0].style.backgroundImage = 'url("assec/css/svg/done_checkbox.svg")';

    $(".chekbox_password_box_s").removeClass('active')
    $('#rewritePaswords').attr("type", "password");

  }
}


function loaditems(id, url) {

  var data = new FormData();
  jQuery.each(jQuery('#' + id)[0].files, function (i, file) {
    data.append('file-' + i, file);
  });
  $.ajax({
    url: '/' + url,
    data: data,
    type: 'POST',
    contentType: false,
    processData: false,
    caches: false,
    method: 'POST',
    success: function (response) {
      obj = jQuery.parseJSON(response)
      error_mesages(obj.titel, Number(obj.tip), obj.headers);
    }
  });
}

function list_catalog_modals(type) {


  var modad_body = $('#body_catalogs')
  var str = `<p onclick="closse('modal_catalog_b');list_catalog_modals('back')" class="closens"><span class="UPPERCASE">Закрыть</span> </p>`
  var les = elements_sorter;
  var mids = 4;
  switch (type) {
    case "boys": str += ` <p onclick="list_catalog_modals('back')" class="atives">
    <span class="UPPERCASE">Мальчики</span>
    </p>
    <p onclick="locations('store&all=boys')"><span class="">Все</span></p>
    `; les = les.boys; mids = 1; break;

    case "girl": str += ` <p onclick="list_catalog_modals('back')" class="atives">
    <span class="UPPERCASE">Девочки</span>
    </p>
    <p onclick="locations('store&all=girl')"><span class="">Все</span></p>
    `; les = les.girl; mids = 0; break;

    case "baby": str += ` <p onclick="list_catalog_modals('back')" class="atives">
    <span class="UPPERCASE">Малыши</span>
    </p>
    <p onclick="locations('store&all=kids')"><span class="">Все</span></p>
    `; les = les.baby; mids = 2; break;

    case "back": str += ` 
   
    <p onclick="list_catalog_modals('boys')">
    <span class="UPPERCASE">Мальчики</span>
    </p>
    <p onclick="list_catalog_modals('girl')">
        <span class="UPPERCASE">Девочки</span>
    </p>
    <p onclick="list_catalog_modals('baby')">
        <span class="UPPERCASE">Малыши</span>
    </p>
    <p onclick="locations('store&items=new')">
        <span class="UPPERCASE">Новинки</span>
    </p>
    <p onclick="locations('store&items=collection')">
        <span class="UPPERCASE">Коллекция</span>
    </p>
    <p onclick="locations('store&items=sale')">
        <span class="UPPERCASE"> Распродажа</span>
    </p>`; break;
  }

  if (mids != 4) {
    for (mas in les) {
      if (mas == "categor") {
        les.categor.forEach((item, key) => {
          str += `<p onclick="locations('store&gategories=${item[0]}&lis=${mids}&Nist=1')"><span class="">${item[1]}</span></p>`
        })
      }

      if (mas == "BiP") {
        les.BiP.forEach((item, key) => {
          str += `<p onclick="locations('store&gategories=${item[0]}&lis=${mids}&Nist=2')"><span class="">${item[1]}</span></p>`
        })
      }
    }

  }
  $(modad_body).html(str)


  /* 
  <p onclick="list_catalog_modals('girl')" class="active">
     <span class="UPPERCASE">Девочки</span>
  </p>
 
  ''
  'girl'
  'baby'
  'nows'
  'free '
  */
}


function rewritePassword() {
  let email = $("#email");
  let codeEmail_i = $("#code_email");

  return;
  formes('GLA', 'Rewrite', 'rewritePaswords.email')
}
function comments_opens(id) {
  $("#comments_id_" + id + " .contents").toggleClass("active")
}



/* -------------------------- Конец  блока "Системные инструменты"  ---------------------------- */








/* -------------------------- Начало блока "Уголок авторизованного пользователя #auth"  ---------------------------- */
function addFavoritesUser(id) {
  if (typeof id == "number" && /[0-9]{4,10}/.test(id) && user_after == true) {
    $.ajax({
      type: "POST",
      url: "userform",
      data: "addFav_f=1&articl=" + id,
      caches: false,
      success: function (rees) {
        let obj = jQuery.parseJSON(rees);
        if (obj.items == "yes")
          $("#id_product_i" + id + " span").addClass("add_favor")
        else if (obj.items == "no") {
          $("#id_product_i" + id + " span").removeClass("add_favor")
          if ($("#box_item_id" + id)) {
            $("#box_item_id" + id).remove()
          }
        }
        error_mesages(obj.titel, obj.tip, obj.headers)
      }
    });
  }
  else if (user_after == false && typeof id == "number" && /[0-9]{4,10}/.test(id)) {
    error_mesages("Для добавление товара в избранное требуется авторизация", 2, "Избранное");
    return;
  }
  else {
    error_mesages("Что-то пошло не так....", 3, "Error");
    return;
  }
}

/* -------------------------- Конец  блока "Уголок авторизованного пользователя"  ---------------------------- */