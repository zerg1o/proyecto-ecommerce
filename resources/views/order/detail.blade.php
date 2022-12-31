@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h1><strong>Pedido #{{ $order->id }}</strong> </h1>
                <h2><strong>Detalle de pedido</strong> </h2>
            </div>

            <div class="product-container col-md-12">

                {{-- crear productos --}}
                @if ($order != null)
                    <div class="col d-flex justify-content-center">

                        <div class="product-management col-md-7">


                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th scope="col">Nombre producto</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Unidades</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $order_id = $order->id; ?>

                                    @foreach ($order->products as $item)
                                        <tr>

                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->getUnitsByProduct($order_id) }}</td>
                                    @endforeach


                                </tbody>
                            </table>

                            {{-- <h1>Total a pagar: S/{{ $total }}</h1> --}}





                        </div>
                        <div class="product-management col-md-5 ">
                            <h2 style="text-align: center"><strong>Resumen de pedido</strong> </h2>
                            <hr>
                            <div class="form group row d-flex justify-content-center">
                                <div class="col col-md-4">
                                    <p><strong>Direccion</strong> </p>
                                </div>
                                <div class="col col-md-4">
                                    <p>{{$order->address}}</p>
                                </div>

                            </div>
                            <hr>
                            <div class="form group row d-flex justify-content-center">
                                <div class="col col-md-4">
                                    <p><strong>Coste</strong> </p>
                                </div>
                                <div class="col col-md-4">
                                    <p>{{$order->getTotal()}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form group row d-flex justify-content-center">
                                <div class="col col-md-4">
                                    <p><strong>Estado</strong> </p>
                                </div>
                                <div class="col col-md-4">
                                    <p>{{$order->estado}}</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <hr>








            </div>
            <div class="col-md-12">
                <h1>Actualizar estado del Pedido</h1>
                @include('includes.message')
                <form action="{{route('order.update')}}" method="POST" class="form-control border-0 col-md-4">
                    @csrf
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control mb-3">

                        <option value="procesado" {{$order->estado=='confirmado'?'selected="selected"':''}}>PROCESADO</option>
                        <option value="pagado" {{$order->estado=='pagado'?'selected="selected"':''}}>PAGADO</option>
                        <option value="enviado" {{$order->estado=='enviado'?'selected="selected"':''}}>ENVIADO</option>
                        <option value="entregado" {{$order->estado=='entregado'?'selected="selected"':''}}>ENTREGADO</option>
                    </select>
                    <input type="submit" class="btn btn-warning" value="Actualizar">
                </form>
            </div>

            @else
            <h2>Pedido no encontrado, comuniquese con desarrollo</h2>
            <a class="btn btn-success" href="{{ route('/') }}"><strong>Ir al inicio</strong></a>
        @endif
        </div>
    </div>
@endsection
