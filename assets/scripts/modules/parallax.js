import {gsap} from "gsap";
import {ScrollToPlugin} from "gsap/ScrollToPlugin";
import {ScrollTrigger} from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);


jQuery(document).ready(() => {
	function gsapParallax() {
		gsap.utils.toArray(".section-parallax").forEach((section) => {
			section.bg = section.querySelector(".parallax-content");

			section.bg.style.backgroundPosition = `0% ${-innerHeight / 15}px`;

			gsap.to(section.bg, {
				backgroundPosition: `0% ${innerHeight / 25}px`,
				ease: "none",
				scrollTrigger: {
					trigger: section,
					scrub: true,
				},
			});
		});
	}
	function gsapTop() {
		gsap.utils.toArray(".gsap-top").forEach((section) => {
			gsap.to(section, {
				yPercent: -20,
				ease: "none",
				scrollTrigger: {
					trigger: section,
					start: "top bottom",
					//end: "bottom top",
					scrub: true,
				},
			});
		});
	}

	if ($( window ).width() >1200 ) {
		gsapParallax();
		gsapTop();
	}

});
