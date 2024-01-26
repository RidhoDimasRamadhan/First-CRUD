@extends('template.layout')
@section('isi')

<!-- START FORM -->
@foreach ($data_detail as $item)
<form action='{{url('mahasiswa/'.$item->nim)}}' method='post'>

@csrf
@method('PUT')
<button class="btn btn-danger mt-5"><a href="{{url('mahasiswa')}}" class="text-white text-decoration-none">Back</a></button>
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="mb-3 row">
        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name='nim' id="nim" value="{{$item->nim}}" disabled>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='nama' id="nama" value="{{$item->nama}}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='jurusan' id="jurusan" value="{{$item->jurusan}}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="jurusan" class="col-sm-2 col-form-label"></label>

        <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
    </div>
  </form>
</div>
    
@endforeach
  <!-- AKHIR FORM -->
    
@endsection