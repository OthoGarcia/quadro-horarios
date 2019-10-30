<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($periodo->nome) ? $periodo->nome : ''}}" required>
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('grade_id') ? 'has-error' : ''}}">
    <label for="grade_id" class="control-label">{{ 'Grade Id' }}</label>
    <input class="form-control" name="grade_id" type="number" id="grade_id" value="{{ isset($periodo->grade_id) ? $periodo->grade_id : ''}}" >
    {!! $errors->first('grade_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
