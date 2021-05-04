<?php  
 require_once "report.php"; 
 if(isset($_GET['submit'])):  
   $report = new reportCliente("css/estilo.css", "Comprovativo  Digital");  
   $report->BuildPDF();  
   $report->Exibir("Comprovativo  Digital");  
 endif;  
 ?>  
 
 <!DOCTYPE html>  
 <html>  
   <head>  
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
     <title>Testando relatório com mPDF</title>  
   </head>  
   <body>  
     <form action="" method="GET" target="_blank">  
       <input type="submit" value="Gerar relatório" name="submit"/>  
     </form>  
   </body>  
 </html>  