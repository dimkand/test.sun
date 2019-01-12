<?php

function displayHelper($key, $alt = false)
{
	if($key%2 == 1)
		return $alt ? "style = 'display: none'" : "style = 'display: block'";
	else
		return $alt ? "style = 'display: block'" : "style = 'display: none'";
}