<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysql_connect("oniddb.cws.oregonstate.edu","leinings-db","Q0u6N9bFIA8s672N");
    $db=mysql_select_db("leinings-db",$con);
    $query=mysql_query("select * from awards where name LIKE '%{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['title'];
    }
    echo json_encode($array);
?>
