<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmarhRequest;
use App\Models\Emarh;
use Illuminate\Http\Request;

class EmarhController extends Controller
{
    public function index()
    {
        $emarhs = Emarh::select()->paginate(PAGINATION_COUNT);
        return view('admin.emarh.index', compact('emarhs'));
    }

    public function create()
    {
        return view('admin.emarh.create');
    }

    public function store(EmarhRequest $request)
    {
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            Emarh::create($request->except(['_token']));
            return redirect()->route('admin.emarh')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.emarh.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        $emarhs = Emarh::select()->find($id);
        if(!$emarhs){
            return redirect()->route('admin.emarh')->with(['error'=>"غير موجود"]);
        }
        return view('admin.emarh.edit',compact('emarhs'));
    }

    public function update($id, EmarhRequest $request)
    {
        try {

            $promos = Emarh::find($id);
            if (!$promos) {
                return redirect()->route('admin.emarh.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            $promos->update($request->except('_token'));

            return redirect()->route('admin.emarh')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.emarh')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

//    public function destroy($id)
//    {
//
//        try {
//            $promos = PromoCode::find($id);
//            if (!$promos) {
//                return redirect()->route('admin.promocode', $id)->with(['error' => '  غير موجوده']);
//            }
//            $promos->delete();
//
//            return redirect()->route('admin.promocode')->with(['success' => 'تم حذف  بنجاح']);
//
//        } catch (\Exception $ex) {
//            return redirect()->route('admin.promocode')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
//        }
//    }
}
