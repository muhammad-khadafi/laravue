<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Menu;
use App\Models\MenuGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email')
            + [
                'password' => \Hash::make($request->input('password')),
                'is_admin' => $request->path() === 'api/admin/register' ? 1 : 0
            ]
        );

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        if (!\Auth::attempt($request->only('email', 'password'))) {
            return response([
                'error' => 'invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = \Auth::user();

        $jwt = $user->createToken('token', ['admin'])->plainTextToken;

        $cookie = cookie('jwt', $jwt, 60 * 24); // 1 day

        $roles = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.id_user')
            ->join('roles', 'roles.id', '=', 'user_roles.id_role')
            ->where('users.id', '=', $user->id)
            ->select('roles.*')
            ->get();

        $menus = Menu::with('subMenus')
            ->join('role_menus', 'menus.id', '=', 'role_menus.id_menu')
            ->join('user_roles', 'role_menus.id_role', '=', 'user_roles.id_role')
            ->join('users', 'users.id', '=', 'user_roles.id_user')
            ->where('users.id', '=', $user->id)
            ->where('menus.id_parent', '=', null)
            ->select('menus.*')
            ->get();

        return response([
            'token' => $jwt,
            'user' => $user,
            'roles' => $roles,
            'menus' => $menus,
            'roleActive' => $roles[0]
        ])->withCookie($cookie);
    }

    public function user(Request $request)
    {
        return $request->user();

    }

    public function getMenu($role)
    {
        $listMenu = Menu::select('menus.*')->with('subMenus')->whereNull('id_parent')
            ->join('role_menus', 'menus.id', '=', 'role_menus.id_menu')
            ->join('roles', 'role_menus.id_role', '=', 'roles.id')
            ->where('roles.role_code', '=', $role)
            ->get();

        return response([
            'result' => $listMenu
        ]);
    }

    public function logout()
    {
        $cookie = \Cookie::forget('jwt');

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function updateInfo(UpdateInfoRequest $request) {

        $user = $request->user();

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);

    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();

        $user->update([
            'password' => \Hash::make($request->input('password'))
        ]);

        return response($user, Response::HTTP_ACCEPTED);
    }

}
