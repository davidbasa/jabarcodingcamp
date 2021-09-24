<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesController extends Controller
{
    public function index()
    {
        if(isAdmin()){
            return view ('admin.categories.index', [
                'data' => Categories::get()
            ]);
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function create()
    {
        if(isAdmin()){
            return view ('admin.categories.create');
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if(isAdmin()){
            $validated = $request->validate([
                'name' => 'required|unique:categories,name'
            ]);
    
            Categories::create($validated);
            
            Alert::success('Berhasil!', 'Data kategori campaign berhasil ditambahkan!');
            return redirect(route('categories.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if(isAdmin()){
            $edit = Categories::find($id);
            return view ('admin.categories.edit', ['edit' => $edit]);
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if(isAdmin()){
            $validated = $request->validate([
                'name' => 'required|unique:categories,name,'. $id . ',id',
            ]);
            
            Categories::where('id', $id)->update($validated);
            
            Alert::success('Berhasil!', 'Data kategori campaign berhasil diperbarui!');
            return redirect(route('categories.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if(isAdmin()){
            $state = Categories::destroy($id);
            $state ? Alert::success('Berhasil!', 'Data kategori campaign berhasil dihapus!') : Alert::success('Error!', 'Data kategori campaign gagal dihapus!');
            
            return redirect(route('categories.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }
}
