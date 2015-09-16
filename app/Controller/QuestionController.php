<?php
require_once "functionsController.php";

class QuestionController extends AppController
{
    public $helpers  = array ('Html','Form');
    public  $name    = 'Question';
    private $iPage   = 1;
    private $iRPP    = 99;
    public  $sSort   = "creation";

    public function ajaxQuestion()
    {
        $this->layout = "ajax";
        $oResult      = $this->searchQuestion();
		$this->set("oResult", $oResult);
    }
	
    public function ajaxPersist()
    {
        $this->layout    = "ajax";
        $oResult         = $this->searchQuestion();
		$oReturn["msg"]  = "";
		
        if(!isset($oResult["error_id"]))
		{
			if(count($oResult["items"]) > 0)
			{
				$oResult      = $oResult["items"];
				$oInsert      = Array();
				$oTransaction = $this->Question->getDataSource();
				$bErro        = false;
				
				$oTransaction->begin();
								
				for($i = 0; count($oResult) > $i; $i++)
				{
					$oData = array("Question" => array("question_id"   => $oResult[$i]["question_id"], 
													   "title"         => $oResult[$i]["title"], 
													   "owner_name"    => $oResult[$i]["owner"]["display_name"], 
													   "score"         => $oResult[$i]["score"], 
													   "creation_date" => $oResult[$i]["creation_date"], 
													   "link"          => $oResult[$i]["link"], 
													   "is_answered"   => $oResult[$i]["is_answered"]));
													  
					if (!$this->Question->save($oData)) 
					{
						$bErro = true;
						break;
					}	
				}
				
				if(!$bErro)
				{
					$oTransaction->commit();
					$oReturn["msg"] = "Registros incluídos com sucesso.";
				}
				else
				{
					$oTransaction->rollback();
					$oReturn["msg"] = "Houve um erro ao incluir os registros.";
				}
			} 
		}

		$oReturn = json_encode($oReturn);
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->body($oReturn);
    }

    private function searchQuestion()
    {
        if (!empty($_GET["page"]))
        {
            $this->iPage = $_GET["page"];
        }

        if (!empty($_GET["rpp"]))
        {
            $this->iRPP = $_GET["rpp"];
        }       
		
		if (!empty($_GET["sort"]))
        {
			if($_GET["sort"] === "votes")
			{
				$this->sSort = $_GET["sort"];
			}
        }

        if (!empty($_GET["score"]))
        {
			$this->iScore = intval($_GET["score"]) + 1;
        }

        $sURL = "api.stackexchange.com/2.2/questions?tagged=php&page={$this->iPage}&pagesize={$this->iRPP}&sort={$this->sSort}&min={$this->iScore}&site=stackoverflow";
        $oCurlHandle = curl_init();

        curl_setopt($oCurlHandle, CURLOPT_URL, $sURL);
        curl_setopt($oCurlHandle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($oCurlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurlHandle, CURLOPT_USERAGENT, "StackAPI");

        $oResult = (curl_exec($oCurlHandle));
        $oResult = gzinflate(substr($oResult, 10, -8));
        $oResult = json_decode($oResult, true);
        curl_close($oCurlHandle);
		
		#VERIFICA INCONSISTÊNCIAS - INICIO
		if(!isset($oResult["error_id"]))
		{
			#VERIFICA ORDENAÇÃO - INICIO
			if (!empty($_GET["sort"]))
			{
				#ORDENAÇÃO POR ID
				if($_GET["sort"] === "question_id")
				{
					arsort($oResult["items"]);
				}			
				#ORDENAÇÃO POR TÍTULO
				else if($_GET["sort"] === "title")
				{
					usort($oResult["items"], "orderByTitle");
				}				
				#ORDENAÇÃO POR USUÁRIO
				else if($_GET["sort"] === "owner_name")
				{
					usort($oResult["items"], "orderByUser");
				}				
				#ORDENAÇÃO POR LINK
				else if($_GET["sort"] === "link")
				{
					usort($oResult["items"], "orderByLink");
				}				
				#ORDENAÇÃO POR RESPONDIDA
				else if($_GET["sort"] === "is_answered")
				{
					usort($oResult["items"], "orderByAnswered");
				}
			}
			#VERIFICA ORDENAÇÃO - FIM
		}
		#VERIFICA INCONSISTÊNCIAS - FIM
		
        return $oResult;
    }

    public function index()
    {
        
    }
}
