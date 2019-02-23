define([
	'jquery',
	'mage/translate',
	'jquery/ui'
], function ($, $t) {
	'use strict';
	return function (widget) {
		console.log(121323);
		$.widget('mage.catalogAddToCart', widget, {
			submitForm: function (form) {
				if (confirm($t('Are you sure?'))) {
					this._super(form);
				} else {
					return false;
				}
			}
		});
		return $.mage.catalogAddToCart;
	}
});