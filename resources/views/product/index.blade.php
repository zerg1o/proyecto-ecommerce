@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="product-container col-md-12">
                {{-- productos --}}
                @foreach ($products as $product)
                    <div class="product">
                        {{-- enlace a detalle del producto --}}
                        <a href="{{ route('product.detail',['product_id' => $product->id]) }}">
                            <div class="product-img-card">
                                <img src="{{ route('product.image', ['filename' => $product->image_path]) }}" alt="">
                            </div>

                            <div class="product-info-card">
                                <div class="product-card-name">
                                    <h5><strong>{{ $product->name }}</strong></h1>
                                </div>
                                <div class="product-card-price">
                                    <p>S/{{ $product->price }}</p>
                                </div>

                            </div>
                        </a>
                        <div class="btn btn-danger btn-see-product" ><a href="{{ route('product.detail',['product_id' => $product->id]) }}"><strong>Ver Producto</strong></a></div>

                    </div>
                @endforeach


            </div>
            {{ $products->links() }}
        </div>
    </div>
@endsection
