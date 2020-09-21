<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($file){

        $fileName = time().$file->getClientOriginalName();
        $destinationPath = public_path('images');
        if ($file->isValid()) {

            $file->move($destinationPath, $fileName);
            return $fileName;
        }
        return null;
    }
    public function deleteFile($fileName){
        $destinationPath = public_path('images');
        $fileLocation = $destinationPath.'/'.$fileName;
        unlink($fileLocation);
    }
    public function getBill($params){

        $data = Bill::orderBy('id','desc');
        if (isset($params['status'])){
            $data = $data->where('status',$params['status']);
        }
        if (isset($params['staff_id'])){
            $data = $data->where('staff_id',$params['staff_id']);
        }
        if (isset($params['date'])){
            $data = $data->whereBetween('created_at',$params['date']);
        }
        if (isset($params['transport_id'])){
            $data = $data->where('transport_id',auth()->user()->transport_id);
        }
//        if (auth()->user()->role == 'staff'){
//            $data = $data->where('staff_id',auth()->id());
//        }
        $data = $data->get();
        return $data;
    }
}
