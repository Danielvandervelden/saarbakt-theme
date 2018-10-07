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
let url = window.location.origin + '/wp-json/search?term=';
let timeout = null;
let loader = false;

console.log(url);

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
        $('body').addClass('no-scroll');
    });

    $(searchClose).click(function() {
        setTimeout(function() {$(searchInput).val('')}, 300);
        $(searchDiv).fadeOut();
        $('body').removeClass('no-scroll');
    });

    class Search {

        //1. Describe and create the object.
        constructor() {
            this.resultsDiv = $("#search-overlay__results");
            this.openButton = $(".search-icon-fa");
            this.closeButton = $(".search-overlay__close");
            this.searchOverlay = $(".search-overlay");
            this.searchField = $("#search-term");
            this.events();
            this.isOverlayOpen = false;
            this.isSpinnerVisible = false;
            this.previousValue;
            this.typingTimer;
        }
    
        //2. events
        events() {
            this.searchField.on("keyup", this.typingLogic.bind(this));
        }
    
    
    
        //3. methods (function, action..)
    
        typingLogic() {
            if (this.searchField.val() != this.previousValue) {
                clearTimeout(this.typingTimer);
    
                if (this.searchField.val()) {
                    if (!this.isSpinnerVisible) {
                this.resultsDiv.html(spinner);
                this.isSpinnerVisible = true;
            }
                this.typingTimer = setTimeout(this.getResults.bind(this), 1000);
                } else {
                    this.resultsDiv.html('');
                    this.isSpinnerVisible = false;
                }
            }
                    this.previousValue = this.searchField.val();
        }
        
         getResults() {
            $.getJSON(saarbaktData.root_url + '/wp-json/saarbakt/search?term=' + this.searchField.val(), (results) => {
                this.resultsDiv.html(`
                    <div class="search-overlay__results">
                        <div class="one-third">
                        <h2>Posts & Paginas</h2>
                            ${results.generalInfo.length ? '<ul class="search-results__list"' : '<p>Geen zoekresultaten gevonden..</p>'}
                            ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a></li> <div>${item.excerpt}</div> <hr class="footerlijn">`).join('')}
                            ${results.generalInfo.length ? '</ul>' : ''}
                        </div>
            
                        <div class="one-third">
                        <h2>Nieuwtjes</h2>
                            ${results.allenieuwtjes.length ? '<ul class="search-results__list"' : '<p>Geen zoekresultaten gevonden..</p>'}
                            ${results.allenieuwtjes.map(item => `<li><a href="${item.permalink}">${item.title}</a></li> <div>${item.excerpt}</div> <hr class="footerlijn">`).join('')}
                            ${results.allenieuwtjes.length ? '</ul>' : ''}
                        </div>
            
                        <div class="one-third">
                        <h2>Tips & Tricks</h2>
                            ${results.alletipstricks.length ? '<ul class="search-results__list"' : '<p>Geen zoekresultaten gevonden..</p>'}
                            ${results.alletipstricks.map(item => `<li><a href="${item.permalink}">${item.title}</a></li> <div>${item.excerpt}</div> <hr class="footerlijn">`).join('')}
                            ${results.alletipstricks.length ? '</ul>' : ''}
                        </div>
                    </div>
                    `);
                this.isSpinnerVisible = false;
            });
        }
        
        }
        
        var search = new Search();


    //#############################################################
})