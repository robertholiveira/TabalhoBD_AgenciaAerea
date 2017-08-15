<?php


function get_post_action($name)
{
    $params = func_get_args();

    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}
//todos os formulários de cadastros vão para esse arquivo com o paramêtro 'tipoCadastro', para cada tipo é executado uma tarefa
$tipoCadastro = $_POST['tipoCadastro'];

$strcon = mysqli_connect('localhost','root','','TI_BD') or die('Erro ao conectar ao banco de dados');
mysqli_set_charset($strcon,"utf8");


if($tipoCadastro=="cliente"){
   $nome = $_POST['nomeCliente'];
    $sexo = $_POST['sexo'];
    $dtanasc = $_POST['dtanasc'];
    $pais = $_POST['pais'];
    $estadocivil = $_POST['estadoCivil'];
    $dtanasc = implode("-",array_reverse(explode("/",$dtanasc)));


    $sql = "INSERT INTO t_cliente(NMCLI, IDSEX_CLI, DTNASC_CLI, CDPAIS_CLI, IDEST_CVL)  VALUES ";
    $sql .= "('$nome', '$sexo', '$dtanasc', '$pais', '$estadocivil')";
    mysqli_query($strcon,$sql) or die("<script>location.href='erro_cadastro.html';</script>");
    mysqli_close($strcon);
    echo "<script>location.href='cadastro_efetuado.html';</script>";

}

if($tipoCadastro=="voo"){

switch (get_post_action('rota', 'submit')) {
    case 'rota':

      $nmrota = $_POST['nmrota'];
      $data = $_POST['data'];
      $hora = $_POST['hora'];

      $sql = "SELECT a.NMCID_AEROP as Origem, B.nmcid_aerop as Destino FROM T_ROTA  R, t_AEROPORTO A, T_AEROPORTO B WHERE r.cdaerop_ori = a.cdaerop and R.CDAEROP_DES = B.CDAEROP AND r.nrrota_voo  = $nmrota;";

        // executa a query
        $dados = mysqli_query($strcon,$sql) or die("Erro ao tentar selecionar registro");
        // transforma os dados em um array
        $linha = mysqli_fetch_assoc($dados);
        // calcula quantos dados retornaram
        $total = mysqli_num_rows($dados);

        $origem =  $linha['Origem'];
        $destino =  $linha['Destino'];

        $url = "http://localhost/bd_ti/cadastra_voo.php?origem=$origem&destino=$destino&nmrota=$nmrota&data=$data&hora=$hora";

        echo "<script>location.href='$url';</script>";
        break;

    case 'submit':

       $nmrota = $_POST['nmrota'];
       $data = $_POST['data'];
       $hora = $_POST['hora'];
       $cdaeron =  $_POST['cdaeronave'];


        $sql = "INSERT INTO t_voo(DTSAIDA, HRSAIDA, NRROTA_VOO, CDAERON)  VALUES ";
        $sql .= "('$data', '$hora', $nmrota, '$cdaeron');";
        mysqli_query($strcon,$sql) or die("<script>location.href='erro_cadastro.html';</script>");
        mysqli_close($strcon);
        echo "<script>location.href='cadastro_efetuado.html';</script>";

        break;

    default:
        //no action sent
}


}

if($tipoCadastro=="aeronave"){


    $cdcia = $_POST['companhia'];
    $cdequ = $_POST['equipamento'];

    $sql = "INSERT INTO t_aeronave(CDCIA, CDEQU) VALUES ";
    $sql .= "('$cdcia', '$cdequ');";
    mysqli_query($strcon,$sql) or die("<script>location.href='erro_cadastro.html';</script>");
    mysqli_close($strcon);
    echo "<script>location.href='cadastro_efetuado.html';</script>";

}


if($tipoCadastro=="reserva"){

   switch (get_post_action('voo', 'submit')) {
    case 'voo':

    $nmvoo = $_POST['nmvoo'];


      $sql = "SELECT a.nmcid_aerop as Origem, b.nmcid_aerop as Destino, v.dtsaida as Data, v.hrsaida as Hora FROM t_aeroporto a, t_aeroporto b, t_voo v where a.cdaerop=(select r.cdaerop_ori from t_voo v, t_rota r where v.nrrota_voo = r.nrrota_voo AND nrvoo =$nmvoo) and b.cdaerop =(select r.cdaerop_des from t_voo v, t_rota r where v.nrrota_voo = r.nrrota_voo and nrvoo =$nmvoo) AND nrvoo =$nmvoo;";

        // executa a query
        $dados = mysqli_query($strcon,$sql) or die("Erro ao tentar selecionar registro");
        // transforma os dados em um array
        $linha = mysqli_fetch_assoc($dados);
        // calcula quantos dados retornaram
        $total = mysqli_num_rows($dados);

        $origem =  $linha['Origem'];
        $destino =  $linha['Destino'];
        $dtsaida =  $linha['Data'];
       $hrsaida =  $linha['Hora'];

        $url = "http://localhost/bd_ti/cadastra_reserva.php?origem=$origem&destino=$destino&data=$dtsaida&hora=$hrsaida&nmvoo=$nmvoo";

        echo "<script>location.href='$url';</script>";
        break;



       case 'submit':
            $nmvoo = $_POST['nmvoo'];
            $codcli = $_POST['codcli'];
            $sql = "INSERT INTO T_RESERVA(NRVOO, CODCLI) VALUES ";
            $sql .= "('$nmvoo', '$codcli');";
            mysqli_query($strcon,$sql) or die("<script>location.href='erro_cadastro.html';</script>");
            mysqli_close($strcon);
            echo "<script>location.href='cadastro_efetuado.html';</script>";

           break;
   }

}

?>
