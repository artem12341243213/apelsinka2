/* ---------------------------- Начало блока "Слайдер" ---------------------------- */


const images = $('.slider .slider-line img');
const sliderLine_images = document.querySelector('.slider .slider-line');


const product_obnov = $('.nowinki_list-items .list .__element');
const sliderLine_product = document.querySelector('.nowinki_list-items .list');

var width_images

var width_product

var count_images = 0;

var count_product = 0;

function index_r() {
  width_images = sliderLine_images != undefined ? sliderLine_images.offsetWidth : 0;

  width_product = product_obnov.length != 0 ? product_obnov[0].offsetWidth + 10 : 0;
}

window.addEventListener('resize',()=> {
  index_r()
})
index_r()
var m = 0;
for (let i of product_obnov) {
  m += i.offsetWidth;
}


var coll_max = 0
var lot = 0;
for (let i = 0; i < product_obnov.length; i++) {
  m -= width_product;
  lot = m;
  if (lot >= 1200) {
    coll_max++;
    lot = 0;
  }
  else if (lot > 900 && lot < 1200) {
    coll_max++;
    lot = 0
  }
};
delete (lot);
delete (m);
delete (product_obnov);



$('.slider-button').on('click', (elements) => {
  let e = elements.target
  data_set = e.dataset.src;
  text = data_set.split('|');
  switch (text[1]) {

    case 'header':
      print(sliderLine_images)
      print(count_images)
      print(width_images)
      switch (text[0]) {
        case 'next':
          if (count_images + 1 == images.length) {
            count_images = 0;
          }
          else { count_images++; }
          rollslider(sliderLine_images, count_images, width_images);
          break;

        case "prev":
          if (count_images < 0) {
            count_images = images.length - 1;
          }
          else { count_images--; }
          rollslider(sliderLine_images, count_images, width_images);

          break;
      }
      break;
    case 'product':
      var max_count_list = coll_max;
      switch (text[0]) {
        case 'next':
          if (count_product == max_count_list) {
            count_product = 0;
          }
          else {
            count_product++;
          }
          rollslider(sliderLine_product, width_product, count_product);
          break;

        case "prev":
          if (count_product - 1 < 0) {
            count_product = max_count_list;
          }
          else {
            count_product--;
          }
          rollslider(sliderLine_product, width_product, count_product);
          break;
      }
      break;
  }
})

function rollslider(id, count, width) {
  id.style.transform = 'translate(-' + count * width + 'px)';
}

/* ---------------------------- Конец блока "Слайдер"  ---------------------------- */



//style.transform.translateX(px+"px")
//transform: translateX(-1284px);
/*
if ($('.slider') || $('.nowinki') || $('.comments_block')) {

  var slides = $('#slides-items');
  let slideIndex = 1;
  function sliders(e) {
    if (e != null) {
      text = e.split('|');

      console.log(text)

      sliders_editor(text[1], text[0])

      switch (text[0]) {
        case 'next': plussSlides(1); break;
        case 'prev': plussSlides(-1); break;
      }
    }

    function plussSlides(n) {
      showSlides(slideIndex += n);
    }
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    /* 
      dotsArea.onclick = function (e) {
        for (let i = 0; i < dots.length + 1; i++) {
          if (e.target.classList.contains('dots-item') && e.target == dots[i - 1]) {
            currentSlide(i);
          }
        }
    } */
/*  }

  function showSlides(n) {
    if (n < 1) { // если меньше 1 то даем ему значение последнего элемента
      slideIndex = slides.length;
    }
    else if (n > slides.length) {// если выходит за пределы элементов то даем 1
      slideIndex = 1;
    }
    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
    }
    slides[slideIndex - 1].style.display = 'block';
  }

  function sliders_editor(id, tip) {
    var px = 0;
    console.log($("#" + id)[0].style.transform)
    if ($("#" + id)[0].style.transform.translateX != null) {

    }

    $("#" + id)[0].style.transform = 'translateX(' + (-600) + 'px)';
  }
  showSlides(1);
}
*/