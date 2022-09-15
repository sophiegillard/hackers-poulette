<?php
function hideError($error, $errorName){
    if($error == null){
        ?> <style>.<?php echo $errorName ?>{display: none;}</style> <?php
    }
}

function showMessage($message, $class){
    if($message != null){
        ?> <style>.<?php echo $class ?>{display: block;}</style> <?php
    }
}