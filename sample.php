<?php

$dbconn3 = pg_connect("host=10.8.84.195 port=5433 dbname=CognosVerticaDB user=globe123 password=globe123!");


/* Total data set length */
$sQuery = "SELECT COUNT('TICKETID') AS row_count FROM MAXIMO.TICKET";
    

$rResultTotal = pg_query($dbconn3,$sQuery);
$aResultTotal = pg_fetch_assoc($rResultTotal);
echo $iTotal = $aResultTotal["row_count"];


?> 