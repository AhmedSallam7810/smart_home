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
use Illuminate\Support\Facades\Session;

class DeviceTypeController extends Controller
{
    use ImageUploader;
    use ApiResponse;

    public function index()
    {
        $types=Type::where('category',2)->get();

        return view('admin.device_types.index',compact('types'));
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
        return view('admin.device_types.create');
    }



    public function store(TypeRequest $request)
    {
        $data=$request->validated();
        $data['category']=2;
        if($request->show_in_app){
            $data['show_in_app']=1;
        }
        else{
            $data['show_in_app']=0;
        }


        $type=Type::create($data);

        Session::flash('success','Successfully Added');

        return redirect()->route('admin.device.types.index');
    }


    public function edit($id)
    {
        $type=Type::find($id);
        return view('admin.device_types.edit',compact('type'));

    }



    public function update(TypeRequest $request, $id)
    {

        $type = Type::find($id);
        // if(!$type){
        //     return $this->apiResponse('',"Type not found");
        // }
        $updated_data=$request->validated();


        if($request->show_in_app){
            $updated_data['show_in_app']=1;
        }
        else{
            $updated_data['show_in_app']=0;
        }

        $type->update($updated_data);

        Session::flash('success','Successfully updated');

        return redirect()->route('admin.device.types.index');



    }



    public function destroy($id)
    {
        $type = Type::find($id);

        if(count($type->devices)){
            Session::flash('error','there are devices with this type');
            return redirect()->route('admin.device.types.index');
        }

        $type->delete();
        Session::flash('success','Successfully Deleted');

        return redirect()->route('admin.device.types.index');


   }
}
