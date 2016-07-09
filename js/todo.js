function cleanUp() {

  // WRAP LIST TEXT IN A P, AND APPLY FUNCTIONALITY TABS
  $(".panel li")
    .wrapInner("<p>")
    .prepend("<div class=\"btn-group\"><button type=\"button\" class=\"btn btn-primary check\"><span class=\"glyphicon glyphicon-ok\"></span></button><button type=\"button\" class=\"btn btn-primary del\"><span class=\"glyphicon glyphicon-remove\"></span></button></div>");

};

$("li").on("click", ".check", function() {
   console.log("click");
   $(this).parent().parent().find("p").css("text-decoration","line-through"); 
});

$("li").on("click", ".del", function() {
   console.log("del");
   $(this).parent().parent().fadeOut("fast");  
});

$("form").on("click", "button", function(){
   console.log("add"); 
   $(".panel ul").append("<li>hi kids</li>"); 
});