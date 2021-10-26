jQuery(document).ready(() => {

	$(".js-scroll-down").click(function(e) {
		e.preventDefault();

		const cls = $(this).closest("section").next().offset().top;
		$("html, body").animate({scrollTop: cls}, "slow");
	});
});
