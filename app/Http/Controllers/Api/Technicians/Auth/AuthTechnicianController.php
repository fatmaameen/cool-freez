<?php

namespace App\Http\Controllers\Api\Technicians\Auth;

use App\Models\technician;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\Technicians\Auth\technicianResource;
use Illuminate\Support\Facades\Auth;

class AuthTechnicianController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|string',
                'password' => 'required|string',
            ]);
            $technician = technician::where('email', $request->email)->first();
            if (!$technician || $technician->is_banned) {
                return response()->json(['message' => 'Your account is banned']);
            }
            if (!$technician || !Hash::check($request->password, $technician->password)) {
                return response()->json(['message' => 'Incorrect Email or Password']);
            }
            $token = $technician->createToken('auth_token', ['server:update'])->plainTextToken;
            $technician_info = technicianResource::make($technician);
            return response()->json(['token' => $token, 'message' => 'Logged in successfully', 'technician' => $technician_info]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong' . $e->getMessage()]);
        }
    }

    public function tokenValidation(Request $request)
    {
        try {
            $token = $request->bearerToken();
            if (!$token) {
                return ['error' => 'Token not provided'];
            }
            $technician = Auth::guard('sanctum')->user();
            if (!$technician) {
                return ['error' => 'Invalid token'];
            }
            return ['message' => 'Token is valid'];
        } catch (\Exception $e) {
            return ['error' => 'Token validation failed' . $e->getMessage()];
        }
    }

    public function logout(technician $technician)
    {
        try {
            $technician->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong' . $e->getMessage()]);
        }
    }
}
