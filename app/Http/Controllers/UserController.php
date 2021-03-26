<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Http\Resources\UserResource;
class UserController extends Controller
{
  public function index() {
      $users = User::with('role')->paginate();
      
      return UserResource::collection($users);
  }

  public function show($id) {
    $user = User::with('role')->find($id);

    return new UserResource($user);
  }

  public function store(UserCreateRequest $request) {
    $user = User::create(
      $request->only('first_name', 'last_name', 'email', 'role_id')
      + ['password' => Hash::make(1234)]
      );

    return response(new UserResource($user), 201);
  }

  public function update(UserUpdateRequest $request,$id) {
    $user = User::find($id);
    
    $user->update($request->only('first_name', 'last_name', 'email', 'role_id'));

    return response(new UserResource($user),202);

  }
  public function destroy($id) {
    User::destroy($id);

    return response(null,204);
  }


    public function user()
    {
      $user = \Auth::user();

      return (new UserResource($user))->additional([
          'data' => [
              'permissions' => $user->permissions(),
          ],
      ]);

    }


    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = \Auth::user();

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response(new UserResource($user), 201);
    }

 
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = \Auth::user();

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return response(new UserResource($user), 201);
    }
}
