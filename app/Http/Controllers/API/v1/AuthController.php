<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Requests\v1\Auth\RegisterRequest;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        try {

            $token = Auth::attempt($credentials);

            if (!$token) {
                return response()->json([
                    'error' => 'Введенные Вами данные неверены',
                ], 401);
            }

            return response()->json([
                'data' => [
                    'user' => Auth::user(),
                    'authorization' => [
                        'access_token' => $token,
                        'type' => 'bearer',
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Произошла ошибка: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create(array_merge(
                $request->validated(),
                ['password' => bcrypt($request->password)]
            ));

            return response()->json([
                'message' => 'Пользователь успешно зарегистрирован.',
                'user' => $user
            ], 201);
        } catch (Exception $e) {
            // Обработка исключения
            Log::error('Произошла ошибка при регистрации: ' . $e->getMessage());
            return response()->json(['error' => 'Произошла ошибка при регистрации'], 500);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Пользователь успешно вышел из системы.']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json([
            'data' => auth()->user(),
        ]);
    }
}
