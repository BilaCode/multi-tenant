{{--<div class="breadcrumb-area breadcrumb-padding breadcrumb-border--}}
{{--    @if((in_array(request()->route()->getName(),['tenant.frontend.homepage','tenant.dynamic.page']) && !empty($page_post) && $page_post->breadcrumb == 0 ))--}}
{{--        d-none--}}
{{--    @endif--}}
{{--">--}}
{{--    <div class="container custom-container-one">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="breadcrumb-contents">--}}
{{--                    <ul class="breadcrumb-contents-list">--}}
{{--                        <li class="breadcrumb-contents-list-item"><a class="breadcrumb-contents-list-item-link" href="{{route('tenant.frontend.homepage')}}">{{__('Home')}}</a></li>--}}
{{--                        @if(Route::currentRouteName() === 'tenant.dynamic.page')--}}
{{--                            <li class="breadcrumb-contents-list-item"><a class="breadcrumb-contents-list-item-link" href="#">{!! $page_post->title ?? '' !!}</a></li>--}}
{{--                        @else--}}
{{--                            <li class="breadcrumb-contents-list-item">@yield('page-title')</li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                    <h1 class="breadcrumb-contents-title mt-3"> @yield('page-title') </h1>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="
    @if((in_array(request()->route()->getName(),['tenant.frontend.homepage','tenant.dynamic.page']) && !empty($page_post) && $page_post->breadcrumb == 0 ))
         d-none">
    <section class="sliderAreaInner" {!! render_background_image_markup_by_attachment_id(get_static_option('site_breadcrumb_image')) !!}>
        @if(Route::currentRouteName() !== 'tenant.frontend.appointment.order.page' && Route::currentRouteName() !== 'tenant.frontend.appointment.payment.page')
            <div class="heroPadding2 agency_and_newspaper_class_condition">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-7 col-lg-9 col-md-10">
                            <div class="innerHeroContent text-center">
                                <h1 class="tittle wow fadeInUp" data-wow-delay="0.0s">
                                    @if(Route::currentRouteName() === 'tenant.dynamic.page')
                                        {!! $page_post->getTranslation('title',get_user_lang()) !!}
                                    @else
                                        @yield('page-title')
                                    @endif
                                </h1>
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb wow fadeInUp" data-wow-delay="0.2s">
                                        <li class="breadcrumb-item"><a href="{{route('tenant.frontend.homepage')}}">{{__('Home')}}</a></li>
                                        @if(Route::currentRouteName() === 'tenant.dynamic.page')
                                            <li class="breadcrumb-item"><a href="#">{!! $page_post->getTranslation('title',get_user_lang()) ?? '' !!}</a></li>
                                        @else
                                            <li class="breadcrumb-item">@yield('page-title')</li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    @endif

</div>





