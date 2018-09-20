/*global Backbone */
var dfd_header_b = dfd_header_b || {};

(function(){
	'use strict';

	dfd_header_b.Collection.Settings = Backbone.Collection.extend({
		model: dfd_header_b.Model.Setting,
		parse: function(response){
			return response;
		}
	});
	dfd_header_b.APP.settingCollection = new dfd_header_b.Collection.Settings();
	dfd_header_b.APP.globalSettingCollection = new dfd_header_b.Collection.Settings();

})(jQuery);
