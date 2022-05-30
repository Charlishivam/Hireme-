<?php
$token_val 	= csrf_hash();
$token_name = csrf_token();
echo '<script>token_val = "'.$token_val.'";$("input[name='.$token_name.']").val("'.$token_val.'");</script>';
?>