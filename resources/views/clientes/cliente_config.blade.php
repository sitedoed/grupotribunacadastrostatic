         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Clientes</h1>
          </div>
          <div class="margem_cima_baixo">

            <h3>Configurações</h3>
            @if(Session::has('retorno'))
              <div class="alert alert-success">{{Session::get('retorno') }}
              </div>
            @endif


           @if(Request::is('http://atdigital.com.br/cadastro/painel_de_controle/clientes/*/config_edit'))

             {!! Form::model('$user',['method' => 'PATCH', 'url' => 'painel_de_controle/clientes/'.$user['id'].'/config_atualizar']) !!}
            <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control">
             <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control">
            
            {!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}

              @endif

          </div> 

        <div class="margem_cima_baixo">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{Auth::user()->name}}</td>
                  <td>{{Auth::user()->email}}</td>
                  <td><a href="http://atdigital.com.br/cadastro/painel_de_controle/clientes/{{Auth::user()->id}}/senha_alterar" class ="btn btn-primary">Alterar Senha</a>
                    <a href="http://atdigital.com.br/cadastro/painel_de_controle/clientes/{{Auth::user()->id}}/config_edit" class ="btn btn-primary">Editar</a></td>
                </tr>  
              </tbody>
            </table>
          </div>
        </div> 

