<?php

//$page = $_GET['page']; // get the requested page
//$limit = $_GET['rows']; // get how many rows we want to have into the grid
//$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
//$sord = $_GET['sord']; // get the direction
$valor = "cliente";
if(isset($_GET['name']))
    $valor = $_GET['name'];
//if (!$sidx)
//    $sidx = 1;
//// connect to the database
//$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error());
//
//mysql_select_db($database) or die("Error conecting to db.");
//$result = mysql_query("SELECT COUNT(*) AS count FROM invheader a, clients b WHERE a.client_id=b.client_id");
//$row = mysql_fetch_array($result, MYSQL_ASSOC);
//$count = $row['count'];
//
//if ($count > 0) {
//    $total_pages = ceil($count / $limit);
//} else {
//    $total_pages = 0;
//}
//if ($page > $total_pages)
//    $page = $total_pages;
//$start = $limit * $page - $limit; // do not put $limit*($page - 1)
//$SQL = "SELECT a.id, a.invdate, b.name, a.amount,a.tax,a.total,a.note FROM invheader a, clients b WHERE a.client_id=b.client_id ORDER BY $sidx $sord LIMIT $start , $limit";
//$result = mysql_query($SQL) or die("Couldn t execute query." . mysql_error());

@$responce->page = 1;
$responce->total = 1;
$responce->records = 1;
$i = 0;
//while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
//    $responce->rows[$i]['id'] = $row[id];
//    $responce->rows[$i]['cell'] = array($row[id], $row[invdate], $row[name], $row[amount], $row[tax], $row[total], $row[note]);
//    $i++;
//}
$responce->rows[0]['id'] = array("1");
$responce->rows[0]['cell'] = array("1", "2fecha", $valor, "amount", "tax", "total", "notes");
$responce->rows[1]['id'] = array("2");
$responce->rows[1]['cell'] = array("2", "1fecha", "cliente", "amount", "tax", "total", "notes");

echo json_encode($responce);
?>
