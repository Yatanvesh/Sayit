<?php
require_once 'header.html';
require_once 'functions.php';

echo <<< _END

<script >

// DEBUG-----------------------------------------
var n = localStorage.getItem('on_load_counter');
if (n === null) {
    n = 0;
}
n++;
localStorage.setItem("on_load_counter", n);
console.log(n)
//-----------------------------------------

$('#masterlayout').load('loadAllQuotes.php',deleteInterceptor)

function deleteInterceptor(){
  $(".trashImg").click(function(){
    var deleteId = $(this).siblings().first().attr('id')
    $.post("handler.php",
    {
      id:deleteId
    },
    function(data,status){
      $('#masterlayout').load('loadAllQuotes.php',deleteInterceptor)

    })
   });
}

$('#newquote').click(function()
{
$('#inputcontainer').slideToggle(400).css('display','inline-block')
$('#quotearea').focus()
})


$('.inputquote').submit(function(event){
  event.preventDefault();

  var quote = $('#quotearea').val()
  var quoter= $('#username').val()


  $.post("handler.php", {
    quote:quote,
    quoter:quoter
  }).complete(function(){
    $('#masterlayout').load('loadAllQuotes.php',deleteInterceptor)
    $('#inputcontainer').slideToggle(200).css('display','inline-block')
    setTimeout(function(){
    $('.inputquote').trigger("reset")
    },200)

  })

})



</script>
</body>
</html>
_END

?>
