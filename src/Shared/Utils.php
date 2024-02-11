<?php

namespace Siroko\Shared;

class Utils
{

    static function authUser(): \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Auth\Authenticatable
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $user;
    }
}
