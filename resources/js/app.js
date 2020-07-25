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
    

  
    // dropDownSearchButton.click(() => {
    //      wdropDownFilter.slideUp();
    //      filterShowButtonIcon.removeClass('fa-minus-circle').addClass('fa-plus-circle');
    // });

    // $(window).resize(function() {
    //     console.log(document.body.clientWidth + ' wide by ' + document.body.clientHeight+' high');
        

    //     if ( document.body.clientWidth < 992 ) {
    //          dropDownSearchButton.click(() => {
    //              dropDownFilter.slideUp();
    //              filterShowButtonIcon.removeClass('fa-minus-circle').addClass('fa-plus-circle');
    //         });
    //     } 
        
    // });

    ////////////////// Search functionality  [ END ]
    ///// SUBMIT BUTTON

})

