<?php

use Illuminate\Support\Facades\Route;


Route::redirect('/', '/home');
Route::livewire('/home', 'pages::home');
Route::livewire('/profile', 'pages::profile');
