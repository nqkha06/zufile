    <!--[ Open graph ]-->
    <meta content='{{ $article_data->title }}' property='og:title'/>
    {{-- <meta content='{{  }}' property='og:url'/> --}}
    <meta content='{{ $_settings['web_name'] ?? env('APP_NAME') }}' property='og:site_name'/>
    <meta content='article' property='og:type'/>
    <meta content='{{ $article_data->summary }}' property='og:description'/>
    <meta content='{{ $article_data->title }}' property='og:image:alt'/>
    <meta content='{{ $article_data->image }}' property='og:image'/>
    <!--[ Twitter Card ]-->
    <meta content='{{ $article_data->title }}' name='twitter:title'/>
    <meta content='{{ route('blog.show', $article_data->slug) }}' name='twitter:url'/>
    <meta content='{{ $article_data->summary }}' name='twitter:description'/>
    <meta content='summary_large_image' name='twitter:card'/>
    <meta content='{{ $article_data->title }}' name='twitter:image:alt'/>
    <meta content='{{ $article_data->image }}' name='twitter:image:src'/>