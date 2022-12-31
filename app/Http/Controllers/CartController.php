<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factory;
//use App\Product;

class CartController extends Controller
{
    //

    public function index(){
        return view('carrito.index');
    }

    public static function getTotal(){
        $cart = session()->get('cart');
        $total = 0;
        foreach($cart as $key => $item){
            
            $total+= $item['quantity']*$item['price'];

        }
        return $total;
    }

    public function add($product_id){
        $objProduct = Factory::create('product');
        $product = $objProduct::where('condition','1')->find($product_id);


        //obtener carrito
        $cart = session()->get('cart');
        //si se encuentra vacio entonces agregamos el producto
        if(!$cart){
            $cart = [
                        [
                        'id' =>$product->id,
                        'name'=>$product->name,
                        'quantity'=>1,
                        'price'=>$product->price,
                        'image_path'=>$product->image_path
                        ]
                    ];
            session()->put('cart',$cart);
            return redirect()->back()->with(['message'=>'Producto agregado al carrito!']);
        }

        //en caso tenga productos, debemos confirmar si el producto ya existe en el carrito
        $exist = false;

        foreach($cart as $item){
            if($item['id'] == $product_id){
                $exist = true;
                $quantity = $item['quantity'];
            }
        }

        if($exist){
            return redirect()->back()->with(['message'=>'Tu carrito contiene '.$quantity.' '.$product->name]);
        }else{
            $item = [
                    'id' =>$product->id,
                    'name'=>$product->name,
                    'quantity'=>1,
                    'price'=>$product->price,
                    'image_path'=>$product->image_path
            ];
            session()->push('cart',$item);
            return redirect()->back()->with(['message'=>'Producto agregado al carrito!']);
        }


    }

    public function clear(){
        session()->forget('cart');
        return redirect()->back()->with(['message'=>'Carrito vacío']);
    }


    public function remove($product_id){
        $cart = session()->get('cart');

        foreach($cart as $key => $item){
            if($item['id'] == $product_id){

                array_splice($cart,$key,1);

            }
        }
        //session()->forget('cart');
        session()->put('cart',$cart);

        return redirect()->back()->with(['message'=>'Producto eliminado']);

    }

    public function up($product_id){
        $objProduct = Factory::create('product');
        $product = $objProduct::find($product_id);
        $cart = session()->get('cart');
        $flag = false;
        foreach($cart as $key => $item){
            if($cart[$key]['id'] == $product_id){
                /* array_splice($cart,$key,1); */
                if(($cart[$key]['quantity']+1)<=4 && (($cart[$key]['quantity']+1)<= $product->stock)){
                    $cart[$key]['quantity']++;
                }else{
                    $flag = true;
                }
                

            }

        }
        if($flag){
            $mensaje = [
                'message' => 'Solo puede añadir como máximo 4 unidades de un mismo producto en su orden '
            ];
        }else{
            $mensaje = [
                'message' => 'Producto actualizado'
            ];
        }
        

        //session()->forget('cart');
        session()->put('cart',$cart);

        return redirect()->back()->with($mensaje);

    }

    public function down($product_id){
        $cart = session()->get('cart');

        for($i=0; $i < count($cart); $i++){
            if($cart[$i]['id'] == $product_id){

                $cart[$i]['quantity']--;
                if($cart[$i]['quantity']==0){
                    array_splice($cart,$i,1);
                }
            }
        }

        /* foreach($cart as $item){
            if($item['id'] == $product_id){

                $item['quantity']--;
                if($item['quantity']==0){

                }
            }
        } */
        //session()->forget('cart');
        session()->put('cart',$cart);

        return redirect()->back()->with(['message'=>'Producto actualizado']);
    }

}
