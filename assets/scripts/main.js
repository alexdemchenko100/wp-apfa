// import external dependencies
import AOS from 'aos'
import "jquery"

// Import everything from autoload
import "./autoload/**/*"
import "./modules/navbar";
import "./modules/scroll-down";
import "./modules/faq";
import "./modules/gradient";
import "./modules/noticebar";
import "./modules/parallax";
import sliders from "./modules/slider"

jQuery(document).ready(() => {
	sliders.init();

	//add class to the last .ob block
	$('.ob').last().addClass('last');

	AOS.init();
});
