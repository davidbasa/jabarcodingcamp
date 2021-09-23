@extends('public.layout')

@section('content')
<br><br><br>
<div class="container">
    <h1 class="text-center">List Campaign</h1>
</div>
<div class="container my-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-sm card-campaign">
                <img src="https://imgix.kitabisa.com/e88b7578-7707-4043-a77f-f662d9ee429e.jpg?ar=16:9&w=664&auto=format,compress" alt="" />

                <div class="card-body">
                    <h4 class="campaign-title">Lorem ipsum dolor sit, amet consectetur ...</h4>
                    <div class="progress my-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Terkumpul</small>
                        <small>Sisa hari</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="total-donation">Rp 15.000.000</span>
                        <small class="text-muted">99</small>
                    </div>
                    
                    <div class="d-grid mt-3">
                        <button class="btn btn-success btn-sm text-center">
                            Donasi Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-sm card-campaign">
                <img src="https://imgix.kitabisa.com/a5b06463-535f-4c6c-99a7-e03c20687642.jpg?ar=16:9&w=664&auto=format,compress" alt="" />

                <div class="card-body">
                    <h4 class="campaign-title">Lorem ipsum dolor sit amet consectetur ...</h4>
                    <div class="progress my-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Terkumpul</small>
                        <small>Sisa hari</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="total-donation">Rp 15.000.000</span>
                        <small class="text-muted">99</small>
                    </div>
                    
                    <div class="d-grid mt-3">
                        <button class="btn btn-success btn-sm text-center">
                            Donasi Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-sm card-campaign">
                <img src="https://imgix.kitabisa.com/e8a834f2-ab46-4a9c-9923-2e2cd1d3f317.jpg?ar=16:9&w=664&auto=format,compress" alt="" />

                <div class="card-body">
                    <h4 class="campaign-title">Lorem ipsum dolor sit amet consectetur ...</h4>
                    <div class="progress my-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Terkumpul</small>
                        <small>Sisa hari</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="total-donation">Rp 15.000.000</span>
                        <small class="text-muted">99</small>
                    </div>
                    
                    <div class="d-grid mt-3">
                        <button class="btn btn-success btn-sm text-center">
                            Donasi Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection