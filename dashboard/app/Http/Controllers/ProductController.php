<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){

        return view('products.index');
    }

    public function get(){

        $products = Product::all();
        return view('products.index' , ['products' => $products]);
    }

    public function edit($id){


        $product = Product::find($id);
        $brands = Brand::all();
        return view('products.edit' , compact('product', 'brands'));
    }
    public function create(){

        $brands = DB::table('brands')->select('id' ,'name_en')->get();
        return view('products.create' , compact('brands'));
    }

    public function store(Request $request){

        $request->validate([
            'name_en'=> ['required' ,'string' ,'between:3,255'],
            'name_ar'=> ['required' , 'string' ,'between:3,255'],
            'price'=> ['required', 'numeric'],
            'quantity'=> ['nullable', 'integer'],
            'status'=> ['required' , 'in:1,0'],
            'brand_id'=> ['required' ,"integer" , "exists:brands,id"],
            'details_en'=> ['required' , 'string' ],
            'details_ar'=> ['required' , 'string' ],
            'image'=> ['required' ,'mimes:png,jpg,jpeg']
        ]);

        $imageName = $request->file('image')->hashName();
        $request->file('image')->move(public_path('images\product'),$imageName);

        $data = $request->except('_token' , 'image');

        $data['image'] = $imageName;
        Product::create($data);

        return redirect('dashboard/products');
    }

    public function update(Request $request , $id){

        $request->validate([
            'name_en'=> ['required' ,'string' ,'between:3,255'],
            'name_ar'=> ['required' , 'string' ,'between:3,255'],
            'price'=> ['required', 'numeric'],
            'quantity'=> ['nullable', 'integer'],
            'status'=> ['required' , 'in:1,0'],
            'brand_id'=> ['required' ,"integer" , "exists:brands,id"],
            'details_en'=> ['required' , 'string' ],
            'details_ar'=> ['required' , 'string' ],
            'image'=> ['required' ,'mimes:png,jpg,jpeg']
        ]);

        $product = Product::findOrFail($id);

        $data = $request->except('_token' , '_method' , 'image');
        if($request->hasFile('image')){
            $imageName = $request->file('image')->hashName();
            $request->file('image')->move(public_path('images\product') , $imageName);

            if(file_exists(public_path('images\product\\'.$product->image))){
                unlink(public_path('images\product\\'.$product->image));
            }
        }

        $data['image'] = $imageName;
        $product->update($data);
        return redirect('dashboard/products');
    }

    public function delete($id){

        $product = Product::findOrFail($id);
        if(file_exists(public_path('images\product\\'.$product->image))){
            unlink(public_path('images\product\\'.$product->image));
        }
        $product->delete();

        return redirect('dashboard/products');
    }
}