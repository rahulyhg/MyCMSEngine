<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Presenters
    |--------------------------------------------------------------------------
    |
    | Define your objects and their corrosponding presenters here to have them
    | automatically decorated when resolved in a view. The array key should
    | be your object and the value will be the presenter. Remember to use
    | the class names and not actual instances.
    |
    */

    EddiesBlog\Page::class => EddiesBlog\Presenters\PagePresenter::class,
    EddiesBlog\Post::class => EddiesBlog\Presenters\PostPresenter::class,
    EddiesBlog\User::class => EddiesBlog\Presenters\UserPresenter::class,



];
