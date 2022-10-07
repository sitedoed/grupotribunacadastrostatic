

          <div class="margem_cima_baixo">

            <h3>Configurações</h3>
            @if(Session::has('retorno'))
              <div class="alert alert-success">{{Session::get('retorno') }}
              </div>
            @endif


           @if(Request::is('painel_de_controle/admin/*/config_edit'))

             {!! Form::model('$user',['method' => 'PATCH', 'url' => '\painel_de_controle/admin/'.$user['id'].'/config_atualizar']) !!}
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
                    <td><a href="\cadastro/painel_de_controle/admin/{{Auth::user()->id}}/senha_alterar" class ="btn btn-primary">Alterar Senha</a>
                      <a href="\cadastro/painel_de_controle/admin/{{Auth::user()->id}}/config_edit" class ="btn btn-primary">Editar</a></td>
                  </tr>  
                </tbody>
              </table>
            </div>
          </div> 





 