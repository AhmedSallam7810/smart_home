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
      public function apiResponse404($data='',$message=''){
        $arr['status']=true;
        $arr['code']=404;
        $arr ['data'] = $data;
        $arr['message'] = $message;
        return response()->json($arr);
      }


}
