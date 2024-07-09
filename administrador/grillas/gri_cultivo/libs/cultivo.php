<?php require_once('conexion.php');
$con=pg_connect("host=localhost user=postgres password='(()()())' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");
$listado=  pg_query($con,"SELECT cultivo.culidcodigo, cultivo.culnomcomun, 
  cultivo.culnomcienti, cultivo.culorigen, cultivo.culclimafavo, cultivo.culdistsiemb, 
  unidad_medida.umenombre, cultivo.culvidautil, cultivo.cultiempvida, 
  cultivo.culfecha, cultivo.cullugarorig
                          from cultivo   INNER JOIN unidad_medida  ON unidad_medida.umeid = cultivo.culunimedsie");
?>
 <script type="text/javascript" language="javascript" src="grillas/gri_cultivo/js/jsListadoCultivo.js"></script>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tabla_Listar_Cultivo">
                <thead>
                    <tr>
                       
                          <th>CODIGO</th>
                          <th>NOMBRE COMUN</th>
                          <th>NOMBRE CIENTIFICO</th>
                          <th>ORIGEN</th>
                          <th>LUGAR ORIGEN</th>
                          <th>DISTANCIA SIEMBRA</th>
                          <th>UND-MEDIDA</th> 
                          <th>CLIMA FAVORABLE</th> 
                          <th>VIDA UTIL</th>
                          <th>TIEMPO</th>
                          <th>EXTENSION</th>
                          <th>UND-MEDIDA</th>
                          <th>LATITUD</th>
                          <th>ORIENTACION</th>
                          <th>LONGITUD</th>
                          <th>ORIENTACION</th>

                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                  <tbody>
                    <?php
     $res=pg_query($con, "SELECT * FROM cultivo ORDER BY culidcodigo ASC");
      while($reg=pg_fetch_array($res))
      {
        $umeid= $reg [8];
        $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$umeid' ");
        while($reg1=pg_fetch_array($res1))
        {
          $nomunidad=$reg1[1];
        }

        $umeid1= $reg [12];
        $res2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$umeid1' ");
        while($reg2=pg_fetch_array($res2))
        {
          $nomunidad1=$reg2[1];
        }
                               echo '<tr>';
                               echo '<td>'.$reg[1].'</td>';
                               echo '<td>'.$reg[2].'</td>';
                               echo '<td>'.$reg[3].'</td>';
                               echo '<td>'.$reg[4].'</td>';
                               echo '<td>'.$reg[5].'</td>';
                               echo '<td>'.$reg[7].'</td>';
                               echo '<td>'.$nomunidad.'</td>';
                               echo '<td>'.$reg[6].'</td>';
                               echo '<td>'.$reg[9].'</td>';
                               echo '<td>'.$reg[10].'</td>';
                               echo '<td>'.$reg[11].'</td>';
                               echo '<td>'.$nomunidad1.'</td>';
                               echo '<td>'.$reg[13].'</td>';
                               echo '<td>'.$reg[14].'</td>';
                               echo '<td>'.$reg[15].'</td>';
                               echo '<td>'.$reg[16].'</td>';
                               echo '</tr>';
                        }
                    ?>
                <tbody>
            </table>
