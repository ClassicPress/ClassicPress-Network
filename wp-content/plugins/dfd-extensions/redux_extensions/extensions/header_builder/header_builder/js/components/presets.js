/*global Backbone */
var dfd_header_b = dfd_header_b || {};

(function($, window){
	'use strict';

	dfd_header_b.Default = {
		"name": "defalult_03223",
		"isActive": "active",
		"presetValues": {
			"desktop": [
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
					],
					[
					],
					[
					]
				]
			],
			"tablet": [
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
						{"name": "Logo", "type": "logo", "isfullwidth": false}
					],
					[
					],
					[
						{"name": "Language", "type": "language", "isfullwidth": false},
						{"name": "Search", "type": "search", "isfullwidth": false},
						{"name": "Cart", "type": "cart", "isfullwidth": false},
						{"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}
					]
				]
			],
			"mobile": [
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
						{"name": "Logo", "type": "logo", "isfullwidth": false}
					],
					[
					],
					[
						{"name": "Delimiter", "type": "delimiter", "isfullwidth": false},
						{"name": "Language", "type": "language", "isfullwidth": false},
						{"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}
					]
				]
			]},
		"settings": {
			"desktop": [
			],
			"tablet": [
				{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"},
				{"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"},
				{"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"},
			],
			"mobile": [
				{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"},
				{"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"},
				{"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"},
			],
			"globals": [
			]}, "active": ""};
	/** 
	 * Default preset for side header
	 */
	dfd_header_b.DefaultPresetSide = {
		"name": "default_343434343",
		"isActive": "",
		"presetValues": {
			"desktop": [[[{"name": "Spacer", "type": "spacer", "isfullwidth": false}, {"name": "Spacer", "type": "spacer", "isfullwidth": false}], [], []], [[], [], []], [[{"name": "Spacer", "type": "spacer", "isfullwidth": false}, {"name": "Spacer", "type": "spacer", "isfullwidth": false}], [], []]], "tablet": [[[], [], []], [[], [], []], [[{"name": "Logo", "type": "logo", "isfullwidth": false}], [], [{"name": "Language", "type": "language", "isfullwidth": false}, {"name": "Search", "type": "search", "isfullwidth": false}, {"name": "Cart", "type": "cart", "isfullwidth": false}, {"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}]]], "mobile": [[[], [], []], [[], [], []], [[{"name": "Logo", "type": "logo", "isfullwidth": false}], [], [{"name": "Delimiter", "type": "delimiter", "isfullwidth": false}, {"name": "Language", "type": "language", "isfullwidth": false}, {"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}]]]
		},
		"settings": {
			"desktop": [{"id": "show_top_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "on", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}, {"id": "set_top_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_mid_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_bot_panel_abstract_builder", "type": "trigger", "value": "on", "def": "off", "isGlobal": "false"}, {"id": "header_top_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_mid_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_bot_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_top_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_mid_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_bot_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_border_color_build", "type": "colorpicker", "value": "{ \"color\":\"#e7e7e7\",\"is_transparent\":\"false\"}", "def": "#e7e7e7", "isGlobal": "false"}], "tablet": [{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}, {"id": "set_top_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_mid_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_bot_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}], "mobile": [{"type": "trigger", "id": "show_top_panel_builder", "value": "off", "def": "on", "isGlobal": "false"}, {"type": "trigger", "id": "show_mid_panel_builder", "value": "off", "def": "on", "isGlobal": "false"}, {"type": "trigger", "id": "show_bot_panel_builder", "value": "", "def": "on", "isGlobal": "false"}, {"type": "trigger", "id": "set_top_panel_abstract_builder", "value": "", "def": "off", "isGlobal": "false"}, {"type": "trigger", "id": "set_mid_panel_abstract_builder", "value": "", "def": "off", "isGlobal": "false"}, {"type": "trigger", "id": "set_bot_panel_abstract_builder", "value": "", "def": "off", "isGlobal": "false"}], "globals": [{"id": "header_copyright_builder", "type": "text", "value": "@DFD", "def": "", "isGlobal": "true"}, {"id": "header_telephone_builder", "type": "telephone", "value": "+(032) 323-323-32", "def": "", "isGlobal": "true"}, {"id": "header_button_text_builder", "type": "text", "value": "Button", "def": "", "isGlobal": "true"}, {"id": "header_button_url_builder", "type": "text", "value": "#", "def": "", "isGlobal": "true"}, {"id": "header_side_background_color_builder", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "true"}, {"id": "bg_image_side_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "header_side_bar_width_builder", "type": "slider", "value": "320", "def": "", "isGlobal": "true"}, {"id": "header_alignment_builder", "type": "radio", "value": "left", "def": "", "isGlobal": "true"}, {"id": "header_bg_repeat_builder", "type": "radio", "value": "no-repeat", "def": "", "isGlobal": "true"}, {"id": "header_bg_size_builder", "type": "radio", "value": "cover", "def": "", "isGlobal": "true"}, {"id": "header_bg_position_builder", "type": "radio", "value": "center-center", "def": "", "isGlobal": "true"}, {"id": "header_content_alignment_builder", "type": "radio", "value": "alignleft", "def": "", "isGlobal": "true"}, {"id": "style_header_builder", "type": "image_select", "value": "side", "def": "", "isGlobal": "true"}, {"id": "logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "retina_logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "top_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "mid_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "bot_header_height_builder", "type": "slider", "value": "70", "def": "", "isGlobal": "true"}, {"id": "header_sticky_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "true"}]
		},
	};
	/** 
	 * Default preset for boxed header
	 */
	dfd_header_b.DefaultPresetBoxed = {
		"name": "default_478368",
		"isActive": "",
		"presetValues": {
			"desktop": [[[], [], []], [[], [], []], [[], [], []]], "tablet": [[[], [], []], [[], [], []], [[{"name": "Logo", "type": "logo", "isfullwidth": false}], [], [{"name": "Language", "type": "language", "isfullwidth": false}, {"name": "Search", "type": "search", "isfullwidth": false}, {"name": "Cart", "type": "cart", "isfullwidth": false}, {"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}]]], "mobile": [[[], [], []], [[], [], []], [[{"name": "Logo", "type": "logo", "isfullwidth": false}], [], [{"name": "Delimiter", "type": "delimiter", "isfullwidth": false}, {"name": "Language", "type": "language", "isfullwidth": false}, {"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}]]]},
		"settings": {
			"desktop": [{"id": "header_copyright_builder", "type": "text", "value": "@DFD", "def": "", "isGlobal": "true"}, {"id": "header_telephone_builder", "type": "telephone", "value": "+(032) 323-323-32", "def": "", "isGlobal": "true"}, {"id": "header_button_text_builder", "type": "text", "value": "Button", "def": "", "isGlobal": "true"}, {"id": "header_button_url_builder", "type": "text", "value": "#", "def": "", "isGlobal": "true"}, {"id": "header_side_background_color_builder", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "true"}, {"id": "bg_image_side_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "header_side_bar_width_builder", "type": "slider", "value": "490", "def": "", "isGlobal": "true"}, {"id": "header_alignment_builder", "type": "radio", "value": "left", "def": "", "isGlobal": "true"}, {"id": "header_bg_repeat_builder", "type": "radio", "value": "no-repeat", "def": "", "isGlobal": "true"}, {"id": "header_bg_size_builder", "type": "radio", "value": "cover", "def": "", "isGlobal": "true"}, {"id": "header_bg_position_builder", "type": "radio", "value": "center-center", "def": "", "isGlobal": "true"}, {"id": "header_content_alignment_builder", "type": "radio", "value": "alignleft", "def": "", "isGlobal": "true"}, {"id": "style_header_builder", "type": "image_select", "value": "horizontal", "def": "", "isGlobal": "true"}, {"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "on", "def": "on", "isGlobal": "false"}, {"id": "set_top_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_mid_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_bot_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "retina_logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "top_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "mid_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "bot_header_height_builder", "type": "slider", "value": "70", "def": "", "isGlobal": "true"}, {"id": "header_top_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_mid_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_bot_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_top_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_mid_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_bot_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_border_color_build", "type": "colorpicker", "value": "{\"color\":\"transparent\",\"is_transparent\":\"true\"}", "def": "#e7e7e7", "isGlobal": "false"}, {"id": "header_sticky_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "true"}], "tablet": [{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}], "mobile": [{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}], "globals": [{"id": "header_copyright_builder", "type": "text", "value": "@DFD", "def": "", "isGlobal": "true"}, {"id": "header_telephone_builder", "type": "telephone", "value": "+(032) 323-323-32", "def": "", "isGlobal": "true"}, {"id": "header_button_text_builder", "type": "text", "value": "Button", "def": "", "isGlobal": "true"}, {"id": "header_button_url_builder", "type": "text", "value": "#", "def": "", "isGlobal": "true"}, {"id": "header_side_background_color_builder", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "true"}, {"id": "bg_image_side_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "header_side_bar_width_builder", "type": "slider", "value": "490", "def": "", "isGlobal": "true"}, {"id": "header_alignment_builder", "type": "radio", "value": "left", "def": "", "isGlobal": "true"}, {"id": "header_bg_repeat_builder", "type": "radio", "value": "no-repeat", "def": "", "isGlobal": "true"}, {"id": "header_bg_size_builder", "type": "radio", "value": "cover", "def": "", "isGlobal": "true"}, {"id": "header_bg_position_builder", "type": "radio", "value": "center-center", "def": "", "isGlobal": "true"}, {"id": "header_content_alignment_builder", "type": "radio", "value": "alignleft", "def": "", "isGlobal": "true"}, {"id": "style_header_builder", "type": "image_select", "value": "boxed", "def": "", "isGlobal": "true"}, {"id": "logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "retina_logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "top_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "mid_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "bot_header_height_builder", "type": "slider", "value": "70", "def": "", "isGlobal": "true"}, {"id": "header_sticky_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "true"}]},
	};



	dfd_header_b.PreSetting = [
		{
			id: "header_copyright_builder",
			type: "text",
			value: "@DFD",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_telephone_builder",
			type: "telephone",
			value: "+(032) 323-323-32",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_button_text_builder",
			type: "text",
			value: "Button",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_button_url_builder",
			type: "text",
			value: "#",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_side_background_color_builder",
			type: "colorpicker",
			value: "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}",
			def: "#ffffff",
			isGlobal: "true"
		},
		{
			id: "bg_image_side_header_builder",
			type: "image",
			value: "{\"id\":\"\",\"thumb\":\"\"}",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_side_bar_width_builder",
			type: "slider",
			value: "490",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_alignment_builder",
			type: "radio",
			value: "left",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_bg_repeat_builder",
			type: "radio",
			value: "no-repeat",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_bg_size_builder",
			type: "radio",
			value: "cover",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_bg_position_builder",
			type: "radio",
			value: "center-center",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_content_alignment_builder",
			type: "radio",
			value: "alignleft",
			def: "",
			isGlobal: "true"
		},
		{
			id: "style_header_builder",
			type: "image_select",
			value: "horizontal",
			def: "",
			isGlobal: "true"
		},
		{
			id: "show_top_panel_builder",
			type: "trigger",
			value: "",
			def: "on",
			isGlobal: "false"
		},
		{
			id: "show_mid_panel_builder",
			type: "trigger",
			value: "",
			def: "on",
			isGlobal: "false"
		},
		{
			id: "show_bot_panel_builder",
			type: "trigger",
			value: "",
			def: "on",
			isGlobal: "false"
		},
		{
			id: "set_top_panel_abstract_builder",
			type: "trigger",
			value: "",
			def: "off",
			isGlobal: "false"
		},
		{
			id: "set_mid_panel_abstract_builder",
			type: "trigger",
			value: "",
			def: "off",
			isGlobal: "false"
		},
		{
			id: "set_bot_panel_abstract_builder",
			type: "trigger",
			value: "",
			def: "off",
			isGlobal: "false"
		},
		{
			id: "logo_header_builder",
			type: "image",
			value: "{\"id\":\"\",\"thumb\":\"" + dfd_header_b_local_settings.logo_url + "\"}",
			def: "",
			isGlobal: "true"
		},
		{
			id: "retina_logo_header_builder",
			type: "image",
			value: "{\"id\":\"\",\"thumb\":\"" + dfd_header_b_local_settings.retina_url + "\"}",
			def: "",
			isGlobal: "true"
		},
		{
			id: "top_header_height_builder",
			type: "slider",
			value: "40",
			def: "",
			isGlobal: "true"
		},
		{
			id: "mid_header_height_builder",
			type: "slider",
			value: "40",
			def: "",
			isGlobal: "true"
		},
		{
			id: "bot_header_height_builder",
			type: "slider",
			value: "70",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_top_background_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}",
			def: "#ffffff",
			isGlobal: "false"
		},
		{
			id: "header_mid_background_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}",
			def: "#ffffff",
			isGlobal: "false"
		},
		{
			id: "header_bot_background_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}",
			def: "#ffffff",
			isGlobal: "false"
		},
		{
			id: "header_top_text_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}",
			def: "#313131",
			hidetransparent: "true",
			isGlobal: "false"
		},
		{
			id: "header_mid_text_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}",
			def: "#313131",
			hidetransparent: "true",
			isGlobal: "false"
		},
		{
			id: "header_bot_text_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}",
			def: "#313131",
			hidetransparent: "true",
			isGlobal: "false"
		},
		{
			id: "header_border_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#e7e7e7\",\"is_transparent\":\"false\"}",
			def: "#e7e7e7",
			isGlobal: "false"
		},
		{
			id: "header_sticky_builder",
			type: "trigger",
			value: "",
			def: "on",
			isGlobal: "true"
		},
	];

	dfd_header_b.PremadeElements = {
		el: [
			{
				type: "text",
				name: "Copyright message",
				class_el: "Copyright-message"
			},
			{
				type: "menu",
				name: "Menu",
				class_el: "Menu"
			},
			{
				type: "second_menu",
				name: "Second Menu",
				class_el: "Second-Menu"
			},
			{
				type: "third_menu",
				name: "Third  Menu",
				class_el: "Third-Menu"
			},
			{
				type: "additional_menu",
				name: "Additional Menu",
				class_el: "Additional_Menu"},
			{
				type: "wishlist",
				name: "Wishlist",
				class_el: "Wishlist"
			},
			{
				type: "cart",
				name: "Cart",
				class_el: "Cart"
			},
			{
				type: "search",
				name: "Search",
				class_el: "Search"
			},
			{
				type: "logo",
				name: "Logo",
				class_el: "Logo"},
			{
				type: "language",
				name: "Language",
				class_el: "Language"
			},
			{
				type: "socicon",
				name: "Social Icon",
				class_el: "Socicon"
			},
			{
				type: "login",
				name: "Login on site",
				class_el: "Login"
			},
			{
				type: "info",
				name: "Info",
				class_el: "Info"
			},
			{
				type: "mobile_menu",
				name: "Mobile Menu",
				class_el: "Mobile_Menu"
			},
			{
				type: "side_area",
				name: "Side Area",
				class_el: "Side_Area"
			},
			{
				type: "inner_page",
				name: "Inner Page",
				class_el: "Inner_Page"
			},
			{
				type: "buttonel",
				name: "Button",
				class_el: "Button"
			},
			{
				type: "telephone",
				name: "Telephone",
				class_el: "Telephone"
			},
			{
				type: "spacer",
				name: "Spacer",
				class_el: "spacer",
				onlimit: true
			},
			{
				type: "delimiter",
				name: "Delimiter",
				class_el: "Delimiter",
				onlimit: true
			},
		]
	};

	dfd_header_b.Dependency = {
		side: [
			"set_top_panel_abstract_builder",
			"set_mid_panel_abstract_builder",
			"set_bot_panel_abstract_builder",
			"top_header_height_builder",
			"mid_header_height_builder",
			"bot_header_height_builder",
			"show_top_panel_builder",
			"show_mid_panel_builder",
			"show_bot_panel_builder",
			"header_top_background_color_build",
			"header_mid_background_color_build",
			"header_bot_background_color_build",
//			"header_sticky_builder",
		],
		horizontal: [
			"bg_image_side_header_builder",
			"header_side_background_color_builder",
			"header_side_bar_width_builder",
			"header_alignment_builder",
			"header_content_alignment_builder",
			"header_bg_repeat_builder",
			"header_bg_size_builder",
			"header_bg_position_builder",
		],
		boxed: [
			"bg_image_side_header_builder",
			"header_side_background_color_builder",
			"header_side_bar_width_builder",
			"header_alignment_builder",
			"header_content_alignment_builder",
			"header_bg_repeat_builder",
			"header_bg_size_builder",
			"header_bg_position_builder",
		],
		init: function(){
			var self = this;
			var type = dfd_header_b.View.Setting.getHeaderStyle();
			var curView = dfd_header_b.Config.getCurentView();
			if(curView != "desktop"){
				if(type == "side"){
					type = "horizontal";
				}
			}
			setTimeout(function(){
				self.build(type);
			}, 50);
		},
		build: function(type){
			for(var key in this[type]) {
				var id = this[type][key];
				var obj = $("fieldset[data-id=" + id + "]").parent().parent();
//				if(obj.is(":visible")){
				obj.hide();
//				}
			}
//			if(type == "side"){
//				type = "horizontal";
//			}			
			if(type == "side"){
				type = "horizontal";
			} else {
				type = "side";
			}
			for(var key in this[type]) {
				var id = this[type][key];
				var obj = $("fieldset[data-id=" + id + "]").parent().parent();
//				if(!obj.is(":visible")){
				obj.show();
//				}
			}
		}
	};
})(jQuery, window);
