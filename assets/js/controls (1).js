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

// dashboard menu button links
$('.btn-dashboard-menu').on('click', function(){
  $('.dashboard-page').hide();
  var panel = $(this).data('idlink');
  $(panel).show();
  var panelForm = $(panel).data('form');
  $('input').val("");
  
});


$('.badge-thumb').on('click', function(){
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
    success: function(data){
      alert(data);
    }
  })
});

$('#btn-add-badge').on('click', function(e){
  $('#badge-form').submit();
})