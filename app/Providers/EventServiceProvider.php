<?php

namespace App\Providers;

use App\Events\ArticleCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'App\Events\Event' => [
//            'App\Listeners\EventListener',
        //  \App\Events\ArticlesEvent::class => [
        //  \App\Listeners\ArticlesEventListener::class,
        \App\Events\ArticlesEvent::class => [
            \App\Listeners\ArticlesEventListener::class,
        ],
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\UsersEventListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
        // \Event::listen(
        //     //'article.created',
        //     \App\Events\ArticleCreated::class,
        //     \App\Listeners\ArticlesEventListener::class
        // );

//        $events->listen('article.created', function($article) {
//            var_dump('이벤트를 받았습니다. 받은 데이터(상태)는 다음과 같습니다.');
//            var_dump($article->toArray());
//        });

//        $events->listen(
//            'article.created',
//            \App\Listeners\ArticlesEventListener::class
//        );

//        $events->listen(
//            \App\Events\ArticleCreated::class,
//            \App\Listeners\ArticlesEventListener::class
//        );

    }
}
