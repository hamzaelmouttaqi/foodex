@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    

                    {{ __('You are logged in!') }}
                    <a href="{{ route('categorie.index') }}"><p><i class="fa fa-utensils"></i>voir tous les categories</p></a>
                    <a href="{{ route('supplement.index') }}"><p><i class="fa fa-utensils"></i>voir tous les supplements</p></a>
                    <a href="{{ route('composants.index') }}"><p><i class="fa fa-utensils"></i>voir tous les composants</p></a>
                    <a href="{{ route('alimentaire.index') }}"><p><i class="fa fa-utensils"></i>voir tous les alimentaires</p></a>
                    <a href="{{ route('clients.index') }}"><p><i class="fa fa-users"></i>voir tous les clients</p></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
