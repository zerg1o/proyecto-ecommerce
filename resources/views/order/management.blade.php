@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="order-container col-md-12">
                {{-- crear orderos --}}

                <div class="col d-flex justify-content-center">

                    <div class="order-management col-md-12">
                        @include('includes.message')
                        <h1>Pedidos</h1>
                        {{-- <a class="btn btn-success" href="{{ route('order.create') }}">Agregar Pedido</a> --}}
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Coste</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>S/.{{ $order->getTotal() }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->estado}}</td>
                                        {{-- {{dd($order->products)}} --}}
                                        <td>
                                            <!-- Button trigger modal -->
                                            {{-- <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#exampleModal">
                                                Deshabilitar
                                            </button> --}}

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Deshabilitar pedido
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿estás seguro?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            {{-- <a href="{{ route('order.delete', ['order_id' => $order->id ]) }}"
                                                                class="btn btn-danger">Confirmar</a> --}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a class="btn btn-success" href="{{route('order.detail',['id'=>$order->id])}}">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 69825ba9b0b64fcac9850d8d23788fb81d39ae20
