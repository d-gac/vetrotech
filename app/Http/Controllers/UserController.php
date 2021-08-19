<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    //php artisan db:seed --class=UsersTableSeeder - admin account
    /**
     * @OA\Tag(
     *     name="Konto",
     *     description="Autoryzacja użytkowników",
     * )
     */


    /**
     * @OA\Post (
     *     path="/api/register",
     *     tags={"Konto"},
     *     summary="Zarejestruj",
     *
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *     oneOf={
     *      @OA\Schema(type="boolean")
     *           }
     *      ),
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="An ""unexpected"" error"
     *      ),
     *
     *     @OA\RequestBody(
     *
     *        @OA\JsonContent(
     *             type="object",
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="User123"
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="john@doe.com"
     *                      ),
     *                      @OA\Property(
     *                         property="password",
     *                         type="string",
     *                         example="password123"
     *                      ),
     *                      @OA\Property(
     *                         property="password_confirmation",
     *                         type="string",
     *                         example="password123"
     *                      ),
     *        )
     *     ),
     *
     * )
     */

    /**
     * @param UserRequest $request
     *
     * @return Response
     */
    public function register(UserRequest $request):Response
    {
            $user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $token = $user->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
    }

    /**
     * @OA\Post (
     *     path="/api/login",
     *     tags={"Konto"},
     *     summary="Zaloguj",
     *
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *     oneOf={
     *      @OA\Schema(type="boolean")
     *           }
     *      ),
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="An ""unexpected"" error"
     *      ),
     *
     *     @OA\RequestBody(
     *
     *        @OA\JsonContent(
     *             type="object",
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="john@doe.com"
     *                      ),
     *                      @OA\Property(
     *                         property="password",
     *                         type="string",
     *                         example="password"
     *                      ),
     *        )
     *     ),
     *
     * )
     */


    /**
     * @param Request $request
     *
     * @return Response
     */
    function login(Request $request):Response
    {
        $user= User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Te dane uwierzytelniające nie są zgodne z naszymi danymi.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'message' => 'Zalogowano pomyślnie',
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    /**
     * @OA\Post (
     *     path="/api/logout",
     *     tags={"Konto"},
     *     summary="Wyloguj",
     *
     *
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *     oneOf={
     *      @OA\Schema(type="boolean")
     *           }
     *      ),
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="Error",
     *     ),
     *     @OA\Response(
     *     response="default",
     *     description="An ""unexpected"" error"
     *      ),
     * )
     */


    /**
     * @return String
     */
    public function logout():String
    {
        auth()->user()->tokens()->delete();

        return 'Wylogowano pomyślnie';

    }
}
