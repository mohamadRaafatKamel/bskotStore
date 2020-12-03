<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
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
        $categories = Category::select()->active()->get();
        return view('admin.product.create',compact('categories'));
    }

    public function store(ProductRequest $request)
    {
//        try {
            $image = $request->file('img');
            $imageName = "prod_".$request->name_en . ".". $image->extension();
            $image->move(public_path('product'),$imageName);
            Product::create(array_merge($request->except(['_token']),['img' => "public/product/".$imageName]));
            return redirect()->route('admin.product')->with(['success'=>'تم الحفظ']);
//        }catch (\Exception $ex){
//            return redirect()->route('admin.product.create')->with(['error'=>'يوجد خطء']);
//        }
    }

    public function edit($id)
    {
        $categories = Category::select()->active()->get();
        $product = Product::select()->find($id);
        if(!$product){
            return redirect()->route('admin.product')->with(['error'=>"غير موجود"]);
        }
        return view('admin.product.edit',compact('product','categories'));
    }

    public function update($id, ProductRequest $request)
    {
        try {

            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('admin.product.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            if ($request->has('img')){
                $image = $request->file('img');
                $imageName = "prod_".$request->name_en . ".". $image->extension();
                $image->move(public_path('product'),$imageName);
                $request->request->add(['img' => "public/product/".$imageName]);
            }else{
                $request->request->add(['img' => $product->img]);
            }

            $product->update($request->except('_token'));

            return redirect()->route('admin.product')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.product')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
