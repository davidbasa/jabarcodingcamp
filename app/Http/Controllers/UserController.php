<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();
        $roles=DB::table('roles')
        ->join('users', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.name as rn')
        ->get();
        return view('admin.user.index', compact(['users', 'roles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('roles')
        ->join('users', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.name as rn')
        ->first();
        
        return view('admin.user.edit', compact(['users', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isAdmin()){
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'role_id'=>'required',
            ]);
            
            User::where('id', $id)->update($validated);

            Alert::success('Berhasil!', 'Data user berhasil diperbarui!');
            return redirect(route('user.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isAdmin()){
            $query = DB::table('users')->where('id', $id)->delete();
            $query ? Alert::success('Berhasil!', 'Data user berhasil dihapus!') : Alert::success('Error!', 'Data user gagal dihapus!');
            
            return redirect(route('user.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }
}
