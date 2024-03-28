<?php

namespace App\Services\User;

use App\DTO\User\LoginUserDTO;
use App\DTO\User\RegistrationUserDTO;
use App\Exceptions\BadCredentialsException;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Exceptions\NotVerifiedException;
use App\Http\Requests\User\LoginUserRequest;
use App\Interfaces\IUserRepository;
use App\Jobs\SendConfirmCodeJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws ExistsObjectException
     */
    public function registration(RegistrationUserDTO $registrationUserDTO): void
    {
        $existingUser = $this->userRepository->getByEmail($registrationUserDTO->getEmail());

        if ($existingUser !== null) {
            throw new ExistsObjectException(__('messages.object_with_email_exists'), 409);
        }

        $user = $this->userRepository->create($registrationUserDTO);

        $confirmCode = rand(9999, 99999);

        Cache::put('confirm_code_' . $user->email, $confirmCode, 60 * 5);

        SendConfirmCodeJob::dispatch($registrationUserDTO->getEmail(), $confirmCode);
    }

    /**
     * @throws BadCredentialsException
     */
    public function confirmEmail(Request $request): void
    {
        $email = $request->input('email');
        $confirmCode = $request->input('confirm_code');

        $cashedConfirmCode = Cache::get('confirm_code_' . $email);

        if ($cashedConfirmCode != $confirmCode) {
            throw new BadCredentialsException(__('messages.invalid_credentials'), 403);
        }

        Cache::forget('confirm_code_' . $email);

        $user = $this->userRepository->getByEmail($email);

        $user['email_verified_at'] = now();

        $user->save();
    }

    /**
     * @throws NotVerifiedException
     * @throws BadCredentialsException
     * @throws NotFoundException
     */
    public function login(LoginUserDTO $loginUserDTO)
    {

        $user = $this->userRepository->getByEmail($loginUserDTO->getEmail());

        if (!$user) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        if ($user['email_verified_at'] === null) {
            throw new NotVerifiedException(__('messages.email_not_verified'), 403);
        }

        if (!$user || !Hash::check($loginUserDTO->getPassword(), $user->password)) {

            throw new BadCredentialsException(__('messages.bad_credentials'));

        }

        return $user->createToken('auth-token')->plainTextToken;
    }
}
