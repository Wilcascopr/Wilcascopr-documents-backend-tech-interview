<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $users;
    public function __construct(\App\Models\User $users)
    {
        $this->users = $users;
        $this->middleware('auth:sanctum')->except(['logIn']);
    }

    public function logIn(Request $request)
    {
        $validator = validator($request->only('email', 'password'), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails())
            return response()->json([
                'message' => 'Hubo un error de validación. ' . $validator->errors()->first(),
            ], 422);

        try {

            $user = $this->users->where('email', $request->email)->first();

            if (!auth()->attempt($request->only('email', 'password')))
                return response()->json([
                    'message' => 'Credenciales incorrectas.'
                ], 401);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hubo un error al iniciar sesión. ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    public function fetchUser()
    {
        try {
            $user = auth('sanctum')->user();

            if (!$user)
                return response()->json([
                    'message' => 'No se encontró el usuario.'
                ], 404);

            return response()->json([
                'user' => $user
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hubo un error al obtener el usuario. ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    public function logOut()
    {
        try {
            $user = auth('sanctum')->user();

            if (!$user)
                return response()->json([
                    'message' => 'No se encontró el usuario.'
                ], 404);

            $user->tokens()->delete();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return response()->json([
                'message' => 'Sesión cerrada correctamente.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hubo un error al cerrar sesión. ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }
}
