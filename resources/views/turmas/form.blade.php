<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($turma->nome) ? $turma->nome : ''}}" required>
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('periodo_id') ? 'has-error' : ''}}">
    <label for="periodo_id" class="control-label">{{ 'Periodo Id' }}</label>
    <input class="form-control" name="periodo_id" type="number" id="periodo_id" value="{{ isset($turma->periodo_id) ? $turma->periodo_id : ''}}" >
    {!! $errors->first('periodo_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
