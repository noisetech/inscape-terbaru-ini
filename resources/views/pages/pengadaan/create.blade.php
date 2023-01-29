@extends('layouts.main')
@section('content')
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
    <div class="pcoded-content">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10"></h5>
                            <p class="m-b-0">Selamat datang di website INSCAPE-PLN</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('pengadaan') }}">Pengadaan</a>
                            </li>

                            <li class="breadcrumb-item"><a href="#!">Tambah Pengadaan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-body start -->
                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Form Tambah Pengadaan</h5>
                                </div>
                            </div>
                            <div class="card-block table-border-style">
                                <form action="#" method="POST" id="form_pengadaan">
                                    @csrf

                                    <div class="form-group">
                                        <label for="">No Nota Dinas</label>
                                        <input type="text" name="no_nota_dinas" class="form-control">

                                        <span class="text-danger error-text no_nota_dinas_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Unit</label>
                                        <select id="unit" name="unit_id" class="form-control">
                                        </select>
                                        <span class="text-danger error-text unit_id_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Tahun</label>
                                        <select id="tahun" name="tahun_id" class="form-control">
                                        </select>
                                        <span class="text-danger error-text tahun_id_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Anggaran</label>
                                        <input type="number" name="anggaran" class="form-control">
                                        <span class="text-danger error-text anggaran_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">File Nota Dinas</label>
                                        <input type="file" name="file" class="form-control" accept="application/pdf">
                                        <span class="text-danger error-text file_error"></span>
                                    </div>


                                    <div class="row justify-content-end">
                                        <div class="col-sm-2 mt-4 mb-4">
                                            <i class="fa fa-plus addAlokasiTahun"></i> Inputan Direksi
                                        </div>
                                    </div>


                                    <div id="wew">

                                    </div>

                                    <button class="btn label label-info" type="submit">
                                        Simpan
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $("#form_pengadaan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('pengadaan.simpan') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'error') {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix.replace(/\./g, '_') +
                                '_error').text(
                                val[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: 'Data telah disimpan',
                            title: 'Berhasil',
                            toast: true,
                            position: 'top-end',
                            timer: 1000,
                            showConfirmButton: false,
                        });
                        $('#form_pengadaan')[0].reset();
                        setTimeout(function() {
                            window.top.location =
                                "{{ url('dashboard/pengadaan') }}"
                        }, 1800);

                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tahun').select2({
                minimumInputLength: 2,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Tahun--',
                type: "get",
                ajax: {
                    url: "{{ route('pengadaan.list_tahun') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.tahun,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });


        $(document).ready(function() {
            $('#unit').select2({
                minimumInputLength: 2,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Unit--',
                ajax: {
                    url: "{{ route('pengadaan.list_unit') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.unit,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
    </script>


    <script>
        var inputan_nama_direksi = 0;
        var validasi_nama_direksi = 0;

        var inputan_dokumen_direksi = 0;
        var validasi_dokumen_direksi = 0;

        var inputan_nama_direksi = 0;
        var validasi_nama_direksi = 0;

        var inputan_dokumen_direksi = 0;
        var validasi_dokumen_direksi = 0;

        $(".addAlokasiTahun").click(function() {
            var test = (
                '<div class="row justify-content-center my-3"><div class="col-sm-4 imgUp"><div class="form-group"><label>Nama Direksi</label><input type="text" id="nama_direksi_' +
                inputan_nama_direksi +
                '" class="form-control nama_direksi_control" name="nama_direksi[]" placeholder="Nama Direksi"><span  class="gg text-danger error-text nama_direksi_' +
                validasi_nama_direksi +
                '_error" style="font-size: 12px;"></span></div></div><div class="col-sm-4 imgUp"><div class="form-group"><label>Dokumen Direksi</label><input type="file" id="dokumen_direksi_' +
                inputan_dokumen_direksi +
                '" class="form-control nama_direksi_control" name="dokumen_direksi[]" multiple="multiple" required  accept="application/pdf"><span  class="cc text-danger error-text dokumen_direksi_' +
                validasi_dokumen_direksi +
                '_error" style="font-size: 12px;"></span></div></div><div class="col-sm-2"><i class="fa fa-times del my-3"></i> </div></div>'
            );
            $('#wew').append(test);
            inputan_nama_direksi++;
            validasi_nama_direksi++;
            inputan_dokumen_direksi++;
            validasi_dokumen_direksi++;
        });
        $(document).on("click", "i.del", function() {
            $(this).parent().parent().remove();
            validasi_nama_direksi--;
            inputan_nama_direksi--;
            inputan_dokumen_direksi--;
            validasi_dokumen_direksi--;
            reset();
        });

        function reset() {
            var inputan_nama_direksi = 0;
            var validasi_nama_direksi = 0;

            var inputan_dokumen_direksi = 0;
            var validasi_dokumen_direksi = 0;


            $(".nama_direksi_control").each(function() {
                $(this).attr('id', 'nama_direksi_' + inputan_nama_direksi);
                inputan_nama_direksi++;
            });


            $(".dokumen_direksi_control").each(function() {
                $(this).attr('id', 'dokumen_direksi_' + inputan_dokumen_direksi);
                inputan_dokumen_direksi++;
            });

            $("span.gg").each(function() {
                $(this).attr('class', 'gg' + ' ' + 'nama_direksi_' +
                    validasi_nama_direksi + '_error');
                validasi_nama_direksi++;
            });
            $('span.gg').addClass('text-danger');

            $("span.cc").each(function() {
                $(this).attr('class', 'cc' + ' ' + 'dokumen_direksi_' +
                    validasi_dokumen_direksi + '_error');
                validasi_dokumen_direksi++;
            });
            $('span.cc').addClass('text-danger');

        }
    </script>
@endpush
