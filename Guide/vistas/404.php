
<?php

    require '../config/config1.php';
    include "../layouts/head.php";?>

<body id="page-top">
<?php include "../layouts/navbar.php";?>
<br><br><br><br><br>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <h2 class="error mx-auto" data-text="404">404</h2>
                        <p class="lead text-gray-800 mb-5">Página no encontrada</p>
                        <p class="text-gray-500 mb-0">Parece que tenemos o tienes probles :/ ...</p>
                        <a href="../index.php">&larr; Atrás en la página de inicio</a>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "../layouts/navbar.php";?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "../layouts/footer.php";?>

</body>


</html>