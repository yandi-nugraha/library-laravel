@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/style.css">

<div class="container">
    @foreach ($galeri as $data)
    <tr>
        <td>{{ ++$no }}</td>
        <td>{{ $data->nama_galeri }}</td>
        <td>{{ 'judul' }}</td>
        <td><img src="{{ asset('thumb/'.$data->foto) }}" style="width= 100px"></td>
        <td>
            <form action="{{ route('galeri.destroy', $data->id) }}" method="post">
                @csrf
                <a href="{{ route('galeri.edit', $data->id) }}" class="btn btn-info">
                    <i class="fa fa-pencil-alt"></i>
                    Edit
                </a>
                <button class="btn btn-danger" onClick="return confirm('Yakin mau dihapus?')">
                    <i class="fa fa-times"></i>
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</div>
@endsection

