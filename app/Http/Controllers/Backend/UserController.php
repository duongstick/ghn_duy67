<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateAvatar;
use App\Http\Requests\UpdatePassword;
use App\Models\Bill;
use App\Models\Transport;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $data = User::where('role','customer')->get();
        return view('backend.user.index',compact('data'));
    }
    public function staffList(){
        $data = User::where('role','staff')->get();
        $title = 'Danh Sách Nhân Viên';
        return view('backend.user.index',compact('data','title'));
    }
    public function seller(){
        $data = User::where('role','seller')->get();
        $title = 'Danh Sách Người bán';
        return view('backend.user.index',compact('data','title'));
    }
    public function profile($id){
        $info = User::findorFail($id);
        $transports = Transport::all();
        return view('backend.user.profile',compact('info','transports'));
    }
    public function create(){
        return view('backend.user.create');
    }
    public function postCreate(CreateUser $request){
        $params = $request->all();
        unset($params['_token']);
        $file = $request->file('avatar');
//        dd($file);
//        $path = $file->getClientOriginalExtension();
//        $allow = ['jpg','png','jpeg'];
//        if (!in_array($path,$allow)){
//            return back()->with('error','File upload phải là JPG, PNG', 'JPEG');
//        }
        $avatar = $this->uploadFile($file);
        $password = $request->get('password');
        $password = bcrypt($password);
        $params['password'] = $password;
        $params['avatar'] = $avatar;

        $create = User::create($params);
        if ($create){
            $type = 'success';
            $message = 'Tạo người dùng thành công';
        }
        else{
            $type = 'error';
            $message = 'Tạo người dùng thất bại';
        }
        return back()->with($type,$message);

    }
    public function postUpdate(Request $request,$id){
        $params = $request->all();
        unset($params['_token']);
        $update = $this->update($params,$id);

        if ($update){
            $type = 'success';
            $message = 'Cập nhật thành công';
        }else{
            $type = 'error';
            $message = 'Cập nhật thất bại';
        }

        return back()->with($type,$message);
    }

    public function update($params,$id){
        $info = User::findOrFail($id);
        return $info->update($params);
    }
    public function updatePassword(UpdatePassword $request,$id){
        $info = User::findOrFail($id);
        $password = $request->get('password');
        $password = bcrypt($password);
        $info->password = $password;
        if ($info->save()){
            $type = 'success';
            $message = 'Cập nhật mật khẩu thành công';
        }
        else{
            $type = 'error';
            $message = 'Cập nhật mật khẩu thất bại';
        }
        return back()->with($type,$message);
    }
    public function updateAvatar(UpdateAvatar  $request,$id ){
        $info = User::findOrFail($id);
        $oldAvatar = $info['avatar'];
        $file = $request->file('avatar');
        $avatar = $this->uploadFile($file);
        $info->avatar = $avatar;

        if ($info->save()){
            if ($oldAvatar != null) $this->deleteFile($oldAvatar);
            $type = 'success';
            $message = 'Cập nhật avatar thành công';
        }
        else{
            $type = 'error';
            $message = 'Cập nhật avatar thất bại';
        }
        return back()->with($type,$message);

    }
    public function delete($id){
        $info = User::findOrFail($id);
        if ($info->delete()){
            Bill::where('seller_id',$id)->delete();
            $type = 'success';
            $message = 'Xóa thành công';
        }
        else{
            $type = 'error';
            $message = 'Xóa thất bại';
        }
        return back()->with($type,$message);

    }
}
