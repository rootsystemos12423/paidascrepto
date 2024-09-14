<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\PaymentNotificationController;
use App\Http\Controllers\PixelController;

use App\Http\Controllers\CotacaoController;


// PAYLOADERS
use App\Http\Controllers\PAYLOADERS\PlanPayloaderController;
use App\Http\Controllers\PAYLOADERS\MaquinasPayloaderController;
use App\Http\Controllers\PAYLOADERS\SalasPayloaderController;
use App\Http\Controllers\PAYLOADERS\UpgradeMaquinaPayloaderController;
use App\Http\Controllers\PAYLOADERS\UpgradePlanPayloaderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/send-facebook-event', [PixelController::class, 'sendEvent']);

Route::post('/process/plan/order', [PlanPayloaderController::class, 'data']);

Route::post('/process/planCard/order', [PlanPayloaderController::class, 'CardData']);




Route::get('/machines/list', [CotacaoController::class, 'listmachines']);
