<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Log;

class SellerController extends Controller
{
    public function index()
    {
        $seller = Seller::all();

        return view('seller.seller', compact('seller'));
    }

    public function create()
    {
        return view('seller.create');
    }

    public function store(Request $request)
    {
        $response = Seller::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
        ]);

        Log::info("Vendedor $response->id foi cadastrado");

        return redirect('/seller');
    }

    public function delete($id)
    {
        $seller = Seller::findOrFail($id);

        $seller->delete();

        Log::info("Cadastro do vendedor $id foi apagado");

        return redirect('/seller');
    }

    public function edit($id)
    {
        $seller = Seller::findOrFail($id);

        return view('seller.edit', compact('seller'));
    }

    public function update(Request $request, $id)
    {
        $seller = Seller::find($id);

        $seller->name = $request->input("name");
        $seller->email = $request->input("email");

        $seller->save();

        Log::info("Cadastro do vendedor $id foi alterado");

        return redirect('/seller');
    }
}
