<?php
/**
 * Plugin  : Autocompletar con jQuery
 *   Autor : Lucas Forchino
 * WebSite : http://www.tutorialjquery.com
 * version : 1.0
 * Licencia: Pueden usar libremenete este código siempre y cuando no sea para 
 *           publicarlo como ejemplo de autocompletar en otro sitio.
 */

// limpio la palabra que se busca
$search= trim($_GET['search']);

// la busco 
$result= search($search);

// seteo la cabecera como json
header('Content-type: application/json; charset=utf-8');

//imprimo el resultado como un json
echo json_encode($result);


/**
 *  Funcion que busca en los datos un resultado  que tenga que ver
 *  con la busqueda, si los datos vinieran de base no seria necesario esto
 *  ya que lo podriamos resolver directamente por sql
 */
function search($searchWord)
{
    $tmpArray=array();
    /**
     * Obtengo los datos almacenados en el array
     */
    $data=getData();
    
    /*
     * Recorro el array para ver si hay palabras que empiecen con lo que viene
     * por parametros
     */
    foreach($data as $word)
    {
        // obtengo el tamaño de la palabra que se busca.
        $searchWordSize=strlen($searchWord);
        // corto la palabra que viene del array y la dejo del mismo tamaño que 
        // la que se busca de manera de poder comparar.
        $tmpWord=substr($word, 0,$searchWordSize);
        // si son iguales la guardo para devolverla
        if (strtolower($tmpWord) == strtolower($searchWord))
        {
            // guardo la palabra original sin cortar.
            $tmpArray[]=$word;
        }
    }
    
    return $tmpArray;
}


/**
 * Retorna los datos, podria ser una base de datos
 * para simplificar solo hice esta funcion que devuelve
 * un array ordenado
 */
function getData()
{
   $result=array();
    /*$result[]='jQuery';
    $result[]='Javascript';
    $result[]='Imagenes';
    $result[]='Galerias';
    $result[]='Fotos';
    $result[]='Efectos';
    $result[]='Menus';
    $result[]='Acordeon';
    $result[]='Autocompletar';
    $result[]='Sliders';
    $result[]='PopUps';
    $result[]='Clocks';
    $result[]='Autoload';
    $result[]='HTML5';
    $result[]='CSS3';
    $result[]='LightBox';
    $result[]='Analytics';
    $result[]='Analizador';
    
    asort($result);
    return $result;*/
    $con = mysql_connect("localhost","root")or die("error a tratar de aabrir la base de datos");
	$base = mysql_select_db("multinext1");
	$consulta = "SELECT nombret FROM tipot";
	$peticion = mysql_query($consulta,$con);
    while($rows = mysql_fetch_array($peticion))
    {
        $result[] = "".$rows['nombret'].""; 
    }
    asort($result);
    return $result;
}



 /*$consulta = "SELECT cargo,control,departamento,empleado,ubicacion FROM empleado";
$sql = mysql_query($consulta,conectar::con());
while($row = mysql_fetch_array($sql))
{
    $completo = $row['cargo']." ".$row['control']." ".$row['departamento']." ".$row['empleado']." ".$row['ubicacion'];
$result[]=$completo;
}*/