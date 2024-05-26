<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\StoreManagerCreateRequest;
use App\Models\Reserve;
use App\Models\User;
use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Evaluation;
use App\Mail\SendMail;

class StoreManageController extends Controller
{
    public function viewAdmin(Request $request){
        $user = auth()->user();
        if($user->auth_id != 1){
            return view('notfound');
        };

        $storeManagers = User::where('auth_id', '2')->get();

        return view('siteadmin/index', ['storeManagers' => $storeManagers, 'user' => $user]);
    }

    public function viewAddStoreManager(Request $request){
        $user = auth()->user();
        if($user->auth_id != 1){
            return view('notfound');
        };

        return view('siteadmin/addmanager', ['user' => $user]);
    }

    public function storeStoreManager(Request $request){
        $user = auth()->user();
        if($user->auth_id != 1){
            return view('notfound');
        };

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'auth_id' => ['required', 'numeric', 'min:2', 'max:2'],
        ]);

        $storeManager = new User();
        $storeManager->name = $request->name;
        $storeManager->email = $request->email;
        $storeManager->password = Hash::make($request->password);
        $storeManager->auth_id = $request->auth_id;
        $storeManager->email_verified_at = date("Y-m-d H:i:s");

        $storeManager->save();

        return redirect()->route('siteadmin');
    }

    public function viewMyStore(){
        $user = auth()->user();
        if($user->auth_id != 2){
            return view('notfound');
        };

        $myStore = Store::where('stores.user_id',$user->id)->
                          join('areas', 'stores.area_id', '=', 'areas.id')->
                          join('genres', 'stores.genre_id', '=', 'genres.id')->
                          select('stores.id', 'stores.name', 'stores.image_url','stores.detail', 
                                 'areas.area', 'genres.genre')->first();
        
        $areas = Area::all();
        $genres = Genre::all();

        if( isset($myStore) ){
            $evaluations = Evaluation::where('evaluations.store_id', $myStore->id)->
                            join('users', 'evaluations.user_id', '=', 'users.id')->
                            get();
        
            $star_score = round($evaluations->avg('stars'), 1);

            return view('storemanage/index', ['myStore' => $myStore, 'areas' => $areas, 'genres' => $genres, 
                        'evaluations' => $evaluations, 'star_score' => $star_score,]);
        } else {
            $star_score = 0;
            $evaluations = null;
            return view('storemanage/index', ['areas' => $areas, 'genres' => $genres, 'evaluations' => $evaluations, 'star_score' => $star_score,]);
        }
    }

    public function createStore(Request $request){
        $user = auth()->user();
        if($user->auth_id != 2){
            return view('notfound');
        };

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'area' => ['required', 'numeric', 'min:1', 'max:3'],
            'genre' => ['required', 'numeric', 'min:1', 'max:5'],
            'detail' => ['required', 'string',],
        ]);

        $store = new Store();

        $store->name = $request->name;
        $store->user_id = $user->id;
        $store->area_id = $request->area;
        $store->genre_id = $request->genre;
        $store->detail = $request->detail;
        $store->image_url = 'sushi.jpg';

        $store->save();

        return redirect()->route('editdone');
    }

    public function editStore($store_id, Request $request){
        $user = auth()->user();
        if($user->auth_id != 2){
            return view('notfound');
        };

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'area' => ['required', 'numeric', 'min:1', 'max:3'],
            'genre' => ['required', 'numeric', 'min:1', 'max:5'],
            'detail' => ['required', 'string',],
        ]);

        $store = Store::where('id', $store_id)->first();
        if(is_null($store)){
            return view('notfound');
        };

        $store->name = $request->name;
        $store->area_id = $request->area;
        $store->genre_id = $request->genre;
        $store->detail = $request->detail;

        $store->update();

        return redirect()->route('editdone');
    }

    public function checkReserve($store_id){
        $user = auth()->user();
        if($user->auth_id != 2){
            return view('notfound');
        };

        $reserves = Reserve::where('reserves.store_id',$store_id)->
                             where('reserves.reserve_date', '>=', date('Y-m-d'))->
                             join('users', 'users.id', '=', 'reserves.user_id')->
                             select('users.name', 'users.email', 'reserves.reserve_date', 'reserves.id', 
                                    'reserves.reserve_time', 'reserves.number', 'reserves.store_id', 'reserves.visited')->
                             get()->sortBy('reserve_time')->sortBy('reserve_date');

        return view('storemanage/reserve', ['reserves' => $reserves]);
    }

    public function viewInfoMail(){
        $user = auth()->user();
        if($user->auth_id != 1){
            return view('notfound');
        };

        return view('siteadmin/sendmail', ['user' => $user]);
    }

    public function sendInfoMail(Request $request){
        $user = auth()->user();
        if($user->auth_id != 1){
            return view('notfound');
        };

        $request->validate([
            'title' => ['required', 'string',],
            'text' => ['required', 'string',],
        ]);

        $addresses = User::where('auth_id', 0)->get();

        foreach( $addresses as $address){
            Mail::to( $address->email )->send(new SendMail($request));
        };

        return view('siteadmin/sended', ['user' => $user]);
    }
}