<?php

/* Route::get('/test', function () {
    return App\Profile::find(1)->user;
}); */

Route::get('/', 'FrontEndController@index');

Auth::routes();
Route::get('/dashboard', [
    'uses' => 'HomeController@index',
    'as' =>'home'
]);


Route::resource('users', 'UsersController');
//Route::post('/users/create', 'UsersController@store')->name('users.create');
Route::get('/users/admin/{id}', 'UsersController@admin')->name('users.admin');
Route::get('/user/profile', 'ProfileController@index')->name('user.profile');
Route::put('/user/profile/{id}', 'ProfileController@update')->name('user.profile.update');
Route::delete('/user/delete/{id}', 'usersController@destroy');
Route::get('/users/not-admin/{id}', 'UsersController@not_admin')->name('users.not_admin');
//Route::resource('post', 'PostsController');

Route::get('/settings', 'SettingController@index');

Route::get('/results', function(){
    $posts = \App\Post::where('title','like', '%'. request('query') . '%')->get();
    return view('results')->with('posts', $posts)
                        ->with('title', 'Search results : ' . request('query'))
                        ->with('settings', \App\Setting::first())
                        ->with('categories', \App\Category::take(5)->get())
                        ->with('query', request('query'));
});

Route::get('/tag/{id}', 'FrontEndController@tag')->name('tag.single');
Route::get('/category/{id}', 'FrontEndController@category')->name('category.single');
Route::get('/{slug}', 'FrontEndController@singlePost')->name('post.single');

//Route::get('/settings', 'SettingController@index');
Route::put('/setting/update', 'SettingController@update')->name('setting.update');;

Route::resource('gallary', 'GallaryController');

Route::group(['prefix'=> 'admin', 'middleware' => 'auth'], function () {

/*     Route::get('/dashboard', [
        'uses' => 'HomeController@index',
        'as' =>'home'
    ]);
 */
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');
    Route::get('/posts/trashed', 'PostsController@trashed')->name('posts.trashed');
    Route::delete('/posts/kill/{id}', 'PostsController@kill')->name('posts.kill');
    Route::post('/posts/restore/{id}', 'PostsController@restore')->name('posts.restore');
    Route::resource('posts', 'PostsController');
/*
     Route::get('/posts/trashed', [
        'uses' => 'PostsController@trashed',
        'as' => 'posts.trashed'
    ]);
 */
    Route::get('/post/create', [
        'uses' => 'PostsController@create',
        'as' => 'post.create'
    ]);

    Route::post('/post/store', [
        'uses' => 'PostsController@store',
        'as' => 'post.store'
    ]);

 /*   Route::get('/category/create', [
        'uses' => 'CategoriesController@create',
        'as' => 'category.create'
    ]);

    Route::get('/categories', [
        'uses' => 'CategoriesController@index',
        'as' => 'categories'
    ]);

    Route::post('/category/store', [
        'uses' => 'CategoriesController@store',
        'as' => 'category.store'
    ]);

    Route::post('/category/store', [
        'uses' => 'CategoriesController@store',
        'as' => 'category.store'
    ]);

    Route::get('/category/edit/{id}', [
        'uses' => 'CategoriesController@edit',
        'as' => 'category.edit'
    ]); */

});

