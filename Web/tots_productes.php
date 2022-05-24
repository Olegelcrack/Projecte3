<?php 
    include_once 'header.php';
?>
        <nav id="def">
            <a href="Tots_Productes.php">Tots Productes</a>
            <a href="Prediccio_temps.html">Predicció de temps del dia</a>
        </nav>
        <main id="tots_productes">
            <div class="filtres">
                <form method="POST" name="filtrar" id="filter-form" onchange="Filtrar()">   <!-- formulari per filtres -->
                    <input type="checkbox" name="" id="1" value="Esquis" class="checkbox">Esquis
                    <br/>
                    <input type="checkbox" name="" id="2" value="Botes" class="checkbox">Botes
                    <br/>
                    <input type="checkbox" name="" id="3" value="Pals" class="checkbox">Pals
                    <br/>
                    <input type="checkbox" name="" id="4" value="Casco" class="checkbox">Cascos
                </form>
            </div>
            <div class="llistaProductes">

                <?php
                    $sql = "SELECT * FROM producte WHERE disponible=1 AND estat=1";     // creem una consulta 
                    $result = mysqli_query($conn, $sql);        // la tirem a la bd 

                    if(mysqli_num_rows($result) !=0){   // si numero columnes es inferior a 0
                        $row = mysqli_fetch_assoc($result); // cada linia ens guarda com a row

                        foreach($result as $row){   // un bucle on ens va llegint les linies fins que s'acabin
                            $categoria = explode(' ', trim($row['nom']))[0]; // Aqui tallem la primera paraula del nom producte, d'aquesta manera ens el guardara com a variable
                ?>
                            <div class="producte_conteiner <?= $categoria?>">   <!-- la posem aqui perque ens agafi la primera paraula com a classe, ho fem per el js de filtres-->
                                <div class="producte_img_conteiner">
                                    <?php echo "<img src='".$row['imatge']."' class='imatge_producte'>" ?> <!-- Ensenyem tots els linies necessaris que hem tret de consulta -->
                                </div>
                                <div class="producte_desc_conteiner">
                                    <h3 class="nom_producte"><?= $row['nom']; ?></h3>
                                    <p>Marca: </p><p class="marca_producte"><?= $row['marca']; ?></p>
                                    <p>Numero usos: <?= $row['num_usos']; ?></p>
                                    <p class="preu_producte" id="preu"><?= $row['preu']; ?>€</p>
                                </div>
                                <input type="button" value="Afegir al carrito" class="carrito" onclick="Boto_afegir_carito()"/>
                            </div>
                <?php
                        }
                    }else{  // si no ens surt cap columna ens donara l'avis de que no hi han productes
                        $noprd = 'No hi han productes disponibles';
                        echo $noprd;
                    }
                ?>
            </div>
        </main>
        <script src="JS/filtres_script.js"></script> <!-- script de filtrar productes -->
<?php
    include_once 'footer.php';
?>