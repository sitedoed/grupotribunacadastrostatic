

          <div class="margem_cima_baixo">
            <div class="container">
              <div class="row">
                  <div class="col-sm-4">
                    <h3>Estatísticas da empresa: </h3>
                  </div>
                  <div class="col-sm-8">
                   <h4>  
                     @foreach($empresa as $empresa)
                        {{ $empresa->name }}
                      @endforeach
                  </h4>
                  </div>
                  <div class="col-sm-4">
                    <h5>Departamentos: </h5>
                  </div>
                  <div class="col-sm-8">
                    <h4> {{ $departamentos_por_empresa->count() }}  </h4>
                  </div>
                  <div class="col-sm-4">
                    <h5>Eventos: </h5>
                  </div>
                  <div class="col-sm-8">
                    <h4> {{ $eventos_por_empresa->count() }}  </h4>
                  </div>
                  <div class="col-sm-4">
                    <h5>Inscritos nos eventos: </h5>
                  </div>
                  <div class="col-sm-8">
                    <h4>{{ $inscritos_por_empresa }} </h4>
                  </div>
                </div>
              </div>
          </div>            


@if(count($departamentos_por_empresa)>=1) 
        <div class="margem_cima_baixo">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Departamentos</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach($departamentos_por_empresa as $departamento)
                  <tr>
                    <td class="margin_right_5">{{ $departamento->name }}</td>
                    <td class="col">{{ $departamento->empresa }}</td>
                    <td class="col"></td>
                    <td class="col"></td>
                    <td>
                    {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$departamento->id.'/departamentos_editar'])!!}
                    {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                    </td>
                    <td>
                    {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$departamento->id.'/departamentos_confirmar_deletar'])!!}
                    {!! Form::submit('Deletar', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </td>                   
                  </tr>
                  @endforeach
              </tbody>
            </table>

          </div>
        </div>
@endif


@if(count($eventos_por_empresa)>=1) 
          <div class="margem_cima_baixo">
              <div class="table-responsive">
     

                  <table class="table table-striped table-sm">
                    <thead>
                      <tr> <h3>Lista de Eventos</h3>
                        <th>Evento</th>
                        <th >Departamento</th>
                        <th></th>
                        <th>Data</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach($eventos_por_empresa as $evento)
                        <tr>
                          <td class="col">{{$evento->evento}}</td>
                          <td class="col">{{$evento->departamento}}</td>
                          <td><span class="invisible"></span></td>
                          <td class="col">
                             {{ date( 'd/m/Y' , strtotime($evento->data)) }}
                          </td>
                         <td><span class="invisible"></span></td>
                          <td class="col"><a href=\painel_de_controle/admin/{{ $evento->evento_id }}/evento_estatisticas>Estatísticas</a>
                          </td>
                          <td ></td>
                          <td class="col">
                            {!! Form::open(['method' =>'PATCH', 'url' =>'painel_de_controle/admin/'.$evento->id.'/eventos_editar'])!!}
                            {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                          </td>
                          <td>
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$evento->id.'/eventos_confirmar_deletar'])!!}
                            {!! Form::submit('DELETAR', ['class'=>'btn btn-danger ']) !!}
                            {!! Form::close() !!}
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>

              </div>
          </div>
@endif