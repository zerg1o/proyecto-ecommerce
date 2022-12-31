@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="product-container col-md-12">
                {{-- crear productos --}}

                <div class="col d-flex justify-content-center">

                    <div class="product-management col-md-12">
                        @include('includes.message')
                        <h1>Carrito</h1>

                        @if(session('cart')!=null)
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Unidades</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; ?>

                                    @foreach (session('cart') as $item)
                                        <tr>

                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['price'] }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{route('cart.down',['producto_id'=>$item['id']])}}"><strong>-</strong></a>
                                                {{ $item['quantity'] }}
                                                <a class="btn btn-sm btn-primary" href="{{route('cart.up',['producto_id'=>$item['id']])}}"><strong>+</strong></a>
                                            </td>
                                            <td>{{ $item['price'] * $item['quantity'] }}</td>
                                            <?php $total +=  $item['price'] * $item['quantity']; ?>
                                            <td>
                                                <a class="btn btn-warning" href="{{ route('cart.remove',['producto_id'=>$item['id']]) }}">Quitar</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            <h1>Total a pagar: S/{{ $total }}</h1>


                            <a class="btn btn-danger" href="{{route('cart.clear')}}">Vaciar Carrito</a>

                            <a class="btn btn-danger" href="{{route('order.index')}}">Continuar con pedido</a>
                        @else
                            <h2>Carrito Vacío</h2>
                            <a class="btn btn-success" href="{{route('/')}}"><strong>Seguir buscando productos</strong></a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
