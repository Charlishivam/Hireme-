<?php

#--------------------------------------------------------------------
# ADDITIONAL FILE TO WRITE ALL THE CONSTANTS AND CONFIGURATIONS
#--------------------------------------------------------------------

if (getenv('CI_ENVIRONMENT') == 'production') {
	require('prodconfig.php');
}else{
	require('devconfig.php');
}