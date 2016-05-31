<?php
    $parm=$_GET['reg'];
    $conn=mysqli_connect('localhost', 'root', 'root','grp_04_db');
    $queryedif="select edificio from posizione";
    $queryplan="select piano from posizione where edificio='".$parm."'";
    $risedif=mysqli_query($conn, $queryedif);
    $risplan=mysqli_query($conn, $queryplan);
    header ('Content-Type: text/xml');
    echo '<?xml version="1.0"?>';
    echo '<oggetto>';
    while ($row=mysqli_fetch_assoc($risedif)) {
        echo '<edificio>'.$row['Prov'].'</edificio>';
    }    
    echo '</oggetto>';
    mysqli_free_result($risedif);
    mysqli_close($conn);

