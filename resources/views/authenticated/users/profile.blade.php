<x-sidebar>
<div class="vh-100 border">
<p class="top-title"><span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span></p>
  <div class="top_area w-75 m-auto pt-5">
    <div class="user_status p-3">
      <p>名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
      <p>カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
      <p>性別 : @if($user->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
      <p>生年月日 : <span>{{ $user->birth_day }}</span></p>
      <p>選択科目 :
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
      </p>
      <div class="">
        @can('admin')
        <div class="subject_edit_btn">選択科目の登録
            <span class=""></span>
        </div>
        <div class="subject_inner">
          <form action="{{ route('user.edit') }}" class="subject_check_box" method="post">
            <div>

              @foreach($subject_lists as $subject_list)
              <label>{{ $subject_list->subject }}</label>
              <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
              @endforeach

            </div>
            <div>
            <input type="submit" value="登録" class="btn btn-primary">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            </div>
            {{ csrf_field() }}
          </form>
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>

</x-sidebar>
