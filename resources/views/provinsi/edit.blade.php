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
          <h4 class="card-title">Edit Data Provinsi</h4>
          <div class="ml-auto">
          </div>
          <a href="{{ route('provinsi.index') }}" type="button" class="btn btn-primary btn-round ml-2">kembali</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 col-lg-12">
            <form action="{{ route('provinsi.update', $provinsi->id) }}" method="post">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="nama_provinsi">Nama Provinsi</label>
                <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" placeholder="Nama Provinsi" value="{{ $provinsi->nama_provinsi }}" autofocus>
              </div>
              <button type="submit" class="btn btn-outline-success float-right">Ubah</button>
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