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



    // show-guest-mobile-click description

    let clickDescription = $('#plus-description');
    let dropdownDescription = $('#dropdown-description');

    clickDescription.click( () => {
        dropdownDescription.slideToggle();

        if ( clickDescription.hasClass("fa-plus-circle") ) {
            clickDescription.removeClass("fa-plus-circle").addClass("fa-minus-circle");
        } else { 
            clickDescription.removeClass("fa-minus-circle").addClass("fa-plus-circle"); 
        }
    })

    // show-guest-mobile-click service

    let clickService = $('#plus-service');
    let dropdownService = $('#dropdown-service');

    clickService.click( () => {
        dropdownService.slideToggle();

        if ( clickService.hasClass("fa-plus-circle") ) {
            clickService.removeClass("fa-plus-circle").addClass("fa-minus-circle");
        } else { 
            clickService.removeClass("fa-minus-circle").addClass("fa-plus-circle"); 
        }
    })

    // show-guest-mobile-click reviews

    let clickReviews = $('#plus-reviews');
    let dropdownReviews = $('#dropdown-reviews');

    clickReviews.click( () => {
        dropdownReviews.slideToggle();

        if ( clickReviews.hasClass("fa-plus-circle") ) {
            clickReviews.removeClass("fa-plus-circle").addClass("fa-minus-circle");
        } else { 
            clickReviews.removeClass("fa-minus-circle").addClass("fa-plus-circle"); 
        }
    })

    // button form-reviews
    let btnReviews = $('#btn-reviews');
    let boxReviews = $('#box-reviews');

    let btnReviewsDesktop = $('#btn-reviews-desktop');
    let boxReviewsDesktop = $('#box-reviews-desktop');


    btnReviews.click( () => {
        // boxReviews.fadeToggle("slow");
        boxReviews.slideToggle("slow");
    })

    btnReviewsDesktop.click( () => {
        // boxReviews.fadeToggle("slow");
        boxReviewsDesktop.slideToggle("slow");
    })



    ////////////////// Search functionality

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
    
    ////////////////// Search functionality  [ END ]
})

