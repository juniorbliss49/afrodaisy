$(document).ready(function() {
	// body...
	$('.notify').click(function() {
		// body...
		$('.glyphicon').tooltip('hide');
		$('.mdbadge').hide();
		var url = "/models/shownotify";
    $('.castId').spin({
      length: 7,
      width : 12,
      radius: 10,
      color : '#54d7e3'
          });
		$.get(
	      url,
	      {},
	      function(data) {
          $('.castId').spin(false)
	        $('.castId').html(data);
	      });
	});
})

$(document).on('click', '.likepix', function() {
    // body...
    var url = "/users/likeimages";
  var statusid = $(this).attr('id');
  var hide = $(this).hide();
    $.get(
      url,
      { statusid : statusid},
      function(data) {
        $('#pix'+statusid).show().html(data);
      });

})

$(document).on('click', '.unlikepix', function() {
    // body...
    var url = "/users/unlikeimages";
  var statusid = $(this).attr('id');
  var hide = $(this).hide();
    $.get(
      url,
      { statusid : statusid},
      function(data) {
        $('#pix'+statusid).show().html(data);
      });

})


