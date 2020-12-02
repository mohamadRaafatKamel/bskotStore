<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PromocodeRequest;
use App\Models\Category;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PoromocodeController extends Controller
{
    public function index()
    {
        $promos = PromoCode::select()->paginate(PAGINATION_COUNT);
        return view('admin.promocode.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promocode.create');
    }

    public function store(PromocodeRequest $request)
    {
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            PromoCode::create($request->except(['_token']));
            return redirect()->route('admin.promocode')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.promocode.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        $promos = PromoCode::select()->find($id);
        if(!$promos){
            return redirect()->route('admin.promocode')->with(['error'=>"غير موجود"]);
        }
        return view('admin.promocode.edit',compact('promos'));
    }

    public function update($id, PromocodeRequest $request)
    {
        try {

            $promos = PromoCode::find($id);
            if (!$promos) {
                return redirect()->route('admin.promocode.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            $promos->update($request->except('_token'));

            return redirect()->route('admin.promocode')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.promocode')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
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
