<?php
function printOrder ($xml){
    echo '<br>';
    foreach ($xml as $value => $key){
        echo '<div style="background: azure; border: 1px solid #e1e1e1; padding: 14px 0 0 10px;">';
        echo '<strong>' . $value . '</strong>' . ':' . $key->__toString() . '<br><br>';
        echo '</div>';
        if (is_object($key)){
            printOrder ($key);
        }
    }
}

function searchRecursive($arr,$flag){
    foreach ($arr as $value => $key ){
        if (is_array($key)){
            rec($key,$flag);
        }
        if ($value === $flag){
            if (!is_array($key)){
                echo $key;
            }
        }
    }
}

function writeAndGetContent($file,$json){
    file_put_contents($file,$json);
    $res = file_get_contents($file);
    return json_decode($res,true);
}