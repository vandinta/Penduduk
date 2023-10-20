<!doctype html>
<html lang="en">

@include('layouts.header')

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
          <h4 class="card-title">Data Provinsi</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div class="action-atas" style="margin-right: 25px; margin-bottom: 20px;">
            <a href="{{ route('provinsi.create') }}" type="button" class="btn btn-primary btn-round ml-2"><i class="fa fa-plus"></i> Tambah Data</a>
            <div class="float-right">
              <div class="row">
                <p style="font-size: 20px; margin-top: 3px;">Search :</p>
                <form action="{{ route('provsearch') }}" method="GET">
                  <div class="form-group">
                    <input type="text" class="form-control" style="margin-left: 8px; height: 36px; width: 180px;" name="search" value="{{ old('search') }}">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <table id="add-row" class="display table table-striped table-hover">
            <thead>
              <tr>
                <th style="width: 60px; text-align: center;">No</th>
                <th style="width: 600px; text-align: center;">Provinsi</th>
                <th style="text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($provinsi as $index => $pr)
              <tr>
                <td style="text-align: center;">{{ $index + $provinsi->firstItem() }}</td>
                <td style="text-align: center;">{{ $pr->nama_provinsi }}</td>
                <td style="text-align: center;">
                  <form action="{{ route('provinsi.destroy',$pr->id) }}" method="POST">
                    <a href="{{ route('provinsi.edit',$pr->id) }}"><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-icon" data-original-title="Ubah">
                        <i class="icon fa fa-edit"></i>
                      </button></a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger btn-icon" data-original-title="Hapus">
                      <i class="icon fa fa-times"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="pagination float-right" style="margin-top: -20px;">
            {{ $provinsi->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.footer')

  @include('layouts.js')

</body>

</html>