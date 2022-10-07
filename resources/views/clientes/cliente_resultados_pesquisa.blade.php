   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Painel de Controle - Clientes</h1>
        {{ Auth::user()->name }} 
      </div>

        <div class="margem_cima_baixo">
          <div class="table-responsive">
            @if(count($eventos)>=1)   
              <h2>{{ $eventos->total() }} Eventos Encontrados</h2> 
              {{ $eventos->appends(['campo_de_pesquisa' => isset($campo_de_pesquisa) ? $campo_de_pesquisa : ''])->links() }}
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($eventos as $evento)
                   <tr>
                    <td id="{{$evento->evento_id}}">{{$evento->evento_id}} </td>
                    <td>{{ $evento->evento }}</td>
                    <td>{{ $evento->desc }}</td>
                    <td>{{ $evento->data }}</td>
                    <td>
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
                  </tr>  
                  @endforeach
                </tbody>
              </table>
              {{ $eventos->appends(['campo_de_pesquisa' => isset($campo_de_pesquisa) ? $campo_de_pesquisa : ''])->links() }}
              @else
              <h2>Nenhum Evento com estas especificações</h2>
              @endif
            </div>
         </div><!-- Margem_cima_baixo-->            
