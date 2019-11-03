<div class="form-group {{ $errors->has('quantidade_tempos') ? 'has-error' : ''}}">
    <label for="quantidade_tempos" class="control-label">{{ 'Quantidade Tempos' }}</label>
    <input class="form-control" name="quantidade_tempos" type="number" id="quantidade_tempos" value="{{ isset($quadrohorario->quantidade_tempos) ? $quadrohorario->quantidade_tempos : ''}}" required>
    {!! $errors->first('quantidade_tempos', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tempo_intervalo') ? 'has-error' : ''}}">
    <label for="tempo_intervalo" class="control-label">{{ 'Tempo Intervalo' }}</label>
    <input class="form-control" name="tempo_intervalo" type="number" id="tempo_intervalo" value="{{ isset($quadrohorario->tempo_intervalo) ? $quadrohorario->tempo_intervalo : ''}}" required>
    {!! $errors->first('tempo_intervalo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('turma_id') ? 'has-error' : ''}}">
    <label for="" class="control-label">{{ 'Turma' }}</label>
    <select class="form-control" name="turma_id"> 
        @foreach($turmas as $turma)
            <option value="{{ $turma->id }}">{{$turma->nome}}</option>
        @endforeach
    </select>
    {!! $errors->first('', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
