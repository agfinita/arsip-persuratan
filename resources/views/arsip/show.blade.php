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
                            <h1 class="h3 mb-2 text-gray-800">Arsip Surat &raquo; Detail</h1>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- Title -->
                            <h6 class="m-0 font-weight-bold text-primary">Detail Arsip Surat</h6>
                        </div>

                        <div class="card-body">
                            <!-- Nomor -->
                            <div class="row mb-1">
                                <div class="col-4 col-md-3">
                                    <p class="fw-bold mb-0" style="font-size: 14px;">Nomor Surat</p>
                                </div>
                                <div class="col-1">
                                    <p class="mb-0" style="font-size: 14px;">:</p>
                                </div>
                                <div class="col-7 col-md-8">
                                    <p class="mb-0" style="font-size: 14px;">{{ $arsipSurat->nomor_surat ?? 'null' }}
                                    </p>
                                </div>
                            </div>
                            <!-- Kategori -->
                            <div class="row mb-1">
                                <div class="col-4 col-md-3">
                                    <p class="fw-bold mb-0" style="font-size: 14px;">Kategori</p>
                                </div>
                                <div class="col-1">
                                    <p class="mb-0" style="font-size: 14px;">:</p>
                                </div>
                                <div class="col-7 col-md-8">
                                    <p class="mb-0" style="font-size: 14px;">
                                        {{ $arsipSurat->kategoriSurat->nama_kategori ?? 'null' }}</p>
                                </div>
                            </div>
                            <!-- Judul -->
                            <div class="row mb-1">
                                <div class="col-4 col-md-3">
                                    <p class="fw-bold mb-0" style="font-size: 14px;">Judul</p>
                                </div>
                                <div class="col-1">
                                    <p class="mb-0" style="font-size: 14px;">:</p>
                                </div>
                                <div class="col-7 col-md-8">
                                    <p class="mb-0" style="font-size: 14px;">{{ $arsipSurat->judul ?? 'null' }}</p>
                                </div>
                            </div>
                            <!-- Waktu -->
                            <div class="row mb-1">
                                <div class="col-4 col-md-3">
                                    <p class="fw-bold mb-0" style="font-size: 14px;">Waktu Unggah</p>
                                </div>
                                <div class="col-1">
                                    <p class="mb-0" style="font-size: 14px;">:</p>
                                </div>
                                <div class="col-7 col-md-8">
                                    <p class="mb-0" style="font-size: 14px;">{{ $arsipSurat->created_at }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <embed class="embed-responsive-item"
                                    src="{{ asset('storage/' . $arsipSurat->uploaded_file) }}" type="application/pdf">
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-start flex-wrap">
                            <!-- Kembali -->
                            <a href="{{ url('/arsip-surat') }}" class="btn btn-warning m-2">Kembali</a>
                            <!-- Unduh -->
                            <a class="btn btn-success m-2" href="{{ asset('storage/' . $arsipSurat->uploaded_file) }}"
                                download>Unduh</a>
                            <!-- Edit -->
                            <a class="btn btn-primary m-2"
                                href="{{ url('/arsip-surat/edit/' . $arsipSurat->id) }}">Edit/Ganti File</a>
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
