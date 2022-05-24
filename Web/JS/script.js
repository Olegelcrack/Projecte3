/*    Carrito     */

function Carrito_container(){
  document.getElementById("car_cont").classList.toggle("mostrar_car");  // Al fer clic a la icona de carrito ens surt el carrito, al fer un altre clic s'amague
  carregarDades();
}

function Boto_afegir_carito(){
  if(document.getElementById("car_cont").classList.contains("mostrar_car_fixed")){  // Al fer clic al boto de afegir al carrito se'ns obrira el carrito, al fer un altre clic dira que el carrito ja esta obert i no fara res mes que afegir el producte

  }
  else{
    document.getElementById("car_cont").classList.toggle("mostrar_car_fixed");
    grabarDades();
  }
}

let carritoProductes = []; // arrays per productes, i preu
let arrayProductes = [];
let totalPreu = [];

document.addEventListener('DOMContentLoaded', grabarDades);

function grabarDades(){
  
  if(localStorage.length>0){  // si el carrito ja te alguna dada ens la ensenyara
    carregarDades();
}

  let BtnsComprar = document.querySelectorAll('.carrito');

  let myJSON;
  
  for(i=0; i < BtnsComprar.length; i++){
    let producte = {};
    BtnsComprar[i].addEventListener('click', (e)=>{     // Al fer clic al boto de compra ens afegira els dades del material a localStorage
      
      producte.imatge = e.target.parentElement.querySelector('.imatge_producte').src;
      
      if(carritoProductes.find(article => article.imatge == producte.imatge)){
        producte.quantitat++;
      }else{
        producte.nom = e.target.parentElement.querySelector('.nom_producte').innerText;
        producte.marca = e.target.parentElement.querySelector('.marca_producte').innerText;
        producte.preu = e.target.parentElement.querySelector('.preu_producte').innerText;
        producte.quantitat = 1;

        carritoProductes.push(producte)
      }

      myJSON = JSON.stringify(carritoProductes);
      localStorage.setItem('compra', myJSON);
      carregarDades();
    })
  }
}

function carregarDades(){
   
  let clau;
  let info;
  totalPreu = [];

  document.getElementById('car').innerHTML="";

  if(localStorage.length>0){    //    Del localStorage carreguem les dades a una array, i des de alli mostrem tot en nostra pagina
      clau = localStorage.key(0);
      info = localStorage.getItem(clau);
      
  
      arrayProductes = JSON.parse(info);
      
      for(i=0; i<arrayProductes.length; i++){
        
          let quantitatLinia = parseInt(arrayProductes[i].quantitat);   // agafem la quantitat de cada linia, convertim la variable a Int
          let preuLinia = parseFloat(arrayProductes[i].preu);           // agafem el preu de cada linia, convertim a Float
          let totalLinia = quantitatLinia*preuLinia;    // fem la multiplicacio per obtindre el total de cada linia
          let totalLiniaFx = totalLinia.toFixed(2);     // posem aixo perque en la variable float ens fica nomes 2 decimals
          totalPreu[i] = totalLinia;

          document.getElementById("car").innerHTML += `<div class='articleCompra'>
                                                              <img src="${arrayProductes[i].imatge}" alt="imatge">
                                                              <p id="nom_prod_cart">${arrayProductes[i].nom}</p>
                                                              <p>${arrayProductes[i].preu}</p>
                                                              <p>${arrayProductes[i].quantitat}</p>
                                                              <p>${totalLiniaFx/*Aqui mostrem el total de cada linia*/}€</p>
                                                              <input type="button" class="carr_del" value="X" onclick="esborrarItem(${i})" />
                                                          </div>`;    
      }

      let SumaTotalPreu = 0;

      for (let i = 0; i < totalPreu.length; i++) { // fem un bucle per contar cada linia total per cada linia que hi ha, per obtindre la suma del preu total
        SumaTotalPreu += totalPreu[i];
      }
      SumaTotalPreu = SumaTotalPreu.toFixed(2);

      document.getElementById("preu_total").innerHTML =`<p class="preu_total">Total: ${SumaTotalPreu}€</p>`; //mostrem el nostre total al preu_total
  }
}

function borrarDades(){ // funcio per esborra dades del carrito, esborrem tot d'arrays, de localstorage i tornem a carregar-ho per actualitzar el carrito
  if(confirm("Estas segur que vols esborrar?")){
      carritoProductes = [];
      totalPreu = [];
      SumaTotalPreu=0;
      document.getElementById("preu_total").innerHTML =`<p class="preu_total">Total: ${SumaTotalPreu}€</p>`;
      localStorage.clear();
      carregarDades();
  }
}

function esborrarItem(id){  //funcio per borra sol un producte
  totalPreu[id] = 0;
  carritoProductes.splice(id, 1);
  localStorage.setItem("compra", JSON.stringify(carritoProductes));
  carregarDades();
}

/*    Productes Scroll Carousel    */

$(document).ready(function() {  //Aqui modifiquem una dels opcio de efecto caruosel, aixo fara que ens ensenyi les fletxes
 
  $("#owl-demo").owlCarousel({
    navigation : true
  });
 
});

/*    Desplegable opcions d'usuari    */

function Desplega(){
  document.getElementById("opcions").classList.toggle("mostrar_opcio");
}

window.onclick = function(event){ /*  al clica la pantalla ens fara funcio event*/
  if (!event.target.matches('.boto')) {  /*  Si qualsevol cosa de la pantalla, menos element asignat(de classe boto), es clicara */
    if(!event.target.matches('.opcio_usuari')){
      var dropdowns = document.getElementsByClassName("opcio_usuari");  /*  indiquem com es diuen elements  */
      var i;
      for (i = 0; i < dropdowns.length; i++) {  /*  Aqui fem un bucle que sempre que conte el mostra opcio l'element actual, es borra.*/
        var openDropdown = dropdowns[i];        /*  El mostrar_opcio ere el que feia que l'element sigui visible com que el borrem, l'element no s'ensenya mes  */
        if (openDropdown.classList.contains('mostrar_opcio')) {
          openDropdown.classList.remove('mostrar_opcio');
        }
      }
    }
  }
  if (!event.target.matches('.boto_car')) {         // Aqui estem fent la mateixa cosa que abans, pero indicant mes elements que al clica no amagui el desplegable
    if (!event.target.matches('.productes_carrito')) {
      if (!event.target.matches('.productes_carrito *')) {
        if (!event.target.matches('.carr_del')) {
          var dropdowns = document.getElementsByClassName("productes_carrito");  
          var i;
          for (i = 0; i < dropdowns.length; i++) {  
            var openDropdown = dropdowns[i];        
            if (openDropdown.classList.contains('mostrar_car')) {
              openDropdown.classList.remove('mostrar_car');
            }
          }
        }
      }
    }
  }
  if (!event.target.matches('.carrito')) {
    if (!event.target.matches('.productes_carrito')) {
      if (!event.target.matches('.productes_carrito *')) {
        if (!event.target.matches('.carr_del')) {
          var dropdowns = document.getElementsByClassName("productes_carrito");  
          var i;
          for (i = 0; i < dropdowns.length; i++) {  
            var openDropdown = dropdowns[i];        
            if (openDropdown.classList.contains('mostrar_car_fixed')) {
              openDropdown.classList.remove('mostrar_car_fixed');
            }
          }
        }
      }
    }
  }
}

/*    Filtrar     */

function check_esquis(){ // funcio que ens envia a tots productes ficant el check1
  window.location.href = "tots_productes.php?chk=1"
}

function check_botes(){ // funcio que ens envia a tots productes ficant el check2
  window.location.href = "tots_productes.php?chk=2"
}

function check_pals(){ // funcio que ens envia a tots productes ficant el check3
  window.location.href = "tots_productes.php?chk=3"
}

/*  Camps Addicionals   */

function removeAdd(){ // funcio per eliminar camps addicionals
  document.getElementById("federat").classList.remove('mostrar_camp');
  document.getElementById("familiaNombrosa").classList.remove('mostrar_camp');
}

function familiaN(){ // funcio que amaga les camps de federat i posar els de familiar
  if(document.getElementById("federat").classList.contains("mostrar_camp")){
    document.getElementById("federat").classList.remove('mostrar_camp');
  }
  document.getElementById("familiaNombrosa").classList.toggle("mostrar_camp");
}

function federat(){ // funcio que amaga les camps de familiar i posar els de federat
  if(document.getElementById("familiaNombrosa").classList.contains("mostrar_camp")){
    document.getElementById("familiaNombrosa").classList.remove('mostrar_camp');
  }
  document.getElementById("federat").classList.toggle("mostrar_camp");
}