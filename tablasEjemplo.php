<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
        </tr>
        <tr>
          <td>Paco</td>
          <td>Perez</td>
        </tr>
        <tr>
          <td>Juan</td>
          <td>Molina</td>
        </tr>
      </table>

      <!-- --------------------------------------------------------------------------------- -->

        $nombre1   = "Adriana";
        $apellido1 = "Ortiz";
        $arr = array("Pedro", "Duarte");

        echo "<table>";
        echo "<tr>";
        echo "  <th> Nombre  </th>";
        echo "  <th> Apellido </th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> " . $nombre1 . "</td>";
        echo "<td> " . $apellido1 . "</td>";
        echo "</tr>";
        echo "<tr>  <td>" . $arr[0] . "</td> <td>" . $arr[1] ."</td>  </tr>" ;
        echo "</table>";


                <?php
        /************simulador de tabla de mysql***********************************/
            $arrPedido2 = array(
                                array("noOdc" => "noOdc uno", "pedido" => "pedido uno", "modelo" => "modelo uno", "idPedido" => "1"),
                                array("noOdc"=>"noOdc dos", "pedido"=>"pedido dos", "modelo"=>"modelo dos", "idPedido"=>"2"),
                                array("noOdc"=>"noOdc dos", "pedido"=>"pedido dos", "modelo"=>"modelo dos", "idPedido"=>"3")
                                );

        ?>
        <html>
        <body>
        <table class="table table-striped" border=1>
        <thead>                                                     
        
            <tr>
                <th class="text-center">ODC</th>
                <th class="text-center">Pedido</th>
                <th class="text-center">Modelo</th>
                <th class="text-center">Select</th>
            </tr>
        </thead>
        <form action='tabla2.php' method='POST'>
        <tbody>
            <?php foreach ($arrPedido2 as $rowPedido2) { ?>
            <tr class="gradeX">
                <td class="text-center"><?php echo utf8_encode($rowPedido2['noOdc']);?></td>
                <td class="text-center"><?php echo utf8_encode($rowPedido2['pedido']);?> </td>          
                <td class="text-center"><?php echo utf8_encode($rowPedido2['modelo']);?></td>
                <td class="text-center"><input type="checkbox" name="txtIdPedido[]" value="<?php echo utf8_encode($rowPedido2['idPedido']);?>"></td>
            </tr>
            <?php }; ?>
            <tr>
                <th class="text-center" colspan="24"><input type="submit" name="txtEnviar" value="Enviar" class="form-control"></th>
            </tr>
        </tbody>
        </form>
        </body>
        </html>

       <!-- ------------------------ tabla 2 con las consultas ------------------- -->
       <?php

       $array_post = array();
       
       foreach($_POST as $valor){
          array_push($array_post, $valor);
       } 
       
       echo 'Asi quedaria el arreglo de las filas seleccionadas: <br>';
       print_r($array_post);
       echo '<hr>';
       
       /*Crear el IN para el sql */
       $ids_Pedidos = '';
       
       foreach ($array_post[0] as $rowPedido2){
           
           $ids_Pedidos = $ids_Pedidos."'".$rowPedido2."'," ;
       }
        
        $ids_Pedidos = substr($ids_Pedidos, 0, -1); //uitar ultima coma
       
       echo 'Debo hacer la consulta a la base de datos para sacar las ID que se seleccionaron anteriormente <br>';
       echo  ' la consulta seria: <br><br>';
       
       $CONSULTA = 'SELECT * FROM pedidos WHERE idPedido IN ('.$ids_Pedidos.');';
       
       echo $CONSULTA;
           
       /* LLENAR LA TABLA NORMAL CON EL RESULTADO DE LA CONSULTA ANTERIOR*/
       
       ?>

</body>
</html>