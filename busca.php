<?php
$strcon = mysqli_connect('localhost','root','','TI_BD') or die('Erro ao conectar ao banco de dados');


$valor = $_GET['valor'];
 
// Procura titulos no banco relacionados ao valor
$sql = mysqli_query("SELECT a.NMCID_AEROP as Origem, B.nmcid_aerop as destino FROM T_ROTA  R, t_AEROPORTO A, T_AEROPORTO B WHERE r.cdaerop_ori = a.cdaerop and R.CDAEROP_DES = B.CDAEROP AND r.nrrota_voo  = $valor;");
 
// executa a query
$dados = mysqli_query($strcon,$sql) or die("Erro ao tentar selecionar registro");
// transforma os dados em um array
$linha = mysqli_fetch_assoc($dados);
// calcula quantos dados retornaram
$total = mysqli_num_rows($dados);

echo $linha['A.NMCIDAD_AEROP']; 
// Acentuação
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>