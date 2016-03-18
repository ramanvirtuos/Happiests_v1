$(function() {

    var ms = $('#ms-complex-templating').magicSuggest({
        data: 'random.json',
        renderer: function(data){
            return '<div style="padding: 5px; overflow:hidden;">' +
                '<div style="float: left;"><img src="' + data.picture + '" /></div>' +
                '<div style="float: left; margin-left: 5px">' +
                    '<div style="font-weight: bold; color: #333; font-size: 10px; line-height: 11px">' + data.name + '</div>' +
                    '<div style="color: #999; font-size: 9px">' + data.email + '</div>' +
                '</div>' +
            '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff
        }
    });



});