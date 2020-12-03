<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select()->paginate(PAGINATION_COUNT);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            $image = $request->file('img');
            $imageName = "cat_".$request->name_en . ".". $image->extension();
            $image->move(public_path('category'),$imageName);
            Category::create(array_merge($request->except(['_token']),['img' => "public/category/".$imageName]));
            return redirect()->route('admin.category')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.category.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        $category = Category::select()->find($id);
        if(!$category){
            return redirect()->route('admin.category')->with(['error'=>"غير موجود"]);
        }
        return view('admin.category.edit',compact('category'));
    }

    public function update($id, CategoryRequest $request)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('admin.category.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            if ($request->has('img')){
                $image = $request->file('img');
                $imageName = "cat_".$request->name_en . ".". $image->extension();
                $image->move(public_path('category'),$imageName);
//                $request->request->add(['img' => "public/category/".$imageName]);
//                array_merge($request ,['img' => "public/category/".$imageName]);
                $imgPath = "public/category/".$imageName;
            }else{
//                $request->request->add(['img' => $category->img]);
                $imgPath = $category->img;
            }

            $category->update(array_merge($request->except('_token'),['img' => $imgPath ]));

            return redirect()->route('admin.category')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {

        try {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('admin.category', $id)->with(['error' => '  غير موجوده']);
            }
            $category->delete();

            return redirect()->route('admin.category')->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
