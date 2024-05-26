<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchStoreRequest;
use App\Http\Requests\EvaluationRequest;
use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Evaluation;
use App\Models\Reserve;
use Milon\Barcode\Facades\DNS2DFacade;

class StoreController extends Controller
{
    public function getIndex(){
        $user = auth()->user();
        $user_id = auth()->id();
        if( is_null($user) ){
            $stores = Store::join('areas', 'stores.area_id', '=', 'areas.id')->
                    join('genres', 'stores.genre_id', '=', 'genres.id')->
                    select('stores.id', 'stores.name', 'stores.image_url', 
                            'areas.area', 'genres.genre')->get()->sortBy('id');
        } else {
            $stores = Store::join('areas', 'stores.area_id', '=', 'areas.id')->
                  join('genres', 'stores.genre_id', '=', 'genres.id')->
                  leftjoin('favorites', function ($join){
                        $join->on('stores.id', '=', 'favorites.store_id')->
                               where('favorites.user_id', '=', auth()->id());
                  })->
                  select('stores.id', 'stores.name', 'stores.image_url', 
                         'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };

        $stores->map(function ($v) {
            $v['stars'] = 0;
        });

        $areas = Area::all();
        $genres = Genre::all();

        $stores_score = Evaluation::select('store_id')->
                            selectRaw('AVG(stars) AS stars')->
                            groupBy('store_id')->
                            get();
        
        foreach( $stores as $store ){
            foreach( $stores_score as $store_score ){
                if( $store->id == $store_score->store_id ){
                    $store->stars = $store_score->stars;
                };
            };
        };



        return view('index', ['stores' => $stores, 'areas' => $areas, 'genres' => $genres, 'user' => $user]);
    }

    public function searchStore(SearchStoreRequest $request){
        $user = auth()->user();
        $user_id = auth()->id();

        //値が空の時
        if( ($request->area == 0) && ($request->genre == 0) && ($request->searchword == "") ){
                $stores = Store::join('areas', 'stores.area_id', '=', 'areas.id')->
                  join('genres', 'stores.genre_id', '=', 'genres.id')->
                  leftjoin('favorites', function ($join){
                        $join->on('stores.id', '=', 'favorites.store_id')->
                               where('favorites.user_id', '=', auth()->id());
                  })->
                  select('stores.id', 'stores.name', 'stores.image_url', 
                         'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };

        //エリアのみ指定があるとき
        if( ($request->area != 0) && ($request->genre == 0) && ($request->searchword == "") ){
                $stores = Store::where('stores.area_id', $request->area)->
                        join('areas', 'stores.area_id', '=', 'areas.id')->
                        join('genres', 'stores.genre_id', '=', 'genres.id')->
                        leftjoin('favorites', function ($join){
                            $join->on('stores.id', '=', 'favorites.store_id')->
                                where('favorites.user_id', '=', auth()->id());
                        })->
                        select('stores.id', 'stores.name', 'stores.image_url', 
                                'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };

        //ジャンルのみ指定があるとき
        if( ($request->area == 0) && ($request->genre != 0) && ($request->searchword == "") ){
            $stores = Store::where('stores.genre_id', $request->genre)->
                    join('areas', 'stores.area_id', '=', 'areas.id')->
                    join('genres', 'stores.genre_id', '=', 'genres.id')->
                    leftjoin('favorites', function ($join){
                            $join->on('stores.id', '=', 'favorites.store_id')->
                                where('favorites.user_id', '=', auth()->id());
                        })->
                    select('stores.id', 'stores.name', 'stores.image_url', 
                            'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };

        //文字列検索のみ指定があるとき
        if( ($request->area == 0) && ($request->genre == 0) && ($request->searchword != "") ){
            $stores = Store::where('stores.name', 'like', '%'.$request->searchword.'%')->
                    orWhere('stores.detail', 'like', '%'.$request->searchword.'%')->
                    join('areas', 'stores.area_id', '=', 'areas.id')->
                    join('genres', 'stores.genre_id', '=', 'genres.id')->
                    leftjoin('favorites', function ($join){
                            $join->on('stores.id', '=', 'favorites.store_id')->
                                where('favorites.user_id', '=', auth()->id());
                        })->
                    select('stores.id', 'stores.name', 'stores.image_url', 
                            'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };

        //エリアとジャンルの指定があるとき
        if( ($request->area != 0) && ($request->genre != 0) && ($request->searchword == "") ){
            $stores = Store::where('stores.area_id', $request->area)->
                    where('stores.genre_id', $request->genre)->
                    join('areas', 'stores.area_id', '=', 'areas.id')->
                    join('genres', 'stores.genre_id', '=', 'genres.id')->
                    leftjoin('favorites', function ($join){
                            $join->on('stores.id', '=', 'favorites.store_id')->
                                where('favorites.user_id', '=', auth()->id());
                        })->
                    select('stores.id', 'stores.name', 'stores.image_url', 
                            'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };

        //エリアと文字列検索のみ指定があるとき
        if( ($request->area != 0) && ($request->genre == 0) && ($request->searchword != "") ){
            $stores = Store::where('stores.name', 'like', '%'.$request->searchword.'%')->
                    orWhere('stores.detail', 'like', '%'.$request->searchword.'%')->
                    where('stores.area_id', $request->area)->
                    join('areas', 'stores.area_id', '=', 'areas.id')->
                    join('genres', 'stores.genre_id', '=', 'genres.id')->
                    leftjoin('favorites', function ($join){
                            $join->on('stores.id', '=', 'favorites.store_id')->
                                where('favorites.user_id', '=', auth()->id());
                        })->
                    select('stores.id', 'stores.name', 'stores.image_url', 
                            'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };

        //ジャンルと文字列検索のみ指定があるとき
        if( ($request->area == 0) && ($request->genre != 0) && ($request->searchword != "") ){
            $stores = Store::where('stores.name', 'like', '%'.$request->searchword.'%')->
                    orWhere('stores.detail', 'like', '%'.$request->searchword.'%')->
                    where('stores.genre_id', $request->genre)->
                    join('areas', 'stores.area_id', '=', 'areas.id')->
                    join('genres', 'stores.genre_id', '=', 'genres.id')->
                    leftjoin('favorites', function ($join){
                            $join->on('stores.id', '=', 'favorites.store_id')->
                                where('favorites.user_id', '=', auth()->id());
                        })->
                    select('stores.id', 'stores.name', 'stores.image_url', 
                            'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };

        //全てに指定があるとき
        if( ($request->area != 0) && ($request->genre != 0) && ($request->searchword != "") ){
            $stores = Store::where('stores.name', 'like', '%'.$request->searchword.'%')->
                    orWhere('stores.detail', 'like', '%'.$request->searchword.'%')->
                    where('stores.area_id', $request->area)->
                    where('stores.genre_id', $request->genre)->
                    join('areas', 'stores.area_id', '=', 'areas.id')->
                    join('genres', 'stores.genre_id', '=', 'genres.id')->
                    leftjoin('favorites', function ($join){
                            $join->on('stores.id', '=', 'favorites.store_id')->
                                where('favorites.user_id', '=', auth()->id());
                        })->
                    select('stores.id', 'stores.name', 'stores.image_url', 
                            'areas.area', 'genres.genre', 'favorites.flag_favo')->get()->sortBy('id');
        };


        $areas = Area::all();
        $genres = Genre::all();
        
        $stores_score = Evaluation::select('store_id')->
                            selectRaw('AVG(stars) AS stars')->
                            groupBy('store_id')->
                            get();
        
        foreach( $stores as $store ){
            foreach( $stores_score as $store_score ){
                if( $store->id == $store_score->store_id ){
                    $store->stars = $store_score->stars;
                };
            };
        };


        return view('index', ['stores' => $stores, 'areas' => $areas, 'genres' => $genres, 'lasttime_v' => $request, 'user' => $user]);
    }

    public function getMyPage(){
        $user = Auth::user();

        if( $user->auth_id != 0 ){
            return view('notfound');
        };

        $reserves = Reserve::where('reserves.user_id', $user->id)->
                             join('stores', 'stores.id', '=', 'reserves.store_id')->
                             select('reserves.id', 'stores.name', 'reserves.reserve_date', 'reserves.reserve_time', 'reserves.number', 'reserves.store_id')->
                             get()->sortByDesc('reserve_date');
        foreach ($reserves as $reserve){
            $reserve->QR = \DNS2D::getBarcodeHTML('https://www.rese.com/storemanage/check/'. $reserve->store_id .'/'. $reserve->id, 
                                                    'QRCODE', 2, 2) ;
        };

        $stores = Favorite::where('favorites.user_id', $user->id)->
                            leftjoin('stores', function($join){
                                $join->on('stores.id', '=', 'favorites.store_id')->
                                       join('areas', 'stores.area_id', '=', 'areas.id')->
                                       join('genres', 'stores.genre_id', '=', 'genres.id');
                            })->
                            select('stores.id', 'stores.name', 'stores.image_url', 
                                   'areas.area', 'genres.genre',)->get()->sortBy('store_id');

        $stores->map(function ($v) {
            $v['stars'] = 0;
        });

        $stores_score = Favorite::where('favorites.user_id', $user->id)->
                                  join('evaluations', 'evaluations.store_id', '=', 'favorites.store_id')->
                                  select('favorites.store_id')->
                                  selectRaw('AVG(stars) AS stars')->
                                  groupBy('favorites.store_id')->
                                  get();
        //$stores_score = Favorite::where('favorites.user_id', $user->id)->
        //                          join('evaluations', 'evaluations.store_id', '=', 'favorites.store_id')->
        //                          select('favorites.store_id', 'stars')->
        //                          get();
        //$stores_score_grp = $stores_score->groupBy('store_id');
        //$stores_score_avg = $stores_score_grp->map(function ($item) {
        //    return $item->avg('stars');
        //});

        foreach( $stores as $store ){
            foreach( $stores_score as $store_score ){
                if( $store->id == $store_score->store_id ){
                    $store->stars = $store_score->stars;
                };
            };
        };

        return view('mypage', ['user' => $user, 'reserves' => $reserves, 'stores' => $stores, 'avgs' => $stores_score]);
    }

    public function getStoreDetail($store_id = 1){
        $user = Auth::user();

        $store = Store::where('stores.id', $store_id)->
                        join('areas', 'stores.area_id', '=', 'areas.id')->
                        join('genres', 'stores.genre_id', '=', 'genres.id')->
                        first();

        if( !$store ){
            return view('notfound');
        };

        $evaluations = Evaluation::where('evaluations.store_id', $store_id)->
                                   join('users', 'evaluations.user_id', '=', 'users.id')->
                                   select('users.name', 'evaluations.stars', 'evaluations.ev_detail', 'evaluations.updated_at')->
                                   get();
        
        $star_score = round($evaluations->avg('stars'), 1);

        if( isset($user) ){
            $reserves = Reserve::where('reserves.store_id', $store_id)->
                                 where('reserves.user_id', $user->id)->
                                 get()->sortByDesc('reserve_date');
            foreach ($reserves as $reserve){
                $reserve->QR = \DNS2D::getBarcodeHTML('https://www.rese.com/storemanage/check/'. $reserve->store_id .'/'. $reserve->id, 
                                                      'QRCODE', 2.5, 2.5) ;
            };
            $flag_visited = Reserve::where('reserves.store_id', $store_id)->
                                     where('reserves.user_id', $user->id)->whereNotNull('visited')->first();
            $flag_evaluation = Evaluation::where('user_id', $user->id)->
                                           where('store_id', $store->id)->
                                           first();
        } else {
            $reserves = null;
            $flag_visited = null;
            $flag_evaluation = null;
        }

        return view('detail', ['user' => $user, 'store' => $store, 'evaluations' => $evaluations, 
                               'star_score' => $star_score,'reserves' => $reserves, 
                               'flag_visited' => $flag_visited, 'flag_evaluation' => $flag_evaluation]);
    }

    public function viewVisitedShop($store_id){
        $user = Auth::user();
        $visited = Reserve::where('user_id', $user->id)->
                             whereNotNull('visited')->
                             first();
        
        if( !$visited ){
            return view('notfound');
        };

        $store = Store::where('stores.id', $store_id)->
                        join('areas', 'stores.area_id', '=', 'areas.id')->
                        join('genres', 'stores.genre_id', '=', 'genres.id')->
                        first();

        if( !$store ){
            return view('notfound');
        };

        $evaluations = Evaluation::where('evaluations.store_id', $store_id)->
                                   join('users', 'evaluations.user_id', '=', 'users.id')->
                                   get();

        $star_score = round($evaluations->avg('stars'), 1);

        return view('evaluation', ['store' => $store, 'evaluations' => $evaluations, 
                                   'star_score' => $star_score,]);
    }

    public function postEvaluation($store_id, EvaluationRequest $request){
        $evaluation = new Evaluation();
        $evaluation->user_id = Auth::user()->id;
        $evaluation->store_id = $store_id;
        $evaluation->stars = $request->stars;
        $evaluation->ev_detail = $request->ev_detail;

        $evaluation->save();

        return view('evdone');
    }

    public function postFavorite($store_id){
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->
                              where('store_id', $store_id)->first();
        if( is_null($favorite) ){
            $postFavorite = new Favorite();
            $postFavorite->user_id = $user->id;
            $postFavorite->store_id = $store_id;
            $postFavorite->flag_favo = 1;

            $postFavorite->save();
        } else {
            $favorite->delete();
        }

        return back();
    }

}
