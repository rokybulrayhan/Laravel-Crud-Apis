<?php

namespace App\Http\Controllers;

use App\Models\CrudItem;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class CrudItemController extends Controller
{
    public function addItem(Request $request){
        $item_add = $request;
        $request = $request->all();
        //echo $item_add;

        $validator = \Validator::make($request, [  
            'item_name' => 'required|string|unique:crud_items',
            'price' => 'required|integer',
        ], [
            
            'item_name' => 'Your item name is already used',  
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors' => $validator->getMessageBag(),
            
            ],501);
        }

        $item_add->validate([         
            'item_name' => 'required|string|unique:crud_items',
            'price' => 'required|integer',
        ]);

        $addItem = new CrudItem([
            'item_name' => $item_add->item_name,   
            'price' => $item_add->price,     
            
        ]);

        $addItem->save();

        return response()->json([
            'message' => 'Successfully created item!',
            'item_name' => $item_add->item_name,
            'price' =>$item_add->price
        ], 201);
        
        
    }
    public function deleteItem($id){     
        DB::table('crud_items')->where('id',$id)->delete();  
        return response()->json([
         'massage' => 'this item was deleted',
     ]);  
    }
    public function editItem(Request $request, $id){
        $data = array();
        $data['item_name'] = $request->item_name;
        $data['price'] = $request->price;
        DB::table('crud_items')->where('id',$id)->update($data);  
        return response()->json([
        'massage' => 'this item was updated',
    ]);         

    }   
    public function allItem(){
     
        $all = DB::table('crud_items')->get();  
        return response()->json(
            $all,
    ); 
    }
    
    public function itemDetails($id){
        $itemDetails = DB::table('crud_items')->where('id',$id)->get(); 
        return response()->json(
            $itemDetails
    ); 
    }

    
}
