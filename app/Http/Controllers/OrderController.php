<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factory;

class OrderController extends Controller
{
    //

    public function index(){
        return View('order.index');
    }

    public function save(Request $request){
        $user = \Auth::user();
        $validate = $this->Validate($request,[
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'address' => 'required|string',
            'reference' => 'required|string',
            'province' => 'required|string',
            'region' => 'required|string',
            'district' => 'required|string',
            'cell_phone' => 'required|string'
            
        ]);

        $order = Factory::create('order');
        $order->user_id = $user->id;
        $order->shipping_id=3;
        $order->address=$request->input('address');
        $order->reference=$request->input('reference');
        $order->province=$request->input('province');
        $order->region=$request->input('region');
        $order->district=$request->input('district');
        $order->cell_phone=$request->input('cell_phone');
        $order->country='Peru';
        $order->estado='Procesado';
        $save = $order->save();
        // $order_product = Factory::create('order_product');
        if($save){
            $order_id = $order->id;

            $cart = session()->get('cart');
           
            foreach($cart as $key => $item){
                $order_product = Factory::create('order_product');
                $order_product->order_id = $order_id;
                $order_product->product_id = $item['id'];
                $order_product->units = $item['quantity'];
                $order_product->subtotal = $item['quantity']*$item['price'];
                $order_product->save();

            }

            return redirect()->route('payment.status');
           
        }else{
            return redirect()->back()->with(['message'=>'Error al registrar pedido']);
        }
        
    }

    public function management(){
        $user = \Auth::user();

        if($user->role= 'Admin'){

            $order = Factory::create('order');
            $orders = $order::orderBy('id','desc')->paginate(5);
            // dd($orders);
            return View('order.management',['orders'=>$orders]);

        }else{
            return redirect()->route('/');
        }
    }

    public function detail($id){
        $user = \Auth::user();

        if($user->role= 'Admin'){

            $order = Factory::create('order');
            $order_ = $order::find($id);
            // dd($orders);
            return View('order.detail',['order'=>$order_]);

        }else{
            return redirect()->route('/');
        }
    }

    public function update(Request $request){
        $user = \Auth::user();

        if($user->role= 'Admin'){

            $validate = $this->Validate($request,[
                'estado' => 'required|string'
                
            ]);

            $estado = $request->input('estado');
            $order_id = $request->input('order_id');
            $order = Factory::create('order');

            $my_order = $order::find($order_id);
            $my_order->estado = $estado;
            $my_order->update();
    
            return redirect()->back()->with(['message'=>'Estado de pedido actualizado con éxito']);

        }else{
            return redirect()->route('/');
        }
    }
}
