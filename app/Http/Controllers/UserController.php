<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.users.index');
    }

    public function data()
    {
        if (request()->ajax()) {

            $data = User::all();

            return datatables()->of($data)
                ->addColumn('role', function ($data) {
                    foreach ($data->roles as $key => $value) {
                        return $value->name;
                    }
                })
                ->addColumn('aksi', function ($data) {
                    if ($data->name == 'admin') {
                    } else {
                        $button = "
                        <div class='d-flex justify-content-start'>
                            <div class='label-main'>
                            <a class='edit label label-warning
                            btn-warning' href='javascript:' id='" . $data->id . "' data-toggle='modal' data-target='#exampleModal2'>Edit</a>
                            </div>";
                        $button  .= "<div class='label-main'>
                                <a href='javascript;' class='hapus label label-danger'
                                id='" . $data->id . "'>delete</a>
                           </div>
                                </div>
                     ";
                        return $button;
                    }
                })
                ->rawColumns(['aksi', 'role'])
                ->make('true');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required'
        ], [
            'name.required' => 'tidak boleh kosong',
            'email.required' => 'tidak boleh kosong',
            'password.required' => 'tidak boleh kosong',
            'password.min' => 'minimal 8 karakter',
            'role_id.required' => 'tidak boleh kosong'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $role = Role::find($request->role_id);

        $finish =  $user->assignRole($role->name);

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function dataById(Request $request)
    {
        $users = User::with(['roles'])->find($request->id);

        return response()->json($users);
    }

    public function role(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Role::select("id", "name")
                ->where('name', '!=', 'admin')
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}
