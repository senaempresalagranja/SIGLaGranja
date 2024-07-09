<!--
    Proyecto: Sistema de Informacion del Centro Agropecuario La Granja.
    Nombre del proyecto:  SIG LA GRANJA.
    Desarrolladores: Tecnologos en Analisis y desarrollo de sistemas de informacion "ADSI".   
    Numero de Ficha: 798585.
    Descripcion del Proyecto: Software que permita la Georeferenciación de Centro agropecuario la granja Sena Espinal - Tolima.
    Año de Desarrollo: 2014-2015. -->

<!-- Descripcion de la pagina en formato de HTML5. -->
<!DOCTYPE html>
<html lang="es">
    <?php
        include 'include/header.php';
    ?>
<!-- Descripcion para el cuerpo de la pagina  -->
    <body>
<!-- Descripcion para el contenedor principal, campo de trabajo-->
    <div id="section">
        <div id="login">
            <?php
                include 'include/ingresar.php';
            ?>
        </div>
<!-- Descripcion para el Banner-->
        <div id="banner">
            <?php
                include 'include/banner.php';
            ?>
        </div>
<!-- Descripcion para el Menu-->
        <div id="nav">
            <?php
                include 'include/menu.php';
            ?>
        </div>
<!-- Descripcion para el cuerpo de la pagina-->
        <div id="pordefinir"><br>
            <center>
             <table border="0" bordercolor="gray" cellspacing="0" style="width: 70%; font-size: 17px; font-family: cambria;" cellspacing="20px">
             <tr>
                 <td><b>Versión.</b></td>                
             </tr>
             <tr>
                 <td>
                     1.01
                 </td>
             </tr>
             <tr>
                 <td><b>Grupo Desarrollador.</b></td>                
             </tr>
             <tr>
                 <td>
                     <p style="text-align: justify;">SIGLaGranja está desarrollado por ADSI 798585, un grupo de aprendices que reciben formacion en Análisis y Desarrollo de Sistemas de Información el el Centro Agropecuario "La Granja", SENA Regional-Tolima</p>
                 </td>
             </tr><br>
             <tr></tr>
             <tr>
                 <td><b>Implementación del Aplicativo.</b></td>                
             </tr>
             <tr>
                 <td>
                     <p>Desarrolladores:</p><br>
                     <li>Jhayron Alexander Carreño Malagón</li>
                     <li>Sena la granja</li>
                 </td>
             </tr>
                </table>
            </center><br>
        </div>
<!-- Descripcion para el pie de pagina-->
        <div id="foot">
            <?php
                include 'include/piepagina.php'
            ?>
        </div>
        <div class="fin">
            Sena la granja
        </div>
    </div>
    </body>
</html>