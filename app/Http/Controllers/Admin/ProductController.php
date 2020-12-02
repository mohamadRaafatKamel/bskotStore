<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select()->paginate(PAGINATION_COUNT);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $image = $request->file('img');
            $imageName = "cat_".$request->name_en . ".". $image->extension();
            $image->move(public_path('product'),$imageName);
            Category::create(array_merge($request->except(['_token']),['img' => "category/".$imageName]));
            return redirect()->route('admin.product')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.product.create')->with(['error'=>'يوجد خطء']);
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
                $request->request->add(['img' => "category/".$imageName]);
            }else{
                $request->request->add(['img' => $category->img]);
            }

            $category->update($request->except('_token'));

            return redirect()->route('admin.category')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
