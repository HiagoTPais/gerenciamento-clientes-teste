<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * @OA\Post (
     *     path="/api/login",
     *     tags={"Login"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="password"
     *                      )
     *                 ),
     *                 example={
     *                     "email":"exemplo@gmail.com",
     *                     "password":"xxxxxxxx"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *      )
     * )
     */

    public function index(Request $request)
    {
        $user = User::where('email', $request->email)->get();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $response['token'] =  $user->createToken('token')->plainTextToken;

            $response['name'] =  $user->name;

            Log::info("Usuario $user->id logou na api de autenticação");

            return response(201, $response);
        } else {
            return response(['error' => 'Unauthorised']);
        }
    }
}
