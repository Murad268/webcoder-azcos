
@foreach($settings->images->where('model_type', 'favicon') as $image)
    <link rel="icon" href="{{asset('storage/'.$image->image_url)}}" />
@endforeach
@yield('seo_meta')
