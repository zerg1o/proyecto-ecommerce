@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="product-container col-md-12">
                {{-- productos --}}

                    <div class="product-detail col-sm-4">


                            <div class="product-img-card">
                                <img src="{{ route('product.image', ['filename' => $product->image_path]) }}" alt="">
                            </div>


                    </div>



            </div>
        </div>
        {{-- detalles del producto --}}
        <div class="col-md-5 col-sm-3">

            <div class="detail-product col">
                <div class="product-name">
                    <h1><strong>{{ $product->name }}</strong></h1>
                </div>
                <hr>
                <div class="product-description">
                    <h5>{{ $product->description }}</h5>
                </div>
                <div class="product-price">
                    <h5>S/{{ $product->price }}</h5>
                </div>
                <hr>
                <div class="actions">
                    <a class="btn btn-primary" href="{{route('cart.add',['product_id'=>$product->id])}}"><strong>Agregar al carrito</strong></a>
                    <a class="btn btn-danger" href=""><strong>Comprar Ahora</strong></a>
                </div>
            </div>
            @include('includes.message')
        </div>
    </div>
</div>
@endsection
