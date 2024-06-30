<div class="row gy-50px">
    @foreach($blogs as $blog)

        <div class="col-md-6 col-lg-4">
            <article class="card card-post-grid-1 bg-transparent border-0" data-animate="fadeInUp">
                @foreach($blog->images->where('model_type', 'blog_images') as $image)
                    <figure class="card-img-top position-relative mb-10">
                        @php
                            $slug = $blog->getWithLocale($lang)->slug ?? "";
                        @endphp
                        <a href="{{ $slug ? route('front.blogs.details', ['lang' => $lang, 'slug' => $slug]) : '#' }}" class="hover-shine hover-zoom-in d-block" title="{{$blog->getWithLocale($lang)->title ?? ""}}">
                            <img data-src="{{asset('storage/'.$image->image_url)}}" class="img-fluid lazy-image w-100" alt="{{$blog->getWithLocale($lang)->title ?? ""}}" width="370" height="450" src="#" />
                        </a>
                        <a href="{{ $slug ? route('front.blogs.details', ['lang' => $lang, 'slug' => $slug]) : '#' }}" class="post-item-cate btn btn-light btn-text-light-body-emphasis btn-hover-bg-dark btn-hover-text-light fw-500 post-cat position-absolute top-100 start-50 translate-middle py-2 px-7 border-0" title="{{$blog->category->getWithLocale($lang)->title ?? ""}}">
                            {{$blog->category->getWithLocale($lang)->title ?? ""}}
                        </a>
                    </figure>
                @endforeach

                <div class="card-body text-center px-md-9 py-0">
                    <h4 class="card-title lh-base mb-9">
                        <a class="text-decoration-none" href="{{ $slug ? route('front.blogs.details', ['lang' => $lang, 'slug' => $slug]) : '#' }}" title="{{$blog->getWithLocale($lang)->title ?? ""}}">{{$blog->getWithLocale($lang)->title ?? ""}}</a>
                    </h4>
                    <ul class="post-meta list-inline lh-1 d-flex flex-wrap justify-content-center m-0">
                        <li class="list-inline-item">
                                <?php
                                $date = new DateTime($blog->created_at);
                                $date->setTimezone(new DateTimeZone('Asia/Baku'));
                                echo $date->format('d-m-Y, H:i');
                                ?>
                        </li>
                    </ul>
                </div>
            </article>

        </div>

    @endforeach

</div>
