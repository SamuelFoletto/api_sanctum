<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Services\ApiResponses;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        return ApiResponses::success(Cliente::all());
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'email' => 'required|email|unique:clientes',
                'telefone' => 'required',
            ]
        );

        $cliente = Cliente::create($request->all());

        return ApiResponses::success($cliente);
    }


    public function show(string $id)
    {
        $cliente = Cliente::find($id);

        if($cliente){
            return ApiResponses::success($cliente);
        } else {
            return ApiResponses::error('O cliente não foi localizado!');
        }
    }


    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nome' => 'required',
                'email' => 'required|email|unique:clientes,email,'.$id,
                'telefone' => 'required',
            ]
        );

        $cliente = Cliente::find($id);
        if($cliente){
            $cliente->update($request->all());
            return ApiResponses::success('Cliente atualizado com sucesso!');
        } else {
            return ApiResponses::error('O cliente não foi localizado!');
        }
    }


    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        if($cliente){
            $cliente->delete();
            return ApiResponses::success('Cliente deletado com sucesso!');
        } else {
            return ApiResponses::error('O cliente não foi localizado!');
        }
    }
}
