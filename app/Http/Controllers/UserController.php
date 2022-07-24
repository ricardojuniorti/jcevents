<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserProfile;

class UserController extends Controller
{
    
    public function show() {
   
        $users = User::buscar_dados();

        //dd($users);

        return view('user.show',['users' => $users]);

    }

    public function showPDF() {
        
        //dd($users);
        
        $users = User::buscar_dados();

        return view('user.showPDF',['users' => $users]);

    }

    public function showEXCEL() {
        
        //dd($users);
        
        $users = User::buscar_dados();

        return view('user.showEXCEL',['users' => $users]);

    }

    public function editUser($id) {

        $user = User::findOrFail($id);

        $userProfiles = UserProfile::all();

        //dd($userProfiles);

        return view('user.editUser',['user' => $user, 'userProfiles' => $userProfiles]);
       
    }

    public function updateUser(Request $request) {

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;    
        $data['user_profile_id'] = $request->perfilAcesso;   
        $data['updated_at'] = date('Y/m/d H:i');
        
        User::findOrFail($request->id)->update($data);

        echo json_encode($request);
        
        return;
       
    }

    public function deleteUser($id, Request $request) {

        $id = $request->userId;

        User::findOrFail($id)->delete();

        return redirect('/user/show')->with('msg', 'Usuário excluído com sucesso!');

    }

}
