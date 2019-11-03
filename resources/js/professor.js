
window.atualizar_periodo_turno =  function() {
    $("#formEnviarTurnos").attr("method", "GET");
    $("#formEnviarTurnos").attr("action", "/professores/periodos/"+$("#professor_id").val());
    $("#formEnviarTurnos").submit();    
}
