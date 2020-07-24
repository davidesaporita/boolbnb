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

    let filterShowButton = $('#filterTitle');
    let filterShowButtonIcon = $('#filterShowButtonIcon');
    let dropDownFilter = $('#dropDownFilter');
    let dropDownSearchButton = $('#button-search');
    filterShowButton.click( () => {
        dropDownFilter.slideToggle();

        if ( filterShowButtonIcon.hasClass('fa-plus-circle') ) {
            filterShowButtonIcon.removeClass('fa-plus-circle').addClass('fa-minus-circle');
        } else {
            filterShowButtonIcon.removeClass('fa-minus-circle').addClass('fa-plus-circle');
        }
    })

    dropDownSearchButton.click(() => {
        dropDownFilter.slideUp();
    });
    ///// SUBMIT BUTTON

})

