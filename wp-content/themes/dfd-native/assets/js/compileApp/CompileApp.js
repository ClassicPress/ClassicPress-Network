var dfdCompileLess = dfdCompileLess || {};

(function($){
	'use strict';
	$(document).ready(function(){
		dfdCompileLess = {
			files: [
			],
			error: [
			],
			strategy:"all",
			pointer: -1,
			init: function(options){
				var self = this;
				var data = {};
				$.extend(data, options);
				var success = function(response){
					self.files = response.files;
					if( typeof  response.files == "undefined"){
						console.log("No files to compile");
						return false;
					}
					if(response.files.length){
						self.recurciveCompile();
					}
				};
				this.ajax(data, success);
			},
			run: function(options){
				var self = this;
				this.clearStats();
				$.extend(options, _compilestyle);
				setTimeout(function(){
					$("#CompilelessCliker").click();
					self.init(options);
				}, 200);
				this.thickboxAddClass();
			},
			htmlMain: function(){
				return "<div id=\"hiddenModalContent\" style=\"display:none\">\n\
							<div class=\"BlockCompile\" style=\"text-align:center\">\n\
								<p class=\"heading\"> Please wait while theme ReCompile styles. <br> Don't close this window</p>\n\
								<p class=\"compilestatuslessTotal\" > </p>\n\
								<p class=\"compilestatuslessBar\" ><span class=\"stat\">&nbsp;</span> </p>\n\
								<table class=\"compilestatusless\" style=\"text-align:center\" ></table>\n\
								<p style=\"text-align:center; display: none\" class=\"closeCompile\">\n\
									<input type=\"submit\" id=\"Login\" value=\"&nbsp;&nbsp;Compile Error&nbsp;&nbsp;\" onclick=\"tb_remove();jQuery('html').removeClass('dfd-compile-box');\"><br>\n\
									<span class=\"compile_err_mess\">Please increase <code>max_input_vars</code> setting in server configuration if it's lower then 3000 and contact our team if it is but the issue still shows up</span>\n\
								</p>\n\
							</div>\n\
						</div>";
			},
			htmlHead: function(){
				return "<script type=\"text/template\" id=\"templateСompilestatuslessHead\"><thead><tr><td>file name</td><td> size</td><td> total size</td></tr></thead></script>";
			},
			htmlStatsTotal: function(){
				return "<script type=\"text/template\" id=\"templateCompileLessModalStatsTotal\">Progress <b><%= start %></b> of <b><%= end %></b><br></script>";
			},
			htmlStats: function(){
				return "<script type=\"text/template\" id=\"templateCompileLessModalStats\"><tr><% if(error_message) { %><td colspan=\"3\" class=\"hasError\"><%=error_message%></span><% } else { %><td><%= name %></td><td><%= scrip_m %></td><td><%= total_m %>M</td><%}%></tr></script>";
			},
			events: function(){
				var self = this;
				$("#recompileStyleButton").on("click", function(){
					self.run();
				});
				$("#wp-admin-bar-compile_less").on("click", function(){
					self.initTemplates();
					self.reInitHtmlContent();
					tb_show('Upload a Image', '#TB_inline?width=600&height=500&inlineId=hiddenModalContent&modal=true', false);
					self.strategy = "all";
					self.run();
					return false;
				});
				$("#wp-admin-bar-simple_compile_less").on("click", function(){
					self.initTemplates();
					self.reInitHtmlContent();
					tb_show('Upload a Image', '#TB_inline?width=600&height=500&inlineId=hiddenModalContent&modal=true', false);
					self.strategy = "simple";
					var options = {"strategy": self.strategy};
					self.run(options);
					return false;
				});
			},
			initTemplates: function(){
				$("body").append(this.htmlMain);
				$("body").append(this.htmlHead);
				$("body").append(this.htmlStatsTotal());
				$("body").append(this.htmlStats());
			},
			recurciveCompile: function(){
				this.startProcess();
				$(".compilestatusless").hide();
				$(".compilestatusless").append(this.templateStatsHead);
				this.compile();
			},
			startProcess: function(){
				this.pointer = 0;
			},
			nextPointer: function(){
				this.pointer++;
			},
			inProcess: function(){
				return this.pointer >= 0 && this.pointer < this.files.length;
			},
			endProcces: function(){
				this.pointer = -1;
			},
			compile: function(){
				var self = this;
				if(!this.inProcess()){
					this.endProcces();
					if(!this.hasError()){
						tb_remove();
						$('html').removeClass('dfd-compile-box');
					} else {
						$(".closeCompile").show();
					}
					return false;
				}
				var name = this.files[this.pointer];
				var data = {
					name: name,
					strategy:self.strategy
				};
				var success = function(response){
					self.updateProgress(response);
					self.nextPointer();
					self.compile();
				};
				this.ajax(data, success);

			},
			ajax: function(data, success){
				data._dfd_compile_yes = 1;
				$.extend(data, _compilestyle);
				var url = _compilestyle.url;
				$.ajax({
					method: "POST",
					url: url,
					data: data,
					success: success,
					error: function(err){
						console.log(err);
						console.log("error");
					}
				});
			},
			updateProgress: function(response){
				this.updateTotal();
				this.updateProgressBarr();
				this.updateStats(response);
			},
			updateProgressBarr: function(){
				var value = ((this.pointer + 1) / this.files.length) * 100;
				$(".compilestatuslessBar .stat").css("width", value + "%");
			},
			updateTotal: function(){
				var obj = $(".compilestatuslessTotal");
				obj.html("");
				var html = this.templateStatsTotal(
						{
							"start": this.pointer + 1,
							"end": this.files.length
						}
				);
				obj.append(html);
			},
			clearStats: function(){
				$(".compilestatusless").html("");
				$(".closeCompile").hide("");
			},
			thickboxAddClass: function(){
				$("html").addClass("dfd-compile-box");
			},
			hasError: function(){
				return this.error.length > 0 ? true : false;
			},
			updateStats: function(response){
				var name = this.files[this.pointer];
				var error_message;
				if(!response.memory_usage){
					error_message = response;
					this.error.push(response);
				}
				var html = this.templateStats(
						{
							"name": name,
							"scrip_m": response.memory_usage,
							"total_m": response.memory_get_peak_usage,
							"error_message": error_message
						}
				);
				response.show = _compilestyle.debug;
				$(".compilestatusless").append(html);
				if(response.show){
					$(".compilestatusless").show();
				} else {
					$(".compilestatusless").hide();
				}
				if(this.hasError()){
					$(".compilestatusless").show();
				}
			},
			reInitHtmlContent: function(){
				this.templateStats = getTemplateCompileLess("#templateCompileLessModalStats");
				this.templateStatsHead = getTemplateCompileLess("#templateСompilestatuslessHead");
				this.templateStatsTotal = getTemplateCompileLess("#templateCompileLessModalStatsTotal");

			},
			templateStats: getTemplateCompileLess("#templateCompileLessModalStats"),
			templateStatsHead: getTemplateCompileLess("#templateСompilestatuslessHead"),
			templateStatsTotal: getTemplateCompileLess("#templateCompileLessModalStatsTotal")
		};

		dfdCompileLess.events();

	});
	var getTemplateCompileLess = function(id){
		if($(id).html()){
			return _.template($(id).html());
		}
		return "";
	};

})(jQuery);






