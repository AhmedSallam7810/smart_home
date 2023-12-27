<?php


namespace App\Http\Helpers;

trait ApiResponse{

  public function apiResponse($data='',$message=''){
    $arr ['data'] = $data;
    $arr['message'] = $message;
    return response()->json($arr); 
  }
}