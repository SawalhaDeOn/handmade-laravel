<section id="testimonials" class="testimonials">
    <div class="container">
        <h2>{{__('Testimonial')}}</h2>
        <p{{__('Testimonial Text')}}
        </p>

        <div class="testimonial-cards owl-carousel" >
            @foreach($reviews as $r)
                @if($lang==1)
                    <div class="testimonial-card">
                        <p>{{substr($r->notes_en,0,100)}}...</p>
                        <div class="testimonial-author">
                            <img src="images/{{$r->image_url}}" alt="{{$r->name_en}}">
                            <div class="testimonial-author-info">
                                <h4>{{$r->name_en}}</h4>
                                <p>{{@$r->city->name_en}}</p>
                            </div>
                        </div>
                    </div>

                @elseif($lang==2)
                    <div class="testimonial-card">
                        <p>{{substr($r->notes,0,100)}}...</p>
                        <div class="testimonial-author">
                            <img src="images/{{$r->image_url}}" alt="{{$r->name}}">
                            <div class="testimonial-author-info">
                                <h4>{{$r->name}}</h4>
                                <p>{{@$r->city->name}}</p>
                            </div>
                        </div>
                    </div>

                @else
                    <div class="testimonial-card ">
                        <p>{{substr($r->notes_he,0,100)}}...</p>
                        <div class="testimonial-author">
                            <img src="images/{{$r->image_url}}" alt="{{$r->name_he}}">
                            <div class="testimonial-author-info">
                                <h4>{{$r->name_he}}</h4>
                                <p>{{@$r->city->name_he}}</p>
                            </div>
                        </div>
                    </div>

                @endif

            @endforeach


        </div>
    </div>

</section>
