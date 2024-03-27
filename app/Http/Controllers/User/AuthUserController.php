<?php

namespace App\Http\Controllers\User;

use App\DTO\User\RegistrationUserDTO;
use App\DTO\UserLoginDTO;
use App\DTO\UsersDTO;
use App\Exceptions\BadCredentialsException;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Exceptions\NotVerifiedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\User\AuthUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    public function __construct(
        private AuthUserService $authUserService
    )
    {
    }

    /**
     * @throws ExistsObjectException
     */
    public function register(UserRequest $request): JsonResponse
    {
        $validData = $request->validated();

        $this->authUserService->registration(RegistrationUserDTO::fromArray($validData));

        return response()->json([
            'message' =>__('messages.code_send'),
        ]);
    }

    /**
     * @throws BadCredentialsException
     */
    public function confirmationEmail(Request $request): JsonResponse
    {
        $this->authUserService->confirmEmail($request);

        return response()->json([
            'message'=>__('messages.email_verified'),
        ]);

    }

    /**
     * @throws BadCredentialsException
     * @throws NotVerifiedException
     * @throws NotFoundException
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        /**
         * @var User $user
         */
        $validatedData = $request->validated();

        $userToken = $this->authUserService->login($validatedData);

        return response()->json([
            'token' => $userToken
        ]);

    }

    public function logout(): JsonResponse
    {

        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "logged out"
        ]);
    }

}
