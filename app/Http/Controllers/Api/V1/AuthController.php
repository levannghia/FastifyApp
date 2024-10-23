<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        try {
            $user = User::where('phone', $data['phone'])->first();
            if ($user) {
                if (Hash::check($data['password'], $user->password)) {
                    $expiresAt = now()->addDays(1);
                    $token = $user->createToken('user_token', ['*'], $expiresAt)->plainTextToken;
                    // Tạo refresh token
                    $refreshToken = Str::random(60);
                    $user->refresh_token = $refreshToken;
                    // $user->refresh_token_expiry = now()->addDays(1); 
                    $user->save();

                    return response()->json([
                        'message' => 'Đăng nhập thành công',
                        'data' => [
                            'user' => new UserResource($user),
                            'expires_at' => $expiresAt
                        ],
                        'access_token' => $token,
                        'refresh_token' => $refreshToken
                    ], 200);
                }
                return response()->json([
                    'errors' => [
                        'password' => [
                            "Mật Khẩu không chính xác!"
                        ]
                    ],
                    'message' => 'Mật khẩu không chính xác!',
                ], 400);
            } else {
                return response()->json([
                    'errors' => [
                        'email' => [
                            "Tài khoản không tồn tại!"
                        ]
                    ],
                    'message' => 'Tài khoản không tồn tại!',
                ], 400);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Trả về lỗi validation
            return response()->json([
                'errors' => $e->errors(),
                'message' => 'Validation error!'
            ], 422);
        } catch (\Exception $e) {
            Log::error("message: " . $e->getMessage() . ' ---- line: ' . $e->getLine());
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Register error!'
            ], 500);
        }
    }

    public function refresh(Request $request)
    {
        $refreshToken = $request->refresh_token;
        $user = User::where('refresh_token', $refreshToken)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid refresh token'
            ], 401);
        }

        $currentToken = $user->currentAccessToken();
        if ($currentToken) {
            $expiresAt = $currentToken->expires_at;
            if ($expiresAt && now()->lt($expiresAt)) {
                // Nếu token chưa hết hạn, trả về token hiện tại
                return response()->json([
                    'access_token' => $currentToken->token,
                    'refresh_token' => $refreshToken,
                    'message' => 'Current token is still valid'
                ], 200);
            }
        }

        // Xóa token cũ nếu có
        $user->tokens()->delete();
        // $user->currentAccessToken()->delete();
        $expiresAt = now()->addDays(1);
        // Tạo access token mới
        $token = $user->createToken('user_token', ['*'], $expiresAt)->plainTextToken;

        // Tạo refresh token mới (tùy chọn)
        $newRefreshToken = Str::random(60);
        $user->refresh_token = $newRefreshToken;
        $user->save();

        return response()->json([
            'access_token' => $token,
            'refresh_token' => $newRefreshToken,
            'expires_at' => $expiresAt,
            'message' => 'Token refreshed successfully'
        ], 200);
    }

    public function updateUserLocation(Request $request) {
        $validatedData = $request->validate([
            'liveLocation'=> 'required|array',
        ]);

        $user = auth()->user();
        $user->live_location = $validatedData['liveLocation'];
        $user->save();

        return response()->json([
            "data" => [
                "user" => new UserResource($user),
            ]
        ]);
    }
}
