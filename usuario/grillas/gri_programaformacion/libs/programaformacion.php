<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='(()()())' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");
$listado=  pg_query($con,"SELECT * from programaformacion");
?>
 <script type="text/javascript" language="javascript" src="grillas/gri_programaformacion/js/jsListadoProgrForma.js"></script>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_ProgrForma">
                <thead>
                    <tr>
                       
                        <th>CODIGO</th>
                        <th>AREA</th>
                        <th>NOMBRE</th>
                        <th>TIPO FORMACION</th>
                        <th>ETAPA LECTIVA</th>
                        <th>TIEMPO</th>
                        <th>ETAPA PRODUCTIVA</th>
                        <th>TIEMPO</th>
                        <!--<th>IMAGEN</th>-->
                        <th>DESCRIPCION</th>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                  <tbody>
                    <?php
     $res=pg_query($con, "SELECT * FROM programaformacion ORDER BY pfoarea ASC");
      while($reg=pg_fetch_array($res))
      {
        $Area= utf8_decode($reg [1]);
          $res1=pg_query($con, "SELECT * FROM area WHERE areid='$Area' ");
          while($reg1=pg_fetch_array($res1))
          {
            $nombre=$reg1[2];
          }
          $UniMed1= utf8_decode($reg [5]);
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UniMed1' ");
          while($reg1=pg_fetch_array($res1))
          {
            $nombre1=$reg1[2];
          }
          $UniMed2= utf8_decode($reg [7]);
          $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UniMed2' ");
          while($reg1=pg_fetch_array($res1))
          {
            $nombre2=$reg1[2];
          }

        $pfoid=$reg[0];
        $pfonombre=$reg[2];
        $pfotipformac=$reg[3];
        $pfotieelecti=$reg[4];
        $pfotieproduc=$reg[6];
        $pfodescripci=$reg[8];
        //$pfoimagen=$reg[9];
                               echo '<tr>';
                               echo '<td>'.mb_convert_encoding($pfoid, "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($nombre, "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($pfonombre, "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($pfotipformac, "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($pfotieelecti, "UTF-8").'</td>';
                               echo '<td>'.$nombre1.'</td>';
                               echo '<td>'.mb_convert_encoding($pfotieproduc, "UTF-8").'</td>';
                               echo '<td>'.$nombre2.'</td>';
                               //echo "<td align='center' width='61px'><img src='imgs/$pfoimagen' width='35px'></td>";
                               echo '<td>'.$pfodescripci.'</td>';
                               echo '</tr>';
                        }
                    ?>
                <tbody>
            </table>
