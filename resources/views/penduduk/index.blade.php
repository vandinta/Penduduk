<!doctype html>
<html lang="en">

@include('layouts.header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<body>
  <!-- Navbar -->
  @include('layouts.navbar')

  <div class="container mt-4">
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
    <div class="card">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title">Data Penduduk</h4>
        </div>
      </div>
      <div class="card-body" style="width: 800px;">
        <div class="table-responsive" style="width: 1065px;">
          <div class="action-atas" style="margin-right: 25px; margin-bottom: 20px;">
            <a href="{{ route('penduduk.create') }}" type="button" class="btn btn-primary btn-round ml-2"><i class="fa fa-plus"></i> Tambah Data</a>
            <div class="row float-right">
              <form action="{{ route('pensearch') }}" method="GET">
                <div class="row">
                  <div class="column" style="margin-left: 10px;">
                    <div class="form-group">
                      <select class="form-control" id="provinsi" name="provinsi" autofocus>
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinsi as $pr)
                        <option value="<?= $pr['id'] ?>"><?= $pr['nama_provinsi'] ?></option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="column" style="margin-left: 10px;">
                    <div class="form-group">
                      <select class="form-control" id="kabupaten" name="kabupaten" autofocus>
                        <option value="">Pilih Kabupaten</option>
                      </select>
                    </div>
                  </div>
                  <div class="column" style="margin-right: 10px;">
                    <div class="form-group">
                      <input type="text" class="form-control" style="margin-left: 8px; height: 36px; width: 180px;" name="search" value="{{ old('search') }}">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-link btn-info text" style="height:36px; margin-right: 10px;">
                    cari
                  </button>
                </div>
              </form>
            </div>
          </div>
          <table id="add-row" class="display table table-striped table-hover">
            <thead>
              <tr>
                <th style="width: 20px; text-align: center;">No</th>
                <th style="width: 120px; text-align: center;">Aksi</th>
                <th style="width: 120px; text-align: center;">Nama</th>
                <th style="width: 160px; text-align: center;">NIK</th>
                <th style="width: 100px; text-align: center;">Tanggal Lahir</th>
                <th style="width: 80px; text-align: center;">Jenis Kelamin</th>
                <th style="width: 100px; text-align: center;">Alamat</th>
                <th style="width: 100px; text-align: center;">Created At</th>
                <th style="width: 100px; text-align: center;">Updated At</th>
              </tr>
            </thead>
            <tbody>
              @foreach($penduduk as $index => $pr)
              <tr>
                <td style="text-align: center;">{{ $index + $penduduk->firstItem() }}</td>
                <td style="text-align: center;">
                  <form action="{{ route('penduduk.destroy',$pr->id) }}" method="POST">
                    <a href="{{ route('penduduk.edit',$pr->id) }}"><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-icon" data-original-title="Ubah">
                        <i class="icon fa fa-edit"></i>
                      </button></a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger btn-icon" data-original-title="Hapus">
                      <i class="icon fa fa-times"></i>
                    </button>
                  </form>
                </td>
                <td style="text-align: center;">{{ $pr->nama }}</td>
                <td style="text-align: center;">{{ $pr->nik }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($pr->tanggallahir)->format('j F Y') }}</td>
                <td style="text-align: center;">{{ $pr->jeniskelamin }}</td>
                <td style="text-align: center;">{{ $pr->alamat . ', ' . $pr->nama_kabupaten . ', ' . $pr->nama_provinsi }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($pr->created_at)->format('j F Y') }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($pr->updated_at)->format('j F Y') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="pagination float-right" style="margin-top: -20px;">
            {{ $penduduk->links() }}
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
                $('#kabupaten').append('<option value="" hidden>Pilih Kabupaten</option>');
                $.each(data, function(id, name) {
                  $('#kabupaten').append('<option value="' + name.id + '">' + name.nama_kabupaten + '</option>');
                });
              } else {
                $('#kabupaten').empty();
              }
            }
          });
        } else {
          $('#kabupaten').empty();
          $('#kabupaten').append(new Option('Pilih Kabupaten', ''));
        }
      });
    });
  </script>

</body>

</html>