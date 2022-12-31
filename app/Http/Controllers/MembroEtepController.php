<?php

namespace App\Http\Controllers;

use App\Models\MembroEtep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class MembroEtepController extends Controller
{
    public function visualizar_etep() {
        $membros_etep = MembroEtep::all();
        return view('visualizar-etep',['membros_etep' => $membros_etep]);
    }

    public function perfil_etep() {
        $membros_etep = MembroEtep::all();
        return view('perfil-etep',['membros_etep' => $membros_etep]);
    }

    public function cadastro_etep(){
        return view('cadastro-etep');
    }

    public function cadastrar_etep(Request $request) {
        $membro_etep = new MembroEtep;
        if ($request->senha != $request->confirmar_senha) {
            return redirect('/perfil-etep/cadastro-etep');
        }
        $membro_etep->matricula_membro = $request->matricula_membro;
        $membro_etep->nome = $request->nome;
        $membro_etep->email = $request->email;
        $membro_etep->senha = $request->senha;
        $membro_etep->save();
        return redirect('perfil-etep');
    }

    public function deletar_etep($matricula_membro){
        MembroEtep::findOrFail($matricula_membro)->delete();
        return redirect('/perfil-etep/visualizar-etep');
    }

    public function editar_etep($matricula_membro){
        $membro_etep = MembroEtep::findOrFail($matricula_membro);
        return view('editar-etep',['membro_etep' => $membro_etep]);
    }

    public function atualizar_etep(Request $request){
        MembroEtep::findOrFail($request->matricula_membro)->update($request->all());
        return redirect('/perfil-etep/visualizar-etep');
    }
    
}