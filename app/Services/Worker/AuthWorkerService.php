<?php

namespace App\Services\Worker;

use App\DTO\Worker\RegistrationWorkerDTO;
use App\Exceptions\BadCredentialsException;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Exceptions\NotVerifiedException;
use App\Interfaces\IWorkerRepository;
use App\Jobs\SendConfirmCodeJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthWorkerService
{
    protected IWorkerRepository $workerRepository;

    public function __construct(IWorkerRepository $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }

    /**
     * @throws ExistsObjectException
     */
    public function registration(RegistrationWorkerDTO $registrationWorkerDTO): void
    {
        $existingWorker = $this->workerRepository->getByEmail($registrationWorkerDTO->getEmail());

        if ($existingWorker !== null) {
            throw new ExistsObjectException(__('messages.object_with_email_exists'), 409);
        }

        $worker = $this->workerRepository->create($registrationWorkerDTO);

        $confirmCode = rand(9999, 99999);

        Cache::put('confirm_code_' . $worker->email, $confirmCode, 60 * 5);

        SendConfirmCodeJob::dispatch($registrationWorkerDTO->getEmail(), $confirmCode);
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

        $user = $this->workerRepository->getByEmail($email);

        $user['email_verified_at'] = now();

        $user->save();
    }

    /**
     * @throws NotVerifiedException
     * @throws BadCredentialsException
     * @throws NotFoundException
     */
    public function login(array $request)
    {

        $worker = $this->workerRepository->getByEmail($request['email']);

        if ($worker === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        if ($worker['email_verified_at'] === null) {
            throw new NotVerifiedException(__('messages.email_not_verified'), 403);
        }

        if (!$worker || !Hash::check($request['password'], $worker->password)) {

            throw new BadCredentialsException(__('messages.invalid_credentials'));

        }

        return $worker->createToken('auth-token')->plainTextToken;
    }
}
