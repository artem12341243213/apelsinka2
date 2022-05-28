
$('.naw-menu_btn').on("click", function (e) {
    e.preventDefault();
    $(this).toggleClass("naw-menu_btn--active");
});



function ixi() {
    if (!$('.dme-info').hasClass('dme-info-hiden')) {
        $('.dme--hiden').addClass('dme--activ');
        $('.dme-info').addClass('dme-info-hiden');
        $('.dme--activ').removeClass('dme--hiden');
    } else {
        $('.dme--activ').addClass('dme--hiden');
        $('.dme-info').removeClass('dme-info-hiden');
        $('.dme--hiden').removeClass('dme--activ');
    };
}




$(document).ready(function () {
    $('.dme-header').on('mouseenter', '.dme-header-right-cart-wrapper', function () {
        $('.dme-header-right-cart-drop').addClass('dme-active');
    });
    $('.dme-header').on('mouseleave', '.dme-header-right', function () {
        $('.dme-header-right-cart-drop').removeClass('dme-active');
    });

    $('.dme-header').on('mouseenter', '.dme-header-right-cart-drop', function () {
        $('.dme-header-right-cart-drop').addClass('dme-active');
    });

    $('.dme-header').on('mouseleave', '.dme-header-right-cart-drop', function () {
        $('.dme-header-right-cart-drop').removeClass('dme-active');
    });

    $('.dme-header').on('mouseenter', '.dme-header-right-fav', function () {
        $('.dme-header-right-cart-drop').removeClass('dme-active');
        $('.dme-header-right-cart-drop').addClass('dme-active');
    });


});



const images = document.querySelectorAll('.slider .slider-line img');
const sliderLine = document.querySelector('.slider-line');
let count = 0;
let width;

function init() {
    console.log('resize');
    width = document.querySelector('.slider').offsetWidth;
    sliderLine.style.width = width * images.length + 'px';
    images.forEach(item => {
        item.style.width = width + 'px';
        item.style.height = 'auto';
    });
    rollslider();
}
window.addEventListener('resize', init);
init();

document.querySelector('.dme-modal-close').addEventListener('click', function () {
    $('#dme-modal_promo-register').style = 'display: none';
})

setInterval(function () {
    if (count + 1 == images.length) {
        count = 0;
    }
    else { count++; }
    rollslider();

}, 6000);
document.querySelector('.slider-next').addEventListener('click', function () {
    if (count + 1 == images.length) {
        count = 0;
    }
    else { count++; }
    rollslider();
})

document.querySelector('.slider-prev').addEventListener('click', function () {
    if (count < 0) {
        count = images.length - 1;
    }
    else { count--; }
    rollslider();
})
function rollslider() {
    sliderLine.style.transform = 'translate(-' + count * width + 'px)';
}



//AjaxCart.init(false, '.dme-header-right .dme-header-right-cart-number', '.dme-header-right .dme-header-right-fav-number', '#flyout-cart');

function closs() {
    $('div#open-comment').detach();
};

$('.dme-modal-close').on('click', function () {
    var closs = $(this).attr('data-src');
    $('#' + closs).removeClass('opened');
});
$('.dme-button').on('click', function () {
    var closs = $(this).attr('data-src');
    $('#' + closs).removeClass('opened');
});


function ixion(id, dost) {
    var out = '';
    var dost = true;
    if (dost == true) {
        out += '<div class="opennd" id= "open-comment">';
        out += '<div class="openned-box">';
        out += '<button class="dme-modal-close" data-src="open-comment" onclick="closs();"></button>';
        out += '<div class="openned-box_content">';
        out += '<div class="openned-box_content__text">';
        out += '<div class="openned-box_content__date"> 5 июля 2021</div>';
        out += "<h4 class='amix'>Елена, Иркутская область</h4>";
        out += "<p>Здравствуйте. Заказ получила. Все очень красивое и качественное. Спасибо большое!!!</p>";
        out += "<div class='podpis'>Отзыв к сайту</div>";
        out += '</div>';
        out += '</div>';
        out += '</div>';
        out += '</div>';
    }
    $('.open-comment').html(out);
}



var countu = 0;

function imion() {
    var m = ['dme-modal_AddToCart', 'document_dme', 'dme-modal_secondStore', 'dme-modal_priceRequest', 'dme-modal_subscribeResult'];
    $('#' + m[countu]).addClass('opened');
    if ((countu + 1) > m.length) {
        countu = 0;
    }
    else {
        countu++;
    }

}

$("input.tip_label").on('click', function () {
    alex('fiz');
})
$("input.tip_label1").on('click', function () {
    alex('yur');
})

var m = document.getElementsByClassName('dme-request-button');
$(m).on('click', function () {
    var PersonalData = document.querySelector('input.PersonalData').checked;
    var text = document.querySelector('input.text').value;
    var phone = document.querySelector('input.phone').value;
    var mail = document.querySelector('input.mail').value;
    console.log('FIO: ' + text + "\n phone:" + phone + "\n mail:" + mail + "\n cheked:" + PersonalData);
    mesegge(1, 'efsfes');
});

function mesegge(cod, text) {
    var out = "";
    switch (cod) {
        case 3:
            out += ' <div class="bar-notifications"> <div class="bar-notifications-error" title="Ошибка" >' + text + '</div>';
            out += '  <div id="bar-notification opened" class="bar-notification">';
            out += '      <span class="close" title="Закрыть" onclick="clossen()"></span>';
            out += '  </div></div>';
            break;
        case 2:
            out += '  <div class="bar-notifications"><div class="bar-notifications-warning" title="Предупреждение">' + text + '</div>';
            out += '  <div id="bar-notification opened" class="bar-notification">';
            out += '      <span class="close" title="Закрыть" onclick="clossen()"></span>';
            out += '  </div> </div>';
            break;
        case 1:
            out += ' <div class="bar-notifications"> <div class="bar-notifications-success" title="Уведомление">' + text + '</div>';
            out += '  <div id="bar-notification opened" class="bar-notification">';
            out += '      <span class="close" title="Закрыть" onclick="clossen()"></span>';
            out += '  </div> </div>';
            break;
    }
    $('.messages').addClass('messages-open');
    $('.messages').html(out);
}
function clossen() {
    $('div.messages').detach();
}
setTimeout(function () {
    clossen();
}, 5000);

function AddTowrLow(id) {

    localStorage['keu'] = '1';
    console.log(localStorage);
    /*
    if (sessionStorage.key('id')) {
        console.log('ess')
    }
    else {
        $('#dme-modal_AddToCart').addClass('opened');
    }*/
}


function post_ury(url, name, data) {
    var str = '';

    $.each(data.split('.'), function (k, v) {

        if (v == 'RememberMe') { str += '&' + v + '='; m = $('#' + v).is(':checked'); str += m; }

        else if (v == 'FIO') {
            m = $('#' + v).val();//0 1 2
            let f = m.split(' ');
            for (var i = 0; i < f.length; i++) {
                switch (i) {
                    case 0:
                        str += '&Firstname=' + f[i];
                        break;
                    case 1:
                        str += '&name=' + f[i];
                        break;
                    case 2:
                        str += '&Fathername=' + f[i];
                        break;
                    default:
                        break;
                }
            };

        }
        else { str += '&' + v + '='; m = $('#' + v).val(); str += m; }
    });

    $.ajax({
        url: "/" + url,
        type: "POST",
        data: name + '_f=1' + str,
        cache: false,
        success: function (result) {
            console.log(result);
            obj = jQuery.parseJSON(result);
            if (obj.go) locations(obj.go);
            else alert(obj.message);


        },
        error: function () {
            $('<p>Ошибка при передаче данных !</p>').appendTo('.success');
        }
    });

}


function show_hide_password(target) { var input = $('input#password'); if (input.attr('type') == 'text') { target.classList.remove('view'); input.attr('type', 'password') } else { target.classList.add('view'); input.attr('type', 'text'); } return false; }; function show_hide_password2(target) { var input = $('input#anpassword'); if (input.attr('type') == 'text') { target.classList.remove('view'); input.attr('type', 'password') } else { target.classList.add('view'); input.attr('type', 'text'); } return false; };
function mail_valid() { let email = $('#email').val(); let mail_length = String(email); if (mail_length.length == 0) { document.getElementById('email1').style.display = "none"; document.getElementById('email2').style.display = "none"; document.getElementById('email').style.borderColor = "#c1c1c1"; } }


function phone_valid() { let tel1 = $('input#phone').val(); let tel = String(tel1); if (tel.length < 11 && tel.length != 0) { document.getElementById('phone_p').style.display = "block"; document.getElementById('phone').style.borderColor = "red"; } else { document.getElementById('phone_p').style.display = "none"; document.getElementById('phone').style.borderColor = "#c1c1c1"; } }

function passchek() { passchek1(); } function passchek1() { let a = document.getElementById('password').value; let c = String(a); let b = document.getElementById('anpassword').value; let d = String(b); if ((c.length < 6 && c.length != 0) || (c.length > 10)) { document.getElementById('passNone1').style.display = "block"; document.getElementById('password').style.borderColor = "red"; if ((d.length > 0)) { if (a != b) { document.getElementById('passNone').style.display = "block"; document.getElementById('anpassword').style.borderColor = "red"; } else { document.getElementById('passNone').style.display = "none"; document.getElementById('anpassword').style.borderColor = "#c1c1c1"; } } else if (d.length == 0) { document.getElementById('passNone').style.display = "none"; document.getElementById('anpassword').style.borderColor = "#c1c1c1"; } } else if (c.length == 0 || d.length == 0) { document.getElementById('passNone1').style.display = "none"; document.getElementById('anpassword').style.borderColor = "#c1c1c1"; document.getElementById('passNone').style.display = "none"; document.getElementById('password').style.borderColor = "#c1c1c1"; } else { document.getElementById('passNone1').style.display = "none"; document.getElementById('password').style.borderColor = "#c1c1c1"; if ((d.length > 0)) { if (a != b) { document.getElementById('passNone').style.display = "block"; document.getElementById('anpassword').style.borderColor = "red"; } else { document.getElementById('passNone').style.display = "none"; document.getElementById('anpassword').style.borderColor = "#c1c1c1"; } } else if (d.length == 0) { document.getElementById('passNone').style.display = "none"; document.getElementById('anpassword').style.borderColor = "#c1c1c1"; } } }
function fio_valid() { let tel1 = $('input#FIO').val(); let tel = String(tel1); if (tel.length < 3 && tel.length != 0) { document.getElementById('fio').style.display = "block"; document.getElementById('FIO').style.borderColor = "red"; } else { document.getElementById('fio').style.display = "none"; document.getElementById('FIO').style.borderColor = "#c1c1c1"; } }
function sity_valid() { let tel1 = $('input#sity').val(); let tel = String(tel1); if (tel.length < 2 && tel.length != 0) { document.getElementById('sity_p').style.display = "block"; document.getElementById('sity').style.borderColor = "red"; } else { document.getElementById('sity_p').style.display = "none"; document.getElementById('sity').style.borderColor = "#c1c1c1"; } }
function validateEmail(email) { if (email == undefined) { email = $('#email').val(); } var re = /\S+@\S+\.\S+/; let mail_length = String(email); if (mail_length.length > 0) { document.getElementById('email1').style.display = "none"; if (!re.test(email)) { document.getElementById('email2').style.display = "block"; document.getElementById('email').style.borderColor = "red"; } else { document.getElementById('email2').style.display = "none"; document.getElementById('email').style.borderColor = "#c1c1c1"; return re.test(email); } } else { document.getElementById('email2').style.display = "none"; document.getElementById('email').style.borderColor = "red"; document.getElementById('email1').style.display = "block"; } };


function show_hide_password3(target) {
    var input = document.getElementById('password');
    if (input.getAttribute('type') == 'text') {
        target.classList.remove('view');
        input.setAttribute('type', 'password');
    } else {
        target.classList.add('view');
        input.setAttribute('type', 'text');
    }
    return false;
};

function cechk() {
    var a = $('#FIO').val(); a = String(a); //+
    var phone = $('#phone').val(); a = String(a);//+
    var mail = document.getElementById('email').value; mail = String(mail);
    var b = validateEmail(document.getElementById('email').value); //true //+
    var c = document.getElementById('password').value; //+
    var d = document.getElementById('anpassword').value;
    var sity = document.getElementById('sity').value; sity = String(sity); //sity //+

    if (b == undefined) {
        b = false;
    }
    var passwodr_scher = String(c);


    post_ury('gform', 'register', 'FIO.phone.email.sity.password');
    /*
        if (passwodr_scher.length != 0 && phone.length > 3 && a.length != 0 && sity.length != 0 && b==true&& mail.length != 0) 
        {if (c == d) {post_ury('gform','register','FIO.phone.email.sity.password');}
        else {document.getElementById('passNone').style.display = "block";document.getElementById('anpassword').style.borderColor = "red";}}else {if (passwodr_scher.length == 0) {document.getElementById('passNone1').style.display = "block";document.getElementById('password').style.borderColor = "red";}if (phone.length < 3) {document.getElementById('phone_p').style.display = "block";document.getElementById('phone').style.borderColor = "red";}if (a.length == 0) {document.getElementById('fio').style.display = "block";document.getElementById('FIO').style.borderColor = "red";}if (sity.length == 0) {document.getElementById('sity_p').style.display = "block";document.getElementById('sity').style.borderColor = "red";}if (mail.length == 0) {document.getElementById('email').style.borderColor = "red"; document.getElementById('email1').style.display = "block";}}
    */
}
function recovery() {
    var b = validateEmail(document.getElementById('email').value);
    if (b) {
        post_ury('gform', 'recovery', 'email.captcha');
    }
}
function confirm(cod, text) {

    mesegge(cod, text);
    setTimeout(function () { post_ury('gform', 'confirm', 'code'); }, 2000);
}

function locations(url) {
    window.location.href = '/' + url;
}


function rewrite(idnex) {
    var out = '';
    switch (idnex) {
        case 1:
            var name = $('input#Name').val();
            var email = $('input#email').val();
            var sity = $('input#sity').val();
            var phone = $('input#phone').val();
            var password = $('input#password').val();

            out += '<table class="table-reWrite">';
            out += '<tr>';
            out += '<td> Фио </td>';
            out += '<td><input type="text" name="" id="Name" value="' + name + '" ></td>';
            out += '</tr>';
            out += '<tr>';
            out += '<td> eMail </td>';
            out += ' <td><input type="text" name="" id="email" value="' + email + '" disabled></td>';
            out += '</tr>';
            out += '<tr>';
            out += '                  <td> Город </td>';
            out += '                 <td><input type="text" name="" id="sity" value="' + sity + '" ></td>';
            out += '               </tr>';
            out += '              <tr>';
            out += '                   <td> Телефон </td>';
            out += '                   <td><input type="text" name="" id="phone" value="' + phone + '" ></td>';
            out += '             </tr>';
            out += '             <tr>';
            out += '                <td> Пароль </td>';
            out += '                  <td><input type="text" name="" id="password" value="' + password + '" ></td>';
            out += '            </tr>';
            out += '               <tr>';

            out += '                   <td><button class="cansle" onclick="rewrite(2)"id ="canlce" >Отмeнить</button></td>';
            out += '            <td><button onclick="rewriteRow()" id = "ok">Подтвердить</button></td>';
            out += '               </tr>';
            out += '           </table>';
            break;
        case 2:
            var name = $('input#Name').val();
            var email = $('input#email').val();
            var sity = $('input#sity').val();
            var phone = $('input#phone').val();
            var password = $('input#password').val();


            out += '  <table class="">';
            out += '  <tr>';
            out += '      <td> Фио </td>';
            out += '       <td><input type="text" name="" id="Name" value="' + name + '" disabled></td>';
            out += '  </tr><td> eMail</td>';
            out += '<td><input type="text" name="" id="email" value="' + email + '" disabled></td>';
            out += '   </tr>';
            out += '  <tr>';
            out += '     <td> Город </td>';
            out += ' <td><input type="text" name="" id="sity" value="' + sity + '" disabled></td>';
            out += '  </tr><td> Телефон </td>';
            out += '<td><input type="text" name="" id="phone" value="' + phone + '" disabled></td>';
            out += '  </tr><td> Пароль </td>';
            out += '<td><input type="password" name="" id="password" value="' + password + '" disabled>';
            out += ' <span href="#" class="password-control" onclick="return show_hide_password3(this);"></span>';
            out += '</td></table>';
    }
    $('div.info-data').html(out);

}
function exit() {
    $.ajax({
        url: "/Aform",
        type: "POST",
        data: 'exit_f=1',
        cache: false,
        success: function (result) {
            obj = jQuery.parseJSON(result);
            locations(obj.go);
        },
        error: function () {
            $('<p>Ошибка при передаче данных !</p>').appendTo('.success');
        }
    });
}


function rewriteRow() {
    var str = '';
    var name = 'Name';
    var sity = 'sity';
    var phone = 'phone';
    var email = 'email';
    var password = 'password';
    let data = '';
    data += name + '.' + email + '.' + sity + '.' + phone + '.' + password
    $.each(data.split('.'), function (k, v) {


        if (v == 'Name') {
            m = $('#' + v).val();//0 1 2
            let f = m.split(' ');
            for (var i = 0; i < f.length; i++) {
                switch (i) {
                    case 0:
                        str += '&Firstname=' + f[i];
                        break;
                    case 1:
                        str += '&name=' + f[i];
                        break;
                    case 2:
                        str += '&Fathername=' + f[i];
                        break;
                    default:
                        break;
                }
            }
        }
        else {
            str += '&' + v + '='; m = $('#' + v).val(); str += m;
        }
    });

    let url = 'Aform';
    let namep = 'rewrite';
    $.ajax({
        url: "/" + url,
        type: "POST",
        data: namep + '_f=1' + str,
        cache: false,
        success: function (result) {
            obj = jQuery.parseJSON(result);
            alert(obj.message);
            rewrite(2);
        },
        error: function () {
            $('<p>Ошибка при передаче данных !</p>').appendTo('.success');
        }
    });


};


function tworion(a, b, c) {
    let get = a + "." + b + "." + c;
    post_ury('agform', 'adminPassword', get);
}