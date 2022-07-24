<?php

namespace App\Http\Controllers;
use App\Models\EventCategory;

use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function show(){
        
        $eventCategories = EventCategory::Paginate(8);

        return view('eventCategory.show',['eventCategories' => $eventCategories]);
    
    }

    public function createEventCategory(){
        return view('eventCategory.createEventCategory');
    }

    public function recordEventCategory(Request $request){
        
        $eventCategory = new EventCategory;
        $eventCategory->description = $request->description;
        $eventCategory->active = $request->active;
        date_default_timezone_set('America/Sao_Paulo');
        $eventCategory->created_at = date('Y/m/d H:i', time());

        $eventCategory->save();

        echo json_encode($request);
            
        return;
    }

    public function editEventCategory($id) {

        $eventCategories = EventCategory::findOrFail($id);

        return view('eventCategory.editEventCategory',['eventCategories' => $eventCategories]);
       
    }

    public function updateEventCategory(Request $request) {

        //$data = $request->all();

        $data['description'] = $request->description;
        $data['active'] = $request->active;      
        $data['updated_at'] = date('Y/m/d H:i');
        
        EventCategory::findOrFail($request->id)->update($data);

        echo json_encode($request);
        
        return;
       
    }

    public function deleteEventCategory(Request $request) {

        $id = $request->eventTypeId;

        EventCategory::findOrFail($id)->delete();

        return redirect('/eventCategory/show')->with('msg', 'Categoria excluída com sucesso!');

    }
}
