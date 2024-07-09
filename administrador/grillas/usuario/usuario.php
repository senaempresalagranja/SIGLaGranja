<?php 
require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='(()()())' dbname=siglagranja  port=5432");
$listado=pg_query($con,"SELECT * from usuario");
?>
 <script type="text/javascript" language="javascript" src="grillas/usuario/jslistar.js"></script>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_listar">
                
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>SEXO</th>
                        <th>CORREO</th>
                        <th>TELEFONO</th>
                        <th>ROL</th>
                        <th>USUARIO</th>
                        <th>CONTRASEÑA</th>
                        <th>FECHA REGISTRO</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                       
                     
                    </tr>
                </tfoot>
                  <tbody>
                    <?php

     
                   while($reg=  pg_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td align="left">'.mb_convert_encoding($reg[0], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[1], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[2], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[3], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[4], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[5], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[8], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[6], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[7], "UTF-8").'</td>';
                               echo '<td align="left">'.mb_convert_encoding($reg[9], "UTF-8").'</td>';
                               echo '</tr>';
                        }
                    ?>
                <tbody>
            </table>
