<?php
    require '../config/database.php';
    require '../config/config1.php';
    
    $db = new Conexion();
    $con = $db->pdo;

    if(isset($_SESSION['id'])){

    }

    $sql = $con->prepare("SELECT * FROM products WHERE active=1 ORDER BY idCategory");
    $sql->execute();
    //fetch devuelve las filas de la consulta PDO::FETCH_ASSOC etiqueta por el nombre de la columna
    $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

    #session_destroy();
?>

<?php include "../layouts/head.php"; ?>

<body>
<?php include "../layouts/navbar.php"; 
    ?>
<main>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Example headline.</h1>
                        <p>Some representative placeholder content for the first slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Some representative placeholder content for the second slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>One more for good measure.</h1>
                        <p>Some representative placeholder content for the third slide of this carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

    <!-- Three columns of text below the carousel -->
        
        <div class="row">
            <div class="col-lg-4">
                <img src="../img/productos/1/polera 1/principal.jpg" alt="polera" class="bd-placeholder-img rounder-circle" width="140"  focusable="false">
                <h2 class="fw-normal">Casacas/poleras</h2>
                <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
                <p><a class="btn btn-secondary" href="#">Ver &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
            <img class="bd-placeholder-img rounder-circle" src="../img/productos/2/jean 1/principal.jpg" alt="jeans" width="140" focusable="false">
                <h2 class="fw-normal">Pantalones</h2>
                <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p>
                <p><a class="btn btn-secondary" href="#">Ver &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
            <img class="bd-placeholder-img rounder-circle" src="../img/productos/3/zapatilla 1/principal.jpg" alt="jeans" width="140" focusable="false">                
                <h2 class="fw-normal">Zapatillas</h2>
                <p>And lastly this, the third column of representative placeholder content.</p>
                <p><a class="btn btn-secondary" href="#">Ver &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->




    <!-- START THE FEATURETTES -->
        <hr class="featurette-divider">
        <?php 
        include '../vistas/catalogo.php';
        ?>
        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


  <!-- FOOTER -->
    <?php include '../layouts/footer.php'; ?>
</main>
    
</body>
</html>