<?php

namespace App\Http\Controllers;

use App\Models\Direksi;
use App\Models\Pengadaan;
use App\Models\Tahun;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PengadaanController extends Controller
{
    public function index()
    {
        return view('pages.pengadaan.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {
            $data = Pengadaan::with(['unit', 'tahun', 'step'])->get();

            return datatables()->of($data)
                ->addColumn('unit', function ($data) {
                    return $data->unit->unit;
                })
                ->addColumn('tahun', function ($data) {
                    return $data->tahun->tahun;
                })
                ->editColumn('aksi', function ($data) {

                    if (Auth::user()->hasRole('manajer') || Auth::user()->hasRole('pemeriksa')) {

                        if ($data->step->toArray() == NULL) {
                            return 'ok';
                        } else {
                            $temp = array_reverse($data->step->toArray());
                            if ($temp[0]['step'] == 'B.1' && $temp[0]['status'] == '1') {
                                // return 'reject';
                                $button  = "
                                <div class='d-flex justify-content-start'>
                                  <a class='detail btn btn btn-sm
                                btn-secondary mr-1' title='Detail'href='" . route('pengadaan.detail', [$data->id]) . "'><i class='fas fa-sm fa-eye'></i></a>
                                 </div>
                                 ";
                                return $button;
                            } elseif ($temp[0]['step'] == 'B.2' && $temp[0]['status'] == '2') {
                                $button  = "
                                <div class='d-flex justify-content-start'>
                                  <a class='detail btn btn btn-sm
                                btn-secondary mr-1' title='Detail'href='" . route('pengadaan.detail', [$data->id]) . "'><i class='fas fa-sm fa-eye'></i></a>";
                                $button  .= "<button class='hapus btn btn-sm  btn-danger' data-toggle='tooltip' title='Hapus' style='display: inline-block;'
                                 id='" . $data->id . "'><i class='fas fa-sm fa-trash-alt'></i></button>
                                 </div>
                                 ";
                                return $button;
                            }
                        }
                    } else {
                        if ($data->step->toArray() == NULL) {
                            return 'ok';
                        } else {
                            $temp = array_reverse($data->step->toArray());
                            if ($temp[0]['step'] == 'B.1' && $temp[0]['status'] == '1') {
                                // return 'reject';
                                $button = "
                    <div class='d-flex justify-content-start'>
                        <div class='label-main'>
                        <a class='edit label label-info
                        ' href='" . route('pengadaan.detail', $data->id) . "' >detail</a>
                        </div>";
                                $button  .= "<div class='label-main'>
                            <a href='javascript;' class='hapus label label-danger'
                            id='" . $data->id . "'>hapus</a>
                       </div>
                            </div>
                 ";
                                return $button;
                            } elseif ($temp[0]['step'] == 'B.2' && $temp[0]['status'] == '2') {
                                $button  = "
                                <div class='d-flex justify-content-start'>
                                  <a class='detail btn btn btn-sm
                                btn-secondary mr-1' title='Detail'href='" . route('pengadaan.detail', [$data->id]) . "'><i class='fas fa-sm fa-eye'></i></a>";
                                $button  .= "<button class='hapus btn btn-sm  btn-danger' data-toggle='tooltip' title='Hapus' style='display: inline-block;'
                                 id='" . $data->id . "'><i class='fas fa-sm fa-trash-alt'></i></button>
                                 </div>
                                 ";
                                return $button;
                            }
                        }
                    }
                })
                ->addColumn('aksi', function ($data) {
                    $button  = "
                    <div class='d-flex justify-content-start'>
                      <a class='detail btn btn btn-sm
                    btn-secondary mr-1' title='Detail'href='" . route('pengadaan.detail', [$data->id]) . "'><i class='fas fa-sm fa-eye'></i></a>";
                    $button  .= "<button class='hapus btn btn-sm  btn-danger' data-toggle='tooltip' title='Hapus' style='display: inline-block;'
                     id='" . $data->id . "'><i class='fas fa-sm fa-trash-alt'></i></button>
                     </div>
                     ";
                    return $button;
                })
                ->rawColumns(['unit', 'tahun', 'aksi'])
                ->make('true');
        }
    }

    public function h_tambah(Request $request)
    {
        return view('pages.pengadaan.create');
    }

    public function simpan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'no_nota_dinas' => 'required',
            'unit_id' => 'required',
            'tahun_id' => 'required',
            'file' => 'required|mimes:pdf',
            'anggaran' => 'required',
            'nama_direksi.*' => 'required',
        ], [
            'no_nota_dinas.required' => 'tidak boleh kosong',
            'unit_id.required' => 'tidak boleh kosong',
            'tahun_id.required' => 'tidak boleh kosong',
            'file.mimes' => 'harus berupa pdf',
            'file.required' => 'tidak boleh kosong',
            'anggaran.required' => 'tidak bobleh kosong',
            'nama_direksi.*.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = $request->all();

        $file_nota_dinas = $request->file('file');

        $path_nota_dinas = Storage::disk('s3')->put('gambar_barang', $file_nota_dinas, $file_nota_dinas->hashName());


        $pengadaan = new Pengadaan();
        $pengadaan->no_nota_dinas = $request->no_nota_dinas;
        $pengadaan->unit_id = $request->unit_id;
        $pengadaan->tahun_id = $request->tahun_id;
        $pengadaan->file = $path_nota_dinas;
        $pengadaan->anggaran = $request->anggaran;
        $pengadaan->save();

        $files = [];
        $file_direksi = $request->file('dokumen_direksi');


        // inser direksi
        foreach ($file_direksi as $d_direksi) {
            $path_dokumen_direksi = Storage::disk('s3')->put('dokumen_direksi', $d_direksi,  $d_direksi->hashName());

            $files[] = $path_dokumen_direksi;
        }


        foreach ($data['nama_direksi'] as $item => $value) {
            $direksi = new Direksi();
            $direksi->pengadaan_id = $pengadaan->id;
            $direksi->nama = $data['nama_direksi'][$item];
            $direksi->dokumen = $files[$item];
            $direksi->save();
        }

        $bahan = [
            [
                'pengadaan_id' => $pengadaan->id,
                'step' => 'B.1',
                'deskripsi' => Auth::user()->name . ' ' . 'membuat pengadaan barang',
                'status' => '0'
            ],
            [
                'pengadaan_id' => $pengadaan->id,
                'step' => 'B.1',
                'dreskripsi' => Auth::user()->name . '' . 'membuat pengadaan barang',
                'status' => '1'
            ]
        ];

        $step =   DB::table('step_pengadaan')
            ->insert($bahan);

        if ($step) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function detail($id)
    {
        $pengadaan = Pengadaan::find($id);

        $direksi = Direksi::where('pengadaan_id', $pengadaan->id)->get();

        // dd($direksi);

        return view('pages.pengadaan.detail', [
            'pengadaan' => $pengadaan,
            'direksi' => $direksi
        ]);
    }


    public function list_tahun(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Tahun::select("id", "tahun")
                ->Where('tahun', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function list_unit(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Unit::select("id", "unit")
                ->Where('unit', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}
