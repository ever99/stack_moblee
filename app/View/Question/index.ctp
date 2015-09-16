<?php
	echo $this->Html->css('bootstrap');
    echo $this->Html->css('stack');

    $this->Html->script('jquery-2.1.4.min',array('inline'=>false)); 
    $this->Html->script('stackAPI',array('inline'=>false));
    $this->Html->script('bootstrap',array('inline'=>false));
?> 

<table style="width:100%;" cellpadding='0' cellspacing='0'>
    <tr>
        <td style="padding-bottom: 13px;">
            <input type="button" value="Persistir Dados" id="btn_persistir_dados" class="btn_stack" onclick="searchQuestionStackAPI(true);">
        </td>
    </tr>
    <tr>
        <td class="td_filter" align="center">
            <table cellpadding='0' cellspacing='0' border="0">
                <tr>
                    <td class="td_title" colspan="4">
                        Buscar na API
                    </td>
                </tr>
                <tr>
                    <td class="td_label">
                        Page
                    </td>
                    <td class="td_label">
                        RPP
                    </td>
                    </td>
                    <td class="td_label">
                        Sort
                    </td>
                    </td>
                    <td class="td_label">
                        Score
                    </td>
                </tr>
                <tr>
                    <td class="td_field">
                        <input type="number" onkeypress="return onlyNumber(event)" min="1" id="txt_page" name="txt_page" style="width: 150px;">
                    </td>
                    <td class="td_field">
                        <input type="number" onkeypress="return onlyNumber(event)" min="1" max="99" id="txt_rpp" name="txt_rpp" style="width: 150px;">
                    </td>
                    </td>
                    <td class="td_field">
                        <select class="form-control" id="txt_sort" name="txt_sort" style="width: 150px; font-size: 12px; color: #696969;">
                            <option value="question_id">
                                ID
                            </option>
                            <option value="title">
                                Título
                            </option>
                            <option value="owner_name">
                                Usuário
                            </option>
                            <option value="votes">
                                Pontos
                            </option>
                            <option value="creation">
                                Data
                            </option>
                            <option value="link">
                                Link
                            </option>
                            <option value="is_answered">
                                Respondida
                            </option>
                        </select>
                    </td>
                    </td>
                    <td class="td_field">
                        <input maxlength="19" type="number" onkeypress="return onlyNumber(event)" min="1" id="txt_score" name="txt_score" style="width: 150px;">
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 12px; padding-top: 10px;  width: 100%;" align="right" colspan="4">
                        <input type="button" value="Buscar" id="btn_buscar" class="btn_stack" onclick="searchQuestionStackAPI(false);">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div style="width:100%; padding-top: 20px;">
    <div class="class_datagrid" id="div_registros">
        <table style="width:100%;" cellspacing="0" cellpadding="0" id="tb_grid_results">
            <tr>
                <td style="width:100%;" colspan="2">
                    <table style="width:100%;" cellspacing="0" cellpadding="0">
                        <tr class="class_cabecalho_datagrid">
                            <td style="width:7%;" class="td_title_grid">
                                ID
                            </td>
                            <td style="width:25%;" class="td_title_grid">
                                Título
                            </td>
                            <td style="width:15;" class="td_title_grid">
                                Usuário
                            </td>
                            <td style="width:7%;" class="td_title_grid">
                                Pontos
                            </td>
                            <td style="width:7%;" class="td_title_grid">
                                Data
                            </td>                           
							<td style="width:9%;" class="td_title_grid">
                                Respondida
                            </td>
                            <td style="width:30%;" class="td_title_grid">
                                Link
                            </td>
                        </tr>
						<tr class="class_tr_grid_dado_2">
                            <td colspan="7"  class="td_result_grid" style="text-align:center;">
                                Informe os filtros e faça a busca
                            </td>
                        </tr>
					</table>
                </td>
            </tr>
            <tr class="class_cabecalho_datagrid">
                <td style="width:100%; height:22px; text-align: center;" id="td_pages">
                </td>
            </tr>
        </table>
    </div>
</div>