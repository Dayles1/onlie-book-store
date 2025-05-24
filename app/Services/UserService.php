<?php
namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(protected UserRepositoryInterface $userRepository) {}

    public function index()
    {
        return $this->userRepository->getAll();
    }

    public function show($id)
    {
        return $this->userRepository->find($id);
    }

    public function store($dto)
    {
        return $this->userRepository->store($dto);
    }

    public function update($dto, $id)
    {
        return $this->userRepository->find($id);
        if ($user->role === 'admin') {
        return $this->userRepository->update($dto, $user);
        }
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }
}
