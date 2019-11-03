@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Professor {{ $professor->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/professores') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/professores/' . $professor->id . '/edit') }}" title="Edit Professor"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('professores' . '/' . $professor->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Professor" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $professor->id }}</td>
                                    </tr>
                                    <tr><th> Nome </th><td> {{ $professor->nome }} </td></tr><tr><th> Prioridade </th><td> {{ $professor->prioridade }} </td></tr><tr><th> Quantidade Aulas </th><td> {{ $professor->dia_da_semana }} </td></tr>
                                </tbody>
                            </table>
                        </div>                       
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Professor Periodos</div>
                    <div class="card-body">
                        <form id="formEnviarTurnos" method="POST" action="{{ url('/professores/periodos') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}                        
                            <input type="hidden" id="professor_id" name="professor_id" value="{{$professor->id}}">
                            <div class="form-group {{ $errors->has('periodo_id') ? 'has-error' : ''}}">
                                <label for="" class="control-label">{{ 'periodos' }}</label>
                                <select onchange="atualizar_periodo_turno()" id="periodo_id" class="form-control" name="periodo_id"> 
                                    @foreach($periodos as $periodo)
                                        <option value="{{ $periodo->id }}">{{$periodo->nome}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('', '<p class="help-block">:message</p>') !!}
                            </div>                            
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="" class="control-label">{{ 'Turno' }}</label>
                                    <select id="turno_id" onchange="atualizar_periodo_turno()" class="form-control" name="turno">
                                        <option {{ ($turno == 1) ? 'selected' : '' }} value="1">Manhã</option>
                                        <option {{ ($turno == 2) ? 'selected' : '' }} value="2">Tarde</option>
                                        <option {{ ($turno == 3) ? 'selected' : '' }}value="3">Noite</option>
                                    </select>
                                </div> 
                                <div class="col-md-4">
                                    <label for="" class="control-label">{{ 'Dias disponiveis' }}</label>
                                    <select class="form-control" name="dia_da_semana[]" multiple>

                                        <option {{ $dias_da_semana->contains(1)? 'selected' : '' }} value="1">Segunda-Feira</option>
                                        <option {{ $dias_da_semana->contains(2)? 'selected' : '' }} value="2">Terça-Feira</option>
                                        <option {{ $dias_da_semana->contains(3)? 'selected' : '' }} value="3">Quarta-Feira</option>
                                        <option {{ $dias_da_semana->contains(4)? 'selected' : '' }} value="4">Quinta-Feira</option>
                                        <option {{ $dias_da_semana->contains(5)? 'selected' : '' }} value="5">Sexta-Feira</option>
                                        <option {{ $dias_da_semana->contains(6)? 'selected' : '' }} value="6">Sabado</option>
                                    </select>
                                </div>
                                            
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Cadastrar">
                            </div>

                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
@endsection
@section('footer')
@endsection