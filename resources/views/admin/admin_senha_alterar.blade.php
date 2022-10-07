
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Administradores</h1>
             <p>{{ Auth::user()->name }} </p>
          </div>

          <h2>Alterar Senha</h2>
          @if(Session::has('retorno'))
          <div class="alert alert-success">{{Session::get('retorno') }}
          </div>
          @endif

          <div class="table-responsive">
     
     
            {!! Form::model('$user',['method' => 'PATCH', 'url' => 'painel_de_controle/admin/'.$user['id'].'/senha_atualizar']) !!}
              <div class="container">
                <div class="row">
                  <div class="margin_top col-sm-4">
                    <input type="password" name="password" class="form-control" placeholder="Por favor, digite a nova senha" >
                  </div>
                  <div class="margin_top col-sm-4">
                     <input type="password" name="password_new" class="form-control" placeholder='Por favor, redigite senha'  >
                  </div>
                  <div class="margin_top col-sm-4">
                  {!! Form::submit('Alterar', ['class'=>'btn btn-primary']) !!}
                  {!! Form::close() !!}  
                  </div>
                </div>
              </div>        



          </div>   





