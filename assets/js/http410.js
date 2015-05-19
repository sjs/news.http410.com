function validateURL(textval) {
  var urlregex = new RegExp("^(http|https|ftp)\://(.*)");
  return urlregex.test(textval);
}

function datetime() {
    date = new Date(),
    datetime = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+'@'+date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
    return datetime;
}

var updating = null;
var last_updated = null;

setTimeout( function() { setInterval( function() { refresh_feed('hn-front');    }, 60000 ); }, 10000);
setTimeout( function() { setInterval( function() { refresh_feed('hn-ask');      }, 60000 ); }, 20000);
setTimeout( function() { setInterval( function() { refresh_feed('hn-show');     }, 60000 ); }, 30000);
setTimeout( function() { setInterval( function() { refresh_feed('dn-front');    }, 60000 ); }, 40000);
setTimeout( function() { setInterval( function() { refresh_feed('lobsters');    }, 60000 ); }, 50000);

function refresh_feed(name) {

    if(name == 'hn-front') {

        console.log('Trying: '+name); updating = name;
        $('#'+name+' .fa-refresh').addClass('fa-spin');
        $.getJSON('/feed/hn-front', function(data) {
            $('#hn-front .feed .column').remove(); console.log('Updating: '+name);
            $.each(data.channel.item, function(i, item) {

                var comments    = '<a href="'+item.comments+'"><i class="fa fa-fw fa-comments"></i></a>';
                var article     = '<a href="'+item.link+'">'+item.title+'</a>';

                if(i%10 == 0) {
                    $('#hn-front .feed').append('<div class="column col-xs-12 col-sm-4"></div>');
                }

                $('#hn-front .feed .column:last-child').append('<article>'+comments+' '+article+'</article>');

            }); updating = null; last_updated = name;
            $('#'+name+' .fa-refresh').removeClass('fa-spin');
        });

    } else if(name == 'lobsters') {

        console.log('Trying: '+name); updating = name;
        $('#'+name+' .fa-refresh').addClass('fa-spin');
        $.getJSON('/feed/lobsters', function(data) {
            $('#lobsters .feed .column').remove(); console.log('Updating: '+name);
            $.each(data.channel.item, function(i, item) {

                var comments    = '<a href="'+item.comments+'"><i class="fa fa-fw fa-comments"></i></a>';
                var article     = '<a href="'+item.link+'">'+item.title+'</a>';

                if(i%8 == 0) {
                    $('#lobsters .feed').append('<div class="column col-xs-12 col-sm-4"></div>');
                }

                $('#lobsters .feed .column:last-child').append('<article>'+comments+' '+article+'</article>');

            }); updating = null; last_updated = name;
            $('#'+name+' .fa-refresh').removeClass('fa-spin');
        });

    } else if(name == 'hn-ask') {

        console.log('Trying: '+name); updating = name;
        $('#'+name+' .fa-refresh').addClass('fa-spin');
        $.getJSON('/feed/hn-ask', function(data) {
            $('#hn-ask .feed .column').remove(); console.log('Updating: '+name);
            $.each(data.channel.item, function(i, item) {

                if(i < 10) {
                    if($('#hn-ask .feed .column').length == 0) {
                        $('#hn-ask .feed').append('<div class="column col-xs-12"></div>');
                    }
                    var comments    = '<a href="'+item.comments+'"><i class="fa fa-fw fa-comments"></i></a>';
                    var article     = '<a href="'+item.link+'">'+item.title+'</a>';
                    $('#hn-ask .feed .column:last-child').append('<article>'+comments+' '+article+'</article>');
                }

            }); updating = null; last_updated = name;
            $('#'+name+' .fa-refresh').removeClass('fa-spin');
        });

    } else if(name == 'hn-show') {

        console.log('Trying: '+name); updating = name;
        $('#'+name+' .fa-refresh').addClass('fa-spin');
        $.getJSON('/feed/hn-show', function(data) {
            $('#hn-show .feed .column').remove(); console.log('Updating: '+name);
            $.each(data.channel.item, function(i, item) {

                if(i < 10) {
                    if($('#hn-show .feed .column').length == 0) {
                        $('#hn-show .feed').append('<div class="column col-xs-12"></div>');
                    }
                    var comments    = '<a href="'+item.comments+'"><i class="fa fa-fw fa-comments"></i></a>';
                    var article     = '<a href="'+item.link+'">'+item.title+'</a>';
                    $('#hn-show .feed .column:last-child').append('<article>'+comments+' '+article+'</article>');
                }

            }); updating = null; last_updated = name;
            $('#'+name+' .fa-refresh').removeClass('fa-spin');
        });

    } else if(name == 'dn-front') {

        console.log('Trying: '+name); updating = name;
        $('#'+name+' .fa-refresh').addClass('fa-spin');
        $.getJSON('/feed/dn-front', function(data) {
            $('#dn-front .feed .column').remove(); console.log('Updating: '+name);
            $.each(data.channel.item, function(i, item) {

                if(i < 10) {
                    if($('#dn-front .feed .column').length == 0) {
                        $('#dn-front .feed').append('<div class="column col-xs-12"></div>');
                    }
                    var pattern = /click\//i;
                    if(validateURL(item.description)) {
                        var pattern = /click\//i;
                        var comments    = '<a href="'+item.link.replace(pattern,'')+'"><i class="fa fa-fw fa-comments"></i></a>';
                        var article     = '<a href="'+item.description+'">'+item.title+'</a>';
                        $('#dn-front .feed .column:last-child').append('<article>'+comments+' '+article+'</article>');
                    } else {
                        var comments    = '<a href="'+item.link.replace(pattern,'')+'"><i class="fa fa-fw fa-comments"></i></a>';
                        var article     = '<a href="'+item.link.replace(pattern,'')+'">'+item.title+'</a>';
                        $('#dn-front .feed .column:last-child').append('<article>'+comments+' '+article+'</article>');
                    }
                }

            }); updating = null; last_updated = name;
            $('#'+name+' .fa-refresh').removeClass('fa-spin');
        });

    }

}
