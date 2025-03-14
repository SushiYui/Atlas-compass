<?php
namespace App\Calendars\Admin;

use Carbon\Carbon;
use App\Models\Users\User;

class CalendarView{
  private $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  public function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table m-auto border">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th class="border">月</th>';
    $html[] = '<th class="border">火</th>';
    $html[] = '<th class="border">水</th>';
    $html[] = '<th class="border">木</th>';
    $html[] = '<th class="border">金</th>';
    $html[] = '<th class="border day-sat">土</th>';
    $html[] = '<th class="border day-sun">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();

    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->format("Y-m-01");
        $toDay = $this->carbon->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="past-day border '.$day->getClassName().'">';
        }else{
          $html[] = '<td class="border '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        $html[] = $day->dayPartCounts($day->everyDay());
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';

    return implode("", $html);
  }

//   週情報を取得するメソッド
  protected function getWeeks(){
    $weeks = [];
    // 初日を取得（Carbonを使うことで日付操作ができる、
    // copy()をはさむことで日付操作しても影響が出ない）
    $firstDay = $this->carbon->copy()->firstOfMonth();
    // 月末
    $lastDay = $this->carbon->copy()->lastOfMonth();
    // １週目
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    // 作業用の日
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    // 月末までループさせる
    while($tmpDay->lte($lastDay)){
        // 週カレンダーview作成
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
    //   次の週は＋７する
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
