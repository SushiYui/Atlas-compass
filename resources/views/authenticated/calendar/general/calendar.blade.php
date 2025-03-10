<x-sidebar>
<div class="pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5  calendar_container" style="border-radius:5px; background:#FFF;">

    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary calender_reservation" value="予約する" form="reserveParts">
    </div>
  </div>
</div>

{{-- キャンセルモーダル --}}
<div class="modal js-modal">
    <div class="modal__bg js-modal-bg">
      <div class="modal__content">
          <p class="reserve_day">予約日：<span></span></p>
          <p class="reserve_part">時間：リモ<span></span></p>
          <p>上記予約をキャンセルしてもよろしいですか？</p>
          <div class="w-50 m-auto edit-modal-btn d-flex">
          <button class="js-modal-close btn btn-primary d-block">閉じる</button>
                <input type="hidden" id="reservePart" name="reserve_part" form="deleteParts">
                <input type="hidden" id="reserveDay" name="reserve_day" form="deleteParts">
                <input type="submit" class="btn btn-danger d-inline-block" value="キャンセル" form="deleteParts">
          </div>
        </div>

    </div>

  </div>

</x-sidebar>
