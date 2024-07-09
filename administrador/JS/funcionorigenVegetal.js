function obtiene_http_request()
{
var req = false;
try
  {
    req = new XMLHttpRequest(); /* p.e. Firefox */
  }
catch(err1)
  {
  try
    {
     req = new ActiveXObject("Msxml2.XMLHTTP");
  /* algunas versiones IE */
    }
  catch(err2)
    {
    try
      {
       req = new ActiveXObject("Microsoft.XMLHTTP");
  /* algunas versiones IE */
      }
      catch(err3)
        {
         req = false;
        }
    }
  }
return req;
}
var miPeticion = obtiene_http_request();
//***************************************************************************************
function from(id,ide,url){
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
		var vinculo=url+"?id="+id+"&rand="+mi_aleatorio;
		//alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               if (miPeticion.readyState==4)
               {
				   //alert(miPeticion.readyState);
                       if (miPeticion.status==200)
                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               var http=miPeticion.responseText;
                               document.getElementById(ide).innerHTML= http;

                       }
               }/*else
               {
			document.getElementById(ide).innerHTML="<img src='ima/loading.gif' title='cargando...' />";

                }*/
       }
       miPeticion.send(null);

}
//************************************************************************************************
function limpiar()
{
	document.form.reset();
	
}

addEvent(window,'load',inicializarOpcionesVegetal,false);

function inicializarOpcionesVegetal()
{
  var select1=document.getElementById('vegorigen');
  addEvent(select1,'change',mostrarveglugorigenVegetal,false);
}

var conexion1;
function mostrarveglugorigenVegetal(e) 
{
  var codigo=document.getElementById('vegorigen').value;
  if (codigo!=0)
  {
    conexion1=crearXMLHttpRequest();
    conexion1.onreadystatechange = procesarEventosVegetal;
    conexion1.open('GET','include/desplegableorigenvegetal.php?codvegetal='+codigo, true);
    conexion1.send(null);
  }
  else
  {
    var select2=document.getElementById('veglugorigen');
    select2.options.length=0;
  }
}

function procesarEventosVegetal()
{
  if(conexion1.readyState == 4)
  {
    var d=document.getElementById('esperaVegetal');
    d.innerHTML = '';
    var xml = conexion1.responseXML;
    var pals=xml.getElementsByTagName('veglugorigen');
    var select2=document.getElementById('veglugorigen');
    select2.options.length=0;
    for(f=0;f<pals.length;f++)
    {
      var op=document.createElement('option');
      var texto=document.createTextNode(pals[f].firstChild.nodeValue);
      op.appendChild(texto);
      select2.appendChild(op);
    } 
  } 
  else 
  {
    var d=document.getElementById('esperaVegetal');
    d.innerHTML = '<img src="../cargando.gif">';
  }
}


//***************************************
//Funciones comunes a todos los problemas
//***************************************
function addEvent(elemento,nomevento,funcion,captura)
{
  if (elemento.attachEvent)
  {
    elemento.attachEvent('on'+nomevento,funcion);
    return true;
  }
  else  
    if (elemento.addEventListener)
    {
      elemento.addEventListener(nomevento,funcion,captura);
      return true;
    }
    else
      return false;
}

function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}