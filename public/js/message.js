$( document ).ready(function() {
  $('#sendsms').bind('click', function() {  
  var url = "/users/sendsms";
  $(this).hide('slow');
    $.get(
      url,
      {},
      function(data) {
      $('#sendsms2').show('slow');
      $(".sms").html(data);
      });
  });
});

$( document ).ready(function() {
  $('#sendsms2').bind('click', function() {  
  var url = "/users/sendsms";
  $(this).hide('slow');
    $.get(
      url,
      {},
      function(data) {
      $('#sendsms3').show('slow');
      $(".sms").html(data);
      });
  });
});

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
 
 $(window).load(function() {  
  var url = "/users/getrss";
    $('#rssOutput').spin('small');
    $.get(
      url,
      {},
      function(data) {
    $('#rssOutput').spin(false);
      $('#rssOutput').show().html(data);
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
        $('.shw').show();
        $('#exampleModal2').modal('hide');
      });
  });
});

$( document ).ready(function() {
  $('#sendnews').bind('click', function() {  
  var url = "/users/sendnews";
  var newsmsg = $('#newsmsg').val();
      $("textarea#newsmsg").val("");
      $('.shownews').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
  if (newsmsg != '') {
        $.get(
      url,
      {newsmsg : newsmsg},
      function(data) {
        $('.shownews').spin(false);
        $('.shownews').prepend(data);
      });
  }else{}
  });
});

$( document ).ready(function() {
  $('#sendcomm').bind('click', function() {  
  var url = "/users/sendcomm";
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
  var url = "/users/replycomment";
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
  var url = "/users/replycomment";
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
  var url = "/users/sendreply";
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
  $('.likeStatus').bind('click', function() {  
  var url = "/users/likeStatus";
  var statusid = $(this).attr('id');
    $.get(
      url,
      { statusid : statusid},
      function(data) {
        $('.likeshow'+statusid).html(data);
      });
  });
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

$( document ).ready(function() {
  $('.likecomm').bind('click', function() {  
  var url = "/users/likecomm";
  var commid = $(this).attr('id');
  $(this).hide('slower');
    $.get(
      url,
      { commid : commid},
      function(data) {
        $('#comm'+commid).show('slower').html(data);
      });
  });
});



$( document ).on('click', '.likecomm2', function() {  
  var url = "/users/likecomm";
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
  var url = "/users/unlikecomm";
  var commid = $(this).attr('id');
  $(this).hide('slower')
    $.get(
      url,
      { commid : commid},
      function(data) {
        $('#comm'+commid).show('slower').html(data);
      });
    
  });

$( document ).on('click', '.unlikereplycomm', function() {  
  var url = "/users/unlikereplycomm";
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
  var url = "/users/likereplycomm";
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
$( document ).ready(function() {
  $('.applycast2').bind('click', function() { 
    $(this).hide();
  $('#spin').spin('small');
  var val = $(this).attr('id');
  var url = "/users/applycast2";
  $.get(
      url,
      { val : val},
      function(data) {
        $('.addcast').html(data);
        $('#spin').spin(false);
      });
  });
});
$( document ).ready(function() {
  $('.selcountry').bind('change', function() { 
  var val = $(this).val();
  var type = $('.type').val();
  var url = "/users/selcountry";
  $.get(
      url,
      { val : val,
        type : type},
      function(data) {
        $('.selcity').append(data);
      });
  });
});
$( document ).ready(function() {
  $('.searchresult').bind('click', function() { 
  var selcountry = $('.selcountry').val();
  var selcity = $('.selcity').val();
  var type = $('.type').val();
   if (type == 'agency') {
    var url = "/users/searchresult";
  }else if(type == 'photographer'){
    var url = "/users/searchphoto";
  }else if(type == 'fashion'){
    var url = "/users/searchfashion";
  }else if(type == 'artist'){
    var url = "/users/searchartist";
  }else if(type == 'others'){
    var url = "/users/searchothers";
  }
  $('.showresult').empty();
  $('.showresult').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
  $.get(
      url,
      { selcountry : selcountry,
        selcity : selcity},
      function(data) {
        $('.showresult').spin(false);
        $('.showresult').html(data);
      });
  });
});

$( document ).ready(function() {
  $('.searchresult2').bind('click', function() { 
  var selcountry = $('.selcountry').val();
  var selcity = $('.selcity').val();
  var selothers = $('.selothers').val();
  var url = "/users/searchothers";
  $('.showresult').empty();
  $('.showresult').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
  $.get(
      url,
      { selcountry : selcountry,
        selcity : selcity,
        selothers : selothers},
      function(data) {
        $('.showresult').spin(false);
        $('.showresult').html(data);
      });
  });
});

$( document ).ready(function() {
  $('.jobapply').bind('click', function() { 
    $(this).hide();
  $('#spin').spin('small');
  var val = $(this).attr('id');
  var url = "/others/applyjob";
  $.get(
      url,
      { val : val},
      function(data) {
        $('.addcast').html(data);
        $('#spin').spin(false);
      });
  });
});
 
$( document ).ready(function() {
  $('.changeplan').bind('click', function() {
  var val = $(this).attr('id');
  var url = "/models/changeplans";
  $.get(
      url,
      { val : val},
      function(data) {
        $('.subshow').html(data);
      });
  });
});

$( document ).ready(function() {
  $('.regplan').bind('click', function() {
  var val = $(this).attr('id');
  var url = "/models/regplan";
  $.get(
      url,
      { val : val},
      function(data) {
        $('.subshow').html(data);
      });
  });
});

$(document).on("click", ".proceedpay", function(){
   $(this).hide('slow');
   $('.Offlinebtn').show('slow');
});

$( document ).ready(function() {
  $('.sendemail').bind('click', function() {
  $(this).hide();
  $('.emailmsg').spin('small');
  var url = "/users/sendemail";
  $.get(
      url,
      {},
      function(data) {
        $('.emailmsg').spin(false);
        $('.emailmsg').html(data);
      });
  });
});