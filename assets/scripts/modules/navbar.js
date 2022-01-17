// Prevent closing from click inside dropdown
$(document).on('click', '.dropdown-menu', function (e) {
	e.stopPropagation();
});

function extraUrlCondition() {

	const disableLink = $('#primary-menu .menu-item a[href*="#"]');
	const disabledForClick = disableLink.closest('li').children('a');

	disabledForClick.addClass("disabled");

	$('.menu-item-has-children > a').on('click', function (event) {
		if ($(this).attr('href') !== '#') {
			event.preventDefault();
			window.location.href = $(this).attr('href');
		} else {
			event.preventDefault();
		}
	});

	const elForClick = $('.caret');
	const backClick = $('.caret-back');

	$(elForClick).on('click', function (event) {
		if ($(window).width() < 992) {
			event.preventDefault();

			const linkEl = $(this).closest('.menu-item').children('a').text();
			const containerEl = $(this).siblings('.dropdown-menu');
			const targetEl = containerEl.find('.caret-back span');

			$(this).closest('.menu-item').children('a').toggleClass('show-sub');
			$(this).siblings('.dropdown-menu').toggleClass('show');
			targetEl.text(linkEl);
		}
	});

	$(backClick).on('click', function (event) {
		if ($(window).width() < 992) {
			event.preventDefault();

			$(this).siblings('.sub-title').remove();
			$(this).closest('.menu-item').children('a').toggleClass('show-sub');
			$(this).closest('.dropdown-menu').toggleClass('show');
		}
	});

}

function extraNavClasses() { //? delete

	$('.dropdown-menu.nested').each(function () {
		$(this).closest('.dropdown-menu.first').addClass('first--row');
	});
}

function menuItemsTitle() {

	const menuItems = $('#primary-menu').children('.menu-item-has-children');

	menuItems.each(function () {
		const linkEl = $(this).children('a').text();
		const containerEl = $(this).children('.dropdown-menu');
		$(containerEl).prepend(`<h3 class='sub-title'>${linkEl}</h3>`);
	});
}

function addMarker() {

	const menuEl = $('#primary-menu');

	$(menuEl).prepend(`<div id='marker'></div>`);
}

function openNav() {
	const marker  = $('#marker');
	const header  = $('header');
	const navEl   = $('#primary-menu');
	const navItem = $('#primary-menu > li');
	const defItem = navItem.first().children('a').children('.nav-text'); //default item

	let defLeftPos =  defItem.offset().left + 3;
	let defWidth   =  defItem.outerWidth();

	marker.css({
		'transform' : `translateX(${defLeftPos}px)`,
		'width' : defWidth,
	});

	navItem.each(function () {
		const targetEl = $(this).children('a').children('.nav-text');
		let targetWidth = targetEl.outerWidth();
		let targetLeft = targetEl.offset().left + 3;

		$(this).mouseenter(function () {
			if ($(window).width() >= 992) {
				header.addClass('open-nav');

				marker.css({
					'transform' : `translateX(${targetLeft}px)`,
					'width' : targetWidth,
				});
			}
		});
	});

	navEl.mouseleave(function () {
		header.removeClass('open-nav');
	});
}

extraUrlCondition();
extraNavClasses();
menuItemsTitle();
addMarker();
openNav();

$('.navbar-toggler').click(function () {
	let previousScrollY = 0;

	if (!$('#primaryNavBar').hasClass('show')) {
		$('#primaryNavBar').closest('.nav-primary').addClass('nav-show');
		$('.navbar-toggler').addClass('close-menu');
		$('.header').addClass('open');
		previousScrollY = window.scrollY;
		$('html').css({
			marginTop: -previousScrollY,
			overflow: 'hidden',
			left: 0,
			right: 0,
			top: 0,
			bottom: 0,
		});
		window.scrollTo(0, previousScrollY);
	} else {
		$('#primaryNavBar').closest('.nav-primary').removeClass('nav-show');
		$('.navbar-toggler').removeClass('close-menu');
		$('.header').removeClass('open');
		$('html').css({
			marginTop: 0,
			overflow: 'visible',
			left: 'auto',
			right: 'auto',
			top: 'auto',
			bottom: 'auto',
			position: 'static',
		});
		window.scrollTo(0, previousScrollY);
	}
});

$(window).resize(function () {
	openNav();

	const win = $(this);
	if (win.width() >= 992) {
		$('#primaryNavBar').removeClass('show');
		$('#primaryNavBar').closest('.nav-primary').removeClass('nav-show');
		$('.navbar-nav').find('.menu-item.show').removeClass('show');
		$('.dropdown-menu').removeClass('show').removeAttr('style');
		$('.caret').removeClass('active');
		$('.navbar-toggler').removeClass('close-menu');
		$('.header').removeClass('open');
		$('html').css({
			marginTop: 0,
			overflow: 'visible',
			left: 'auto',
			right: 'auto',
			top: 'auto',
			bottom: 'auto',
			position: 'static',
		});
	} else {
		$('header').removeClass('open-nav');
	}
});

$('.nav-search .icon-search').on('click', function () {
	$(this).hide();
	$('.nav-search .icon-close').show();
	$('.search-popup').show();
	$('main').hide();
	$('.navbar-toggler-wrap').hide();
});

$('.nav-search .icon-close').on('click', function () {
	$(this).hide();
	$('.nav-search .icon-search').show();
	$('.search-popup').hide();
	$('main').show();
	$('.navbar-toggler-wrap').show();
});


$('.header__btns .icon-search').on('click', function () {
	$(this).hide();
	$('.header__btns .icon-close').show();
	$('.search-popup').show();
	$('main').hide();
	$('.navbar-toggler-wrap').hide();
});

$('.header__btns .icon-close').on('click', function () {
	$(this).hide();
	$('.header__btns .icon-search').show();
	$('.search-popup').hide();
	$('main').show();
	$('.navbar-toggler-wrap').show();
});

$('.search-popup-box-close').on('click', function() {
	$('.search-popup-input').val('');
	$(this).hide();
	$('.search-popup-result').hide();
	$('.search-popup-down-arrow').hide();
})

function fetchData(page, value) {
	fetch('/page/' + page + '/?s=' + value)
		.then(response => response.text())
		.then(html => {
			var parser = new DOMParser();
			var doc = parser.parseFromString(html, 'text/html');
			$('.search-popup-result').show();
			$('.search-popup-down-arrow').show();
			var search_count = $(doc).find('article').length;
			if (search_count > 0) {
				$('.search-popup-result-right').html($(doc).find('#main').html());
				$('.search-popup .page-numbers').click(function(e) {
					e.preventDefault();
					var page = $(this).html();
					var value = $('.search-popup-input').val();
					fetchData(page, value);
				})
			} else {
				$('.search-popup-result-right').html('<div class="text-center empty">No result</div>');
			}
		});
}

$('.search-popup-input').on('input', function(e) {
	var value = e.target.value;
	if (value) {
		$('.search-popup-box-close').show();
		$('.search-keyword').html("'" + value + "'");
		fetchData(1, value);
	}
})
