<!-- Navbar Header -->
<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand text" href="#">Penduduk</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-link text" href="{{ route('home') }}">Home</a>
      <a class="nav-link text" href="{{ route('provinsi.index') }}">Provinsi</a>
      <a class="nav-link text" href="{{ route('kabupaten.index') }}">Kabupaten</a>
      <a class="nav-link text" href="{{ route('penduduk.index') }}">Penduduk</a>
      <a class="nav-link text" href="{{ route('laporan.index') }}">Laporan</a>
    </div>
  </div>
</nav>