@extends('template.layout')
@section('isi')
<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
      <form class="d-flex" action="" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
          <button class="btn btn-secondary" type="submit">Cari</button>
      </form>
    </div>
    
    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
      <a href='{{url('mahasiswa/create')}}' class="btn btn-primary">+ Tambah Data</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-3">NIM</th>
                <th class="col-md-4">Nama</th>
                <th class="col-md-2">Jurusan</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $mahasiswa->firstItem()?>
            @foreach ($mahasiswa as $item)
            <tr>
                <td class="col-md-1">{{$i}}</td> 
                <td class="col-md-3">{{$item->nim}}</td> 
                <td class="col-md-4">{{$item->nama}}</td>
                <td class="col-md-2">{{$item->jurusan}}</td>
            </td>
            <?php $i++ ?>
            <td>
            <a href='{{url('mahasiswa/'.$item->nim.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>

                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ini?')" action="{{url('mahasiswa/'.$item->nim)}}" method="post" class="d-inline">
            @csrf   
                @method('DELETE')
                <button class="btn btn-danger" name="submit" type="submit">Del</button>
            </form>
        </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{$mahasiswa->links()}}
   
</div>
<!-- AKHIR DATA -->
    
@endsection