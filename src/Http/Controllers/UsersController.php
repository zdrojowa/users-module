<?php

namespace Selene\Modules\UsersModule\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Selene\Models\PermissionPackage;
use Selene\Modules\DashboardModule\ZdrojowaTable;
use Selene\Modules\UsersModule\Http\Requests\UserStoreRequest;
use Selene\Modules\UsersModule\Http\Requests\UserUpdateRequest;
use Selene\Support\Facades\Core;

class UsersController extends Controller
{
    public function index()
    {
        $packages = ZdrojowaTable::select(PermissionPackage::class, 'id', 'name');

        return view('UsersModule::list', ['packages' => $packages]);
    }

    public function ajax(Request $request)
    {
        $query = User::leftJoin('permission_packages', 'users.permission_package_id', 'permission_packages.id')->select('users.*', 'permission_packages.name as package_name')->where('admin', 0);

        return ZdrojowaTable::response($query, $request, true);
    }

    public function create() {
        return view('UsersModule::add', ['packages' => PermissionPackage::get(['id', 'name'])]);
    }

    public function store(UserStoreRequest $request) {
        User::create($request->all());

        $request->session()->flash('alert-success', 'Użytkownik został pomyślnie utworzony');

        return redirect()->route('UsersModule::users.create');
    }

    public function edit(User $user)
    {
        return view('UsersModule::edit', ['user' => $user, 'packages' => PermissionPackage::get(['id', 'name'])]);
    }

    public function update(UserUpdateRequest $request, User $user) {
        if($request->input('password') === null) {
            $request->request->remove('password');
        }

        $user->update($request->all());

        $request->session()->flash('alert-success', 'Użytkownik został zaktualizowany');

        return redirect()->route('UsersModule::users.edit', ['user' => $user]);
    }
}
