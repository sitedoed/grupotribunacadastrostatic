  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Usuários</h1>
            <p>Bem-vindo(a):  {{ Auth::user()->name }} </p>
          </div>

          @if(Session::has('retorno'))
            <div class="alert alert-success">{{Session::get('retorno') }}
            </div>
          @endif

		@if(Request::is('painel_de_controle/usuarios/*/campos_adicionais_editar'))

		       <div class="margem_cima_baixo">
          		<h3>Editar campo adicional</h3>

          		<div class="table-responsive">
	            	<table class="table table-striped table-sm">
		                <thead>
		                  <tr>
		                  	<th>ID</th>
		                    <th>Evento</th>
		                    <th>Departamento</th>
		                    <th>Empresa</th>
		                    <th>Campo a ser inserido</th>
		                    <th></th>
		                  </tr>
		                </thead>
		                <tbody>
		                  @foreach ($campo as $row)
		                   <tr>
		                   	{!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/campos_adicionais_cadastrar'])!!}
		                    <td id="{{$row->nome}}">{{$row->evento_id}} </td>
		                    <td>{{ $row->nome }}</td>
		                    <td>{{ $row->departamento }}</td>
		                    <td>{{ $row->empresa }}</td>
		                    <td>
		                    <input type="text" name="name" class="form-control"
		                    value="{{ $row->campo }}">
			          		<input type="hidden" name="eventos_id" value="{{ $row->evento_id }}">
							<input type="hidden" name="eventos_departamentos_id" value="{{ $row->eventos_departamento_id }}">
							<input type="hidden" name="eventos_departamentos_empresas_id" value="{{ $row->eventos_departamentos_empresas_id }}">
							</td>
							<td>
			          		{!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
		                    </td>
		                    {!! form::close() !!}
		                  </tr> 

		                  @endforeach
		                </tbody>
	              	</table>
	            </div>
	         </div><!-- Margem_cima_baixo-->   


		@elseif(Request::is('painel_de_controle/usuarios/*/campos_adicionais_confirmar_deletar'))

		       <div class="margem_cima_baixo">
          		<h3>Editar campo adicional</h3>

          		<div class="table-responsive">
	            	<table class="table table-striped table-sm">
		                <thead>
		                  <tr>
		                  	<th>ID</th>
		                    <th>Evento</th>
		                    <th>Departamento</th>
		                    <th>Empresa</th>
		                    <th>Campo a ser deletado</th>
		                    <th></th>
		                  </tr>
		                </thead>
		                <tbody>
		                  @foreach ($campo as $row)
		                   <tr>
		                   	{!! Form::open(['method' =>'DELETE', 'url' =>'painel_de_controle/usuarios/'.$row->extra_id.'/campos_adicionais_deletar'])!!}
		                    <td id="{{$row->nome}}">{{$row->evento_id}} </td>
		                    <td>{{ $row->nome }}</td>
		                    <td>{{ $row->departamento }}</td>
		                    <td>{{ $row->empresa }}</td>
		                    <td>{{ $row->campo }}
			          		<input type="hidden" name="eventos_id" value="{{ $row->evento_id }}">
							<input type="hidden" name="eventos_departamentos_id" value="{{ $row->eventos_departamento_id }}">
							<input type="hidden" name="eventos_departamentos_empresas_id" value="{{ $row->eventos_departamentos_empresas_id }}">
							</td>
							<td>
			          		{!! Form::submit('Deletar', ['class'=>'btn btn-primary']) !!}
		                    </td>
		                    {!! form::close() !!}
		                  </tr> 

		                  @endforeach
		                </tbody>
	              	</table>
	            </div>
	         </div><!-- Margem_cima_baixo-->   	         


		@else

          <div class="margem_cima_baixo">
          		<h3>Criar campos adicionais para o cadastro no evento</h3>

          		<div class="table-responsive">
          			{{ $eventos->links() }}
	            	<table class="table table-striped table-sm">
		                <thead>
		                  <tr>
		                  	<th>ID</th>
		                    <th>Evento</th>
		                    <th>Departamento</th>
		                    <th>Empresa</th>
		                    <th>Campo a ser inserido</th>
		                    <th></th>
		                  </tr>
		                </thead>
		                <tbody>
		                  @foreach ($eventos as $row)
		                   <tr>
		                   	{!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/campos_adicionais_cadastrar'])!!}
		                    <td id="{{$row->nome}}">{{$row->evento_id}} </td>
		                    <td>{{ $row->nome }}</td>
		                    <td>{{ $row->departamento }}</td>
		                    <td>{{ $row->empresa }}</td>
		                    <td>
		                    <input type="text" name="name" class="form-control">
			          		<input type="hidden" name="eventos_id" value="{{ $row->evento_id }}">
							<input type="hidden" name="eventos_departamentos_id" value="{{ $row->eventos_departamento_id }}">
							<input type="hidden" name="eventos_departamentos_empresas_id" value="{{ $row->eventos_departamentos_empresas_id }}">
							</td>
							<td>
			          		{!! Form::submit('Criar', ['class'=>'btn btn-primary']) !!}
		                    </td>
		                    {!! form::close() !!}
		                  </tr> 

		                  @endforeach
		                </tbody>
	              	</table>
	              	{{ $eventos->links() }}
	            </div>
	         </div><!-- Margem_cima_baixo-->


		@endif     


          <div class="margem_cima_baixo">
          	<h4>Eventos com campos adicionais</h4>

          		<div class="table-responsive">
          			{{ $campos_adicionais->links() }}
	            	<table class="table table-striped table-sm">
		                <thead>
		                  <tr>		                  	
		                  	<th>evento_ID</th>
		                    <th>Evento</th>
		                    <th>Empresa</th>
		                    <th>Departamento</th>		           
		                    <th>Campo</th>
		                    <th></th>
		                    <th></th>
		                  </tr>
		                </thead>
		                <tbody>
		                  @foreach ($campos_adicionais as $campo)
		                   <tr>
		                   	<input type="hidden" name="eventos_id" value="{{ $campo->evento_id }}">
		                   	<input type="hidden" name="name" value="{{ $campo->nome }}">
							<input type="hidden" name="eventos_departamentos_id" value="{{ $campo->eventos_departamento_id }}">
							<input type="hidden" name="eventos_departamentos_empresas_id" value="{{ $campo->eventos_departamentos_empresas_id }}">
							
		                    <td>{{$campo->evento_id}} </td>
		                    <td>{{ $campo->nome }}</td>
		                    <td>{{ $campo->empresa }}</td>
		                    <td>{{ $campo->departamento }}</td>	                    
		                    <td>{{ $campo->campo }}</td>
                            <td>
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/'.$campo->extra_id.'/campos_adicionais_editar'])!!}
                              {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                              {!! Form::close() !!}
                            </td>
                            <td>
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/'.$campo->extra_id.'/campos_adicionais_confirmar_deletar'])!!}
                              {!! Form::submit('DELETAR', ['class'=>'btn btn-danger ']) !!}
                              {!! Form::close() !!}
                            </td>

		                  </tr> 

		                  @endforeach
		                </tbody>
	              	</table>
	              	{{ $campos_adicionais->links() }}
	            </div>

          </div>
