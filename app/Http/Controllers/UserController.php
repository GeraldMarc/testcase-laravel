<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        //Find user
        $user = User::where('username','=',$request->username)->first();

        //Gather permissions
        $permissions = RolePermission::join('roles', 'role_id', '=', 'roles.id')
                                    ->join('permissions', 'permission_id', '=', 'permissions.id')
                                    ->where('role_id', '=', $user->role_id)
                                    ->select('permissions.name as permission')
                                    ->get();
        if($user){
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
                return redirect(route('user.index'))->with('success','Login Successful');
            }
        }
        return redirect()->back()->with('error', 'Login Failed');
    }

    public function getList(){
        $current_user = Auth()->user();
        $current_company_list = User::join('companies', 'companies.id', '=', 'users.company_id')
                    ->join('roles', 'roles.id', '=', 'users.role_id')
                    ->where('users.company_id', '=', $current_user->company_id)
                    ->select(
                        'users.id', 
                        'users.name',
                        'companies.name as company_name',
                        'roles.name as role_name');

        //Check permissions "VIEW_ALL_SUPERVISORS"
        $permissions = User::find(Auth()->user()->id)->getPermissions();
        if(in_array('VIEW_ALL_SUPERVISORS',$permissions)){
            $other_company_list = User::join('companies', 'companies.id', '=', 'users.company_id')
                        ->join('roles', 'roles.id', '=', 'users.role_id')
                        ->where('users.company_id', '!=', $current_user->company_id)
                        ->where('roles.name', '=', 'Supervisor')
                        ->select(
                            'users.id', 
                            'users.name',
                            'companies.name as company_name',
                            'roles.name as role_name');
            $result = $current_company_list->union($other_company_list)->get();
            return view('user/index')->with('data', $result);
        }

        return view('user/index')->with('data', $current_company_list);
    }
}
