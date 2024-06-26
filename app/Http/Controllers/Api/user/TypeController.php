<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\imageUploader;

class TypeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $types=Type::where('category',1)->get();
        $data = TypeResource::collection($types);
        return $this->apiResponse($data,"return data successfully");
    }

    public function getDeviceTypes()
    {
        $types=Type::where('category',2)->get();
        $data = TypeResource::collection($types);
        return $this->apiResponse($data,"return data successfully");
    }

}
