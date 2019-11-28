<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($turma->nome) ? $turma->nome : ''}}" required>
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('periodo_id') ? 'has-error' : ''}}">
    <label for="" class="control-label">{{ 'periodos' }}</label>
    <select class="form-control" name="periodo_id"> 
        @foreach($periodos as $periodo)
            <option value="{{ $periodo->id }}">{{$periodo->nome}}</option>
        @endforeach
    </select>
    {!! $errors->first('', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group col-md-4">
    <label for="" class="control-label">{{ 'Turno' }}</label>
    <select id="turno_id"  class="form-control" name="turno" required>
        <option value="">Selecione o turno</option>
        <option {{ (isset($turma) && $turma->turno == 1) ? 'selected' : '' }} value="1">Manhã</option>
        <option {{ (isset($turma) && $turma->turno == 2) ? 'selected' : '' }} value="2">Tarde</option>
        <option {{ (isset($turma) && $turma->turno == 3) ? 'selected' : '' }}value="3">Noite</option>
    </select>
</div> 

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
