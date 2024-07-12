<!DOCTYPE html>
<html lang="en">

<!-- Head -->
@include('section.head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-mail-bulk"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    Arsip Surat Karangduren
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/arsip-surat') }}">
                    <i class="fas fa-folder"></i>
                    <span>Arsip</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/arsip/kategori') }}">
                    <i class="fas fa-boxes"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/about') }}">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('section.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h1 class="h3 mb-2 text-gray-800">Arsip Surat</h1>
                            <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>
                                Klik "Lihat" pada kolom aksi untuk menampilkan surat.
                            </p>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
                                <!-- Title table -->
                                <h6 class="m-0 font-weight-bold text-primary">Riwayat Arsip Surat</h6>

                                <!-- Search bar -->
                                <div class="d-flex align-items-center mt-3 mt-sm-0">
                                    <label for="search" class="mr-2">Cari surat:</label>
                                    <form action="#" class="d-flex align-items-center">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="search" placeholder="search" name="cari"
                                                class="form-control search-input" aria-label="Search" aria-describedby="basic-addon1" value="{{ old('cari', $valueCari) }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-outline-secondary">Cari!</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor Surat</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Waktu Pengarsipan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($arsipSurat->isEmpty())
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada surat yang diarsipkan</td>
                                            </tr>
                                        @else
                                            @foreach ($arsipSurat as $as )
                                            <tr>
                                                <td>{{ $as->nomor_surat }}</td>
                                                <td>{{ $as->kategoriSurat->nama_kategori }}</td>
                                                <td>{{ $as->judul }}</td>
                                                <td>{{ $as->created_at }}</td>
                                                <td>
                                                    <div class="d-flex flex-column flex-sm-row">
                                                        <!-- Hapus -->
                                                        <form id="delete-form-{{ $as->id }}" action="{{ url('/arsip-surat/' . $as->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" class="btn btn-danger m-1 swal-6" data-id="{{ $as->id }}">Hapus</button>
                                                        </form>
                                                        <!-- Unduh -->
                                                        <a type="button" class="btn btn-warning m-1" href="{{ asset('storage/' . $as->uploaded_file) }}" download>Unduh</a>
                                                        <!-- Lihat -->
                                                        <button type="button" class="btn btn-primary m-1">Lihat</button>


                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
                                    <!-- Arsip surat -->
                                    <button type="submit" class="btn btn-secondary mb-3 mb-sm-0">
                                        <a href="{{ url('/arsip-surat/create') }}" class="text-decoration-none text-white">
                                            <span>
                                                <i class="fas fa-inbox"></i>
                                            </span>
                                            Arsipkan Surat
                                        </a>
                                    </button>

                                    <!-- Pagination -->
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('section.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('section.logout')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('js/demo/pagination.js') }}"></script>
    <script src="{{ asset('js/sweetalert-custom.js') }}"></script>

</body>

</html>
