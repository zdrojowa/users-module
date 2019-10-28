@extends('DashboardModule::dashboard.index')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista wszystkich użytkowników</h4>
                        <table class="table table-striped"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascripts')
    @parent

    @javascript('packages', $packages)

    <script>
        $('.table').zdrojowaTable({
            ajax: {
                url: "{{route('UsersModule::users.ajax')}}",
                method: "POST",
                data: {
                    "_token": "{{csrf_token()}}"
                },
            },
            headers: [
                {
                    name: 'L.p',
                    type: 'index'
                },
                {
                    name: 'Imię i nazwisko',
                    type: 'text',
                    ajax: 'users.name',
                    display: 'name',
                    orderable: true,
                },
                {
                    name: 'Email',
                    orderable: true,
                    type: 'text',
                    ajax: 'email'
                },
                {
                    name: 'Paczka uprawnień',
                    type: 'select',
                    ajax: 'permission_package_id',
                    display: 'package_name',
                    select: packages
                },
                {
                    name: 'Data utworzenia',
                    orderable: true,
                    ajax: 'created_at'
                },
                {
                    name: 'Akcje',
                    type: 'actions',
                    buttons: [
                        @permission('UsersModule.users.edit')
                            {
                                color: 'primary',
                                icon: 'mdi mdi-pencil',
                                class: 'edit',
                                url: '{{route('UsersModule::users.edit', ["user" => "%%id%%"])}}'
                            },
                        @endpermission
                        @permission('UsersModule.users.delete')
                            {
                                color: 'danger',
                                icon: 'mdi mdi-delete',
                                class: 'ZdrojowaTable--remove-action',
                                url: '{{route('UsersModule::users.destroy', ["user" => "%%id%%"])}}'
                            }
                        @endpermission
                    ]
                }
            ]
        });
    </script>
@endsection
