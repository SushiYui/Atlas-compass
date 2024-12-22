<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>

{{-- キャンセルモーダル --}}
<div class="modal js-modal">
    <div class="modal__bg js-modal-close">
      <div class="modal__content">
          <p class="reserve_day">予約日：<span></span></p>
          <p class="reserve_part">時間：リモ<span></span></p>
          <p>上記予約をキャンセルしてもよろしいですか？</p>
          <div class="w-50 m-auto edit-modal-btn d-flex">
          <button class="js-modal-close btn btn-primary d-block">閉じる</button>
              <form method="post" action="{{ route('deleteParts') }}">
                  <button class="btn btn-danger d-inline-block">キャンセル</button>
              </form>

          </div>
        </div>

      </div>

  </div>

{{-- <div id="delete-modal" class="modal">
  <div id="js-overlay" class="modal__bg">
    <div class="modal__content">
        <p>予約日：</p>
        <p>時間：リモ</p>
        <p>上記予約をキャンセルしてもよろしいですか？</p>
        <div class="button__box">
            <form method="post" action="{{ route('deleteParts') }}">
                <button class="modal__button">キャンセル</button>
            </form>
            <button id="modal__button" class="modal__button">閉じる</button>

        </div>
      </div>

    </div>

</div> --}}


</x-sidebar>
