<?php
const NODBROOT 	= "data/";
const NODBKEY 	= "noDbIsAwesome!";
const NODBIV	= "1234567890123456";
function nodb_table_create($o){
	if(!isset($o['table'])){
		return false;
	}
	$table	= $o['table'];
	if(file_exists(NODBROOT.$table)){
		return false;
	}
	return mkdir(NODBROOT.$table);
}
function nodb_entry_add($o){
	if(!isset($o['table'])){
		return false;
	}
	if(!isset($o['name'])){
		return false;
	}
	$table	= $o['table'];
	$name	= $o['name'];
	$data 	= "";
	if(isset($o['data'])){
		$data = json_encode($o['data']);
	}	
	if(!file_exists(NODBROOT.$table)){
		return false;
	}
	if(file_exists(NODBROOT.$table.'/'.$name)){
		return false;
	}
	$fp = fopen(NODBROOT.$table.'/'.$name,'wb');
	fwrite($fp,openssl_encrypt($data,'AES-256-CBC',NODBKEY,0,NODBIV));
	fclose($fp);
	return true;
}
function nodb_entry_get($o){
	if(!isset($o['table'])){
		return false;
	}
	if(!isset($o['name'])){
		return false;
	}
	$table 	= $o['table'];
	$name 	= $o['name'];
	if(!file_exists(NODBROOT.$table)){
		return false;
	}
	if(!file_exists(NODBROOT.$table.'/'.$name)){
		return false;
	}
	$data = json_decode(openssl_decrypt(file_get_contents(NODBROOT.$table.'/'.$name),'AES-256-CBC',NODBKEY,0,NODBIV),true);
	return $data;
}
function nodb_entry_remove($o){
	if(!isset($o['table'])){
		return false;
	}
	if(!isset($o['name'])){
		return false;
	}
	$table 	= $o['table'];
	$name 	= $o['name'];
	if(!file_exists(NODBROOT.$table)){
		return false;
	}	
	if(!file_exists(NODBROOT.$table.'/'.$name)){
		return false;
	}
	$rm = NODBROOT.$table.'/'.$name;
	unlink($rm);
	return true;
}
function nodb_entry_get_all($o){	
	if(!isset($o['table'])){
		return false;
	}
	$table 	= $o['table'];
	if(!file_exists(NODBROOT.$table)){
		return false;
	}
	$all = scandir(NODBROOT.$table);
	$all = array_diff($all,['.','..']);
	return $all;
}
