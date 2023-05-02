
<!DOCTYPE html>
<html>
<head>
<title>Mada- Board</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.mySlides {display:none;}
</style>
</head>

<body>

<h2 ></h2>

<section id="media">
  @foreach($datas as $data) 
 
     @if($data->type=='image')
       <img class="mySlides"  src="{{ $data->image }}"  style="width:100%;height: 100%; position: fixed">
     @elseif($data->type=='video')
      <!-- <video controls autoplay loop muted class="mySlides" style="width:100%;height: 100%; position: fixed">
        <source  src="{{$data->image }}" >
      </video> -->
    <object data="/music/lostmojo.wav">
<param name="controller" value="true">
<param name="autoplay" value="true">
</object>
     @endif
 
  @endforeach
</section>

<script>
  var myIndex = 0;
carousel();
  function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  autoplay = true;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 10000);
}

</script>

</body>
</html>