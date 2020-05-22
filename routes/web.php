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

Route::get('/', function () { // retorna vista de usuarios
    $users = App\User::get();

    return view('welcome', ['users' => $users]);
});

Route::get('/profile/{id}', function ($id) { //paso el parametro de id para la ruta profile

    $user = App\User::find($id);

    $posts = $user->posts() 
        ->with('category','image','tags')
        ->withCount('comments')->get; //traemos y contamos todos los posts. Al traer las categorias
                                    // imagenes y comentarios ayudamos a no cargar de consultas 
                                    //a la vista.

    $videos = $user->videos()
        ->with('category','image','tags')
        ->withCount('comments')->get;

    return view ('profile',[
        'user'  => $user,
        'posts' => $posts,
        'videos'=> $videos

    ]);
})->name('profile'); //el nombre es profile por eso lo coloco aqui

Route::get('/level/{id}', function ($id) {

    $level = App\Level::find($id);

    $posts = $level->posts() 
        ->with('category','image','tags')
        ->withCount('comments')->get; 

    $videos = $level->videos()
        ->with('category','image','tags')
        ->withCount('comments')->get;

    return view ('level',[
        'level' => $level,
        'posts' => $posts,
        'videos'=> $videos

    ]);
})->name('level');