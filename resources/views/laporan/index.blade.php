<!doctype html>
<html lang="en">

@include('layouts.header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="js/jquery.printPage.js"></script>

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
    <div class="card" style="width: 1100px;">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title">Pelaporan Data Penduduk</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="column">
            <div class="card" style="width: 500px; margin-left: 35px;">
              <h4 class="card-header" style="text-align: center;">Print</h4>
              <div class="card-body">
                <form action="{{ route('print') }}" method="GET">
                  <div class="row">
                    <div class="column" style="margin-left: 85px;">
                      <div class="form-group">
                        <select class="form-control" id="printprovinsi" name="printprovinsi" autofocus>
                          <option value="">Pilih Provinsi</option>
                          @foreach ($provinsi as $pr)
                          <option value="<?= $pr['id'] ?>"><?= $pr['nama_provinsi'] ?></option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="column" style="margin-left: 10px;">
                      <div class="form-group">
                        <select class="form-control" id="printkabupaten" name="printkabupaten" autofocus>
                          <option value="">Pilih Kabupaten</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <button type="submit" class="btn btn-link btn-primary text btn-print" style="margin: auto;">
                      Print Laporan
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="card" style="width: 500px; margin-left: 20px;">
              <h4 class="card-header" style="text-align: center;">Excel</h4>
              <div class="card-body">
                <form action="{{ route('excel') }}" method="GET">
                  <div class="row">
                    <div class="column" style="margin-left: 85px;">
                      <div class="form-group">
                        <select class="form-control" id="excelprovinsi" name="excelprovinsi" autofocus>
                          <option value="">Pilih Provinsi</option>
                          @foreach ($provinsi as $pr)
                          <option value="<?= $pr['id'] ?>"><?= $pr['nama_provinsi'] ?></option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="column" style="margin-left: 10px;">
                      <div class="form-group">
                        <select class="form-control" id="excelkabupaten" name="excelkabupaten" autofocus>
                          <option value="">Pilih Kabupaten</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <button type="submit" class="btn btn-link btn-primary text" style="margin: auto;">
                      Export Excel Laporan
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
      $('#printprovinsi').on('change', function() {
        var id_provinsi = $(this).val();
        if (id_provinsi) {
          $.ajax({
            url: '/getKabupaten/' + id_provinsi,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              if (data) {
                $('#printkabupaten').empty();
                $('#printkabupaten').append('<option value="" hidden>Pilih Kabupaten</option>');
                $.each(data, function(id, name) {
                  $('#printkabupaten').append('<option value="' + name.id + '">' + name.nama_kabupaten + '</option>');
                });
              } else {
                $('#printkabupaten').empty();
              }
            }
          });
        } else {
          $('#printkabupaten').empty();
          $('#printkabupaten').append(new Option('Pilih Kabupaten', ''));
        }
      });

      $('#excelprovinsi').on('change', function() {
        var id_provinsi = $(this).val();
        if (id_provinsi) {
          $.ajax({
            url: '/getKabupaten/' + id_provinsi,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              if (data) {
                $('#excelkabupaten').empty();
                $('#excelkabupaten').append('<option value="" hidden>Pilih Kabupaten</option>');
                $.each(data, function(id, name) {
                  $('#excelkabupaten').append('<option value="' + name.id + '">' + name.nama_kabupaten + '</option>');
                });
              } else {
                $('#excelkabupaten').empty();
              }
            }
          });
        } else {
          $('#excelkabupaten').empty();
          $('#excelkabupaten').append(new Option('Pilih Kabupaten', ''));
        }
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.btn-print').printPage();
    });
  </script>

</body>

</html>