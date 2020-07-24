require('./bootstrap');

import $ from 'jquery';

$(document).ready(function(){

    let menuIcon = $('#menu-icon');
    let subMenu  = $('#sub-menu');

    menuIcon.click( () => {
        subMenu.slideToggle();

        if ( menuIcon.hasClass("fa-bars") ) {
            menuIcon.removeClass("fa-bars").addClass("fa-times");
        } else { 
            menuIcon.removeClass("fa-times").addClass("fa-bars"); 
        }
    })

    ///// SUBMIT BUTTON

})

