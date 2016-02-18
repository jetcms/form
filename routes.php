<?php

Route::get('form/{name}', '\JetCMS\Form\Http\Controllers\MailController@getMailController');
Route::post('form/{name}', '\JetCMS\Form\Http\Controllers\MailController@postMailController');
Route::any('form/{name}/success', '\JetCMS\Form\Http\Controllers\MailController@anySuccess');