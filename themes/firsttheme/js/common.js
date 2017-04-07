// javascript

$(document).ready(function($) {
	console.log(navigator.userAgent.toLowerCase());

	$('a.menu-btn').click(function() {
		$('#top-menu').slideToggle('fast');
		$('a.menu-btn').toggleClass('opened');
		$('body').toggleClass('fixed');
		return false;
	});

	$('a.close-btn').click(function() {
		$('#top-menu').slideToggle('fast');
		$('a.menu-btn').removeClass('opened');
		$('body').removeClass('fixed');
		return false;
	});

	$('.main-menu > ul > li.menu-item-has-children > .sub-menu').append('<li class="sub-close">CLOSE</li>');
	$('.main-menu > ul > li.menu-item-has-children > .sub-menu > .sub-close').click(function() {
		$(this).parent().slideToggle('fast');
	});

	$('.main-menu li.menu-item-has-children').hover(
		function() {
			if (window.matchMedia("screen and (min-width:641px)").matches) {
				$(this).children('.sub-menu').css('padding-left', $(this).offset().left);
				$(this).children('.sub-menu').slideDown('fast');
			}
		},
		function() {
			if (window.matchMedia("screen and (min-width:641px)").matches) {
				$(this).children('.sub-menu').slideUp('fast');
				// $(this).children('.sub-menu').css('padding-left', '');
			}
		}
	);

	$('.main-menu > ul > li.menu-item-has-children > a').click(function() {
		if (window.matchMedia("screen and (max-width:640px)").matches) {
			$(this).parent().children('.sub-menu').slideToggle('fast');
			return false;
		} else {
			return false;
		}
	});
});

/* 
 * ページ内スクロール
 */
function pScroll(loc) {
	if (typeof loc === 'undefined') {
		p = 0;
	} else if (typeof loc === 'number') {
		p = loc;
	} else {
		p = $(loc).offset().top;
	}

	$('html,body').animate({ scrollTop: p }, 'fast');
}
