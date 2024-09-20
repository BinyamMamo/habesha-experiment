<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PdfController;

Route::post('/convert-pdf', [PdfController::class, 'convertPdfToImage']);

Route::view('/upload-pdf', 'pdf_upload');
