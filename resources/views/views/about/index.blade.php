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
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/arsip/kategori') }}">
                    <i class="fas fa-boxes"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
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
                    <h1 class="h3 mb-4 text-gray-800">About</h1>

                    <div class="row">

                        <div class="col-lg-12">
                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
                                </div>
                                <div class="row g-0">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                                        <img src="{{ asset('img/undraw_profile_3.svg') }}" class="img-fluid rounded-circle" alt="User Image" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <p class="card-text mb-4">Aplikasi ini dibuat oleh:</p>

                                            <div class="row mb-1">
                                                <p class="col-3 fw-bold mb-0" style="font-size: 14px;">Nama</p>
                                                <p class="col-1 mb-0" style="font-size: 14px;">:</p>
                                                <p class="col-8 mb-0" style="font-size: 14px;">{{ $about->nama ?? 'null' }}</p>
                                            </div>

                                            <div class="row mb-1">
                                                <p class="col-3 fw-bold mb-0" style="font-size: 14px;">Prodi</p>
                                                <p class="col-1 mb-0" style="font-size: 14px;">:</p>
                                                <p class="col-8 mb-0" style="font-size: 14px;">{{ $about->prodi ?? 'null' }}</p>
                                            </div>

                                            <div class="row mb-1">
                                                <p class="col-3 fw-bold mb-0" style="font-size: 14px;">NIM</p>
                                                <p class="col-1 mb-0" style="font-size: 14px;">:</p>
                                                <p class="col-8 mb-0" style="font-size: 14px;">{{ $about->nim ?? 'null' }}</p>
                                            </div>

                                            <div class="row mb-1">
                                                <p class="col-3 fw-bold mb-0" style="font-size: 14px;">Tanggal</p>
                                                <p class="col-1 mb-0" style="font-size: 14px;">:</p>
                                                <p class="col-8 mb-0" style="font-size: 14px;" id="tanggal"></p>
                                            </div>
                                        </div>
                                    </div>
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

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('js/demo/pagination.js') }}"></script>
    <script>
        // Array nama-nama bulan
        const months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        // Fungsi untuk memformat tanggal
        function formatDate(date) {
            const day = date.getDate(); // Mendapatkan tanggal
            const month = months[date.getMonth()]; // Mendapatkan nama bulan
            const year = date.getFullYear(); // Mendapatkan tahun

            return `${day} ${month} ${year}`;
        }

        // Mendapatkan tanggal dari PHP dan memformatnya
        document.addEventListener("DOMContentLoaded", function() {
            const createdAt = new Date("{{  $about->created_at ?? '' }}");
            const formattedDate = formatDate(createdAt);

            // Menampilkan tanggal yang diformat di elemen HTML
            document.getElementById('tanggal').textContent = formattedDate;
        });
    </script>

</body>

</html>
