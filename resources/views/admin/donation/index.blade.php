@extends('layouts.admin.template')
@push('page-header', 'Data Donasi Masuk')

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
                <h4 class="card-title">Data Donasi Masuk</h4>
            </div>
            <div class="card-body">
                @if ($data->count())                
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table-campaign">
                            <thead>
                                <tr role="row" style="background-color:#dadada">
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th>Campaign</th>
                                    <th>Donatur</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Donasi</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 5%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->campaign->name }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ formatRupiah($item->amount) }}</td>
                                        <td>{{ indonesianDate($item->created_at, true) }}</td>
                                        <td>
                                            @switch($item->status)
                                                @case('waiting_transfer')
                                                    <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                                @break
                                                @case('cancel')
                                                    <span class="badge bg-danger">Dibatalkan</span>
                                                @break
                                                @case('success')
                                                    <span class="badge bg-success">Berhasil</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="text-center">
                                            @if ($item->status == 'waiting_transfer')
                                                <form action="{{ route('donation.status') }}" method="POST" style="display: inline" id="form-status-{{ $item->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="status" value="success">
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="submit_status({{ $item->id }})" data-container="table" data-toggle="tooltip" data-placement="top" title="Terima Donasi">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-success btn-sm" data-container="table" data-toggle="tooltip" data-placement="top" title="Donasi Telah Diterima" disabled>
                                                    <i class="fas fa-check-double"></i>
                                                </button>
                                            @endif
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

        function submit_status(donation_id){
            event.preventDefault();
            Swal.fire({
                width: 600,
                title: 'Konfirmasi Terima Donasi',
                text: 'Pastikan donatur telah melakukan pembayaran donasi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value == true) {
                        $(`#form-status-${donation_id}`).submit();
                    } else {
                        return false;
                    }
                }
            );
        }
    </script>
@endpush