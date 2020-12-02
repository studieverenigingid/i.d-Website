var ajaxurl;
jQuery(document).ready(onDocReady);

function onDocReady () {

	ajaxurl = document.head.querySelector("[name=ajaxurl]").content;

	menuToggler();
	menuSticky();
	fixVHAfterLoad();
	closeInMemoriam();
	openingHours();

	// formhandling.js
	ajaxFeedbackForm();
	hideUpdateFields();
	resetFormLink();
	showHidePassword();
	createAccountForm();
	buyTicketEventPage();

	// userinfoedit.js
	userInfoEdit();

	// social.js
	socialFeed();

	// filters.js
	registerFilters();

	// kafee.js
	if (!!document.getElementById('isitkafee')) aftellen();
}

function menuToggler () {

	var menuToggle = jQuery('.js-menu-toggle'),
		menu = jQuery('.primary-menu'),
		subMenuToggle = jQuery('.js-sub-menu-toggle');

	menuToggle.click(function () {
		menu.toggleClass('opened');
		menuToggle.toggleClass('opened');
	});

	subMenuToggle.click(function () {
		jQuery(this).next().toggleClass('opened');
		jQuery(this).toggleClass('opened');
	});

}

function menuSticky() {
	var primaryMenu = jQuery('.primary-menu');
	var biesImage = jQuery('.bies__image');
	var posFromTop = primaryMenu.offset().top + 80;

	jQuery(window).scroll(function() {
		var scroll = jQuery(window).scrollTop();

		if (scroll > posFromTop) {
	    	primaryMenu.addClass("primary-menu--sticky");
			biesImage.addClass("bies__image--sticky");
	  	} else {
			primaryMenu.removeClass("primary-menu--sticky");
			biesImage.removeClass("bies__image--sticky");
	  	}
	});

}

function fixVHAfterLoad() {
	jQuery('.fix-me').height(jQuery('.fix-me').height());
}

function notFound(jQuery) {
	setTimeout(function() {
		var container = jQuery('.not-found');
		jQuery('.bies, .not-found').css('background-color', '#ef686c');
		jQuery('h1').html(jQuery('h1').text().replace('404', '4<span style="font-size: 0.44rem">0</span>4'));
		setInterval(function() {
			jQuery('<div>44</div>').appendTo('.not-found')
				.offset({
					top: Math.floor(Math.random() * container.height()),
					left: Math.floor(Math.random() * container.width())
				});
		}, 44 * 22);
	}, 44 * 444);
}

function closeInMemoriam() {
	jQuery('.in-memoriam__link').click(function(e) {
		e.preventDefault();
		jQuery('.in-memoriam').remove();
	});
}

function openingHours() {
	let hoursList = jQuery('.opening_hours__full-list');
	hoursList.addClass('closed');
	jQuery('.opening_hours__link').click(function(e) {
		e.preventDefault();
		hoursList.toggleClass('closed');
	})
}

// Polyfill from the lovely Brian Blakely (don’t know him but his polyfill is
// nice) https://jsfiddle.net/brianblakely/h3EmY/
(function templatePolyfill(d) {
	if('content' in d.createElement('template')) {
		return false;
	}

	var qPlates = d.getElementsByTagName('template'),
		plateLen = qPlates.length,
		elPlate,
		qContent,
		contentLen,
		docContent;

	for(var x=0; x<plateLen; ++x) {
		elPlate = qPlates[x];
		qContent = elPlate.childNodes;
		contentLen = qContent.length;
		docContent = d.createDocumentFragment();

		while(qContent[0]) {
			docContent.appendChild(qContent[0]);
		}

		elPlate.content = docContent;
	}
})(document);

// Polyfill from MDN for the .children property
(function(constructor) {
    if (constructor &&
        constructor.prototype &&
        constructor.prototype.children == null) {
        Object.defineProperty(constructor.prototype, 'children', {
            get: function() {
                var i = 0, node, nodes = this.childNodes, children = [];
                while (node = nodes[i++]) {
                    if (node.nodeType === 1) {
                        children.push(node);
                    }
                }
                return children;
            }
        });
    }
})(window.Node || window.Element);
