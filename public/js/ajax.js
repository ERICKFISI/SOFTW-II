// Traer los datos y pasarlo a la funcion para hacer los que se desee

function ajax_get(ruta, cadena, funcion)
{
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
	if (this.readyState == 4 && this.status == 200)
	    funcion(this.responseText, cadena);
    }
    xhttp.open("GET", ruta, true);
    xhttp.send();

}

function ajax_post(ruta, cadena, funcion)
{
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
	if (this.readyState == 4 && this.status == 200)
	    funcion(this.responseText, cadena);
    }
    xhttp.open("POST", ruta, true);
    xhttp.send();
}
