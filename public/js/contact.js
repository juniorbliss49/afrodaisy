$( document ).ready(function() {
  $('#confirms').bind('click', function() {  
  var url = "/others/getall2";
  var cast = $('input[name="cast_id"]').val()
    $.get(
      url,
      {cast: cast},
      function(data) {
      $('.valindex').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('#discards').bind('click', function() {  
  var url = "/others/getdisc2";
  var cast = $('input[name="cast_id"]').val()
    $.get(
      url,
      {cast: cast},
      function(data) {
      $('.valindex').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('#confirm').bind('click', function() {
    var curVa = $('ul#folder li').hasClass('active');
    curVal = $('ul#folder li.active a').text();

    var users = $('input[name="users"]:checked').val();
    $('input[name="users"]:checked').parents('.well').remove().slideUp('slower');
    var val = 'users';
    
    var url = "/others/processconfirm2";
    var cast = $('input[name="cast_id"]').val()
    $.get(
      url,
      {user : users,
        cast : cast,
        val : val
      },
      function(data) {
      $('#show_div').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('#discard').bind('click', function() {
    curVal = $('ul#folder li.active a').text();
    
    var users = $('input[name="users"]:checked').val();
    $('input[name="users"]:checked').parents('.well').remove().slideUp('slower');
    var val = 'users';
    
    var url = "/others/discardform2";
    var cast = $('input[name="cast_id"]').val()
    $.get(
      url,
      {user : users,
        cast : cast,
        val : val
      },
      function(data) {
      $('#show_div').show().html(data);
      });
  });
});

$(document).ready(function() {
	// body...
	$('.contact').click(function() {
		var url = '/others/contactothers';
		var id = $(this).attr('id');
	  $.get(
      url,
      {id : id},
      function(data) {
        $('.contact').html(data);
      });
	})
})

$(document).ready(function() {
	// body...
	$('.contacterror').click(function() {
		$('#exampleModal').modal('show');
	})
});

$(document).ready(function() {
  // body...
  $('.contacterror2').click(function() {
    $('#exampleModal7').modal('show');
  })
});

$(document).ready(function() {
	// body...
	$('.acceptuser').click(function() {
		var url = '/others/mymodelaccept';
		var id = $(this).attr('id');
	  $.get(
      url,
      {id : id},
      function(data) {
        $('#acpt'+id).hide();
      });
	})
})

$(document).ready(function() {
	// body...
	$('.declineuser').click(function() {
		var url = '/others/mymodeldecline';
		var id = $(this).attr('id');
	  $.get(
      url,
      {id : id},
      function(data) {
        $('#acpt'+id).hide();
      });
	})
})

$(document).ready(function() {
	// body...
	$('.bookmodel').click(function() {
		var url = '/others/mymodelbook';
		var id = $(this).attr('id');
	  $.get(
      url,
      {id : id},
      function(data) {
      	$('.showbook').html(data);
      });
	})
})

$( document ).ready(function() {
  $('.sendcast').bind('click', function() {  
  var url = "/others/sendcast";
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
  $('input[name="acknoledge"]:checkbox').change(function() {
  var ischecked= $(this).is(':checked');
  if(!ischecked){
    var id = $(this).val(); 
  var user_id = $('input[name="hdid"]').val(id);
        $('#exampleModal').modal('show');
  }  
  });
});

$( document ).ready(function() {
  $('.sendack').bind('click', function() {  
  var url = "/others/sendack";
  var user_id = $('#hdid').val();
  var cast = $('#ack').val();
  var ackmsg = $('#ackmsg').val();
    $.get(
      url,
      {user_id : user_id,
        cast : cast,
        ackmsg : ackmsg},
      function(data) {
        $('#exampleModal').modal('hide');
      });
  });
});

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


$( document ).ready(function() {
  $('.exist').bind('click', function() {  
  var url = "/users/viewcasts";
  var modelid = $(this).attr('id');
  var castid = $(this).attr('id');
    $.get(
      url,
      {modelid : modelid,
        castid : castid},
      function(data) {
        $('#exampleModal').modal('show');
      $('#castapplyviews').html(data);
      });
  });
});

$( document ).on('click','.send', function() {  
  var url = "/users/sendbookings";
  var id = $(this).attr('id');
    $.get(
      url,
      {id : id},
      function(data) {
        $('#exampleModal').modal('hide');
        $('.sendit').html(data);
  });
});

$( document ).ready(function() {
  $('.declineopt').bind('click', function() {  
  var url = "/others/declineopt";
  var modelid = $(this).attr('id');
    $.get(
      url,
      {modelid : modelid},
      function(data) {
        $('#exampleModal2').modal('show');
      $('#castapplyview').show().html(data);
      });
  });
});

$( document ).on('click','.declineusers', function() { 
    var url = '/others/mymodeldecline';
    var id = $(this).attr('id');
     $.get(
      url,
      {id : id},
      function(data) {
        $('#acpt'+id).hide();
      });
});

$( document ).ready(function() {
  $('.followings').bind('click', function() {  
  var url = "/others/followings";
  var modelid = $(this).attr('id');
    $.get(
      url,
      {modelid : modelid},
      function(data) {
        $('#exampleModal3').modal('show');
      $('#castapplyview').show().html(data);
      });
  });
});

$( document ).on('click','.following', function() { 
    var val = $(this).attr('id');
  var url = "/users/unfollow";
  $.get(
      url,
      { val : val},
      function(data) {
        $('#acpt'+val).hide('slow');
      });
});

$( document ).ready(function() {
  $('.linkto').bind('click', function() {  
  var url = "/others/linktojob";
  var user_id = $('.user_id').val();
  $('.form').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
    $.get(
      url,
      {user_id : user_id},
      function(data) {
        $('.form').spin(false);
      $('.form').show().html(data);
      });
  });
});

$( document ).on('click','.invitepro', function() {
    var val = $(this).attr('id');
    var proid = $('#proid').val();
  var url = "/others/invitepro";
  $.get(
      url,
      { val : val,
        proid: proid},
      function(data) {
        $('#exampleModal2').modal('hide');
      });
});

$( document ).ready(function() {
  $('.sendjob').bind('click', function() {  
  var url = "/others/creatjob";
  var form = $('.form1').serialize();
  var user_id = $('.user_id').val();
  $('.form').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
    $.get(
      url,
      {user_id : user_id,
        form : form},
      function(data) {
        $('.form').spin(false);
      $('#exampleModal2').modal('hide');
      });
  });
});

$( document ).ready(function() {
  $('.viewjob').click(function() {
    var val = $(this).attr('id');
    var url = "/others/jobview";
    $.get(
      url,
      {val : val
      },
      function(data) {
        $('#castapplyview').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('.viewjobs').click(function() {
    var val = $(this).attr('id');
    var url = "/others/jobviews";
    $.get(
      url,
      {val : val
      },
      function(data) {
        $('#castapplyview').show().html(data);
      });
  });
});

$(document).on("click", ".applyjob", function(){
   var val = $(this).attr('id');
    var url = "/others/jobapplyProcess";
    $.get(
      url,
      {val : val
      },
      function(data) {
        $('.jobview'+val).show().html(data);
      });
});

$(document).ready(function() {
  $('#checkoutjob').click(function() {

    var cast = $('input[name="cast_id"]').val();
    var url = "/others/checkoutjob";
    $.get(
      url,
      {
        cast : cast
      },
      function(data) {
      $('.modelcheckout').show().html(data);
      });
    
  })
})

$(document).on("click", ".proceedpay", function(){
   $(this).hide('slow');
   $('.Offlinebtn').show('slow');
});

$( document ).ready(function() {
  $('#btn-fol').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/following";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('#btn-fol').hide();
      $('#btn-unfol').show();
      });
  });
});

 $( document ).ready(function() {
  $('#btn-unfol').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/unfollow";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('#btn-unfol').hide();
      $('#btn-fol').show();
      });
  });
});

 $( document ).ready(function() {
  $('button#send').click(function() {
    var users = $('input[name="user_id"]').val();
    var msg = $('textarea#msg').val();
    var url = "/models/message";
    if (msg != '') {
    $.get(
      url,
      {user : users,
        msg : msg
      },
      function(data) {
        $('#exampleModal4').modal('hide');
        $('.sent').html(data);
      });
  }else{
    $('#exampleModal').modal('show');
  }
  });
});