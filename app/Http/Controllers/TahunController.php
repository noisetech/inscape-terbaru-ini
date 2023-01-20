<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunController extends Controller
{
    public function index()
    {
        return view('pages.tahun.index');
    }

    public function data()
    {
        if (request()->ajax()) {

            $data = Tahun::all();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
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
                })
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }


    public function store(Request $request)
    {
        $validitor = Validator::make($request->all(), [
            'tahun' => 'required'
        ], [
            'tahun.required' => 'tidak boleh kosong'
        ]);

        if ($validitor->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validitor->errors()->toArray()
            ]);
        }


        $tahun = new Tahun();
        $tahun->tahun = $request->tahun;
        $simpan =  $tahun->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function dataById(Request $request)
    {
        $tahun = Tahun::find($request->id);

        return response()->json($tahun);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $tahun = Tahun::find($id);
        $tahun->tahun = $request->tahun;
        $tahun->save();

        return response()->json([
            'status' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data ditambah'
        ]);
    }

    public function destroy(Request $request)
    {
        $tahun = Tahun::find($request->id);

        $hapus = $tahun->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data disimpan'
            ]);
        }
    }
}
