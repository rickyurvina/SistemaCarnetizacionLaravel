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
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <section class="login_content">
                        <input type="hidden" value="1" name="enviar"/>
                        <h1 style="color: white;">Control de Acceso</h1>
                        <div>
                            <input id="cedula" type="cedula" placeholder="Cédula"
                                   class="form-control @error('cedula') is-invalid @enderror" name="cedula"
                                   value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>
                            @error('cedula')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div>
                            <div>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
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


