<!doctype html>
<html lang="en">

@include('layouts.header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
          <h4 class="card-title">Tambah Data Penduduk</h4>
          <div class="ml-auto">
          </div>
          <a href="{{ route('penduduk.index') }}" type="button" class="btn btn-primary btn-round ml-2">kembali</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 col-lg-12">
            <form action="{{ route('penduduk.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ old('nama') }}" autofocus>
              </div>
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="{{ old('nik') }}" autofocus>
              </div>
              <div class="form-group">
                <label for="jeniskelamin">Jenis Kelamin</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jeniskelamin" id="jeniskelamin" value="laki-laki" >
                  <label class="form-check-label" for="jeniskelamin">
                    Laki-Laki
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jeniskelamin" id="jeniskelamin" value="perempuan">
                  <label class="form-check-label" for="jeniskelamin">
                    Perempuan
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="tanggallahir">Tanggal Lahir</label>
                <input type="datetime-local" class="form-control" name="tanggallahir">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" value="{{ old('alamat') }}"></textarea>
              </div>
              <div class="form-group">
                <select class="form-control" id="provinsi" name="provinsi" autofocus>
                  <option value="">Pilih Provinsi</option>
                  @foreach ($provinsi as $pr)
                  <option value="<?= $pr['id'] ?>"><?= $pr['nama_provinsi'] ?></option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" id="kabupaten" name="kabupaten" autofocus>
                  <option value="">Pilih Kabupaten</option>
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

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    flatpickr("input[type=datetime-local]");
  </script>
  <script>
    $(document).ready(function() {
      $('#provinsi').on('change', function() {
        var id_provinsi = $(this).val();
        if (id_provinsi) {
          $.ajax({
            url: '/getKabupaten/' + id_provinsi,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              if (data) {
                $('#kabupaten').empty();
                $('#kabupaten').append('<option hidden>Pilih Kabupaten</option>');
                $.each(data, function(id, name) {
                  $('#kabupaten').append('<option value="'+ name.id +'">' + name.nama_kabupaten+ '</option>');
                });
              } else {
                $('#kabupaten').empty();
              }
            }
          });
        } else {
          $('#kabupaten').empty();
          $('#kabupaten').append(new Option('Pilih Kota', ''));
        }
      });
    });
  </script>

</body>

</html>