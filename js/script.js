
(function () {
  
  function pageInit(){
    $("li .content").addClass("hide");
    
    $(".content").click(function(e){
      e.stopImmediatePropagation();
      $(this).find(".hide").eq(0).removeClass("hide");
    });
  }
  
  $(document).on("pageinit", ".page", function (e) {
    pageInit();
  });
  
}());