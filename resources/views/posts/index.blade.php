@extends('layouts.app')

@section('content')
<div class="posts">
  @forelse($posts as $post)
    <div class="post col-md-6">
      <div class="post-header">
        <div class="post-header-left">
          <div class="user-icon">
            @if( $post->user->profile_photo )
              <img src="{{asset('storage/user_images/' . $post->user->profile_photo )}}" alt="">
            @else
              <img src="{{ asset('/images/blank_profile.png') }}" alt="">
            @endif
          </div>
          <p class="user-name">
            <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a>
          </p>
        </div>

        @if ($post->user->id == Auth::user()->id)
          <a href="/posts/delete/{{ $post->id }}">
            <div class="delete-post-icon">
              <img src="/images/parts9.png">
            </div>
          </a>
        @endif
      </div>
      <div class="post-image">
        <img src="{{asset('/storage/post_images/' . $post->id)}}.jpg">
      </div>
      <div class="post-content">
        <div class="post-like">
          @if($post->likedBy(Auth::user())->count() > 0)
            <a href="/likes/{{ $post->likedBy(Auth::user())->firstOrFail()->id}}" data-method="delete"><img src="/images/parts7.png"></a>
          @else
            <a href="/posts/{{ $post->id }}/likes" data-method="post"><img src="/images/parts5.png"></a>
          @endif
          @if($post->likeCount() > 0)
            <span>{{ $post->likeCount() }}人がいいねしました。</span>
          @endif
        </div>
        <div class="post-caption">
          <p>{{ $post->caption}}</p>
        </div>
        <div class="post-comments">
          <ul>
            @foreach($post->comments as $comment)
            <li>
              <strong>{{ $comment->user->name}}</strong>
              <span>{{$comment->comment}}</span>
            </li>
            @endforeach
          </ul>
          <p class="post-date">{{$post->created_at}}</p>
          <form action="/posts/{{ $post->id }}/comments" class="comment-form" method="post">
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input class="comment-text" type="text" name="comment" value="{{ old('comment')}}" placeholder="コメントを追加...">
            <input class="comment-submit" type="submit" value="投稿">
          </form>
          @if($errors->has('comment'))
            <p class="error">{{$errors->first('comment')}}</p>
          @endif
        </div>
      </div>
    </div>
  @empty
    投稿はありません
  @endforelse
</div>
@endsection
