<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\imageUploader;
use App\Models\Admin;

class TypeController extends Controller
{
    use imageUploader;
    use ApiResponse;

    public function index()
    {
        $types=Type::all();
        $data = TypeResource::collection($types);
        // return $this->apiResponse($data,"return data successfully");
        return view('Admin.layouts.index');
    }


    
    public function show($id)
    {
        $type = Type::find($id);
        if(!$type){
            return $this->apiResponse('',"Type not found"); 
        }
        
        $data = TypeResource::make($type);
        return $this->apiResponse($data,"return data successfully");
        


    }

    
    
    public function store(TypeRequest $request)
    {
        $data=$request->validated();
        
        $image=$request->file('image');
        if($image){
            $image_name=$this->storeimage($image,'types');
            $data['image']=$image_name;
        }
        else{
            $data['image']='default.png';
        }
        $type=Type::create($data);

        $data = TypeResource::make($type);
        
        return $this->apiResponse($data,"stored data successfully");
    }

    
    

 
    
    public function update(TypeRequest $request, $id)
    {

        $type = Type::find($id);
        if(!$type){
            return $this->apiResponse('',"Type not found"); 
        }

        $updated_data=$request->validated();

        $image=$request->file('image');
        
        if($image){
            $image_name=$this->updateimage($image,'types',$type->image);
            $updated_data['image']=$image_name;
        }


        $type->update($updated_data);

        $data = TypeResource::make($type);
        return $this->apiResponse($data,"updated data successfully");


    }

   
    
    public function destroy($id)
    {
        $type = Type::find($id);
        if(!$type){
            return $this->apiResponse('',"Type not found"); 
        }

        if($type->image!='default.png'){
            $this->deleteimage($type->image,'types');
        }
        
        $type->delete();
        $data = TypeResource::make($type);
        return $this->apiResponse($data,"deleted data successfully");
        
   }
}