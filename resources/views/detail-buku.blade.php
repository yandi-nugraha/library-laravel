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
    <br><hr><br>

    <div class="card col-md-6 mx-auto">
        <div class="card-body m-3">
            <form method="post" action="{{ route('komentar.store', $buku->id) }}">
                @csrf
                <h4>Tambahkan komentar baru</h4><br>
                <div class="form-group">
                    <textarea name="comment" class="form-control" placeholder="Tulis Komentar Anda"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-sm btn-outline-primary float-end">Kirim</button>
            </form>
        </div>
    </div>

    <div class="col-md-6 mt-4 mx-auto">
        <h3>Comments</h3>
        @foreach ($komentar as $data)
        <div class="d-flex my-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-circle" 
            viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 
                4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            <div class="flex-fill ms-3 p-3 shadow-sm" style="background: #ffffff">
                <h4 class="card-title mb-1">{{ $data->user->name }}</h4>
                <p class="card-text">{{ $data->comment }}</p>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection

