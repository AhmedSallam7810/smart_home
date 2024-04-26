<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\ImageUploader;
use App\Models\Admin;

class TypeController extends Controller
{
    use ImageUploader;
    use ApiResponse;

    public function index()
    {
        $types=Type::where('category',1)->get();

        return view('admin.types.index',compact('types'));
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
    public function create()
    {

        $types=Type::all();

        return view('admin.types.create',compact('types'));


    }



    public function store(TypeRequest $request)
    {
        $data=$request->validated();
        $data['category']=1;
        if($request->show_in_app){
            $data['show_in_app']=1;
        }
        else{
            $data['show_in_app']=0;
        }

        $image=$request->file('image');
        if($image){
            $image_name=$this->storeimage($image,'types');
            $data['image']=$image_name;
        }
        else{
            $data['image']='default.jpg';
        }


        $type=Type::create($data);


        return redirect()->route('admin.types.index')->with('success','IT WORKS!');;
    }


    public function edit($id)
    {

        $type=Type::find($id);

        return view('admin.types.edit',compact('type'));


    }



    public function update(TypeRequest $request, $id)
    {

        $type = Type::find($id);
        // if(!$type){
        //     return $this->apiResponse('',"Type not found");
        // }
        $updated_data=$request->validated();

        $image=$request->file('image');

        if($image){
            $image_name=$this->updateimage($image,'types',$type->image);
            $updated_data['image']=$image_name;
        }

        if($request->show_in_app){
            $updated_data['show_in_app']=1;
        }
        else{
            $updated_data['show_in_app']=0;
        }

        $type->update($updated_data);

        return redirect()->route('admin.types.index')->with('success','IT WORKS!');;



    }



    public function destroy($id)
    {
        $type = Type::find($id);
        // if(!$type){
        //     return $this->apiResponse('',"Type not found");
        // }

        if($type->image!='default.jpg'){
            $this->deleteimage($type->image,'types');
        }

        $type->delete();

        return redirect()->route('admin.types.index')->with('success','IT WORKS!');;


   }
}
