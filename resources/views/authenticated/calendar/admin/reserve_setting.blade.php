<x-sidebar>

<div class="w-100" style="align-items:center; justify-content:center;">
    <div class="w-100 border p-5">
        <div class="border w-75 m-auto pt-5 pb-3  calendar_container" style="border-radius:5px; background:#FFF;">

    <p class="text-center">{{ $calendar->getTitle() }}</p>

    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
        <input type="submit" class="btn btn-primary calender_reservation" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
    </div>
</div>

</div>
</x-sidebar>
