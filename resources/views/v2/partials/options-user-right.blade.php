@if(!isset($user))
        <!--Invitado-->
<section id="login">
    <div class="panel panel-default">
        <div class="panel-heading"><b>Inicio de sesión</b></div>
        <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Hay problemas con los datos ingresados<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form role="form" method="POST" action="{{ url('/auth/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-12 control-label">{{ trans('validation.attributes.email') }}</label>
                    <div class="col-md-12">
                        <input type="email" class="form-control" name="email"
                               value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12 control-label">{{ trans('validation.attributes.password') }}</label>
                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       name="remember"> {{ trans('validation.attributes.remember') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <a class="btn btn-link"
                               href="{{ url('/password/email') }}">{{ trans('validation.attributes.forgot-password') }}</a>
                            <a class="btn btn-link" href="{{ url('/unirme') }}">Crear una
                                cuenta</a>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>

</section>
@elseif($user['tipo'] == 'user')
        <!--User-->
<a href="/user/upload-activity" class="list-group-item"><strong><i class="fa fa-plus-square"></i> Cargar Actividad</strong></a>
<a href="/user/my-publications" class="list-group-item"><strong><i class="fa fa-dot-circle-o"></i> Mis publicaciones</strong></a>

@elseif($user['tipo'] == 'admin')
        <!--Admin-->
<div class="list-group">
    <a href="/user/upload-activity" class="list-group-item"><strong><i class="fa fa-plus-square"></i> Cargar Actividad</strong></a>
    <a href="/admin/reports" class="list-group-item"><strong><i class="fa fa-dot-circle-o"></i> Ver reportes</strong></a>
    <a href="/user/my-publications" class="list-group-item"><strong><i class="fa fa-dot-circle-o"></i> Mis publicaciones</strong></a>
</div>

@endif



