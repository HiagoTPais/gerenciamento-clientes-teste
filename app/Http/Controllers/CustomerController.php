<?php

namespace App\Http\Controllers;

use App\Mail\CustomerMail;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\Phone;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();

        return view('customer.customer', compact('customer'));
    }

    public function create()
    {
        $seller = Seller::all();

        return view('customer.create', compact('seller'));
    }

    public function store(Request $request)
    {
        $img_name = $this->uploadImg($request);

        $response = Customer::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "seller_id" => $request->input("seller"),
            "client_type_id" => $request->input("client_type"),
            "img" => $img_name
        ]);

        Log::info("Cliente $response->id foi cadastrado");

        foreach ($request->input("phone") as $key => $value) {
            if (!is_null($value)) {
                Phone::create([
                    "phone" => $value,
                    "customer_id" =>  $response->id
                ]);
            }
        }

        Mail::to($request->input("email"))->send(new CustomerMail);

        Log::info("Email de boas vindas foi enviado para o cliente $response->id");

        return redirect('/customer');
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);

        Storage::delete('public/images' . $customer->img);

        $customer->delete();

        Log::info("Cadastro do cliente $id foi apagado");

        return redirect('/customer');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        $seller = Seller::all();

        $phone = Phone::where('customer_id', '=', $id)->get();

        return view('customer.edit', compact('customer', 'seller', 'phone'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $img_name = $this->uploadImg($request);

        Storage::delete('public/images' . $customer->img);

        $customer->name = $request->input("name");
        $customer->email = $request->input("email");
        $customer->client_type_id = $request->input("client_type");
        $customer->seller_id = $request->input("seller");
        $customer->img = $img_name != null ? $img_name : $customer->img;

        $customer->save();

        Phone::where('customer_id', $id)->delete();

        foreach ($request->input("phone") as $key => $value) {
            if (!is_null($value)) {
                Phone::create([
                    "phone" => $value,
                    "customer_id" => $id
                ]);
            }
        }

        Log::info("Cadastro do cliente $id foi alterado");

        return redirect('/customer');
    }

    public function uploadImg($request)
    {
        $img_name = null;

        if ($request->hasFile('img')) {
            $path = "public/images";
            $img = $request->file("img");
            $img_name = time() . '.' . $img->getClientOriginalName();
            $request->file("img")->storeAs($path, $img_name);
        }

        return $img_name;
    }
    /**
     * @OA\Get (
     *     path="/api/customer/{name?}",
     *     tags={"Buscar clientes"},
     *     @OA\Parameter(
     *         in="path",
     *         name="name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="name", type="text", example="Carlos"),
     *         )
     *     )
     * )
     */

    public function customerList($name = null)
    {
        if (is_null($name)) {
            $response = Customer::all();
        } else {
            $response = Customer::where('name', 'like', '%' . $name . '%')->get();
        }

        Log::info("Lista de clientes");

        return new CustomerResource($response);
    }
}
