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

//Route::get('/', function () {
////    return view('welcome');
//    return "<h1>Hello Foo</h1>";
//});

//Route::get('/{foo}', function ($foo) {
//    return $foo;
//});

//Route::pattern('foo', '[0-9a-zA-Z]{3}');
//
//Route::get('/{foo?}', function ($foo="bar") {
//    return $foo;
//});

//Route::get('/{foo?}', function ($foo="bar") {
//    return $foo;
//})->where('foo','[0-9a-zA-Z]{3}');

//Route::get('/', [
//    'as' => 'home',
//    function() {
//        return '제 이름은 "home" 입니다';
//    }
//]);
//
//Route::get('/home', function () {
//    return redirect(route('home'));
//});

//Route::get('/', function () {
//    return view('welcome')->with('name','Foo');
//});

//Route::get('/', function () {
//    return view('welcome')->with([
//        'name'=>'foo',
//        'greeting' => '안녕하세요?',
//    ]);
//});

//Route::get('/', function () {
//    return view('welcome',[
//        'name' =>'Foo',
//        'greeting' => '안녕하세요?',
//    ]);
//});

//Route::get('/', function () {
//    $items = ['apple', 'banana', 'tomato'];
//    return view('welcome', ['items' => $items]);
//});

//Route::resource('articles', 'ArticlesController');

Route::get('auth/login', function () {
    $credentials = [
        'email' => 'john@example.com',
        'password' => 'password',
    ];

    if (! auth()->attempt($credentials)) {
        return '로그인 정보가 정확하지 않습니다.';
    }

    return redirect('protected');
});

Route::get('protected', ['middleware' => 'auth', function () {
    var_dump(session()->all());

//    if (! auth()->check()) {
//        return '누구세요?';
//    }

    return '어서오세요 ' . auth()->user()->name;
}]);

Route::get('auth/logout', function () {
    auth()->logout();

    return '또 봐요~';
});

//Route::auth();
//
//Route::get('/home', 'HomeController@index');
//
//Route::get('password/remind', 'Auth\PasswordController@getEmail');
Route::get('/', 'WelcomeController@index');

Auth::routes();

//Event::listen('articles.created', function($article) {
//    var_dump('이벤트를 받았습니다. 받은 데이터(상태)는 다음과 같습니다.');
//    var_dump($article->toArray());
//});


Route::auth();

//DB::listen(function($query){
//    var_dump($query->sql);
//});

Route::get('/home', 'HomeController@index');
Route::resource('articles', 'ArticlesController');
