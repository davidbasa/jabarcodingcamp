@extends('layouts.admin.template')
@push('page-header', 'Detail Campaign "' . $data->name . '"')

@section('content')
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Detail Campaign "{{ $data->name }}"</h3>
        </div>
		<div class="card-body">
			<img src="{{ asset('img/banner/' . $data->banner) }}" alt="Banner" class="image" width="427px" height="240px">
            <br><br>
            <p>Target Donasi : {{ formatRupiah($data->target) }}</p>
            <p>Donasi Terkumpul : --</p>
            <p>Hingga Tanggal : {{ indonesianDate($data->duration) }}</p>
            
            <h4>Deskripsi</h4>
            <p>{!! $data->description !!}</p>
            
		</div>
        <div class="card-footer">
            <div class="text-right">
                <a href="{{ route('campaign.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
	</div>
@endsection