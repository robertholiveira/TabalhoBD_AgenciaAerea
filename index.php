<?php
   // definições de host, database, usuário e senha
   $strcon = mysqli_connect('localhost','root','','TI_BD') or die('Erro ao conectar ao banco de dados');
   mysqli_set_charset($strcon,"utf8");
   
   // cria a instrução SQL que vai selecionar os dados
   $query = "SELECT count(codcli) as num, nmpais, (select  count(codcli) from t_cliente) as total from t_cliente, t_pais p where cdpais_cli = p.cdpais group by(cdpais_cli);";
   // executa a query
   $dados = mysqli_query($strcon,$query) or die("Erro ao tentar selecionar registro");
   // transforma os dados em um array
   $linha = mysqli_fetch_assoc($dados);
   // calcula quantos dados retornaram
   $total = mysqli_num_rows($dados);




   // cria a instrução SQL que vai selecionar os dados
   $querysex = "SELECT count(codcli) as num, idsex_cli,  (select  count(codcli) from t_cliente) as total from t_cliente group by(idsex_cli);";
   // executa a query
   $dadossex = mysqli_query($strcon,$querysex) or die("Erro ao tentar selecionar registro");
   // transforma os dados em um array
   $linhasex = mysqli_fetch_assoc($dadossex);
   // calcula quantos dados retornaram
   $totalsex = mysqli_num_rows($dadossex);


   
?>
<!DOCTYPE html>
<html>
   <!-- Mirrored from light.pinsupreme.com/charts.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 May 2017 01:22:05 GMT -->
   <head>
      <title>Página inicial </title>
      <meta charset="utf-8">
      <meta content="ie=edge" http-equiv="x-ua-compatible">
      <meta content="template language" name="keywords">
      <meta content="Tamerlan Soziev" name="author">
      <meta content="Admin dashboard html template" name="description">
      <meta content="width=device-width, initial-scale=1" name="viewport">
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
             
                        <div class="col-md-4">
                           <div class="element-wrapper">
                              <h6 class="element-header">Informações de clientes</h6>
                                 <div class="element-box el-tablo">
                                <?php
                                          if($total > 0) {
                                              // inicia o loop que vai mostrar todos os dados
                                              do {
                                          ?>
                               
                               
                                  
                                 <div style="margin-top:10px;" class="label">CLientes do <?=$linha['nmpais']?></div>
                                  
                                 <div class="value"><?=$linha['num']?></div>
                                   <?php
                                     $porc = round(($linha['num']/$linha['total'])*100);
                                                  if($porc>30){
                                                      $cor = "#4ecc48;";
                                                    
                                                  }
                                              
                                                  else if($porc>20){
                                                        $cor = '#ffcc29;';
                                                  }
                                                else if($porc<20){
                                                     $cor = '#f37070;';
                                                }
                                                
                                   ?>
                                     
                                 <div  style="background-color:<?=$cor?>" class="trending trending-up"><span><?=$porc?>%</span><i class="os-icon os-icon-arrow-up2"></i></div>
                            
                               
                                     
                                       <?php
                                          // finaliza o loop que vai mostrar os dados
                                          }while($linha = mysqli_fetch_assoc($dados));
                                          // fim do if 
                                          }
                                          ?> 
                               
                              </div>
                               
                               
                                <div class="element-box el-tablo">
                                <?php
                                          if($totalsex > 0) {
                                              // inicia o loop que vai mostrar todos os dados
                                              do {
                                                       if($linhasex['idsex_cli']=='F'){
                                                       $sexo = 'Feminino';
                                                           $cor = '#f37070;';
                                                   }
                                                  else{
                                                      $sexo = 'Masculino';
                                                      $cor = '#5797fc;';
                                                  }
                                          ?>
                               
                               
                                  
                                 <div style="margin-top:10px;" class="label">CLientes do sexo <?=$sexo?></div>
                                  
                                 <div class="value"><?=$linhasex['num']?></div>
                                   <?php
                                     $porc = round(($linhasex['num']/$linhasex['total'])*100);
                                                  
                                   ?>
                                     
                                 <div style="background-color:<?=$cor?>" class="trending trending-down"><span><?=$porc?>%</span><i class="os-icon os-icon-arrow-up2"></i></div>
                            
                               
                                     
                                       <?php
                                          // finaliza o loop que vai mostrar os dados
                                          }while($linhasex = mysqli_fetch_assoc($dadossex));
                                          // fim do if 
                                          }
                                          ?> 
                               
                              </div>
                      
                           </div>
                        </div>
                         <div class="col-md-4">
                         
                         <div class="element-wrapper">
                        <h6 class="element-header">Informações sobre companhias</h6>
                        <div class="element-box">
                          
                           <div class="form-desc">Veja abaixo informações sobre as companhias aereas</div>
                           <div class="el-chart-w">
                              <canvas height="160" id="donutChart" width="160"></canvas>
                              <div class="inside-donut-chart-label"><strong>28</strong><span>companhias</span></div>
                           </div>
                           <div class="el-legend">
                              <div class="legend-value-w">
                                 <div class="legend-pin" style="background-color: #6896f9;"></div>
                                 <div class="legend-value">Azerbaijão</div>
                              </div>
                              <div class="legend-value-w">
                                 <div class="legend-pin" style="background-color: #85c751;"></div>
                                 <div class="legend-value">Brasil</div>
                              </div>
                              <div class="legend-value-w">
                                 <div class="legend-pin" style="background-color: #d97b70;"></div>
                                 <div class="legend-value">Inglaterra</div>
                              </div>
                                 <div class="legend-value-w">
                                 <div class="legend-pin" style="background-color:yellow;"></div>
                                 <div class="legend-value">Japão</div>
                              </div>
                           </div>
                        </div>
                     </div>
                         
                         </div>
                   
                         <div class="col-md-4">
                         
                             
                              <div class="element-wrapper">
                                    <h6 class="element-header">Informações sobre aeroportos</h6>
                        <div class="element-box">
                        
                           <div class="form-desc">Veja abaixo mais informações sobre os aeroportos da DataBase Airlines </div>
                           <div class="el-chart-w">
                              <canvas height="150px" id="pieChart1" width="150px"></canvas>
                           </div>
                        </div>
                     </div>
                             
                         </div>
                      
                      
                      
                      
                      
                      </div>
              
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
      <script src="bower_components/jquery/dist/jquery.min.js"></script><script src="bower_components/moment/moment.js"></script><script src="bower_components/chart.js/dist/Chart.min.js"></script><script src="bower_components/select2/dist/js/select2.full.min.js"></script><script src="bower_components/ckeditor/ckeditor.js"></script><script src="bower_components/bootstrap-validator/dist/validator.min.js"></script><script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script><script src="bower_components/dropzone/dist/dropzone.js"></script><script src="bower_components/editable-table/mindmup-editabletable.js"></script><script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script><script src="bower_components/datatables/media/js/dataTables.bootstrap4.min.js"></script><script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script><script src="js/main.js"></script>
       
       
   </body>
   <!-- Mirrored from light.pinsupreme.com/charts.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 May 2017 01:22:05 GMT -->
</html>