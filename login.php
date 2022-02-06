<?php
session_start();

require_once 'config.php';

$web_host='http://localhost/IT_BSC/template.php';

if(isset($_POST['login'])){
	if(empty($_POST['username']) || empty($_POST['password']))	{
		exit("<script>window.alert('Masukkan username dan password anda');window.history.back();</script>");
	}
	$username=$_POST['username'];
	$password=($_POST['password']);
	// $q=mysql_query("SELECT * FROM tbpengguna WHERE username='".$username."' AND password='".$password."'");
	// if(mysql_num_rows($q)==0){
	$q = mysqli_query($koneksi, "SELECT * FROM tbpengguna WHERE username = '".$_POST['username']."' and password='".($_POST['password'])."'");
 if(mysqli_num_rows($q)==0){
		exit("<script>window.alert('Username dan password yang anda masukkan salah');window.history.back();</script>");
		/*simpan data login ke dalam session*/
	//$_SESSION['LOGIN_username']=$username;
//	exit("<script>window.location='".$wwwroot."';</script>");
	}
	/*simpan data login ke dalam session*/
	$_SESSION['LOGIN_username']=$username;
	exit("<script>window.location='".$web_host."';</script>");
	
}

?>