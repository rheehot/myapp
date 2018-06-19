<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 캐싱 설정
    |--------------------------------------------------------------------------
    |
    */
//    'cache' => true,
    'cache' => false,

//    // 다음처럼 해도 좋다.
//    ! env('APP_DEBUG', false),
//    app()->environment('production'),

    'etag' => true,

    /*
    |--------------------------------------------------------------------------
    | 프로젝트 기본 정보
    |--------------------------------------------------------------------------
    */
    'name' => 'MyApp',

    'url' => 'http://myapp.dev:8000',
    'api_domain' => env('API_DOMAIN', 'api.myapp.dev'),

    'description' => '',

    /*
    |--------------------------------------------------------------------------
    | Tag 목록
    |--------------------------------------------------------------------------
    */
    'tags' => [
        'ko' => [
            'laravel' => '라라벨',
            'lumen' => '루멘',
            'general' => '자유의견',
            'server' => '서버',
            'tip' => '팁',
        ],
        'en' => [
            'laravel' => 'Laravel',
            'lumen' => 'Lumen',
            'general' => 'General',
            'server' => 'Server',
            'tip' => 'Tip',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 업로드할 수 있는 파일 확장자
    |--------------------------------------------------------------------------
    */
    'mimes' => [
        'png',
        'jpg',
        'zip',
        'tar',
    ],

    /*
    |--------------------------------------------------------------------------
    | 정렬 필드
    |--------------------------------------------------------------------------
    */
    'sorting' => [
        'view_count' => '조회수',
        'created_at' => '작성일',
    ],

    /*
    |--------------------------------------------------------------------------
    | 지원하는 언어 목록
    |--------------------------------------------------------------------------
    */
    'locales' => [
        'ko' => '한국어',
        'en' => 'English',
    ],
];
