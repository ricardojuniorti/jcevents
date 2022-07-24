<?php

namespace App\Http\Controllers;
use App\Models\UserProfile;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(){
        
        $userProfiles = UserProfile::Paginate(8);

        return view('userProfile.show',['userProfiles' => $userProfiles]);
    
    }

    public function createUserProfile(){
        return view('userProfile.createUserProfile');
    }

    public function recordUserProfile(Request $request){
        
        $userProfile = new UserProfile;
        $userProfile->description = $request->description;
        $userProfile->active = $request->active;
        date_default_timezone_set('America/Sao_Paulo');
        $userProfile->created_at = date('Y/m/d H:i', time());

        $userProfile->save();

        echo json_encode($request);
            
        return;
    }

    public function editUserProfile($id) {

        $userProfiles = UserProfile::findOrFail($id);

        return view('userProfile.editUserProfile',['userProfiles' => $userProfiles]);
       
    }

    public function updateUserProfile(Request $request) {

        //$data = $request->all();

        $data['description'] = $request->description;
        $data['active'] = $request->active;      
        $data['updated_at'] = date('Y/m/d H:i');
        
        UserProfile::findOrFail($request->id)->update($data);

        echo json_encode($request);
        
        return;
       
    }

    public function deleteUserProfile(Request $request) {

        
        $id = $request->userProfileId;

        UserProfile::findOrFail($id)->delete();

        return redirect('/userProfile/show')->with('msg', 'Perfil excluído com sucesso!');

    }
}
