 $(document).ready(function() {
  $('.viewModel').bind('click', function() {  
  var url = "/admin/viewprofile";
  var user = $(this).attr('id');
    $.get(
      url,
      {user: user},
      function(data) {
      $('#userview').show().html(data);
      });
  });
});

 $(document).ready(function() {
  $('.viewother').bind('click', function() {  
  var url = "/admin/viewothers";
  var user = $(this).attr('id');
    $.get(
      url,
      {user: user},
      function(data) {
      $('#userview').show().html(data);
      });
  });
});

  $(document).ready(function() {
  $('.viewapplicant').bind('click', function() {  
  var url = "/admin/viewapplicant";
  var user = $(this).attr('id');
    $.get(
      url,
      {user: user},
      function(data) {
      $('#userview').show().html(data);
      });
  });
});

 $(document).ready(function() {
  $('.verify').bind('click', function() {  
  var url = "/admin/verify";
  var user = $(this).attr('id');
        $('#sd'+user).hide('slow');
    $.get(
      url,
      {user: user},
      function(data) {
      });
  });
});

 $(document).ready(function() {
  $('.decline').bind('click', function() {  
  var url = "/admin/decline";
  var user = $(this).attr('id');
        $('#sd'+user).hide('slow');
    $.get(
      url,
      {user: user},
      function(data) {
        $('.hideit').remove();
      });
  });
});

 $(document).ready(function() {
  $('.acceptcast').bind('click', function() {  
  var url = "/admin/acceptcast";
  var castid = $(this).attr('id');
    $.get(
      url,
      {castid: castid},
      function(data) {
        $('.hideit').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.declinecast').bind('click', function() {  
  var url = "/admin/castdeclined";
  var castid = $(this).attr('id');
    $.get(
      url,
      {castid: castid},
      function(data) {
        $('.hideit').html(data);
      });
  });
});

  $(document).ready(function() {
  $('.acceptjob').bind('click', function() {  
  var url = "/admin/acceptjob";
  var castid = $(this).attr('id');
    $.get(
      url,
      {castid: castid},
      function(data) {
        $('.hideit').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.declinejob').bind('click', function() {  
  var url = "/admin/jobdeclined";
  var castid = $(this).attr('id');
    $.get(
      url,
      {castid: castid},
      function(data) {
        $('.hideit').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.acptserv').bind('click', function() {  
  var url = "/admin/acceptservice";
  var id = $(this).attr('id');
  var val = 'acptserv';
    $.get(
      url,
      {id: id,
        val : val},
      function(data) {
        $('.serv'+id).hide();
      });
  });
});

 $(document).ready(function() {
  $('.discserv').bind('click', function() {  
  var url = "/admin/modalservice";
  var id = $(this).attr('id');
  var val = 'discserv';
    $.get(
      url,
      {id: id,
        val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});

$(document).ready(function() {
  $('.sendmsg').bind('click', function() {  
  var url = "/admin/sendmsgservice";
  var id = $('.discid').val();
  var val = $('#discval').val();
  var para = $('.para').val();
    $.get(
      url,
      {id: id,
        val : val,
        para : para},
      function(data) {
    $('#exampleModal').modal('hide');
        $('.serv'+id).hide();
      });
  });
});

 $(document).ready(function() {
  $('.servinfo').bind('click', function() {   
  var url = "/admin/viewserviceinfo";
  var id = $(this).attr('id');
  var param = $('.paraminfo').val();
    $.get(
      url,
      {id: id,
        param : param},
      function(data) {
        $('#viewprofile').html(data);
      });
  });
});

  $(document).ready(function() {
  $('.acptphoto').bind('click', function() {  
  var url = "/admin/acceptservice";
  var id = $(this).attr('id');
  var val = 'acptphoto';
    $.get(
      url,
      {id: id,
        val : val},
      function(data) {
        $('.serv'+id).hide();
      });
  });
});

 $(document).ready(function() {
  $('.discphoto').bind('click', function() {  
  var url = "/admin/modalservice";
  var id = $(this).attr('id');
  var val = 'discphoto';
    $.get(
      url,
      {id: id,
        val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});

  $(document).ready(function() {
  $('.acptcourses').bind('click', function() {  
  var url = "/admin/acceptservice";
  var id = $(this).attr('id');
  var val = 'acptcourses';
    $.get(
      url,
      {id: id,
        val : val},
      function(data) {
        $('.serv'+id).hide();
      });
  });
});

 $(document).ready(function() {
  $('.disccourses').bind('click', function() {  
  var url = "/admin/modalservice";
  var id = $(this).attr('id');
  var val = 'disccourses';
    $.get(
      url,
      {id: id,
        val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.viewpaid').bind('click', function() {  
  var url = "/account/viewpaid";
  var id = $(this).attr('id');
    $.get(
      url,
      {id: id},
      function(data) {
        $('#userview').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.viewreceipt').bind('click', function() {  
  var url = "/account/viewreceipt";
  var id = $(this).attr('id');
    $.get(
      url,
      {id: id},
      function(data) {
        $('#userview').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.viewjobreceipt').bind('click', function() {  
  var url = "/account/viewjobreceipt";
  var id = $(this).attr('id');
    $.get(
      url,
      {id: id},
      function(data) {
        $('#userview').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.btnfilter').bind('click', function() {  
  var url = "/account/filterReport";
  var fromDay = $('select[name="fromDay"]').val();
  var fromMonth = $('select[name="fromMonth"]').val();
  var fromYear = $('select[name="fromYear"]').val();
  var toDay = $('select[name="toDay"]').val();
  var toMonth = $('select[name="toMonth"]').val();
  var toYear = $('select[name="toYear"]').val();
  var paystatus = $('select[name="paystatus"]').val();
  var location = $('select[name="location"]').val();
    $.get(
      url,
      {fromDay : fromDay,
      fromMonth : fromMonth,
      fromYear : fromYear,
      toDay : toDay,
      toMonth : toMonth,
      toYear : toYear,
      paystatus : paystatus,
      location : location},
      function(data) {
        $('#tabledisplay').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.viewslip').bind('click', function() {  
  var url = "/account/poppayslip";
  var id = $(this).attr('id');
    $.get(
      url,
      {id: id},
      function(data) {
        $('#userview').html(data);
      });
  });
});

 $(document).ready(function() {
  $('.viewjobslip').bind('click', function() {  
  var url = "/account/popjobpayslip";
  var id = $(this).attr('id');
    $.get(
      url,
      {id: id},
      function(data) {
        $('#userview').html(data);
      });
  });
});

  $(document).ready(function() {
  $('.selectType').bind('change', function() {  
  var url = "/account/changeType";
  var id = $(this).val();
    $.get(
      url,
      {id: id},
      function(data) {
        $('#userview').html(data);
      });
  });
});

  $(document).ready(function() {
  $('.getinc').bind('click', function() {  
  var url = "/account/getincome";
  var source = $('.source').val();
  var month = $('.month').val();
  var year = $('.year').val();
    $.get(
      url,
      {source : source,
       month : month,
       year : year},
      function(data) {
        $('#userview').html(data);
      });
  });
});

  $(document).ready(function() {
  $('.verifyphoto').bind('click', function() {  
  var url = "/account/getverifyphoto";
  var val = $(this).attr('id');
    $.get(
      url,
      {val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});

$(document).on('click', '.photoyes', function() {
    // body...
    var url = "/account/approvephoto";
  var val = $(this).attr('id');
    $.get(
      url,
      { val : val},
      function(data) {
    $('photo'+val).hide('slow');
    $('#exampleModal').modal('hide');
      });

})

  $(document).ready(function() {
  $('.verifycourses').bind('click', function() {  
  var url = "/account/getverifycourses";
  var val = $(this).attr('id');
    $.get(
      url,
      {val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});

$(document).on('click', '.courseyes', function() {
    // body...
    var url = "/account/approvecourse";
  var val = $(this).attr('id');
    $.get(
      url,
      { val : val},
      function(data) {
    $('#course'+val).hide('slow');
    $('#exampleModal').modal('hide');
      });

})

  $(document).ready(function() {
  $('.verifyservice').bind('click', function() {  
  var url = "/account/getverifyservice";
  var val = $(this).attr('id');
    $.get(
      url,
      {val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});

$(document).on('click', '.serviceyes', function() {
    // body...
    var url = "/account/approveservice";
  var val = $(this).attr('id');
    $.get(
      url,
      { val : val},
      function(data) {
    $('#service'+val).hide('slow');
    $('#exampleModal').modal('hide');
      });

})

  $(document).ready(function() {
  $('.verifycast').bind('click', function() {  
  var url = "/account/getverifycast";
  var val = $(this).attr('id');
    $.get(
      url,
      {val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});

$(document).on('click', '.castyes', function() {
    // body...
    var url = "/account/approvecast";
  var val = $(this).attr('id');
    $.get(
      url,
      { val : val},
      function(data) {
    $('#cast'+val).hide('slow');
    $('#exampleModal').modal('hide');
      });

})

  $(document).ready(function() {
  $('.verifyjob').bind('click', function() {  
  var url = "/account/getverifyjob";
  var val = $(this).attr('id');
    $.get(
      url,
      {val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});

$(document).on('click', '.jobyes', function() {
    // body...
    var url = "/account/approvejob";
  var val = $(this).attr('id');
    $.get(
      url,
      { val : val},
      function(data) {
    $('#job'+val).hide('slow');
    $('#exampleModal').modal('hide');
      });

})

  $(document).ready(function() {
  $('.verifysub').bind('click', function() {  
  var url = "/account/getverifysub";
  var val = $(this).attr('id');
    $.get(
      url,
      {val : val},
      function(data) {
        $('#userview').html(data);
      });
  });
});


$(document).on('click', '.subyes', function() {
    // body...
    var url = "/account/approvesub";
  var val = $(this).attr('id');
    $.get(
      url,
      { val : val},
      function(data) {
    $('#sub'+val).hide('slow');
    $('#exampleModal').modal('hide');
      });

})