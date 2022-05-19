/*!
* Start Bootstrap - Shop Homepage v5.0.5 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

/* Code for changing active 
            link on clicking */
var btns =
  $("#navigation .navbar-nav .nav-link");

for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click",
    function () {
      var current = document
        .getElementsByClassName("active");

      current[0].className = current[0]
        .className.replace(" active", "");

      this.className += " active";
    });
}

/* Code for changing active 
link on Scrolling */
$(window).scroll(function () {
  var distance = $(window).scrollTop();
  $('.page-section').each(function (i) {

    if ($(this).position().top
      <= distance + 250) {

      $('.navbar-nav a.active')
        .removeClass('active');

      $('.navbar-nav a').eq(i)
        .addClass('active');
    }
  });
}).scroll();