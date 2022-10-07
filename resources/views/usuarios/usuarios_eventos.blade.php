
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Usuários</h1>
            {{ Auth::user()->name }} 
          </div>

          <div class="margem_cima_baixo">





            
          @if(Request::is('painel_de_controle/usuarios/*/eventos_editar'))

              <h2>Editar Evento2</h2>
              @if(Session::has('retorno'))
                <div class="alert alert-success">{{Session::get('retorno') }}
                </div>
              @endif

              @foreach($evento as $row)
              {!! Form::model($confirmar, ['method' => 'PATCH', 'url' => 'painel_de_controle/usuarios/'.$row->id.'/eventos_atualizar']) !!}
              <input type="text" class="form-control" name="nome" value="{{ $row->nome }}">
              <textarea name='descricao' rows="6" class="form-control">{{ $row->descricao }}</textarea>

              <input class="form-control" name="data" type="date" value="{{ $row->data }}">

              @endforeach

                <select name="departamento_id" class="form-control">
                    @foreach($departamentos as $departamento)
                    <option value={{$departamento->id}}>{{$departamento->name}}</option>
                    @endforeach
                </select>
              </div>
              {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}


          @elseif(Request::is('painel_de_controle/usuarios/*/eventos_confirmar_deletar'))

              <h2>Deletar Evento</h2>
              @if(Session::has('retorno'))
                <div class="alert alert-success">{{Session::get('retorno') }}
                </div>
              @endif

              @foreach($evento as $row)
              {!! Form::model($confirmar, ['method' => 'DELETE', 'url' => 'painel_de_controle/usuarios/'.$row->id.'/eventos_deletar']) !!}
              
              <input type="text" class="form-control" name="nome" value="{{ $row->nome }}">
              <textarea name='descricao' rows="6" class="form-control">{{ $row->descricao }}
              </textarea>
              <input type="text" class="form-control" name="departamentos_id" value="{{ $row->departamento }}">
              @endforeach
                </select>
              </div>
              {!! Form::submit('Deletar', ['class'=>'btn btn-primary btn-danger']) !!}
              {!! Form::close() !!}


            @else

              <h2>Cadastrar Evento</h2>
              @if(Session::has('retorno'))
                <div class="alert alert-success">{{Session::get('retorno') }}
                </div>
              @endif

                {!! Form::open(['url' => 'painel_de_controle/usuarios/eventos_criar']) !!}
                {!! Form::input('text', 'nome', '', ['class' => 'form-control', 'placeholder' =>'Nome do Evento']) !!}
                {!! Form::textarea('descricao','', ['class' => 'form-control', 'placeholder' =>'Descrição do Evento']) !!}
                {!! Form::input('date', 'data', '', ['class' => 'form-control', 'placeholder' =>'Data do Evento']) !!}

                <select name="departamentos_id" class="form-control">
                    @foreach($departamentos as $departamento)
                    <option value={{$departamento->id}}>{{$departamento->name}}</option>
                    @endforeach
                </select>
              </div>

              {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
              {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
            @endif


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
                            <td class="col"><a href=http://atdigital.com.br/cadastro/painel_de_controle/usuarios/{{ $evento->id }}/evento_estatisticas>Estatísticas</a>
                            </td>
                            <td ></td>
                            <td class="col">
                              {!! Form::open(['method' =>'PATCH', 'url' =>'painel_de_controle/usuarios/'.$evento->id.'/eventos_editar'])!!}
                              {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                              {!! Form::close() !!}
                            </td>
                            <td>
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/'.$evento->id.'/eventos_confirmar_deletar'])!!}
                              {!! Form::submit('DELETAR', ['class'=>'btn btn-danger ']) !!}
                              {!! Form::close() !!}
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                    {{ $eventos->links() }}
                    @endif 
                </div>
            </div>
  