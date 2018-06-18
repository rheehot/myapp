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

// Route::get('/docs/{file}', function ($file) {
//        $text = (new App\Documentation)->get($file);
//
//        return app(ParsedownExtra::class)->text($text);
//
//  });

/* 아티클 */
Route::resource('articles', 'ArticlesController');
Route::get('tags/{slug}/articles', [
    'as' => 'tags.articles.index',
    'uses' => 'ArticlesController@index',
]);

Route::get('/docs/{file?}', 'DocsController@show');

Route::get('mail', function () {
    $article = App\Article::with('user')->find(1);

    return Mail::send(
        'emails.articles.created',
        compact('article'),
        function ($message) use ($article) {
            $message->to('jowlee@naver.com');
            $message->to('jowlee@naver.com');
            $message->subject(sprintf('새 글이 등록되었습니다 - %s', $article->title));
        }
    );

//    return Mail::send(
//        'emails.articles.created',
//        compact('article'),
//        function ($message) use ($article) {
//            $message->from('yours1@domain', 'Your Name');
//            $message->to(['yours2@domain', 'yours3@domain']);
//            $message->subject(sprintf('새 글이 등록되었습니다 - %s', $article->title));
//            $message->cc('yours4@domain');
//            $message->attach(storage_path('elephant.png'));
//        }
//    );
//
//    return Mail::send(
//        ['text' => 'emails.articles.created-text'],
//        compact('article'),
//        function ($message) use ($article) {
//            $message->to('yours@domain');
//            $message->subject(sprintf('새 글이 등록되었습니다 - %s', $article->title));
//        }
//    );
//
//    return Mail::send(
//        'emails.articles.created',
//        compact('article'),
//        function ($message) use ($article) {
//            $message->to('yours@domain.com');
//            $message->subject(sprintf('새 글이 등록되었습니다 - %s', $article->title));
//        }
//    );

//Route::get('markdown', function () {
//    $text =<<<EOT
//**Note** To make lists look nice, you can wrap items with hanging indents:
//
//    -   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
//        Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi,
//        viverra nec, fringilla in, laoreet vitae, risus.
//    -   Donec sit amet nisl. Aliquam semper ipsum sit amet velit.
//        Suspendisse id sem consectetuer libero luctus adipiscing.
//EOT;

});
