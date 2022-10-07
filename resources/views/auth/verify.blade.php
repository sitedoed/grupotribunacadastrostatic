@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Por favor, cheque a sua caixa-postal.') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __(' Enviamos um e-mail de confirmação para completar o seu cadastro.') }}
                        </div>
                    @endif

                    {{ __('Antes de prosseguir, clique no link que enviamos para: ') }}

                    <strong>{{ Auth::user()->email }}</strong>.

                    {{ __('Caso, necessite,') }} <a href="{{ route('verification.resend') }}">{{ __('click aqui e enviaremos outro') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
