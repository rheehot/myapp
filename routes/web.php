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

Route::get('/', function () {
    return view('welcome',[
        'name' =>'Foo',
        'greeting' => '안녕하세요?',
    ]);
});
