<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserController;
use App\Http\Requests\Api\UpdateUserController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return ResponseFormatter::success($users);
    }
    public function show(User $user)
    {
        return ResponseFormatter::success($user);
    }
    public function store(CreateUserController $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return ResponseFormatter::success($user);   
    }
    public function update(UpdateUserController $request, User $user)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user->update($data);
        return ResponseFormatter::success($user);   
    }
    public function destroy(User $user)
    {
        $user->delete();
        return ResponseFormatter::success($user);
    }
}
