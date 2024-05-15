<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\redirectController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Controller;
use App\Models\Product;

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

Route::get('/',[redirectController::class, 'index']);

Route::get('/cart',[redirectController::class, 'cart']);

Route::get('/contato',[redirectController::class, 'contato']);

Route::get('/details',[redirectController::class, 'details']);

Route::get('/profile/{id}',[redirectController::class, 'profile']);

Route::get('/registro_end',[redirectController::class, 'registro']);

Route::get('/shop',[redirectController::class, 'shop'])->name('shop');

Route::get('/sobre',[redirectController::class, 'sobre']);

Route::get('/cadastroPage',[redirectController::class, 'cadastroPage']);

Route::get('/pagamento',[redirectController::class, 'pagamento']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->back();
    })->name('index');
});

Route::get('/confirm-password', [redirectController::class, 'changePassword'])
    ->middleware(['auth'])
    ->name('password.confirm');

Route::post('/products', [ProductController::class, 'store']);

Route::delete('/admin/{id}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('auth');;

Route::get('/admin/edit/{id}', [ProductController::class, 'edit']);

Route::post('admin/update/{id}', [ProductController::class, 'update']);

Route::post('/procura/product', [ProductController::class, 'busca_product'])->name('busca.busca_product');

Route::get('/shop/product/{id}', [ProductController::class, 'show_product']);

Route::post('/car/add_car', [CarrinhoController::class, 'add_carrinho']);

Route::delete('/car/delete/{id}', [CarrinhoController::class, 'destroy_car'])->name('car.destroy');

Route::post('/edit/car', [CarrinhoController::class, 'edit_carrinho']);

Route::get('/message', [redirectController::class, 'messageWhats']);

Route::get('/dashboard_admin', [redirectController::class,'dashboardAdmin']);

Route::get('/relatorio_admin', [redirectController::class,'relatorioAdmin']);

Route::get('/relatorio-scan_admin', [redirectController::class,'relatorioScanAdmin']);

Route::get('/produtos_admin', [redirectController::class,'produtosAdmin']);