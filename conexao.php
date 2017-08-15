<?php
$nome = $_POST['nomeCliente'];
$sexo = $_POST['sexo'];
$dtanasc = $_POST['dtanasc'];
$pais = $_POST['pais'];
$estadocivil = $_POST['estadoCivil'];



$dtanasc = implode("-",array_reverse(explode("/",$dtanasc)));

$strcon = mysqli_connect('localhost','root','','TI_BD') or die('Erro ao conectar ao banco de dados');
$sql = "INSERT INTO t_cliente(NMCLI, IDSEX_CLI, DTNASC_CLI, CDPAIS_CLI, IDEST_CVL)  VALUES ";
$sql .= "('$nome', '$sexo', '$dtanasc', '$pais', '$estadocivil')"; 
mysqli_query($strcon,$sql) or die("Erro ao tentar cadastrar registro");
mysqli_close($strcon);
echo "Cliente cadastrado com sucesso!";
?>