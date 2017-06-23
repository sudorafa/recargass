<?php

	//form para atualizar as recargas
	//@sudorafa
    
    include('../../global/conecta.php');
	include('../../global/libera.php');
	
	$servidor = `uname -a | awk -F" " '{print $2}'`;
	$filial1  = trim($servidor);
    
    $arqInicial = explode('.',$_FILES['arq_csv']['name']);
    $tipoArquivo = end($arqInicial);
    
    if(isset($_FILES['arq_csv']['name']) and $tipoArquivo == 'csv' )
    {
        // nome temporário para o arquivo
        $tmpName = $_FILES['arq_csv']['tmp_name']; 
        
        //novo nome que o arquivo será salvo
        $newName = 'recargas'.$dt_banco.$_FILES['arq_csv']['new_name'].'.csv';
        
            if(!move_uploaded_file($tmpName, '../arquivos/'. $newName))
            {
               
               // throw new ErrorLog("Erro ao enviar arquivo" {$tmpName});
            }
            else
            {
                //abrindo o arquivo  
                $abreArq = fopen('../arquivos/'.$newName,'r');
                if (!isset($abreArq)){
                 //   throw new ErrorLog("Não foi possível localizar o Arquivo");
                    
                }
         
                while($valores = fgetcsv($abreArq,2048,';'))
                {
					
                    $valorArr = explode(',',$valores[12]);
                    $NovoValor = implode('.',$valorArr);
					$data = explode('/', $valores[1]);
					$data = $data[2].'-'.$data[1].'-'.$data[0];
					$nsuArr = explode(',',$valores[4]);
					$nsu = implode('.',$nsuArr);
					$estadoArr = explode(',',$valores[7]);
					$estado = implode('.',$estadoArr);
					$valor1 = $valores[15];
                    
					$sql = "select * from recargasrec where data = '$data' and nsuTef = '$nsu'";
					$qry = mysql_query($sql);
					$tot_linha = mysql_num_rows($qry);
					
					$hora = date('H:i');
					
                   // echo "$data $valores[14] $NovoValor <br>";
				   
				   
					
					if($tot_linha == 0 && $estado == "Efetuada") { 
						$query = "insert into recargasrec (id, nsuTef, valor, id_operador, data, horaAdd, filial) values (null,'$nsu','$NovoValor','$valor1','$data','$hora','$filial1')";
						if( mysql_query($query)){}
					} else {
					
						if($tot_linha == 0 && $estado == "Efetuada Local") { 
							$query = "insert into recargasrec (id, nsuTef, valor, id_operador, data, horaAdd, filial) values (null,'$nsu','$NovoValor','$valor1','$data','$hora','$filial1')";
							if( mysql_query($query)){}
						}
					}
				
				}
                fclose($abreArq);
				echo 
				"<script>window.alert('Dados Atualzizados com Sucesso !')
					window.location.replace('../view/form_upar.php');
				</script>";	
                
			}
    }
    else
    {
        if(end($arqInicial) != 'csv')
        {
            echo 
				"<script>window.alert('Formato de Arquivo Inválido! Os arquivos devem está no Formato .csv !')
					window.location.replace('../view/form_upar.php');
				</script>";	
		}
    }
    
?>
	