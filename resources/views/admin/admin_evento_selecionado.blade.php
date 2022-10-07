

        <div class="margem_cima_baixo">
         <div class="table-responsive">
            @if(count($clientes)>=1)   
              <h2>{{ $clientes->total() }} Clientes Cadastrados</h2> 
              {{ $clientes->links() }}
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
                      {!! Form::open(['method' =>'PATCH', 'url' =>'painel_de_controle/admin/'.$cliente->cliente_id.'/clientes_editar'])!!}
                      {!! Form::submit('Editar', ['class'=>'btn btn-primary floatright']) !!}
                      {!! Form::close() !!}
                    </td>
                    <td>
                      {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$cliente->cliente_id.'/cliente_confirmar_deletar'])!!}
                      {!! Form::submit('DELETAR', ['class'=>'btn btn-danger floatright']) !!}
                      {!! Form::close() !!}
                    </td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>
              @endif
            </div>
             {{ $clientes->links() }}
          <div>
