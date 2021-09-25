@extends('layouts.admin.template')
@push('page-header', 'Data Campaign')

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
                <h4 class="card-title">Data Campaign</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <a href="{{ route('campaign.create') }}" 
                            class="btn btn-primary mr-1"
                            data-toggle="tooltip" data-placement="top" title="Tambah Campaign">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>
                    <div class="offset-lg-6"></div>
                </div>
                @if ($data->count())                
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table-campaign">
                            <thead>
                                <tr role="row" style="background-color:#dadada">
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th>Nama Campaign</th>
                                    <th>Target Donasi</th>
                                    <th>Target Tanggal</th>
                                    <th>Kategori Donasi</th>
                                    <th class="text-center" style="width: 20%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ formatRupiah($item->target) }}</td>
                                        <td>{{ indonesianDate($item->duration) }}</td>
                                        <td>{{ $item->categories->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('campaign.show', [$item->id]) }}" class="btn btn-info btn-sm" data-container="table" data-toggle="tooltip" data-placement="top" title="Detail Campaign" data-toggle="tooltip" data-placement="top">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a href="{{ route('campaign.edit', [$item->id]) }}"  class="btn btn-sm btn-warning" data-container="table" data-toggle="tooltip" data-placement="top" title="Edit Campaign">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('campaign.destroy', [$item->id]) }}" method="POST" style="display: inline" id="form-delete-{{$item->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="submit_delete({{$item->id}})" data-container="table" data-toggle="tooltip" data-placement="top" title="Hapus Campaign">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('campaign.status') }}" method="POST" style="display: inline" id="form-status-{{ $item->id }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="status" value="{{ $item->status }}">
                                                <button type="submit" class="btn {{ $item->status == 'Ongoing' ? 'btn-success' : 'btn-secondary'}} btn-sm" onclick="submit_status({{ $item->id }}, '{{ $item->status }}')" data-container="table" data-toggle="tooltip" data-placement="top" title="{{ $item->status == 'Ongoing' ? 'Selesaikan' : 'Jalankan'}} Campaign">
                                                    <i class="fas {{ $item->status == 'Ongoing' ? 'fa-check' : 'fa-play'}}"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
        $('#table-campaign').DataTable({
            columnDefs: [
                { orderable: false, targets: 5 },
            ]
        });
        $('[data-toggle="tooltip"]').tooltip();

        function submit_delete(campaign_id){
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
                        $(`#form-delete-${campaign_id}`).submit();
                    } else {
                        return false;
                    }
                }
            );
        }

        function submit_status(campaign_id, status){
            event.preventDefault();
            Swal.fire({
                width: 600,
                title: 'Konfirmasi perubahan status',
                text: 'Anda yakin ingin ' + (status == 'Ongoing' ? 'menyelesaikan' : 'menjalankan') + ' Campaign?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value == true) {
                        $(`#form-status-${campaign_id}`).submit();
                    } else {
                        return false;
                    }
                }
            );
        }
    </script>
@endpush