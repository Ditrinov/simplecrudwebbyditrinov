<!DOCTYPE php>

<?php
//minta ke func.php
require 'func.php';
require 'checklog.php';
$namaadmin = $_SESSION['Nama'];

//get data dari halaman sebelumnya
$idud = $_GET['iddetail'];
$nama = $_GET['namadetail'];
$ktp =$_GET['ktpdetail'];
$telpon = $_GET['telpdetail'];
$addr = $_GET['addrdetail'];
$jumlahdetail = $_GET['jmldetail'];
$sumdetail = $_GET['sumdetail'];

$tarikcicilandetail = mysqli_query($konek, "select * from datamasuk WHERE idutama='$idud'");
$tariktambahandetail = mysqli_query($konek, "select * FROM datatambahan WHERE idutama='$idud'");

?>

<php lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Detail Peminjam</title>

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <style>
            .ikonweb {
        background: url("img/logo.png");
        height: 40px;
        width: 40px;
        display: block;
        /* Other styles here */
        }
        </style>

        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <img src="img/logo.png" alt="logo" style="width:50px;height:60px;">         
                    <div class="sidebar-brand-text mx-3">Database Peminjaman</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Tables -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cicilan.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Cicilan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tambahan.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Tambahan</span></a>
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
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <form class="form-inline">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </form>

                        <!-- Topbar Search -->
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">3+</span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 7, 2019</div>
                                            $290.29 has been deposited into your account!
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 2, 2019</div>
                                            Spending Alert: We've noticed unusually high spending for your account.
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                </div>
                            </li>

                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                                alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                                problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                                alt="...">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month, how
                                                would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                                alt="...">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                                the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                                alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                                told me that people say this to all dogs, even if they aren't good...</div>
                                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$namaadmin;?></span>
                                    <img class="img-profile rounded-circle"
                                        src="img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 font-weight-bold text-primary">Detail Peminjaman</h1>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h2>Data Peminjam</h2>
                                <input type="hidden" name="idpaksi" value="<?=$idud;?>">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editdetail">
                                 Edit
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>No Telpon</th>
                                                <th>Alamat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th><?=$idud;?></th>
                                                <th><?=$nama;?></th>
                                                <th><?=$ktp;?></th>
                                                <th><?=$telpon;?></th>
                                                <th><?=$addr;?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Jumlah Saat ini</th>
                                                <th>Total Keseluruhan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Rp. <?=number_format($jumlahdetail, 0, ',','.');?>,-</th>
                                                <th>Rp. <?=number_format($sumdetail, 0, ',','.');?>,-</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--Tabel untuk tambahan-->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h2>List Peminjaman</h2>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahanpinjam">
                                 Input Peminjaman Tambahan
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    $i = 1;
                                                    while($tambahandetailfetch = mysqli_fetch_array($tariktambahandetail)){
                                                        $idtd = $tambahandetailfetch['idtambahan'];
                                                        $jumtd = $tambahandetailfetch['jumlahtambahan'];
                                                        $statustd = $tambahandetailfetch['status'];
                                                        $tgltd = $tambahandetailfetch['tanggaltambahan'];
                                                        $menjaditd = $tambahandetailfetch['jumlahmenjadi'];
                                                ?>
                                                <td>
                                                    <?=$i++;?>
                                                </td>
                                                <td>
                                                    <?=$nama;?>
                                                </td>
                                                <td>
                                                    Rp. <?=number_format($jumtd, 0, ',','.');?>,-
                                                </td>
                                                <td>
                                                    <?=$statustd;?>
                                                </td>
                                                <td>
                                                    <?=$tgltd;?>
                                                </td>
                                                <td>
                                                <form method="get" action="kwitansitambahan.php">
                                                    <input type="hidden" name="printid" value="<?=$idtd;?>">
                                                    <input type="hidden" name="printidu" value="<?=$idud;?>">
                                                    <input type="hidden" name="printnama" value="<?=$nama;?>">
                                                    <input type="hidden" name="printkeseluruhan" value="<?=number_format($sumdetail, 0, ',','.');?>">
                                                    <input type="hidden" name="printtambahan" value="<?=number_format($jumtd, 0, ',','.');?>">
                                                    <input type="hidden" name="printmenjadi" value="<?=number_format($menjaditd, 0, ',','.');?>">
                                                    <input type="hidden" name="printtanggal" value="<?=$tgltd;?>">
                                                    <input type="hidden" name="namaadmin" value="<?=$namaadmin;?>">
                                                    <button type="submit" class="btn btn-primary" name="printdatatambahan">Cetak Kwitansi</button>
                                                </form>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deletetambahan<?=$idtd;?>">Hapus</button>                                            
                                                </td>
                                                </tr>
                                                <div class="modal fade" id="deletetambahan<?=$idtd;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <h5>Apakah anda yakin data masuk sebesar <?=number_format($jumtd, 0, ',','.');?> dihapus?</h5>
                                                            <input type="hidden" name="idc" value="<?=$idtd;?>">
                                                            <input type="hidden" name="jumlahtambahan" value="<?=$jumtd;?>">
                                                            <input type="hidden" name="idus" value="<?=$idud;?>">

                                                            <input type="hidden" name="iddetail" value="<?=$idud;?>">
                                                            <input type="hidden" name="namadetail" value="<?=$nama;?>">
                                                            <input type="hidden" name="ktpdetail" value="<?=$ktp;?>">
                                                            <input type="hidden" name="telpdetail" value="<?=$telpon;?>">
                                                            <input type="hidden" name="addrdetail" value="<?=$addr;?>">
                                                            <input type="hidden" name="jmldetail" value="<?=$jumlahdetail;?>">
                                                            <input type="hidden" name="sumdetail" value="<?=$sumdetail;?>">

                                                            <button type="submit" class="btn btn-danger" name="deletetambahandetail">Hapus</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!--Tabel untuk cicilan-->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h2>List Pembayaran Cicilan</h2>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cicilanbaru">
                                 Bayar Cicilan
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th>Jumlah Setelah Pembayaran</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    $i = 1;
                                                    while($cicilandetailfetch = mysqli_fetch_array($tarikcicilandetail)){
                                                        $idcd = $cicilandetailfetch['idmasuk'];
                                                        $jumcd = $cicilandetailfetch['jumlahmasuk'];
                                                        $menjadicd = $cicilandetailfetch['sisacicilan'];
                                                        $tglcd = $cicilandetailfetch['tanggalmasuk'];
                                                        $statuscicilan = $cicilandetailfetch['statuscicilan'];
                                                ?>
                                                <td>
                                                    <?=$i++;?>
                                                </td>
                                                <td>
                                                    <?=$nama;?>
                                                </td>
                                                <td>
                                                    Rp. <?=number_format($jumcd, 0, ',','.');?>,-
                                                </td>
                                                <td>
                                                    Rp. <?=number_format($menjadicd, 0, ',','.');?>,-
                                                </td>
                                                <td>
                                                    <?=$tglcd;?>
                                                </td>
                                                <td>
                                                <form method="get" action="kwitansi.php">
                                                        <input type="hidden" name="printid" value="<?=$idcd;?>">
                                                        <input type="hidden" name="printidu" value="<?=$idud;?>">
                                                        <input type="hidden" name="printnama" value="<?=$nama;?>">
                                                        <input type="hidden" name="printkeseluruhan" value="<?=number_format($sumdetail, 0, ',','.');?>">
                                                        <input type="hidden" name="printcicil" value="<?=number_format($jumcd, 0, ',','.');?>">
                                                        <input type="hidden" name="printsisa" value="<?=number_format($menjadicd, 0, ',','.');?>">
                                                        <input type="hidden" name="printstatus" value="<?=$statuscicilan;?>">
                                                        <input type="hidden" name="printtanggal" value="<?=$tglcd;?>">
                                                        <input type="hidden" name="namaadmin" value="<?=$namaadmin;?>">
                                                        <button type="submit" class="btn btn-primary" name="printdata">Cetak Kwitansi</button>
                                                </form>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deletecicilan<?=$idcd;?>">Hapus</button>
                                                </td>
                                                </tr>
                                                <div class="modal fade" id="deletecicilan<?=$idcd;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <h5>Apakah anda yakin data cicilan sebesar <?=number_format($jumcd, 0, ',','.');?> dihapus?</h5>
                                                            <input type="hidden" name="idc" value="<?=$idcd;?>">
                                                            <input type="hidden" name="jumlahmasuk" value="<?=$jumcd;?>">
                                                            <input type="hidden" name="idus" value="<?=$idud;?>">
                                                            <input type="hidden" name="iddetail" value="<?=$idud;?>">
                                                            <input type="hidden" name="namadetail" value="<?=$nama;?>">
                                                            <input type="hidden" name="ktpdetail" value="<?=$ktp;?>">
                                                            <input type="hidden" name="telpdetail" value="<?=$telpon;?>">
                                                            <input type="hidden" name="addrdetail" value="<?=$addr;?>">
                                                            <input type="hidden" name="jmldetail" value="<?=$jumlahdetail;?>">
                                                            <input type="hidden" name="sumdetail" value="<?=$sumdetail;?>">
                                                            <button type="submit" class="btn btn-danger" name="deletecicilandetail">Hapus</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.js"></script>
        <!--<script src="js/select2.min.js"></script>-->
        <!--<script src="js/select-pt-stimulan.js"></script>-->
        <script>
            
            // When ready.
            $(function() {
                
                
                var $form = $( "#form" );
                var $input = $form.find( "input" );

                $input.on( "keyup", function( event ) {
                    
                    
                    // When user select text in the document, also abort.
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }
                    
                    // When the arrow keys are pressed, abort.
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                        return;
                    }
                    
                    
                    var $this = $( this );
                    
                    // Get the value.
                    var input = $this.val();
                    
                    var input = input.replace(/[\D\s\._\-]+/g, "");
                            input = input ? parseInt( input, 10 ) : 0;

                            $this.val( function() {
                                return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                            } );
                } );
                
                //When Form Submitted
                $form.on( "submit", function( event ) {
                    
                    var $this = $( this );
                    var arr = $this.serializeArray();
                        arr = arr.replace(/[^0-9\.]+/g, "");
                
                    for (var i = 0; i < arr.length; i++) {
                            arr[i].value = arr[i].value.replace(/\D/g, ''); // Sanitize the values.
                    };
                    
                    console.log( arr );
                    
                    event.preventDefault();
                });
                
            });
        </script>       

        <script>
            
            // When ready.
            $(function() {
                
                
                var $form = $( "#form1" );
                var $input = $form.find( "input" );

                $input.on( "keyup", function( event ) {
                    
                    
                    // When user select text in the document, also abort.
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }
                    
                    // When the arrow keys are pressed, abort.
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                        return;
                    }
                    
                    
                    var $this = $( this );
                    
                    // Get the value.
                    var input = $this.val();
                    
                    var input = input.replace(/[\D\s\._\-]+/g, "");
                            input = input ? parseInt( input, 10 ) : 0;

                            $this.val( function() {
                                return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                            } );
                } );
                
                //When Form Submitted
                $form.on( "submit", function( event ) {
                    
                    var $this = $( this );
                    var arr = $this.serializeArray();
                        arr = arr.replace(/[^0-9\.]+/g, "");
                
                    for (var i = 0; i < arr.length; i++) {
                            arr[i].value = arr[i].value.replace(/\D/g, ''); // Sanitize the values.
                    };
                    
                    console.log( arr );
                    
                    event.preventDefault();
                });
                
            });
        </script>

        <script>
            
            // When ready.
            $(function() {
                
                
                var $form = $( "#edit1" );
                var $input = $form.find( "input" );

                $input.on( "keyup", function( event ) {
                    
                    
                    // When user select text in the document, also abort.
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }
                    
                    // When the arrow keys are pressed, abort.
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                        return;
                    }
                    
                    
                    var $this = $( this );
                    
                    // Get the value.
                    var input = $this.val();
                    
                    var input = input.replace(/[\D\s\._\-]+/g, "");
                            input = input ? parseInt( input, 10 ) : 0;

                            $this.val( function() {
                                return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                            } );
                } );
                
                //When Form Submitted
                $form.on( "submit", function( event ) {
                    
                    var $this = $( this );
                    var arr = $this.serializeArray();
                        arr = arr.replace(/[^0-9\.]+/g, "");
                
                    for (var i = 0; i < arr.length; i++) {
                            arr[i].value = arr[i].value.replace(/\D/g, ''); // Sanitize the values.
                    };
                    
                    console.log( arr );
                    
                    event.preventDefault();
                });
                
            });
        </script>
        
        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

        <div class="modal fade" id="editdetail">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                    <!-- Modal body -->
                    <form method="post" novalidate>
                    <div class="modal-body">
                        <input type="hidden" name="ide" style="color:#fffff" value="<?=$idud;?>">
                        <h5>NIK</h5>
                        <input type="text" name="nikedit" value="<?=$ktp;?>" class="form-control" required>
                        <br>
                        <h5>Nama</h5>
                        <input type="text" name="namaedit" value="<?=$nama;?>" class="form-control" required>
                        <br>
                        <h5>Alamat</h5>
                        <input type="text" name="alamatedit" value="<?=$addr;?>" class="form-control" required>
                        <br>
                        <h5>No HP</h5>
                        <input type="number" name="telpedit" value="<?=$telpon;?>" class="form-control" required>
                        <br>
                        <h5>Jumlah</h5>
                        <div id="edit1">
                        <input type="text" name="jumlahedit" value="<?=number_format($jumlahdetail);?>" class="form-control" required>
                        <br>
                        </div>
                        <input type="hidden" name="jumlahsaatini" value="<?=$jumlahdetail;?>">
                        <input type="hidden" name="totalsaatini" value="<?=$sumdetail;?>">
                        <button type="submit" class="btn btn-warning" name="editdata">Edit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cicilanbaru">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Bayar Cicilan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form id="form" method="post">
                <div class="modal-body">
                    <input type="hidden" name="cicilannya" value="<?=$idud;?>">
                    <h5>Tagihan</h5>
                    <h6>Rp.<?=number_format($jumlahdetail, 0, ',','.');?>,-</h6>
                    <h5>Jumlah</h5>
                    <input type="text" name="jumlahcicil" placeholder="Jumlah Pembayaran Cicilan" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-success" name="bayarcicil">Masukkan Cicilan</button>
                </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="tambahanpinjam">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Peminjaman</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form id="form1" method="post">
                <div class="modal-body">
                    <input type="hidden" name="tambahannya" value="<?=$idud;?>">
                    <h5>Tagihan</h5>
                    <h6>Rp.<?=number_format($jumlahdetail, 0, ',','.');?>,-</h6>
                    <h5>Jumlah</h5>
                    <input type="text" name="jumlahtambahan" placeholder="Jumlah Tambahan Peminjaman" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-success" name="tambahpinjam">Masukkan Tambahan</button>
                </div>
                </form>
                </div>
            </div>
        </div>        

    </body>
</php>
