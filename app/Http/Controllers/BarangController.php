<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ParameterBarang;
use App\Models\SpesifikasiParameter;
use App\Models\SpesifikasiSubBarang;
use App\Models\SubBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return view('pages.barang.index');
    }

    public function data()
    {
        if (request()->ajax()) {

            $data = Barang::all();

            return datatables()->of($data)
                ->editColumn('gambar', function ($data) {
                    return "<img src=" . Storage::disk('s3')->temporaryUrl($data->gambar, now()->addMinutes(5)) . " class='img-thumbnail' width='100'>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = "
                    <div class='d-flex justify-content-start align-items-center'>
                        <div class='label-main'>
                        <a href='javascript:void(0)' class='sub_barang label label-info' href='javascript:' id='" . $data->id . "' data-toggle='modal' data-target='#data_sub_barang'>Sub Barang</a>
                        </div>";
                    $button .= "

                        <div class='label-main'>
                        <a href='javascript:void(0)' class='parameter_barang label label-success' href='javascript:' id='" . $data->id . "' data-toggle='modal' data-target='#data_parameter_barang'>Parameter Barang</a>
                        </div>";

                    $button .= "

                        <div class='label-main'>
                        <a class='edit label label-warning
                        btn-warning' href='javascript:void(0)' id='" . $data->id . "' data-toggle='modal' data-target='#exampleModal2'>Ubah barang</a>
                        </div>";
                    $button  .= "<div class='label-main'>
                            <a href='javascript:void(0)' class='hapus label label-danger'
                            id='" . $data->id . "'>Hapus barang</a>
                       </div>
                            </div>
                 ";
                    return $button;
                })
                ->rawColumns(['aksi', 'gambar'])
                ->make('true');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|min:2',
            'gambar' => 'required|file|mimes:png,jpg|max:2048',
            'deskripsi' => 'required'
        ], [
            'nama_barang.min' => 'minimal 2 karakter',
            'nama_barang.required' => 'tidak boleh kosong',
            'gambar.required' => 'tidak boleh kosong',
            'gambar.file' => 'harus berupa file',
            'gambar.mimes' => 'harus jpg atau jp',
            'gambar.max' => 'maksimal 2MB',
            'deskripsi.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $file = $request->file('gambar');


        $path = Storage::disk('s3')->put('gambar_barang', $file, $file->hashName());

        $barang = new Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->gambar =  $path;
        $barang->deskripsi =  $request->deskripsi;

        $simpan = $barang->save();

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

        $barang = Barang::find($request->id);

        return response()->json($barang);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|min:2',
            'gambar' => 'file|mimes:png,jpg|max:2048',
            'deskripsi' => 'required'
        ], [
            'nama_barang.required' => 'tidak boleh kosong',
            'nama_barang.min' => 'harus 2 karakter',
            'gambar.file' => 'harus berupa file',
            'gambar.mimes' => 'harus jpg atau jp',
            'gambar.max' => 'maksimal 2MB',
            'deskripsi.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $id = $request->id;

        if (empty($request->gambar)) {
            $barang = Barang::find($id);
            $barang->nama_barang = $request->nama_barang;
            $barang->deskripsi = $request->deskripsi;
            $simpan =   $barang->save();

            if ($simpan) {
                return response()->json([
                    'status' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Data diubah'
                ]);
            }
        } else {
            $file = $request->file('gambar');

            $path = Storage::disk('s3')->put('gambar_barang', $file, $file->hashName());

            $barang = Barang::find($id);
            $barang->nama_barang = $request->nama_barang;
            $barang->gambar = $path;
            $barang->deskripsi = $request->deskripsi;
            $simpan =   $barang->save();

            if ($simpan) {
                return response()->json([
                    'status' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Data diubah'
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $barang = Barang::find($id);

        $hapus =  $barang->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data dihapus'
            ]);
        }
    }

    // bagian sub barang

    public function data_sub_barang(Request $request)
    {
        if (request()->ajax()) {

            $data = SubBarang::where('barang_id',  $request->barang_id);

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = "
                    <div class='d-flex justify-content-start'>
                        <div class='label-main'>
                        <a class='edit_sub_barang label label-warning' href='javascript:' id='" . $data->id . "'>Edit</a>
                        </div>";

                    $button  .= "<div class='label-main'>
                            <a href='javascript;' class='hapus_sub_barang label label-danger'
                            id='" . $data->id . "'>Hapus</a>
                       </div>
                 ";


                    $button  .= "<div class='label-main'>
                 <a href='javascript;' class='sepsifikasi_sub_barang label label-info'
                 id='" . $data->id . "'  data-toggle='modal' data-target='#modal_spesifikasi_sub_barang'>Spesifikasi sub barang</a>
            </div>
                 </div>
      ";
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function sub_barang_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'sub_barang' => 'required'
        ], [
            'barang_id.required' => 'tidak boleh kosong',
            'sub_barang.required' => 'tidak boleh kosong'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $simpan = SubBarang::create([
            'barang_id' => $request->barang_id,
            'sub_barang' => $request->sub_barang
        ]);

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function sub_barangById(Request $request)
    {
        $sub_barang = SubBarang::find($request->id);

        return response()->json($sub_barang);
    }

    public function sub_barangUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'sub_barang' => 'required'
        ], [
            'barang_id.required' => 'tidak boleh kosong',
            'sub_barang.required' => 'tidak boleh kosong'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $sub_barang = SubBarang::find($request->id);
        $sub_barang->barang_id  = $request->barang_id;
        $sub_barang->sub_barang  = $request->sub_barang;
        $simpan =  $sub_barang->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data diubah'
            ]);
        }
    }

    public function sub_barang_destroy(Request $request)
    {
        $sub_barang = SubBarang::find($request->id);

        $hapus = $sub_barang->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data dihapus'
            ]);
        }
    }

    // parameter
    public function store_parameter_barang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'parameter' => 'required',
            'bobot' => 'required'
        ], [
            'barang_id.required' => 'tidak boleh kosong',
            'parameter.required' => 'tidak boleh kosong',
            'bobot.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $parameter_barang = new ParameterBarang();
        $parameter_barang->barang_id =  $request->barang_id;
        $parameter_barang->parameter = $request->parameter;
        $parameter_barang->bobot = $request->bobot;
        $simpan =  $parameter_barang->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function data_parameter_barang(Request $request)
    {
        if (request()->ajax()) {

            $data = ParameterBarang::where('barang_id',  $request->barang_id);

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = "
                    <div class='d-flex justify-content-start'>
                        <div class='label-main'>
                        <a class='edit_parameter_barang label label-warning' href='javascript:' id='" . $data->id . "'>Ubah</a>
                        </div>";

                    $button  .= "<div class='label-main'>
                            <a href='javascript:void(0)' class='hapus_parameter_barang label label-danger'
                            id='" . $data->id . "'>Hapus</a>
                       </div>

                 ";
                    $button  .= "<div class='label-main'>
                            <a href='javascript:void(0)' class='spesifikasi_parameter_barang label label-info'
                            id='" . $data->id . "' data-toggle='modal' data-target='#modal_spesifkasi_parameter'>Spesifikasi parameter</a>
                       </div>
                 ";
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function dataParameterBarangById(Request $request)
    {
        $parameter_barang = ParameterBarang::find($request->id);

        return response()->json($parameter_barang);
    }

    public function parameterBarangUpdate(Request $request)
    {
        $parameter_barang = ParameterBarang::find($request->id);

        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'parameter' => 'required',
            'bobot' => 'required'
        ], [
            'barang_id.required' => 'tidak boleh kosong',
            'parameter.required' => 'tidak boleh kosong',
            'bobot.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $parameter_barang->barang_id =  $request->barang_id;
        $parameter_barang->parameter = $request->parameter;
        $parameter_barang->bobot = $request->bobot;
        $ubah =  $parameter_barang->save();


        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data diubah'
            ]);
        }
    }

    public function parameter_barang_destroy(Request $request)
    {
        $parameter_barang = ParameterBarang::find($request->id);

        $hapus = $parameter_barang->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data dihapus'
            ]);
        }
    }


    // spesifikasi parameter

    public function data_spesifikasi_paramemter(Request $request)
    {
        $data = SpesifikasiParameter::where('parameter_id', $request->parameter_id)->get();

        return datatables()->of($data)

            ->addColumn('aksi', function ($data) {
                $button = "
                    <div class='d-flex justify-content-start'>
                        <div class='label-main'>
                        <a class='edit_spesifikasi_parameter label label-warning' href='javascript:' id='" . $data->id . "'>Ubah</a>
                        </div>";

                $button  .= "<div class='label-main'>
                            <a href='javascript:void(0)' class='hapus_spesifikasi_parameter label label-danger'
                            id='" . $data->id . "'>Hapus</a>
                       </div>
                       </div>

                 ";
                return $button;
            })
            ->rawColumns(['aksi'])
            ->make('true');
    }

    public function store_spesifikasi_parameter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parameter_id' => 'required',
            'spesifikasi' => 'required',
            'level' => 'required'
        ], [
            'parameter_id.required' => 'tidak boleh kosong',
            'spesifikasi.required' => 'tidak boleh kosong',
            'level.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $spesifikasi_parameter = new SpesifikasiParameter();
        $spesifikasi_parameter->parameter_id = $request->parameter_id;
        $spesifikasi_parameter->spesifikasi = $request->spesifikasi;
        $spesifikasi_parameter->level = $request->level;
        $simpan =  $spesifikasi_parameter->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function spesifikasiParameterById(Request $request)
    {
        $spesifikasi_parameter = SpesifikasiParameter::find($request->id);

        return response()->json($spesifikasi_parameter);
    }

    public function spesifikasiParameterUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'parameter_id' => 'required',
            'spesifikasi' => 'required',
            'level' => 'required'
        ], [
            'parameter_id.required' => 'tidak boleh kosong',
            'spesifikasi.required' => 'tidak boleh kosong',
            'level.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $spesifikasi_parameter = SpesifikasiParameter::find($request->id);
        $spesifikasi_parameter->parameter_id = $request->parameter_id;
        $spesifikasi_parameter->spesifikasi = $request->spesifikasi;
        $spesifikasi_parameter->level = $request->level;
        $ubah = $spesifikasi_parameter->save();

        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data diubah'
            ]);
        }
    }

    public function sepsifikasiParameterDestroy(Request $request)
    {
        $spesifikasi_parameter = SpesifikasiParameter::find($request->id);
        $hapus = $spesifikasi_parameter->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data dihapu'
            ]);
        }
    }

    // bagian spesifikasi sub barang
    public function data_spesifikasi_sub_barang(Request $request)
    {
        $data = SpesifikasiSubBarang::where('sub_barang_id', $request->sub_barang_id)->get();

        return datatables()->of($data)

            ->addColumn('parameter', function ($data) {
                return $data->spesifikasi_parameter->parameter->parameter;
            })
            ->addColumn('spesifikasi', function ($data) {
                return $data->spesifikasi_parameter->spesifikasi;
            })
            ->addColumn('level', function ($data) {
                return $data->spesifikasi_parameter->level;
            })


            ->rawColumns(['aksi', 'parameter', 'spesifikasi', 'level'])
            ->make('true');
    }

    public function formTambahSpesifkkasiSubBarang(Request $request)
    {

        $sub_barang = SubBarang::where('id', $request->sub_barang_id)->first();

        $parameter = ParameterBarang::whereIn('barang_id', [$sub_barang->barang_id])->get();

        $html = '<form action="#" method="post" id="form_tambah_spesifikasi_sub_barang">
        <input type="hidden" name="_token" value="' . csrf_token() . '" />

         <input type="hidden" name="sub_barang_id" value="' . $sub_barang->id . '">';
        foreach ($parameter as  $parameter) :

            $html .=      '<div class="form-group">
            <label for="">' . $parameter->parameter . '</label>
            <select class="form-control" name="spesifikasi_parameter_id[]">';
            foreach ($parameter->spesifikasi as  $spesifikasi) :
                $html .=  '<option value="' . $spesifikasi->id . '">' . $spesifikasi->spesifikasi . '</option>';
            endforeach;
            $html .= '</select>
            <span class="text-danger error-text permissions_error"></span>
        </div>';

        endforeach;

        $html .=  '
        <div class="modal-footer">
        <button type="submit" class="btn label label-primary"
            id="form_tambah_spesifikasi_sub_barang_btn">Simpan</button>
         </div>
        </form>';

        return response()->json($html);
    }

    public function ptambah_spesifkasi_sub_barang(Request $request)
    {
        $data = $request->all();

        foreach ($data['spesifikasi_parameter_id'] as $key => $value) {
            $spesifikasi_sub_barang = new SpesifikasiSubBarang();
            $spesifikasi_sub_barang->sub_barang_id = $request->sub_barang_id;
            $spesifikasi_sub_barang->spesifikasi_parameter_id = $data['spesifikasi_parameter_id'][$key];
            $simpan =  $spesifikasi_sub_barang->save();
        }

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }
}
