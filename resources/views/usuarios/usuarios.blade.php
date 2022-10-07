@include('painel_sidebar');


 <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Usuários</h1>
            {{ Auth::user()->name }} 
          </div>


          <div class="margem_cima_baixo">

          @if(Session::has('retorno'))
            <div class="alert alert-success">{{Session::get('retorno') }}
            </div>
          @endif


        @if(Request::is('*/painel_usuario_editar'))
          <h3>Editar Usuario</h3>
          @foreach($usuario as $row)
            {!! Form::model('$user',['method' => 'PATCH','url' => $row->id.'/painel_usuario_atualizar']) !!}
            <input type="text" class="form-control" name="name" value="{{ $row->name }}">
            <input type="email" class="form-control" name="email" value="{{ $row->email }}">
            <select name="nivel" class="form-control">
              <option value="1">Administrador</option>
              <option value="2">Usuário</option>
            </select>
            <select name="status" class="form-control">
              <option value="1">Ativo</option>
              <option value="2">Inativo</option>
              <option value="3">Suspenso</option>
            </select>

          @endforeach
            <select name="" class="form-control">
            @foreach($empresas as $empresa)

            <option value={{$empresa->id}}>{{$empresa->name}}</option>
            @endforeach
            </select>
          {!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}



          @elseif(Request::is('*/painel_usuarios_confirmar_deletar'))
          <h3>Deletar Usuário</h3>
          @foreach($departamento as $row)
            {!! Form::model('$departamento',['method' => 'POST','url' => $row->id.'/painel_departamentos_deletar']) !!}

          <input type="text" class="form-control" name="name" value="{{ $row->name }}">

           <input type="text" class="form-control" name="empresa" value="{{ $row->empresa }}">

          @endforeach
          {!! Form::submit('Deletar', ['class'=>'btn btn-primary btn-danger']) !!}
          {!! Form::close() !!}



          @else

          <h3>Cadastrar Usuario </h3>
          {!! Form::open(['url' => 'painel_usuario_criar']) !!}

          {!! Form::input('text', 'name', '', ['class' => 'form-control', 'placeholder' =>'Nome']) !!}
          {!! Form::input('email', 'email', '', ['class' => 'form-control', 'placeholder' =>'E-mail']) !!}
          {!! Form::input('text', 'password', '', ['class' => 'form-control', 'placeholder' =>'Senha']) !!}
           
           <select name="nivel" class="form-control">
                <option value="1">Administrador</option>
                <option value="2">Usuário</option>
            </select>
            <select name="status" class="form-control">
              <option value="1">Ativo</option>
              <option value="2">Inativo</option>
              <option value="3">Suspenso</option>
            </select>

          {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}

          @endif

          </div>

          <div class="margem_cima_baixo">
          @if(count($users)>=1)    
          <h3>Usuários Cadastrados 2 </h3>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th class="col-sm-1">Nome</th>
                   <th class="col-sm-2">E-mail</th>
                  <th class="col-sm-2">Nivel</th>
                  <th class="col-sm-2">Status</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nivel }}</td>
                    <td>{{ $user->status }}</td>
                    <th>
                    {!! Form::open(['method' =>'POST', 'url' =>$user->id.'/painel_usuario_editar'])!!}
                    {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                    </th>
                    <th>
                    {!! Form::open(['method' =>'POST', 'url' =>$user->id.'/painel_usuario_confirmar_deletar'])!!}
                    {!! Form::submit('Deletar', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </th>                   
                  </tr>
                  @endforeach
              </tbody>
            </table>
          @endif
          </div>
          </div>

        </main>
      </div>
    </div>


