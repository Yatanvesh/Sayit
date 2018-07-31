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
  $('#username').val(globalUserName)

var ip = '$IP'
const slideTimeout=200
hoverDisable=false
const minDeviceWidth=450

$('#masterlayout').load('loadAllQuotes.php',Interceptor)

$('#inputcontainer').hide()

$(document).mousemove(function(event){
  mouseLeft= event.pageX
  mouseTop = event.pageY
})

$(document).click(function(event){
  $('.customcontextmenu').css({'display':'none'}).html('')
})

$('.customcontextmenu').click(function(){
  if(currentHoverId>=0 )
  {
    var dummy = document.createElement("input")
    document.body.appendChild(dummy)
    dummy.setAttribute('id', 'dummy_id')
    //currentQuoteText = currentQuoteText.replace('{\d+:\d+\}','')
    document.getElementById("dummy_id").value =currentQuoteText
    dummy.select()
    document.execCommand("copy")
    document.body.removeChild(dummy)
  }
})



function Interceptor(){

  $('.quotecontainer').hover(function(){
    currentHoverId=$(this).children(":first").attr('id')
    currentQuoteText=$(this).children(":first").html() + ' ' + $(this).children(':nth-child(2)').html()
    window.oncontextmenu= function(event){
      if($('.menu').width()>minDeviceWidth){
        setTimeout(function(){
          $('.customcontextmenu').css({'display':'block','left':mouseLeft,'top':mouseTop}).html('Copy')
        },70)
        return false
      }
      else return true
    }

if($('.menu').width()>minDeviceWidth && !hoverDisable ){
    $(this).css('font-size','1.3em')
}
  },function(){
  $(this).css('font-size','1.0em')
  window.oncontextmenu= function(){return true}
  })

  $(".trashImg").click(function(){
    var deleteId = $(this).siblings().first().attr('id')
    $.post("handler.php",
    {
      deleteId:deleteId
    }, function(data){
      if(data==1)
      {
        hoverDisable=true
        $('#' +deleteId).parent().slideToggle(200, function()
        {
          setTimeout(function(){
            hoverDisable=false
              $('#' +deleteId).parent().remove()
          },300)
        })
      }

    })
   });
}

$('#newquote').click(function()
{
$('#inputcontainer').slideToggle(400).css('display','inline-block')
$('#quotearea').focus()
})

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
  },function(data){

    if(data>=0)
    {
        $.post("handler.php", {
          fetchQuoteById:data
        },function(returnedQuoteContainer){
          $('#masterlayout').prepend(returnedQuoteContainer)

        })
    }

  }).complete(function(){
    setTimeout(function(){
        Interceptor()
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
