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
<div class="form-group {{ $errors->has('materia_id') ? 'has-error' : ''}}">
    <label for="" class="control-label">{{ 'Materias' }}</label>
    <select class="form-control" name="materia_id[]" multiple> 
        @foreach($materias as $materia)
            <option {{ isset($professor) && $professor->materias->contains($materia)? 'selected' : '' }} value="{{ $materia->id }}">{{$materia->nome}}</option>
        @endforeach
    </select>
    {!! $errors->first('', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('grade_id') ? 'has-error' : ''}}">
    <label for="" class="control-label">{{ 'grades' }}</label>
    <select class="form-control" name="grade_id[]" multiple> 
        @foreach($grades as $grade)
            <option {{ isset($professor) && $professor->grades->contains($grade)? 'selected' : '' }} value="{{ $grade->id }}">{{$grade->nome}}</option>
        @endforeach
    </select>
    {!! $errors->first('', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
