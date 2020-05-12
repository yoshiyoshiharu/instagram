@extends('layouts.app')

@section('content')
<div class="profile-wrap">
  <div class="row">
    <div class="col-md-4 text-center">
      @if ($user->profile_photo)
        <p>
          <img class="round-img" src="{{ asset('storage/user_images/' . $user->profile_photo) }}"/>
        </p>
        @else
          <img class="round-img" src="{{ asset('/images/blank_profile.png') }}"/>
      @endif
    </div>
    <div class="col-md-8">
      <div class="user-name">
        <h1>{{ $user->name }}</h1>
      </div>
      @if ($user->id == Auth::user()->id)
      <div class="user-email">
        <p>
          {{ $user->email }}
        </p>
      </div>
      <div class="profile-btns">
        <a class="btn btn-outline-dark common-btn edit-profile-btn" href="/users/edit">プロフィールを編集</a>
        <a class="btn btn-outline-dark common-btn edit-profile-btn" rel="nofollow" data-method="POST" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
      </div>
      @endif


    </div>
  </div>
</div>
@endsection
