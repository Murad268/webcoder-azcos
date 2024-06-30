@extends('client.app.app')
@section('seo_meta')
    {!! $blog->seo_links  !!}
    <meta name="description" content="{{$blog->getWithLocale($lang)->meta_description ?? ""}}" />
    <meta name="keywords" content="{{$blog->getWithLocale($lang)->meta_keywords ?? ""}}" />
    <title>{{$blog->getWithLocale($lang)->seo_title ?? ""}}</title>
@endsection
@section('content')
    <main id="content" class="wrapper layout-page">
        <section class="z-index-2 position-relative pb-2 mb-12">
            <div class="bg-body-secondary mb-3">
                <div class="container">
                    <nav class="py-4 lh-30px" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center py-1 mb-0">
                            <li class="breadcrumb-item">
                                <a title="Home" href="../index.html">{{TranslateUtility::getTranslate('breadcrumb', 'home', $lang)}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a title="Home" href="../index.html">{{TranslateUtility::getTranslate('breadcrumb', 'blogs', $lang)}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{$blog->getWithLocale($lang)->title ?? ""}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section class="pt-10 pb-16 pb-lg-18 container">
            <div class="px-lg-25 px-0">
                <div class="text-center mb-13">
                    <h1 class="px-6 text-body-emphasis border-0 fw-500 mb-4 fs-3">
                        {{$blog->getWithLocale($lang)->title ?? ""}}
                    </h1>
                    <ul
                        class="list-inline fs-15px fw-semibold letter-spacing-01 d-flex justify-content-center align-items-center"
                    >
                        
                        <li class="border-end px-6 text-body-emphasis border-0 text-body">
                            <span>{{$blog->category->getWithLocale($lang)->title ?? ""}}</span>
                        </li>
                        <li class="list-inline-item px-6">
                            <?php
                            $date = new DateTime($blog->created_at);
                            $date->setTimezone(new DateTimeZone('Asia/Baku'));
                            echo $date->format('d-m-Y, H:i');
                            ?>
                        </li>
                        <li class="ms-5 list-style-disc">{{$blog->views_count ?? ""}}  {{TranslateUtility::getTranslate('site', 'views', $lang)}}</li>
                    </ul>
                </div>
            </div>
            <div class="">
                <div class="row d-flex align-items-center">
                    <div class="px-6">
                        {!! $blog->getWithLocale($lang)->text ?? "" !!}
                    </div>
                    <div class="flex-grow-1 flex-shrink-1 flex-basis-0">
                        @foreach($blog->images->where('model_type', 'blog_banner_images') as $image)
                            <img
                                data-src="{{asset('storage/'.$image->image_url)}}"
                                width="1170"
                                height="700"
                                alt="{{$blog->getWithLocale($lang)->title ?? ""}}"
                                class="lazy-image w-100 h-100 d-block object-fit-cover"
                                src="#"
                            />
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="px-lg-25 px-0">
                <div class="row no-gutters pt-11 justify-content-sm-between">
                    <div class="col-sm-6 mb-4 mb-sm-0">
                        <ul class="list-inline fw-semibold">
                            @foreach($blog->tags as $tag)
                                <li class="list-inline-item me-3">
                                    <a
                                        href=""
                                        class="text-body text-body-emphasis-hover text-decoration-none"
                                    >#{{$tag->getWithLocale($lang)->tag ?? ""}}</a
                                    >
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 mt-5 mb-7">
                        <div class="border-bottom"></div>
                    </div>
                </div>
            </div>
            <div class="px-0">
                <div class="pt-14 pb-13 pb-lg-15 pt-lg-18 mx-n5" id="post_related">
                    <div class="container">
                        <div class="text-center">
                            <h2 class="mb-6 fs-3"> {{TranslateUtility::getTranslate('blog_details_page', 'related_posts', $lang)}}</h2>
                        </div>
                    </div>
                    @include('client.app.partials._blogs', ['blogs' => $relatedBlogs])
                </div>
            </div>

        </section>
    </main>

@endsection
@section('scripts')
     {!! $blog->seo_scripts !!}
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var blogtId = {{ $blog->id }};
            
            $.ajax({
                url: "{{ route('blog.increment_views') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    blog_id: blogtId
                },
                success: function(response) {
                        console.log(response)

                   
                },
                error: function(response) {
                        console.log(response)

                }
            });
        });
    </script>
@endsection