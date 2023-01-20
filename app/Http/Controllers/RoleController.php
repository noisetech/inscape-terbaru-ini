<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.role.index');
    }

    public function data()
    {
        if (request()->ajax()) {

            $data = Role::all();

            return datatables()->of($data)
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
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'role' => 'required',
            'permissions' => 'required'
        ];

        $text = [
            'role.required' => 'tidak boleh kosong',
            'permissions.required' => 'tidak boleh kosong'
        ];


        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        } else


            $role = Role::create([
                'name' => $request->input('role'),
                'guard_name' => 'web'
            ]);


        $role->givePermissionTo($request->input('permissions'));

        if ($role) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function dataById(Request $request)
    {
        $id = $request->id;

        $role = Role::find($id);

        return response()->json($role);
    }

    public function update(Request $request)
    {
        $validitor = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'tidak boleh kosong'
        ]);

        if ($validitor->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validitor->errors()->toArray()
            ]);
        }

        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->guard_name = 'web';
        $simpan =  $role->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data  diubah'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $role = Role::find($id);

        $role->delete();

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data  dihapus'
        ]);
    }

    public function permission(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Permission::select("id", "name")
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}
