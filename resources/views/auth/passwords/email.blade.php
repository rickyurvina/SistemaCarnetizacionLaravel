@extends('layouts.app')
@section('content')
    <body class="fondo">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <div>
                    <h1 style="font: 400 25px Helvetica,Arial,sans-serif;text-align: center; color: white;"> Sistema de
                        Registro e Identificación</h1>
                </div>
                <form method="GET" action="{{route('mail')}}">
                    @csrf
                    <section class="login_content">
                        <input type="hidden" value="1" name="enviar"/>
                        <h1 style="color: white;">Resetear Contrasena</h1>
                        <div>
                            <input id="email" placeholder="Cédula"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                Solicitar Cambio de Contrasena
                            </button>
                            <a href="{{route('login')}}" class="btn btn-outline-info">Inicio</a>
                        </div>

                        <br>
                        @include('partials.session-status')
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <br/>
                            <p style="color: black;">
                                COTEDEM © {{date('Y')}}<a
                                    href="https://www.linkedin.com/in/ricardo-urvina-142222182/"> {{__('Developed by')}}
                                    : Ricardo Urvina C.</a>
                            </p>
                        </div>
                </form>
                </section>
            </div>
        </div>
    </div>
    </body>
@endsection



