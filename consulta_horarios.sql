SELECT t.dia_da_semana, t.hora_inicio, t.hora_final, p.nome, m.nome FROM quadro_horarios qh
JOIN tempos t ON t.quadro_horario_id = qh.id
JOIN professores p ON p.id = t.professor_id
JOIN professor_materia pm ON pm.professor_id = p.id AND pm.materia_id = t.materia_id
JOIN materias m ON m.id = pm.materia_id
WHERE qh.id = 1
ORDER BY t.dia_da_semana, t.hora_inicio