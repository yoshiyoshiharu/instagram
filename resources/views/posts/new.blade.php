@extends('layouts.app')

@section('content')
<div class="newpost-wrap">
  <div class="col-md-8">
    <form class="post-form" action="/posts" method="post" enctype="multipart/form-data" >
      @csrf
      <p><input type="file" name="photo" value="{{ old('photo') }}"></p>
      @if($errors->has('photo'))
        <p class="error">{{$errors->first('photo')}}</p>
      @endif
      <p><textarea placeholder="キャプションを書く" name="caption" rows="8" cols="30" value="{{ old('caption')}}"></textarea></p>
      <p><input type="submit" value="投稿" class="btn btn-primary"></p>
    </form>
  </div>
</div>
@endsection
