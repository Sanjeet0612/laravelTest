<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{   
   
    
    
    
    public function products(Request $request){
        if($request->isMethod('post')){

        }else{
            $products = Product::with(['images'])->get();
            //print_r($products);
            return view('admin.product.manage_product', compact('products'));
        }
    }

    

    public function add_products(Request $request){
        if($request->isMethod('post')){

        //print_r($_POST); 
        //print_r($attributes = $request->input('attributes', [])); 
        //die();

            $request->validate([
                'name' => 'required',
                'regular_price' => 'required|numeric',
                'sale_price' => 'required|numeric',
            ]);

            $product = new Product();

            $product->name = $request->name;
            $product->slug = Str::slug($request->name) . '-' . time();
            $product->short_description = $request->short_desc;
            $product->description = $request->description;
            $product->regular_price = $request->regular_price;
            $product->sale_price = $request->sale_price;
            $product->status = $request->status;
            $product->save();

            /*
            =========================================
            PRODUCT MAIN IMAGE
            =========================================
            */

            if($request->hasFile('main_image')) {
                $path = $request->file('main_image')->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,   // full path save karo
                    'is_primary' => 1
                ]);
            }

            /*
            =========================================
            PRODUCT GALLERY IMAGES
            =========================================
            */
            if($request->hasFile('gallery_images')) {
                foreach($request->file('gallery_images') as $image) {
                    // Storage folder: storage/app/public/products
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,   // full path save karo
                        'is_primary' => 0
                    ]);
                }
            }
            /*
            =========================================
            PRODUCT ATTRIBUTES SAVE
            =========================================
            */
            
            //print_r($_POST); die();
           return redirect('admin/products')->with('success','Product Added Successfully');

        }else{
            
            return view('admin.product.add_product_form');
        }
    }
    
    public function product_edit($id){
        $product = Product::with(['images'])->findOrFail($id);
        return view('admin.product.product_edit_form', compact('product'));
    }

    public function update_product(Request $request,$id){
        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required',
                'regular_price' => 'required|numeric',
                
            ]);

            $product = Product::findOrFail($id);
            $product->name = $request->name;
            // Slug only change if name changed
            if($product->isDirty('name')){
                $product->slug = Str::slug($request->name) . '-' . time();
            }
            $product->short_description = $request->short_desc;
            $product->description = $request->description;
            $product->regular_price = $request->regular_price;
            $product->sale_price = $request->sale_price;
            $product->status = $request->status;
            $product->save();
            /*
            =========================================
            PRODUCT MAIN IMAGE UPDATE
            =========================================
            */

            if($request->hasFile('main_image')) {
                // Old main image delete
                $oldMain = ProductImage::where('product_id', $product->id)->where('is_primary',1)->first();

                if($oldMain){
                    \Storage::disk('public')->delete($oldMain->image);
                    $oldMain->delete();
                }

                $path = $request->file('main_image')->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_primary' => 1
                ]);
            }
            if($request->hasFile('gallery_images')) {
                foreach($request->file('gallery_images') as $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,
                        'is_primary' => 0
                    ]);
                }
            }
            
            return back()->with('success','Product Updated Successfully');
        }
    }
	
    public function product_delete($id){
        $product = Product::findOrFail($id);
        $images = ProductImage::where('product_id', $product->id)->get();
        foreach($images as $image){
            // Storage se delete
            if(\Storage::disk('public')->exists($image->image)){
                \Storage::disk('public')->delete($image->image);
            }
            // DB record delete
            $image->delete();
        }
        
        $product->delete();
        return back()->with('success','Product Deleted Successfully');
    }
    public function product_deleteImage($id){
        $image = ProductImage::findOrFail($id);
        // Storage se delete
        \Storage::disk('public')->delete($image->image);
        // DB se delete
        $image->delete();
        return back()->with('success','Image Deleted Successfully');
    }
}