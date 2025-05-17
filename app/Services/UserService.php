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

    public function store($request)
    {
        return $this->userRepository->store($request);
    }

    public function update($data, $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }
}
