<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name' , 'Harustagram')}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
  </head>
  <body>
    <div class="wrap">
      <header>
        <div class="header-left">
          <div class="header-logo">
            <a href="/"><img src="/images/logoharu.png" alt=""></a>
          </div>
        </div>
        <div class="header-right">
          <div class="post-btn">
            <a href="{{ route('new')}}" class="btn btn-primary">投稿</a>
          </div>
          <div class="profile-icon">
            @if (Auth::check())
              <a href="/users/{{ Auth::user()->id}}">
                @if(Auth::user()->profile_photo)<img src="/storage/user_images/{{Auth::user()->profile_photo}}" alt="">
                @else<img src="/images/parts3.png" alt="">
                @endif
              </a>
            @else
              <a href="/login"><img src="/images/parts3.png" alt=""></a>
            @endif
          </div>
        </div>
      </header>

      <div class="container">
        @yield('content')
      </div>

    </div>
  </body>
</html>
