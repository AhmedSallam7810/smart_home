<?php


namespace App\Http\Helpers;

trait ApiResponse{

  public function apiResponse($data='',$message=''){
    $arr['status']=true;
    $arr['code']=200;
    $arr ['data'] = $data;
    $arr['message'] = $message;
    return response()->json($arr); 
  }
}