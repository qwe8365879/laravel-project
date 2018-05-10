<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\UserGroup;
use App\Transformers\UserTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\AccessDenyException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $lookingForName = 'admin';
        $users = User::whereDoesntHave('userGroups', function ($query) use ($lookingForName) {
            $query->where('name', $lookingForName);
        })->get();
        return Fractal::collection($users, new UserTransformer);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return Fractal::includes('articles')->item($user, new UserTransformer);
    }

    public function update(\App\Http\Requests\Api\User\UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->get('name', $user->name);
        $user->email = $request->get('email', $user->email);
        $user->password = $request->has('password') ? Hash::make( $user->password ) : $user->password;
        $user->avatar = $request->get('avatar', $user->avatar);
        $user->update();

        return Fractal::includes('articles')->item($user, new UserTransformer); 
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
