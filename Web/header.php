<?php
    session_start();                    /*Comanda per iniciar o continua la sessio ja iniciada*/
    include 'includes/Con_DB.inc.php';  // importem el php amb connexio a bd
?>

<!DOCTYPE html>         <!-- Aquest header s'afegira a cada pagina php de la web, llavors les links i imports de php tambe es faran a cada pagina -->
<html lang="ca">
    <head>
        <meta charset="UTF-8" />
        <title>iCanSki</title>

        <link rel="stylesheet" href="Estils/owl.carousel.css"> <!-- Estils per efecte carousel, fara que pugui pasar imatge d'un costat a l'altre -->

        <link rel="stylesheet" href="Estils/index_estil.css">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">       <!-- GOOGLE ICONS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        

        <link rel="preconnect" href="https://fonts.googleapis.com">     <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400&display=swap" rel="stylesheet">
        
        <script src="JS/jquery-1.9.1.min.js"></script> <!-- Scripts de efecto carousel, per fer un slider d'imatges -->
        <script src="JS/owl.carousel.js"></script> 
        <script src="JS/script.js"></script>
    </head>
    <body>
        <header id="header">
            <div class="logo">
                <a href="index.php"><img src="Img/nuevo.png" alt="logo_empresa"/></a>
            </div>
            <div class="icones">
                <?php

                    if(isset($_SESSION["usuari"])){     // comprovacio si hem entrat a la sessio, si es veritat ens ensenya unes icones diferentes

                ?>
                        <div class="perfil" onclick="Desplega()">   <!-- al clic ens tira a funcio per deplega un menu-->
                            <span class="material-symbols-outlined boto">account_circle</span>

                            <?php
            
                                echo "<p class="."boto".">" . $_SESSION["nom"] . " " . $_SESSION["cognom"] . "</p>";
                            
                            ?>
                        </div>
                        <div class="opcio_usuari" id="opcions"> <!-- Desplegable -->
                                <a href="dades_usuari.php">Meves dades</a>
                                <a href="cursos_llogats.php">Cursos llogats</a>
                                <a href="material_llogat.php">Material llogat</a>
                        </div>
                        <a href="includes/logout.inc.php">
                            <div class="logout">
                                <span class="material-symbols-outlined">logout</span><p>Sortir</p>
                            </div>
                        </a>
                <?php

                    }
                    else{       // icoba per entrar a la sessio, si entrem desapareix

                ?>
                        <div class="login">
                            <a href="login.php"><span class="material-icons-outlined">login</span><p>Iniciar Sessió</p></a>
                        </div>
                <?php

                    }

                ?>
                <div class="carrito" onclick="Carrito_container()">     <!-- ens tira a la funcio per desplega el carrito -->
                    <span class="material-icons-outlined boto_car">shopping_cart</span>
                    <p class="boto_car">Carrito</p>
                </div>
                <div class="productes_carrito" id="car_cont">
                    <form action="header.php" method="POST">
                        <ul>
                            <li>Nom</li>
                            <li>Preu</li>
                            <li>Quant</li>
                            <li>Sum</li>
                        </ul>
                        <div id="car">
                        </div>
                        <div id="preu_total"></div>
                        <input type="button" class="boto_borrarTot" value="Borrar tot" onclick="borrarDades()"/>
                        <input type="submit" class="boto_realitzarCompra" value="Realitzar Compra"/>
                    </form>
                </div>
            </div>
        </header>
        <div class="header_backside"></div>