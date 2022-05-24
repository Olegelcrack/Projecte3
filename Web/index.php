<?php 
    include_once 'header.php';
?>

        <nav id="nav_portada">
            <a href="tots_productes.php">Tots Productes</a>
            <a href="prediccio_temps.html">Predicció de temps del dia</a>
        </nav>
        <main id="portada">

            <section class="categories">
                <article><!-- categories -->
                    <a onclick="check_esquis()">    <!-- ens tira a una funcio que ens adresa a tots productes ficant un check a les filtres -->
                        <img src="Img/Cat_Esqui.jpeg" alt="Cat_Esquis"/>
                        <h3>Esqui</h3>
                    </a>
                    <h4>Descubreix el catalog d'esquis, i compra l'esquis a millor preu!</h4>
                </article>
                <article>
                    <a onclick="check_botes()">
                        <img src="Img/Cat_Botes.png" alt="Cat_Botes" />
                        <h3>Botes</h3>
                    </a>
                    <h4>Descubreix el catalog de les botes, i compra les botes a millor preu!</h4>
                </article>
                <article>
                    <a onclick="check_pals()">
                        <img src="Img/Cat_Pals.png" alt="Cat_Pals" />
                        <h3>Pals</h3>
                    </a>
                    <h4>Descubreix el catalog dels pals, i compra els pals a millor preu!</h4>
                </article>
                
            </section>
            <h2 id="productes_titol">NOSTRES PRODUCTES</h2>
            <section class="productes"><!-- productes -->
                <article><!-- productes -->
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        <?php

                            $sql = "SELECT * FROM producte WHERE disponible=1 AND estat=1 AND num_usos<1 ORDER BY num_usos;";   //Consulta perque ens agafi sol els productes nous
                            $result = mysqli_query($conn, $sql);
                        
                            if(mysqli_num_rows($result) !=0){
                                $row = mysqli_fetch_assoc($result);

                                foreach($result as $row){

                        ?>

                                    <div class="item producte">     <!-- Aquesta part s'ensenyara tants cops que linies que obtenim de consulta -->
                                        <div class="producte_img_conteiner">
                                            <?php echo "<img src='".$row['imatge']."' alt='img_Producte' class='imatge_producte'>" ?>
                                        </div>
                                        <div class="producte_desc_conteiner">
                                            <h3 class="nom_producte"><?= $row['nom']; ?></h3>
                                            <p>Marca: </p><p class="marca_producte"> <?= $row['marca']; ?></p>
                                            <p class="preu_producte" id="preu"><?= $row['preu']; ?>€</p>
                                        </div>
                                        <input type="button" value="Afegir al carrito" class="carrito" onclick="Boto_afegir_carito()" /> <!-- boto per afegir al carrito el producte, i tambe obrir el carrito automaticament -->
                                    </div>

                        <?php
                        
                                }
                            }

                        ?>
                    </div>
                </article>
            </section>
        </main>

<?php
    include_once 'footer.php';
?>