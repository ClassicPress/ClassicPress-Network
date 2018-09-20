jQuery(document).ready(function($) {
	"use strict";
    var icon_field;

	$('#dfd-generator ul.icons-list li').each(function() {
		var $self = $(this);
		var selected = $self.hasClass('crdash-wine_alt') ? 'checked' : '';
		var $class = $self.find('i').attr('class');
		var $label = $self.find('label');
		var $icon = $self.find('i').clone();
		$self.prepend('<input name="name" type="radio" value="'+$class+'" id="'+$class+'" '+selected+'>').find('i').remove();
		$label.html('').attr('for', $class).append($icon);
	});
	

    // Custom popup box
    $(document).on('click', '.crum-icon-add', function(evt){

        icon_field = $(this).siblings('.iconname');

        $("#dfd-generator-wrap, #dfd-generator-overlay").show();
		$('.ui-dialog').hide();
		
        $('#dfd-generator-insert').on('click', function(event) {
			
            $('.dfd-generator-icon-select input:checked').addClass("dfd-generator-attr");
            $('.dfd-generator-icon-select input:not(:checked)').removeClass("dfd-generator-attr");


            var icon_name = $('.dfd-generator-icon-select input:checked').val();

            icon_field.val(icon_name);


            $(icon_field).parents('.metro-menu-item').find('.tile-icon').addClass(icon_name);


			$('.ui-dialog').show();
            $("#dfd-generator-wrap, #dfd-generator-overlay").hide();


            // Prevent default action
            event.preventDefault();

            return false;
        });

        return false;
    });

	$(document).on('click', '#dfd-generator-close', function(evt){
		$("#dfd-generator-wrap, #dfd-generator-overlay").hide();
		$('.ui-dialog').show();
        return false;
    });

    // Icon pack select
	$(document).on('change', '#dfd-generator-select-pack', function(){
		$('ul.ul-icon-list').hide();
		$('ul.'+ $(this).val()).show();
	});


});