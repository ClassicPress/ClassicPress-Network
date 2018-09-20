/*---------------------------------
 Portfolio votes
 -----------------------------------*/

jQuery(document).ready(function () {

    jQuery(".post-like a").click(function () {

        var heart = jQuery(this);

        // Retrieve post ID from data attribute
        var post_id = heart.data("post_id");

        // Ajax call
        jQuery.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=post-like&nonce=" + ajax_var.nonce + "&post_like=&post_id=" + post_id,
            success: function (count) {
                // If vote successful
                if (count != "already") {
                    heart.addClass("voted");
                    heart.siblings(".count").text(count);
                }
            }
        });

        return false;
    });
	
	jQuery("a.post-like, a.post-like-mini").click(function () {

        var $heart = jQuery(this);

        // Retrieve post ID from data attribute
        var post_id = $heart.data("post_id");

        // Ajax call
        jQuery.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=post-like&nonce=" + ajax_var.nonce + "&post_like=&post_id=" + post_id,
            success: function (count) {
                // If vote successful
                if (count != "already") {
                    $heart.addClass("voted");
					jQuery('.count', $heart).text(count);
                }
            }
        });

        return false;
    });
});
