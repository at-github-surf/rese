<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use App\Models\Store;

class ReserveController extends Controller
{

    public function postReserve($store_id, ReserveRequest $request){
        $reserve = new Reserve();

        $reserve->user_id = Auth::user()->id;
        $reserve->store_id = $store_id;
        $reserve->reserve_date = $request->reserve_date;
        $reserve->reserve_time = $request->reserve_time;
        $reserve->number = $request->number;

        $reserve->save();

        return view('done');
    }

    public function editReserve($reserve_id){
        $reserve = Reserve::where('id', $reserve_id)->
                   whereNull('visited')->
                   first();
        if( isset($reserve) && ($reserve->user_id == Auth::user()->id) ){
            $store = Store::where('stores.id', $reserve->store_id)->
                            join('areas', 'stores.area_id', '=', 'areas.id')->
                            join('genres', 'stores.genre_id', '=', 'genres.id')->
                            first();

            return view('change', ['reserve' => $reserve, 'store' => $store]);
        } else {
            return view('notfound');
        }
    }

    public function changeReserve($reserve_id, ReserveRequest $request){
        $update_reserve = Reserve::where('id', $reserve_id)->first();
        $update_reserve->reserve_date = $request->reserve_date;
        $update_reserve->reserve_time = $request->reserve_time;
        $update_reserve->number = $request->number;

        $update_reserve->update();
        return view('changedone');
    }

    public function cancelReserve($reserve_id){
        $reserve = Reserve::where('id', $reserve_id)->first();

        $reserve->delete();
    }

    public function confReserve($store_id, $reserve_id){
        $user = auth()->user();
        if($user->auth_id != 2){
            return view('notfound');
        };

        $reserve = Reserve::where('reserves.id', $reserve_id)->
                            where('store_id', $store_id)->
                            join('users', 'users.id', '=', 'reserves.user_id')->
                            select('reserves.id', 'reserves.store_id', 'users.name', 'reserves.reserve_date', 'reserves.reserve_time', 
                                   'reserves.number')->
                            first();
        
        $store = Store::where('id', $store_id)->first();
        
        if( (is_null('$reserve')) || ($user->id != $store->user_id) ){
            return view('notfound');
        };

        return view('storemanage/check', ['reserve' => $reserve]);
    }

    public function checkVisit($store_id, $reserve_id){
        $user = auth()->user();
        if($user->auth_id != 2){
            return view('notfound');
        };

        $reserve = Reserve::where('reserves.id', $reserve_id)->
                            where('store_id', $store_id)->
                            first();
        
        $store = Store::where('id', $store_id)->first();
        
        if( (is_null('$reserve')) || ($user->id != $store->user_id) ){
            return view('notfound');
        };

        $reserve->visited = date("Y-m-d H:i:s");
        $reserve->update();

        return redirect('/storemanage/reserve/' . $store_id);
    }


}
