<?php

use Illuminate\Support\Facades\Route;

Route::get('/', static fn() => redirect('/graphiql'));
