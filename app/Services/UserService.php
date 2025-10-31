<?php 

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAllUsers($data)
    {
        $perPage = $data->get('per_page', 10);
        return User::with('roles')->orderBy('id', 'desc')->paginate($perPage);
    }
    public function getUser($id)
    {
        return User::with('roles')->find($id);
    }

    public function storeUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $role = Role::find($data['role']);
        if(!$role){
            throw new \Exception('Role not found');
        }
        $user->assignRole($role);

        return $user;
    }

    public function updateUser($user, $data) 
    {
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if(!empty($data['password'])){
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        $role = Role::find($data['role']);
        if(!$role){
            throw new \Exception('Role not found');
        }
        
        $user->syncRoles($role);

        return $user;
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }
}