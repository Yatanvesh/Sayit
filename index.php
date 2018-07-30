<?php
require_once 'header.html';
require_once 'functions.php';

session_start();

$IP=$_SERVER['REMOTE_ADDR'];

if(isset($_SESSION['sessionUserName']))
{
  $sessionUserName= sanitizeString($_SESSION['sessionUserName']);
  echo <<<_END
<script>
var globalUserName= '$sessionUserName'
_END;
}
else
echo "<script> var globalUserName=''";

echo <<< _END


if(globalUserName!='')
{
  
  $('#username').val(globalUserName)
}
var ip = '$IP'


$('#masterlayout').load('loadAllQuotes.php',deleteInterceptor)
$('#inputcontainer').hide()
function deleteInterceptor(){
  $(".trashImg").click(function(){
    var deleteId = $(this).siblings().first().attr('id')
    $('#' +deleteId).parent().slideToggle(300, function()
    {
      setTimeout(function(){
        $('#masterlayout').load('loadAllQuotes.php',deleteInterceptor)
      },300)

    })
    $.post("handler.php",
    {
      deleteId:deleteId
    })
   });
}

$('#newquote').click(function()
{
$('#inputcontainer').slideToggle(400).css('display','inline-block')
$('#quotearea').focus()
})

var slideTimeout=200
$('#newquote').hover(function(){
  var quote=$('#sitelogo')
  quote.slideToggle(slideTimeout)
  setTimeout(function(){quote.html("Write")},slideTimeout)
  quote.slideToggle(slideTimeout)
}, function(){
  var quote=$('#sitelogo')
  quote.slideToggle(slideTimeout)
  setTimeout(function(){quote.html("Sayit")},slideTimeout)
  quote.slideToggle(slideTimeout)
})


$('.inputquote').submit(function(event){
  event.preventDefault();

  var quote = $('#quotearea').val()
  var quoter= $('#username').val()
  globalUserName= quoter
  document.cookie = 'uname=' +globalUserName

  $.post("handler.php", {
    quote:quote,
    quoter:quoter,
    ip:ip
  }).complete(function(){
    setTimeout(function(){
      $('#masterlayout').load('loadAllQuotes.php',deleteInterceptor)

    },100)
    $('#inputcontainer').slideToggle(300).css('display','inline-block')
    setTimeout(function(){
    $('.inputquote').trigger("reset")
    $('#username').val(globalUserName)
  },300)

  })

})



</script>
</body>
</html>
_END

?>
