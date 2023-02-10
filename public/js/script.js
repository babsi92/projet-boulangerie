$(".burger").click(function () {
  if (!$(this).hasClass("active")) {
    $(".liens_mobile").css("right", "0px");
    $(this).addClass("active");
  } else {
    $(".liens_mobile").css("right", "-170px");
    $(this).removeClass("active");
  }
});

$(".parallax-window").parallax();

$(document).ready(function () {
  $(".carousel").slick({
    dots: true,
    autoplay: true,
    autoplaySpeed: 1000,
  });
});

$("h1").fadeIn(10000); //per transizione lenta (mettendo display:none sul titolo)
$(".parallax-p").fadeIn(15000);

var i = 0;

setInterval(function () {
  if (i <= 35) {
    $(".parallax-p").css("left", i + "%");
    i++;
  }
}, 100);

