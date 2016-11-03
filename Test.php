<?php
    include_once 'Computer.php';
    $pc = new Computer("4_PC-02" , "Amd fx 8350" , "Nvidia GTX 750 ti", 
     "8 GB Corsair Vengeance","WD blue 1TB" , "Evga 500w", "MSI 970 Gaming" , "4");
    if ($pc->Register())
    {
        echo("Yey :)");
    }else
    {
        echo("Nope");
    }
?>