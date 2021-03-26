<?php

namespace App\Http\Controllers;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
   
    public function index()
    {
        return Role::all();
    }

   
    public function store(Request $request)
    {
        $role = Role::create($request->only('name'));

        return response($role, 201 );
    }

   
    public function show($id)
    {
        return Role::find($id);
    }

    
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $role->update($request->only('name'));

        return response($role, 202);
    }

    
    public function destroy($id)
    {
        Role::destroy($id);

        return response(null, 204);
    }
}
