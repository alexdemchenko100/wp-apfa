import Swiper, {Navigation, Autoplay, EffectFade, Pagination} from 'swiper'
Swiper.use([Navigation, Autoplay, EffectFade, Pagination])

const
	sliders = {
		init: function () {
			let resourcesLinkSlider = $('.resources .swiper-container');
			let afpaSlider = $('.afpa .swiper-container');
			let multipleSlider = $('.multiple-info .swiper-container');
			// let sponsorSlider = $('.sponsor-item .swiper-container');

            if (resourcesLinkSlider.length > 0) {
                resourcesLinkSlider.each(function () {
                    let resourcesLinkSwiper = new Swiper(this, {
                        slidesPerView: 'auto',
                        loop: false,
						allowTouchMove: true,
                        breakpoints: {
                            200: {
                                loop: false,
								allowTouchMove: true,
                            },
                            768: {
                                slidesPerView: '3',
                                loop: false,
                            },
                            992: {
                                slidesPerView: '3',
                                loop: false,
								navigation: {
									nextEl: '.swiper-button-next',
									prevEl: '.swiper-button-prev',
								},
                            },

                            1600: {
                                slidesPerView: '4',
                                loop: false,
								navigation: {
									nextEl: '.swiper-button-next',
									prevEl: '.swiper-button-prev',
								},
                            },

							2400: {
                                slidesPerView: 'auto',
                                loop: false,
								navigation: {
									nextEl: '.swiper-button-next',
									prevEl: '.swiper-button-prev',
								},
                            },
                        },
                    });

                    resourcesLinkSwiper.init();
                });
            }

			if (afpaSlider.length > 0) {
				afpaSlider.each(function () {
					let afpaSlider = new Swiper(this, {
						slidesPerView: 'auto',
						spaceBetween: 16,
						autoplayDisableOnInteraction: true,
						centeredSlides: false,
						allowTouchMove: true,
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},
						breakpoints: {
							768: {
								spaceBetween: 24,
							},
							1920: {
								spaceBetween: 32,
							},
						},
					});

					afpaSlider.init();
				});
			}

			if (multipleSlider.length > 0) {
				multipleSlider.each(function () {
					let multipleSlider = new Swiper(this, {
						slidesPerView: "auto",
						spaceBetween: 16,
						autoplayDisableOnInteraction: true,
						centeredSlides: false,
						allowTouchMove: true,
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},
						breakpoints: {
							768: {
								spaceBetween: 24,
							},
							1920: {
								spaceBetween: 32,
							},
						},
					});

					multipleSlider.init();
				});
			}

			// if (sponsorSlider.length > 0 && $( window ).width() > 560 ) {
			// 	sponsorSlider.each(function () {
			// 		let sponsorSlider = new Swiper(this, {
			// 			slidesPerView: "auto",
			// 			spaceBetween: 16,
			// 			autoplayDisableOnInteraction: true,
			// 			centeredSlides: false,
			// 			allowTouchMove: true,
			// 			navigation: {
			// 				nextEl: '.swiper-button-next',
			// 				prevEl: '.swiper-button-prev',
			// 			},
			// 			breakpoints: {
			// 				768: {
			// 					slidesPerView: 'auto',
			// 					spaceBetween: 24,
			// 					allowTouchMove: true,
			// 					navigation: {
			// 						nextEl: '.swiper-button-next',
			// 						prevEl: '.swiper-button-prev',
			// 					},
			// 				},
			// 				1920: {
			// 					slidesPerView: 'auto',
			// 					spaceBetween: 32,
			// 					allowTouchMove: true,
			// 					navigation: {
			// 						nextEl: '.swiper-button-next',
			// 						prevEl: '.swiper-button-prev',
			// 					},
			// 				},
			// 			},
			// 		});

			// 		sponsorSlider.init();
			// 	});
			// }
		},
	};

export default sliders
