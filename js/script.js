/*
|------------------------------------------------------------
| All Javascript for the website.
|------------------------------------------------------------
*/

let $ = jQuery;
let mainMenu = $('#menu-headermenu');
let mobileMenuIcon = $('.mobile-menu-icon');
let searchIcon = $('.search-icon');
let searchDiv = $('.search-overlay');
let searchClose = $('#search-close');
let searchInput = $('.search-term');
let searchTerm;
let spinner = $('<div class="spinner"><div class="cube1"></div><div class="cube2"></div></div>');
let timeout = null;
let loader = false;

$(document).ready(function() {
    //#############################################################
    // All javascript for the menu
    
    // Clone the regular menu into the mobile menu.
    $(mainMenu).clone().appendTo('#mobile-menu');

    // Grab all the menu items that have children
    let menuItemHasChildren = $('#mobile-menu .menu-item-has-children');

    // Put an event listener on each one of them.
    $.each(menuItemHasChildren, function() {
        $(this).click(function() {
            $(this).toggleClass('active');
            $(this).children('ul.sub-menu').slideToggle();
        })
    })

    // Event listener on the mobile menu icon
    $(mobileMenuIcon).click(function() {
        console.log('clicked');
        $('#mobile-menu').addClass('active');
        $('#backdrop').addClass('active');
        $('html').addClass('no-scroll');
    })

    // Event listener on the exit icon
    $('.exit').click(function() {
        $('#mobile-menu').removeClass('active');
        $('#backdrop').removeClass('active');
        $('html').removeClass('no-scroll');
    })

    // Event listener on the entire page, but stop it on the mobile menu
    $('#backdrop').click(function() {
        $('#mobile-menu').removeClass('active');
        $('#backdrop').removeClass('active');
        $('html').removeClass('no-scroll');
    })

    //#############################################################

    //#############################################################
    // All Javascript for the search!

    $(searchIcon).click(function(e) {
        $(searchDiv).fadeIn();
        $(searchInput).focus();
    });

    $(searchClose).click(function() {
        setTimeout(function() {$(searchInput).val('')}, 300);
        $(searchDiv).fadeOut();
    });

    $(searchInput).on('input', function(e) {
        clearTimeout(timeout);
        if(!loader) {
        $('.search-container').append(spinner);
        }
        loader = true;

        timeout = setTimeout(function() {
            searchTerm = e.target.value;
            console.log(searchTerm);
            $(spinner).remove();
            loader = false;
        }, 500);
    })

    //#############################################################
})