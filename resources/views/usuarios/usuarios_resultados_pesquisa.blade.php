   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Painel de Controle - Usuários</h1>
        {{ Auth::user()->name }} 
      </div>

        <div class="margem_cima_baixo">
          <div class="table-responsive">
            @if(count($clientes)>=1)   
              <h2>{{ $clientes->total() }} Clientes Encontrados</h2> 
              {{ $clientes->appends(['campo_de_pesquisa' => isset($campo_de_pesquisa) ? $campo_de_pesquisa : ''])->links() }}
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Evento</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($clientes as $cliente)
                   <tr>
                    <td id="{{$cliente->cliente_id}}">{{$cliente->cliente_id}} </td>
                    <td>{{ $cliente->name }}</td>
                    <td>{{ $cliente->email1 }}</td>
                    <td>{{ $cliente->evento }}</td>
                    <td>
                      {!! Form::open(['method' =>'PATCH', 'url' =>'painel_de_controle/usuarios/'.$cliente->cliente_id.'/clientes_editar'])!!}
                      {!! Form::submit('Editar', ['class'=>'btn btn-primary floatright']) !!}
                      {!! Form::close() !!}
                    </td>
                    <td>
                      {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/'.$cliente->cliente_id.'/cliente_confirmar_deletar'])!!}
                      {!! Form::submit('DELETAR', ['class'=>'btn btn-danger floatright']) !!}
                      {!! Form::close() !!}
                    </td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>
              @else
              <h2>Nenhum Cliente com estas especificações</h2>
              @endif
              {{ $clientes->appends(['campo_de_pesquisa' => isset($campo_de_pesquisa) ? $campo_de_pesquisa : ''])->links() }}
            </div>
         </div><!-- Margem_cima_baixo-->            

