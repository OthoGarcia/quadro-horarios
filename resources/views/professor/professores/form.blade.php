<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($professor->nome) ? $professor->nome : ''}}" >
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('prioridade') ? 'has-error' : ''}}">
    <label for="prioridade" class="control-label">{{ 'Prioridade' }}</label>
    <input class="form-control" name="prioridade" type="number" id="prioridade" value="{{ isset($professor->prioridade) ? $professor->prioridade : ''}}" >
    {!! $errors->first('prioridade', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('quantidade_aulas') ? 'has-error' : ''}}">
    <label for="quantidade_aulas" class="control-label">{{ 'Quantidade Aulas' }}</label>
    <input class="form-control" name="quantidade_aulas" type="number" id="quantidade_aulas" value="{{ isset($professor->quantidade_aulas) ? $professor->quantidade_aulas : ''}}" >
    {!! $errors->first('quantidade_aulas', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
