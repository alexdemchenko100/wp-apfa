jQuery(document).ready(() => {
	const noticeBar = $('#noticebar');
	const closeBar = noticeBar.find('.js-close-bar');

	if ((noticeBar.length > 0) && (localStorage.getItem("noticeState") !== "hide")) {
		$('body').addClass('noticebar-open');
		setTimeout(function () {
			noticeBar.slideDown();
		}, 1000);
	}

	closeBar.click(function () {
		noticeBar.slideUp();
		$('body').removeClass('noticebar-open');
		localStorage.setItem("noticeState", "hide");
	});
});
