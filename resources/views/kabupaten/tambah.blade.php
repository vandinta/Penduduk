<!doctype html>
<html lang="en">

@include('layouts.header')

<body>
  <!-- Navbar -->
  @include('layouts.navbar')

  <div class="container mt-4">
    <div class="alert">
      @if ($message = Session::get('berhasil'))
      <div class="alert alert-success" role="alert">
        <p>{{ $message }}</p>
      </div>
      @endif
      @if ($message = Session::get('gagal'))
      <div class="alert alert-danger" role="alert">
        <p>{{ $message }}</p>
      </div>
      @endif
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>
    <div class="card">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title">Tambah Data Kabupaten</h4>
          <div class="ml-auto">
          </div>
          <a href="{{ route('kabupaten.index') }}" type="button" class="btn btn-primary btn-round ml-2">kembali</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 col-lg-12">
            <form action="{{ route('kabupaten.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="nama_kabupaten">Nama Kabupaten</label>
                <input type="text" class="form-control" id="nama_kabupaten" name="nama_kabupaten" placeholder="Nama Kabupaten" value="{{ old('nama') }}" autofocus>
              </div>
              <div class="form-group">
                  <label for="provinsi">Kategori Provinsi</label>
                  <select class="form-control" id="id_provinsi" name="id_provinsi" autofocus>
                    <option value=""></option>
                    @foreach ($provinsi as $pr)
                    <option value="<?= $pr['id'] ?>"><?= $pr['nama_provinsi'] ?></option>
                    @endforeach
                  </select>
                </div>
              <button type="submit" class="btn btn-outline-success float-right">Tambah</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.footer')

  @include('layouts.js')

</body>

</html>