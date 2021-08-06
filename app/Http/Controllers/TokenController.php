<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
     /**
     * @param Request $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = User::query()->firstWhere('email', $request->input('email'));

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw new AuthenticationException();
        }

        $token = $user->createToken('')->plainTextToken;

        return response([
            'data' => [
                'token' => $token,
            ],
        ]);
    }

     /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
