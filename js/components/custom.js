(function($) {
	$(function() {
		// fix collapse conflict with mootools
		$('.dropdown').on('hide.bs.dropdown hidden.bs.dropdown show.bs.dropdown shown.bs.dropdown', function () {
			$(this).removeAttr('style');
		});
		$('.navbar-collapse').on('hide.bs.collapse hidden.bs.collapse show.bs.collapse shown.bs.collapse', function () {
			$(this).removeAttr('style');
		});

		// messages
		var alertCount = $('.alert-messages > li > *:first-child').length;
		var elementAlert = $('#alert-count');
		if (alertCount > 0 && elementAlert.data('alert') === true) {
			elementAlert.removeClass('label-default');
			elementAlert.addClass('label-danger');
			elementAlert.text(alertCount);
		}

		// fix missing CSS classes for tree listing
		$('li .tl_folder .tl_left').each(function() {
			var el = $(this).children('a');
			if (el && el.length > 2) {
				$(this).parent().addClass('has-children')
			}
		});
		$('#tl_breadcrumb li').each(function(index, el) {
			el.set('html', el.get('html').replace(/&gt;/, ''));
		});

		// Bootstrap Template stuff
		$('#side-menu').metisMenu({
			toggle: false,
			collapseClass: 'm-collapse',
			collapseInClass: 'm-in',
			collapsingClass: 'm-collapsing'
		});


		//Loads the correct sidebar on window load,
		//collapses the sidebar on window resize.
		// Sets the min-height of #page-wrapper to window size
		$(window).bind("load resize", function() {
			var topOffset = 50;
			var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
			if (width < 768) {
				$('div.navbar-collapse').addClass('collapse');
				topOffset = 100; // 2-row-menu
			} else {
				$('div.navbar-collapse').removeClass('collapse');
			}

			var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
			height = height - topOffset;
			if (height < 1) height = 1;
			if (height > topOffset) {
				$("#page-wrapper").css("min-height", (height) + "px");
			}
		});

		var url = window.location;
		var element = $('ul.nav a').filter(function() {
			return this.href == url || url.href.indexOf(this.href) == 0;
		}).addClass('active').parent().parent().addClass('in').parent();
		if (element.is('li')) {
			element.addClass('active');
		}
	});
})(jQuery);