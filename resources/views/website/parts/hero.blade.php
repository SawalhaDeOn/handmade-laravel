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

        <h2>تصنيفات المنتجات</h2>
        <p>نرحب بجميع أنواع المنتجات التراثية والحرفية اليدوية بما في ذلك:</p>
        <ul>
            <li>المطرزات</li>
            <li>الإكسسوارات</li>
            <li>الأعمال الخشبية</li>
            <li>الشموع اليدوية</li>
            <li>العديد من الحرف اليدوية المبتكرة</li>
        </ul>
    </div>


    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="over-layer"></div>

        @php $count=0; @endphp
        <div class="carousel-inner">
            @foreach ($sliders as $h)
                <div class="carousel-item  {{($count==0)?'active':''}}">
                    <img src="images/{{$h->image_url}}" class="d-block w-100" alt="{{$h->name}}">

                    <div class="likecontainer hero-content carousel-caption {{($count==0)?'active-carousel-caption':''}}">
                        @if($lang==1)
                            <h1>{{$h->name_en}}</h1>
                        @elseif($lang==3)
                            <h1>{{$h->name_he}}</h1>
                        @else
                            <h1>{{$h->name}}</h1>
                        @endif


                        @if($lang==1)
                            <p>{{$h->notes_en}}</p>
                        @elseif($lang==3)
                            <p>{{$h->notes_he}}</p>
                        @else
                            <p>{{$h->notes}}</p>
                        @endif
                        <a href="{{$h->hlink}}" target="_blank"> <button>{{__('More')}}</button></a>

                    </div>

                </div>
                @php $count++; @endphp
            @endforeach
            @php $count=0; @endphp
            <div class="carousel-indicators">
                @foreach ($sliders as $h)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$count}}"
                            class="  {{($count==0)?'active':''}}"
                            {{($count==0)?'aria-current="true"':''}}
                            aria-label="Slide {{$count+1}}"></button>
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
    </div>


</section>
