<?php

function orderByTitle($aItem1, $aItem2) 
{	
	return strnatcmp(trim($aItem1["title"]), trim($aItem2["title"]));
}

function orderByUser($aItem1, $aItem2) 
{	
	return strnatcmp(trim($aItem1["owner"]["display_name"]), trim($aItem2["owner"]["display_name"]));
}

function orderByLink($aItem1, $aItem2) 
{	
	return strnatcmp(trim($aItem1["link"]), trim($aItem2["link"]));
}

function orderByAnswered($aItem1, $aItem2) 
{	
	return strnatcmp(trim($aItem2["is_answered"]), trim($aItem1["is_answered"]));
}