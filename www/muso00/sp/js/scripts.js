/*!
* Start Bootstrap - Shop Homepage v5.0.5 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

var popoverTitle = 'Password requirements';
var popoverContent = 'Your password has to have at least one capital letter [A-Z], one digit [0-9] and be minimum 8 characters long.';

$(document).ready(function () {
    $('.nav-toggle').click(function () {
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function () {
            if ($(this).css('display') == 'none') {
                toggle_switch.html('<i class="bi bi-arrow-down"></i>Read More');
            } else {
                toggle_switch.html('<i class="bi bi-arrow-up"></i>Read Less');
            }
        });
    });

});

$(document).ready(function () {
    $('.passwd-popover').popover({
        placement: 'right',
        title: popoverTitle,
        content: popoverContent,
        trigger: 'click'
    });
});
