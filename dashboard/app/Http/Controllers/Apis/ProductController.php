<?php

namespace App\Http\Controllers\Apis;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\Responses;

class ProductController extends Controller
{
    // use Responses;

    public function index(){

        return view('products.index');
    }

    public function get(){

        $products = Product::all();

        foreach($products as $product){
            $product->image = asset('images/product/'.$product->image);
        }
        // return $this->data(compact('products'));
        return response()->json(compact('products'));
    }

    public function edit($id){


        $product = Product::find($id);
        $brands = Brand::all();

        $product->image = asset('images/product/'.$product->image);
        // return $this->data(compact('product' ,'brands'));
        return response()->json(compact('product' , 'brands'));

    }

    public function create(){

        $brands = DB::table('brands')->select('id' ,'name_en')->get();
        // return $this->data(compact('brands'));
        return response()->json(compact('brands'));

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
        // return $this->success('product created');
        return response()->json('product created');


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
        // return $this->success('product updated');
        return response()->json('product updated');

    }

    public function delete($id){

        $product = Product::findOrFail($id);
        if(file_exists(public_path('images\product\\'.$product->image))){
            unlink(public_path('images\product\\'.$product->image));
        }
        $product->delete();

        // return $this->success('product deleted');
        return response()->json('product deleted');

    }
}