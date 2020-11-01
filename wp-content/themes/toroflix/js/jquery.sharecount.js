/*!
 * Social Share Count v1.0
 *
 * Licensed GPLv3 for open source use
 * or Share Count Commercial License for commercial use
 *
 * Copyright 2016 Dat Nguyen
 */

(function($) {
    $.fn.shareCount = function(options) {
        var settings = $.extend({
            twitter: false,
            facebook: false,
            template: '<span class="numbr">{number}</span>'
        }, options);
        function replace_number(str, number) {
            str.replace('{number}', number);
            return str;
        }
        return this.each(function() {
            var _that = this;
			var url = window.location.href;
            if (settings.twitter) {
                jQuery.getJSON('//public.newsharecounts.com/count.json?url=' + url, function(data) {
                    $(_that).find(settings.twitter).append(settings.template.replace('{number}', data.count));
                });
            }
            if (settings.facebook) {
                jQuery.getJSON('//graph.facebook.com/' + url, function(data) {
                    var share_number = data.share.share_count;
                    $(_that).find(settings.facebook).append(settings.template.replace('{number}', share_number));
                });
            }
        });
    }
}(jQuery));
jQuery(document).ready(function($){
$('.ShareList').shareCount({
    facebook:'.trfb',
    twitter:'.trtw',
    template: '<span class="numbr">{number}</span>'
})
});