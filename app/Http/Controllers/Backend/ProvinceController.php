<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(){
        $data = City::with(['wards','districts'])->orderBy('name')->get();
        $districts = District::count();
        $wards = Ward::count();
        return view('backend.province.index',compact('data','districts','wards'));
    }

    public function district(){
        $data = District::with(['wards','province'])->orderBy('name')->get();
        return view('backend.province.district',compact('data'));
    }
    public function ward(){
        $data = Ward::with(['province','district'])->orderBy('name')->get();
        return view('backend.province.ward',compact('data'));
    }
    //Sửa
    public function edit($id){
        $info = City::findOrFail($id);
        $data = District::with(['wards','province'])->where('province_id',$id)->orderBy('name')->get();
        return view('backend.province.edit',compact('info','data'));
    }
    public function districtEdit($id){
        $info = District::findOrFail($id);
        $data = Ward::with(['district','province'])->where('district_id',$id)->orderBy('name')->get();
        return view('backend.province.district_edit',compact('info','data'));
    }
    public function wardEdit($id){
        $info = Ward::findOrFail($id);
        return view('backend.province.ward_edit',compact('info'));
    }
    //Cập nhật
    public function update(Request $request,$id){

        $info = City::findOrFail($id);
        $name = $request->get('name');
        $code = $request->get('code');

        $checkNAme = City::where('name',$name)->where('id','!=',$id)->count();
        if ($checkNAme > 0){
            return back()->with('error','Tên thành phố đã tồn tại');
        }

        $checkCode = City::where('code',$code)->where('id','!=',$id)->count();
        if ($checkCode > 0){
            return back()->with('error','Mã thành phố đã tồn tại');
        }
        $info->name = $name;
        $info->code = $code;
        if ($info->save()){
            return back()->with('success','Sửa thành công');
        }else{
            return back()->with('error','Sửa thất bại');
        }
    }
    public function districtUpdate(Request $request,$id){

        $info = District::findOrFail($id);
        $province_id = $info->province_id;
        $name = $request->get('name');
        $prefix = $request->get('prefix');

        $checkNAme = District::where('name',$name)->where('id','!=',$id)->where('province_id',$province_id)->count();
        if ($checkNAme > 0){
            return back()->with('error','Tên đã tồn tại');
        }
        $info->name = $name;
        $info->prefix = $prefix;
        if ($info->save()){
            return back()->with('success','Sửa thành công');
        }else{
            return back()->with('error','Sửa thất bại');
        }
    }
    public function wardUpdate(Request $request,$id){

        $info = Ward::findOrFail($id);
        $province_id = $info->province_id;
        $district_id = $info->district_id;
        $name = $request->get('name');
        $prefix = $request->get('prefix');

        $checkNAme = Ward::where('name',$name)->where('id','!=',$id)->where('province_id',$province_id)->where('district_id',$district_id)->count();
        if ($checkNAme > 0){
            return back()->with('error','Tên đã tồn tại');
        }
        $info->name = $name;
        $info->prefix = $prefix;
        if ($info->save()){
            return back()->with('success','Sửa thành công');
        }else{
            return back()->with('error','Sửa thất bại');
        }
    }

    //Xóa
    public function delete($id){
        $info = City::findOrFail($id);
        $info->delete();
        return back()->with('success','Xóa thành công');
    }
    public function districtDelete($id){
        $info = District::findOrFail($id);
        $info->delete();
        return back()->with('success','Xóa thành công');
    }
    public function wardDelete($id){
        $info = Ward::findOrFail($id);
        $info->delete();
        return back()->with('success','Xóa thành công');
    }
    //Tạo
    public function create(Request $request){
        $create = City::create([
            'name' => $request->get('name'),
            'code' => $request->get('code')
        ]);
        if ($create){
            return back()->with('success','Tạo thành công');
        }else{
            return back()->with('error','Tạo thất bại');
        }
    }

    public function districtCreate(Request $request){
        $create = District::create([
            'name' => $request->get('name'),
            'prefix' => $request->get('prefix'),
            'province_id' => $request->get('province_id'),
        ]);
        if ($create){
            return back()->with('success','Tạo thành công');
        }else{
            return back()->with('error','Tạo thất bại');
        }
    }
    public function wardCreate(Request $request){
        $create = Ward::create([
            'name' => $request->get('name'),
            'prefix' => $request->get('prefix'),
            'province_id' => $request->get('province_id'),
            'district_id' => $request->get('district_id'),
        ]);
        if ($create){
            return back()->with('success','Tạo thành công');
        }else{
            return back()->with('error','Tạo thất bại');
        }
    }
}
