<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Items;

class ItemEventController extends Controller
{
    public function show(){
        
        $items = Items::Paginate(8);

        return view('itemEvent.show',['items' => $items]);
    
    }

    public function createItemEvent(){
        return view('itemEvent.createItemEvent');
    }

    public function recordItemEvent(Request $request){
        
        $items = new Items;
        $items->description = $request->description;
        $items->active = $request->active;
        date_default_timezone_set('America/Sao_Paulo');
        $items->created_at = date('Y/m/d H:i', time());

        $items->save();

        echo json_encode($request);
            
        return;
    }

    public function editItemEvent($id) {

        $item = Items::findOrFail($id);

        return view('itemEvent.editItemEvent',['item' => $item]);
       
    }

    public function updateItemEvent(Request $request) {

        //$data = $request->all();

        $data['description'] = $request->description;
        $data['active'] = $request->active; 
        date_default_timezone_set('America/Sao_Paulo');    
        $data['updated_at'] = date('Y/m/d H:i', time());
        
        Items::findOrFail($request->id)->update($data);

        echo json_encode($request);
        
        return;
       
    }

    public function deleteItemEvent(Request $request) {

        $id = $request->itemEventId;

        Items::findOrFail($id)->delete();

        return redirect('/itemEvent/show')->with('msg', 'Item excluído com sucesso!');

    }
}
