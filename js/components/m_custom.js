var BsAjaxRequest =
{
	/**
	 * Toggle the navigation menu
	 *
	 * @param {object} el The DOM element
	 * @param {string} id The ID of the menu item
	 *
	 * @returns {boolean}
	 */
	toggleNavigation: function(el, id) {
		el.blur();

		var item = $(id);

		if (item) {
			if (item.get('aria-expanded') == 'false') {
				$(el).store('tip:title', Contao.lang.collapse);
				new Request.Contao({
					evalScripts: true,
					onRequest: AjaxRequest.displayBox(Contao.lang.loading + ' …'),
					onSuccess: function(txt) {
						var item = $(id);
						item.set("html", txt);

						// Update the referer ID
						item.getElements('a').each(function(el) {
							el.href = el.href.replace(/&ref=[a-f0-9]+/, '&ref=' + Contao.referer_id);
						});

						$(el).store('tip:title', Contao.lang.collapse);
						AjaxRequest.hideBox();

						// HOOK
						window.fireEvent('ajax_change');
					}
				}).post({'action':'loadNavigation', 'id':id, 'state':1, 'REQUEST_TOKEN':Contao.request_token});
			} else {
				$(el).store('tip:title', Contao.lang.expand);
				new Request.Contao().post({'action':'toggleNavigation', 'id':id, 'state':0, 'REQUEST_TOKEN':Contao.request_token});
			}
			return false;
		}



		return false;
	}
};
Tips.Contao = new Class ({});