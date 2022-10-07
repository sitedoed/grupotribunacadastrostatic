

          <div class="margem_cima_baixo">
              <div class="table-responsive">
                  @if(count($eventos)>=1)      

                  <table class="table table-striped table-sm">
                    <thead>
                      <tr> <h3>Lista de Eventos da Empresa: {{ $empresa->name }}</h3>
                        <th>ID</th>
                        <th>Evento</th>
                        <th>Data</th>
                        <th></th>
                        <th >Departamento</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach($eventos as $evento)
                        <tr>
                          <td calss="col">{{$evento->id}}</td>
                          <td class="col">{{$evento->nome}}</td>
                          <td class="col">
                             {{ date( 'd/m/Y' , strtotime($evento->data)) }}
                          </td>
                          <td class="col">{{$evento->empresa}}</td>
                          <td class="col">{{$evento->departamento}}</td>
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
                  @else
                    <h3>Não há eventos da cadastrados da empresa: {{ $empresa->name }}, até o momento.</h3>
                  @endif 
              </div>
          </div>
