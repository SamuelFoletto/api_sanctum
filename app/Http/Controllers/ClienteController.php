<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        return response()->json(Cliente::all(), 200);
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

        return response()->json(
            [
            'message' => 'Cliente cadastrado com sucesso!',
            'data' => $cliente
            ], 200
        );
    }


    public function show(string $id)
    {
        $cliente = Cliente::find($id);

        if($cliente){
            return response()->json($cliente, 200);
        } else {
            return response()->json([
                'message' => 'Cliente não foi encontrado!'
            ], 404);
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
            return response()->json(
                [
                    'message' => 'Cliente atualizado com sucesso!',
                    'data' => $cliente
                ], 200
            );
        } else {
            return response()->json([
                'message' => "Cliente não foi encontrado!"
            ], 404);
        }
    }


    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        if($cliente){
            $cliente->delete();
            return response()->json(
                [
                    'message' => 'Cliente apagado com sucesso!'
                ], 200
            );
        } else {
            return response()->json([
                'message' => 'Cliente não foi encontrado!'
            ], 402);
        }
    }
}
