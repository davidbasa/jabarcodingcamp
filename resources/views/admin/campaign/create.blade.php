@extends('layouts.admin.template')
@push('page-header', 'Tambah Data Campaign')

@push('head')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/cropperjs/cropper.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Campaign</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('campaign.store') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama Campaign:<span class="text-danger">*</span></label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="name" maxlength="200" placeholder="Nama Campaign" value="{{ old('name') }}" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Slug:<span class="text-danger">*</span></label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="slug" maxlength="200" placeholder="Slug URL" value="{{ old('slug') }}" autocomplete="off" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Target Donasi:<span class="text-danger">*</span></label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Target Donasi" value="{{ old('target') }}" autocomplete="off" onkeyup="format_rupiah('target')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Target Tanggal:<span class="text-danger">*</span></label>
                        <div class="col-lg-5">
                            <div class="input-group date">
                                <input type="text" class="form-control" placeholder="Target Tanggal" name="duration" value="{{ old('duration') }}" autocomplete="off" required>
                                <div class="input-group-append">
                                    <button class="btn input-group-text" type="button" style="z-index: 0"><i class="far fa-calendar-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Kategori:<span class="text-danger">*</span></label>
                        <div class="col-lg-5">
                            <select name="category_id" class="form-control" required>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Banner Campaign:</label>
                        <div class="col-lg-9">
                            <img src="" alt="" id="cropped">
                            <input type="file" name="banner" class="image" id="uploaded_image">
                            <input type="hidden" name="banner_file" id="banner_file">
                            <span id="info" class="text-info" style="display: none">Refresh halaman jika ingin mengganti banner!</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Deskripsi Campaign:<span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('campaign.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @if ($errors->any())
            <div class="card">
                <div class="card-body">
                    <h5>Terdapat kesalahan: </h5>
                    <div class="text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Banner Sebelum di Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="" id="pre_cropped_image">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
    <script src="{{ asset('plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/cropperjs/cropper.js') }}"></script>
    <script>
        // format slug
        const elementTitle = document.querySelector('input[name=name]');
        const elementSlug = document.querySelector('input[name=slug]');
        elementTitle.addEventListener('keyup', function() {
            const slug = elementTitle.value.toLowerCase().split(" ").join("-");
            elementSlug.value = slug;
        });

        $(document).ready(function () {
            // datepicker
            $('.input-group.date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                orientation: 'bottom',
                startDate: '+1d'
            });

            // ckeditor
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{ route('ckeditor.image-upload.description', ['_token' => csrf_token() ]) }}",
                filebrowserUploadMethod: 'form',
                removeButtons: 'TextField,Textarea,Select,Button,ImageButton,HiddenField,Form,Checkbox,Radio,Iframe,Flash,PasteFromWord,PasteText,ExportPdf,Preview,Print,Templates,Scayt,Language'
            });

            //cropperjs
            var $modal = $('#modal');
            var image = document.getElementById('pre_cropped_image');
            let cropper, reader, file;
            $('#uploaded_image').change(function(event){
                var files = event.target.files;
                var done = function(url){
                    image.src = url;
                    $modal.modal('show');
                };
                
                if(files && files.length > 0)
                {
                    reader = new FileReader();
                    reader.onload = function(event)
                    {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }

                $modal.on('shown.bs.modal', function() {
                    cropper = new Cropper(image, {
                        aspectRatio: 16 / 9,
                        viewMode: 2,
                        preview:'.preview'
                    });
                }).on('hidden.bs.modal', function(){
                    cropper.destroy();
                    cropper = null;
                });

                $('#crop').click(function(){
                    canvas = cropper.getCroppedCanvas({
                        width:400,
                        height:400
                    });
            
                    canvas.toBlob(function(blob){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        url = URL.createObjectURL(blob);
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function(){
                            var base64data = reader.result;
                            var urlnya = "{{route('banner.image')}}";
                            var slugnya = $('input[name=slug]').val();
                            $.ajax({
                                url:urlnya,
                                method:'POST',
                                data:{image:base64data, slug:slugnya},
                                success:function(data) {
                                    $modal.modal('hide');
                                    $('#cropped').attr('src', "{{ URL::asset('/img/banner') }}" + "/" + data.image_name);
                                    $('#cropped').attr('alt', data.slug);
                                    $('#uploaded_image').hide();
                                    $('#banner_file').val(data.image_name);
                                    $('#info').show();
                                }
                            });
                        };
                    });
                });
            });
        });

        //format rupiah
        function format_rupiah(id) {
            var angka = document.getElementById(id).value;
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            document.getElementById(id).value = 'Rp. ' + rupiah;
        }
    </script>
@endpush