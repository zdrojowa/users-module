@extends('DashboardModule::dashboard.index')

@section('content')
    <div class="content-wrapper PermissionsModule">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('DashboardModule::partials.alerts')

                        <h4 class="card-title">Dodawanie nowego użytkownika</h4>
                        <form method="POST" action="{{route('UsersModule::users.store')}}">
                            @csrf
                            <div class="form-group @error('name') has-danger @enderror">
                                <label for="">Imię i nazwisko</label>
                                <input type="text" class="form-control" name="name" placeholder="Wpisz imię" value="{{old('name')}}">

                                @error('name')
                                <small class="error mt-2 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('email') has-danger @enderror">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Wpisz email" value="{{old('email')}}">

                                @error('email')
                                <small class="error mt-2 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('permission_package_id') has-danger @enderror">
                                <label for="">Paczka uprawnień</label>
                                <select class="form-control" name="permission_package_id" id="package_select">
                                    <option value="" @if(!old('permission_package_id')) selected @endif>Wybierz paczkę uprawnień</option>
                                    @each('UsersModule::partials.package_option', $packages, 'package')
                                </select>


                                @error('permission_package_id')
                                <small class="error mt-2 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('password') has-danger @enderror">
                                <label for="">Hasło</label>
                                <input type="password" class="form-control" name="password" placeholder="Wpisz hasło" value="{{old('password')}}">

                                @error('password')
                                <small class="error mt-2 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('password_confirmation') has-danger @enderror">
                                <label for="">Potwierdź hasło</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Wpisz hasło" value="{{old('password_confirmation')}}">

                                @error('password_confirmation')
                                <small class="error mt-2 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="float-right mt-2 btn btn-primary mr-2">Zapisz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @javascript('anchors', old('anchors'))
@endsection

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{mix('vendor/css/PermissionsModule.css')}}">
@endsection

@section('javascripts')
    @parent
    <script src="{{mix('vendor/js/UsersModule.js')}}"></script>

@endsection
