<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($periodo->nome) ? $periodo->nome : ''}}" required>
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('grade_id') ? 'has-error' : ''}}">
    <label for="" class="control-label">{{ 'grades' }}</label>
    <select class="form-control" name="grade_id"> 
        @foreach($grades as $grade)
            <option {{ isset($professor) && $professor->grades->contains($grade)? 'selected' : '' }} value="{{ $grade->id }}">{{$grade->nome}}</option>
        @endforeach
    </select>
    {!! $errors->first('', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
