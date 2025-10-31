<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Worker\StoreWorkerRequest;
use App\Http\Requests\Worker\UpdateWorkerRequest;
use App\Interfaces\User\IUserService;
use App\Models\User;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = ($this->userService->index(['role' => Role::WORKER->value]))->toResourceCollection();

        return sendSuccessResponse(data: $workers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkerRequest $request)
    {
        $data = $request->validated();
        $data['role'] = Role::WORKER->value;
        $data['password'] = defaultPassword();
        $worker = ($this->userService->store($data))->toResource();

        return sendSuccessResponse(message: 'تم انشاء العامل بنجاح',data: $worker);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->find(column: 'id', value: $id);
        return $user->hasRole(Role::WORKER->value)
            ? sendSuccessResponse(message: 'تم ارجاع العامل بنجاح',data: $user->toResource())
            : sendFailedResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerRequest $request, string $id)
    {
        $user = $this->userService->find(column: 'id', value: $id);
        if($user->hasRole(Role::WORKER->value)) {
            $data = $request->validated();

            $worker = ($this->userService->update(id: $user->id, data: $data))->toResource();

            return sendSuccessResponse(message: 'تم تحديث العامل بنجاح',data: $worker);
        }
       return sendFailedResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->find(column: 'id', value: $id);
        if($user->hasRole(Role::WORKER->value)) {

            $this->userService->delete(id: $user->id);

            return sendSuccessResponse(status_code: 204);
        }
        return sendFailedResponse();

    }
}
