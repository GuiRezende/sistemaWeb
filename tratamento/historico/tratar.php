<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require "../../config/banco.php"; 


if(!empty($_POST['leito']) && !empty($_POST['unidade']) && !empty($_POST['data_hora']) ){

    $leito                                      = addslashes($_POST['leito']);
    $unidade                                    = addslashes($_POST['unidade']);
    $data_hora                                  = addslashes($_POST['data_hora']);
    $origem                                     = addslashes($_POST['origem']);
    $condicaoChegada                            = addslashes($_POST['condicaoChegada']);
    $estadoEmocional                            = addslashes($_POST['estadoEmocional']);
    $saude_recentemente                         = addslashes($_POST['saude_recentemente']);
    $informanteResponsavel                      = addslashes($_POST['informanteResponsavel']);
    $motivo_internacao                          = addslashes($_POST['motivo_internacao']);
    $dor                                        = addslashes($_POST['dor']);
    $queixa_principal                           = addslashes($_POST['queixa_principal']);
    $quando_iniciou                             = addslashes($_POST['quando_iniciou']);
    $tratamento_em_casa                         = addslashes($_POST['tratamento_em_casa']);
    $tipo_sanguineo                             = addslashes($_POST['tipo_sanguineo']);
    $alergia                                    = addslashes($_POST['alergia']);
    $hospitalizacao_anterior                    = addslashes($_POST['hospitalizacao_anterior']);
    $cirurgia_anteriores                        = addslashes($_POST['cirurgia_anteriores']);
    $exames_recentes                            = addslashes($_POST['exames_recentes']);
    $tabagismo                                  = addslashes($_POST['tabagismo']);
    $neoplasia                                  = addslashes($_POST['neoplasia']);
    $doenca_auto_imune                          = addslashes($_POST['doenca_auto_imune']);
    $doenca_respiratoria                        = addslashes($_POST['doenca_respiratoria']);
    $doenca_renal                               = addslashes($_POST['doenca_renal']);
    $doenca_cardiovascular                      = addslashes($_POST['doenca_cardiovascular']);
    $diabetes                                   = addslashes($_POST['diabetes']);
    $disturbios_comportamentais                 = addslashes($_POST['disturbios_comportamentais']);
    $donecas_infectocontagiosas                 = addslashes($_POST['donecas_infectocontagiosas']);
    $dislipidemia                               = addslashes($_POST['dislipidemia']);
    $etilismo                                   = addslashes($_POST['etilismo']);
    $hipertensao                                = addslashes($_POST['hipertensao']);
    $transfusao_sanguinea                       = addslashes($_POST['transfusao_sanguinea']);
    $drogas_ilicitas                            = addslashes($_POST['drogas_ilicitas']);
    $virose_infancia                            = addslashes($_POST['virose_infancia']);
    $outros                                     = addslashes($_POST['outros']);
    $nivel_consciencia                          = addslashes($_POST['nivel_consciencia']);
    $linguagem                                  = addslashes($_POST['linguagem']);
    $alteracao_visao                            = addslashes($_POST['alteracao_visao']);
    $alteracao_audicao                          = addslashes($_POST['alteracao_audicao']);
    $respiracao                                 = addslashes($_POST['respiracao']);
    $apetite                                    = addslashes($_POST['apetite']);
    $reducao_alimentar                          = addslashes($_POST['reducao_alimentar']);
    $mudanca_de_peso                            = addslashes($_POST['mudanca_de_peso']);
    $ingestao_agua                              = addslashes($_POST['ingestao_agua']);
    $protese                                    = addslashes($_POST['protese']);
    $disturbios                                 = addslashes($_POST['disturbios']);
    $uso_de_sonda                               = addslashes($_POST['uso_de_sonda']);
    $diurese                                    = addslashes($_POST['diurese']);
    $uso_de_sonda_diurese                       = addslashes($_POST['uso_de_sonda_diurese']);
    $ritmo_intestinal                           = addslashes($_POST['ritmo_intestinal']);
    $abdome                                     = addslashes($_POST['abdome']);
    $vomito                                     = addslashes($_POST['vomito']);
    $aparelho_urinario                          = addslashes($_POST['aparelho_urinario']);
    $menopausa                                  = addslashes($_POST['menopausa']);
    $preventivo_prostata                        = addslashes($_POST['preventivo_prostata']);
    $pele                                       = addslashes($_POST['pele']);
    $tugor_elasticidade                         = addslashes($_POST['tugor_elasticidade']);
    $edema                                      = addslashes($_POST['edema']);
    $prurido                                    = addslashes($_POST['prurido']);
    $lesao                                      = addslashes($_POST['lesao']);
    $sedentarismo                               = addslashes($_POST['sedentarismo']);
    $dificuldade_dormir                         = addslashes($_POST['dificuldade_dormir']);
    $aux_dormir                                 = addslashes($_POST['aux_dormir']);

    $paciente_id                                = addslashes($_POST['paciente_id']);
    $respiracaoText                             = addslashes($_POST['respiracaoText']);
    $linguagemText                              = addslashes($_POST['linguagemText']);             
    $nivel_conscienciaText                      = addslashes($_POST['nivel_conscienciaText']);
    $outrosText                                 = addslashes($_POST['outrosText']);
    $virose_infanciaText                        = addslashes($_POST['virose_infanciaText']);
    $drogas_ilicitasText                        = addslashes($_POST['drogas_ilicitasText']);
    $transfusao_sanguineaText                   = addslashes($_POST['transfusao_sanguineaText']);
    $hipertensaoText                            = addslashes($_POST['hipertensaoText']);
    $etilismoText                               = addslashes($_POST['etilismoText']);
    $dislipidemiaText                           = addslashes($_POST['dislipidemiaText']);
    $donecas_infectocontagiosasText             = addslashes($_POST['donecas_infectocontagiosasText']);
    $disturbiosComportamentaisText              = addslashes($_POST['disturbiosComportamentaisText']);
    $diabetesText                               = addslashes($_POST['diabetesText']);
    $doenca_cardiovascularText                  = addslashes($_POST['doenca_cardiovascularText']);
    $doenca_renalText                           = addslashes($_POST['doenca_renalText']);
    $doenca_respiratoriaText                    = addslashes($_POST['doenca_respiratoriaText']);
    $doenca_auto_imuneText                      = addslashes($_POST['doenca_auto_imuneText']);
    $neoplasiaText                              = addslashes($_POST['neoplasiaText']);
    $tabagismoText                              = addslashes($_POST['tabagismoText']);
    $saude_recentementeText                     = addslashes($_POST['saude_recentementeText']);
    $informante                                 = addslashes($_POST['informante']);
    $alergiaText                                = addslashes($_POST['alergiaText']);
    $cirurgiaRealizada                          = addslashes($_POST['cirurgiaRealizada']);
    $exameRecente                               = addslashes($_POST['exameRecente']);

    $historico = $pdo->prepare("INSERT INTO historicos_enf (paciente_id, leito, unidade, data_hora, origem, condicaoChegada, estadoEmocional, saude_recentemente,informanteResponsavel, motivo_internacao, dor, 
    queixa_principal, quando_iniciou, tratamento_em_casa, tipo_sanguineo, alergia, hospitalizacao_anterior, cirurgia_anteriores, exames_recentes, tabagismo,
    neoplasia, doenca_auto_imune, doenca_respiratoria, doenca_renal, doenca_cardiovascular, diabetes, disturbios_comportamentais, donecas_infectocontagiosas,
    dislipidemia, etilismo, hipertensao, transfusao_sanguinea, drogas_ilicitas, outros, nivel_consciencia, linguagem, alteracao_visao, respiracao, apetite,
    reducao_alimentar, mudanca_de_peso, ingestao_agua, protese, disturbios, uso_de_sonda, diurese, uso_de_sonda_diurese, ritmo_intestinal, abdome, vomito,
    aparelho_urinario, menopausa, preventivo_prostata, pele, tugor_elasticidade, edema, prurido, lesao, sedentarismo, dificuldade_dormir, aux_dormir, respiracaoText, linguagemText, nivel_conscienciaText, outrosText, 
    virose_infanciaText, drogas_ilicitasText, transfusao_sanguineaText, hipertensaoText, etilismoText, dislipidemiaText, donecas_infectocontagiosasText, 
    disturbiosComportamentaisText, diabetesText, doenca_cardiovascularText, doenca_renalText, doenca_respiratoriaText, doenca_auto_imuneText, neoplasiaText, 
    tabagismoText, saude_recentementeText, informante, alergiaText, cirurgiaRealizada, exameRecente, virose_infancia, alteracao_audicao) VALUES (:paciente_id, :leito, :unidade, :data_hora, :origem, :condicaoChegada, :estadoEmocional, :saude_recentemente, :informanteResponsavel, :motivo_internacao, 
    :dor, :queixa_principal, :quando_iniciou, :tratamento_em_casa, :tipo_sanguineo, :alergia, :hospitalizacao_anterior, :cirurgia_anteriores, 
    :exames_recentes, :tabagismo, :neoplasia, :doenca_auto_imune, :doenca_respiratoria, :doenca_renal, :doenca_cardiovascular, :diabetes, 
    :disturbios_comportamentais, :donecas_infectocontagiosas, :dislipidemia, :etilismo, :hipertensao, :transfusao_sanguinea, :drogas_ilicitas, :outros, 
    :nivel_consciencia, :linguagem, :alteracao_visao, :respiracao, :apetite, :reducao_alimentar, :mudanca_de_peso, :ingestao_agua, :protese, :disturbios,
    :uso_de_sonda, :diurese, :uso_de_sonda_diurese, :ritmo_intestinal, :abdome, :vomito, :aparelho_urinario, :menopausa, :preventivo_prostata, :pele, 
    :tugor_elasticidade, :edema, :prurido, :lesao, :sedentarismo, :dificuldade_dormir, :aux_dormir, :respiracaoText, :linguagemText, :nivel_conscienciaText, :outrosText, 
    :virose_infanciaText, :drogas_ilicitasText, :transfusao_sanguineaText, :hipertensaoText, :etilismoText, :dislipidemiaText, :donecas_infectocontagiosasText, 
    :disturbiosComportamentaisText, :diabetesText, :doenca_cardiovascularText, :doenca_renalText, :doenca_respiratoriaText, :doenca_auto_imuneText, :neoplasiaText, 
    :tabagismoText, :saude_recentementeText, :informante, :alergiaText, :cirurgiaRealizada, :exameRecente, :virose_infancia, :alteracao_audicao)");
 
    $historico->bindValue(":paciente_id", $paciente_id);
    $historico->bindValue(":leito", $leito); 
    $historico->bindValue(":unidade", $unidade); 
    $historico->bindValue(":data_hora",$data_hora );
    $historico->bindValue(":origem", $origem); 
    $historico->bindValue(":condicaoChegada", $condicaoChegada); 
    $historico->bindValue(":estadoEmocional", $estadoEmocional); 
    $historico->bindValue(":saude_recentemente", $saude_recentemente); 
    $historico->bindValue(":informanteResponsavel", $informanteResponsavel); 
    $historico->bindValue(":motivo_internacao", $motivo_internacao); 
    $historico->bindValue(":dor", $dor); 
    $historico->bindValue(":queixa_principal", $queixa_principal);
    $historico->bindValue(":quando_iniciou", $quando_iniciou); 
    $historico->bindValue(":tratamento_em_casa", $tratamento_em_casa);
    $historico->bindValue(":tipo_sanguineo", $tipo_sanguineo); 
    $historico->bindValue(":alergia", $alergia); 
    $historico->bindValue(":hospitalizacao_anterior", $hospitalizacao_anterior);
    $historico->bindValue(":cirurgia_anteriores", $cirurgia_anteriores); 
    $historico->bindValue(":exames_recentes", $exames_recentes); 
    $historico->bindValue(":tabagismo", $tabagismo);
    $historico->bindValue(":neoplasia", $neoplasia);
    $historico->bindValue(":alteracao_audicao", $alteracao_audicao);
    $historico->bindValue(":doenca_auto_imune", $doenca_auto_imune);
    $historico->bindValue(":doenca_respiratoria", $doenca_respiratoria); 
    $historico->bindValue(":doenca_renal", $doenca_renal); 
    $historico->bindValue(":doenca_cardiovascular", $doenca_cardiovascular);
    $historico->bindValue(":diabetes", $diabetes); 
    $historico->bindValue(":disturbios_comportamentais", $disturbios_comportamentais); 
    $historico->bindValue(":donecas_infectocontagiosas", $donecas_infectocontagiosas); 
    $historico->bindValue(":dislipidemia", $dislipidemia);
    $historico->bindValue(":etilismo", $etilismo); 
    $historico->bindValue(":hipertensao", $hipertensao);
    $historico->bindValue(":transfusao_sanguinea", $transfusao_sanguinea); 
    $historico->bindValue(":drogas_ilicitas", $drogas_ilicitas);
    $historico->bindValue(":virose_infancia", $virose_infancia);
    $historico->bindValue(":outros", $outros); 
    $historico->bindValue(":nivel_consciencia", $nivel_consciencia); 
    $historico->bindValue(":linguagem", $linguagem); 
    $historico->bindValue(":alteracao_visao", $alteracao_visao);
    $historico->bindValue(":respiracao", $respiracao); 
    $historico->bindValue(":apetite", $apetite); 
    $historico->bindValue(":reducao_alimentar", $reducao_alimentar); 
    $historico->bindValue(":mudanca_de_peso", $mudanca_de_peso); 
    $historico->bindValue(":ingestao_agua", $ingestao_agua); 
    $historico->bindValue(":protese", $protese); 
    $historico->bindValue(":disturbios", $disturbios);
    $historico->bindValue(":uso_de_sonda", $uso_de_sonda); 
    $historico->bindValue(":diurese", $diurese); 
    $historico->bindValue(":uso_de_sonda_diurese", $uso_de_sonda_diurese); 
    $historico->bindValue(":ritmo_intestinal", $ritmo_intestinal); 
    $historico->bindValue(":abdome", $abdome); 
    $historico->bindValue(":vomito", $vomito); 
    $historico->bindValue(":aparelho_urinario", $aparelho_urinario); 
    $historico->bindValue(":menopausa", $menopausa); 
    $historico->bindValue(":preventivo_prostata", $preventivo_prostata); 
    $historico->bindValue(":pele", $pele); 
    $historico->bindValue(":tugor_elasticidade", $tugor_elasticidade); 
    $historico->bindValue(":edema", $edema); 
    $historico->bindValue(":prurido", $prurido); 
    $historico->bindValue(":lesao", $lesao); 
    $historico->bindValue(":sedentarismo", $sedentarismo); 
    $historico->bindValue(":dificuldade_dormir", $dificuldade_dormir); 
    $historico->bindValue(":aux_dormir", $aux_dormir);

    $historico->bindValue(":respiracaoText", $respiracaoText);                
    $historico->bindValue(":linguagemText", $linguagemText);                 
    $historico->bindValue(":nivel_conscienciaText", $nivel_conscienciaText);        
    $historico->bindValue(":outrosText", $outrosText);                   
    $historico->bindValue(":virose_infanciaText", $virose_infanciaText);         
    $historico->bindValue(":drogas_ilicitasText", $drogas_ilicitasText);         
    $historico->bindValue(":transfusao_sanguineaText", $transfusao_sanguineaText);    
    $historico->bindValue(":hipertensaoText", $hipertensaoText);           
    $historico->bindValue(":etilismoText", $etilismoText);              
    $historico->bindValue(":dislipidemiaText", $dislipidemiaText);            
    $historico->bindValue(":donecas_infectocontagiosasText", $donecas_infectocontagiosasText);
    $historico->bindValue(":disturbiosComportamentaisText", $disturbiosComportamentaisText);
    $historico->bindValue(":diabetesText", $diabetesText);               
    $historico->bindValue(":doenca_cardiovascularText", $doenca_cardiovascularText);   
    $historico->bindValue(":doenca_renalText", $doenca_renalText);          
    $historico->bindValue(":doenca_respiratoriaText", $doenca_respiratoriaText);     
    $historico->bindValue(":doenca_auto_imuneText", $doenca_auto_imuneText);        
    $historico->bindValue(":neoplasiaText", $neoplasiaText);          
    $historico->bindValue(":tabagismoText", $tabagismoText);           
    $historico->bindValue(":saude_recentementeText", $saude_recentementeText);     
    $historico->bindValue(":informante", $informante);                   
    $historico->bindValue(":alergiaText", $alergiaText);              
    $historico->bindValue(":cirurgiaRealizada", $cirurgiaRealizada);        
    $historico->bindValue(":exameRecente", $exameRecente);               
    $historico->execute();

    $id        = $pdo->lastInsertId();

    if($historico){

        header("Location:../../prontuario.php?alterar=".$paciente_id."&id_historico=".$id);
    }
    else{
        echo "nao salvou..";
    }

}else{
    echo "nao entrou....";
}

?>