<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        //Find user
        $user = User::where('username','=',$request->username)->first();

        //Check if user exists and password matches
        if($user && Hash::check($request->password, $user->password)){
            Auth::login($user);
            return redirect(route('user.index'));
        }
        Auth::logout();
        return redirect()->back()->with('error', 'Login Failed: Invalid user/password');
    }

    public function getUserList(){
        //Get logged in user model
        $current_user = User::find(Auth()->user()->id);

        //Get logged in user permissions
        $permissions = $current_user->getPermissions();

        //Get user company name
        $company_name = $current_user->company->name;

        //Start getting user list
        $user_list = User::join('companies', 'companies.id', '=', 'users.company_id')
                    ->join('roles', 'roles.id', '=', 'users.role_id')
                    ->where('users.company_id', '=', $current_user->company_id);
        
        //Check permissions "MANAGE_COMPANY_USERS" if user can view all members in the same company
        //NOTE: Current data design (higher role id = lower standing)
        if(in_array('MANAGE_COMPANY_USERS',$permissions)){
            $user_list->where('roles.id', '>', 'users.role_id');
        }
        
        //Gather final user list
        $user_list = $user_list->select(
                                    'users.id', 
                                    'users.name',
                                    'companies.name as company_name',
                                    'roles.name as role_name')
                                ->get();
        
        //Pack return data
        $data = [
            'user_list' => $user_list,
            'title_company_name' => $company_name,
            'user_permissions' => $permissions,
        ];
        
        //Check permissions "VIEW_ALL_SUPERVISORS" to view other company supervisors
        if(in_array('VIEW_ALL_SUPERVISORS',$permissions)){
            $other_spv_list = User::join('companies', 'companies.id', '=', 'users.company_id')
                        ->join('roles', 'roles.id', '=', 'users.role_id')
                        ->where('users.company_id', '!=', $current_user->company_id)
                        ->where('roles.name', '=', 'Supervisor')
                        ->select(
                            'users.id', 
                            'users.name',
                            'companies.name as company_name',
                            'roles.name as role_name')
                        ->get();
            
            //Append additional data to return
            $data = array_merge($data, ['other_spv_list' => $other_spv_list]);
        }
        
        return view('user/index')->with([
            'data' => $data,
        ]);
    }
    
    public function getUserDetail($id){
        $user = User::find($id);
        
        $company_name = $user->company->name;

        $role_name = $user->role->name;

        $permissions = Permission::select('name', 'definition')->get();

        $user_permissions = $user->getPermissions();

        $data = [
            'name' => $user->name,
            'company_name' => $company_name,
            'role_name' => $role_name,
            'permissions' => $permissions,
            'user_permissions' => $user_permissions,
        ];

        return view('user/detail')->with('data',$data);
    }

    public function formRegisterUser(){
        $roles = Role::select('id', 'name')->get();

        $permissions = Permission::select('name', 'definition')->get();

        $data = [
            'roles' => $roles,
            'permissions' => $permissions,
        ];

        return view('user/register')->with('data',$data);
    }

    public function registerUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role_id' => 'required|integer|min:1',
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->company_id = Auth()->user()->company_id;
        $user->role_id = $request->role;
        $user->save();
        
        return redirect(route('user.index'));
    }

    public function formEditUser($id){
        $user = User::find($id);

        $user_role_id = $user->role->id;

        $roles = Role::select('id', 'name')->get();

        $data = [
            'name' => $user->name,
            'username' => $user->username,
            'roles' => $roles,
            'user_role_id' => $user_role_id,
        ];

        return view('user/edit')->with(['data'=>$data,'id'=>$id]);
    }

    public function editUser(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username,'.$id.'|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|integer|min:1',
        ]);
        $user = User::find($id);
        if($user){
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role;
            $user->save();
            return redirect(route('user.index'));
        }
        return redirect()->back()->with('error', 'Edit Failed');
    }

    public function formDeleteUser($id){
        $user = User::find($id);

        $role_name = $user->role->name;

        $data = [
            'name' => $user->name,
            'role_name' => $role_name,
        ];

        return view('user/delete')->with(['data'=>$data,'id'=>$id]);
    }

    public function deleteUser($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect(route('user.index'));
        }
        return redirect()->back()->with('error', 'Delete Failed');
    }
}
