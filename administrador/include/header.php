<head>
<!--_________________________________________________________________________________________--> 
<!-- Descripcion para la correcion de tildes y ñ y formato de texto (DISEÑO RESPONSIVE)-->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="&aacute; &eacute; &iacute; &oacute; &uacute; &ntilde;" content="text	/html; charset=ISO-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Fringila Responsive web template, Bootstrap Web 	Templates, Flat Web Templates, Andriod Compatible web 
template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<!--_________________________________________________________________________________________--> 
<!--Imagen en la barra de direcciones (img.ICO)--> 
<link rel="icon" type="image/png" href="img/logo.ico"/>
<!--_________________________________________________________________________________________--> 
<!-- llamado al estilo css de la pagina-->
<link href="css/estilo.css" rel="stylesheet" type="text/css" media="all">
<!--_________________________________________________________________________________________--> 
<!-- Titulo de la pagina -->
<title>SIGLaGranja</title>
<!--_________________________________________________________________________________________--> 
<!-- Librerias .js -->
<link rel="stylesheet" href="JS/validationEngine.jquery.css" type="text/css"/>
<script src="JS/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="JS/funcionorigen.js" language="JavaScript"></script>
<script src="JS/funcionorigenVegetal.js" language="JavaScript"></script>
<script src="JS/funcionorigenRaza.js" language="JavaScript"></script>
<script src="JS/funciones.js" language="JavaScript"></script>
<script src="JS/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="JS/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="JS/main.js"></script>
<script type="text/javascript" src="warning/jquery-1.3.2.js"></script>
<script src="JS/jquery.js"></script>
<!--_________________________________________________________________________________________--> 
<!-- Validaciones para numero y texto -->
<script language="javascript" type="text/javascript">
	function Solo_Numerico(variable)
	{
		Numer=parseInt(variable);
		if (isNaN(Numer))//La función isNaN () determina si un valor es un número ilegal (no-a-Number).
		{
			return "";
		}
		return Numer;
	}
	function ValNumero(Control)
	{
		Control.value=Solo_Numerico(Control.value);
	}
//Validar Texto
	function validar_texto(e) 
	{
		tecla = (document.all) ? e.keyCode : e.which;//La propiedad keyCode devuelve el código de caracteres Unicode de la tecla que activa la onkeypress evento, o el código de clave de Unicode de la tecla que activa la onkeydown o onkeyup evento.
		if (tecla==8) return true; 
		patron =/\D/;// /\D/ elimina los datos Num
		tecla_final = String.fromCharCode(tecla);//  "fromCharCode(tecla)" combierte un Int a Str
		return patron.test(tecla_final);
	} 
</script>

<!--<script> 
	function validar_numero(e) 
	{
		tecla = (document.all) ? e.keyCode : e.which;//La propiedad keyCode devuelve el código de caracteres Unicode de la tecla que activa la onkeypress evento, o el código de clave de Unicode de la tecla que activa la onkeydown o onkeyup evento.
		if (tecla==8) return true; 
		patron =/\d/;// /\D/ elimina los datos Num
		tecla_final = String.fromCharCode(tecla);//  "fromCharCode(tecla)" combierte un Int a Str
		return patron.test(tecla_final);
	}
</script>-->

<!--_________________________________________________________________________________________--> 
<!-- OTRA VALIDACION PARA PERMITIR SOLO NUMEROS, SOLO TEXTO, O AMBOS-->
<!--_________________________________________________________________________________________-->
<script type="text/javascript">
    function permite(elEvento, permitidos) 
    {
  // Variables que definen los caracteres permitidos
  var numeros = "0123456789";
  var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
  var numeros_caracteres = numeros + caracteres;
  var teclas_especiales = [37];
  //var teclas_especiales = [8, 37, 39, 46];
  // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
 
 
  // Seleccionar los caracteres a partir del parámetro de la función
  switch(permitidos) 
  {
    case 'num':
      permitidos = numeros;
      break;
    case 'car':
      permitidos = caracteres;
      break;
    case 'num_car':
      permitidos = numeros_caracteres;
      break;
  }
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
 
  // Comprobar si la tecla pulsada es alguna de las teclas especiales
  // (teclas de borrado y flechas horizontales)
  var tecla_especial = false;
  for(var i in teclas_especiales) 
  {
    if(codigoCaracter == teclas_especiales[i]) 
    {
      tecla_especial = true;
      break;
    }
  }
 
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  // o si es una tecla especial
  return permitidos.indexOf(caracter) != -1 || tecla_especial;
}
// Sólo números
//<input type="text" id="texto" onkeypress="return permite(event, 'num')" /><br>
 
// Sólo letras
//<input type="text" id="texto" onkeypress="return permite(event, 'car')" /><br>
 
// Sólo letras o números
//<input type="text" id="texto" onkeypress="return permite(event, 'num_car')" />
  </script>
  <!--_________________________________________________________________________________________-->
<!-- funcion para la tabla de consulta-->
<script type="text/javascript">
function fnc() 
{
	document.getElementById('table-scroll').onscroll = function() 
	{
	document.getElementById('fixedY').style.top = document.getElementById('table-scroll').scrollTop + 'px';
	document.getElementById('fixedX').style.left = document.getElementById('table-scroll').scrollLeft + 'px';
	};
}
window.onload = fnc;
</script>
<!--_________________________________________________________________________________________--> 
<!-- Validaciones de los botones-->
<script>
    jQuery(document).ready(function()
    {
    	jQuery("#formID1").validationEngine('attach', {promptPosition : "centerRight",	 
    	autoPositionUpdate : true});
    	jQuery("#formID2").validationEngine('attach', {promptPosition : "bottomLeft",
    	autoPositionUpdate : true});
    	jQuery("#formID3").validationEngine('attach', {promptPosition : "bottomRight",	 
    	autoPositionUpdate : true});
    	jQuery("#formID4").validationEngine('attach', {promptPosition : "topLeft"});
    	jQuery("#formID5").validationEngine('attach', {promptPosition : "topLeft"});
    });
</script>
<!--_________________________________________________________________________________________-->
<!-- Validaciones para cuando se quedan campos vacios o con solo espacios-->
<script type="text/javascript">
//Input Normales
	function revisar(elemento) 
	{
	    if (elemento.value=="")
	    {
	        elemento.className='error';
	    }
	    else 
	    {
	        elemento.className='inp-form';
	    }
	}
//Select Normales
    function SelectVacio(select) 
    {
      	if (select.value=="")
      	{
      	  select.className='errors';
      	  return false;
	  	}
	  	else 
	  	{
      		select.className='select-form';
	  	}
    }
//Select para las Unidades de Medida	
  	function SelectVaciouni(select) 
  	{
  	  	if (select.value=="")
  	  	{
  	  	      select.className='erroru';
  	  	      return false;
   	  	}
 	  	else 
 	  	{
 	  	    select.className='uni-form';
 	  	}
  	}
// Descripcion (textarea)//
	function revisard(elemento) 
	{
	    if (elemento.value=="")
	    {
	        elemento.className='errord';
	    }
	    else 
	    {
	        elemento.className='des-form';
	    }
	}
// Enteros  (input de "Orientacion y Numéricos")//
	function revisarn(elemento) 
	{
	    if (elemento.value=="")
	    {
	        elemento.className='errorn';
	    }
	    else 
	    {
	        elemento.className='inp-ent';
	    }
	}
// Coordenadas (input de "Latitud y Longitud")//
	function revisarc(elemento) 
	{
	    if (elemento.value=="")
	    {
	        elemento.className='errorc';
	    }
	    else 
	    {
	        elemento.className='inp-coor';
	    }
	}
// Usuario (input normales solo para el Frm de Usuario)//
	function revisarusu(elemento) 
	{
	    if (elemento.value=="")
	    {
	        elemento.className='errorusu';
	    }
	    else 
	    {
	        elemento.className='inp-usuario';
	    }
	}
// Fechas (input valido sólo para datos type="Date")//
	function revisarfecha(elemento) 
	{
    	if (elemento.value=="")
    	{
    	    elemento.className='error';//Clase error coresponde a input "Normales"
    	}
    	else 
    	{
    	    elemento.className='select-form';//Clase select-form corresponde a Listas Desplegables
    	}
	}
</script>
<!--_________________________________________________________________________________________-->
<!-- Funcion para las coordenadas (ORIENTACION)-->	
<script>
	function Orilatitud(orilatitud)//Funcion para validar la Coordenada LATITUD
	{
		if (orilatitud.value<0) 
		{
		    document.formulario.orilatitud.value='SUR';
		} 
		else 
		{
		    document.formulario.orilatitud.value='NORTE';
		}
	}
	function Orilongitud(orilongitud)//Funcion para validar la Coordenada LONGITUD
	{

	    if (orilongitud.value>0) 
	    {
	        document.formulario.orilongitud.value='ESTE';
	    } 
	    else 
	    {
	        document.formulario.orilongitud.value='OESTE';
	    }
	}
	function Orilatitudf(orilatitudf)//Funcion para validar la Coordenada LATITUD (FINAL)
	{

	    if (orilatitudf.value< 0 ) 
	    {
	        document.formulario.orilatitudf.value='SUR';
	    } 
	    else 
	    {
	        document.formulario.orilatitudf.value='NORTE';
	    }
	}
	function Orilongitudf(orilongitudf)////Funcion para validar la Coordenada ORIENTACION (FINAL)
	{

	    if (orilongitudf.value> 0 ) 
	    {
	        document.formulario.orilongitudf.value='ESTE';
	    } 
	    else 
	    {
	        document.formulario.orilongitudf.value='OESTE';
	    }
	}
</script>
<!--_________________________________________________________________________________________-->
<!-- Funcion para la grilla-->
<script src="JS/jquery.js"></script><!--Llamado a la librería JS-->
<script type="text/javascript">
	$(document).ready(function()
	{
	    $("#boton").click(function()//El evento click hace que se active la funcion al oprimir el Icono
	    {
	        $("#grilla").slideToggle("slow");//Se carga la grilla en el div correpondiente
	        //slideToggle(); Esto hace que las partes inferiores de la página se deslice hacia arriba o hacia abajo, que aparece para mostrar u ocultar los elementos. 
	    });
	});
</script>
<!--_________________________________________________________________________________________-->
<!-- FUNCION PARA EL BOTÓN(ICONO) DE LA "LUPA", QUE PERMITE MOSTRAR EL INPUT DE CONSULTA-->
<script type="text/javascript"> //Icono para los formularios en: REGISTRAR
	$(document).ready(function()
	{
	    $("#botonconsulta").click(function()
	    {
	        $("#consultar").slideToggle("slow");//El método (slideToggle) comprueba los elementos seleccionados para la visibilidad. slideDown () se ejecuta si un elemento está oculto. slideUp () se ejecuta si un elemento es visible - Esto crea un efecto de PALANCA.
	    });
	});
</script>
<script type="text/javascript">//Icono para los formularios en: ACTUALIZAR
	$(document).ready(function()
	{
	    $("#botonconsulta").click(function()
	    {
	        $("#consultarr").slideToggle("slow");
	    });
	});
</script>
<!--_________________________________________________________________________________________-->
<!--NO SE LLAMA ESTA FUNCION EN EL FORMULARIO DE Ruta-->
<!--<script type="text/javascript">
    function numepunto(N)
      {
          var teclaPulsada=window.event ? window.event.keyCode:N.which;
          var valor=document.getElementById("rutdistancia").value;
          if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
              {
                  return true;
              }
          return /\d/.test(String.fromCharCode(teclaPulsada));
      }
  </script>
 ++++++++++++++++++++++++++ REVISAR++++++++++++++++++++++
  <script type="text/javascript">
	function NumStr(e)
	{
		var teclaPulsada=window.event ? window.event.keyCode:e.which;
		var valor=document.getElementById("canidcodigo").value;
		if ((teclaPulsada==08 && valor.indexOf(" ")==-1) || (teclaPulsada==08)) 
		{
			return false;
		}
	}
	
</script>-->
<!--_________________________________________________________________________________________-->	      
<!-- Funcion que solo permite un negativo y un punto decimal -->
<script>
    function Coorla(e)//Coordenada Latitud INICIAL
    {
        var teclaPulsada=window.event ? window.event.keyCode:e.which;//Según el evento se codifica el caracter y se normaliza el evento con "e.which"
        var valor=document.getElementById("coorlatitud").value;//Se Obtiene el elemento con el ID especificado en este caso "coorlatitud"
        if(teclaPulsada==45 && valor.indexOf("-")==-1)//Oprime la tecla "-" y Busca entre el string el caracter "-" 
        {
            document.getElementById("coorlatitud").value="-"+valor;//Imprime "-" y seguidamente la cadena
        }
        if((teclaPulsada==13) || (teclaPulsada==46 && valor.indexOf(".")==-1))//Al recoger el evento (la pulsacion de las teclas), si es la tecla "RetrocesoDeCarro" O tecla ".", las permitimos
        {
        	return true;//Se permiten las teclas
        }
        if (teclaPulsada==08 && valor.indexOf(" ")==-1)//Oprime la tecla "BS"<<retroceso>> y verifíca que no exista el caracter " "<<espacio>>
        {
        	return true;
        }
        return /\d/.test(String.fromCharCode(teclaPulsada));//"/\d/" es la ExpresionRegular--metodo "test()" comprueba si existe un patron dentro de una cadena--"String.fromCharCode()" Es la cadena en la que se va a buscar, en este caso la cadena es teclaPulsada
    }
    function Coorlaf(e)//Coordenada Latitud FINAL
    { 
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
        var valor=document.getElementById("coorlatitudf").value;
        if(teclaPulsada==45 && valor.indexOf("-")==-1 )
        {
            document.getElementById("coorlatitudf").value="-"+valor;
        }
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
           	return true;
        }
        if (teclaPulsada==08 && valor.indexOf(" ")==-1)
        {
        	return true;
        }
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function Coorlo(e)//Coordenada Longitud INICIAL
    {
    	var teclaPulsada=window.event ? window.event.keyCode:e.which;
    	var valor=document.getElementById("coorlongitud").value;
    	if(teclaPulsada==45 && valor.indexOf("-")==-1 )
        {
            document.getElementById("coorlongitud").value="-"+valor;
        }
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
        if (teclaPulsada==08 && valor.indexOf(" ")==-1)
        {
        	return true;
        }
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function Coorlof(e)//Coordenada Longitud FINAL
    {
    	var teclaPulsada=window.event ? window.event.keyCode:e.which;
    	var valor=document.getElementById("coorlongitudf").value;
    	if(teclaPulsada==45 && valor.indexOf("-")==-1 )
        {
            document.getElementById("coorlongitudf").value="-"+valor;
        }
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
        if (teclaPulsada==08 && valor.indexOf(" ")==-1)
        {
        	return true;
        }
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
</script>
<!--_________________________________________________________________________________________-->
<!-- Funcion para permitir ningun espacio al principio-->		
<script type="text/javascript"> 
  espacios=function(input)
    {
      if (input.value==' ')//Si cadena tiene 2 espacios
	  {
	    input.value=input.value.replace(' ','');//Se reemplaza el valor de la cadena por "ningun espacio"
	  }
      else
      {
        input.value=input.value.replace('  ',' ');//Se reemplaza el valor de la cadena por "un espacio"
      }
    }
</script>
<!--_________________________________________________________________________________________-->
<!-- Funcion para permitir Sólo datos numéricos-->		
<script type="text/javascript">
  	function solonumeros()
  	{
  		if (event.keyCode < 48 || event.keyCode > 57)//Solo permite obtener el Codigo ASCII de las teclas comprendidas en el rango de teclas 48 hasta 57 (que son las de los números)
		{
			event.returnValue = false;
		};
  	}
</script>
<!--***********************************************************************************************-->
<!--__VALIDACIONES PARA COMPROBAR LOS CAMPOS DE LOS FORMULARIOS (Si el dato existe o no, mostrar Alert cuando no se completa o diligencia correctamente un campo sin refrescar el Frm y marca el campo)__-->
<!--**********************************************************************************************-->
<!--______________________________________________________________________________________________-->
<!-- Validacion Formulario: (AREA)-->
<!--______________________________________________________________________________________________-->
<!--Validacion para el CODIGO del Area (Disponible o Ya Existe) "REGISTRAR" -->
<script src="JS/jquery-1.8.2.min.js"></script><!--Se hace llamado a la librería para su correcto uso-->
<script type="text/javascript">
//Validacion Disponible, Ya Existe (Codigo)
	$(document).ready(function()//El metod "ready" realiza una funcion disponible despues de cargar el documento, es decir, esperamos que se escriba algo en el campo
	{  
		$('#areidcodigo').blur(function()//"blur (desenfoque)", ocurre cuando un elemento pierde el foco, atribuye una funcion a ejecutar cuando se produce el evento (desenfoque), es decir, cuando se escribe algo en el campo y al SALIRSE del campo se muestra la imagen
		{
			$('#Info').html('<img src="img/loader.gif" class="LoadIcon" alt="" />').fadeOut(1000);//Devuelve el contenido html(Imagen) del elemento seleccionado(#Info)__(.fadeOut() cambia gradualmente la opacidad del elemento seleccionado 'lo oculta')
			var areidcodigo = $(this).val();//Preparamos un valor al elemento   
			var dataString = 'areidcodigo='+areidcodigo;//A 'areidcodigo' le concatenamos un valor
			$.ajax(
			{
				type: "POST",//Enviamos via POST al fichero (.php)
				url: "consregistros/area/areacodigo_reg.php",
				data: dataString,//Valor que enviamos obtenido del (input)
				success: function(data) 
				{
				$('#Info').fadeIn(300).html(data);//Declaramos el nombre del Identificador en el (input)--".fadeIn(300)" es la gradualidad de aparicion del elemento y el tiempo en que lo hace--".html()" es el elemento html en el que se carga el Identificador
			}
		});
		});              
	});
//Validacion Disponible, Ya Existe (Nombre)
$(document).ready(function()
{  
	$('#arenombre').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" alt=""/>').fadeOut(1000);
		var arenombre = $(this).val();  
		var dataString = 'arenombre='+arenombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/area/areanombre_reg.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
//Funcion de un sólo punto para Numeros Decimales(EXTENCION)	
function extencionArea(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var valor=document.getElementById("areextension").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Validacion de los campos del formulario antes de ser enviados al servidor
function ValidarFormArea()
{
		var codigo = document.getElementById("VercodArea");//Accedemos al primer elemento con el Id especificado
		if(codigo.value < 1)//Si el valor del campo(input) es menor a 1 (0)
		{
			alert("Por favor, Verificar el Codigo del Area");
			document.getElementById("areidcodigo").style.border = "2px solid red";//Se marca el inpput de color rojo cuando el elemento tiene valor <  0 	
			return false;
		}
		else
		{
			document.getElementById("areidcodigo").style.border = "";//Se mantiene el borde del imput sin color 
			var nombre = document.getElementById("vernomarea");
			if(nombre.value < 1) 
			{
				alert("Por favor, Verificar el Nombre del Area");
				document.getElementById("arenombre").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("arenombre").style.border = "";
				var responsable = document.getElementById("arecoordinad");
				if(responsable.value == " ")//Si el valor del elemento contiene un espacio al principio, no se debe permitir guardar
				{
					alert("Por favor, Verificar el responsable del Area, No puede contener ningun espacio al principio");
					document.getElementById("arecoordinad").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("arecoordinad").style.border = "";
					var extension = document.getElementById("areextension");
					if (extension.value == ".") 
					{
						alert("Por favor, Verificar la extension, no puede contener puntos(.) al principio");
						document.getElementById("areextension").style.border = "2px solid red";
						return false;
					}
					/*var unimedida = document.getElementById("areunimedida");
					if (unimedida.selectedIndex == null || unimedida.selectedIndex == 0)//Si el "option" no se seleccionó, marca (null), esto es por el "disabled".--Si se marca la primera opcion el (disabled), el index(índice) vale 0, por eso se pregunta por 0.
						//NOTA:Esta validacion puede no funcionar ya que en el formulario ya se ha validado para que obligatoriamente elija una opcion superior a 0, esto se hizo mediante la propiedad "required"
					{
						alert("Por favor seleccione una opción válida de Unidad de Medida para la Extensión");
						document.getElementById('areunimedida').style.border="2px solid red";
						return false
					}*/
					else
					{
						//document.getElementById("areunimedida").style.border = "";
						document.getElementById("areextension").style.border = "";
						var descripcion = document.getElementById("aredescripci");
						if(descripcion.value == "              ")//Se validan los 14 espacios del campo "descripcion"
						{
							alert("Por favor, Verificar la descripción, no puede contener espacios al principio ¡borre los espacios!");
							document.getElementById("aredescripci").style.border = "2px solid red";
							return false;
						}
						else if (descripcion.value == " ") 
						{
							alert("Por favor, Verificar la descripcion, no se aceptan espacios al principio")
							document.getElementById("aredescripci").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("aredescripci").style.border = "";
							return true;
						}
					}
				}
			}
		}
	}
</script>
<!--______________________________________________________________________________________________-->
<!-- Validacion Formulario: (CANAL)-->
<!--______________________________________________________________________________________________-->
<!--Validacion para verificar los input de Decimales-->
  <script type="text/javascript">
    function numepunto1(N)//Funcion de un sólo punto para Numeros Decimales(PROFUNDIDAD)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var valor=document.getElementById("canprofundid").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function numepunto2(N)//Funcion de un sólo punto para Numeros Decimales(ANCHO)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var valor=document.getElementById("canancho").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function numepunto3(N)//Funcion de un sólo punto para Numeros Decimales(PENDIENTE)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var valor=document.getElementById("canpendiente").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function numepunto4(N)//Funcion de un sólo punto para Numeros Decimales(DISTANCIA)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var valor=document.getElementById("candistancia").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
//Validacion para el CODIGO de la Canal (Disponible o Ya Existe) "REGISTRAR"
$(document).ready(function()
{  
	$('#canidcodigo').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon" alt="" />').fadeOut(1000);
		var canidcodigo = $(this).val();  
		var dataString = 'canidcodigo='+canidcodigo;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/canal/canalcodigo.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion para el NOMBRE de la Canal (Disponible o Ya Existe) "REGISTRAR"
$(document).ready(function()
{  
	$('#cannombre').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var cannombre = $(this).val();  
		var dataString = 'cannombre='+cannombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/canal/canalnombre.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion para verificar los campos "REGISTRAR"
function ValidarFormCanal()
{
	var codigo = document.getElementById("Vercodcanal");
	if(codigo.value < 1) 
	{
		alert("Por favor, Verificar el Codigo del Canal");
		document.getElementById("canidcodigo").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("canidcodigo").style.border = "";
		var nombre = document.getElementById("vernomcanal");
		if(nombre.value < 1) 
		{
			alert("Por favor, Verificar el Nombre del Canal");
			document.getElementById("cannombre").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("cannombre").style.border = "";
			var profundidad = document.getElementById("canprofundid");
			if (profundidad.value == ".") 
			{
				alert("Por favor, Verificar la profundidad, No puede contener un punto(.) al principo");
				document.getElementById("canprofundid").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("canprofundid").style.border = "";
				var profundidad = document.getElementById("canancho");
				if (profundidad.value == ".") 
				{
					alert("Por favor, Verificar el ancho, No puede contener un punto(.) al principo");
					document.getElementById("canancho").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("canancho").style.border = "";
					var profundidad = document.getElementById("canpendiente");
					if (profundidad.value == ".") 
					{
						alert("Por favor, Verificar la pendiente, No puede contener un punto(.) al principo");
						document.getElementById("canpendiente").style.border = "2px solid red";
						return false;
					}
					else
					{
						document.getElementById("canpendiente").style.border = "";
						var profundidad = document.getElementById("candistancia");
						if (profundidad.value == ".") 
						{
							alert("Por favor, Verificar la distancia, No puede contener un punto(.) al principo");
							document.getElementById("candistancia").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("candistancia").style.border = "";
							return true;
						}
					}
				}
			}
		}
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (CLIMA)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<!--______________________________________________________________________________________________-->
<!--Validacion para verificar los campos "REGISTRAR"-->
<script type="text/javascript">
	function ValidarFormClima()
	{
		var radsolar = document.getElementById("cliradisolar");
		if (radsolar.value == ".") 
		{
			alert("Por favor, Verificar la radiacion solar, No puede contener un punto(.) al principo");
			document.getElementById("cliradisolar").style.border = "2px solid red";
			return false;
		}
		else 
		{
			document.getElementById("cliradisolar").style.border = "";
			var tempaire = document.getElementById("clitempeaire");
			if (tempaire.value == ".")
			{
				alert("Por favor, Verificar la temperatura del aire, No puede contener un punto(.) al principo");
				document.getElementById("clitempeaire").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("clitempeaire").style.border = "";
				var humrelativa = document.getElementById("clihumeralat");
				if (humrelativa.value == ".")
				{
					alert("Por favor, Verificar la humedad relativa, No puede contener un punto(.) al principo");
					document.getElementById("clihumeralat").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("clihumeralat").style.border = "";
					var humrelativa = document.getElementById("cliprecipita");
					if (humrelativa.value == ".")
					{
						alert("Por favor, Verificar la precipitacion, No puede contener un punto(.) al principo");
						document.getElementById("cliprecipita").style.border = "2px solid red";
						return false;
					}
					else
					{
						document.getElementById("cliprecipita").style.border = "";
						var humrelativa = document.getElementById("clivelovient");
						if (humrelativa.value == ".")
						{
							alert("Por favor, Verificar la velocidad del viento, No puede contener un punto(.) al principo");
							document.getElementById("clivelovient").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("clivelovient").style.border = "";
							return true;
						}
					}
				}
			}
		}
	}
	//Funcion de un sólo punto para Numeros Decimales
	function numepuntoClima(N)
	{
		var teclaPulsada=window.event ? window.event.keyCode:N.which;
		var valor1=document.getElementById("cliradisolar").value;
		if(teclaPulsada==13 || (teclaPulsada==46 && valor1.indexOf(".")==-1))
		{
			return true;
		}
		if (teclaPulsada==08 && valor1.indexOf(" ")==-1)
		{
			return true;
		}
		return /\d/.test(String.fromCharCode(teclaPulsada));
	}
	function numepuntoClima1(N)
	{
		var teclaPulsada=window.event ? window.event.keyCode:N.which;
		var valor2=document.getElementById("clitempeaire").value;
		if(teclaPulsada==13 || (teclaPulsada==46 && valor2.indexOf(".")==-1))
		{
			return true;
		}
		if (teclaPulsada==08 && valor2.indexOf(" ")==-1)
		{
			return true;
		}
		return /\d/.test(String.fromCharCode(teclaPulsada));
	}
	function numepuntoClima2(N)
	{
		var teclaPulsada=window.event ? window.event.keyCode:N.which;
		var valor3=document.getElementById("clihumeralat").value;
		if(teclaPulsada==13 || (teclaPulsada==46 && valor3.indexOf(".")==-1))
		{
			return true;
		}
		if (teclaPulsada==08 && valor3.indexOf(" ")==-1)
		{
			return true;
		}
		return /\d/.test(String.fromCharCode(teclaPulsada));
	}
	function numepuntoClima3(N)
	{
		var teclaPulsada=window.event ? window.event.keyCode:N.which;
		var valor4=document.getElementById("cliprecipita").value;
		if(teclaPulsada==13 || (teclaPulsada==46 && valor4.indexOf(".")==-1))
		{
			return true;
		}
		if (teclaPulsada==08 && valor4.indexOf(" ")==-1)
		{
			return true;
		}
		return /\d/.test(String.fromCharCode(teclaPulsada));
	}
	function numepuntoClima4(N)
	{
		var teclaPulsada=window.event ? window.event.keyCode:N.which;
		var valor5=document.getElementById("clivelovient").value;
		if(teclaPulsada==13 || (teclaPulsada==46 && valor5.indexOf(".")==-1))
		{
			return true;
		}
		if (teclaPulsada==08 && valor5.indexOf(" ")==-1)
		{
			return true;
		}
		return /\d/.test(String.fromCharCode(teclaPulsada));
	}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (COSTRUCCION)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion de los datos del formulario, antes de enviar al servidor
	function ValidarFormConstruccion() 
	{	
		var codConstr = document.getElementById("VercodConstruccion");
		if(codConstr.value < 1) 
		{
			alert("Por favor, Verificar el Codigo de la Construccion");
			document.getElementById("conidcodigo").style.border = "2px solid red";
			return false;
		}
		else		
		{
			document.getElementById("conidcodigo").style.border = "";
			var NomComun = document.getElementById("VerNomConstru");
			if(NomComun.value < 1) 
			{
				alert("Por favor, Verificar el Nombre de la Construccion");
				document.getElementById("connombre").style.border = "2px solid red";
				return false;
			}
			else
			{
				var inicio = document.getElementById('confecconstr').value; 
				var finalq  = document.getElementById('confecremode').value;
				inicio= new Date(inicio);
				finalq= new Date(finalq);
				if(inicio>=finalq)
				{
					alert('La Fecha de Remodelacion debe ser mayor que la Fecha de Construccion');
					document.getElementById("confecconstr").style.border = "2px solid red";
					document.getElementById("confecremode").style.border = "2px solid red";
					return false;
				}
				else
				{
					var extension = document.getElementById('conextension');
					if(extension.value == ".") 
					{
						alert("Por favor, Verificar la extension, no puede contener puntos(.) al principio");
						document.getElementById("conextension").style.border = "2px solid red";
						return false;
					}
					else
					{
						return true;
					}
				}
			}
		}
	}
//Validacion para comprobar si el dato Ya Existe o si está Disponible (CODIGO CONSTRUCCION)
	$(document).ready(function()
	{  
		$('#conidcodigo').blur(function()
		{
			$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
			var conidcodigo = $(this).val();  
			var dataString = 'conidcodigo='+conidcodigo;
			$.ajax({
				type: "POST",
				url: "consregistros/construccion/conidcodigo.php",
				data: dataString,
				success: function(data) 
				{
					$('#Info').fadeIn(300).html(data);
				}
			});
		});              
	});
//Validacion para comprobar si el dato Ya Existe o si está Disponible (NOMBRE CONSTRUCCION)
	$(document).ready(function()
	{  
		$('#connombre').blur(function()
		{
			$('#Info1').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
			var connombre = $(this).val();  
			var dataString = 'connombre='+connombre;
			$.ajax({
				type: "POST",
				url: "consregistros/construccion/connombre.php",
				data: dataString,
				success: function(data) 
				{
					$('#Info1').fadeIn(300).html(data);
				}
			});
		});              
	});
//Funcion de un sólo punto para Numeros Decimales
	function ExtencionConst(N)
	{
		var teclaPulsada=window.event ? window.event.keyCode:N.which;
		var extenconstr=document.getElementById("conextension").value;
		if(teclaPulsada==13 || (teclaPulsada==46 && extenconstr.indexOf(".")==-1))
		{
			return true;
		}
		if (teclaPulsada==08 && extenconstr.indexOf(" ")==-1)
		{
			return true;
		}
		return /\d/.test(String.fromCharCode(teclaPulsada));
	}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (CULTIVO)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
  <script src="JS/jquery-1.8.2.min.js"></script>
  <script type="text/javascript">
    //Validacion para permitir un solo punto en numeros Decimales
    function puntodecimal(N)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var valor1=document.getElementById("culvidautil").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && valor1.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && valor1.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function puntodecimal1(N)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var valor1=document.getElementById("culdistsiemb").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && valor1.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && valor1.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function puntodecimal2(N)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var valor1=document.getElementById("culextension").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && valor1.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && valor1.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
//Disponible-Ya Existe (CODIGO)
$(document).ready(function()
{  
	$('#culidcodigo').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var culidcodigo = $(this).val();  
		var dataString = 'culidcodigo='+culidcodigo;
		$.ajax({
			type: "POST",
			url: "consregistros/cultivo/culidcodigo.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Disponible-Ya Existe (NOMBRE)
$(document).ready(function()
{  
	$('#culnomcomun').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var culnomcomun = $(this).val();  
		var dataString = 'culnomcomun='+culnomcomun;
		$.ajax({
			type: "POST",
			url: "consregistros/cultivo/culnomcomun.php",
			data: dataString,
			success: function(data) {
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
//Disponible-Ya Existe (NOM CIENTIFICO)
$(document).ready(function()
{  
	$('#culnomcienti').blur(function()
	{
		$('#Info2').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var culnomcienti = $(this).val();  
		var dataString = 'culnomcienti='+culnomcienti;
		$.ajax({
			type: "POST",
			url: "consregistros/cultivo/culnomcienti.php",
			data: dataString,
			success: function(data) {
				$('#Info2').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion de Campos
function ValidarFormCultivo()
{
	var codigo = document.getElementById("VerCodigoCultivo"); 
	if(codigo.value < 1) 
	{
		alert("Por favor, Verificar el Codigo del cultivo");
		document.getElementById("culidcodigo").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("culidcodigo").style.border = "";
		var nombre = document.getElementById("VerComunCultivo");
		if(nombre.value < 1) 
		{
			alert("Por favor, Verificar el Nombre Comun del Cultivo");
			document.getElementById("culnomcomun").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("culnomcomun").style.border = "";
			var culnomcienti = document.getElementById("VerNomCientCultivo");
			if(culnomcienti.value < 1) 
			{
				alert("Por favor, Verificar el Nombre Cientifico");
				document.getElementById("culnomcienti").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("culnomcienti").style.border = "";
				var culdistsiemb = document.getElementById("culdistsiemb");
				if(culdistsiemb.value == ".") 
				{
					alert("Por favor, Verificar la distancia de siembra, no puede contener puntos(.) al principio");
					document.getElementById("culdistsiemb").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("culdistsiemb").style.border = "";
					var culvidautil = document.getElementById("culvidautil");
					if(culvidautil.value == ".") 
					{
						alert("Por favor, Verificar la vida util, no puede contener puntos(.) al principio");
						document.getElementById("culvidautil").style.border = "2px solid red";
						return false;
					}
					else
					{
						document.getElementById("culvidautil").style.border = "";
						var culextension = document.getElementById("culextension");
						if(culextension.value == ".") 
						{
							alert("Por favor, Verificar la extension, no puede contener puntos(.) al principio");
							document.getElementById("culextension").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("culextension").style.border = "";
							return true;
						}
					}
				}
			}
		}		
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ENFERMEDAD)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Disponible-Ya Existe (NOMBRE COMUN)
$(document).ready(function()
{  
	$('#enfnomcomun').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var enfnomcomun = $(this).val();  
		var dataString = 'enfnomcomun='+enfnomcomun;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/enfermedad/enfnomcomun.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Disponible-Ya Existe (NOMBRE CIENTIFICO)
$(document).ready(function()
{  
	$('#enfnomcinti').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var enfnomcinti = $(this).val();  
		var dataString = 'enfnomcinti='+enfnomcinti;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/enfermedad/enfnomcinti.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion de Campos
function ValidarFormEnfermedad()
{
	var nomcomunenfermedad = document.getElementById("VernomComun");
	if(nomcomunenfermedad.value < 1) 
	{
		alert("Por favor, Verificar el Nombre Comun de la Enfermedad");
		document.getElementById("enfnomcomun").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("enfnomcomun").style.border = "";
		var nomcientenfermedad = document.getElementById("VernomCient");
		if(nomcientenfermedad.value < 1) 
		{
			alert("Por favor, Verificar el Nombre Cientifico de la Enfermedad");
			document.getElementById("enfnomcinti").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("enfnomcinti").style.border = "";
			var sintoenfermedad = document.getElementById("enfsintomas");
			if(sintoenfermedad.value == " ") 
			{
				alert("Por favor, ingrese los síntomas de la enfermedad");
				document.getElementById("enfsintomas").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("enfsintomas").style.border = "";
				var tratemenfermedad = document.getElementById("enftratamien");
				if(tratemenfermedad.value == " ") 
				{
					alert("Por favor, ingrese el tratamiento de la enfermedad");
					document.getElementById("enftratamien").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("enftratamien").style.border = "";
					return true;
				}
			}
		}
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ENFERMEDAD_ESPECIE)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Validacion de Campos
function ValidarFormEnferEspec()
{
	var eesdescripci = document.getElementById("eesdescripci");
	if(eesdescripci.value == " ") 
	{
		alert("Por favor, Verificar la descripcion, no se aceptan espacios al principio");
		document.getElementById("eesdescripci").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("eesdescripci").style.border = "";
		return true;
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ESPECIE)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion de los campos
function ValidarFormEspecie() 
{	
	var NomComEspecie = document.getElementById("VerNomComEsp");
	if(NomComEspecie.value < 1) 
	{
		alert("Por favor, Verificar el Nombre Comun de la Especie");
		document.getElementById("espnomcomun").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("espnomcomun").style.border = "";
		var NomCientEspecie = document.getElementById("VerNomCientEsp");
		if(NomCientEspecie.value < 1) 
		{
			alert("Por favor, Verificar el Nombre Cientifico de la Especie");
			document.getElementById("espnomcienti").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("espnomcienti").style.border = "";
			return true;
		}
	}
}
//Validacion Disponible-Ya Existe (Nombre Comun Especie)
$(document).ready(function()
{  
	$('#espnomcomun').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var espnomcomun = $(this).val();  
		var dataString = 'espnomcomun='+espnomcomun;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/especie/espnomcomun.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion Disponible-Ya Existe (Nombre Cientifico Especie)
$(document).ready(function()
{  
	$('#espnomcienti').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var espnomcienti = $(this).val();  
		var dataString = 'espnomcienti='+espnomcienti;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/especie/espnomcienti.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
</script>
<!--_____________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ESPECIE_RAZA)    +++++++++++++++++++++++++++++++-->
<!--_____________________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Validacion de Campos
function ValidarFormEspRaz()
{
	var eradescripci = document.getElementById("eradescripci");
	if(eradescripci.value == " ") 
	{
		alert("Por favor, Verificar la descripcion, no se aceptan espacios al principio");
		document.getElementById("eradescripci").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("eradescripci").style.border = "";
		return true;
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ESPECIEACUATICA)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion de los campos
function ValidarFormEspAcuatica() 
{	
	var nomComEspAcu = document.getElementById("VerNomComEspAcu");
	if(nomComEspAcu.value < 1) 
	{
		alert("Por favor, Verificar el Nombre Comun de la Especie Acuatica");
		document.getElementById("eacnomcomun").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("eacnomcomun").style.border = "";
		var nomCientEspAcu = document.getElementById("VerNomCientEspAcu");
		if(nomCientEspAcu.value < 1) 
		{
			alert("Por favor, Verificar el Nombre Cientifico de la Especie Acuatica");
			document.getElementById("eacnomcienti").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("eacnomcienti").style.border = "";
			return true;
		}
	}
}
//Validacion Disponible-Ya Existe (Nombre Comun EspecieAcuatica)
$(document).ready(function()
{  
	$('#eacnomcomun').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var eacnomcomun = $(this).val();  
		var dataString = 'eacnomcomun='+eacnomcomun;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/especieacuatica/espnomcomunacuatica.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion Disponible-Ya Existe (Nombre Cientifico Especie)
$(document).ready(function()
{  
	$('#eacnomcienti').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var eacnomcienti = $(this).val();  
		var dataString = 'eacnomcienti='+eacnomcienti;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/especieacuatica/espnomcientiacuatica.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
</script>
<!--_________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ESTANQUE)    +++++++++++++++++++++++++++++++-->
<!--_________________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion de los campos
function ValidarFormEstanque() 
{	
	var nomEstanque = document.getElementById("VerNomEstanque");
	if(nomEstanque.value < 1) 
	{
		alert("Por favor, Verificar el Nombre del Estanque");
		document.getElementById("estnombre").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("estnombre").style.border = "";
		var estprofundid = document.getElementById("estprofundid");
		if(estprofundid.value == ".") 
		{
			alert("Por favor, Verificar la profundidad, no puede contener puntos(.) al principio");
			document.getElementById("estprofundid").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("estprofundid").style.border = "";
			var estespejagua = document.getElementById("estespejagua");
			if(estespejagua.value == ".") 
			{
				alert("Por favor, Verificar el espejo de agua, no puede contener puntos(.) al principio");
				document.getElementById("estespejagua").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("estespejagua").style.border = "";
				var estvolumagua = document.getElementById("estvolumagua");
				if(estvolumagua.value == ".") 
				{
					alert("Por favor, Verificar el volumen del agua, no puede contener puntos(.) al principio");
					document.getElementById("estvolumagua").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("estvolumagua").style.border = "";
					return true;
				}
			}
		}
	}
}
//Validacion Disponible-Ya Existe (Nombre Comun EspecieAcuatica)
$(document).ready(function()
{  
	$('#estnombre').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var estnombre = $(this).val();  
		var dataString = 'estnombre='+estnombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/estanque/estnombre.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion para permitir un solo punto en numeros Decimales
    function estunimedpro1(N)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var estanque1=document.getElementById("estprofundid").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && estanque1.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && estanque1.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function estespejagua2(N)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var estanque2=document.getElementById("estespejagua").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && estanque2.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && estanque2.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    function estvolumagua3(N)
    {
    	var teclaPulsada=window.event ? window.event.keyCode:N.which;
    	var estanque3=document.getElementById("estvolumagua").value;
    	if(teclaPulsada==13 || (teclaPulsada==46 && estanque3.indexOf(".")==-1))
    	{
    		return true;
    	}
    	if (teclaPulsada==08 && estanque3.indexOf(" ")==-1)
    	{
    		return true;
    	}
    	return /\d/.test(String.fromCharCode(teclaPulsada));
    }
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ESTANQUE_ESPECIEACUATICA)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Validacion de Campos
function ValidarFormEstEspAcua()
{
	var eearesponsab = document.getElementById("eearesponsab");
	if(eearesponsab.value == " ") 
	{
		alert("Por favor, Verificar el responssable, no se aceptan espacios al principio");
		document.getElementById("eearesponsab").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("eearesponsab").style.border = "";
		var fchinicioest_espacua = document.getElementById('eeafecsiembr').value; 
		var fchfinalest_espacua  = document.getElementById('eeafeccosech').value;
		fchinicioest_espacua= new Date(fchinicioest_espacua);
		fchfinalest_espacua= new Date(fchfinalest_espacua);
		if(fchinicioest_espacua>=fchfinalest_espacua)
		{
			alert('La Fecha de Cosecha debe ser mayor que la Fecha de Siembra');
			document.getElementById("eeafecsiembr").style.border = "2px solid red";
			document.getElementById("eeafeccosech").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("eeafecsiembr").style.border = "";
			document.getElementById("eeafeccosech").style.border = "";
			var eeadescripci = document.getElementById("eeadescripci");
			if(eeadescripci.value == " ") 
			{
				alert("Por favor, Verificar la descripcion, no se aceptan espacios al principio");
				document.getElementById("eeadescripci").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("eeadescripci").style.border = "";
				return true;
			}
		}
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (LA GRANJA)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Validacion de Campos
function ValidarFormLagranja()
{
	var lagnit = document.getElementById("lagnit");
	if(lagnit.value == " ") 
	{
		alert("Por favor, Verificar el codigo (NIT), no se aceptan espacios al principio");
		document.getElementById("lagnit").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("lagnit").style.border = "";
		var lagnombre = document.getElementById("lagnombre");
		if(lagnombre.value == " ") 
		{
			alert("Por favor, Verificar el nombre, no se aceptan espacios al principio");
			document.getElementById("lagnombre").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("lagnombre").style.border = "";
			var lagdireccio = document.getElementById("lagdireccio");
			if(lagdireccio.value == " ") 
			{
				alert("Por favor, Verificar la direccion, no se aceptan espacios al principio");
				document.getElementById("lagdireccio").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("lagdireccio").style.border = "";
				var lagdepartam = document.getElementById("lagdepartam");
				if(lagdepartam.value == " ") 
				{
					alert("Por favor, Verificar el departamento, no se aceptan espacios al principio");
					document.getElementById("lagdepartam").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("lagdepartam").style.border = "";
					var lagmunicipi = document.getElementById("lagmunicipi");
					if(lagmunicipi.value == " ") 
					{
						alert("Por favor, Verificar el municipio, no se aceptan espacios al principio");
						document.getElementById("lagmunicipi").style.border = "2px solid red";
						return false;
					}
					else
					{
						document.getElementById("lagmunicipi").style.border = "";
						var lagvereda = document.getElementById("lagvereda");
						if(lagvereda.value == " ") 
						{
							alert("Por favor, Verificar la vereda, no se aceptan espacios al principio");
							document.getElementById("lagvereda").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("lagvereda").style.border = "";
							var lagcodprenu = document.getElementById("lagcodprenu");
							if(lagcodprenu.value == " ") 
							{
								alert("Por favor, Verificar el codigo del predial nuevo, no se aceptan espacios al principio");
								document.getElementById("lagcodprenu").style.border = "2px solid red";
								return false;
							}
							else
							{
								document.getElementById("lagcodprenu").style.border = "";
								var lagcodprean = document.getElementById("lagcodprean");
								if(lagcodprean.value == " ") 
								{
									alert("Por favor, Verificar el codigo del predial anterior, no se aceptan espacios al principio");
									document.getElementById("lagcodprean").style.border = "2px solid red";
									return false;
								}
								else
								{
									document.getElementById("lagcodprean").style.border = "";
									var lagmatriinm = document.getElementById("lagmatriinm");
									if(lagmatriinm.value == " ") 
									{
										alert("Por favor, Verificar la matricula inmobilaria, no se aceptan espacios al principio");
										document.getElementById("lagmatriinm").style.border = "2px solid red";
										return false;
									}
									else
									{
										document.getElementById("lagmatriinm").style.border = "";
										var lagactiecon = document.getElementById("lagactiecon");
										if(lagactiecon.value == " ") 
										{
											alert("Por favor, Verificar la actividad economica, no se aceptan espacios al principio");
											document.getElementById("lagactiecon").style.border = "2px solid red";
											return false;
										}
										else
										{
											document.getElementById("lagactiecon").style.border = "";
											var lagareaterr = document.getElementById("lagareaterr");
											if(lagareaterr.value == ".") 
											{
												alert("Por favor, Verificar el area de terreno, no puede contener puntos(.) al principio");
												document.getElementById("lagareaterr").style.border = "2px solid red";
												return false;
											}
											else
											{
												document.getElementById("lagareaterr").style.border = "";
												var lagareconst = document.getElementById("lagareconst");
												if(lagareconst.value == ".") 
												{
													alert("Por favor, Verificar el area construida, no puede contener puntos(.) al principio");
													document.getElementById("lagareconst").style.border = "2px solid red";
													return false;
												}
												else
												{
													document.getElementById("lagareconst").style.border = "";
													var lagcanconst = document.getElementById("lagcanconst");
													if(lagcanconst.value == " ") 
													{
														alert("Por favor, Verificar la cantidad de construcciones, no se aceptan espacios al principio");
														document.getElementById("lagcanconst").style.border = "2px solid red";
														return false;
													}
													else
													{
														document.getElementById("lagcanconst").style.border = "";
														var lagaltitud = document.getElementById("lagaltitud");
														if(lagaltitud.value == ".") 
														{
															alert("Por favor, Verificar la altitud del mar, no puede contener puntos(.) al principio");
															document.getElementById("lagaltitud").style.border = "2px solid red";
															return false;
														}
														else
														{
															document.getElementById("lagaltitud").style.border = "";
															var lagplancha = document.getElementById("lagplancha");
															if(lagplancha.value == " ") 
															{
																alert("Por favor, Verificar el numero de la plancha, no se aceptan espacios al principio");
																document.getElementById("lagplancha").style.border = "2px solid red";
																return false;
															}
															else
															{
																document.getElementById("lagplancha").style.border = "";
																var lagescala = document.getElementById("lagescala");
																if(lagescala.value == " ") 
																{
																	alert("Por favor, Verificar la escala, no se aceptan espacios al principio");
																	document.getElementById("lagescala").style.border = "2px solid red";
																	return false;
																}
																else
																{
																	document.getElementById("lagescala").style.border = "";
																	return true;								
																}							
															}							
														}						
													}						
												}							
											}							
										}							
									}							
								}							
							}							
						}
					}
				}
			}
		}
	}
}
//Funcion de un sólo punto para Numeros Decimales(Area Terreno)	
function areaTerreno(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var lagareaterr=document.getElementById("lagareaterr").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && lagareaterr.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && lagareaterr.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Area Construida)	
function areaConstruida(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var lagareconst=document.getElementById("lagareconst").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && lagareconst.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && lagareconst.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Area Terreno)	
function altitudmar(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var lagaltitud=document.getElementById("lagaltitud").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && lagaltitud.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && lagaltitud.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
</script>
<!--_________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (LOTE)    +++++++++++++++++++++++++++++++-->
<!--_________________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion de los campos
function ValidarFormLote() 
{	
	var lotidcodigo = document.getElementById("VercodLote");
	if(lotidcodigo.value < 1) 
	{
		alert("Por favor, Verificar el codigo del lote");
		document.getElementById("lotidcodigo").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("lotidcodigo").style.border = "";
		var lotextension = document.getElementById("lotextension");
		if(lotextension.value == ".") 
		{
			alert("Por favor, Verificar la extension, no puede contener puntos(.) al principio");
			document.getElementById("lotextension").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("lotextension").style.border = "";
			return true;
		}
	}
}
//Validacion Disponible-Ya Existe (Codigo Lote)
$(document).ready(function()
{  
	$('#lotidcodigo').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var lotidcodigo = $(this).val();  
		var dataString = 'lotidcodigo='+lotidcodigo;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/lote/lotecodigo.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion para permitir un solo punto en numeros Decimales
function loteExtension(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var lotextension=document.getElementById("lotextension").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && lotextension.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && lotextension.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}    
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (LOTE_CULTIVO)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
//Validar el formulario
function ValidarFormLoteCultivo() 
{	
	var FecSiem = document.getElementById('lcufechsiemb').value; 
	var FecCos  = document.getElementById('lcufechcosec').value;
	FecSiem= new Date(FecSiem);
	FecCos= new Date(FecCos);
	if(FecSiem>=FecCos)
	{
		alert('La Fecha de Siembra debe ser mayor que la Fecha de Cosecha');
		document.getElementById("lcufechsiemb").style.border = "2px solid red";
		document.getElementById("lcufechcosec").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("lcufechsiemb").style.border = "";
		document.getElementById("lcufechcosec").style.border = "";
		var proEst = document.getElementById('lcuproduesti');
		if (proEst.value == ".") 
		{
			alert("Por favor, Verificar la produccion estimada, No puede contener un punto(.) al principo");
			document.getElementById("lcuproduesti").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("lcuproduesti").style.border = "";
			var proReal = document.getElementById('lcuprodureal');
			if (proReal.value == ".") 
			{
				alert("Por favor, Verificar la produccion real, No puede contener un punto(.) al principo");
				document.getElementById("lcuprodureal").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("lcuprodureal").style.border = "";
				var costProEst = document.getElementById('lcucosproest');
				if (costProEst.value == ".") 
				{
					alert("Por favor, Verificar el costo de produccion estimada, No puede contener un punto(.) al principo");
					document.getElementById("lcucosproest").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("lcucosproest").style.border = "";
					var costProEst = document.getElementById('lcucosprorea');
					if (costProEst.value == ".") 
					{
						alert("Por favor, Verificar el costo de produccion real, No puede contener un punto(.) al principo");
						document.getElementById("lcucosprorea").style.border = "2px solid red";
						return false;
					}
					else
					{
						document.getElementById("lcucosprorea").style.border = "";
						var responsable = document.getElementById("lcuresponsab");
						if(responsable.value == " ")//Si el valor del elemento contiene un espacio al principio, no se debe permitir guardar
						{
							alert("Por favor, Verificar el responsable, No puede contener ningun espacio al principio");
							document.getElementById("lcuresponsab").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("lcuresponsab").style.border = "";
							return true;
						}
					}
				}
			}
		}
	}
}
//Funcion de un sólo punto para Numeros Decimales(PRODUCCION ESTIMADA)
function ProdEstLoteCultivo(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var valor=document.getElementById("lcuproduesti").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(PRODUCCION REAL)
function ProdRealLoteCultivo(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var valor=document.getElementById("lcuprodureal").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(COSTO PRODUCCION ESTIMADA)
function CosProdEstLoteCultivo(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var valor=document.getElementById("lcucosproest").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(COSTO PRODUCCION REAL)
function CosProdRealLoteCultivo(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var valor=document.getElementById("lcucosprorea").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && valor.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}

</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (PLAGA)    +++++++++++++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Disponible-Ya Existe (CODIGO)
$(document).ready(function()
{  
	$('#plaidcodigo').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var plaidcodigo = $(this).val();  
		var dataString = 'plaidcodigo='+plaidcodigo;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/plaga/plaidcodigo.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Disponible-Ya Existe (NOMBRE COMUN)
$(document).ready(function()
{  
	$('#planomcomun').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var planomcomun = $(this).val();  
		var dataString = 'planomcomun='+planomcomun;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/plaga/planomcomun.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
//Disponible-Ya Existe (NOMBRE CIENTIFICO)
$(document).ready(function()
{  
	$('#planomcienti').blur(function()
	{
		$('#Info2').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var planomcienti = $(this).val();  
		var dataString = 'planomcienti='+planomcienti;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/plaga/planomcienti.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info2').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion de Campos
function ValidarFormPlaga()
{
	var plaidcodigo = document.getElementById("VercodPlaga");
	if(plaidcodigo.value < 1) 
	{
		alert("Por favor, Verificar Codigo de la Plaga");
		document.getElementById("plaidcodigo").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("plaidcodigo").style.border = "";
		var planomcomun = document.getElementById("VerNomComPlaga");
		if(planomcomun.value < 1) 
		{
			alert("Por favor, Verificar el Nombre Comun de la Plaga");
			document.getElementById("planomcomun").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("planomcomun").style.border = "";
			var planomcienti = document.getElementById("VerNomCientPlaga");
			if(planomcienti.value < 1) 
			{
				alert("Por favor, Verificar el Nombre Cientifico de la Plaga");
				document.getElementById("planomcienti").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("planomcienti").style.border = "";
				var planomcienti1 = document.getElementById("VerNomCientPlaga");
				if(planomcienti1.value == " ") 
				{
					alert("Por favor, Verificar el Nombre Cientifico de la Plaga")	;
					document.getElementById("planomcienti").style.border = "	2px solid red";
					return false;
				}
				else
				{
					return true;
				}
			}
		}
	}
}
</script>
<!--_____________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (PLAGA_ESPECIE)    +++++++++++++++++++++++++++++++-->
<!--_____________________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Validacion de Campos
function ValidarFormPlagaEspecie()
{
	var pesdescripci = document.getElementById("pesdescripci");
	if(pesdescripci.value == " ") 
	{
		alert("Por favor, Verificar la descripcion, no se aceptan espacios al principio");
		document.getElementById("pesdescripci").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("pesdescripci").style.border = "";
		return true;
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (PLAGAENFERMEDAD_CULTIVO)    +++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
//Validar el formulario
function ValidarFormPlaEnfCultivo()
{	
	var pcudescripci = document.getElementById("pcudescripci");
	if(pcudescripci.value == " ")
	{
		alert("Por favor, Verificar la descripción, no puede contener espacios al principio ¡borre los espacios!");
		document.getElementById("pcudescripci").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("pcudescripci").style.border = "";
		return true;
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (PLAGAENFERMEDAD_VEGETAL)    +++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
//Validar el formulario
function ValidarFormPlaEnfVegetal()
{	
	var pvedescripci = document.getElementById("pvedescripci");
	if(pvedescripci.value == " ")
	{
		alert("Por favor, Verificar la descripción, no puede contener espacios al principio ¡borre los espacios!");
		document.getElementById("pvedescripci").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("pvedescripci").style.border = "";
		return true;
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (PLAGAENFERMEDAD)    +++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
	function ValidarFormPlagaEnfer() 
	{	
		var pennomcomun = document.getElementById("VerPlaEnfNomComun");
		if(pennomcomun.value < 1) 
		{
			alert("Por favor, Verificar el Nombre Comun");
			document.getElementById("pennomcomun").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("pennomcomun").style.border = "";
			var pennomcienti = document.getElementById("VerPlaEnfNomCientifico");
			if(pennomcienti.value < 1) 
			{
				alert("Por favor, Verificar el Nombre Cientifico");
				document.getElementById("pennomcienti").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("pennomcienti").style.border = "";
				var pulsado = false;//variable de comprobación
				var opciones = document.formulario.pentipmanejo; //array de elementos
				var elegido = -1; //número del elemento elegido en el array
				for (i=0;i<opciones.length;i++) 
				{ //bucle de comprobación
					if (opciones[i].checked == true) 
					{
						pulsado = true 
						elegido = i //número del elemento elegido en el array
					}
				}
				if (pulsado == false) 
				{
					alert("Por Favor, Seleccione el Tipo de Manejo");
					document.getElementById('Radio').style.border="2px solid red";
					return false;
				}
				else
				{
					document.getElementById("Radio").style.border = "";
					var pulsado = false;//variable de comprobación
					var opciones = document.formulario.checkboxz; //array de elementos
					var elegido = -1; //número del elemento elegido en el array
					for (i=0;i<opciones.length;i++) 
					{ //bucle de comprobación
						if (opciones[i].checked == true) 
						{
							pulsado = true 
							elegido = i //número del elemento elegido en el array
						}
					}
					if (pulsado == false) 
					{
						alert("Por Favor, Seleccione la Zona de Afectacion");
						document.getElementById('checkbox').style.border="2px solid red";
						return false;
					}
					else
					{
						document.getElementById('checkbox').style.border="";
						var pendescripci = document.getElementById("pendescripci");
						if(pendescripci.value == " ")
						{
							alert("Por favor, Verificar la descripción, no puede contener espacios al principio ¡borre los espacios!");
							document.getElementById("pendescripci").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("pendescripci").style.border = "";
							return true;
						}
					}
				}
			}
		}
	}
//Validacion Disponible-Ya Existe (Nombre Comun)	
$(document).ready(function()
{  
	$('#pennomcomun').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var pennomcomun = $(this).val();  
		var dataString = 'pennomcomun='+pennomcomun;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/plagaenfermedad/plaenfnomcomun.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//Validacion Disponible-Ya Existe (Nombre Cientifico)
$(document).ready(function()
{  
	$('#pennomcienti').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" class="LoadIcon"/>').fadeOut(1000);
		var pennomcienti = $(this).val();  
		var dataString = 'pennomcienti='+pennomcienti;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/plagaenfermedad/plaenfnomcientifico.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (POSTE)    +++++++++++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
	function ValidarFormPoste()
	{
		var posidcodigo = document.getElementById("VercodPoste");
		if(posidcodigo.value < 1) 
		{
			alert("Por favor, Verificar el Codigo del Poste");
			document.getElementById("posidcodigo").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("posidcodigo").style.border = "";
			var posaltura = document.getElementById("posaltura");
			if(posaltura.value == ".") 
			{
				alert("Por favor, Verificar la Altura, no puede contener puntos(.) al principio");
				document.getElementById("posaltura").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("posaltura").style.border = "";
				var pulsado1 = false;//variable de comprobación
				var opciones1 = document.formulario.posalumbrado; //array de elementos
				var elegido1 = -1; //número del elemento elegido en el array
				for (j=0;j<opciones1.length;j++) 
				{ //bucle de comprobación
					if (opciones1[j].checked == true) 
					{
						pulsado1 = true 
						elegido1 = j //número del elemento elegido en el array
					}
				}
				if (pulsado1 == false) 
				{
					alert("Por Favor, Seleccione el Tipo de Iluminacion");
					document.getElementById('Iluminacion').style.border="2px solid red";
					return false;
				}
				else
				{
					document.getElementById("Iluminacion").style.border = "";
					var pulsado2 = false;//variable de comprobación
					var opciones2 = document.formulario.posestalumbr; //array de elementos
					var elegido1 = -1; //número del elemento elegido en el array
					for (k=0;k<opciones2.length;k++) 
					{ //bucle de comprobación
						if (opciones2[k].checked == true) 
						{
							pulsado2 = true 
							elegido1 = k //número del elemento elegido en el array
						}
					}
					if (pulsado2 == false) 
					{
						alert("Por Favor, Seleccione el Estado de la Iluminación");
						document.getElementById('EstIluminacion').style.border="2px solid red";
						return false;
					}
					else
					{
						document.getElementById("EstIluminacion").style.border = "";
						var pulsado3 = false;//variable de comprobación
						var opciones3 = document.formulario.postransform; //array de elementos
						var elegido3 = -1; //número del elemento elegido en el array
						for (l=0;l<opciones3.length;l++) 
						{ //bucle de comprobación
							if (opciones3[l].checked == true) 
							{
								pulsado3 = true 
								elegido3 = l //número del elemento elegido en el array
							}
						}
						if (pulsado3 == false) 
						{
							alert("Por Favor, Seleccione el Transformador");
							document.getElementById('Transformador').style.border="2px solid red";
							return false;
						}
						else
						{
							document.getElementById("Transformador").style.border = "";
							var pulsado4 = false;//variable de comprobación
							var opciones4 = document.formulario.posesttransf; //array de elementos
							var elegido4 = -1; //número del elemento elegido en el array
							for (m=0;m<opciones4.length;m++) 
							{ //bucle de comprobación
								if (opciones4[m].checked == true) 
								{
									pulsado4 = true 
									elegido4 = m //número del elemento elegido en el array
								}
							}
							if (pulsado4 == false) 
							{
								alert("Por Favor, Seleccione el Estado del Transformador");
								document.getElementById('EstTransf').style.border="2px solid red";
								return false;
							}
							else
							{
								document.getElementById("EstTransf").style.border = "";
								return true;
							}
						}
					}
				}
			}
		}
	}
//Validacion Disponible-Ya Existe (Codigo)
$(document).ready(function()
{	
	$('#posidcodigo').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var posidcodigo = $(this).val();	
		var dataString = 'posidcodigo='+posidcodigo;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/poste/posidcodigo.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion para permitir un solo punto en numeros Decimales
function posteAltura(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var posaltura=document.getElementById("posaltura").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && posaltura.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && posaltura.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Validacion para Habilitar las opciones del RadioButton
function habilitaEstIluminacion(form)
{ 
form.posestalumbr[0].disabled = false;
form.posestalumbr[1].disabled = false;
form.posestalumbr[2].disabled = false;
form.posestalumbr[3].disabled = true;
}
//Validacion para Deshabilitar las opciones del RadioButton
function deshabilitaEstIluminacion(form)
{ 
form.posestalumbr[0].disabled = true;
form.posestalumbr[1].disabled = true;
form.posestalumbr[2].disabled = true;
form.posestalumbr[3].disabled = false;
}
//Validacion para Habilitar las opciones del RadioButton
function habilitaEstTransf(form)
{ 
form.posesttransf[0].disabled = false;
form.posesttransf[1].disabled = false;
form.posesttransf[2].disabled = false;
form.posesttransf[3].disabled = true;
}
//Validacion para Deshabilitar las opciones del RadioButton
function deshabilitaEstTransf(form)
{ 
form.posesttransf[0].disabled = true;
form.posesttransf[1].disabled = true;
form.posesttransf[2].disabled = true;
form.posesttransf[3].disabled = false;
}
</script>
<!--____________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (PROGRAMA DE FORMACION)    +++++++++++++++++++++-->
<!--____________________________________________________________________________________________________-->
<script type="text/javascript">
  function ValidarFormProgrForma()
    {
      var ProgramaFormacion = document.getElementById("VerNomProgrForma");
        if(ProgramaFormacion.value == 0) 
          {
            alert("Por favor, Verificar el Nombre del Programa de Formacion");
            document.getElementById("pfonombre").style.border = "2px solid red";
            return false;
          }
        else
          {
          	document.getElementById("pfonombre").style.border = "";
          	var pfodescripci = document.getElementById("pfodescripci");
			if(pfodescripci.value == " ") 
			{
				alert("Por favor, Verificar la descripcion, no se aceptan espacios al principio");
				document.getElementById("pfodescripci").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("pfodescripci").style.border = "";
				return true;
			}
          }
   	}
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#pfonombre').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var pfonombre = $(this).val();	
		var dataString = 'pfonombre='+pfonombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/programaformacion/pfonombre.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});    
</script>
<!--____________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (PUNTO ESPECIAL)    ++++++++++++++++++++++++++++-->
<!--____________________________________________________________________________________________________-->
<script type="text/javascript">
  function ValidarFormPuntoEspecial()
    {
      var pesnombre = document.getElementById("VerNomPuntEsp");
        if(pesnombre.value == 0) 
          {
            alert("Por favor, Verificar el Nombre del Punto Especial");
            document.getElementById("pesnombre").style.border = "2px solid red";
            return false;
          }
        else
          {
          	document.getElementById("pesnombre").style.border = "";
          	var pesdescripci = document.getElementById("pesdescripci");
			if(pesdescripci.value == " ") 
			{
				alert("Por favor, Verificar la descripcion, no se aceptan espacios al principio");
				document.getElementById("pesdescripci").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("pesdescripci").style.border = "";
				return true;
			}
          }
   	}
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#pesnombre').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var pesnombre = $(this).val();	
		var dataString = 'pesnombre='+pesnombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/puntoespecial/pesnombre.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});    
</script>
<!--____________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (RAZA)    ++++++++++++++++++++++++++++-->
<!--____________________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#raznombre').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var raznombre = $(this).val();	
		var dataString = 'raznombre='+raznombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/raza/raznombre.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion de los campos
function ValidarFormRaza()
{
	var raznombre = document.getElementById("VerNomRaza");
	if(raznombre.value < 1) 
	{
		alert("Por favor, Verificar el Nombre de la Raza");
		document.getElementById("raznombre").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("raznombre").style.border = "";
		var razproducion = document.getElementById("razproducion");
		if(razproducion.value == ".") 
		{
			alert("Por favor, Verificar la Produccion, no puede contener puntos(.) al principio");
			document.getElementById("razproducion").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("razproducion").style.border = "";
			if(razcarfenoti.value == " ") 
			{
				alert("Por favor, Verificar el Fenotipo, no se aceptan espacios al principio");
				document.getElementById("razcarfenoti").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("razcarfenoti").style.border = "";
			}
		}
	}
}
//Validacion para los decimales(Produccion raza)
function ProdRaza(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var razproducion=document.getElementById("razproducion").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && razproducion.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && razproducion.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
</script>
<!--___________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (RED_ELECTRICA)    ++++++++++++++++++++++++++++-->
<!--___________________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#eleconstrucc').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var eleconstrucc = $(this).val();	
		var dataString = 'eleconstrucc='+eleconstrucc;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/red_electrica/eleconstrucc.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion de los campos
function ValidarFormRedElectrica()
{
	var eleconstrucc = document.getElementById("VerConstRedElec");
	if(eleconstrucc.value < 1) 
	{
		alert("Por favor, Verificar la Construcción de la Red Electrica");
		document.getElementById("eleconstrucc").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("eleconstrucc").style.border = "";
		return true;
	}
}
//Validacion para Habilitar las opciones del RadioButton
function habilitarCantVentilacion(value)
{
	if(value=="AIRE ACONDICIONADO")
	{
		// habilitamos
		document.getElementById("elecantidad").disabled=false;
		document.getElementById("elecantidad").style.background = "#fff";
	}
	else if(value=="VENTILADORES")
	{
		// deshabilitamos
		document.getElementById("elecantidad").disabled=false;
		document.getElementById("elecantidad").style.background = "#fff";
	}
	else if(value=="N/A")
	{
		// deshabilitamos
		document.getElementById("elecantidad").disabled=true;
		document.getElementById("elecantidad").style.background = "#EDE9E9";
	}
}
</script>
<!--___________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (RED_GAS)    ++++++++++++++++++++++++++++-->
<!--___________________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#rgaconstrucc').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var rgaconstrucc = $(this).val();	
		var dataString = 'rgaconstrucc='+rgaconstrucc;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/red_gas/rgaconstrucc.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion de los campos
function ValidarFormRedGas()
{
	var rgaconstrucc = document.getElementById("VerConstRedGas");
	if(rgaconstrucc.value < 1) 
	{
		alert("Por favor, Verificar la Construcción de la Red de Gas");
		document.getElementById("rgaconstrucc").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("rgaconstrucc").style.border = "";
		return true;
	}
}
</script>
<!--________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (RED_LOGICA)    ++++++++++++++++++++++++++++-->
<!--________________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#rloconstrucc').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var rloconstrucc = $(this).val();	
		var dataString = 'rloconstrucc='+rloconstrucc;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/red_logica/rloconstrucc.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion de los campos
function ValidarFormRedLogica()
{
	var rloconstrucc = document.getElementById("VerConstRedLogica");
	if(rloconstrucc.value < 1) 
	{
		alert("Por favor, Verificar la Construcción de la Red Lógica");
		document.getElementById("rloconstrucc").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("rloconstrucc").style.border = "";
		var pulsado5 = false;
		var opciones5 = document.formulario.rlozonawifi;
		var elegido5 = -1;
		for (g=0;g<opciones5.length;g++)
		{
			if (opciones5[g].checked == true) 
			{
				pulsado5 = true;
				elegido5 = g
			}
		}
		if (pulsado5 == false) 
		{
			alert("Por favor, Seleccione una opcion del WiFi");
			document.getElementById('ZonaWiFi').style.border="2px solid red";
			return false;
		}
		else
		{
			document.getElementById('ZonaWiFi').style.border="";
			var pulsado6 = false;//variable de comprobación
			var opciones6 = document.formulario.rloredalambr; //array de elementos
			var elegido6 = -1; //número del elemento elegido en el array
			for (u=0;u<opciones6.length;u++) 
			{ //bucle de comprobación
				if (opciones6[u].checked == true) 
				{
					pulsado6 = true 
					elegido6 = u //número del elemento elegido en el array
				}
			}
			if (pulsado6 == false) 
			{
				alert("Por Favor, Seleccione una opcion de la Red Alambrica");
				document.getElementById('RedAlambrica').style.border="2px solid red";
				return false;
			}
			else
			{
				document.getElementById("RedAlambrica").style.border = "";
				return true;
				/*var pulsado7 = false;//variable de comprobación
				var opciones7 = document.formulario.rlorack; //array de elementos
				var elegido7 = -1; //número del elemento elegido en el array
				for (c=0;c<opciones7.length;c++) 
				{ //bucle de comprobación
					if (opciones7[c].checked == true) 
					{
						pulsado7 = true 
						elegido7 = c //número del elemento elegido en el array
					}
				}
				if (pulsado7 == false) 
				{
					alert("Por Favor, Seleccione una opcion del Rack");
					document.getElementById('Rack').style.border="2px solid red";
					return false;
				}
				else
				{
					return true;
				}*/
			}
		}
	}
}
//++++++++++++++++++   **PRIMER** VALIDACION DE HAB Y DESHAB   ++++++++++++++++++++++++++++++++++++
//Validacion para Habilitar las opciones del RadioButton
function habilitaCantAccesPoint(form)
{ 
	document.getElementById("rlocantacces").disabled=false;
	document.getElementById("rlocantacces").style.background = "#fff";
}
//Validacion para Deshabilitar las opciones del RadioButton
function deshabilitaCantAccesPoint(form)
{ 
	document.getElementById("rlocantacces").disabled=true;
	document.getElementById("rlocantacces").style.background = "#EDE9E9";
}
//++++++++++++++++++   **SEGUNDA** VALIDACION DE HAB Y DESHAB   ++++++++++++++++++++++++++++++++++++
//Validacion para habilitar/deshabilitar el input, deacuerdo a la opcion anterior del input-Radio
function habilitaTodosCampos(form)
{ 
	document.getElementById("rlocantanale").disabled=false;
	document.getElementById("rlocantanale").style.background = "#fff";

	document.getElementById("rlounimedcca").disabled=false;
	document.getElementById("rlounimedcca").style.background = "#fff";

	document.getElementById("rlocantrj").disabled=false;
	document.getElementById("rlocantrj").style.background = "#fff";

	document.getElementById("rlocantfibop").disabled=false;
	document.getElementById("rlocantfibop").style.background = "#fff";

	document.getElementById("rlocategoutp").disabled=false;
	document.getElementById("rlocategoutp").style.background = "#fff";

	document.getElementById("rlotopologia").disabled=false;
	document.getElementById("rlotopologia").style.background = "#fff";

	document.getElementById("rlodistribuc").disabled=false;
	document.getElementById("rlodistribuc").style.background = "#fff";

	form.rlorack[0].disabled = false;
	form.rlorack[1].disabled = false;

	document.getElementById("rlocantswitc").disabled=false;
	document.getElementById("rlocantswitc").style.background = "#fff";

	document.getElementById("rlocantregle").disabled=false;
	document.getElementById("rlocantregle").style.background = "#fff";

	document.getElementById("rlocantups").disabled=false;
	document.getElementById("rlocantups").style.background = "#fff";
}
//Validacion para Deshabilitar las opciones del RadioButton
function deshabilitaTodosCampos(form)
{ 
	document.getElementById("rlocantanale").disabled=true;
	document.getElementById("rlocantanale").style.background = "#EDE9E9";

	document.getElementById("rlounimedcca").disabled=true;
	document.getElementById("rlounimedcca").style.background = "#EDE9E9";

	document.getElementById("rlocantrj").disabled=true;
	document.getElementById("rlocantrj").style.background = "#EDE9E9";

	document.getElementById("rlocantfibop").disabled=true;
	document.getElementById("rlocantfibop").style.background = "#EDE9E9";

	document.getElementById("rlocategoutp").disabled=true;
	document.getElementById("rlocategoutp").style.background = "#EDE9E9";

	document.getElementById("rlotopologia").disabled=true;
	document.getElementById("rlotopologia").style.background = "#EDE9E9";

	document.getElementById("rlodistribuc").disabled=true;
	document.getElementById("rlodistribuc").style.background = "#EDE9E9";

	form.rlorack[0].disabled = true;
	form.rlorack[1].disabled = true;

	document.getElementById("rlocantswitc").disabled=true;
	document.getElementById("rlocantswitc").style.background = "#EDE9E9";

	document.getElementById("rlocantregle").disabled=true;
	document.getElementById("rlocantregle").style.background = "#EDE9E9";

	document.getElementById("rlocantups").disabled=true;
	document.getElementById("rlocantups").style.background = "#EDE9E9";
}
</script>
<!--___________________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (RED_SANITARIA)    ++++++++++++++++++++++++++++-->
<!--___________________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#rsaconstrucc').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var rsaconstrucc = $(this).val();	
		var dataString = 'rsaconstrucc='+rsaconstrucc;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/red_sanitaria/rsaconstrucc.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion de los campos
function ValidarFormRedSani()
{
	var rsaconstrucc = document.getElementById("VerConstRedSani");
	if(rsaconstrucc.value < 1) 
	{
		alert("Por favor, Verificar la Construcción de la Red de Gas");
		document.getElementById("rsaconstrucc").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("rsaconstrucc").style.border = "";
		return true;
	}
}
</script>
<!--__________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (RUTA)    ++++++++++++++++++++++++++++-->
<!--__________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion Disponible-Ya Existe (Codigo)
$(document).ready(function()
{	
	$('#rutidcodigo').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var rutidcodigo = $(this).val();	
		var dataString = 'rutidcodigo='+rutidcodigo;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/ruta/rutcodigo.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#rutnombre').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var rutnombre = $(this).val();	
		var dataString = 'rutnombre='+rutnombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/ruta/rutnombre.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion de los campos
function ValidarFormRuta()
{
	var rutidcodigo = document.getElementById("VercodRuta");
	if(rutidcodigo.value < 1) 
	{
		alert("Por favor, Verificar el Codigo de la Ruta");
		document.getElementById("rutidcodigo").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("rutidcodigo").style.border = "";
		var rutnombre = document.getElementById("VernomRuta");
		if(rutnombre.value < 1) 
		{
			alert("Por favor, Verificar el Nombre de la Ruta");
			document.getElementById("rutnombre").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("rutnombre").style.border = "";
			var rutdistancia = document.getElementById("rutdistancia");
			if(rutdistancia.value == ".") 
			{
				alert("Por favor, Verificar la Distancia, no puede contener puntos(.) al principio");
				document.getElementById("rutdistancia").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("rutdistancia").style.border = "";
				var ruttierecorr = document.getElementById("ruttierecorr");
				if(ruttierecorr.value == ".") 
				{
					alert("Por favor, Verificar el Timpo Recorrido, no puede contener puntos(.) al principio");
					document.getElementById("ruttierecorr").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("ruttierecorr").style.border = "";
					var rutdescripci = document.getElementById("rutdescripci");
					if(rutdescripci.value == " ") 
					{
						alert("Por favor, Verificar la Descripcion, No puede Contener Espacios al principio");
						document.getElementById("rutdescripci").style.border = "2px solid red";
						return false;
					}
					else
					{
						document.getElementById("rutdescripci").style.border = "";
						return true;
					}
				}
			}
		}
	}
}
//Funcion de un sólo punto para Numeros Decimales(Ruta Distancia)
function RutDistancia(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var rutdistancia=document.getElementById("rutdistancia").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && rutdistancia.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && rutdistancia.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function RutTiempoRec(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var ruttierecorr=document.getElementById("ruttierecorr").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && ruttierecorr.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && ruttierecorr.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
</script>
<!--__________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (RUTA_UNIDAD)    ++++++++++++++++++++++++++++-->
<!--__________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion de los campos
function ValidarFormRutaUnidad()
{
	var rundistancia = document.getElementById("rundistancia");
	if(rundistancia.value == ".") 
	{
		alert("Por favor, Verificar la Distancia, no puede contener puntos(.) al principio");
		document.getElementById("rundistancia").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("rundistancia").style.border = "";
		var runtierecorr = document.getElementById("runtierecorr");
		if(runtierecorr.value == ".") 
		{
			alert("Por favor, Verificar el Tiempo Recorrido, no puede contener puntos(.) al principio");
			document.getElementById("runtierecorr").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("runtierecorr").style.border = "";
			return true;
		}
	}
}
//Funcion de un sólo punto para Numeros Decimales(Ruta Distancia)
function RutUniDistancia(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var rundistancia=document.getElementById("rundistancia").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && rundistancia.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && rundistancia.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function RutUniTiempoRec(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var runtierecorr=document.getElementById("runtierecorr").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && runtierecorr.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && runtierecorr.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
</script>
<!--__________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (SUELO)    ++++++++++++++++++++++++++++-->
<!--__________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion de los campos
function ValidarFormSuelo()
{
	var suefhumedad = document.getElementById("suefhumedad");
	if(suefhumedad.value == ".") 
	{
		alert("Por favor, Verificar la Humedad, no puede contener puntos(.) al principio");
		document.getElementById("suefhumedad").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("suefhumedad").style.border = "";
		var suefporocida = document.getElementById("suefporocida");
		if(suefporocida.value == ".") 
		{
			alert("Por favor, Verificar la Porocidad, no puede contener puntos(.) al principio");
			document.getElementById("suefporocida").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("suefporocida").style.border = "";
			var suefconsiste = document.getElementById("suefconsiste");
			if(suefconsiste.value == ".") 
			{
				alert("Por favor, Verificar la Consistencia, no puede contener puntos(.) al principio");
				document.getElementById("suefconsiste").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("suefconsiste").style.border = "";
				var suefcondelet = document.getElementById("suefcondelet");
				if(suefcondelet.value == ".") 
				{
					alert("Por favor, Verificar la Conductividad Eléctrica, no puede contener puntos(.) al principio");
					document.getElementById("suefcondelet").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("suefcondelet").style.border = "";
					var sueqnitrogen = document.getElementById("sueqnitrogen");
					if(sueqnitrogen.value == ".") 
					{
						alert("Por favor, Verificar el Nitrógeno, no puede contener puntos(.) al principio");
						document.getElementById("sueqnitrogen").style.border = "2px solid red";
						return false;
					}
					else
					{
						document.getElementById("sueqnitrogen").style.border = "";
						var sueqfosforo = document.getElementById("sueqfosforo");
						if(sueqfosforo.value == ".") 
						{
							alert("Por favor, Verificar el Fósforo, no puede contener puntos(.) al principio");
							document.getElementById("sueqfosforo").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("sueqfosforo").style.border = "";
							var sueqpotacio = document.getElementById("sueqpotacio");
							if(sueqpotacio.value == ".") 
							{
								alert("Por favor, Verificar el Potacio, no puede contener puntos(.) al principio");
								document.getElementById("sueqpotacio").style.border = "2px solid red";
								return false;
							}
							else
							{
								document.getElementById("sueqpotacio").style.border = "";
								var sueqph = document.getElementById("sueqph");
								if(sueqph.value == ".") 
								{
									alert("Por favor, Verificar el PH, no puede contener puntos(.) al principio");
									document.getElementById("sueqph").style.border = "2px solid red";
									return false;
								}
								else
								{
									document.getElementById("sueqph").style.border = "";
									var suebactimicr = document.getElementById("suebactimicr");
									if(suebactimicr.value == ".") 
									{
										alert("Por favor, Verificar la Actividad Microbiana, no puede contener puntos(.) al principio");
										document.getElementById("suebactimicr").style.border = "2px solid red";
										return false;
									}
									else
									{
										document.getElementById("suebactimicr").style.border = "";
										var suebmasmicro = document.getElementById("suebmasmicro");
										if(suebmasmicro.value == ".") 
										{
											alert("Por favor, Verificar la Masa Microbiana, no puede contener puntos(.) al principio");
											document.getElementById("suebmasmicro").style.border = "2px solid red";
											return false;
										}
										else
										{
											document.getElementById("suebmasmicro").style.border = "";
											var suebmateorga = document.getElementById("suebmateorga");
											if(suebmateorga.value == ".") 
											{
												alert("Por favor, Verificar la Materia Organica, no puede contener puntos(.) al principio");
												document.getElementById("suebmateorga").style.border = "2px solid red";
												return false;
											}
											else
											{
												document.getElementById("suebmateorga").style.border = "";
												return true;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
//Funcion de un sólo punto para Numeros Decimales(Ruta Distancia)
function SueloHume(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var suefhumedad=document.getElementById("suefhumedad").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && suefhumedad.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && suefhumedad.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloPoro(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var suefporocida=document.getElementById("suefporocida").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && suefporocida.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && suefporocida.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloConsi(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var suefconsiste=document.getElementById("suefconsiste").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && suefconsiste.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && suefconsiste.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloCoEl(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var suefcondelet=document.getElementById("suefcondelet").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && suefcondelet.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && suefcondelet.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloNitr(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var sueqnitrogen=document.getElementById("sueqnitrogen").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && sueqnitrogen.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && sueqnitrogen.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloFosf(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var sueqfosforo=document.getElementById("sueqfosforo").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && sueqfosforo.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && sueqfosforo.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloPota(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var sueqpotacio=document.getElementById("sueqpotacio").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && sueqpotacio.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && sueqpotacio.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloPH(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var sueqph=document.getElementById("sueqph").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && sueqph.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && sueqph.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloAcMi(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var suebactimicr=document.getElementById("suebactimicr").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && suebactimicr.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && suebactimicr.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SueloMaMi(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var suebmasmicro=document.getElementById("suebmasmicro").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && suebmasmicro.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && suebmasmicro.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function SuloMaOr(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var suebmateorga=document.getElementById("suebmateorga").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && suebmateorga.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && suebmateorga.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
</script>
<!--__________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (UNIDAD)    ++++++++++++++++++++++++++++-->
<!--__________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#uninombre').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var uninombre = $(this).val();	
		var dataString = 'uninombre='+uninombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/unidad/uninombre.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion de los campos
function ValidarFormUnidad()
{
	var uninombre = document.getElementById("VerNomUnidad");
	if(uninombre.value < 1)
	{
		alert("Por favor, Verificar el Nombre de la Unidad");
		document.getElementById("uninombre").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("uninombre").style.border = "";
		var uniextension = document.getElementById("uniextension");
		if(uniextension.value == ".") 
		{
			alert("Por favor, Verificar la Extension, No puede contener puntos(.) al principio.");
			document.getElementById("uniextension").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("uniextension").style.border = "";
			var uniresponsab = document.getElementById("uniresponsab");
			if(uniresponsab.value == " ") 
			{
				alert("Por favor, Verificar el Responsable de la Unidad, No puede contener espacios al principio.");
				document.getElementById("uniresponsab").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("uniresponsab").style.border = "";
				var unidescripci = document.getElementById("unidescripci");
				if(unidescripci.value == " ") 
				{
					alert("Por favor, Verificar la Descripción, No puede Contener espacios al principio.");
					document.getElementById("unidescripci").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("unidescripci").style.border = "";
					return true;
				}
			}
		}
	}
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function UnidadExtension(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var uniextension=document.getElementById("uniextension").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && uniextension.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && uniextension.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
</script>
<!--__________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (UNIDAD_CANAL)    ++++++++++++++++++++-->
<!--__________________________________________________________________________________________-->
<script type="text/javascript">
function ValidarFormUnidadCanal()
{
	var cundistancia = document.getElementById("cundistancia");
	if(cundistancia.value == ".") 
	{
		alert("Por favor, Verificar la Distancia, No puede contener puntos(.) al principio.");
		document.getElementById("cundistancia").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("cundistancia").style.border = "";
		var cundescripci = document.getElementById("cundescripci");
		if(cundescripci.value == " ") 
		{
			alert("Por favor, Verificar la Descripción, No puede contener Espacios al principio.");
			document.getElementById("cundescripci").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("cundescripci").style.border = "";
			return true;
		}
	}
}
//Funcion de un sólo punto para Numeros Decimales(Tiempo Recorrido)
function UniCanDistancia(N)
{
	var teclaPulsada=window.event ? window.event.keyCode:N.which;
	var cundistancia=document.getElementById("cundistancia").value;
	if(teclaPulsada==13 || (teclaPulsada==46 && cundistancia.indexOf(".")==-1))
	{
		return true;
	}
	if (teclaPulsada==08 && cundistancia.indexOf(" ")==-1)
	{
		return true;
	}
	return /\d/.test(String.fromCharCode(teclaPulsada));
}
</script>
<!--__________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (UNIDAD_MEDIDA)    +++++++++++++++++++-->
<!--__________________________________________________________________________________________-->
<script type="text/javascript">
//Validación Campos
function ValidarFormUnidadMedida() 
{	
	var umenombre = document.getElementById("VerNomUniMed");
	if(umenombre.value < 1) 
	{
		alert("Por Favor, Verificar el Nombre de la Unidad de Medida");
		document.getElementById("umenombre").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("umenombre").style.border = "";
		var umerepreset = document.getElementById("VerRepreUniMed");
		if(umerepreset.value < 1) 
		{
			alert("Por Favor, Verificar el Símbolo de la Unidad de Medida");
			document.getElementById("umerepreset").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("umerepreset").style.border = "";
		}
	}
}
//Validacion Disponible-Ya Existe (Nombre)
$(document).ready(function()
{	
	$('#umenombre').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var umenombre = $(this).val();	
		var dataString = 'umenombre='+umenombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/unidadmedida/umenombre.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion Disponible-Ya Existe (Representación "Símbolo")
$(document).ready(function()
{	
	$('#umerepreset').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var umerepreset = $(this).val();	
		var dataString = 'umerepreset='+umerepreset;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/unidadmedida/umerepreset.php",
			data: dataString,
			success: function(data)
			{
				$('#Info1').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
</script>
<!--__________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (VEGETAL)    +++++++++++++++++++-->
<!--__________________________________________________________________________________________-->
<script src="JS/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
//Validar Campos
function ValidarFormVegetal()
{
	var vegnomcomun = document.getElementById("VerNomComVegetal");
	if(vegnomcomun.value < 1) 
	{
		alert("Por favor, Verificar el Nombre Comun del Vegetal");
		document.getElementById("vegnomcomun").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("vegnomcomun").style.border = "";
		var vegnomcienti = document.getElementById("VerNomCienVegetal");
		if(vegnomcienti.value < 1) 
		{
			alert("Por favor, Verificar el Nombre Cientifico del Vegetal");
			document.getElementById("vegnomcienti").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("vegnomcienti").style.border = "";
			var vegdescripci = document.getElementById("vegdescripci");
			if(vegdescripci.value < 1) 
			{
				alert("Por favor, Verificar la Descripción, no puede contener espacios al principio");
				document.getElementById("vegdescripci").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("vegdescripci").style.border = "";
				return true;
			}
		}
	}
}
//Validacion Disponible-Ya Existe (Nombre Comun)
$(document).ready(function()
{	
	$('#vegnomcomun').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var vegnomcomun = $(this).val();	
		var dataString = 'vegnomcomun='+vegnomcomun;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/vegetal/vegnomcomun.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Validacion Disponible-Ya Existe (Nombre Cientifico)
$(document).ready(function()
{	
	$('#vegnomcienti').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var vegnomcienti = $(this).val();	
		var dataString = 'vegnomcienti='+vegnomcienti;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/vegetal/vegnomcienti.php",
			data: dataString,
			success: function(data)
			{
				$('#Info1').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
</script>
<!--__________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ZONA VERDE)    +++++++++++++++++++-->
<!--__________________________________________________________________________________________-->
<script type="text/javascript">
//Validacion Disponible-Ya Existe (Codigo)
$(document).ready(function()
{	
	$('#zveidcodigo').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif" alt="" class="LoadIcon"/>').fadeOut(1000);
		var zveidcodigo = $(this).val();	
		var dataString = 'zveidcodigo='+zveidcodigo;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/zonaverde/zveidcodigo.php",
			data: dataString,
			success: function(data)
			{
				$('#Info').fadeIn(1000).html(data);
			//alert(data);
			}	
		});
	});              
});
//Funcion de un sólo punto para Numeros Decimales(Extension)
function PuntoExtZonVer(N)
{
var teclaPulsada=window.event ? window.event.keyCode:N.which;
var valor=document.getElementById("zveextension").value;
if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
  {
      return true;
  }
return /\d/.test(String.fromCharCode(teclaPulsada));
}
//Validacion de los Campos
function ValidarFormZonaVerde()
{
	var zveidcodigo = document.getElementById("VerZonVerCod");
	if(zveidcodigo.value < 1) 
	{
		alert("Por favor, Verificar el Codigo de la Zona Verde");
		document.getElementById("zveidcodigo").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("zveidcodigo").style.border = "";
		var zveextension = document.getElementById("zveextension");
		if(zveextension.value == ".") 
		{
			alert("Por favor, Verificar la extension, no puede contener puntos(.) al principio");
			document.getElementById("zveextension").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("zveextension").style.border = "";
			return true;
		}
	}
}
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (ZONAVERDE_VEGETAL)    +++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
//Validar el formulario
function ValidarFormZonverVegetal()
{	
	var zovdescripci = document.getElementById("zovdescripci");
	if(zovdescripci.value == " ")
	{
		alert("Por favor, Verificar la descripción, no puede contener espacios al principio ¡borre los espacios!");
		document.getElementById("zovdescripci").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("zovdescripci").style.border = "";
		return true;
	}
}
</script>
<!--_________________________________________________________________________________________-->   
<!-- Validacion Red Logica-->
<script type="text/javascript">
		
     	 function ValidaFormRedLogica()
	      {
	      	var constru = document.getElementById("VerCodConstruccion");
	          if(constru.value < 1) 
	            {
	              alert("Por favor, Verificar la Construccion ya se encuentra Registrada");
	              document.getElementById("rloconstrucc").style.border = "2px solid red";
	              return false;
	            }
	          else
	            {
	            	document.getElementById("rloconstrucc").style.border = "";
	            	var pulsado = false;//variable de comprobación
			        var opciones = document.formulario.rlotipconfig; //array de elementos
			        var elegido = -1; //número del elemento elegido en el array
			        for (i=0;i<opciones.length;i++) { //bucle de comprobación
			               if (opciones[i].checked == true) {
			               pulsado = true 
			               elegido = i //número del elemento elegido en el array
			               }
			             }
			        if (pulsado == false) 
			            {
			               alert("PorFavor Seleccione el Tipo de Configuracion ");
			               document.getElementById('verficartc').style.border="1px solid red";
			               return false; //el formulario no se envía.
			            }
			        else
			            {
			              return true;
			            }
	            }
	      }
//+++++++++++++++++++++++++++++++++++++++++++
  $(document).ready(function()
   {  
    $('#rloconstrucc').blur(function()
    {
      var rloconstrucc = $(this).val();  
      var dataString = 'rloconstrucc='+rloconstrucc;
      $.ajax({
              type: "POST",
              url: "consregistros/rloconstrucc.php",
              data: dataString,
              success: function(data) {
          $('#Info').fadeIn(10).html(data);
              }
          });
      });              
  });
//++++++++++++++++++++++++++
	function numepuntorl(N)
          {
              var teclaPulsada=window.event ? window.event.keyCode:N.which;
              var valor=document.getElementById("rlonumcanale").value;
              if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
                  {
                      return true;
                  }
              return /\d/.test(String.fromCharCode(teclaPulsada));
          }
</script>
<!--______________________________________________________________________________________________-->
<!-- ++++++++++++++++++++++++    Validacion Formulario: (USUARIO)    +++++++++++++-->
<!--______________________________________________________________________________________________-->
<script type="text/javascript">
function ValidarFormUsuario() 
{	
	var Nomusuario = document.getElementById("VerNomUsu");
	if(Nomusuario.value < 1) 
	{
		alert("El Nombre del Usuario es Incorrecto");
		document.getElementById("usunombre").style.border = "2px solid red";
		return false;
	}
	else
	{
		document.getElementById("usunombre").style.border = "";
		var Apeusuario = document.getElementById("VerApeUsu");
		if(Apeusuario.value < 1) 
		{
			alert("Los Apellidos del Usuario son Incorrecto");
			document.getElementById("usuapellidos").style.border = "2px solid red";
			return false;
		}
		else
		{
			document.getElementById("usuapellidos").style.border = "";
			var Correo = document.getElementById("Email");
			if(Correo.value < 1) 
			{
				alert("Por Favor, Confirme su Correo Eletronico");
				document.getElementById("usucorreo").style.border = "2px solid red";
				return false;
			}
			else
			{
				document.getElementById("usucorreo").style.border = "";
				var Celular = document.getElementById("VerCelUsu");
				if(Celular.value < 1) 
				{
					alert("Por Favor, Confirme su Numero de Celular");
					document.getElementById("usutelefono").style.border = "2px solid red";
					return false;
				}
				else
				{
					document.getElementById("usutelefono").style.border = "";
					var Usuario = document.getElementById("verusuusuario");
					if(Usuario.value < 1) 
					{
						alert("Por Favor, Confirme el Nombre del Usuario");
						document.getElementById("usuusuario").style.border = "2px solid red";
						return false;
					}
					else
					{
						document.getElementById("usuusuario").style.border = "";
						var usupass = document.getElementById("Verificarpasswor");
						if(usupass.value < 1) 
						{
							alert("Por Favor, Confirme que la Contraseña Cumpla con los Requisitos");
							document.getElementById("usupassword").style.border = "2px solid red";
							return false;
						}
						else
						{
							document.getElementById("usupassword").style.border = "";
							var Confusu = document.getElementById("Verpasswoord");
							if(Confusu.value < 1) 
							{
								alert("Por Favor, Confirme las Contraseñas No son Iguales");
								document.getElementById("usupassword1").style.border = "2px solid red";
								return false;
							}
							else
							{
								document.getElementById("usupassword1").style.border = "";
								return true;
							}
						}
					}
				}
			}
		}
	}
}
//+++++++++++++++++++++++++++++++++++++++++++++++++
$(document).ready(function()
{  
	$('#usunombre').blur(function()
	{
		$('#Info').html('<img src="img/loader.gif"/>').fadeOut(1000);
		var usunombre = $(this).val();  
		var dataString = 'usunombre='+usunombre;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/nomusuario.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info').fadeIn(300).html(data);
			}
		});
	});              
});
//+++++++++++++++++++++++++++++++++++++++++++++++++
$(document).ready(function()
{  
	$('#usuapellidos').blur(function()
	{
		$('#Info1').html('<img src="img/loader.gif"/>').fadeOut(1000);
		var usuapellidos = $(this).val();  
		var dataString = 'usuapellidos='+usuapellidos;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/apeusuario.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info1').fadeIn(300).html(data);
			}
		});
	});              
});
//+++++++++++++++++++++++++++++++++++++++++++++++++
$(document).ready(function()
{  
	$('#usuusuario').blur(function()
	{
		$('#Info2').html('<img src="img/loader.gif"/>').fadeOut(1000);
		var usuusuario = $(this).val();  
		var dataString = 'usuusuario='+usuusuario;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/usuusuario.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info2').fadeIn(300).html(data);
			}
		});
	});              
});
//+++++++++++++++++++++++++++++++++++++++++++++++++
function realizaProceso(usupassword, usupassword1)
{
	var parametros = 
	{
		"usupassword" : usupassword,
		"usupassword1" : usupassword1
	};
	$.ajax(
	{
		data: parametros,
		url: "consregistros/confusuario.php",
		type: 'get',
		success: function (response) 
		{
			$("#Info3").html(response);
//document.getElementById("primer").style.display = "none";
}
});
}
//+++++++++++++++++++++++++++++++++++++++++++++++++
$(document).ready(function()
{  
	$('#usupassword').blur(function()
	{
		$('#Info4').html('<img src="img/loader.gif"/>').fadeOut(1000);
		var usupassword = $(this).val();  
		var dataString = 'usupassword='+usupassword;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/passusuario.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info4').fadeIn(300).html(data);
			}
		});
	});              
});
//+++++++++++++++++++++++++++++++++++++++++++++++++
$(document).ready(function()
{  
	$('#usutelefono').blur(function()
	{
		$('#Info5').html('<img src="img/loader.gif"/>').fadeOut(1000);
		var usutelefono = $(this).val();  
		var dataString = 'usutelefono='+usutelefono;
		$.ajax(
		{
			type: "POST",
			url: "consregistros/celusuario.php",
			data: dataString,
			success: function(data) 
			{
				$('#Info5').fadeIn(300).html(data);
			}
		});
	});              
});
//+++++++++++++++++++++++++++++++++++++++++++++++++
function validarEmail() 
{ 
	var email = document.getElementById("usucorreo").value;
	var expreg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if(expreg.test(email))
	{
		document.getElementById("usucorreo").style.border = "";
		document.getElementById("Email").value="1";
	} 
	else
	{
		document.getElementById("usucorreo").style.border = "2px solid red";
		document.getElementById("Email").value="0";
	}
}
</script>
</head>