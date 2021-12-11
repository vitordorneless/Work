<?php
function alerta($msg, $ir)
{    
    echo"<script type='text/javascript'>";
        echo "alert('$msg');";
        echo "window.location.href='$ir';";
    echo "</script>";
}

function repasse($ir)
{    
    echo "<script type='text/javascript'>";
        echo "window.location.href='$ir';";
    echo "</script>";    
}

function alerta_2($msg)
{    
    echo"<script type='text/javascript'>";
        echo "alert('$msg');";        
    echo "</script>";
}
?>