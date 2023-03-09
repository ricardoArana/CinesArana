<?php

use App\Http\Controllers\CineController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PeliculaController;
use App\Models\Cine;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/* Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\DemoMail($details));

    dd("Email is Sent.");
}); */

Route::get('/stripe-payment/{proyeccion}', [StripeController::class, 'handleGet'])->name('pagar');
Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');

Route::get('/', [CineController::class, 'notuser'])
->name('notuser');

Route::get('/dashboard', [CineController::class, 'index'])
->name('inicio');

Route::get('/peliculas', [CineController::class, 'peliculas'])
->name('peliculas');

Route::get('/cines', [CineController::class, 'cines'])
->name('cines');

Route::get('/reserva/{proyeccion}', [CineController::class, 'reserva'])
->name('reserva');

Route::post('/reservar', [CineController::class, 'reservar'])
->name('reservar');

Route::get('/preguntas', [CineController::class, 'preguntas'])
->middleware(['auth'])->name('preguntas');

Route::get('/miPerfil', [CineController::class, 'miPerfil'])
->middleware(['auth'])->name('miPerfil');

Route::post('/cambiarCineFav', [CineController::class, 'cambiarCineFav'])
->name('cambiarCineFav');

Route::get('/usuarios', [CineController::class, 'usuarios'])
->middleware(['auth'])->name('usuarios');

Route::get('/modificarUsuario/{usuario}', [CineController::class, 'modificarUsuario'])
->middleware(['auth'])->name('modificarUsuario');

Route::get('/pdf', function () {
    $pdf = app('dompdf.wrapper');
    $user = Auth::user();
    $reservas = Auth::user()->reservas;
    $cines = Cine::all();
    $pdf->loadView('pruebaPdf', compact('user', 'cines', 'reservas'))->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->download('pruebapdf.pdf');
  });


require __DIR__.'/auth.php';
