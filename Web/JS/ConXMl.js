document.addEventListener("DOMContentLoaded", iniciar);

function iniciar(){ // Al iniciar ens connectem amb un XML

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        
        //console.log(`readyState: ${this.readyState} <br>status: ${this.status} `);
        
        if (this.readyState == 4 && this.status == 200) {
            myFunction(this);
        }
    };
    xhttp.open("GET", "https://static-m.meteo.cat/content/opendata/ctermini_comarcal.xml", true);
    xhttp.send();
}


function myFunction(xml) {
    var xmlDoc = xml.responseXML;

    var XMLData_con = xmlDoc.getElementsByTagName("smc");
    var Data_con = document.getElementById("Data_con");

    Data_con.innerHTML += `<p>Data Creació de Consulta: <b>${XMLData_con[0].getAttribute("datacreacio")}</b><p>`;       // visualitzar la data de creacio de la consulta
    

    var Contenidor = document.getElementById("Conteiner");      // aixo es el lloc on col·loquem les dades del temps
    var contPr=0;
    var contCal=0;

    let arrayComarques = xmlDoc.getElementsByTagName("comarca");        // Gravem cada elements necessaris com a nova array
    let prediccions = xmlDoc.getElementsByTagName("prediccio");
    let precipitacions = xmlDoc.getElementsByTagName("precipitacio");
    let calamarsa = xmlDoc.getElementsByTagName("calamarsa");

    for(i=0; i<arrayComarques.length; i++){ //si la comarca es una dels 5 ficats ens entrar al bucle 
        if(arrayComarques[i].getAttribute("nomCOMARCA")=="L'Alt Urgell" || arrayComarques[i].getAttribute("nomCOMARCA")=="L'Alta Ribagorça" || arrayComarques[i].getAttribute("nomCOMARCA")=="La Cerdanya" || arrayComarques[i].getAttribute("nomCOMARCA")=="El Pallars Sobirà" || arrayComarques[i].getAttribute("nomCOMARCA")=="La Val d'Aran"){
            var prMati=0;
            var prTarda=0;
            var prMati1=0;
            var prTarda1=0;

            var calMati=0;
            var calTarda=0;
            var calMati1=0;
            var calTarda1=0;
            
            let variable = prediccions[i].getElementsByTagName("variable"); // agafem les variables de cada prediccions de cada comarca

            for(contPr=0;contPr<precipitacions.length;contPr++){ // fem revisio del nom de precipitacio, els apuntem a les variables de diferents dies per mostra despres 
                if(variable[0].getAttribute("probprecipitaciomati")==precipitacions[contPr].getAttribute("id")){
                    prMati = precipitacions[contPr].getAttribute("nomprobprecipitaciomati");
                }
                if(variable[0].getAttribute("probprecipitaciotarda")==precipitacions[contPr].getAttribute("id")){
                    prTarda = precipitacions[contPr].getAttribute("nomprobprecipitaciotarda");
                }
                if(variable[1].getAttribute("probprecipitaciomati")==precipitacions[contPr].getAttribute("id")){
                    prMati1 = precipitacions[contPr].getAttribute("nomprobprecipitaciomati");
                }
                if(variable[1].getAttribute("probprecipitaciotarda")==precipitacions[contPr].getAttribute("id")){
                    prTarda1 = precipitacions[contPr].getAttribute("nomprobprecipitaciotarda");
                }
            }

            for(contCal=0;contCal<calamarsa.length;contCal++){ // fem revisio del nom de calamarsa
                if(variable[0].getAttribute("probcalamati")==calamarsa[contCal].getAttribute("id")){
                    calMati = calamarsa[contCal].getAttribute("nomprobcalamati");
                }
                if(variable[0].getAttribute("probcalatarda")==calamarsa[contCal].getAttribute("id")){
                    calTarda = calamarsa[contCal].getAttribute("nomprobcalatarda");
                }
                if(variable[1].getAttribute("probcalamati")==calamarsa[contCal].getAttribute("id")){
                    calMati1 = calamarsa[contCal].getAttribute("nomprobcalamati");
                }
                if(variable[1].getAttribute("probcalatarda")==calamarsa[contCal].getAttribute("id")){
                    calTarda1 = calamarsa[contCal].getAttribute("nomprobcalatarda");
                }
            }
            //aqui inserim els conteiners de cada comarca amb les dades que hem cridat
            Contenidor.innerHTML += `   <div class="weather_cont">
                                            <div class="image">
                                                <div id="si" class="primer">
                                                    <h3>${arrayComarques[i].getAttribute("nomCOMARCA")} ${arrayComarques[i].getAttribute("nomCAPITALCO")}</h3>
                                                    <br />
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <h2 id="temp">${variable[0].getAttribute("tempmin")}º - ${variable[0].getAttribute("tempmax")}</h2>
                                                                <p>${variable[0].getAttribute("data")}</p>
                                                            </td>
                                                            <td>
                                                                <img src="https://static-m.meteo.cat/assets-w3/images/meteors/estatcel/${variable[0].getAttribute("simbolmati")}"/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="segon">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <h2 id="temp">${variable[1].getAttribute("tempmin")}º - ${variable[1].getAttribute("tempmax")}</h2>
                                                                <p>${variable[1].getAttribute("data")}</p>
                                                            </td>
                                                            <td>
                                                                <img src="https://static-m.meteo.cat/assets-w3/images/meteors/estatcel/${variable[1].getAttribute("simbolmati")}"/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="desc">
                                                <div class="primer">
                                                    <table>
                                                        <tr class="titolR">
                                                            <th>
                                                                <p>Probalitat</p>
                                                            </th>
                                                            <th>
                                                                <h2>Mati:</h2>
                                                            </th>
                                                            <th>
                                                                <h2>Tarda:</h2>
                                                            </th>
                                                        </tr>
                                                        <tr class="row">
                                                            <th>
                                                                Calamarsa: 
                                                            </th>
                                                            <td>
                                                                <p>
                                                                    ${calMati}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    ${calTarda}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr class="row">
                                                            <th>
                                                                Precipitacio: 
                                                            </th>
                                                            <td>
                                                                <p>
                                                                    ${prMati}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    ${prTarda}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="segon">
                                                    <table>
                                                        <tr class="row">
                                                            <th>
                                                                Calamarsa: 
                                                            </th>
                                                            <td>
                                                                <p>
                                                                    ${calMati1}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    ${calTarda1}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr class="row">
                                                            <th>
                                                                Precipitacio: 
                                                            </th>
                                                            <td>
                                                                <p>
                                                                    ${prMati1}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p>
                                                                    ${prTarda1}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    `;
        }
    }
}