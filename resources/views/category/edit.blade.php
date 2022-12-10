@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Categoria') }}</div>

                    <div class="card-body">
                        <form class="form-edit-category" method="POST" action="{{ route('category.update') }}" aria-label="{{ __('Editar Categoria') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$category->id}}"/>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $category->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            {{-- estado --}}
                            <div class="form-group row">
                                <label for="condition" class="col-md-4 col-form-label text-md-right">Estado</label>

                                <div class="col-md-6">
                                    <select id="condition" class="form-control{{ $errors->has('condition') ? ' is-invalid' : '' }}" name="condition" required>

                                        <option value="1" {{ $category->condition == 1 ? 'selected="selected"':'' }}>Activo</option>
                                        <option value="0" {{ $category->condition == 0 ? 'selected="selected"':'' }}>Inactivo</option>

                                    </select>

                                    @if ($errors->has('condition'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('condition') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <a class="btn btn-danger" href="{{ route('category.index') }}">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
