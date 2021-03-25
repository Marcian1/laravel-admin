<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
  public function index() {
      return User::all();
  }

  public function show($id) {
    return User::find($id);
  }

  public function store(Request $request) {
    return User::create([
      'first_name' => $request->input('first_name'),
      'last_name' => $request->input('last_name'),
      'email' => $request->input('email'),
      'password' => Hash::make($request->input('password')),
    ]);

    return response($user, Response::HTTP_CREATED);
  }

  public function update(Request $request,$id) {
    $user = User::find($id);
    $user->update([
      'first_name' => $request->input('first_name'),
      'last_name' => $request->input('last_name'),
      'email' => $request->input('email'),
      'password' => Hash::make($request->input('password')),
    ]);

    return response($user,202);

  }
  public function destroy($id) {
    User::destroy($id);

    return response(null,204);
  }
}