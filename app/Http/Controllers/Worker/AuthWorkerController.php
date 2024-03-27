<?php

namespace App\Http\Controllers\Worker;

use App\DTO\User\RegistrationUserDTO;
use App\DTO\Worker\RegistrationWorkerDTO;
use App\Exceptions\BadCredentialsException;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Exceptions\NotVerifiedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\WorkerLoginRequest;
use App\Http\Requests\WorkerRequest;
use App\Models\User;
use App\Services\User\AuthUserService;
use App\Services\Worker\AuthWorkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthWorkerController extends Controller
{
    public function __construct(
        protected AuthWorkerService $workerService
    )
    {
    }

    /**
     * @throws ExistsObjectException
     */
    public function register(WorkerRequest $request): JsonResponse
    {
        $validData = $request->validated();

        $this->workerService->registration(RegistrationWorkerDTO::fromArray($validData));

        return response()->json([
            'message' =>__('messages.code_send'),
        ]);
    }

    /**
     * @throws BadCredentialsException
     */
    public function confirmationEmail(Request $request): JsonResponse
    {
        $this->workerService->confirmEmail($request);

        return response()->json([
            'message'=>__('messages.email_verified'),
        ]);

    }

    /**
     * @throws BadCredentialsException
     * @throws NotVerifiedException
     * @throws NotFoundException
     */
    public function login(WorkerLoginRequest $request): JsonResponse
    {

        $validatedData = $request->validated();

        $workerToken = $this->workerService->login($validatedData);

        return response()->json([
            'token' => $workerToken
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
