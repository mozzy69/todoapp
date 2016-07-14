function cleanUp() {

// WRAP LIST TEXT IN A P, AND APPLY FUNCTIONALITY TABS
$(".panel li")
    .wrapInner("<p>")
    .prepend("<div class=\"btn-group\"><button type=\"button\" class=\"btn btn-primary check\"><span class=\"glyphicon glyphicon-ok\"></span></button><button type=\"button\" class=\"btn btn-primary del\"><span class=\"glyphicon glyphicon-remove\"></span></button></div>");

//check if ListItemDone and render strike-through when needed
$.ajax({
    type: "POST",
    url:"inc/renderStrike.php",
    async: true,
    dataType: "json",
    success: function( msg ) {
	strikeArrLength = msg.length;
	for (i = 0; i < strikeArrLength; i++) {
    		console.log(msg[i]);
		if(msg[i] > 0){
		$(".panel li:eq(" + i + ")").find("p").css("text-decoration","line-through");
		}else{
		$(".panel li:eq(" + i + ")").find("p").css("text-decoration","none");	
		}
	}//end for
    }//end success function
});

};//end cleanup main function

//Check status of ListItemDone and render strike-through if needed
$("li").on("click", ".check", function() {
   //Get li index value from DOM
   var checkNum = $(this).parent().parent().index();   

   $.ajax({
    type: "POST",
    url:"inc/done.php",
    data: "val=" + checkNum,
    async: true,
    dataType: "text",
    success: function( data ) {
	if(data > 0){
		$(".panel li:eq(" + checkNum + ")").find("p").css("text-decoration","line-through");
	}else{
		$(".panel li:eq(" + checkNum + ")").find("p").css("text-decoration","none");	
	}
    }//end success function
   });//end ajax call 
  	 
});//end click for done functionallity

//Delete list items
$("li").on("click", ".del", function() {
   //Remove entry from DOM
   $(this).parent().parent().fadeOut("fast");
   var checkNum = $(this).parent().parent().index();
   //Remove entry from database	 
   $.post('inc/delete.php', 'val=' + checkNum);
});



