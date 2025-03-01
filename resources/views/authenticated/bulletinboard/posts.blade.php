<x-sidebar>
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto"></p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name ?? 'ユーザーなし' }}</span><span class="ml-3">{{ $post->user->under_name ?? 'ユーザーなし' }}</span><span>さん</span></p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="post_status">
              @foreach ($post->subCategories as $subCategory)
              {{-- @if ($sub_category->posts->contains($post->id)) --}}
              <input type="submit" name="category_word" class="category_btn" value={{ $subCategory->sub_category }}>
              {{-- <input type="submit" name="category_word" class="category_btn" value={{$sub_category->sub_category}} form="postSearchRequest"> --}}
              @endforeach
        </div>
        <div class="post_bottom_box">
            <div>
            <i class="fa fa-comment"></i><span class="">{{ $post_comment->commentCounts($post->id) }}</span>
            </div>
            <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @endif
            </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="m-4">
      <div class=""><a href="{{ route('post.input') }}" class="post-btn">投稿</a></div>
      <div class="">
      <div class="post-search">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest" class="post-keyword">
        <input type="submit" value="検索" form="postSearchRequest" class="keyword-btn">
      </div>
      </div>
      <div class="">
      <div class="post-btn-box">
      <input type="submit" name="like_posts" class="category_like" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_mypost" value="自分の投稿" form="postSearchRequest">
      </div>
      </div>
        <p>カテゴリー検索</p>
        <dl>
        <article class="category_menu">
            @foreach($categories as $category)
            <dt class="main_categories" category_id="{{ $category->id }}">{{ $category->main_category }}
                <span class=""></span>
            </dt>
            @foreach ($sub_categories as $sub_category)
            @if ($category->id === $sub_category->main_category_id)
            <input type="hidden" name="sub_category" value="{{ $sub_category->sub_category }}" form="postSearchRequest">
            <p class="category_num{{ $category->id }} sub_category">{{ $sub_category->sub_category }}</p>
            @endif
            @endforeach
        @endforeach
        </article>
        </dl>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
</x-sidebar>
