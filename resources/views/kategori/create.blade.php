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
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/arsip-surat') }}">
                    <i class="fas fa-folder"></i>
                    <span>Arsip</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
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
                            <h1 class="h3 mb-2 text-gray-800">Kategori Surat &raquo; Tambah</h1>
                            <p> Tambahkan data kategori.<br>
                                Jika sudah selesai, jangan lupa mengklik tombol "Simpan".
                            </p>
                        </div>
                    </div>

                    <div class="card shadow mb-4">

                        <form action="{{ url('/arsip/kategori') }}" id="create-form" method="POST">
                            @csrf
                            <div class="card-body">
                                <!-- ID Kategori -->
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-12 col-md-2 col-form-label">ID
                                        Kategori</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" readonly class="form-control" id="id_category"
                                            name="category_id" value="{{ $incrementId }}">
                                    </div>
                                </div>
                                <!-- Nama Kategori -->
                                <div class="form-group row">
                                    <label for="category_name" class="col-sm-12 col-md-2 col-form-label">Nama
                                        Kategori</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control" id="category" name="category_name"
                                            placeholder="Pemberitahuan">
                                    </div>
                                </div>
                                <!-- Keterangan -->
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-12 col-md-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-12 col-md-10">
                                        <textarea class="form-control" id="ket" name="keterangan" rows="4"
                                            placeholder="Kategori ini digunakan untuk surat yang sifatnya berupa pengumuman atau menginformasikan suatu perihal."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-start">
                                <a href="{{ url('/arsip/kategori') }}" class="btn btn-warning m-2">Kembali</a>
                                <button type="submit" id="kirim" name="kirim"
                                    class="btn btn-primary m-2">Simpan</button>
                            </div>
                        </form>

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
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        var redirectUrl = "{{ url('/arsip/kategori') }}";
    </script>
    <script src="{{ asset('js/sweetalert-custom.js') }}"></script>

</body>

</html>
