<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>{{$property->title}}</title>
	<link href="{{ asset('public/assets/css/brochure.css?t='.time())}}" rel="stylesheet" type="text/css" />
<style>
* {
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}
@page {
size: auto;
margin: 0mm;
}

@media print { body { -webkit-print-color-adjust: exact; }
 a[href]:after {
 content: none !important;
  } 
}
@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
main{
margin-top:20px;
width: 100%;
max-width: 100%;
padding:20px;
}
</style>
</head>
<body>
<main id="section-to-print">
<section class="topSec pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('public/assets/img/logo.svg') }}" class="logoImg">
            </div>
        </div>
    </div>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-12 hadingSec text-center">
        <h1>{!! $property->title !!}</h1>
        <!-- <p>Town Square, Warde Apartments</p> -->
    </div>
  </div>
  <div class="row py-5">
    <div class="col-md-7">
      <ul class="roomFacility">
        <li>
        {{$property->bedrooms }} Bedrooms
        </li>
        <li>
        {{$property->baths }} Baths
        </li>
        <li>
        BUA: {{$property->buildup_area }} {{$property->measure_unit == 1 ? 'Sqft' : 'Sqmeter' }}
        </li>
      </ul>
      <div class="price pt-4">
        <h2>Price<br>AED {{number_format($property->price)}}</h2>
      </div>
    </div>
    @if(isset($property->images[0]))
    <div class="col-md-5">
      <div class="boxBanr">
        <img src="{{s3AssetUrl('uploads/property/'.$property->id.'/images/'.$property->images[0]->images_link) }}" class="w-100">
      </div>
    </div>
    @endif
  </div>
</div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="bannerImgBox w-100 mb-4">
          <div class="row">
            @if(count($property->images) > 0)
              @foreach($property->images->skip(1)->take(3) as $rs)
                <div class="col-4">
                  <img src="{{s3AssetUrl('uploads/property/'.$property->id.'/images/'.$rs->images_link) }}" class="w-100">
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
      @if(isset($property->images[0]))
        @if(isset($property->images[4]))
          @php
            $image=$property->images[4]->images_link;
          @endphp
        @else
          @php
            $image=$property->images[0]->images_link;
          @endphp
        @endif
      
      <div class="col-md-12">
        <div class="bnrImgBB">
          <img src="{{s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image) }}" class="w-100 p-4">
        </div>
      </div>
      @endif
    </div>
  </div>
</section>
<section class="midBlnk"></section>
<section class="contetnSec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h3 class="text-center mb-5">{!! $property->title !!}</h3>
      {!! $property->description !!}
      </div>
    </div>
    <!-- <div class="row my-5">
      <div class="col-md-12">
        <div class="d-flex flexB">
          <div class="flrBox text-center">
            <div class="flrIocn">
              <img src="img/shapes.png">
            </div>
            <h5>2 Floors</h5>
          </div>
          <div class="flrBox text-center">
            <div class="flrIocn">
              <img src="img/shapes.png">
            </div>
            <h5>3 Parking</h5>
          </div>
          <div class="flrBox text-center">
            <div class="flrIocn">
              <img src="img/shapes.png">
            </div>
            <h5>15m Street 
              Width</h5>
          </div>
          <div class="flrBox text-center">
            <div class="flrIocn">
              <img src="img/shapes.png">
            </div>
            <h5>12 Border Length </h5>
          </div>
          <div class="flrBox text-center">
            <div class="flrIocn">
              <img src="img/shapes.png">
            </div>
              <h5>Furnished</h5>
          </div>
          <div class="flrBox text-center">
            <div class="flrIocn">
              <img src="img/shapes.png">
            </div>
            <h5> East Facing</h5>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</section>
@if($property->floorPlans && count($property->floorPlans))
<section class="contetnSec2">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-center mb-5">FLOOR PLANS</h3>
      </div>
    </div>
    <div class="row">
      @php
        $i=1;
      @endphp
      @foreach($property->floorPlans as $image)
        @if(count($property->floorPlans) == 1)
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="mapBox w-100 h-100">
              <img src="{{s3AssetUrl('uploads/property/'.$property->id.'/floor_plan/'.$image->document_link) }}" class="w-100">
            </div>
          </div>
        @else
          @php
            $divWidth="w-75";
          @endphp
          @if($i > 1 && $i%2 == 0)
            @php
            $divWidth = "w-100";
            $i++;
            @endphp
          @endif
            <div class="col-md-4">
              <div class="mapBox w-100 h-100">
                <img src="{{s3AssetUrl('uploads/property/'.$property->id.'/floor_plan/'.$image->document_link) }}" class="{{$divWidth}}">
              </div>
            </div>
        @endif
      @endforeach
    </div>
    </div>
  </section>
  @endif
    <section class="addressSec mt-5 py-5">
      <div class="container">
        <div class="row">
          <div class="col-6">
            <div class="addBox h-100">
              <div class="flgg">
                <img src="{{asset('public/assets/img/flag1.jpg')}}" class="h-100 w-100">
              </div>
              <p class="text-center mb-2"><b>Riyadh Office</b></p>
              <p class="text-center mb-2">Prince Muhammad Ibn Salman St، Al Aqiq,
                Office 15, 2nd floor, Riyadh 13515</p>
                <p class="mb-2 text-center callP">+966 55 008 8601 | +971 424 34 692</p>
                <p class="socill text-center mb-0">
                <a href="https://www.facebook.com/madaproperties" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/madaproperties" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://twitter.com/MadaProperties" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://www.youtube.com/channel/UCeFvODTAaNG-pIiqSTsT39w" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                <a href="https://www.linkedin.com/company/madaproperties" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </p>
            </div>
          </div>
          <div class="col-6">
            <div class="addBox h-100">
              <div class="flgg">
                <img src="{{asset('public/assets/img/flag2.jpg')}}" class="h-100 w-100">
              </div>
              <p class="text-center mb-2"><b>Dubai Office</b></p>
              <p class="text-center mb-2">PO Box: 112037, Office 1106, Opal Tower,
                Business Bay, Dubai</p>
                <p class="mb-2 text-center callP">+971 50 377 0780 | +971 424 34 692</p>
                <p class="socill text-center mb-0">
                <a href="https://www.facebook.com/madapropertiesuae" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/madaproperties.uae/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://twitter.com/MadaPropUAE" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://www.youtube.com/channel/UCQWJrg12NV5GxxsBD9StC8Q" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                <a href="https://www.linkedin.com/company/mada-properties-uae" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    </main>
    <div class="content" style="min-height: auto;">
			<div class="content-wrapper p-1">
			<a href="mailto:?subject={{$property->title}}&amp;body=Check out this property {{ route('property.brochure',$property->id) }}" class="btn btn-info white">Send in email</a>

			<a href="javascript:void(0)" onclick="window.print()" target="_blank" class="btn btn-success white">Create PDF</a>
			<a href="whatsapp://send?text={{ route('property.brochure',$property->id) }}" data-action="share/whatsapp/share" class="btn btn-danger white">Share via Whatsapp</a>
			</div>
		</div>

</body>
</html>
