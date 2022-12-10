<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Factory;
// use App\Product;
// use App\Category;
class ProductController extends Controller
{
    public function index(){

    }

    public function management(){
        $this->middleware('auth');

        if(\Auth::user()->role == 'admin'){
            //enviar productos
            $objProduct = Factory::create('product');
            $products = $objProduct::orderBy('id','desc')->paginate(5);
            return view('product.management',[
                'products' => $products
            ]);
        }else{
            return redirect()->route('/');
        }

    }
    public function create(){
        if(\Auth::user()->role == 'admin'){
            //enviar categorias
            $objCategory = Factory::create('category');
            $categories =  $objCategory::orderBy('id','desc')->get();
            return view('product.create',[
                'categories' => $categories
            ]);
        }else{
            return redirect()->route('/');
        }
    }

    public function save(Request $request){

        if(\Auth::user()->role == 'admin'){
            //validar datos
            $validate = $this->Validate($request,[
                'name' => 'string|required',
                'category_id' => 'integer|min:1|required',
                'price' => 'integer|min:1|required',
                'stock' => 'integer|min:1|required',
                'image_path' => 'required',
                'description' => 'string|required',

            ]);
            //recibir datos
            $name = $request->input('name');
            $description = $request->input('description');
            $category_id = $request->input('category_id');
            $image_path = $request->file('image_path');
            $price = $request->input('price');
            $stock = $request->input('stock');

            //setear datos
            
            $product = Factory::create('product');
            
            $product->name = $name;
            $product->description = $description;
            $product->category_id = $category_id;
            $product->price = $price;
            $product->stock = $stock;
            $product->condition = '1';
            if($image_path){
                //guardar imagen
                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_path_name, File::get($image_path));
                $product->image_path = $image_path_name;
            }

            $result = $product->save();
            //verificar si se insertó correctamente el producto
            if($result){
                return redirect()->route('product.management')->with(['message'=>'Producto agregado correctamente']);
            }else{
                return redirect()->route('product.management')->with(['message'=>'Fallo al agregar producto']);
            }


        }else{
            return redirect()->route('/');
        }
    }

    public function delete($product_id){
        if(\Auth::user()->role == 'admin'){
            //buscar producto
            $objProduct = Factory::create('product');
            $product = $objProduct::find($product_id);


            //si existe, cambiar condition a 0 (De baja)
            if($product != null){
                $product->condition = '0';
                $result = $product->update();

                if($result){
                    return redirect()->back()->with(['message'=>'Producto dado de baja correctamente']);
                }else{
                    return redirect()->back()->with(['message'=>'Fallo al dar de baja el producto']);
                }
            }


        }else{
            return redirect()->route('/');
        }
    }

    public function edit($product_id){
        if(\Auth::user()->role == 'admin'){
            $objProduct = Factory::create('product');
            $objCategory = Factory::create('category');
            $product = $objProduct::find($product_id);
            $categories = $objCategory::orderBy('id','desc')->get();
            if($product!=null){
                return view('product.edit',[
                    'product' => $product,
                    'categories'=> $categories
                ]);
            }else{
                return redirect()->route('/');
            }


        }else{
            return redirect()->route('/');
        }
    }

    public function getImage($filename){


            $file = Storage::disk('images')->get($filename);
            return new Response($file,200);

    }

    public function update(Request $request){
        if(\Auth::user()->role == 'admin'){
            //validar datos
            $validate = $this->Validate($request,[
                'name' => 'string|required',
                'category_id' => 'integer|min:1|required',
                'price' => 'integer|min:1|required',
                'stock' => 'integer|min:1|required',
                //'image_path' => '',
                'description' => 'string|required',
                'condition' => 'required',
            ]);
            //recibir datos
            $id = $request->input('id');
            $name = $request->input('name');
            $description = $request->input('description');
            $category_id = $request->input('category_id');
            $image_path = $request->file('image_path');
            $price = $request->input('price');
            $stock = $request->input('stock');
            $condition = $request->input('condition');
            //setear datos
            $objProduct = Factory::create('product');
            $product = $objProduct::find($id);

            $product->name = $name;
            $product->description = $description;
            $product->category_id = $category_id;
            $product->price = $price;
            $product->stock = $stock;
            $product->condition = $condition;
            if($image_path){
                //guardar imagen
                $image_path_name = time().$image_path->getClientOriginalName();
                Storage::disk('images')->put($image_path_name, File::get($image_path));
                $product->image_path = $image_path_name;
            }

            $result = $product->update();
            //verificar si se actualizó correctamente el producto
            if($result){
                return redirect()->route('product.management')->with(['message'=>'Producto actualizado correctamente']);
            }else{
                return redirect()->route('product.management')->with(['message'=>'Fallo al actualizar producto']);
            }


        }else{
            return redirect()->route('/');
        }
    }

    public function detail($product_id){
        $objProduct = Factory::create('product');
        $product = $objProduct::find($product_id);
        //$product = Product::find($product_id);
        if($product!=null){
            return view('product.detail',[
                'product'=>$product
            ]);
        }else{
            return redirect()->route('/');
        }

    }
}
