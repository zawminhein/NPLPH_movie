<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAllUsers()
    {
        return User::with('roles')->latest()->get();
    }
    public function getUser($id)
    {
        return User::with('roles')->find($id);
    }

    public function createUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if(!empty($data['role'])) {
            $user->assignRole($data['role']);
        }

        return $user;
    }

    public function updateUser($user, $data) 
    {
        $updateData = [
            'name' => $data['name'],
        ];

        if(!empty($data['password'])){
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        if(!empty($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $user;
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }
}