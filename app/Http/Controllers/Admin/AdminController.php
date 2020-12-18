<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmarhRequest;
use App\Models\Admin;
use App\Models\Emarh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::select()->paginate(PAGINATION_COUNT);
        return view('admin.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        try {
            $pass = Hash::make($request->password);
            unset($request->password);
            Admin::create(array_merge($request->except(['_token']),['password'=>$pass]));
            return redirect()->route('admin.admin')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.admin.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        $admins = Admin::select()->find($id);
        if(!$admins){
            return redirect()->route('admin.admin')->with(['error'=>"غير موجود"]);
        }
        return view('admin.admin.edit',compact('admins'));
    }

    public function update($id, Request $request)
    {
        try {

            $admins = Admin::find($id);
            if (!$admins) {
                return redirect()->route('admin.admin.edit', $id)->with(['error' => '  غير موجوده']);
            }
            $pass = Hash::make($request->password);
            unset($request->password);
            $admins->update(array_merge($request->except(['_token']),['password'=>$pass]));

            return redirect()->route('admin.admin')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.admin')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {

        try {
            $admins = Admin::find($id);
            if (!$admins) {
                return redirect()->route('admin.admin', $id)->with(['error' => '  غير موجوده']);
            }
            $admins->delete();

            return redirect()->route('admin.admin')->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.admin')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
