          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Clientes</h1>
            {{ Auth::user()->name }} 
          </div>

            <div class="margem_cima_baixo">
                <div class="table-responsive">
                    @if(count($eventos)>=1)      
                    {{ $eventos->links() }}
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr> <h3>Lista de Eventos Cadastrados</h3>
                          <th>ID</th>
                          <th>Evento</th>
                          <th>Data</th>
                          <th>Empresa</th>
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
                            <td class="col"><a href=http://atdigital.com.br/cadastro/painel_de_controle/clientes/{{ $evento->id }}/evento_estatisticas>Estatísticas</a>
                            </td>
                            <td ></td>
                            <td class="col">
                              @if(($evento->data) > $hoje)
                                {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/clientes/'.$evento->id.'/inscrever'])!!}



                                  <input type="hidden" name="eventos_departamentos_id" value="{{ $evento->departamento_id }}" >
                                  <input type="hidden" name="eventos_departamentos_empresas_id" value="{{ $evento->empresa_id }}" >
                                  <input type="hidden" name="clientes_id" value=" {{ Auth::user()->id }} " >



                                {!! Form::submit('Inscrever', ['class'=>'btn btn-primary']) !!}
                                {!! Form::close() !!}                              
                              @else
                              <span class="btn btn-secondary">Encerrado</span>
                              @endif
                            </td>
                            <td>
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                    {{ $eventos->links() }}
                    @endif 
                </div>
        </div>
