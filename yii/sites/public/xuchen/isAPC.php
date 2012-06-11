<?php
if (function_exists('apc_fetch')) {
       echo 'it surpport apc model!';
     } else {
       echo "it's not support apc model!";
     }
?>