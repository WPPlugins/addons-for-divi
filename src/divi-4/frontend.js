// jQuery(function ($) {
// 	var newsTicker = $('.dtq-news-tricker');
// 	if (newsTicker && newsTicker.length > 0) {
// 		newsTicker.each(function () {
// 			var _width = $(this).find('#parent').width();
// 			$(this).get(0).style.setProperty(`--width`, `${_width}px`);
// 		});
// 	}

// 	var scrollImage = $('.dtq-scroll-image');
// 	if (scrollImage && scrollImage.length > 0) {
// 		scrollImage.each(function () {
// 			var _img = $(this).find('.dtq-scroll-image-el');
// 			var _dir_hover = $(this).data('dir-hover');
// 			var _dir_scroll = $(this).data('dir-scroll');
// 			if (_dir_hover !== 'none') {
// 				var operator = '';
// 				var offset =
// 					_dir_hover[0] === 'X'
// 						? parseInt(_img.width()) - parseInt($(this).width())
// 						: parseInt(_img.height()) - parseInt($(this).height());
// 				if (parseInt(offset) < 1) {
// 					offset = 0;
// 				}
// 				if (_dir_hover === 'X_rtl' || _dir_hover === 'Y_btt') {
// 					operator = '-';
// 				}

// 				$(this).on('mouseenter', function () {
// 					_img.css(
// 						'transform',
// 						'translate' +
// 							_dir_hover[0] +
// 							'(' +
// 							operator +
// 							offset +
// 							'px)'
// 					);
// 				});

// 				$(this).on('mouseleave', function () {
// 					_img.css(
// 						'transform',
// 						'translate' + _dir_hover[0] + '(0px)'
// 					);
// 				});
// 			}

// 			if (_dir_scroll !== 'none') {
// 				var _overlay = $(this).find('.dtq-scroll-image-overlay');
// 				if (_dir_scroll === 'horizontal') {
// 					_overlay.css({
// 						width: _img.width(),
// 						height: _img.height(),
// 					});
// 				} else {
// 					_overlay.css({
// 						width: '100%',
// 						height: '100%',
// 					});
// 				}
// 			}
// 		});
// 	}

// 	let popupVideo = $('.dtq-popup-yt, .dtq-popup-vm');
// 	if (popupVideo && popupVideo.length > 0) {
// 		popupVideo.each(function () {
// 			let href = $(this).attr('href');
// 			let type = $(this).data('type');
// 			let source = $(this).data('source');
// 			let videoSource = '';

// 			if (type === 'vm') {
// 				let suffix = '';
// 				if (-1 === href.indexOf('?')) {
// 					suffix = '?autoplay=1';
// 				} else {
// 					suffix = '&autoplay=1';
// 				}

// 				if (-1 === href.indexOf('player')) {
// 					videoSource = '//player.vimeo.com/video/%id%' + suffix;
// 				} else {
// 					videoSource = href + suffix;
// 				}
// 			}

// 			$(this).magnificPopup({
// 				type: 'iframe',
// 				mainClass: 'mfp-fade',
// 				removalDelay: 160,
// 				preloader: false,
// 				fixedContentPos: false,
// 				iframe: {
// 					markup:
// 						'<div class="mfp-iframe-scaler">' +
// 						'<div class="mfp-close"></div>' +
// 						'<iframe class="mfp-iframe" frameborder="0" allow="autoplay" allowfullscreen></iframe>' +
// 						'</div>',
// 					patterns: {
// 						youtube: {
// 							index: 'youtube.com/',
// 							src: '//www.youtube.com/embed/%id%?autoplay=1',
// 						},
// 						vimeo: {
// 							index: 'vimeo.com/',
// 							id: '/',
// 							src: videoSource,
// 						},
// 					},
// 				},
// 				callbacks: {
// 					beforeOpen: function () {
// 						var triggerEl = $(this.st.el),
// 							order_class = triggerEl.data('order');
// 						$('body').addClass(
// 							`dtq-video-open dtq-video-popup-${order_class}`
// 						);
// 					},

// 					close: function () {
// 						var triggerEl = $(this.st.el),
// 							order_class = triggerEl.data('order');
// 						$('body').removeClass(
// 							`dtq-video-open dtq-video-popup-${order_class}`
// 						);
// 					},
// 				},
// 			});
// 		});
// 	}

// 	$('.dtq-popup-video').magnificPopup({
// 		type: 'inline',
// 		mainClass: 'mfp-fade',
// 		removalDelay: 100,
// 		closeOnContentClick: false,
// 		midClick: false,
// 		callbacks: {
// 			beforeOpen: function () {
// 				$('body').addClass('dtq-modal-open dtq-video-popup');
// 			},
// 			open: function () {
// 				var targetEl = $(this.st.el).data('mfp-src');
// 				$('.dtq-modal').addClass('open');
// 				$(`${targetEl} video`).trigger('play');
// 			},
// 			close: function () {
// 				var targetEl = $(this.st.el).data('mfp-src');
// 				$(`${targetEl} video`).trigger('pause');
// 				$('body').removeClass('dtq-modal-open dtq-video-popup');
// 				$('.dtq-modal').removeClass('open');
// 			},
// 		},
// 	});

// 	// Image Compare
// 	$('.dtq-image-compare').each(function () {
// 		var offsetpct = $(this).data('offsetpct'),
// 			moveonhover = $(this).data('moveonhover'),
// 			orientation = $(this).data('orientation'),
// 			beforelabel = $(this).data('beforelabel'),
// 			afterlabel = $(this).data('afterlabel'),
// 			overlay = $(this).data('overlay');

// 		$(this)
// 			.find('.dtq-image-compare-container')
// 			.twentytwenty({
// 				default_offset_pct: offsetpct,
// 				move_slider_on_hover: moveonhover === 'on' ? true : false,
// 				orientation: orientation,
// 				before_label: beforelabel,
// 				after_label: afterlabel,
// 				no_overlay: overlay === 'on' ? false : true,
// 				move_with_handle_only: false,
// 				click_to_move: true,
// 			});
// 	});

// 	// Tooltip Activation
// 	var tooltip = $('.dtq-tooltip');
// 	if (tooltip && tooltip.length > 0) {
// 		tippy('.dtq-tooltip', {
// 			trigger: 'mouseenter',
// 		});
// 	}

// 	// Module Link Click Reactivation
// 	// This will work if click event don't work or disabled by other action
// 	if (typeof et_link_options_data !== 'undefined') {
// 		et_link_options_data.forEach(function (el, i) {
// 			$(document).on(
// 				'click',
// 				`.${et_link_options_data[i].class}`,
// 				function () {
// 					window.open(
// 						et_link_options_data[i].url,
// 						et_link_options_data[i].target
// 					);
// 				}
// 			);
// 		});
// 	}

// 	// Popup
// 	$('.dtq-popup-front-mode').each(function () {
// 		let $target = $(this);
// 		let instance = null;
// 		let settings = $target.data('settings');
// 		instance = new window.baPopup($target, settings);
// 		instance.init();
// 	});

// 	// Alert Dismiss
// 	$('.dtq-alert-dismiss').each(function () {
// 		$(this).on('click', function () {
// 			$(this).parents('.ba_alert').fadeOut(400);
// 		});
// 	});

// 	// Counter.
// 	$('.dtq-counter .dtq-number-text').each(function (ignore, counter) {
// 		var counterUp = window.counterUp['default'];
// 		var waypoint = new Waypoint({
// 			element: $(this),
// 			handler: function () {
// 				counterUp(counter, {
// 					duration: 1000,
// 					delay: 16,
// 				});
// 				this.destroy();
// 			},
// 			offset: 'bottom-in-view',
// 		});
// 	});
// });

// jQuery(function ($) {
// 	$(document).ready(function () {
// 		// Set Image for different devices
// 		// function _set_image(selector, photo, photo_tablet, photo_phone) {
// 		// 	var _screen = $(document).width();
// 		// 	if (_screen < 768) {
// 		// 		if (photo_phone && photo_phone.length > 0) {
// 		// 			$(selector).attr('src', photo_phone);
// 		// 		}
// 		// 	} else if (_screen < 981 && _screen > 767) {
// 		// 		if (photo_tablet && photo_tablet.length > 0) {
// 		// 			$(selector).attr('src', photo_tablet);
// 		// 		}
// 		// 	} else {
// 		// 		$(selector).attr('src', photo);
// 		// 	}
// 		// }
// 		// var swapped_img_parent = $('.dtq-swapped-img-selector');
// 		// if (swapped_img_parent.length > 0) {
// 		// 	swapped_img_parent.each(function () {
// 		// 		var swapped_img = $(this).find('.dtq-swapped-img'),
// 		// 			img_schema = swapped_img.data('schema');
// 		// 		if (img_schema && typeof img_schema === 'object') {
// 		// 			var photo = img_schema['desktop'],
// 		// 				photo_hover = img_schema['hover'],
// 		// 				photo_tablet = img_schema['tablet'],
// 		// 				photo_phone = img_schema['phone'];
// 		// 			if (photo_hover && photo_hover.length > 0) {
// 		// 				$(this).on('mouseenter', function () {
// 		// 					console.log($(this));
// 		// 					$(swapped_img).attr('src', photo_hover);
// 		// 					$(swapped_img).addClass('dtq-img-hovered');
// 		// 				});
// 		// 				$(this).on('mouseleave', function () {
// 		// 					_set_image(
// 		// 						swapped_img,
// 		// 						photo,
// 		// 						photo_tablet,
// 		// 						photo_phone
// 		// 					);
// 		// 					$(swapped_img).removeClass('dtq-img-hovered');
// 		// 				});
// 		// 			}
// 		// 			_set_image(swapped_img, photo, photo_tablet, photo_phone);
// 		// 			if (
// 		// 				(photo_tablet && photo_tablet.length > 0) ||
// 		// 				(photo_tablet && photo_phone.length > 0)
// 		// 			) {
// 		// 				$(window).on('resize', function () {
// 		// 					_set_image(
// 		// 						swapped_img,
// 		// 						photo,
// 		// 						photo_tablet,
// 		// 						photo_phone
// 		// 					);
// 		// 				});
// 		// 			}
// 		// 		}
// 		// 	});
// 		// }
// 		// var ba_img_lightbox = $('.dtq-lightbox');
// 		// if (ba_img_lightbox) {
// 		// 	try {
// 		// 		ba_img_lightbox.magnificPopup({
// 		// 			type: 'image',
// 		// 			mainClass: 'mfp-with-zoom',
// 		// 			gallery: { enabled: false },
// 		// 			zoom: {
// 		// 				enabled: true,
// 		// 				duration: 300,
// 		// 				easing: 'ease-in-out',
// 		// 			},
// 		// 		});
// 		// 	} catch (e) {
// 		// 		return;
// 		// 	}
// 		// }
// 	});
// });

/**
 * Revamp Codebase
 *
 * @ver 4.0.0
 */
jQuery(function ($) {
	//  Image Swapper
	$('.dtq-swapped-img-selector').each(function () {
		const swappedImg = $(this).find('.dtq-swapped-img');
		const imgSchema = swappedImg.data('schema');

		if (imgSchema && typeof imgSchema === 'object') {
			updateImageSource(swappedImg, {
				desktop: imgSchema.desktop,
				tablet: imgSchema.tablet,
				phone: imgSchema.phone,
				hover: imgSchema.hover,
			});
		}
	});

	// Carousel Initialization
	$('.dtq-carousel').each(function () {
		const $this = $(this);
		const settings = $this.data('settings');
		const preSettings = {
			edgeFriction: 0.35,
			useTransform: true,
			touchThreshold: 600,
		};

		$this.slick(Object.assign(preSettings, settings));
	});

	// Lightbox Initialization
	$('.dtq-lightbox').magnificPopup({
		type: 'image',
		mainClass: 'mfp-with-zoom',
		gallery: { enabled: false },
		zoom: {
			enabled: true,
			duration: 300,
			easing: 'ease-in-out',
		},
	});

	// Animated Text Initialization
	$('.dtq-animated-text').each(function () {
		const $this = $(this);
		const settings = $this.data('settings');
		const target = $this.attr('id');
		const type = $this.data('type');
		const targetSelector = `#${target}`;

		switch (type) {
			case 'typed':
				new Typed(`${targetSelector} .dtq-typed-text`, settings);
				break;

			case 'tilt':
				$this.find('.dtq-animated-text-tilt').textillate(settings);
				console.log(settings);
				break;

			case 'slide':
				const $slides = $this.find('.dtq-animated-text-slide');
				const $firstSlide = $slides
					.find('li')
					.removeClass('text-in')
					.first()
					.addClass('text-in');

				setInterval(() => {
					const $activeText = $slides
						.find('.text-in')
						.addClass('text-out')
						.removeClass('text-in');
					const $nextText = $activeText.next('li');

					if ($nextText.length) {
						$nextText.addClass('text-in').removeClass('text-out');
					} else {
						$firstSlide.addClass('text-in').removeClass('text-out');
					}
				}, parseInt(settings.slide_gap));
				break;

			default:
				console.warn('Unsupported animation type:', type);
		}
	});

	// Before After Slider Initialization
	$('.dtq-image-compare').each(function () {
		var offsetpct = $(this).data('offsetpct'),
			moveonhover = $(this).data('moveonhover'),
			orientation = $(this).data('orientation'),
			beforelabel = $(this).data('beforelabel'),
			afterlabel = $(this).data('afterlabel'),
			overlay = $(this).data('overlay');

		$(this)
			.find('.dtq-image-compare-container')
			.twentytwenty({
				default_offset_pct: offsetpct,
				move_slider_on_hover: moveonhover === 'on',
				orientation: orientation,
				before_label: beforelabel,
				after_label: afterlabel,
				no_overlay: overlay !== 'on',
				move_with_handle_only: false,
				click_to_move: true,
			});
	});

	// News Ticker Initialization
	const newsTicker = $('.dtq-news-tricker');
	if (newsTicker && newsTicker.length > 0) {
		newsTicker.each(function () {
			var _width = $(this).find('#parent').width();
			$(this).get(0).style.setProperty(`--width`, `${_width}px`);
		});
	}

	// Counter Initialization
	$('.dtq-counter .dtq-number-text').each(function (ignore, counter) {
		const counterUp = window.counterUp['default'];
		counterUp(counter, {
			duration: 5000,
			delay: 16,
		});
	});

	// Scroll Image Initialization
	$('.dtq-scroll-image').each(function () {
		applyScrollImageEffect($(this));
	});

	// Video Modal Initialization
	const popupVideo = $('.dtq-popup-yt, .dtq-popup-vm');

	if (popupVideo.length > 0) {
		popupVideo.each(function () {
			if ($(this).data('popup-initialized')) return;
			$(this).data('popup-initialized', true);

			const href = $(this).attr('href');
			const type = $(this).data('type');
			let videoSource = '';

			if (type === 'vm') {
				const suffix = href.includes('?')
					? '&autoplay=1'
					: '?autoplay=1';
				if (href.includes('player')) {
					videoSource = href + suffix;
				} else {
					const videoId = href.split('/').pop();
					videoSource = `//player.vimeo.com/video/${videoId}${suffix}`;
				}
			}

			$(this).magnificPopup({
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 140,
				preloader: true,
				fixedContentPos: false,
				iframe: {
					markup: `
                    <div class="mfp-iframe-scaler">
                        <div class="mfp-close"></div>
                        <iframe class="mfp-iframe" frameborder="0" allow="autoplay" allowfullscreen></iframe>
                    </div>
                `,
					patterns: {
						youtube: {
							index: 'youtube.com/',
							src: '//www.youtube.com/embed/%id%?autoplay=1',
						},
						vimeo: {
							index: 'vimeo.com/',
							id: '/',
							src: videoSource,
						},
					},
				},
				callbacks: {
					beforeOpen: function () {
						const orderClass = $(this.st.el).data('order');
						$('body').addClass(
							`dtq-video-open dtq-video-popup-${orderClass}`
						);
					},
					close: function () {
						const orderClass = $(this.st.el).data('order');
						$('body').removeClass(
							`dtq-video-open dtq-video-popup-${orderClass}`
						);
					},
				},
			});
		});
	}

	$('.dtq-popup-video').magnificPopup({
		type: 'inline',
		mainClass: 'mfp-fade',
		removalDelay: 100,
		closeOnContentClick: false,
		midClick: false,
		callbacks: {
			beforeOpen: function () {
				$('body').addClass('dtq-modal-open dtq-video-popup');
			},
			open: function () {
				var targetEl = $(this.st.el).data('mfp-src');
				$('.dtq-modal').addClass('open');
				$(`${targetEl} video`).trigger('play');
			},
			close: function () {
				var targetEl = $(this.st.el).data('mfp-src');
				$(`${targetEl} video`).trigger('pause');
				$('body').removeClass('dtq-modal-open dtq-video-popup');
				$('.dtq-modal').removeClass('open');
			},
		},
	});

	// Alert Dismiss Initialization
	$('.dtq-alert-dismiss').each(function () {
		$(this).on('click', function () {
			$(this).parents('.ba_alert').fadeOut(400);
		});
	});
});

// Image Swapper
function updateImageSource(selector, imageConfig) {
	const updateSrc = (selector, src) => {
		if (src && src.length > 0) {
			$(selector).attr('src', src);
		}
	};

	const handleResize = () => {
		const screenWidth = $(document).width();
		if (screenWidth < 768) {
			updateSrc(selector, imageConfig.phone);
		} else if (screenWidth >= 768 && screenWidth < 981) {
			updateSrc(selector, imageConfig.tablet);
		} else {
			updateSrc(selector, imageConfig.desktop);
		}
	};

	handleResize(); // Call immediately to set initial source

	$(window).on('resize', handleResize);

	$(selector)
		.closest('.dtq-swapped-img-selector')
		.on({
			mouseenter: () => {
				updateSrc(selector, imageConfig.hover);
				$(selector).addClass('dtq-img-hovered');
			},
			mouseleave: () => {
				handleResize();
				$(selector).removeClass('dtq-img-hovered');
			},
		});
}

// Scroll Image Initialization
function applyScrollImageEffect(element) {
	const imgElement = element.find('.dtq-scroll-image-el');
	const overlay = element.find('.dtq-scroll-image-overlay');
	const dirHover = element.data('dir-hover');
	const dirScroll = element.data('dir-scroll');

	// Calculate hover offset based on direction
	function calculateHoverOffset() {
		return dirHover[0] === 'X'
			? parseInt(imgElement.width()) - parseInt(element.width())
			: parseInt(imgElement.height()) - parseInt(element.height());
	}

	// Handle hover animations if applicable
	if (dirHover !== 'none') {
		const operator =
			dirHover === 'X_rtl' || dirHover === 'Y_btt' ? '-' : '';
		const axis = dirHover[0];
		const offset = Math.max(calculateHoverOffset(), 0);

		element.on('mouseenter', function () {
			imgElement.css(
				'transform',
				`translate${axis}(${operator}${offset}px)`
			);
		});

		element.on('mouseleave', function () {
			imgElement.css('transform', `translate${axis}(0px)`);
		});
	}

	// Handle scroll overflow styling if applicable
	if (dirScroll !== 'none') {
		if (dirScroll === 'horizontal') {
			overlay.css({
				width: imgElement.width(),
				height: imgElement.height(),
			});
		} else {
			overlay.css({
				width: '100%',
				height: '100%',
			});
		}
	}
}
