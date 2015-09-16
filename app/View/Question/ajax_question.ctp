<?php

$sHTML  = "<table style='width:100%;' cellspacing='0' cellpadding='0' id='tb_grid_results'>";
$sHTML .= "   <tr>";
$sHTML .= "      <td style='width:100%;' colspan='2'>";
$sHTML .= "         <table style='width:100%;' cellspacing='0' cellpadding='0'>";
$sHTML .= "             <tr class='class_cabecalho_datagrid'>";
$sHTML .= "         	   <td style='width:7%;' class='td_title_grid'>";
$sHTML .= "         	      ID";
$sHTML .= "         	   </td>";
$sHTML .= "         	   <td style='width:25%;' class='td_title_grid'>";
$sHTML .= "         	      Título";
$sHTML .= "         	   </td>";
$sHTML .= "         	   <td style='width:15%;' class='td_title_grid'>";
$sHTML .= "         	      Usuário";
$sHTML .= "         	   </td>";
$sHTML .= "         	   <td style='width:7%;' class='td_title_grid'>";
$sHTML .= "         	      Pontos";
$sHTML .= "         	   </td>";
$sHTML .= "         	   <td style='width:7%;' class='td_title_grid'>";
$sHTML .= "         	      Data";
$sHTML .= "         	   </td>";
$sHTML .= "         	   <td style='width:9%;' class='td_title_grid'>";
$sHTML .= "         	      Respondida";
$sHTML .= "         	   </td>";
$sHTML .= "         	   <td style='width:30%;' class='td_title_grid'>";
$sHTML .= "         	      Link";
$sHTML .= "         	   </td>";
$sHTML .= "            </tr>";

if(!isset($oResult["error_id"]))
{
    if(count($oResult["items"]) > 0)
    {
		$oResult = $oResult["items"];
        $sClasse = "class_tr_grid_dado_2";
	
        for($i = 0; count($oResult) > $i; $i++)
        {
            if ($sClasse == "class_tr_grid_dado_2")
            {
                $sClasse = "class_tr_grid_dado_1";
            }
            else
            {
                $sClasse = "class_tr_grid_dado_2";
            }
						
            $sID         = $oResult[$i]["question_id"];
            $sTitulo     = $oResult[$i]["title"];
            $sUsuario    = $oResult[$i]["owner"]["display_name"];
            $iPontos     = $oResult[$i]["score"];
            $sData       = date("d/m/Y", $oResult[$i]["creation_date"]);
			$sRespondida = $oResult[$i]["is_answered"];
			
			if($oResult[$i]["is_answered"])
			{
				$sRespondida  = "Sim";
			}
			else
			{
				$sRespondida  = "Não";
			}
            
			$sLink       = $oResult[$i]["link"];
            
            $sHTML .="<tr class='{$sClasse}'>";
            $sHTML .="   <td class='td_result_grid' style='text-align:right;'>";
            $sHTML .=       $sID;
            $sHTML .="   </td>";
            $sHTML .="   <td class='td_result_grid' style='text-align:left;'>";
            $sHTML .=       $sTitulo;
            $sHTML .="   </td>";
            $sHTML .="   <td class='td_result_grid' style='text-align:left;'>";
            $sHTML .=       $sUsuario;
            $sHTML .="   </td>";
            $sHTML .="   <td class='td_result_grid' style='text-align:right;'>";
            $sHTML .=       $iPontos;
            $sHTML .="   </td>";
            $sHTML .="   <td class='td_result_grid' style='text-align:center;'>";
            $sHTML .=       $sData;
            $sHTML .="   </td>";            
			$sHTML .="   <td class='td_result_grid' style='text-align:center;'>";
            $sHTML .=       $sRespondida;
            $sHTML .="   </td>";
            $sHTML .="   <td class='td_result_grid' style='text-align:left;'>";
            $sHTML .=       "<a onclick='linkOpen(\"{$sLink}\")'>{$sLink}</a>";
            $sHTML .="   </td>";
            $sHTML .="</tr>";
        }
    }
    else
    {
        $sHTML .= "<tr class='class_tr_grid_dado_2'>";
        $sHTML .= "   <td colspan='7'  class='td_result_grid' style='text-align:center;'>";
        $sHTML .= "      Nenhum registro foi encontrado";
        $sHTML .= "   </td>";
        $sHTML .= "</tr>";
    }
}
else
{
    $sHTML .= "<tr class='class_tr_grid_dado_2'>";
    $sHTML .= "   <td colspan='7'  class='td_result_grid' style='color: #E8473E; text-align:center;'>";
    $sHTML .=        "Error: ".$oResult["error_message"];
    $sHTML .= "   </td>";
    $sHTML .= "</tr>";
}

$sHTML .= "         </table>";
$sHTML .= "      </td>";
$sHTML .= "   </tr>";
$sHTML .= "   <tr class='class_cabecalho_datagrid'>";
$sHTML .= "      <td style='width:100%; height:22px; text-align: center;' id='td_pages'>";
$sHTML .= "      </td>";
$sHTML .= "   </tr>";
$sHTML .= "</table>";

echo $sHTML;