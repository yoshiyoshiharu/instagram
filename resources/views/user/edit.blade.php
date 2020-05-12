@extends('layouts.app')

@section('content')
<div class="form-wrap">
  <form class="edit-form" action="/users/update" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="col-md-8">
      <p>プロフィール写真</p>
       <input type="file" name="user_profile_photo" value="{{ old('user_profile_photo')}}" accept="image/jpeg,image/gif,image/png" />
      <p>名前</p>
      <input  class="form-group" type="text" name="user_name" value="{{ old('user_name' , $user->name)}}">
      @if ($errors->has('user_name'))
      <p class="error">{{ $errors->first('user_name')}}</p>
      @endif
      <p>メールアドレス</p>
      <input  class="form-group" type="email" name="user_email" value="{{ old('user_email' , $user->email) }}">
      <p>パスワード</p>
      <input  class="form-group" type="password" name="user_password" value="">
      @if ($errors->has('user_password'))
      <p class="error">{{ $errors->first('user_password')}}</p>
      @endif
      <p>パスワードの確認</p>
      <input  class="form-group" type="password" name="user_password_confirmation" value="">
      <p><input type="submit" value="変更する" class="btn btn-primary"></p>
    </div>
  </form>
</div>
@endsection
