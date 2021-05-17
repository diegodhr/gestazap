@extends('Layout.Elements.plantilla')
<link rel="stylesheet" href="{{'css/custom/login.css'}}">
@section('contenido')

<div class="row align-items-center justify-content-center h-100">
    <div class="col-sm-10 col-md-8 col-lg-7 col-xl-5 col-xl-3 d-flex align-items-center" style="height: 100%">

        <div class="panel panel-default w-100 caja">
            <div class="panel-heading">
                <h1 class="panel-title">Acceso de usuarios</h1>
                <br>
            </div>
            <div class="panel-body">
                <form method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Usuario</label>
                        <input class="form-control" value="{{ old('email') }}" type="email" name="email"
                            placeholder="Email o número de empleado" id="email" autofocus>
                    </div>
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Contraseña"
                            id="password">
                    </div>
                    @error('password')
                    <small class="text-danger">{{ $message }}</small><br>
                    @enderror
                    <br><button class="btn btn-primary col-md-12 col-sm-12" type="submit">Acceder</button>
                    @error('acceso')
                    <br><small class="text-danger">{{ $message }}</small>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row h-100 justify-content-center align-items-center caja">
    <div class="col-md-8 col-md-offset-8 form-login">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h1 class="panel-title">Acceso de usuarios</h1>
                <br>
            </div>
            <div class="panel-body">
                <form method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" value="{{ old('email') }}" type="email" name="email"
placeholder="Indica email" id="email" autofocus>
</div>
@error('email')
<small class="text-danger">{{ $message }}</small>
@enderror
<br>
<div class="form-group">
    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" placeholder="Indica password" id="password">
</div>
@error('password')
<small class="text-danger">{{ $message }}</small><br>
@enderror
<br><button class="btn btn-primary col-md-12" type="submit">Acceder</button>
@error('acceso')
<br><small class="text-danger">{{ $message }}</small>
@enderror
</form>
</div>
</div>
</div>
</div> --}}

@endsection

{{-- 
    {{-- <pre>{{ Auth::user() }}</pre> --}}
{{-- <div> --}}

{{-- {!! Form::open(['url'=>'#','method'=>'put']) !!} --}}
{{-- {!! Form::open(['action' => 'App\Http\Controllers\LoginController@validar','method'=>'POST']) !!} --}}
{{-- {!! Form::open(['route' => 'Login.validar','method'=>'POST']) !!} --}}
{{-- <input type="checkbox" id="recuerda" name="remember"> &nbsp; <label for="recuerda">Recuérdame</label><br> --}}
{{--    <pre> {{ Auth::user() }} </pre>

{!! Form::open(['url' => '','method'=>'POST']) !!}
<div class="form-group">
    {!! Form::label('name','Nombre') !!}
    {!! Form::text('name',old('name'),['type'=>'text','class'=>'form-control','placeholder'=>'nombre usuario']) !!}
    {!! $errors->first('name','<small class="text-danger">:message</small>')!!}
</div>
<div class="form-group">
    {!! Form::label('email','Email address') !!}
    {!! Form::text('email',old('email'),['type'=>'text','class'=>'form-control','placeholder'=>'mete un email']) !!}
    {!! $errors->first('email','<small class="text-danger">:message</small>')!!}
</div>
<div class="form-group">
    {!! Form::label('password', 'Password') !!}
    {{-- <input type="password" class="form-control" id="password" placeholder="Password"> --}}
    {{--        {!! Form::password('password',['class'=>'form-control','placeholder'=>'mete pass']) !!}
        {!! $errors->first('password','<small class="text-danger">:message</small>') !!}
    </div>
    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}        
    {!! Form::close() !!}
</div> --}}

    {{-- <div class="form-check">
    {!! Form::checkbox('txt_check',null,false, ['class'=>'form-check-input']) !!}
    {!! Form::label('txt_check', 'Check me out', ['class'=>'form-check-label']) !!}
</div> --}}
    {{--@section('contenido')
    <div class="row">
        <div class="col"><h1>Index Login</h1></div>
        <div class="col"><h2>Index Login</h2></div>
        <div class="col"><h3>Index Login</h3></div>
    </div>
    <div class="row">
        <div class="col"><h1>DOS</h1></div>        
        <div class="col"><h3>TRE RES</h3></div>
    </div>
@endsection --}}


    {{-- @extends('Layout.layout')

@section('header_landing')
    @include('Layout.Elements.header', ['es_landing' => true])
@endsection --}}
    {{-- @section('content')
    @if(isset($idioma))
        @php(App::setLocale($idioma->codigo))
    @endif
    <div class="menu_links_js">
        {{Html::link('#Inicio', Html::icon('arrow-up' , __('Arriba')),['escape'=>false, "class" => 'landing-btn-arriba'])}}
</div>
<h1 style="display:none">{{$portal->nombre}}</h1>
<div class="cnt-first-part-home"
    id="{{($noticias_destacadas->isNotEmpty())?'cnt-first-part-home-noticias-destacadas':''}}">
    @if(!empty($imagenes_carrusel = config('settings.PORTALES.'.strtoupper($portal->nombre).'.CARRUSEL.IMAGENES')))
    <div class="owl-carousel owl-theme owl-nav-disabled carousel-cabecera-js" id="carousel-cabecera-js">
        @php($i=0)
        @php($textos_carrusel = config('settings.PORTALES.'.strtoupper($portal->nombre).'.CARRUSEL.TEXTOS'))
        @php($subtextos_carrusel = config('settings.PORTALES.'.strtoupper($portal->nombre).'.CARRUSEL.SUBTEXTOS'))
        @php($links_carrusel = config('settings.PORTALES.'.strtoupper($portal->nombre).'.CARRUSEL.LINKS'))
        @foreach($imagenes_carrusel as $key => $imagen_carrusel)
        @if(isset($links_carrusel) && isset($links_carrusel[$i]))
        <a href="{{'https://'.$portal->url.$links_carrusel[$i]}}" class="link_carrusel">
            @endif
            <div class="item">
                {{Html::image(asset_cache($imagen_carrusel), 'carrusel_'.$key, ['class' => 'img_carrusel_inicio'])}}
                @if(!empty($textos_carrusel))
                @php($i>=count($textos_carrusel)?$i=0:'')
                <div class="frase-home">
                    {{$textos_carrusel[$i]}}
                    @if(isset($subtextos_carrusel) && isset($subtextos_carrusel[$i]))
                    <div class="subfrase-home">
                        {{$subtextos_carrusel[$i]}}
                    </div>
                    @endif
                </div>
                @endif
            </div>
            @if(isset($links_carrusel) && isset($links_carrusel[$i]))
        </a>
        @endif
        @php($i++)
        @endforeach
    </div>
    @endif
    <div class="grid-container">
        <div class="session_msg_index">
            @include('Elements.sesion_mensajes')
        </div>
        @if($portal->seccion_top && !$portal->seccion_gpromo)
        @if(!is_null(config('settings.PORTALES.'.strtoupper($portal->nombre).'.NOTICIAS_DESTACADAS')) &&
        config('settings.PORTALES.'.strtoupper($portal->nombre).'.NOTICIAS_DESTACADAS'))
        @if($noticias_destacadas->isNotEmpty())
        @include('Dashboard.Elements.noticias_destacadas')
        @endif
        @endif
        @include('Dashboard.Elements.seccion_top')
        @endif
        @if($portal->seccion_cliente_corporativo)
        @include('Dashboard.Elements.campanas')
        @endif
        @if($portal->seccion_flotas)
        @include('Dashboard.Elements.flotas')
        @endif
        @if($portal->seccion_compromisos)
        @include('Dashboard.Elements.compromisos')
        @endif
    </div>
    @if($portal->seccion_advisor)
    @if($portal->seccion_advisor_landing)
    @include('Dashboard.Elements.advisor')
    @endif
    @endif
    <div class="cnt-grey-home">
        @if($portal->seccion_noticias && !$portal->seccion_gpromo)
        @include('Dashboard.Elements.noticias')
        @endif
    </div>
    @if($portal->seccion_social_magazine)
    @include('Dashboard.Elements.social_magazine')
    @endif
    <div class="cnt-grey-home">
        @if($portal->seccion_quien_somos)
        @include('Dashboard.Elements.quesomos')
        @endif
        @if($portal->seccion_donde_estamos)
        @include('Dashboard.Elements.donde_estamos')
        @endif
    </div>
</div>
@if($portal->seccion_autogest)
@include('Dashboard.Elements.autogest')
@endif
@if($portal->seccion_gsmart)
@include('Dashboard.Elements.gsmart')
@endif

@if($portal->seccion_web_flotas)
@include('Dashboard.Elements.web_flotas')
@endif

@if($portal->seccion_portal_advisor)
@include('Dashboard.Elements.portal_advisor')
@endif

@if($portal->seccion_banner && !empty($banners))
@include('Dashboard.Elements.banner')
@endif

@if($portal->seccion_gpromo)
@include('Dashboard.Elements.gpromo')
@endif
@endsection --}}

{{-- @section('scripts')
    @parent
    <script type="text/javascript" src="{!! asset_cache('js/dashboard.js') !!}"></script>
@endsection --}}