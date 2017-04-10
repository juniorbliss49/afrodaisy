 $( document ).ready(function() {
  $('a.viewmsg').bind('click', function() {  
  var url = "/users/sents";
  var hiddenId = $(this).attr('id');
 	$('#hidemsg').remove().slideUp('slower');
    $.get(
      url,
      {hiddenid : hiddenId},
      function(data) {
      $('#headerDisplay').show().html(data);
      });
  });
});

 $( document ).ready(function() {
  $('.reply').bind('click', function() {  
  var url = "/users/save";
  var showmsg = $('#showmsg').val();
  var msg = $('textarea').val();
  var otherVal = $('#otherVal').val();
 	$('#hidemsg').remove().slideUp('slower');
    $.get(
      url,
      {showmsg : showmsg,
      	msg : msg,
      	otherVal : otherVal},
      function(data) {
      $('#headerDisplay').show().html(data);
      });
  });
});

$( document ).on('click', '.reply', function() {  
  var url = "/users/save";
  var showmsg = $('#showmsg').val();
  var msg = $('textarea').val();
  var otherVal = $('#otherVal').val();
 	$('#hidemsg').remove().slideUp('slower');
    $.get(
      url,
      {showmsg : showmsg,
      	msg : msg,
      	otherVal : otherVal},
      function(data) {
      $('#headerDisplay').show().html(data);
      });
  });
 
$( document ).ready(function() {
  $('.existing').bind('click', function() {  
  var url = "/users/viewcast";
  var modelid = $('#modelid').val();
  var castid = $(this).attr('id');
    $.get(
      url,
      {modelid : modelid,
      	castid : castid},
      function(data) {
        $('#exampleModal').modal('show');
      $('#castapplyview').show().html(data);
      });
  });
});

  $( document ).on('click','.send', function() {  
  var url = "/users/sendbooking";
  var modelid = $('#modelid').val();
  var castid = $(this).attr('id');
    $.get(
      url,
      {modelid : modelid,
      	castid : castid},
      function(data) {
        $('#exampleModal').modal('hide');
  });
});

$( document ).ready(function() {
  $('.sendcast').bind('click', function() {  
  var url = "/users/sendcast";
  var modelid = $('#modelid').val();
  var cast = $('.form').serialize();
    $.get(
      url,
      {modelid : modelid,
      	cast : cast},
      function(data) {
        $('#exampleModal2').modal('hide');
      });
  });
});

$( document ).ready(function() {
  $('#sendnews').bind('click', function() {  
  var url = "/users/sendnews";
  var newsmsg = $('#newsmsg').val();
      $("textarea#newsmsg").val("");
  if (newsmsg != '') {
        $.get(
      url,
      {newsmsg : newsmsg},
      function(data) {
        $('.shownews').prepend(data);
      });
  }else{}
  });
});

$( document ).ready(function() {
  $('#sendcomm').bind('click', function() {  
  var url = "/users/sendcommimg";
      id = $("textarea").attr('id');
  var newsmsg = $('.newscomm').val();
      $("textarea.newscomm").val("");
  if (newsmsg != '') {
    $('.spincomm').spin('small');
        $.get(
      url,
      {newsmsg : newsmsg,
        id : id},
      function(data) {
        $('.spincomm').spin(false);
        $('.addcomm').prepend(data);
      });
  }else{}
  });
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function() {
  // body...
  $('.verifysms').click(function() {
    // body...
    $('.show').show();
  });
});

$(document).ready(function() {
  // body...
  $('#sendverify').click(function() {
    // body...
    random = $('.random').val();
    url = "/users/verifynumber";
    $.get(
      url,
      {random : random},
      function(data) {
        $('#smsverifymsg').html(data);
      });
  })
})

$( document ).ready(function() {
  $('a.replycomm').bind('click', function() {  
  var url = "/users/replycommentimg";
  var commid = $(this).attr('id');
  var replytext = $('#replytext'+commid).val();
    $.get(
      url,
      { replytext : replytext,
        commid : commid},
      function(data) {
        $('#showreplycom'+commid).toggle(function() {
          // body...
          $('#showreplycom'+commid).html(data)
        });
      });
  });
});

$( document ).on('click', 'a.replycomm2', function() {  
  var url = "/users/replycommentimg";
  var commid = $(this).attr('id');
  var replytext = $('#replytext'+commid).val();
  $.get(
      url,
      { replytext : replytext,
        commid : commid},
      function(data) {
        $('#showreplycom'+commid).toggle(function() {
          // body...
          $('#showreplycom'+commid).html(data)
        });
      });
  });

$( document ).on('click', 'button.sendcommreply', function() {  
  var url = "/users/sendreplyimg";
  var commid = $(this).attr('id');
  var replytext = $('#replytext'+commid).val();
  $('#replytext'+commid).val("");
  if (replytext != '') {
    $('.spinsndcomm'+commid).spin('small');
        $.get(
      url,
      { replytext : replytext,
        commid : commid},
      function(data) {
        $('.spinsndcomm'+commid).spin(false);
        $('.replydata'+commid).append(data);
      });
  }else{}
    
  });

$( document ).ready(function() {
  $('.likeimage').bind('click', function() {  
  var url = "/users/likeimage";
  var statusid = $(this).attr('id');
    $.get(
      url,
      { statusid : statusid},
      function(data) {
        $('.likeshow'+statusid).html(data);
      });
  });
});


$( document ).on('click', '.likecomm', function() {  
  var url = "/users/likecommimg";
  var commid = $(this).attr('id');
  $(this).hide('slower');
    $.get(
      url,
      { commid : commid},
      function(data) {
        $('#comm'+commid).show('slower').html(data);
      });
    
  });


$( document ).on('click', '.unlikecomm', function() {  
  var url = "/users/unlikecommimg";
  var commid = $(this).attr('id');
  $(this).hide('slower');
    $.get(
      url,
      { commid : commid},
      function(data) {
        $('#comm'+commid).show('slower').html(data);
      });
    
  });

$( document ).on('click', '.unlikereplycomm', function() {  
  var url = "/users/unlikereplycommimg";
  var commid = $(this).attr('id');
  $(this).hide('slower')
    $.get(
      url,
      { commid : commid},
      function(data) {
        $('.showreplycomlike'+commid).show('slower').html(data);
      });
    
  });

$( document ).on('click', '.likereplycomm', function() {  
  var url = "/users/likereplycommimg";
  var commid = $(this).attr('id');
  $(this).hide('slower')
    $.get(
      url,
      { commid : commid},
      function(data) {
        $('.showreplycomlike'+commid).show('slower').html(data);
      });
    
  });
$( document ).ready(function() {
  $('.applycast').bind('click', function() { 
    $(this).hide();
  $('#spin').spin('small');
  var val = $(this).attr('id');
  var url = "/users/applycast";
  $.get(
      url,
      { val : val},
      function(data) {
        $('.addcast').html(data);
        $('#spin').spin(false);
      });
  });
});
