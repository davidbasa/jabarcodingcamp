@extends('layouts.admin.template')

@push('page-header', 'Data Metode Pembayaran')
@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/css/sweetalert2.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush


@section('content')
        <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Metode Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <a href="/admin-area/payment/create" 
                            class="btn btn-primary mr-1"
                            data-toggle="tooltip" data-placement="top" title="Tambah Metode Pembayaran">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>
                    <div class="offset-lg-6"></div>
                </div>
                @if ($payment->count())                
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table-payment">
                            <thead>
                                <tr role="row" style="background-color:#dadada">
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th>Nama Metode Pembayaran</th>
                                    <th>Logo</th>
                                    <th>Akun</th>
                                    <th class="text-center" style="width: 11%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payment as $key=>$value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->logo}}</td>
                                        <td>{{$value->account}}</td>
                                        <td class="text-center">
                                            <a href="/admin-area/payment/{{$value->id}}/edit"  class="btn btn-sm btn-warning btn-action mx-1" data-container="table" data-toggle="tooltip" data-placement="top" title="Edit Metode Pembayaran">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="/admin-area/payment/{{$value->id}}" method="POST" id="form-delete-{{$value->id}}" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $value->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="submit_delete({{$value->id}})" data-container="table" data-toggle="tooltip" data-placement="top" title="Hapus Metode Pembayaran">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse              
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center">
                        <h3>Tidak ada data ditemukan.</h3>
                        <img src="{{ asset('img/data_empty.jpg') }}" width="427px" height="240px">
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- DataTables & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Script Tambahan -->
    <script src="{{ asset('plugins/sweetalert2/js/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {$("#table-payment").DataTable(); });
        $('[data-toggle="tooltip"]').tooltip();

        function submit_delete(payment_id){
            event.preventDefault();
            Swal.fire({
                width: 600,
                title: 'Anda yakin ingin menghapus data terpilih?',
                text: "Data yang sudah di hapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value == true) {
                        $(`#form-delete-${payment_id}`).submit();
                    } else {
                        return false;
                    }
                }
            );
        }
    </script>
@endpush
