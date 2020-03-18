$('a[href="#hide-item"]').click(function () {
  var elem = $(this);
  var parent = $(this).parent(".action-btn");
  var id = parent.attr("data-global-id-item");
  $.ajax({
    url: "/account/ajax.php?action=hide_item&id="+id,
    dataType: "json",
    success: function (mes) {
      if (typeof mes.success !== "undefined") {
        $("#item-"+id).css("opacity", "0.6");
        elem.hide();
        parent.find('a[href="#show-item"]').show();
      }
    }
  });
});

$('a[href="#show-item"]').click(function () {
  var elem = $(this);
  var parent = $(this).parent(".action-btn");
  var id = parent.attr("data-global-id-item");
  $.ajax({
    url: "/account/ajax.php?action=show_item&id="+id,
    dataType: "json",
    success: function (mes) {
      if (typeof mes.success !== "undefined") {
        $("#item-"+id).css("opacity", "1");
        elem.hide();
        parent.find('a[href="#hide-item"]').show();
      }

    }
  });
});


$('a[href="#delete-item"]').click(function () {
  var bDel =  confirm("Вы подтверждаете удаление?");
  if (bDel) {
    var parent = $(this).parent(".action-btn");
    var id = parent.attr("data-global-id-item");
    $.ajax({
      url: "/account/ajax.php?action=delete_item&id=" + id,
      dataType: "json",
      success: function (mes) {
        if (typeof mes.success !== "undefined") {
          $("#item-" + id).fadeOut(300, function () {
            $("#item-" + id).remove();
          });
        }
      }
    });
  }
});