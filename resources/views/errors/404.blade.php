@extends('identification.layouts.app')
@section('title','Error 404')
@section('content')
    <!-- page content -->
    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">404</h1>
                <h2>Disculpa no pudimos realizar tu solicitud</h2>
                <p>La página que estas buscando no existe <a href="https://cotedem.com/">Reporta esto?</a>
                </p>
                <div class="mid_center">
                    <h3>Regresar</h3>
                    <form>
                        <a href="/" class="btn btn-secondary"> Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection
