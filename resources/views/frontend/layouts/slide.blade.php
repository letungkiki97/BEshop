<div id="main-slider">
    @php
    $banner = App\Models\Banner::orderByRaw("RAND()")->first();
    @endphp
    <div id="owl-main-slider" class="owl-carousel owl-theme">
        @foreach($banner->images as $k=>$v)

        <div class="item">
            <div class="ms-img">
                <img src="{{url('uploads/banner/'.@$v->name)}}" alt="Các mẫu xe thể thao" />
                <div class="ms-desc">
                    <div class="line-1 wow fadeInLeft" data-wow-duration="0.75s" data-wow-delay="0.5s">
                        {{@$banner->name}}
                    </div>
                    <div class="line-2 wow fadeInRight" data-wow-duration="0.75s" data-wow-delay="0.5s">
                        <p style="color: #{{@$v->pivot->text_color}}">{{@$v->pivot->text_text}}</p>
                    </div>
                    <a href="{{@$v->pivot->link}}" class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="1.5s">{{@$v->pivot->button_text}}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<style>
    .owl-stage-outer{
        max-height: {{@$banner->size}}px;
    }
</style>