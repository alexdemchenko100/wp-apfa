let siteBody = $('body');
let block = $('.multiple-info');
let social = $('.social-media');
let faq = $('.faq');
let sponsors = $('.sponsors');
let agenda = $('.agenda');
let intro = $('.intro');
let resources = $('.resources-list');
let blockGradient = $('.js-change');


$(window).scroll(function() {
	blockGradient.each(function () {
		let topOfElement = $(this).offset().top + $(this).outerHeight()/2;
		let bottomOfElement = $(this).offset().top + $(this).outerHeight()/2;
		let bottomOfScreen = $(window).scrollTop() + $(window).innerHeight();
		let topOfScreen = $(window).scrollTop();

		if (bottomOfScreen >= topOfElement && $(this).hasClass('js-change-bg-before')){
			if (!siteBody.hasClass('body-green')) {
				siteBody.addClass('body-green')
				block.addClass('section-bg-green')
				faq.addClass('section-bg-green')
				sponsors.addClass('section-bg-green')
				intro.addClass('section-bg-green')
				resources.addClass('section-bg-green')
				agenda.addClass('section-bg-green')
				social.addClass('green')
				$(this).addClass('current-gradient')
			}
		}

		if (bottomOfScreen < topOfElement && $(this).hasClass('js-change-bg-before') && $(this).hasClass('current-gradient')){
			if (siteBody.hasClass('body-green')) {
				siteBody.removeClass('body-green')
				block.removeClass('section-bg-green')
				faq.removeClass('section-bg-green')
				sponsors.removeClass('section-bg-green')
				agenda.removeClass('section-bg-green')
				resources.removeClass('section-bg-green')
				intro.removeClass('section-bg-green')
				social.removeClass('green')
				$(this).removeClass('current-gradient')
			}
		}

		if (topOfScreen >= bottomOfElement && $(this).hasClass('js-change-bg-after')){
			if (siteBody.hasClass('body-green')) {
				siteBody.removeClass('body-green')
				block.removeClass('section-bg-green')
				faq.removeClass('section-bg-green')
				sponsors.removeClass('section-bg-green')
				resources.removeClass('section-bg-green')
				intro.removeClass('section-bg-green')
				agenda.removeClass('section-bg-green')
				social.removeClass('green')
			}
		}
	})
});


