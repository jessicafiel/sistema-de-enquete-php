<?php
session_start();
include_once("conexao.php");
//Verificar se está vindo a variável id pela URL
if(isset($_GET['id'])){
	if(isset($_COOKIE['voto_cont'])){
		$_SESSION['msg'] = "<div class='alert alert-danger'>Você já votou!</div>";
		header("Location: index.php");
	}else{
		setcookie('voto_cont', $_SERVER['REMOTE_ADDR'], time() + 5);
		$result_produto = "UPDATE produtos SET qnt_voto=qnt_voto + 1
		WHERE id ='".$_GET['id']."'"; 
		$resultado_produto = mysqli_query($conn, $result_produto);
		
		if(mysqli_affected_rows($conn)){
			$_SESSION['msg'] = "<div class='alert alert-success'>Voto recebido com sucesso!</div>";
			header("Location: index.php");
		}else{
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao votar!</div>";
			header("Location: index.php");
		}
	}
}