$(".submenu").click(function () {
  $(this).children("ul").slideToggle();
  console.log("Has dado clic");
});
$("ul").click(function (p) {
  p.stopPropagation();
});
$(".submenu").mouseenter(function () {
  $(this).children("ul").css("display", "block");
});
$(".submenu").mouseleave(function () {
  $(this).children("ul").css("display", "none");
});
$("#close-menu").click(function () {
    $("#btn-menu").prop("checked", false);
});
