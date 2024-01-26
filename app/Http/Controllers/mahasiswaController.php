<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kata_kunci = $request->katakunci;
        // dd($kata_kunci);
        
        if(strlen($kata_kunci)){
            $data= mahasiswa::where('nim','like',"%$kata_kunci%")
            ->orWhere('nama','like',"%$kata_kunci%")
                ->orWhere('jurusan','like',"%$kata_kunci%")
                ->paginate(4);
        }
        else{
            $data = mahasiswa::orderBy('nama','asc')->paginate(5);        
        }
        return view('mahasiswa.create',['mahasiswa'=>$data]);        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Session::flash('nim',$request->nim);
        Session::flash('nama',$request->nama);
        Session::flash('jurusan',$request->jurusan);
        $request->validate([
            'nim'=>'required|numeric|unique:mahasiswas,nim',
            'nama'=>'required',
            'jurusan'=>'required',
        ]
        ,[
            'nim.required'=>'nim harus diisi donggg',
            'nama.required'=>'nama harus diisi donggg',
            'jurusan.required'=>'jurusan harus diisi donggg',
        ]
    );
        $data =[
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
        ];

        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success','Data Sudah Berhasil Masuk !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = mahasiswa::where('nim',$id)->get();
        // dd($data);
        return view('mahasiswa.edit',['data_detail'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        Session::flash('nama',$request->nama);
        Session::flash('jurusan',$request->jurusan);
        $request->validate([
            'nama'=>'required',
            'jurusan'=>'required',
        ]
        ,[
            'nama.required'=>'nama harus diisi donggg',
            'jurusan.required'=>'jurusan harus diisi donggg',
        ]
    );
        $data =[
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
        ];

        mahasiswa::where('nim',$id)->update($data);
        return redirect()->to('mahasiswa')->with('success','Data Sudah Berhasil diganti !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        mahasiswa::where('nim',$id)->delete();
        return redirect()->to('mahasiswa')->with('success','Data Sudah Berhasil dihapus !');
    }
}
