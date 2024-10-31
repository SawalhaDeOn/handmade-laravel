<section id="hero" class="hero">
    <div class="home">
        <h2>{{__('Handmade')}}</h2>
        <div class="origin-story-box">
            {{__('The origin of the story')}}
        </div>
    </div>
    <div  id="about-us" class="product-categories">
        <p>
            {{__('The first Palestinian company to embrace all handmade crafts and heritage works with a national and cultural character from all parts of the homeland. We aim to strengthen the Palestinian economy by promoting handicrafts that reflect Palestinian heritage and identity. Product Categories: We welcome all types of heritage and handmade crafts, including embroidery, accessories, woodwork, handmade candles, and many other innovative handicrafts.')}}
        </p>
        <h2>{{__('Product Categories')}}</h2>
        <p>{{__('We welcome all types of traditional and handmade crafts products, including')}}</p>
        <ul>
        @foreach($featurs as $s)
            @if($lang==1)
                <li>{{$s->name_en}}</li>
            @elseif($lang==3)
                <li>{{$s->name_he}}</li>
            @else
                <li>{{$s->name}}</li>
            @endif
        @endforeach

        </ul>
    </div>


    <div class="product-images">
        <div class="images-list owl-carousel owl-theme">
            @php $count = 0; @endphp
            @foreach ($sliders as $slider)
                <div class="image-item {{ ($count == 0) ? 'active' : '' }}">
                    <img src="images/{{ $slider->image_url }}" alt="{{$slider->name}}">
                </div>
                @php $count++; @endphp
            @endforeach
        </div>

    </div>

    {{--<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>--}}



</section>
