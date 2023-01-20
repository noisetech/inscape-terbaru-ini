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
                            <p class="m-b-0">Selamat datang di website MBATIK</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Users</a>
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
                                    <h5>List users</h5>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah permission --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Users</h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="create_users">
                        @csrf

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                            <span class="text-danger error-text email_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                            <span class="text-danger error-text email_error"></span>
                        </div>


                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="text-danger error-text password_error"></span>
                        </div>


                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role_id" class="role form-control"></select>
                            <span class="text-danger error-text role_id_error"></span>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary" id="create_users_btn">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- modal akhir tambah permission --}}




    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Edit Users</h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_role">
                        @csrf

                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                            <span class="text-danger error-text email_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                            <span class="text-danger error-text email_error"></span>
                        </div>


                        <div class="form-group">
                            <label for="">Password</label> <sup class="text-danger" style="font-size: 10px">* isi
                                jika diubah</sup>
                            <input type="password" name="password" class="form-control">
                            <span class="text-danger error-text password_error"></span>
                        </div>


                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role_id" class="form-control" id="role_edit"></select>
                            <span class="text-danger error-text role_id_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary" id="edit_role_btn">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
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
                    url: "{{ route('users.data') }}"
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });
        });

        $('#exampleModal').on('hidden.bs.modal', function(e) {
            $('#create_users')[0].reset();
            $("#create_users_btn").text('Simpan');
            $(document).find('span.error-text').empty();
            $(".role").val('').trigger("change");
            $("#exampleModal").modal('hide');
        });

        $('#exampleModal2').on('hidden.bs.modal', function(e) {
            $('#edit_permission')[0].reset();
            $("#edit_permission_btn").text('Simpan');
            $(document).find('span.error-text').empty();
            $(".role_edit").val('').trigger("change");
            $("#exampleModal2").modal('hide');
        });

        $("#create_users").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#create_users_btn").text('Menyimpan...');
            $.ajax({
                url: '{{ route('users.store') }}',
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
                        $('#create_users')[0].reset();
                        $("#create_users_btn").text('Simpan');
                        $(".role").val('').trigger("change");
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
                url: '{{ route('users.dataById') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);

                    console.log(data.roles.length);

                    for (i = 0; i < data.roles.length; i++) {
                        // selected
                        var newOption = new Option(data.roles[i].name, data.roles[i].id, true,
                            true);
                        $('#role_edit').append(newOption).trigger('change');
                    }
                }
            });
        });


        $(document).ready(function() {
            $('#role_edit').select2({
                minimumInputLength: 1,
                dropdownParent: $('#exampleModal2'),
                maximumSelectionLength: 0,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Role--',
                width: '100%',
                ajax: {
                    url: "{{ route('users.role') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.role').select2({
                minimumInputLength: 3,
                dropdownParent: $('#exampleModal'),
                maximumSelectionLength: 0,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Role--',
                width: '100%',
                ajax: {
                    url: "{{ route('users.role') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush
