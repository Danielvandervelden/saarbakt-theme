let $ = jQuery;
let pageWrapper = $('.page-wrapper');
let adminBar;
let body = $('body');
let counter = 0;
let burgerMenu = $('.mobile-menu-icon');
let exitIcon = $('.exit');
let searchIcon = $('.search-icon');
let searchDiv = $('.search-overlay');
let inputField = $('.search-term');
let exitSearch = document.getElementById('search-close')
let mobileMenuDiv = $('#mobile-menu');
let saarBaktLogo = $('.saarbaktlogo');
let navBar = document.getElementById('nav-bar');
let sticky = navBar.getBoundingClientRect().top;
let headerContainer = $('.header-container');
let scroll = window.scrollY;
let subMenu = $('.sub-menu');
let listList = document.getElementsByClassName('menu-item-object-page');

//check for wp-aminbar on the page
function init() {
	setTimeout(function() {
		if($(body).hasClass('logged-in')) {
			console.log('Welkom, Sara. (of Daniel)');
		} else if(counter < 10) {
			init();
			counter = counter + 1;
			console.log("checking for logged in..." + counter);
		}

	}, 250)

	if($(body).hasClass('archive')) { // HAXXXXXXXXXXXXXXXXXX
		$('.headertext:first').remove();
	}

	if($(body).hasClass('blog')) { // HAXXXXXXXXXXXXXXXXXX
		$('.textheaderpaginasingle').text('Recepten');
	}
	if($(body).hasClass('home')) {
		$(headerContainer).addClass('bigger-header');
		$(saarBaktLogo).addClass('bigger-header');
	} else {
		$(headerContainer).removeClass('bigger-header');
		$(saarBaktLogo).removeClass('bigger-header');

	}

	$('#menu-headermenu').addClass('clearfix');
	stickyMenu(); // when page loads we wanna execute this function. Because if you're scrolled you won't see the menu untill you scroll up or down and it gets executed by the on scroll listener.
}

init();

window.onscroll = debounce(stickyMenu, 30); // Sticky menu scroll eventlistener.

$(burgerMenu).on("click", function() {
	if($(body).hasClass('logged-in')) {
			$(mobileMenuDiv).addClass('wp-bar-evasion');
		}
	$(mobileMenuDiv).addClass('menu-left').removeClass('menu-right');
	$(navBar).addClass('move-up').removeClass('from-top');
	noDisplay(mobileMenuDiv);
	noDisplay(navBar);
	setTimeout(function() {
		$(saarBaktLogo).addClass("sticky-fix");
	}, 300)

});

$(exitIcon).on("click", function() {
		$(mobileMenuDiv).removeClass('menu-left').addClass('menu-right');
		$(navBar).addClass('from-top').removeClass('move-up');

		if(window.pageYOffset > 0 === false) { //check if window is already scrolled, bcause then you don't want to remove the sticky-fix.
			$(headerContainer).removeClass("sticky-fix");
		}
		noDisplay(mobileMenuDiv);
		noDisplay(navBar);
});

$(searchIcon).on("click", function() {
	if($(body).hasClass('logged-in')) {
			$(searchDiv).addClass('wp-bar-evasion');
		}
	$(body).addClass('no-scroll');
	$(searchDiv).addClass('full-opacity');
	$(searchDiv).removeClass('no-opacity');
	setTimeout(function() {
		$(inputField).focus();
	}, 50)
	noDisplay(searchDiv);
});

$(exitSearch).on("click", function() {
	$(searchDiv).removeClass('full-opacity');
	$(searchDiv).addClass('no-opacity');
	$(body).removeClass('no-scroll');

	noDisplay(searchDiv);
})

function noDisplay(element) {
	if ($(element).hasClass('no-display')) {
		$(element).removeClass('no-display');
	} else {
		setTimeout(function() {
			$(element).addClass('no-display');
		}, 300);
	}
}

function stickyMenu() {

	sticky = navBar.getBoundingClientRect().top;
	if (window.pageYOffset > sticky) {
		if($(body).hasClass('logged-in')) {
				$(navBar).addClass('wp-bar-evasion');
			}
	$(navBar).addClass("sticky from-top");
	$(saarBaktLogo).addClass("sticky-fix");
 } else {
	 $(navBar).removeClass("sticky from-top");
	 $(saarBaktLogo).removeClass("sticky-fix");
	 $(navBar).removeClass('wp-bar-evasion');
 }
}

function debounce(fn, wait) {
	var timeout;
	return function() {
		var ctx = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
		    fn.apply(ctx, args);
		}, wait || 100);
	};
};

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
            this.resultsDiv.html('<div class="spinner-loader"></div>');
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
              <h2 class="header-l">Posts & Paginas</h2>
                ${results.generalInfo.length ? '<ul class="search-results__list"' : '<p>Geen zoekresultaten gevonden..</p>'}
                ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a></li> <div>${item.excerpt}</div> <hr class="footerlijn">`).join('')}
                ${results.generalInfo.length ? '</ul>' : ''}
              </div>

              <div class="two-third">
              <h2 class="header-l">Nieuwtjes</h2>
                ${results.allenieuwtjes.length ? '<ul class="search-results__list"' : '<p>Geen zoekresultaten gevonden..</p>'}
                ${results.allenieuwtjes.map(item => `<li><a href="${item.permalink}">${item.title}</a></li> <div>${item.excerpt}</div> <hr class="footerlijn">`).join('')}
                ${results.allenieuwtjes.length ? '</ul>' : ''}
              </div>

              <div class="three-third">
              <h2 class="header-l">Tips & Tricks</h2>
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


