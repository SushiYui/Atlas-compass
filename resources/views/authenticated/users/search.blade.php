<x-sidebar>
<div class="search_content w-100 d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span>ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span class="one_parson_name">{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span>性別 : </span><span>女</span>
        @else
        <span>性別 : </span><span>その他</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span>講師(英語)</span>
        @else
        <span>権限 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span>選択科目 :</span>
        @foreach ($user->subjects as $subject_user)
        <span>{{ $subject_user->subject }}</span>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach

  </div>
  <div class="search_area w-25 border">
    <div class="">
      <div>
        <p class="search_title">検索</p>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div>
        <p class="search_p">カテゴリ</p>
        <select form="userSearchRequest" name="category" class="search_select">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <p class="search_p">並び替え</p>
        <select name="updown" form="userSearchRequest" class="search_select">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="search_container">
        <div class="search_conditions">検索条件の追加
        <span class=""></span>
        </div>

        <div class="search_conditions_inner">
          <div class="search_conditions_box">
            <p>性別</p>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>
          <div class="search_conditions_box">
            <p>権限</p>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="search_conditions_box">
            <p>選択科目</p>
                @foreach ($subjects as $subject)
                    <span>{{ $subject->subject }}</span><input type="checkbox" name="subjects[]" class="checkbox" value={{ $subject->id }} form="userSearchRequest">
                @endforeach
          </div>
        </div>
      </div>
      <div class="search_btn_box">
        <input type="submit" name="search_btn" class="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div class="reset_box">
        <input type="reset" class="reset" value="リセット" form="userSearchRequest">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
</x-sidebar>
