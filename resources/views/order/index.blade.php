@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Direccion de envio') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('order.save') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text"
                                        class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre"
                                        value="{{ old('nombre') }}" required autofocus>

                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellidos"
                                    class="col-md-4 col-form-label text-md-right">{{ __('apellidos') }}</label>

                                <div class="col-md-6">
                                    <input id="apellidos" type="text"
                                        class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}"
                                        name="apellidos" value="{{ old('apellidos') }}" required autofocus>

                                    @if ($errors->has('apellidos'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('apellidos') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- direccion --}}
                            <div class="form-group row">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                        name="address" value="{{ old('address') }}" required>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- referencia --}}
                            <div class="form-group row">
                                <label for="reference"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Referencia') }}</label>

                                <div class="col-md-6">
                                    <input id="reference" type="text"
                                        class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}"
                                        name="reference" value="{{ old('reference') }}" required>

                                    @if ($errors->has('reference'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reference') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- provincia --}}
                            <div class="form-group row">
                                <label for="province"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>

                                <div class="col-md-6">
                                    <input id="province" type="text"
                                        class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}"
                                        name="province" value="{{ old('province') }}" required>

                                    @if ($errors->has('province'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('province') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- region --}}
                            <div class="form-group row">
                                <label for="region"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Region') }}</label>

                                <div class="col-md-6">
                                    <input id="region" type="text"
                                        class="form-control{{ $errors->has('region') ? ' is-invalid' : '' }}"
                                        name="region" value="{{ old('region') }}" required>

                                    @if ($errors->has('region'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('region') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- distrito --}}
                            <div class="form-group row">
                                <label for="district"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Distrito') }}</label>

                                <div class="col-md-6">
                                    <input id="district" type="text"
                                        class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}"
                                        name="district" value="{{ old('district') }}" required>

                                    @if ($errors->has('district'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- celular --}}
                            <div class="form-group row">
                                <label for="cell_phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                                <div class="col-md-6">
                                    <input id="cell_phone" type="number"
                                        class="form-control{{ $errors->has('cell_phone') ? ' is-invalid' : '' }}"
                                        name="cell_phone" value="{{ old('cell_phone') }}" required>

                                    @if ($errors->has('cell_phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cell_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            {{-- pagos --}}
                            <div class="form-group row">
                                <label for="pagos"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Pagos') }}</label>

                                <div class="col-md-2">
                                    <a href="{{route('payment.paypal')}}">PayPal</a>

                                </div>
                                <div class="col-md-2 col-form-label text-md-center">
                                    <input type="radio" name="tipo_pago" value="transaccion" required>
                                    <label for="tipo_pago" class="">Transaccion bancaria</label>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Procesar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
