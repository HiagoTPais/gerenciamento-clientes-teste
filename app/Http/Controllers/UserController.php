<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $body = $request->getContent();

        $data = json_decode($body);

        $user = User::where('email', $data->email)->first();

        if (!$user || !Hash::check($data->password, $user->password)) {
            return response([
                'message' => ['Usuario não foi encontrado.']
            ], 404);
        }

        $token = $user->createToken('token')->plainTextToken;

        Log::info("Usuario $user->id logou na api de autenticação");

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
