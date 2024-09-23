<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountConfirmationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\AfiliadosController;
use App\Http\Controllers\PixelController;

//ADMIN
use App\Http\Controllers\ADMIN\UserController;
use App\Http\Controllers\ADMIN\MaquinasController;
use App\Http\Controllers\ADMIN\SaquesController;
use App\Http\Controllers\ADMIN\ChatController;
use App\Http\Controllers\ADMIN\PedidosController;
use App\Http\Controllers\ADMIN\SessionsController;

//CHECKOUT
use App\Http\Controllers\CheckoutController;

//MISC
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;



use App\Services\CryptoCurrencyService;
use App\Http\Controllers\CotacaoController;
use App\Http\Controllers\ExchangeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['web'])->group(function () {

Route::get('/set-cookie', function (Request $request) {
    $cookie = cookie('userDiscount', 'sharkDiscount', 60*24*30); // 60 minutos
    return response('Cookie is set')->cookie($cookie);
});

Route::get('/', function (Request $request) {
    if ($request->has('code')) {
        return app()->call([AfiliadosController::class, 'CookieSaver'], ['code' => $request->input('code')]);
    }
    return view('welcome');
});

Route::get('/mining-report', [DashboardController::class, 'relatorio'])->name('mining.report');

Route::get('/mining-report/html', [DashboardController::class, 'relatorioHtml'])->name('mining.report');

Route::post('/recive/data', [CotacaoController::class, 'recive']);

Route::get('/createuser/{orderid}', [DashboardController::class, 'CreateUser'])->name('create.user');
Route::post('/createuser/{orderid}/post', [CheckoutController::class, 'CreateUserPost'])->name('create.user.post');


Route::get('/about', function () {
    return view('about');
});

Route::get('/captcha', function () {
    return view('welcome-ads');
});


Route::get('/terms', function () {
    return view('terms');
});

Route::get('/responsability', function () {
    return view('responsability');
});

Route::get('/email', function () {
    return view('mails.remarketing.one');
});

Route::get('/cm/{token}', [AccountConfirmationController::class, 'index'])->name('auth.cm');
Route::post('/ca/register', [AccountController::class, 'create'])->name('auth.ca');
Route::post('/cm/validate/{token}', [AccountConfirmationController::class, 'validateTokenAndCod'])->name('auth.cm.validate');
Route::post('/cm/validateDash', [AccountConfirmationController::class, 'ConfirmationOnDash'])->name('auth.cm.validateDash');




Route::group(['prefix' => 'checkout'], function () {
    Route::get('/{id}', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/payment/{id}', [CheckoutController::class, 'indexPayment'])->name('checkout.payment')->middleware('facebookTrack');
    Route::get('/payment/sucess/{id}', [CheckoutController::class, 'indexSucess'])->name('checkout.sucess')->middleware('facebookTrack');
    Route::post('/create/order', [CheckoutController::class, 'createOrder'])->name('checkout.createOrder');
    Route::post('/process/order', [CheckoutController::class, 'processPayment'])->name('checkout.processPayment');
});


Route::middleware([
    'auth:web',
    'verified',
])->group(function () {

    // Grupo de rotas para o Dashboard
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Grupo de rotas para Saques
        Route::group(['prefix' => 'saques'], function () {
            Route::get('/efetuar', [DashboardController::class, 'SaquesIndex'])->name('saques.efetuar');
            Route::post('/store', [WithdrawalController::class, 'store'])->name('saques.store');
            Route::post('/store/crypto', [WithdrawalController::class, 'StoreCrypto'])->name('saques.crypto');
            Route::post('/store/bank', [WithdrawalController::class, 'storeBankWithdrawal'])->name('saques.bank');
            Route::post('/store/pix', [WithdrawalController::class, 'storePixWithdrawal'])->name('saques.pix');
            Route::get('/historico', [DashboardController::class, 'HistoryIndex'])->name('saques.historico');
        });

        Route::group(['prefix' => 'status'], function () {
            Route::get('/uptime', [DashboardController::class, 'StatusIndex'])->name('status.index');
        });

        Route::group(['prefix' => 'cotas'], function () {
            Route::get('/adquirir', [DashboardController::class, 'CotasIndex'])->name('cotas.index');
        });

        Route::group(['prefix' => 'profiles'], function () {
            Route::get('/minha-conta', [DashboardController::class, 'MinhaContaIndex'])->name('profile.conta');
        });


        Route::group(['prefix' => 'relatorios'], function () {
            Route::get('/gerar', [DashboardController::class, 'RelatorioIndex'])->name('relatorios.index');
        });

        Route::group(['prefix' => 'maquinas'], function () {
            Route::get('/menu', [DashboardController::class, 'indexMachines'])->name('maquinas.menu');
            Route::get('/upgrade/{id}', [MachineController::class, 'upgradeMachine'])->name('maquinas.upgrade');
            Route::get('/adicionar', function () {
                return view('maquinas.adicionar');
                })->name('maquinas.adicionar');
            Route::post('/adcionar/order', [MachineController::class, 'createOrderAdicionar'])->name('maquinas.buy');
            Route::post('/upgrade/buy', [MachineController::class, 'createOrderUpgrade'])->name('maquinas.upgradeBuy');
            Route::post('/machines/store', [DashboardController::class, 'maquinaFicticiastore'])->name('machines.ficticia');
        });

        Route::group(['prefix' => 'exchange'], function () {
            Route::get('/main', [ExchangeController::class, 'index'])->name('exchange.main');
            Route::post('/convert', [ExchangeController::class, 'convertCrypto'])->name('exchange.convertCrypto');
        });

        Route::group(['prefix' => 'afiliacao'], function () {
            Route::get('/instrucao', [AfiliadosController::class, 'index'])->name('afiliacao.index');
            Route::post('/resgate', [AfiliadosController::class, 'resgate'])->name('afiliacao.resgate');
        });

        Route::group(['prefix' => 'suporte'], function () {
            Route::get('/instrucao', [DashboardController::class, 'SuporteIndex'])->name('suporte.index');
        });


        Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {

            Route::get('/users', [UserController::class, 'index'])->name('admin.users');
            Route::get('/users/moreinfo/{id}', [UserController::class, 'MoreInfo'])->name('admin.moreInfo');
            Route::post('/users/moreinfo/{id}', [UserController::class, 'BanUser'])->name('admin.banuser');
            Route::post('/users/impersonate/{id}', [UserController::class, 'impersonate'])->name('admin.impersonate');
            Route::post('/users/updateRole/', [UserController::class, 'updateRole'])->name('admin.update.role');

            Route::get('/maquinas', [MaquinasController::class, 'index'])->name('admin.maquinas');
            Route::post('/maquinas/create', [MaquinasController::class, 'create'])->name('admin.Mcreate');
            Route::post('/maquinas/charge', [MaquinasController::class, 'charge'])->name('admin.Mcharge');
            Route::post('/maquinas/delete', [MaquinasController::class, 'delete'])->name('admin.Mdelete');
            Route::post('/maquinas/endpoint', [MaquinasController::class, 'storeEndPoint'])->name('admin.Mendpoint');


            Route::get('/salas', [SalasController::class, 'index'])->name('admin.salas');
            Route::post('/salas/create', [SalasController::class, 'create'])->name('admin.Screate');

            Route::get('/saques', [SaquesController::class, 'index'])->name('admin.saques');
            Route::post('/saques/update/{id}', [SaquesController::class, 'update'])->name('admin.Supdate');

            Route::get('/chat', [ChatController::class, 'index'])->name('admin.chat');

            Route::get('/pedidos', [PedidosController::class, 'index'])->name('admin.pedidos');
            Route::get('/pedidos/moreinfo/{id}', [PedidosController::class, 'moreinfo'])->name('admin.pedidos.info');

            Route::get('/sessions', [SessionsController::class, 'index'])->name('admin.sessions');

            Route::get('/pixel', [PixelController::class, 'index'])->name('admin.pixel');
            Route::post('/pixel/store', [PixelController::class, 'store'])->name('pixel.store');
            Route::delete('/pixel/{pixel}', [PixelController::class, 'destroy'])->name('pixel.destroy');

            Route::post('/tag/store', [PixelController::class, 'GoogleStore'])->name('tag.store');
            Route::delete('/tag/{tag}', [PixelController::class, 'Googledestroy'])->name('tag.destroy');

            Route::get('/onlines', [SessionsController::class, 'indexOnlines'])->name('admin.onlines');

        });

    });
});
});
