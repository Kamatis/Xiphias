$("#txtaDescription").focus(function(){
  $(this).siblings(".edit-controls").show();
  $(this).removeClass("txtaDescription");
});

//$("#txtaDescription").blur(function(){
//  $(this).siblings(".edit-controls").hide();
//  $(this).addClass("txtaDescription");
//});

$("#btnSaveDescription").click(function(){
  // save description ajax
  $(this).parent().hide();
  $('#txtaDescription').addClass("txtaDescription");
});

$(".knob").hover(
  function(){
    var color = $(this).data("fgcolor");
    $(this).css("color", color);
    $("#avatar").removeClass("avatarImage");
  },
  function(){
    $(this).css("color", "transparent");
    $("#avatar").addClass("avatarImage");
  }
);

//region Badges
// dashboard menu button links
// same as adding :D ahahahaha
$('body').on('click', '.btn-dashboard-menu', function(){
  $('.dashboard-page').hide();
  var panel = $(this).data('idlink');
  $(panel).show();
  var panelForm = $(panel).data('form');
  $('input:text').val("");
  $('textarea').val("");
  $('#base-lvl-badge').attr('src', "http://localhost/drive/Xiphias/CodeIgniter/assets/images/emptyBadge.png");
  $('.badge-level').remove();
  $('base-lvl-badge').attr('src', "<?php echo base_url('assets/images/emptyBadge.png'); ?>");
  $('#btn-change-passcode').hide();
});

$('body').on('click', '.badge-thumb', function(){
  var badgeId = $(this).data('badgeid');
  $.ajax({
    url: "getBadgeDetails",
    async: true,
    type: "POST",
    dataType: 'json',
    data: { badge_id:badgeId},
    success: function(jsonData) {
      $('#base-lvl-badge').attr('src', jsonData.baseLvlBadge);
      $('#txtBadgeName').val(jsonData.name);
      $('#txtaDescription').val(jsonData.description);
      $('.badge-level').remove();
      $('#badge-level-wrapper').append(jsonData.badgeLvls);
    }
  });
  $('#btn-save').show();
  $('#btn-add').hide();
});

$('#btnAddBadge').on('click', function(){
  $.ajax({
    url: "getEmptyUpgrade",
    async: true,
    type: "POST",
    data: { badge_id : 0 },
    dataType: "html",
    success: function (data) {
      $('#badge-level-wrapper').append(data);
      $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
    }
  });
  
});

//  $('.input-preview').on('change', function() {
//    alert('hoho');
//    readURL(this, $(this).siblings(".picture-src"));
//  });

$('body').on('change', '.input-preview', function() {
    readURL(this, $(this).siblings(".picture-src"));
})

$('body').on('click', '.btn-delete-upgrade', function() {
  $(this).closest('.badge-level').remove();
})


function readURL(input, pic) {
  if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            pic.attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('[data-toggle="radio"]').click(function(event){
  $(".choice").removeClass('active');
  $('.choice').children('input').removeAttr('checked');
  $(this).addClass('active');
  $(this).children('input').attr('checked', 'true');
});

$('input#txt-search').on('input', function(){
  $.ajax({
    url: "searchQuests",
    type: 'post',
    data: { searchTxt : txtInput },
    success: function(data) {
      $('li.list-item-quest').remove();
      $('#quest-list').append(data);
    }
  })
});

$('#badge-form').on('submit', function(e){
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: "addBadge",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function(dataPass){
      BootstrapDialog.show({
            title: 'SUCCESS',
            message: 'ADDED!'
        });
//        alert(dataPass);
        $('input').val("");
        $('textarea').val("");
        $('#base-lvl-badge').attr('src', "http://localhost/drive/Xiphias/CodeIgniter/assets/images/emptyBadge.png");
        $('.badge-level').remove();
        $('base-lvl-badge').attr('src', "<?php echo base_url('assets/images/emptyBadge.png'); ?>");
        $('#my-badges').html(dataPass);
    }
  })
});

$('#btn-add-badge').on('click', function(e){
    e.preventDefault();
  $('#badge-form').submit();
})
//endregion

//region Party
$('body').on('click', '.list-item-party', function(){
  var partyId = $(this).data('partyid');
  $.ajax({
    url: "getPartyDetails",
    async: true,
    type: "POST",
    dataType: 'json',
    data: { party_id:partyId },
    success: function(jsonData) {
      $('#txt-party-name').val(jsonData['partyName']);
      $('#txt-party-description').val(jsonData['partyDescription']);
      $('#list-party-members').html(jsonData['partyMember']);
    }
  });
  $('#btn-save').show();
  $('#btn-add').hide();
  $('#btn-change-passcode').show();
  $('#btn-change-passcode').data('selparty', $(this).data('partyid'));
  
});

$('body').on('click', '#btn-award-ok', function(){
  var formData = new FormData($('#party-form'));
  var badgeid = $('.bordered').data('badgeid');
  formdata.append('badge_id', badgeid);
  $.ajax({
    url: "awardBadge",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function(dataPass){
      BootstrapDialog.show({
            title: 'SUCCESS',
            message: 'ADDED!'
        });
//        alert(dataPass);
        $('input').val("");
        $('textarea').val("");
        $('#base-lvl-badge').attr('src', "http://localhost/drive/Xiphias/CodeIgniter/assets/images/emptyBadge.png");
        $('.badge-level').remove();
        $('base-lvl-badge').attr('src', "<?php echo base_url('assets/images/emptyBadge.png'); ?>");
        $('#my-badges').html(dataPass);
    }
  })
});

$('body').on('click', '.badge-thumb', function(){
  $('.badge-thumb').removeClass('bordered');
  $(this).addClass('bordered');
});

$('#btn-award-badge').on('click', function(){
  $.ajax({
    url: 'getAwardingBadge',
    type: 'post',
    success: function(dataPass) {
      BootstrapDialog.show({
        title: 'Award a Badge',
        message: '<ul class="grid columns-3 nav scrollable-menu" id="my-badges">' + dataPass + '</ul>',
        buttons: [{
          id: 'btn-award-ok',
          label: 'Award',
          action: function(dialog){
            dialog.close();
          }
        }, {
          id: 'btn-award-cancel',
          label: 'Cancel',
          action: function(dialog){
            dialog.close();
          }
        }]
      });
    }
  });
  
});

$('#btn-change-passcode').on('click', function(){
  $.ajax({
    url: 'changePasscode',
    type: 'post',
    success: function() {
      
    }
  })
});
// endregion

// region Quests
$('input[name="date-range"]').daterangepicker({
        format: 'YYYY-MM-DD',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '2012-01-01',
        maxDate: '2015-12-31',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

$('body').on('click', '.list-item-quest', function() {
    var questId = $(this).data('questid');
    $.ajax({
        url: 'getQuestDetails',
        type: 'post',
        dataType: 'json',
        data: { quest_id : questId },
        success: function(dataPass) {
            var rarityID = '#rarity' + dataPass['questRarity'];
            $('#quest-name').val(dataPass['questTitle']);
            $('#quest-description').val(dataPass['questdescription']);
            $('.choice').removeClass('active');
            $('input:radio').removeAttr('checked');
            $(rarityID).attr('checked', 'checked');
            $(rarityID).parent().addClass('active');
            $('#quest-venue').val(dataPass['questVenue']);
            $('#quest-date').val(dataPass['questDate']);
            $('#quest-exp').val(dataPass['questExp']);
            $('#quest-members').html(dataPass['questRegistrant']);
        }
    });
});

$('#txt-exp-input').val($('.slider input').val());

//$('#btn-qreg-refresh').on('click', function(){
//  var questId = $()
//});

$('#form-quest').on('submit', function(e){
    e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: "addQuest",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function(dataPass){
        alert(dataPass);
        if(dataPass == "ok") {
            BootstrapDialog.show({
               title: 'SUCCESS',
                message: 'Quest Added!',
                buttons: [{
                    label: 'OK',
                    action: function(dialog) {
                        dialog.close();   
                    }
                }]
            });
        }
        else {
            BootstrapDialog.show({
               title: 'OOPS...',
                message: 'Something is wrong',
                buttons: [{
                    label: 'OK',
                    action: function(dialog) {
                        dialog.close();   
                    }
                }]
            });
        }
    }
  });
  
});

$('#btn-quest-add').on('click', function(e) {
    e.preventDefault();
   $('#form-quest').submit(); 
});
// endregion

// region Serial
$('#serial-form').on('submit', function(e){
  e.preventDefault();
  var npcid = $('#txt-npc-id').val();
  $.ajax({
    url: 'generateSerial',
    type: 'post',
    data: { npcID : npcid },
    success: function(dataPass) {
      $('#txt-serial-code').val(dataPass);
    }
  });
});

$('#btn-generate-serial').on('click', function(e){
  e.preventDefault();
  $('#serial-form').submit();
});
// endregion

$('#verify-account').on('click', function() {
  BootstrapDialog.show({
    title: 'Account Verification',
    message: $('<input type="text" id="verification-code" class="form-control" placeholder="Enter verification code.">'),
    buttons: [{
      id: 'btn-verify-ok',
      label: 'Verify',
      action: function(dialog) {
        var vcode = $('#verification-code').val();
        if($('#btn-verify-ok').html() == "OK")
          dialog.close();
        else {
            $.ajax({
              url: 'http://127.0.0.1/drive/xiphias/codeigniter/index.php/pages/checkVerification',
              type: 'post',
              data: { verificationCode: vcode },
              success: function(dataPass) {
                if(dataPass == "ok") {
                  $('#btn-verify-ok').html('OK');
                  dialog.setMessage('You are now verified! Dashboard has been activated.\nYou may need to refresh the browser for the dashboard to open up.');
                  $('#btn-verify-cancel').remove();
                }
                else {
                
                }
              }
            });
        }
        
      }
    }, {
      id: 'btn-verify-cancel',
      label: 'Cancel',
      action: function(dialog) {
        dialog.close();
      }
    }]
  });
});