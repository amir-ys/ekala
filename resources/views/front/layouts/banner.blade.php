<div class="banner-area pt-100 pb-65">
    <div class="container">
        <div class="row">


            @foreach($topIndexBanners->chunk(3)->last() as $banner)
                <div class="col-lg-4 col-md-4">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="{{ $banner->btn_link }}"><img class="animated" src="{{ route('panel.products.displayImage' , $banner->image->files) }}" alt="" /></a>
                        <div class="banner-content-2 banner-position-5">
                            <h4> {{ $banner->title }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($topIndexBanners->chunk(2)->first() as $banner)
            <div class="col-lg-6 col-md-6">
                <div class="single-banner mb-30 scroll-zoom">
                    <a href="{{ $banner->btn_link }}"><img class="animated" src="{{ route('panel.products.displayImage' , $banner->image->files) }}" alt="" /></a>
                    <div class="banner-content banner-position-6 text-right">
                        <h3>{{ $banner->title }}</h3>
                        <h2> {{ $banner->body }} </h2>
                        <a href="{{ route('panel.products.displayImage' , $banner->image->files) }}">{{ $banner->btn_text }}</a>
                    </div>
                </div>
            </div>
            @endforeach



        </div>
    </div>
</div>
