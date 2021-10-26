let faqBlock = $('.faq-item ');
let faqHiddenElement = $('.faq-item > .faq-item__hidden');
let faqShownElement = $('.faq-item > .faq-item__shown');

faqHiddenElement.slideUp();

faqShownElement.click(function () {
	if ($(this).parent().hasClass('faq-item_open')) {
		faqHiddenElement.slideUp();
		faqBlock.removeClass('faq-item_open');
		$(this).next().slideUp();
		return false;
	} else {
		faqHiddenElement.slideUp();
		faqHiddenElement.next().show();
		$(this).parent().siblings().removeClass('faq-item_open');
		$(this).next().slideDown();
		$(this).parent().addClass('faq-item_open');
		return false;
	}
});
