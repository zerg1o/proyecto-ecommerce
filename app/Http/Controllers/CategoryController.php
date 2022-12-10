<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factory;
//use App\Category;
class CategoryController extends Controller
{
    //

    public function index(){
        $this->middleware('auth');
        $user = \Auth::user();
        if($user && $user->role=='admin'){
            $objCategory = Factory::create('category');
            $categories = $objCategory::orderBy('id','desc')->paginate(5);
            return view('category.index',['categories' => $categories]);
        }else{
            return redirect()-route('/');
        }

    }

    public function create(){
        $this->middleware('auth');
        $user = \Auth::user();
        if($user && $user->role=='admin'){

            return view('category.create');

        }else{
            return redirect()-route('/');
        }

    }

    public function save(Request $request){
        $this->middleware('auth');
        $user = \Auth::user();
        $validate = $this->Validate($request,[
            'name' => 'required|string'
        ]);

        if($user && $user->role=='admin'){

            $category = Factory::create('category');
            $name = $request->input('name');
            $category->name = $name;
            $category->condition = '1';

            $save = $category->save();

            if($save){
                $message = 'Categoria Creada Correctamente';
            }else{
                $message = 'Fallo al crear Categoria';
            }

            return redirect()->route('category.index')->with(['message'=> $message]);

        }else{
            return redirect()-route('/');
        }
    }

    public function delete($category_id){
        if(\Auth::user()->role == 'admin'){
            //buscar categoria
            $objCategory = Factory::create('category');
            $category = $objCategory::find($category_id);


            //si existe, cambiar condition a 0 (De baja)
            if($category != null){
                $category->condition = '0';
                $result = $category->update();

                if($result){
                    return redirect()->back()->with(['message'=>'Categoria deshabilitada correctamente']);
                }else{
                    return redirect()->back()->with(['message'=>'Fallo al deshabilitar categoria']);
                }
            }else{
                return redirect()->back();
            }


        }else{
            return redirect()->route('/');
        }
    }

    public function edit($category_id){
        if(\Auth::user()->role == 'admin'){
            $objCategory = Factory::create('category');
            $category = $objCategory::find($category_id);
            if($category!=null){
                return view('category.edit',[
                    'category' => $category
                ]);
            }else{
                return redirect()->route('/');
            }


        }else{
            return redirect()->route('/');
        }
    }


    public function update(Request $request){
        if(\Auth::user()->role == 'admin'){
            //validar datos
            $validate = $this->Validate($request,[
                'name' => 'string|required',
                'condition' => 'required',
            ]);
            //recibir datos
            $id = $request->input('id');
            $name = $request->input('name');
            $condition = $request->input('condition');
            //setear datos
            $objCategory = Factory::create('category');
            $category = $objCategory::find($id);

            $category->name = $name;
            $category->condition = $condition;
            $result = $category->update();
            //verificar si se actualizó correctamente el producto
            if($result){
                return redirect()->route('category.index')->with(['message'=>'Categoria actualizado correctamente']);
            }else{
                return redirect()->route('category.index')->with(['message'=>'Fallo al actualizar Categoria']);
            }


        }else{
            return redirect()->route('/');
        }
    }

}
