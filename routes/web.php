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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Category
Route::group(['prefix' => 'categories'],function (){
   Route::get('list','CategoriesController@categories_list')->name('categories_list');
   Route::get('create', function (){
       return view('admin.categories.create');
   })->name('categories_create');
   Route::get('add', 'CategoriesController@category_create')->name('addCategory');
   Route::get('edit/{id}', 'CategoriesController@category_edit')->name('editCategory');
   Route::get('update/{id}', 'CategoriesController@category_update')->name('updateCategory');
   Route::get('delete/{id}', 'CategoriesController@category_delete')->name('deleteCategory');
});

//Money
Route::group(['prefix' => 'money'],function (){
   Route::get('list','MoneyController@finance_list')->name('finance_list');
   Route::get('add', 'MoneyController@money_create')->name('addMoney');
});

//News
Route::group(['prefix' => 'news'],function (){
    Route::get('list','NewsController@news_list')->name('news_list');
    Route::get('create', function (){
        return view('admin.news.create');
    })->name('news_create');
    Route::post('add', 'NewsController@new_create')->name('addNews');
    Route::get('edit/{id}', 'NewsController@new_edit')->name('editNews');
    Route::post('update/{id}', 'NewsController@new_update')->name('updateNews');
    Route::get('delete/{id}', 'NewsController@new_delete')->name('deleteNews');
});

//Posts
Route::group(['prefix' => 'posts'],function (){
    Route::get('list','PostsController@posts_list')->name('posts_list');
    Route::get('create', function (){
        return view('admin.posts.create');
    })->name('posts_create');
    Route::post('add', 'PostsController@postcreate')->name('addPost');
    Route::get('edit/{id}', 'PostsController@postedit')->name('editPost');
    Route::post('update/{id}', 'PostsController@postupdate')->name('updatePost');
    Route::get('delete/{id}', 'PostsController@postdelete')->name('deletePost');
});

//Profile user
Route::group(['prefix' => 'profile'],function (){
    Route::get('detail/{userid}','ProfilesController@profile_detail')->name('profileDetail');
    Route::get('create', function (){
        return view('admin.profiles.create');
    })->name('profile_create');
    Route::post('add', 'ProfilesController@profile_create')->name('addProfile');
    Route::get('edit/{userid}', 'ProfilesController@profile_edit')->name('editProfile');
    Route::post('update/{userid}', 'ProfilesController@profile_update')->name('updateProfile');
    Route::get('delete/{userid}', 'ProfilesController@profile_delete')->name('deleteProfile');
});

//Wallet handling
Route::group(['prefix' => 'wallet'],function (){
    Route::get('list','WalletsController@wallets_list')->name('wallets_list');
    Route::get('create', function (){
        return view('admin.wallets.create');
    })->name('wallet_create');
    Route::post('add', 'WalletsController@wallet_create')->name('addWallet');
    Route::get('edit/{id}', 'WalletsController@wallet_edit')->name('editWallet');
    Route::post('update/{id}', 'WalletsController@wallet_update')->name('updateWallet');
    Route::get('delete/{id}', 'WalletsController@wallet_delete')->name('deleteWallet');
});

//Report
Route::group(['prefix' => 'report'],function (){
    Route::get('income', 'ReportsController@income_report')->name('incomeReport');
    Route::get('paid', 'ReportsController@paid_report')->name('paidReport');
    Route::get('total_info', 'ReportsController@total_info_report')->name('totalReport');
});

//Geography
Route::group(['prefix' => 'geo'],function (){
    Route::get('full_address', 'GeoController@full_address')->name('full_address');
    Route::get('cities', 'GeoController@cities_list')->name('citiesList');
    Route::get('districts', 'GeoController@districts_list')->name('districtsList');
    Route::get('wards', 'GeoController@wards_list')->name('wardsList');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
