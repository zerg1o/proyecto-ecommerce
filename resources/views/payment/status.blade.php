@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Resultado de compra') }}</div>

                    <div class="card-body">
                        <h1>Pedido realizado correctamente!!!</h1>
                        <h2>Pagar confirmar el pedido deberá realizar el pago al siguiente número de cuenta</h2>
                        <h3>191020818625678</h3>
                        <p>Una vez el pago sea realizado el pedido será enviado</p>
                        <a href="{{route('/')}}" class="btn btn-success">Seguir comprando</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
