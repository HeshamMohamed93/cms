<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>TheSaaS — Blog with sidebar</title>

    <!-- Styles -->
    <link href="{{ asset('css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
</head>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
    <div class="container">

        <div class="navbar-left">
            <button class="navbar-toggler" type="button">&#9776;</button>
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img class="logo-dark" src="{{ asset('img/logo-dark.png') }}" alt="logo">
                <img class="logo-light" src="{{ asset('img/logo-light.png') }}" alt="logo">
            </a>
        </div>

        <section class="navbar-mobile">
            <span class="navbar-divider d-mobile-none"></span>

            <ul class="nav nav-navbar">

            </ul>
        </section>

        <a class="btn btn-xs btn-round btn-success" href="{{ route('login') }}">Login</a>

    </div>
</nav><!-- /.navbar -->

<header class="header text-white h-fullscreen pb-80" style="background-image: url({{ asset('storage/'.$post->image) }})"
        data-overlay="9">
    <div class="container text-center">

        <div class="row h-100">
            <div class="col-lg-8 mx-auto align-self-center">

                <p class="opacity-70 text-uppercase small ls-1">{{ $post->category->name }}</p>
                <h1 class="display-4 mt-7 mb-8">{{ $post->title }}</h1>
                <p><span class="opacity-70 mr-1">By</span> <a class="text-white" href="#">{{ $post->user->name }}</a>
                </p>
                <p><img class="avatar avatar-sm" src="{{ Gravatar::src($post->user->email) }}" alt="..."></p>

            </div>

            <div class="col-12 align-self-end text-center">
                <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
            </div>

        </div>

    </div>
</header><!-- /.header -->

<body>
<div class="section" id="section-content">
    <div class="container">
        <div class="row">
            {!!  $post->description !!}
        </div>

        <div class="text-center my-6">
            <img class="rounded-md" src="{{ asset('storage/'.$post->image) }}" alt="...">
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                {!! $post->content !!}
                <div class="gap-xy-2 mt-6">
                    @foreach($post->tags as $tag)
                        <a class="badge badge-pill badge-secondary" href="{{ route('welcome.tag', $tag->id) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section bg-gray">
    <div class="container">

        <div class="row">
            <div class="col-lg-8 mx-auto">


                <hr>
                <div id="disqus_thread"></div>
                <script>

                    /**
                     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

                    var disqus_config = function () {
                    this.page.url = "{{config('app.url')}}/posts/{{$post->id}}";  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = {{$post->id}}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };

                    (function () { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://sass-blog-4xmqotkvrd.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                        powered by Disqus.</a></noscript>


            </div>
        </div>

    </div>


    <script src="{{ asset('js/page.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
