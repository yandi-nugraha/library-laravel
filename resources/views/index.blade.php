@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
@section('content')
<div class="container">
    <table class="table table-striped">
        <h3>Data Buku</h3>
        <form action="{{ route('search') }}" method="get">
            @csrf
            <input type="text" name="kata" class="form-control" placeholder="Cari..." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: left;">
        </form>
        <thead>
            <tr>
                <th>Id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tgl. Terbit</th>
                @if(Auth::check() && Auth::user()->level == 'admin')
                <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if(Session::has('pesan'))
                <div class="alert alert-success">{{ Session::get('pesan') }}</div>
            @endif
            @if(Session::has('pesan1'))
                <div class="alert alert-danger">{{ Session::get('pesan1') }}</div>
            @endif
            @if(Session::has('pesan2'))
                <div class="alert alert-success">{{ Session::get('pesan2') }}</div>
            @endif
            @foreach($data_buku as $buku)
            <tr>
                <td>{{ $buku->id }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp".number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                @if(Auth::check() && Auth::user()->level == 'admin')
                <td>
                    <a href="{{ route('galbuku', $buku->buku_seo) }}"><button class="btn btn-outline-primary">Detail</button></a>
                    <a href="{{ route('show', $buku->id) }}"><button class="btn btn-outline-secondary">Edit</button></a>
                    <form action="{{ route('destroy', $buku->id) }}" method="post">
                        @csrf
                        <button class="btn btn-danger" onClick="return confirm('Yakin mau dihapus?')">Hapus</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>{{ $data_buku->links() }}</div>
    <br>

    @if(Auth::check() && Auth::user()->level == 'admin')
    <a href="{{ route('create') }}"><button>Tambah Buku</button></a>
    <br><br>
    @endif

    <h5>
        Jumlah Data : {{ $buku->count('id') }}
    </h5>
    <p>Jumlah Total Harga Buku : {{ "Rp".number_format($buku->sum('harga')) }} </p>
</div>
@endsection