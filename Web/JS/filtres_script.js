var form = document.getElementById('filter-form'); //indiquem el formulari

var url = window.location.href.split("?"); //agafem la nostra url borran el ?

if(url[1].toLowerCase().includes("chk=1")){   // revisem, si la url es 1 ens marca l'opcio 1
  document.getElementById(1).checked =true;
  Filtrar();
}
if(url[1].toLowerCase().includes("chk=2")){   // revisem, si la url es 2 ens marca l'opcio 2
  document.getElementById(2).checked =true;
  Filtrar();
}
if(url[1].toLowerCase().includes("chk=3")){   // revisem, si la url es 3 ens marca l'opcio 3
  document.getElementById(3).checked =true;
  Filtrar();
}

/*    Filtrar     */
    
function Filtrar(){

  var categories = [];
      
  form.querySelectorAll('input').forEach(function (input) {   //Al marca un filtre apunta el nom del filtre a l'array
    if(input.type === 'checkbox' && input.checked) {
      categories.push(input.value);
    }
  })
            
  filtrarProductes(categories);
}
      
function filtrarProductes(categories) {
  var x, i;
  x = document.getElementsByClassName("producte_conteiner");
        
  if (categories.length != 0) {   // ens amagara les productes que tenen la categoria diferent de la que hem marcat
    for (let i = 0; i < x.length; i++) {
      for (let n = 0; n < categories.length; n++) {
        if (!categories.includes(x[i].classList[1])) {
      
          x[i].classList.add("ocult");
      
        } else {
      
          x[i].classList.remove("ocult");
      
        }
      }
    }
  } else {    // si no ens troba cap categoria marcada ens torna a ensenya tots els productes
    for (let i = 0; i < x.length; i++) {
      
      x[i].classList.remove("ocult");
      
    }
  }
}