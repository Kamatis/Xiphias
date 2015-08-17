$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});

var socket = io.connect('http://localhost:8080');

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

//region Registration

$('.btn.toggleable').on('click', function(){
  $('.btn.toggleable').removeClass('active');
  $(this).addClass('active');
});

$('#btn-next').on('click', function(){
  var nextItem = $('li.current').next();
  $('li.current').fadeOut(1000);
  nextItem.fadeIn(1000);
  if(nextItem.hasClass('last-question'))
  {
    $(this).fadeOut(1000);
    
    // @kelly:
    // So yah this is the ajax part
    // tiglaag ko na mga data.. haven't tested but probably works
    // ang irereturn/echo mo na dataPass e2ng view na lastPanel.php sa views/register
    // check mo lastPanel.php for the data needed duman
    
    var last = $('input[name="last_name"]').val();
    var first = $('input[name="first_name"]').val();
    var middle = $('input[name="middle_name"]').val();
    var type = $('.btn.active').data('value');
    var un = $('input[name="username"]').val();
    var pw = $('input[name="password"]').val();
    $.ajax({
      url: 'accountRegistration',
      type: "POST",
      data: { last_name:last, 
              first_name:first,
              middle_name:middle,
              user_type:type,
              username:un,
              password:pw },
      success: function(dataPass){
        $('li.last-question').html(dataPass);
      }
    });
  }
    
  $('li.current').removeClass('current');
  nextItem.addClass('current');
  
//  $('li.current').fadeOut('slow', function(){
//    nextItem.fadeIn('slow', function(){
//      $('li.current').removeClass('current');
//      nextItem.addClass('current');
//    });
//  });
  
});

//endregion

//region QuestBoard
$('.btn-join-quest').on('click', function(e){
  e.preventDefault();
  var qid = $(this).data("questid");
  var btn = $(this);
  if($(this).html() == "Join") {
//    alert(qid);
    $.ajax({
      url: 'questRegistration',
      type: 'post',
      data: { quest_id:qid },
      success: function(){
//        alert(btn.html());
        btn.html('Abort');
      }
    });
  }
  else if($(this).html() == "Abort") {
    $.ajax({
      url: 'questAbort',
      type: 'post',
      data: { quest_id:qid },
      success: function(){
        btn.html('Join');
      }
    });
  }
});
//endregion

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
  $('#base-lvl-badge').attr('src', "http://" + window.location.hostname + "/xiphias/assets/images/emptyBadge.png");
  $('.badge-level').remove();
  $('base-lvl-badge').attr('src', "http://" + window.location.hostname + "/xiphias/assets/images/emptyBadge.png");
  $('#btn-change-passcode').hide();
});

$('body').on('click', '.badge-thumb', function(){
  var badgeId = $(this).data('badgeid');
  $.ajax({
    url: "http://" + window.location.hostname + "/xiphias/index.php/ajax/getBadgeDetails",
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
        $('#base-lvl-badge').attr('src', "http://" + window.location.hostname + "/xiphias/assets/images/emptyBadge.png");
        $('.badge-level').remove();
        $('base-lvl-badge').attr('src', "http://" + window.location.hostname + "/xiphias/assets/images/emptyBadge.png");
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
    url: "http://" + window.location.hostname + "/xiphias/index.php/ajax/getPartyDetails",
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

$('body').on('click', '#btn-save-profile', function(){
  var formData = new FormData(document.getElementById('edit-profile'));
  $.ajax({
    url: "http://" + window.location.hostname + "/xiphias/index.php/pages/updateProfile",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    async:false
  })
});

$('body').on('click', '#btn-award-ok', function(){
  var formData = new FormData(document.getElementById('quest-registrants'));
  var badgeid = $('.bordered').data('badgeid');
  var questid = $('.list-item-quest.active').data('questid');
  formData.append('badge_id', badgeid);
  formData.append('quest_id', questid);
  $.ajax({
    url: "http://" + window.location.hostname + "/xiphias/index.php/pages/awardReward",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    aync: false,
    success: function(dataPass){
      socket.emit('feed', { streamItem : dataPass });
      BootstrapDialog.show({
            title: 'SUCCESS',
            message: 'ADDED!'
        });
    }
  })
});

$('body').on('click', '.badge-thumb', function(){
  $('.badge-thumb').removeClass('bordered');
  $(this).addClass('bordered');
});

$('#btn-award-badge').on('click', function(){
//  <ul class="grid columns-3 nav scrollable-menu" id="my-badges">' + dataPass + '</ul>
  $.ajax({
    url: 'getAwardingBadge',
    type: 'post',
    success: function(dataPass) {
      BootstrapDialog.show({
        title: 'Award Rewards',
        message: 'Are you sure you want to award the rewards?',
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

$('#btn-party-add').on('click', function(e){
    e.preventDefault();
    $('#party-form').submit();         
})

$('#party-form').on('submit', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: "addParty",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function(dataPass){
            BootstrapDialog.show({
                title: 'SUCCESS',
                message: 'ADDED!'
            });
            $('input').val("");
            $('textarea').val("");
            $('#party-list').html(dataPass);
        }
    });
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
           'This Month': [moment().startOf('month'), moment().endOf('month')],
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
    var activeli = $(this);
    $.ajax({
        url: 'http://' + window.location.hostname + '/xiphias/index.php/ajax/getQuestDetails',
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
            $('input[name="range"]').prop('disabled', false);
            $('input[name="range"]').attr('min', $('.choice').children('input:checked').data('minexp'));
            $('input[name="range"]').attr('max', $('.choice').children('input:checked').data('maxexp'));
            $('input[name="range"]').attr('value', dataPass['questExp']);
            $('#rangeSuccess').html(dataPass['questExp']);
            $('#quest-badge-reward').data('badgeid', dataPass['badge_id']);
            $('#badge-reward-img').attr('src', (dataPass['badge_image']));
            $('#quest-members').html(dataPass['questRegistrant']);
            $('.list-item-quest').removeClass('active');
            activeli.addClass('active');
        }
    });
});

$('.choice').on('click', function(){
  $('input[name="range"]').prop('disabled', false);
  $('input[name="range"]').attr('min', $(this).children('input:checked').data('minexp'));
  $('input[name="range"]').attr('max', $(this).children('input:checked').data('maxexp'));
  $('input[name="range"]').attr('value', $(this).children('input:checked').data('minexp'));
  $('#rangeSuccess').html($(this).children('input:checked').data('minexp'));
});

function popOver(element, body){
    element
        .attr('data-content', body)
        .popover('fixTitle')
        .popover('setContent');

    element.popover('show');
}

function popDown(element) {
  element.popover('hide');
}

$('body').on('click', '#badge-reward-list .badge-thumb', function(){
  var id = $(this).data('badgeid');
  $('#quest-badge-reward').data('badgeid', id);
  $('#quest-badge-reward').attr('data-badgeid', id);
  var imgSource = $(this).children('img').attr('src');
  $('#badge-reward-img').attr('src', imgSource);
  popDown($('#quest-badge-reward'));
});

$('#quest-badge-reward').on('click', function(){
  var badgeID = $(this).data('badgeid');
  $.ajax({
    url: 'getAwardingBadge',
    type: 'post',
    data: { badge_id:badgeID },
    success: function(datapass){
      var ul = '<ul class="grid columns-3 nav scrollable-menu" id="badge-reward-list">' + datapass + '</ul>';
      popOver($('#quest-badge-reward'), ul);
    }
  });
  
});
                    
$('#form-quest').on('submit', function(e){
   e.preventDefault();
   var formData = new FormData(this);
   var badgeid = $('#quest-badge-reward').data('badgeid');
  formData.append('badge_id', badgeid);
//  socket.emit('feed', { streamItem: badgeid });
//  alert(JSON.stringify(formData));
  $.ajax({
    url: "addQuest",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function(dataPass){
//        socket.emit('feed', { name: questid, message: questid });
        BootstrapDialog.show({
            title: 'SUCCESS',
            message: 'ADDED!'
        });
      
        $('input').val("");
        $('textarea').val("");
        $('#quest-list').html(dataPass);
    }
  });
  
});

$('#btn-quest-add').on('click', function(e) {
//  e.preventDefault();
   $('#form-quest').submit(); 
});
// endregion

// region Office

$('#btn-office-add').on('click', function(e){
    e.preventDefault();
    $('#office-form').submit();         
})

$('#office-form').on('submit', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "addOffice",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function(dataPass){
            BootstrapDialog.show({
                title: 'SUCCESS',
                message: 'ADDED!'
            });
            $('input').val("");
            $('textarea').val("");
            $('#office-logo').attr('src', "http://" + window.location.hostname + "/xiphias/assets/images/emptyBadge.png");
            $('#office-logo').attr('src', "http://" + window.location.hostname + "/xiphias/assets/images/emptyBadge.png");
            $('#office-list').html(dataPass);
        }
    });
});

$('body').on('click', '.list-item-office', function(){
  var officeId = $(this).data('officeid');
  $.ajax({
    url: "http://" + window.location.hostname + "/xiphias/index.php/ajax/getOfficeDetails",
    async: true,
    type: "POST",
    dataType: 'json',
    data: { office_id:officeId},
    success: function(jsonData) {
      $('#office-logo').attr('src', jsonData.officeLogo);
      $('#txt-office-name').val(jsonData.officeName);
      $('#txt-office-description').val(jsonData.officeDescription);
    }
  });
  $('#btn-save').show();
  $('#btn-add').hide();
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
              url: 'http://' + window.location.hostname + '/xiphias/index.php/pages/checkVerification',
              type: 'post',
              data: { verificationCode: vcode },
              success: function(dataPass) {
                if(dataPass == "ok") {
                  $('#btn-verify-ok').html('OK');
                  dialog.setMessage('You are now verified! Dashboard has been activated.\nYou may need to refresh the browser for the dashboard to open up.');
                  $('#btn-verify-cancel').remove();
                }
                else {
                  alert("ERROR!");
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

//region leaderboards

function namelink(value, row) {
  var username = value.split("/");
  return '<a href="' + value + '">' + username[username.length-1] + '</a>';
}

function unrank(value, row) {
  if(row.points == 0) return '-';
  else return value;
}

function changeTopThree(questType) {
  $.ajax({
    url: 'changeTopThree',
    type: 'post',
    data: { quest_type : questType },
    success: function(dataPass) {
      $('.staircase').html(dataPass);
    }
  });
}

$('#sel-quest-type').on('change', function(){
  var selectedVal = $('#sel-quest-type option:selected' ).val();
  var geturl = "";
  if(selectedVal == "Academic")
    geturl = "http://" + window.location.hostname + "/xiphias/index.php/pages/getRankings/Academic";
  else if(selectedVal == "Co-Curricular")
    geturl = "http://" + window.location.hostname + "/xiphias/index.php/pages/getRankings/Co-Curricular";
  else if(selectedVal == "Extra Curricular")
    geturl = "http://" + window.location.hostname + "/xiphias/index.php/pages/getRankings/Extra-Curricular";
  
  changeTopThree(selectedVal);
  $('#rank-table').bootstrapTable('refresh', {
    url: geturl
  });
});

//endregion

// region profile

$('#btn-edit-profile').on('click', function(){
  BootstrapDialog.show({
    title: 'Edit Profile',
    message: $('<div class="container"></div>').load('http://' + window.location.hostname + '/xiphias/index.php/pages/editProfile'),
    cssClass: 'edit-profile-dialog'
  });
});

$('#btn-create-resume').on('click', function(){
  BootstrapDialog.show({
    title: 'Create Resume',
    message: $('<div class="container"></div>').load('http://' + window.location.hostname + '/xiphias/index.php/pages/createResume'),
    cssClass: 'edit-profile-dialog'
  });
});

$('body').on('click', '#primary-add', function(){
  $('#select-primary').toggle();
  $('#input-primary').toggle();
  $(this).toggle();
  $('#primary-list').toggle();
});

$('body').on('click', '#primary-list', function(){
  $('#input-primary').val('');
  $('#input-primary').toggle();
  $('#select-primary').toggle();
  $(this).toggle();
  $('#primary-add').toggle();
});

$('body').on('click', '#secondary-add', function(){
  $('#select-secondary').toggle();
  $('#input-secondary').toggle();
  $(this).toggle();
  $('#secondary-list').toggle();
});

$('body').on('click', '#secondary-list', function(){
  $('#input-secondary').val('');
  $('#input-secondary').toggle();
  $('#select-secondary').toggle();
  $(this).toggle();
  $('#secondary-add').toggle();
});

$('body').on('click', '#add-affil', function(){
  BootstrapDialog.show({
    title: 'Add Affiliation',
    message: $('<div></div>').load('http://' + window.location.hostname + '/xiphias/index.php/pages/showAddAffiliation'),
    buttons: [{
                label: 'Add',
                action: function(dialog) {
                    var n = $('input-org-name').val();
                    var p = $('input-position').val();
                    var d = $('input-join-date').val();
                    $.ajax({
                      url: 'addAffiliation',
                      type: 'post',
                      data: { name:n,
                              position: p, 
                              date: d },
                      success: function(){
                        alert('Affiliation Added');
                      }
                    })
                }
            }, {
                label: 'Cancel',
                action: function(dialog) {
                    dialog.close();
                }
            }]
  });
})

$('body').on('click', '#add-involve', function(){
  BootstrapDialog.show({
    title: 'Add Involvement',
    message: $('<div></div>').load('http://' + window.location.hostname + '/xiphias/index.php/pages/showAddInvolvement'),
    buttons: [{
                label: 'Add',
                action: function(dialog) {
                    var n = $('input-inv-name').val();
                    var p = $('input-inv-venue').val();
                    var d = $('input-inv-date').val();
                    $.ajax({
                      url: 'addInvolvement',
                      type: 'post',
                      data: { name:n,
                              position: p, 
                              date: d },
                      success: function(){
                        alert('Involvement Added!');
                      }
                    })
                }
            }, {
                label: 'Cancel',
                action: function(dialog) {
                    dialog.close();
                }
            }]
  });
})
// endregion

//region Sockets


$('#')

socket.on('message', function(data){
  var actualContent = $("#feeder").html();
  var msgContent = '<li>' + data.name + '</li>';
  var concatCOntent = msgContent + actualContent;
  $('#feeder').html(concatCOntent);
});
//endregion
