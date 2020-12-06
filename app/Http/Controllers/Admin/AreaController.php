<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\Emarh;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::select()->paginate(PAGINATION_COUNT);
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        $emarhs = Emarh::select()->active()->get();
        return view('admin.area.create',compact('emarhs'));
    }

    public function store(AreaRequest $request)
    {
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            Area::create($request->except(['_token']));
            return redirect()->route('admin.area')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.area.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        $emarhs = Emarh::select()->active()->get();
        $areas = Area::select()->find($id);
        if(!$areas){
            return redirect()->route('admin.area')->with(['error'=>"غير موجود"]);
        }
        return view('admin.area.edit',compact('areas','emarhs'));
    }

    public function update($id, AreaRequest $request)
    {
        try {

            $areas = Area::find($id);
            if (!$areas) {
                return redirect()->route('admin.area.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            $areas->update($request->except('_token'));

            return redirect()->route('admin.area')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.area')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
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
