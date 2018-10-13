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
var isMobile = false;

// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
}

$(document).ready(function() {

    //#############################################################
    // INIT!
    //#############################################################
    (function init() {
        !isMobile ? checkHighestDiv() : ""; // if mobile is false > execute highest div function.
    })()

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

    //#############################################################
    // Making homepage most recent news and most recent recipe equal heights

    function resetHeight() {
        var blogPosts = document.querySelectorAll('.nieuws-recepten .single-blog-post');
        for(var i=0;i<blogPosts.length;i++) {
            $(blogPosts[i]).css('height', "auto");
        }
        checkHighestDiv();
    }

    function checkHighestDiv() {
        var blogPosts = document.querySelectorAll('.nieuws-recepten .single-blog-post');
        var highest = 0;

        $.each(blogPosts, function(post) {
            if(parseInt($(this).css('height')) > highest) {
                highest = $(this).css('height');
            }
        })

        for(var i=0;i<blogPosts.length;i++) {
            $(blogPosts[i]).css('height', highest);
        }
    }

    if($('.nieuws-recepten').length > 0 && !isMobile) { // if we're on mobile, since otherwise it's not necessary
        var resizeTimer = 500;
        $(window).resize(function() {
            clearTimeout(resizeTimer)
            resizeTimer = setTimeout(resetHeight, resizeTimer);
        });
    }
    //#############################################################
})