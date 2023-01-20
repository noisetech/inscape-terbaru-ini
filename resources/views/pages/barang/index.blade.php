@extends('layouts.main')
@section('content')
    <style>
        .cell_table {
            max-width: 250px;
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
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Role</a>
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
                        <div id="bagian_index_barang">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>List Barang</h5>
                                        <div class="label-main">
                                            <a href="#" data-toggle="modal"
                                                data-target="#exampleModal"class="label label-primary">
                                                Tambah
                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-block table-border-style">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped responsive nowrap" cellpadding="0"
                                            cellspacing="0" width="100%">

                                            <thead>
                                                <tr>
                                                    <th>Barang</th>
                                                    <th>Gambar</th>
                                                    <th>Deskripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah barang --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Barang</h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="create_barang" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control">
                            <span class="text-danger error-text nama_barang_error"></span>
                        </div>


                        <div class="form-group">
                            <label for="">Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                            <span class="text-danger error-text gambar_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" cols="30" rows="10"></textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>



                        <div class="modal-footer">
                            <button type="submit" class="btn label label-primary" id="create_barang_btn">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- modal akhir tambah barang --}}



    {{-- modal edit barang --}}
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Edit Gambar</h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_barang" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang">
                            <span class="text-danger error-text nama_barang_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Gambar Barang</label>
                            <input type="file" name="gambar" class="form-control" id="nama_barang">
                            <span class="text-danger error-text gambar_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" cols="30" rows="10" id="deskripsi"></textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn label label-primary" id="edit_tahun_btn">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- modal data sub_barang --}}
    <div class="modal fade" id="data_sub_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titiTableSubBarang"></h5>

                    <div class="d-flex justify-content-end">
                        <a href="#" class="label label-primary tambah_sub_barang" id="old_id">Tambah</a>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="datatables_sub_barang" class="table table-striped responsive nowrap" cellpadding="0"
                            cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>Sub Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- modal tambah sub_barang --}}
    <div class="modal fade" id="modal_tambah_sub_barang" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleFormSubBarang"></h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="create_sub_barang" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="barang_id" class="bahan_id_barang_pada_sub_barang">

                        <div class="form-group">
                            <label for="">Sub Barang</label>
                            <input type="text" name="sub_barang" class="form-control">
                            <span class="text-danger error-text sub_barang_error"></span>
                        </div>




                        <div class="modal-footer">
                            <button type="submit" class="btn label label-primary"
                                id="create_sub_barang_btn">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- modal akhir tambah sub_barang --}}



    {{-- modal edit sub_barang --}}
    <div class="modal fade" id="modal_edit_sub_barang" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Edit Sub Barang</h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_sub_barang" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" class="id_sub_barang_edit">

                        <input type="hidden" name="barang_id" class="bahan_id_barang_pada_sub_barang_edit">

                        <div class="form-group">
                            <label for="">Sub Barang</label>
                            <input type="text" name="sub_barang" class="form-control" id="data_sub_barang_edit">
                            <span class="text-danger error-text sub_barang_error"></span>
                        </div>




                        <div class="modal-footer">
                            <button type="submit" class="btn label label-primary"
                                id="edit_sub_barang_btn">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- modal edit sub_barang --}}


    {{-- modal data parameter_barang --}}
    <div class="modal fade" id="data_parameter_barang" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_tabel_parameter"></h5>

                    <div class="d-flex justify-content-end">
                        <a href="#" class="label label-primary tambah_parameter_barang"
                            id="old_parameter_barang_id">Tambah</a>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="datatables_parameter_barang" class="table table-striped responsive nowrap"
                            cellpadding="0" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- modal tambah parameter_barang --}}
    <div class="modal fade" id="modal_tambah_parameter_barang" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Parameter Barang</h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="create_parameter_barang" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="barang_id" class="bahan_id_barang_pada_parameter_barang">

                        <div class="form-group">
                            <label for="">Parameter</label>
                            <input type="text" name="parameter" class="form-control">
                            <span class="text-danger error-text parameter_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Bobot</label>
                            <input type="text" name="bobot" class="form-control">
                            <span class="text-danger error-text bobot_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn label label-primary"
                                id="create_parameter_barang_btn">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- modal akhir tambah parameter_barang --}}

    {{-- modal edit paramater barang --}}
    <div class="modal fade" id="modal_edit_parameter_barang" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Edit Parameter Barang</h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="update_parameter_barang" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="barang_id" class="bahan_id_edit_parameter_barang">

                        <input type="text" name="id" class="id_parameter">

                        <div class="form-group">
                            <label for="">Parameter</label>
                            <input type="text" name="parameter" class="form-control parameter_edit">
                            <span class="text-danger error-text parameter_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Bobot</label>
                            <input type="text" name="bobot" class="form-control bobot_edit">
                            <span class="text-danger error-text bobot_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn label label-primary"
                                id="update_parameter_barang_btn">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- akhir modal edit parameter barang --}}
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "responsive": true,
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                // responsive: true,
                order: [],
                ajax: {
                    url: "{{ route('barang.data') }}"
                },
                columns: [{
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });
        });

        $('#exampleModal').on('hidden.bs.modal', function(e) {
            $('#create_barang')[0].reset();
            $("#create_barang_btn").text('Simpan');
            $(document).find('span.error-text').empty();
            $("#exampleModal").modal('hide');
        });

        $('#exampleModal2').on('hidden.bs.modal', function(e) {
            $('#edit_barang')[0].reset();
            $("#edit_barang_btn").text('Simpan');
            $(document).find('span.error-text').empty();
            $("#exampleModal2").modal('hide');
        });

        $('#modal_tambah_sub_barang').on('hidden.bs.modal', function(e) {
            $('#create_sub_barang')[0].reset();
            $("#create_sub_barang_btn").text('Simpan');
            $(document).find('span.error-text').empty();
            $("#modal_tambah_sub_barang").modal('hide');
        });


        $("#create_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#create_barang_btn").text('Menyimpan...');
            $.ajax({
                url: '{{ route('barang.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'error') {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        $('#create_barang')[0].reset();
                        $("#create_barang_btn").text('Simpan');
                        $("#exampleModal").modal('hide');
                        $('#example').DataTable().ajax.reload();
                    }
                }
            });
        });


        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('barang.dataById') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#id').val(data.id);
                    $('#nama_barang').val(data.nama_barang);
                    $('#deskripsi').val(data.deskripsi);
                }
            });
        });



        $("#edit_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_barang_btn").text('Menyimpan...');
            $.ajax({
                url: '{{ route('barang.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'error') {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        $('#edit_barang')[0].reset();
                        $("#edit_barang_btn").text('Simpan');
                        $("#exampleModal2").modal('hide');
                        $('#example').DataTable().ajax.reload();
                    }
                }
            });
        });


        $(document).on('click', '.hapus', function(e) {
            e.preventDefault();
            let id = $(this).attr('id')
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('barang.destroy') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 1500,
                                    showConfirmButton: false,
                                });
                                $('#example').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        });


        // bagian sub barang

        $(document).on('click', '.sub_barang', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');

            $('#datatables_sub_barang').DataTable({
                destroy: true,
                "responsive": true,
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                // responsive: true,
                order: [],
                ajax: {
                    url: "{{ route('data_sub_barang') }}",
                    data: {
                        barang_id: id
                    },
                },
                columns: [{
                        data: 'sub_barang',
                        name: 'sub_barang'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });


            $.ajax({
                url: '{{ route('barang.dataById') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {

                    let bahan_id_sub_barang = data.id;

                    $('#titiTableSubBarang').text('Sub barang' + ' ' + data.nama_barang);

                    $('#titleFormSubBarang').text('Tambah sub barang' + ' ' + data.nama_barang);

                    // manipulasi id yang ada di class tambah sub barang
                    $('.tambah_sub_barang').attr('id', data.id);
                }
            });
        });



        $(document).on('click', '.tambah_sub_barang', function(e) {

            e.preventDefault();

            $('#data_sub_barang').modal('hide');
            $('#modal_tambah_sub_barang').modal('show');

            let id_barang = $(this).attr('id');


            $('.bahan_id_barang_pada_sub_barang').val(id_barang);

        });

        $("#create_sub_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#create_sub_barang_btn").text('Menyimpan...');
            $.ajax({
                url: '{{ route('barang.sub_barang.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'error') {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        $('#create_sub_barang')[0].reset();
                        $("#create_sub_barang_btn").text('Simpan');
                        $("#modal_tambah_sub_barang").modal('hide');
                        $('#datatables_sub_barang').DataTable().ajax.reload();
                    }
                }
            });
        });


        $(document).on('click', '.hapus_sub_barang', function(e) {
            e.preventDefault();
            let id = $(this).attr('id')
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('barang.sub_barang_destroy') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 1500,
                                    showConfirmButton: false,
                                });
                                $('#datatables_sub_barang').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        });

        $(document).on('click', '.edit_sub_barang', function(e) {
            e.preventDefault();

            $('#data_sub_barang').modal('hide');
            $('#modal_edit_sub_barang').modal('show');
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('barang.sub_barangById') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('.id_sub_barang_edit').val(data.id);
                    $('.bahan_id_barang_pada_sub_barang_edit').val(data.barang_id);
                    $('#data_sub_barang_edit').val(data.sub_barang);
                }
            });
        });


        $("#edit_sub_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_sub_barang_btn").text('Menyimpan...');
            $.ajax({
                url: '{{ route('barang.sub_barangUpdate') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'error') {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        $('#edit_sub_barang')[0].reset();
                        $("#edit_sub_barang_btn").text('Simpan');
                        $("#modal_edit_sub_barang").modal('hide');
                        $('#datatables_sub_barang').DataTable().ajax.reload();
                    }
                }
            });
        });

        // bagian parameter barang
        $(document).on('click', '.parameter_barang', function(e) {
            e.preventDefault();
            let bahan_id_barang_untuK_parameter_barang = $(this).attr('id');

            $('.tambah_parameter_barang').attr('id', bahan_id_barang_untuK_parameter_barang);

            $('#datatables_parameter_barang').DataTable({
                destroy: true,
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                // responsive: true,
                order: [],
                ajax: {
                    url: "{{ route('data_parameter_barang') }}",
                    data: {
                        barang_id: bahan_id_barang_untuK_parameter_barang
                    },
                },
                columns: [{
                        data: 'parameter',
                        name: 'parameter'
                    },
                    {
                        data: 'bobot',
                        name: 'bobot'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });

            $.ajax({
                url: '{{ route('barang.dataById') }}',
                method: 'get',
                data: {
                    id: bahan_id_barang_untuK_parameter_barang,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#title_tabel_parameter').text('Parameter' + ' ' + data.nama_barang);
                }
            });
        });

        $(document).on('click', '.tambah_parameter_barang', function(e) {

            e.preventDefault();

            $('#data_parameter_barang').modal('hide');
            $('#modal_tambah_parameter_barang').modal('show');

            let id_barang = $(this).attr('id');

            $('.bahan_id_barang_pada_parameter_barang').val(id_barang);

        });


        $("#create_parameter_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#create_parameter_barang_btn").text('Menyimpan...');
            $.ajax({
                url: '{{ route('store_parameter_barang') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'error') {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        $('#create_parameter_barang')[0].reset();
                        $("#create_parameter_barang_btn").text('Simpan');
                        $("#modal_tambah_parameter_barang").modal('hide');
                        $("#datatables_parameter_barang").DataTable().ajax.reload();
                    }
                }
            });
        });

        $(document).on('click', '.edit_parameter_barang', function(e) {
            e.preventDefault();

            $('#data_parameter_barang').modal('hide');
            $('#modal_edit_parameter_barang').modal('show');
            let bahan_id_edit_parameter = $(this).attr('id');

            $.ajax({
                url: '{{ route('dataParameterBarangById') }}',
                method: 'get',
                data: {
                    id: bahan_id_edit_parameter,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('.bahan_id_edit_parameter_barang').val(data.barang_id);
                    $('.id_parameter').val(data.id);
                    $('.parameter_edit').val(data.parameter);
                    $('.bobot_edit').val(data.bobot);
                }
            });
        });

        $("#update_parameter_barang").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#update_parameter_barang_btn").text('Menyimpan...');
            $.ajax({
                url: '{{ route('parameterBarangUpdate') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'error') {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        $('#update_parameter_barang')[0].reset();
                        $("#update_parameter_barang_btn").text('Simpan');
                        $("#modal_edit_parameter_barang").modal('hide');
                        $("#datatables_parameter_barang").DataTable().ajax.reload();
                    }
                }
            });
        });

        $(document).on('click', '.hapus_parameter_barang', function(e) {
            e.preventDefault();
            let id = $(this).attr('id')

            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('parameter_barang_destroy') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 1500,
                                    showConfirmButton: false,
                                });
                                $("#datatables_parameter_barang").DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        });
    </script>
@endpush
