$('li.url_link_item a').on('click', (e) => {
    e = e.target;
    Array.from($('li.url_link_item')).forEach(it => {
        $(it).removeClass("active_li");
    });
    $($(e).closest('li')).addClass('active_li');
    e = e.dataset.src;
    data = 'elem=' + e;
    if (e == 'table_razmers') {
        $(".razmers_block_modal_element").removeClass('hidden_items');
    }
    else if (e != 'exit')

        $.ajax({ type: "POST", url: "userform", data: data, caches: false }).done(
            function (res) {
                $("#include_box").removeClass('hidden_items');
                $("#include_box").html(res);
            })

    else {
        localStorage.clear('cart');

        $.ajax({ type: "POST", url: "userform", data: data, caches: false }).done(
            function (res) {
                obj = jQuery.parseJSON(res);
                locations(obj.go);
            })
    }

});


function profil_chek_save(type = 'saves', id = "") {
    var last_name = $("input#last_name").val()
    var name = $("input#name").val()
    var first_name = $("input#first_name").val()
    var phone = $("input#phone").val()
    var obl = $("input#obl").val()
    var sity = $("input#sity").val()
    var starsse = $("input#starsse").val()
    var home = $("input#home").val()
    var home_s = $("input#homeV").val()
    var index = $("input#Address_ZipPostalCode").val()

    var span_last_name = ("span#last_name_s")
    var span_name = ("span#name_s")
    var span_first_name = ("span#first_name_s")
    var span_phone = ("span#phone_s")
    var span_obl = ("span#obl_s")
    var span_sity = ("span#sity_s")
    var span_starsse = ("span#starsse_s")
    var span_home = ("span#home_s")
    var span_home_s = ("span#home_s_s")
    var span_index = ("span#index_s")

    var yes = "yes_chek";
    var no = "non_chek";


    if (type == "saves") {
        var mas_list = [
            last_name, name, first_name,
            phone, obl, sity, starsse,
            home, home_s, index
        ]
        var mas_list_span = [
            span_last_name, span_name, span_first_name, span_phone,
            span_obl, span_sity, span_starsse, span_home,
            span_home_s, span_index
        ]
        var disss = 0;

        for (var i = 0; i < mas_list.length; i++) {
            var data = mas_list[i]
            if (data == "") {
                $(mas_list_span[i]).addClass(no)
                disss++
            }
            else {
                $(mas_list_span[i]).removeClass(no)
                $(mas_list_span[i]).addClass(yes)
            }
        }
        if (disss == 0) {
            var mis = 'last_name.name.first_name.phone.obl.sity.starsse.home.homeV.Address_ZipPostalCode'

            formes('userform', 'edit_data_user', mis)
            
            $(".box_include").addClass("hidden_items")
            $(".box_include").html("")
        }
        else {
            error_mesages("Заполните все поля. Поля которые не можете заполните - поставте '-'.", 2, 'Не удалось сохранить')
        }
    }
    else {
        last_name
    }
} 