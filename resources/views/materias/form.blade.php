<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($materia->nome) ? $materia->nome : ''}}" required>
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('quantidade_aulas') ? 'has-error' : ''}}">
    <label for="quantidade_aulas" class="control-label">{{ 'Quantidade Aulas' }}</label>
    <input class="form-control" name="quantidade_aulas" type="number" id="quantidade_aulas" value="{{ isset($materia->quantidade_aulas) ? $materia->quantidade_aulas : ''}}" required>
    {!! $errors->first('quantidade_aulas', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('quebrar') ? 'has-error' : ''}}">
    <label for="quebrar" class="control-label">{{ 'Quebrar' }}</label>
    <input class="form-control" name="quebrar" type="number" id="quebrar" value="{{ isset($materia->quebrar) ? $materia->quebrar : ''}}" required>
    {!! $errors->first('quebrar', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('grade_id') ? 'has-error' : ''}}">
    <label for="" class="control-label">{{ 'Grades' }}</label>
    <select class="form-control" name="grade_id"> 
        @foreach($grades as $grade)
            <option value="{{ $grade->id }}">{{$grade->nome}}</option>
        @endforeach
    </select>
    {!! $errors->first('', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
