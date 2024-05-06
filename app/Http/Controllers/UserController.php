<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Endereco;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Gate;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UserController extends Controller
{
    public function cadastrar_endereco(Request $request){
        
        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }

        $endereco = new Endereco;

        //deixando o CEP  apenas com os numeros
        $cep_organiz = parent::organizaCep($request->cep);

        if ($this->validaCepExistente($cep_organiz)) {
            return redirect()->back()->with('err', 'Endereço já cadastrado.');
        }
        
        $endereco->id_usuario = auth()->user()->id;
        $endereco->cep = $cep_organiz;
        $endereco->rua=$request->rua;
        $endereco->bairro=$request->bairro;
        $endereco->cidade=$request->cidade;
        $endereco->number_house=$request->number_house;
        $endereco->complemento=$request->complemento;

        $endereco->save();

        return redirect('/registro_end')->with('msg', 'Endereço cadastrado com sucesso!');
    }
    
    public function edit_endereco($id){

        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }

        $endereco = Endereco::findOrfail($id);

        if($endereco->id_usuario == auth()->user()->id){
            return view('user.registro_edit', ['endereco' => $endereco]);
        }

        abort(403); //acesso não autorizado
    }

    public function update_endereco(Request $request){

        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }
             
        $dados = $request->all();

        //Deixando o CEP apenas com os numeros
        $cep_organiz = parent::organizaCep($request->cep);

        if ($this->validaCepExistenteEdit($cep_organiz, $request->id)) {
            return redirect()->back()->with('err', 'Endereço já cadastrado.');
        }

        $dados['cep'] = $cep_organiz;

        Endereco::FindOrFail($request->id)->update($dados);
            
        return redirect('/registro_end')->with('msg', 'Endereço editado com sucesso!');
    }

    public function destroy_endereco($id){
        
        // Localize o endereco
        $endereco = Endereco::find($id);

        //Valida se o usuario dono do cadastro que está realizando a exclusão do produto
        if($endereco->id_usuario == auth()->user()->id){
            $endereco->delete();
            
            return redirect('/registro_end')->with('msg', 'Endereço excluido com sucesso!');
        }
        
        abort(403);
    }
    private function validaCepExistente($cep_form){

        $cep_cadastrado = Endereco::where('cep', $cep_form)->where('id_usuario', auth()->user()->id)->first();

        return $cep_cadastrado !== null;
    }

    private function validaCepExistenteEdit($cep_form, $id_endereco){
        
        $cep_cadastrado = Endereco::where('cep', $cep_form)->where('id_usuario', auth()->user()->id)->where('id', '!=', $id_endereco)->first();
        
        return $cep_cadastrado !== null;
    }
}
