<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Categories;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CampaignController extends Controller
{
    public function list (Request $request) {
        return view('public.campaign.list');
    }

    public function detail($slug) {
        $data = Campaign::where('slug', $slug)->first();

        if(!$data) {
            Alert::error('Campaign tidak ditemukan', 'Reload halaman lalu silahkan coba lagi');
            return redirect()->back();
        }

        return view('public.campaign.detail', compact([
            'data'
        ]));
    }

    public function index()
    {
        if(isAdmin()){
            $data = Campaign::latest()
                ->with('categories')
                ->get();
                
            return view ('admin.campaign.index', [
                'data' => $data
            ]);
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function create()
    {
        if(isAdmin()){
            return view ('admin.campaign.create', [
                'categories' => Categories::get()
            ]);
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if(isAdmin()){
            $validated = $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:campaigns,slug',
                'target' => 'required',
                'duration' => 'required',
                'category_id' => 'required',
                'description' => 'required',
            ]);

            $validated['target'] = preg_replace('/[Rp. ]/','', $request->target);
            $validated['banner'] = $request->banner != NULL ? $request->banner_file : 'no-banner.jpg';
            
            Campaign::create($validated);
            
            Alert::success('Berhasil!', 'Data campaign berhasil ditambahkan!');
            return redirect(route('campaign.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        if(isAdmin()){
            $data = Campaign::find($id);
            return view ('admin.campaign.show', ['data' => $data]);
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if(isAdmin()){
            $edit = Campaign::find($id);
            return view ('admin.campaign.edit', [
                'edit' => $edit,
                'categories' => Categories::get()
            ]);
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if(isAdmin()){
            $validated = $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:campaigns,slug,'. $id . ',id',
                'target' => 'required',
                'duration' => 'required',
                'category_id' => 'required',
                'description' => 'required',
            ]);

            $validated['target'] = preg_replace('/[Rp. ]/','', $request->target);
            $validated['banner'] = $request->banner != NULL ? $request->banner_file : 'no-banner.jpg';

            Campaign::where('id', $id)->update($validated);
            
            Alert::success('Berhasil!', 'Data campaign berhasil diperbarui!');
            return redirect(route('campaign.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if(isAdmin()){
            $find = Campaign::where('id', $id)->first();
            if ($find->banner != 'no-banner.jpg') {
                unlink('img/banner/' . $find->banner);
            }
            
            $state = Campaign::destroy($id);
            $state ? Alert::success('Berhasil!', 'Data campaign berhasil dihapus!') : Alert::success('Error!', 'Data kategori campaign gagal dihapus!');
            
            return redirect(route('campaign.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function status(Request $request)
    {
        if(isAdmin()){
            $request->validate([
                'id' => 'required',
                'status' => 'required',
            ]);

            Campaign::where('id', $request->id)->update(['status' => ($request->status == 'Ongoing' ? 'Done' : 'Ongoing')]);
            
            Alert::success('Berhasil!', 'Campaign berhasil ' . ($request->status == 'Ongoing' ? 'diselesaikan' : 'dijalankan') . '!');
            return redirect(route('campaign.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function ckeditor_upload_image_description(Request $request)
    {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('img/description/'), $fileName);
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('img/description/' . $fileName); 
        $msg = 'Gambar berhasil di upload!'; 
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        
        @header('Content-type: text/html; charset=utf-8'); 
        echo $response;
    }

    public function banner_image(Request $request)
    {
        if ($request->has('existed')) {
            unlink('img/banner/' . $request->existed);
        }
        
        $image = $request->image;
        $image_array_1 = explode(";", $image);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = 'img/banner/' . $request->slug . '_' . substr(str_shuffle("0123456789"), 0, 3) . '.png';
        file_put_contents($image_name, $data);

        return response()->json(['slug' => $request->slug, 'image_name' => explode('/', $image_name)[2]]);
    }
}
