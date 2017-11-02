<?php
const NODBROOT 	= "data/";
const NODBKEY 	= "noDbIsAwesome!";
const NODBIV	= "1234567890123456";
function nodb_table_create($o){
	if(!isset($o['table'])){
		return "Table not set";
	}
	$table	= $o['table'];
	if(file_exists(NODBROOT.$table)){
		return "Table exists";
	}
	return mkdir(NODBROOT.$table);
}
function nodb_entry_add($o){
	if(!isset($o['table'])){
		return "No Table";
	}
	if(!isset($o['name'])){
		return "No Name";
	}
	$table	= $o['table'];
	$name	= $o['name'];
	$data 	= "";
	if(isset($o['data'])){
		$data = json_encode($o['data']);
	}	
	if(!file_exists(NODBROOT.$table)){
		return "Table does not exist";
	}
	if(file_exists(NODBROOT.$table.'/'.$name)){
		return "This name is taken";
	}
	$fp = fopen(NODBROOT.$table.'/'.$name,'wb');
	fwrite($fp,openssl_encrypt($data,'AES-256-CBC',NODBKEY,0,NODBIV));
	fclose($fp);
	return true;
}
function nodb_entry_get($o){
	if(!isset($o['table'])){
		return "No Table";
	}
	if(!isset($o['name'])){
		return "No Name";
	}
	$table 	= $o['table'];
	$name 	= $o['name'];
	if(!file_exists(NODBROOT.$table)){
		return "Table does not exist";
	}
	if(!file_exists(NODBROOT.$table.'/'.$name)){
		return "The name does not exist";
	}
	$data = json_decode(openssl_decrypt(file_get_contents(NODBROOT.$table.'/'.$name),'AES-256-CBC',NODBKEY,0,NODBIV),true);
	return $data;
}
function nodb_entry_remove($o){
	if(!isset($o['table'])){
		return "No Table";
	}
	if(!isset($o['name'])){
		return "No Name";
	}
	$table 	= $o['table'];
	$name 	= $o['name'];
	if(!file_exists(NODBROOT.$table)){
		return "Table does not exist";
	}	
	if(!file_exists(NODBROOT.$table.'/'.$name)){
		return "The name does not exist";
	}
	$rm = NODBROOT.$table.'/'.$name;
	unlink($rm);
	return true;
}
function nodb_entry_get_all($o){	
	if(!isset($o['table'])){
		return "No Table";
	}
	$table 	= $o['table'];
	if(!file_exists(NODBROOT.$table)){
		return "Table does not exist";
	}
	$all = scandir(NODBROOT.$table);
	$all = array_diff($all,['.','..']);
	return $all;
}
