<?php

    if(count($_GET) > 0){
    $origem = $_GET["origem"];
    $destino = $_GET["destino"];
    $nmrota = $_GET["nmrota"];
    $data = $_GET["data"];
    $hora = $_GET["hora"];

    }
    else{
        $origem = ".";
        $destino = ".";
        $nmrota = "";
        $hora = "";
        $data = "";
    }

    if($origem ==""){
         $nmrota = $_GET["nmrota"];
         echo '<script type="text/javascript">alert("Rota nao existe")</script>';

}


   // definições de host, database, usuário e senha
   $strcon = mysqli_connect('localhost','root','','TI_BD') or die('Erro ao conectar ao banco de dados');

   // cria a instrução SQL que vai selecionar os dados
   $query = "SELECT CDAERON FROM t_aeronave;";
   // executa a query
   $dados = mysqli_query($strcon,$query) or die("Erro ao tentar selecionar registro");
   // transforma os dados em um array
   $linha = mysqli_fetch_assoc($dados);
   // calcula quantos dados retornaram
   $total = mysqli_num_rows($dados);
   ?>

<!DOCTYPE html>
<html>
   <!-- Mirrored from light.pinsupreme.com/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 May 2017 01:22:04 GMT -->
   <head>
      <title>Cadastrar Voos - Data Base Airlines</title>
      <meta charset="utf-8">
  
      <link href="favicon.png" rel="shortcut icon">
      <link href="apple-touch-icon.png" rel="apple-touch-icon">
      <link href="bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
      <link href="../fast.fonts.net/cssapi/175a63a1-3f26-476a-ab32-4e21cbdb8be2.css" rel="stylesheet">
      <link href="bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <link href="bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
      <link href="bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="bower_components/datatables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link href="bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
      <link href="css/main.css" rel="stylesheet">
      <link href="css/novo.css" rel="stylesheet">
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="funcs.js"></script>
      <script>
         jQuery(function($){
         $("#date").mask("99/99/9999",{});
         $("#phone").mask("(999) 999-9999");
         $("#tin").mask("99-9999999");
         $("#ssn").mask("999-99-9999");
         $("#hour").mask("99:99:99");
         });
      </script>
   </head>
   <body>
      <div class="all-wrapper">
      <div class="layout-w">
      <div class="menu-w menu-activated-on-click">
         <div class="logo-w">
            <a class="logo" href="index.php"><img src="img/logo.png"  width="300px"></a>
            <div class="mobile-menu-trigger">
               <div class="os-icon os-icon-hamburger-menu-1"></div>
            </div>
         </div>
              <div class="menu-and-user">
                  <ul class="main-menu">
                     <li>
                        <a href="index.php">
                           <div class="icon-w">
                              <div class="os-icon os-icon-window-content"></div>
                           </div>
                           <span>Inicio</span>
                        </a>
                     </li>

                     <li class="has-sub-menu">
                        <a href="#">
                           <div class="icon-w">
                              <div class="os-icon os-icon-donut-chart-2"></div>
                           </div>
                           <span>Cadastros</span>
                        </a>
                        <ul class="sub-menu">
                           <li><a href="cadastra_cliente.php">Cadastrar clientes</a></li>
                           <li><a href="cadastra_voo.php">Cadstrar voos</a></li>
                           <li><a href="cadastra_aeronave.php">Cadastrar aeronaves</a></li>
                           <li><a href="cadastra_reserva.php">Cadastrar reserva</a></li>

                        </ul>
                     </li>
                     <li class="has-sub-menu">
                        <a href="#">
                           <div class="icon-w">
                              <div class="os-icon os-icon-wallet-loaded"></div>
                           </div>
                           <span>Visualizar</span>
                        </a>
                        <ul class="sub-menu">
                           <li><a href="visualizar_clientes.php">Visualizar clientes</a></li>
                           <li><a href="visualizar_voos.php">Visualizar voos</a></li>

                             <li><a href="visualizar_reserva.php">Visualizar reserva</a></li>
                        </ul>
                      </li>


                  </ul>
               </div>
      </div>

      <div class="content-w">
         <div class="content-i">
            <div class="content-box">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="element-wrapper">
                        <div class="element-box">
                           <h6 class="element-header">Cadastro de Voo</h6>

                           <div class="form-desc">Preencha os dados de voo:</div>

                           <form name="Cadastro" action="Cadastros.php" method="POST">

                                <input hidden="hidden" name="tipoCadastro" value="voo" />

                              <div class="row" style="margin-bottom:20px !important;">

                                  <div class="col-md-4">
                                    <p>Data de Saída:</p>
                                    <input name="data" id="date" type='text'  value="<?=$data?>" class="form-control date" />
                                 </div>
                                 <div class="col-md-4">
                                    <p>Hora de saída:</p>
                                    <input name="hora" id="hour" type='text'  value="<?=$hora?>" class="form-control date" />

                                            </div>
                                 <div class="col-md-4">

                                 </div>
                              </div>
                              <div class="row" style="margin-bottom:20px !important;">


                                 <div class="col-md-4">
                                     <div class="row">
                                     <div class="col-md-6">
                                    <p>Número da rota: </p>
                                          <input name="nmrota" type='text' value="<?=$nmrota?>" class="form-control date" />
                                  </div>
                                     <div class="col-md-6">

                                     <button style="margin-top:25%;" class="btn btn-primary" name="rota" type="submit"> Verificar</button>
                                     </div>
                                     </div>
                                 </div>

                                <div class="col-md-4">
                                    <p>Cidade origem:</p>
                                    <input name="dtanasc" id="rotaOrigem"  value="<?=$origem?>" type='text' class="visual form-control date" />
                                 </div>
                                   <div class="col-md-4">
                                    <p>Cidade destino:</p>
                                    <input name="dtanasc" id="rotaDestino" value="<?=$destino?>" type='text' class="visual form-control date" />
                                 </div>

                              </div>

                               <div class="row" STYLE="margin-bottom:20px !important;">
                                   <div class="col-md-4">
                                    <p>Cod aeronave: </p>
                                    <select name="cdaeronave" class="form-control mb-2 mr-sm-2 mb-sm-0">
                                       <?php
                                          if($total > 0) {
                                              // inicia o loop que vai mostrar todos os dados
                                              do {
                                          ?>
                                       <option value="<?=$linha['CDAERON']?>"><?=$linha['CDAERON']?></option>
                                       <?php
                                          // finaliza o loop que vai mostrar os dados
                                          }while($linha = mysqli_fetch_assoc($dados));
                                          // fim do if
                                          }
                                          ?>
                                    </select>

                                   </div>



                               </div>







                              <button class="btn btn-primary" name="submit" type="submit"> ENVIAR</button>
                             </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="jquery.js" type="text/javascript"></script>
      <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/moment/moment.js"></script>
      <script src="bower_components/chart.js/dist/Chart.min.js"></script><script src="bower_components/select2/dist/js/select2.full.min.js"></script>
      <script src="bower_components/ckeditor/ckeditor.js"></script>
      <script src="bower_components/bootstrap-validator/dist/validator.min.js"></script>
      <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
      <script src="bower_components/dropzone/dist/dropzone.js"></script>
      <script src="bower_components/editable-table/mindmup-editabletable.js"></script>
      <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
      <script src="bower_components/datatables/media/js/dataTables.bootstrap4.min.js"></script>
      <script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>
