NProgress.configure({ showSpinner: false });
NProgress.start();

$(window).on("load", function () {
  NProgress.done();
  $("#page").fadeIn(300).css("display", "flex");
});
