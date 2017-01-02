<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\DB;


use App\user as users;

Route::get('/', function () {
    return view('welcome');
});


Route::get('customer', function () {

    $users = users::all();

    foreach ($users as $user) {
        $role = DB::table('roles')->select('display_name')->where('id','=',$user->role_id)->get();
//        $role =   $role = DB::table('roles')->find($user->role_id);
//        print_r($role);
//        echo $role[0]->display_name;
        
        $testing = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.id', 'roles.display_name')
            ->get();
        
        
        print_r($testing);
    }


});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index');
