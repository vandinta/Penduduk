<!doctype html>
<html lang="en">

@include('layouts.header')

<body>
  <div class="card" style="margin-top: 30px; margin-left: 45px; width: 1420px;">
    <div class="card-header">
      <div class="d-flex align-items-center">
        <h4 class="card-title">Data Penduduk</h4>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive" style="width: 1380px;">
        <table id="add-row" class="display table table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 20px; text-align: center;">ID</th>
              <th style="width: 140px; text-align: center;">Nama</th>
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
              <td style="text-align: center;">{{ $pr->id }}</td>
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
      </div>
    </div>
  </div>

  <script type="text/javascript">
    window.print();
  </script>

  @include('layouts.js')
</body>

</html>