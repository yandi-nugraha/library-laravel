<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<div class="container">
    @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <h4>Edit Buku</h4>
    <form method="post" action="{{ route('update', $buku->id) }}">
        @csrf
        <div>Judul <input type="text" name="judul" value="{{ $buku->judul }}"></div>
        <div>Penulis <input type="text" name="penulis" value="{{ $buku->penulis }}"></div>
        <div>Harga <input type="text" name="harga" value="{{ $buku->harga }}"></div>
        <div>Tgl. Terbit <input type="text" id="datepicker" name="tgl_terbit" value="{{ $buku->tgl_terbit->format('Y-m-d') }}" class="date form-control"></div>
        <div>
            <button type="submit">Simpan</button>
            <a href="/buku">Batal</a>
        </div>
    </form>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#datepicker" ).datepicker();
    });
</script>