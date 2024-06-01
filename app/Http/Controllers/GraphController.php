<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GraphController extends Controller
{
    public function dadosBar(){
        if(!isset(auth()->user()->id) || auth()->user()->role != "admin"){
            return redirect('/');
        }

        // Consulta para agrupar e contar pedidos por mês e ano
        $pedidosPorMes = Pedido::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Inicializar array para contagens de pedidos por mês
        $contagensPorMes = array_fill(0, 12, 0);

        // Preencher contagens de pedidos por mês com os resultados da consulta
        foreach ($pedidosPorMes as $pedido) {
            $contagensPorMes[$pedido->month - 1] = $pedido->count;
        }

        $dados = [
            'labels' => ['Jan', 'Fev', 'Mar', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Set', 'Out', 'Nov', 'Dez'],
            'dados' => $contagensPorMes
        ];

        // Retornar os dados como JSON
        return Response::json(['dados' => $dados]);
    }
    public function dadosBar2(){
        if(!isset(auth()->user()->id) || auth()->user()->role != "admin"){
            return redirect('/');
        }

        /// Consulta para agrupar e contar produtos por mês e ano
        $produtosPorMes = Product::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Inicializar array para contagens de produtos por mês
        $contagensPorMes = array_fill(0, 12, 0);

        // Preencher contagens de produtos por mês com os resultados da consulta
        foreach ($produtosPorMes as $produto) {
            $contagensPorMes[$produto->month - 1] = $produto->count;
        }

        $dados2 = [
            'labels' => ['Jan', 'Fev', 'Mar', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Set', 'Out', 'Nov', 'Dez'],
            'dados' => $contagensPorMes
        ];

        // Retornar os dados como JSON
        return Response::json(['dados2' => $dados2]);
    }

    public function dadosCircular(){

        if(!isset(auth()->user()->id) || auth()->user()->role != "admin"){
            return redirect('/');
        }

        // Consulta para agrupar por Nome_produto e contar os pedidos, limitando a 5 produtos
        $bestProducts = Pedido::selectRaw('Nome_produto, COUNT(*) as count')
            ->groupBy('Nome_produto')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        // Estruturar os dados para o gráfico
        $labels = $bestProducts->pluck('Nome_produto');
        $counts = $bestProducts->pluck('count');

        return Response::json(['labels' => $labels, 'counts' => $counts]);
    }

    public function dadosLine(){
        if(!isset(auth()->user()->id) || auth()->user()->role != "admin"){
            return redirect('/');
        }

        // Consulta para agrupar e contar usuários por mês e ano
        $usuariosPorMes = User::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Inicializar array para contagens de usuários por mês
        $contagensPorMes = array_fill(0, 12, 0);

        // Preencher contagens de usuários por mês com os resultados da consulta
        foreach ($usuariosPorMes as $usuario) {
            $contagensPorMes[$usuario->month - 1] = $usuario->count;
        }

        $dados_do_grafico = [
            'labels' => ['Jan', 'Fev', 'Mar', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Set', 'Out', 'Nov', 'Dez'],
            'dados' => $contagensPorMes
        ];
        
        // Retornar os dados como JSON
        return Response::json(['dados_do_grafico' => $dados_do_grafico]);
    }
}
