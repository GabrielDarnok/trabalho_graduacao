<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\redirectController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\GraphController;
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

# Desativado por não ter necessidade de ser aplicado no momento.
#Route::get('/profile/{id}',[redirectController::class, 'profile']);

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
        return redirect('/');
    })->name('index');
});

Route::post('/products', [ProductController::class, 'store']);

Route::delete('/admin/{id}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('auth');

Route::delete('/admin/user/{id}', [UserController::class, 'destroyUser'])->name('user.destroy')->middleware('auth');

Route::post('/admin/user/change/{id}', [UserController::class, 'changeUser'])->name('change.user')->middleware('auth');

Route::post('/admin/admin/change/{id}', [UserController::class, 'changeAdmin'])->name('change.admin')->middleware('auth');

Route::get('/admin/edit/{id}', [ProductController::class, 'edit']);

Route::post('admin/update/{id}', [ProductController::class, 'update']);

Route::post('/procura/product', [ProductController::class, 'busca_product'])->name('busca.busca_product');

Route::get('/shop/product/{id}', [ProductController::class, 'show_product']);

Route::post('/car/add_car', [CarrinhoController::class, 'add_carrinho']);

Route::delete('/car/delete/{id}', [CarrinhoController::class, 'destroy_car'])->name('car.destroy');

Route::post('/edit/car', [CarrinhoController::class, 'edit_carrinho']);

Route::get('/message', [redirectController::class, 'messageWhats']);

Route::get('/dashboard_admin', [redirectController::class,'dashboardAdmin']);

Route::get('/dados_usuario', [redirectController::class,'dadosUser']);

Route::get('/produtos_admin', [redirectController::class,'produtosAdmin']);

Route::get('/forgot_password', [redirectController::class,'changePassword']);

Route::post('/car/pedido', [CarrinhoController::class,'finalizaPedido'])->name('add.pedido');

Route::get('/pedido', [redirectController::class,'pedido']);

Route::get('/usuario-admin', [redirectController::class,'usuarioAdmin']);

Route::get('/dadosbar', [GraphController::class, 'dadosBar']);

Route::get('/dadosbar2', [GraphController::class, 'dadosBar2']);

Route::get('/dados-circular', [GraphController::class, 'dadosCircular']);

Route::get('/dadosline', [GraphController::class, 'dadosLine']);

Route::post('/add-phone', [UserController::class, 'dadosPhone'])->name('add.phone')->middleware('auth');