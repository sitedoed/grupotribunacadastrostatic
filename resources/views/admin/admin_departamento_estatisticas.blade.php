
          <div class="margem_cima_baixo">
            <div class="container">
              <div class="row">
                  <div class="col-sm-5">
                    <h3>Estatísticas do departamento: </h3>
                  </div>
                  <div class="col-sm-7">
                   <h3>  {{ $departamento->name }}
                  </h3>
                  </div>
                  <div class="col-sm-5">
                    <h5>Empresa: </h5>
                  </div>
                  <div class="col-sm-7">
                    <h4>@foreach($departamento_da_empresa as $empresa)
                          {{ $empresa->name }}
                        @endforeach
                    </h4>
                  </div>
                  <div class="col-sm-5">
                    <h5>Eventos: </h5>
                  </div>
                  <div class="col-sm-7">
                    <h4>{{ $eventos_por_departamento->count() }}</h4>
                  </div>
                  <div class="col-sm-5">
                    <h5>Inscritos nos eventos: </h5>
                  </div>
                  <div class="col-sm-7">
                    <h4>{{ $inscritos_por_departamento}}</h4>
                  </div>
                </div>
              </div>
          </div>            



    @if($eventos_por_departamento->count()>=1)
          <div class="margem_cima_baixo">
              <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr> <h3>Lista de Eventos do departamento</h3>
                        <th>Evento</th>
                        <th ></th>
                        <th>Data</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach($eventos_por_departamento as $evento)
                        <tr>
                          <td class="col">{{$evento->nome}}</td>
                          <td class="col">{{$evento->departamento}}</td>
                          <td class="col">
                             {{ date( 'd/m/Y' , strtotime($evento->data)) }}
                          </td>
                          <td class="col">{{$evento->empresa}}</td>
                          <td class="col"><a href=\painel_de_controle/admin/{{ $evento->id }}/evento_estatisticas>Estatísticas</a>
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