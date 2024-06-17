<?php

use Illuminate\Support\Facades\Route;

// web
use App\Http\Controllers\web\main_controller;

// settings
use App\Http\Controllers\settings\settings_controller;

use App\Http\Controllers\settings\merchandise_m_controller;
use App\Http\Controllers\settings\instagram_t_controller;
use App\Http\Controllers\settings\question_m_controller;


Route::get('/', [main_controller::class, 'index'])->name('web.index');

Route::get('/merchandise', [main_controller::class, 'merchandise'])->name('web.merchandise');

Route::get('/inquiry', [main_controller::class, 'inquiry'])->name('web.inquiry');

Route::get('/forcorporation', [main_controller::class, 'forcorporation'])->name('web.forcorporation');

Route::get('/farminfo', [main_controller::class, 'farminfo'])->name('web.farminfo');

Route::get('/password_check', [main_controller::class, 'password_check'])->name('web.password_check');


Route::post('/password_check/password_check_process', [main_controller::class, 'password_check_process'])->name('web.password_check_process');
Route::post('/inquiry/send_inquiry_mail_process', [main_controller::class, 'send_inquiry_mail_process'])->name('web.send_inquiry_mail_process');


Route::get('settings', [settings_controller::class, 'index'])->name('settings.index');

Route::get('settings/login', [settings_controller::class, 'login'])->name('settings.login');

Route::get('settings/logout', [settings_controller::class, 'logout'])->name('settings.logout');

Route::post('settings/login_check', [settings_controller::class, 'login_check'])->name('settings.login_check');

Route::get('settings/menu', [settings_controller::class, 'menu'])->name('settings.menu');

Route::get('settings/system_check', [settings_controller::class, 'system_check'])->name('settings.system_check');

Route::get('settings/merchandise_m/index', [merchandise_m_controller::class, 'index'])->name('settings.merchandise_m.index');
Route::get('settings/merchandise_m/settings_screen', [merchandise_m_controller::class, 'settings_screen'])->name('settings.merchandise_m.settings_screen');
Route::post('settings/merchandise_m/save', [merchandise_m_controller::class, 'save'])->name('settings.merchandise_m.save');
Route::post('settings/merchandise_m/delete', [merchandise_m_controller::class, 'delete'])->name('settings.merchandise_m.delete');
Route::post('settings/merchandise_m/image_upload', [merchandise_m_controller::class, 'image_upload'])->name('settings.merchandise_m.image_upload');

Route::get('settings/question_m/index', [question_m_controller::class, 'index'])->name('settings.question_m.index');
Route::get('settings/question_m/settings_screen', [question_m_controller::class, 'settings_screen'])->name('settings.question_m.settings_screen');
Route::post('settings/question_m/save', [question_m_controller::class, 'save'])->name('settings.question_m.save');
Route::post('settings/question_m/delete', [question_m_controller::class, 'delete'])->name('settings.question_m.delete');

Route::get('settings/instagram_t/index', [instagram_t_controller::class, 'index'])->name('settings.instagram_t.index');
Route::get('settings/instagram_t/settings_screen', [instagram_t_controller::class, 'settings_screen'])->name('settings.instagram_t.settings_screen');
Route::get('settings/instagram_t/instagram_confirmation', [instagram_t_controller::class, 'instagram_confirmation'])->name('settings.instagram_t.instagram_confirmation');
Route::post('settings/instagram_t/save', [instagram_t_controller::class, 'save'])->name('settings.instagram_t.save');
Route::post('settings/instagram_t/delete', [instagram_t_controller::class, 'delete'])->name('settings.instagram_t.delete');