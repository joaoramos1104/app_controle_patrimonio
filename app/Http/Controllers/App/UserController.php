<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\QueryException;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('admin.user', compact('users'));
    }


    // public function create()
    // {
    //     //
    // }

    protected function create(Request $data)
    {
        $this->validate($data,
            [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required','string'],
            'photo_perfil' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ],
        );

        $user = new User();
            if ($data->input('admin_user') == 'on'){
                $data['admin_user'] = 1;
            } else {
                $data['admin_user'] = 0;
            }

            if ($data->input('padrao_user') == 'on'){
                $data['padrao_user'] = 1;
            }  else {
                $data['padrao_user'] = 0;
            }

            if ($data->input('tech_user') == 'on'){
                $data['tech_user'] = 1;
            }  else {
                $data['tech_user'] = 0;
            }

            $user->name = $data->input('name');
            $user->email = $data->input('email');
            $user->phone = strtoupper($data->input('phone'));
            $user->active = $data->input('status_user');
            $user->admin = $data->input('admin_user');
            $user->tech = $data->input('tech_user');
            $user->user = $data->input('padrao_user');

            $user->password = Hash::make($data->input('password'));

            if ($data->file('photo_perfil')){
                $user->photo_perfil = $data->file('photo_perfil')->store('photo_perfil');
            }

            $user->save();
            return $user->toJson();
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $user = User::find($id);

        if ($user ) {
            return view('admin.user_perfil', compact('user'));
        }
        return redirect()->route('users');
    }

    public function profileUser($id)
    {
        $user = User::find($id);

        if ($user->id == Auth::user()->id ) {
            return view('admin.user_perfil', compact('user'));
        }
        return redirect()->route('home');
    }


    public function alterPassword(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->id == Auth::user()->id ) {
            $this->validate($request, [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user->password = Hash::make($request->input('password'));
            $user->save();

            return $user->toJson();
        }
        return redirect()->route('show_perfil_user/', $id);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);
            if (isset($request->password)){
                $this->validate($request, [
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
                $user->password = Hash::make($request->input('password'));
            }
            if ($request->file('photo_perfil')) {
                if ($user->photo_perfil && Storage::exists($user->photo_perfil)) {
                    Storage::delete($user->photo_perfil);
                }
                $path = Storage::putFile('photo_perfil', $request->file('photo_perfil'));
                $user->photo_perfil = $path;
            }

            if ($request->input('admin_user') == 'on'){
                $request['admin_user'] = 1;
            } else {
                $request['admin_user'] = 0;
            }

            if ($request->input('padrao_user') == 'on'){
                $request['padrao_user'] = 1;
            }  else {
                $request['padrao_user'] = 0;
            }

            if ($request->input('tech_user') == 'on'){
                $request['tech_user'] = 1;
            }  else {
                $request['tech_user'] = 0;
            }

            if ($request->input('status_user') == 'on'){
                $request['status_user'] = 1;
            } else {
                $request['status_user'] = 0;
            }

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            $user->active = $request['status_user'];
            $user->admin = $request['admin_user'];
            $user->tech = $request['tech_user'];
            $user->user = $request['padrao_user'];



            $user->save();
        return redirect()->route('perfil_user', $id);
        // return $user->toJson();
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if ($user)
        {
            try {
                $user->delete();

                if ($user->photo_perfil) {
                    $photo_perfil = $user->photo_perfil;

                    Storage::delete($photo_perfil);
                }


                return redirect()->route('users');

            } catch (QueryException $e) {
                return redirect()->back()->with('error','Algo deu errado, tente novamente mais tarde! Codigo do erro '. $e->getCode() );
            }
        }
        return redirect()->route('users');
    }
}
