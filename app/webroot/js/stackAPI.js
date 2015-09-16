function searchQuestionStackAPI(bPersist)
{
    var iPage  = $("#txt_page").val();
    var iRPP   = $("#txt_rpp").val();
    var sSort  = $("#txt_sort").val();
    var iScore = $("#txt_score").val();
    var sURL   = "Question/ajaxQuestion";
    var sType  = "html";
    
    //OS CAMPOS PAGE E RESULTS PER PAGE DEVER SER USADO EM CONJUNTO
    if((isEmpty(iPage) && !isEmpty(iRPP)) ||  (isEmpty(iRPP) && !isEmpty(iPage)))
    {
        alert("Os campos [Page] e [RPP] devem ser usados em conjunto.");
    }
    else if(iRPP > 99)
    {
        alert("A busca somente pode ter 99 registros [RPP].");
    }
    else
    { 
        if(bPersist)
        {
            sURL  = "Question/ajaxPersist";
			sType = "json";
            
        }
        openLoading();
        $.ajax({
            url: sURL,
            type: "GET",
            async: true,
            dataType: sType,
            data:
            {
                page:iPage,
                rpp:iRPP,
                sort:sSort,
                score:iScore,
                tags: "php"
            },
            success: function (oRetorno)
            {
                closeLoading();
				
				if(bPersist)
				{
					alert(oRetorno.msg);
				}
				else
				{
					$("#div_registros").html(oRetorno);
				}
                
            },
            error: function (oRetorno)
            {
                closeLoading();
                alert("Houve um erro ao executar a requisição.");
                console.log(oRetorno);
            }
        });
    }
}

function linkOpen(sLink)
{
    window.open(sLink,"_blank");
}

function isEmpty(sValue)
{
    var bReturn = false;

    if (trimJs(sValue).length === 0)
    {
        bReturn = true;
    }
    else if (sValue == 0)
    {
        bReturn = true;
    }
    else if (sValue == null)
    {
        bReturn = true;
    }
    return bReturn;
}

function trimJs(sValue)
{
    var sTrimValue = lTrimJs(sValue);

    sTrimValue = rTrimJs(sTrimValue);

    return sTrimValue;
}

function lTrimJs(sValue)
{
    var sNewValue = new String(sValue);
    var iSize     = sNewValue.length;
    var iPosition = 0;
    var i         = iSize - 1;

    while (sNewValue.charAt(i) == ' ')
    {
        iPosition++;
        i--;
    }

    var sReturn = new String(sNewValue.substr(0, iSize - iPosition));

    return sReturn;
}

function rTrimJs(sValue)
{
    var sNewValue = new String(sValue);
    var iSize     = sNewValue.length;
    var i         = 0;
    
    while (sNewValue.charAt(i) == ' ')
    {
        i++;
    }

    var sReturn = new String(sNewValue.substr(i, iSize - i));

    return sReturn;
}

function openLoading()
{
    var oDivTrans = $("<div class='div_trans' id='div_trans'></div>");
    var oDivLoading = $("<div class='div_loading' id='div_loading'></div>");
    oDivLoading.append("<img class='gif_loading' src='img/cake.loading.gif'>");
    oDivLoading.append("<div style='bottom: 2px; position: absolute; left: 60;'>Carregando...</div>");

    $("body").append(oDivLoading);
    $("body").append(oDivTrans);

    document.getElementById("div_loading").style.left = ($("body").width() / 2) - ($("#div_loading").width() / 2);
    document.getElementById("div_loading").style.top = ($("body").height() / 2) - ($("#div_loading").height() / 2);
}

function closeLoading()
{
    var oDivTrans = $("#div_trans");
    var oDivLoading = $("#div_loading");
    oDivTrans.remove();
    oDivLoading.remove();
}

function onlyNumber(oEvent)
{
    if (window.event)
    {
        var iKey = event.keyCode;
    }
    else
    {
        var iKey = oEvent.which;
    }

    if ((iKey > 47 && iKey < 58))
    {
        return true;
    }
    else
    {
        if (iKey == 8 || iKey == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}