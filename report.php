<?php  
  require_once __DIR__ . '/vendor/autoload.php';

  class reportCliente {  

    // Atributos da classe  
    private $pdo  = null;  
    private $pdf  = null;
    private $css  = null;  
    private $titulo = null; 
 
    /*  
    * Construtor da classe  
    * @param $css  - Arquivo CSS  
    * @param $titulo - Título do relatório   
    */  
    public function __construct($css, $titulo) {  
      $this->titulo = $titulo;  
      $this->setarCSS($css);  
    }
  
    /*  
    * Método para setar o conteúdo do arquivo CSS para o atributo css  
    * @param $file - Caminho para arquivo CSS  
    */  
    public function setarCSS($file){  
     if (file_exists($file)):  
       $this->css = file_get_contents($file);  
     else:  
       echo 'Arquivo inexistente!';  
     endif;  
    }  

    /*  
    * Método para montar o Cabeçalho do relatório em PDF  
    */  
    protected function getHeader(){  
       $data = date('j/m/Y');  
       $retorno = "<table class=\"tbl_header\" width=\"1000\">  
               <tr>  
                 <td align=\"left\">Biblioteca mPDF</td>  
                 <td align=\"right\">Gerado em: $data</td>  
               </tr>  
             </table>";  
       return $retorno;  
     }  

     /*  
     * Método para montar o Rodapé do relatório em PDF  
     */  
     protected function getFooter(){  
       $retorno = "<table class=\"tbl_footer\" width=\"1000\">  
               <tr>  
                 <td align=\"left\"><a href=''>devwilliam.blogspot.com</a></td>  
                 <td align=\"right\">Página: {PAGENO}</td>  
               </tr>  
             </table>";  
       return $retorno;  
     }  

    /*   
    * Método para construir a tabela em HTML com todos os dados  
    * Esse método também gera o conteúdo para o arquivo PDF  
    */  
    private function getTabela(){  
      $color  = false;  
      $retorno = "";  

      $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";  
      $retorno .= "<table border='1' width='1000' align='center'>  
           <tr class='header'>  
             <th>Data - Hora</td>  
             <th>Operação</td>  
             <th>Entidade</td>  
             <th>Referência</td>  
             <th>Montante</td>  
             <th>Transacção</td>  
             <th>Descrição</td>  
           </tr>";  
$conn=mysqli_connect("localhost","root","","fpdf");
$result=mysqli_query($conn,"SELECT * FROM transacao");

      foreach ($result as $reg):  
       
         $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";  
         $retorno .= "<td class='destaque'>{$reg['Data']}</td>";  
         $retorno .= "<td>".utf8_decode($reg["Operacao"])."</td>";  
         $retorno .= "<td>".utf8_decode($reg['Entidade'])."</td>";  
         $retorno .= "<td>".utf8_decode($reg['Referencia'])."</td>";  
         $retorno .= "<td>".utf8_decode($reg['Motante'])."</td>";  
         $retorno .= "<td>".utf8_decode($reg['Descricao'])."</td>";  
         $retorno .= "<td>".utf8_decode($reg['Transacao'])."</td>";  
        
       $retorno .= "<tr>";  
       $color = !$color;  
      endforeach;  

      $retorno .= "</table>";  
      return $retorno;  
    } 

    /*   
    * Método para construir o arquivo PDF  
    */  
    public function BuildPDF(){  
     $this->pdf = new \Mpdf\Mpdf();  
     $this->pdf->WriteHTML($this->css, 1);  
     $this->pdf->SetHTMLHeader($this->getHeader());  
     $this->pdf->SetHTMLFooter($this->getFooter());  
     $this->pdf->WriteHTML($this->getTabela());   
    }   

    /*   
    * Método para exibir o arquivo PDF  
    * @param $name - Nome do arquivo se necessário grava-lo  
    */  
    public function Exibir($name = null) {  
     $this->pdf->Output($name, 'I');  
    }  
  }   