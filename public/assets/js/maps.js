
var PositionOptions = {

    enableHighAccurace: true,
    timeout: 5000,
    maximumAge: 60000

};
var latitud = 0;

function localize() {

	if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(mapa,errorCallback, PositionOptions);
    } else {
        alert('Tu navegador no soporta geolocalizacion.');
    }
}
 
function mapa(pos) {
 
	/************************ Aqui estÃƒÂ¡n las variables que te interesan***********************************/
  console.log(pos);

    var latitud = pos.coords.latitude;
    var longitud = pos.coords.longitude;
    var precision = pos.coords.accuracy;
 
    /* funciona window.location="posigraba.php?latitud="+latitud+"&longitud="+longitud;*/
 
 
/* identificador para mostrar valores en input del body*/
document.getElementById('lng').value=longitud; 
document.getElementById('lat').value=latitud;
document.getElementById('pre').value=precision;

/* identificador para mostrar valores en texto span del body*/
 document.getElementById('lng1').innerHTML = longitud; 
 document.getElementById('lat1').innerHTML = latitud; 
 document.getElementById('pre1').innerHTML = precision; 
/*   fecha y hora */
 
var timestamp = document.getElementById('timestamp');
 
  var date = new Date(pos.timestamp);
 
  var mes = date.getMonth() + 1;
 
  if (mes < 10) {
 
    mes = '0' + mes
 
  }
 
  var dia = date.getDate();
 
  if (dia < 10) {
 
    dia = '0' + dia
 
  }
 
  var anyo = date.getFullYear();
 
  var hora = date.getHours();
 
  if (hora < 10) {
 
    hora = '0' + hora
 
  }
 
  var minuto = date.getMinutes();
 
  if (minuto < 10) {
 
    minuto = '0' + minuto
 
  }
 
  var segundo = date.getSeconds();
 
  if (segundo < 10) {
 
    segundo = '0' + segundo
 
  }
 
  var timestamp = document.getElementById('timestamp');
 
/*   fecha y hora   */
 
 
/* funciona alert ('latitud: '+ latitud +'\nlongitud: '+longitud +'\nfecha: '+dia+'/'+mes+'/'+anyo+'\nhora: '+hora+':'+minuto+':'+segundo*/
 
			var contenedor = document.getElementById('map')
 
 
 
			var centro = new google.maps.LatLng(latitud,longitud);
 
 
 
			var propiedades =
 
			{
 
                zoom: 18,
 
                center: centro,
 
                mapTypeId: google.maps.MapTypeId.ROADMAP
 
			};
 
 
 
			var map = new google.maps.Map(contenedor, propiedades);
 
 
 
			var marcador = new google.maps.Marker({
 
                position: centro,
 
                map: map,
 
                title: 'Tu posicion actual'
 
            });
 
 
		}
 
 function errorCallback(error) {
 
        var appErrMessage = null;
 
        if (error.core == error.PERMISSION_DENIED) {
 
            appErrMessage = "El usuario no ha concedido los privilegios de geolocalizaciÃƒÆ’Ã‚Â³n"
 
        } else if (error.core == error.POSITION_UNAVAILABLE) {
 
            appErrMessage = "PosiciÃƒÆ’Ã‚Â³n no disponible"
 
        } else if (error.core == error.TIMEOUT) {
 
            appErrMessage = "Demasiado tiempo intentando obtener la localizaciÃƒÆ’Ã‚Â³n del usuario."
 
        } else if (error.core == error.UNKNOWN) {
 
            appErrMessage = "Error desconocido, Revise si el GPS de su móvil está activo"
 
        } else {
 
            appErrMessage = "Error insesperado"
 
        }
 
        //document.getElementById("mensaje").innerHTML = appErrMessage
        document.getElementById("map").innerHTML = appErrMessage
    };
 
function error(errorCode)
 
		{
 
			if(errorCode.code == 1)
 
				alert('No has permitido buscar tu localizacion')
 
			else if (errorCode.code==2)
 
				alert('Posicion no disponible')
 
			else
 
				alert('Ha ocurrido un error')
 
		}
 