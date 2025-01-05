<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        // dd($request);
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            // dd($getPart,$getDate);
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    public function delete(Request $request){
        if($request->reserve_part == "1部"){
            $reserve_part = 1;
        }else if($request->reserve_part == "2部"){
            $reserve_part = 2;
        }else if($request->reserve_part == "3部"){
            $reserve_part = 3;
        }
        // dd($reserve_part);
        DB::beginTransaction();
        try{
            $getPart = $reserve_part;
            $getDate = $request->input('reserve_day');
                $reserve_settings = ReserveSettings::where('setting_reserve', $getDate)->where('setting_part', $getPart)->first();
                $reserve_settings->increment('limit_users');
                $reserve_settings->users()->detach(Auth::id());

                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
            }
                    return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

}
