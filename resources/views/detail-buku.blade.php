@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/style.css">

<div class="container">
    Halaman Detail Buku
    <br>
    <h2>Buku: {{ $buku->judul }}</h2>
    <hr>
    <div class="row">
        @foreach ($galeri as $data)
        <div class="col-md-4">
            <a href="{{ asset('thumb/'.$data->foto) }}" data-lightbox="image-1" data-title="{{ $data->keterangan }}">
                <img src="{{ asset('thumb/'.$data->foto) }}" style="width:200px; height:150px">
                <p>
                    <h5>{{ $data->nama_galeri }}</h5>
                </p>
            </a>
        </div>
        @endforeach
    </div>
    <div>
        {{ $galeri->links() }}
    </div>
</div>
@endsection

