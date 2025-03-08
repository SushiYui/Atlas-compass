<x-sidebar>
<div class="w-75 m-auto pt-5">
<div class="border w-80 m-auto pt-5 pb-5  calendar_container" style="border-radius:5px; background:#FFF;">

  <div class="w-100">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <div class="w-75 m-auto border" style="border-radius:5px;">

           <div>{!! $calendar->render() !!}</div>
    </div>
  </div>
</div>
</div>
</x-sidebar>
