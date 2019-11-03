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


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
