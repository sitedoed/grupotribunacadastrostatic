


        <div class="margem_cima_baixo">

          @if(Session::has('retorno'))
            <div class="alert alert-success">{{Session::get('retorno') }}
            </div>
          @endif

          @if(Session::has('danger'))
            <div class="alert alert-danger">{{Session::get('danger') }}
            </div>
          @endif
              
          @include('flash-message')

              @if(Request::is('painel_de_controle/admin/*/usuario_editar'))
                <h3>Editar Usuário</h3>
                @foreach($usuario as $row)
                  {!! Form::model('$user',['method' => 'PATCH','url' => 'painel_de_controle/admin/'.$row->id.'/usuario_atualizar']) !!}

                <div class="container">
                  <div class="row">
                    <div class="margin_top col-sm-4">
                      <input type="text" class="form-control" name="name" value="{{ $row->name }}">
                    </div>
                    <div class="margin_top col-sm-4">
                      <input type="email" class="form-control" name="email" value="{{ $row->email }}">
                    </div>
                    <div class="margin_top col-sm-4">
                      <input type="password" class="form-control" name="senha" value="{{ $row->password }}">
                    </div>
                    <div class="margin_top form-group col-md-4">
                       @endforeach
                      <select name="nivel" class="form-control">
                            <option value="1">Administrador</option>
                            <option value="2">Usuário</option>
                      </select>
                    </div>
                    <div class="margin_top col-sm-4">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="status" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">Ativo</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="status" value="0" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">Inativo</label>
                      </div>
                    </div>
                    <div class=" margin_top col-sm-4">
                       {!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
                      {!! Form::close() !!}
                    </div>
                  </div><!--FIm Div Row-->
                </div><!--FIm Div Container-->


          <div class="margem_cima_baixo">

                @elseif(Request::is('painel_de_controle/admin/*/usuario_confirmar_deletar'))
                <h3>Deletar Usuário</h3>
                @foreach($usuario as $row)
                  {!! Form::model('$user',['method' => 'DELETE','url' => 'painel_de_controle/admin/'.$row->id.'/usuario_deletar']) !!}

                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>E-mail</th>
                          <th>Nivel</th>
                          <th>Status</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>
                              @switch($row->nivel)
                                  @case(1)
                                      <span> Administrador</span>
                                      @break

                                  @case(2)
                                      <span>Usuário</span>
                                      @break

                                  @default
                                      <span>Cliente</span>
                              @endswitch
                            </td>
                            <td>
                                @if($row->email_verified_at)
                                    <span> Ativo</span>
                                @else
                                    <span class="vermelho">Inativo</span>
                                @endif
                            </td>
                            <td>
                            @endforeach
                            {!! Form::submit('Deletar', ['class'=>'btn btn-primary btn-danger']) !!}
                            {!! Form::close() !!} 
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>


                @else

                <h3>Cadastrar Usuário </h3>
                {!! Form::open(['url' => 'painel_de_controle/admin/usuario_criar']) !!}
                <div class="container">
                  <div class="row">
                    <div class="margin_top col-sm-4">
                      {!! Form::input('text', 'name', '', ['class' => 'form-control', 'placeholder' =>'Nome', 'required' => 'required']) !!}
                    </div>
                    <div class="margin_top col-sm-4">
                      {!! Form::input('email', 'email', '', ['class' => 'form-control', 'placeholder' =>'E-mail', 'required' => 'required']) !!}
                    </div>
                    <div class="margin_top col-sm-4">
                        {!! Form::input('password', 'password', '', ['class' => 'form-control', 'placeholder' =>'Senha', 'required' => 'required']) !!}
                    </div>
                    <div class="margin_top form-group col-md-4">
                      <select name="nivel" class="form-control">
                            <option value="1">Administrador</option>
                            <option value="2">Usuário</option>
                      </select>
                    </div>
                    <div class="margin_top col-sm-4">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="status" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">Ativo</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="status" value="0" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">Inativo</label>
                      </div>
                    </div>
                    <div class=" margin_top col-sm-4">
                      {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
                      {!! Form::close() !!}
                    </div>
                  </div><!--FIm Div Row-->
                </div><!--FIm Div Container-->

        @endif   

            </div><!--Fim Div margem_cima_baixo-->

                <div class="margem_cima_baixo">
                @if(count($users)>=1)    
                  <h3>Usuários Cadastrados</h3>
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>E-mail</th>
                          <th>Nivel</th>
                          <th>Status</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($users as $user)
                          <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                              @switch($user->nivel)
                                  @case(1)
                                      <span> Administrador</span>
                                      @break

                                  @case(2)
                                      <span>Usuário</span>
                                      @break

                                  @default
                                      <span>Cliente</span>
                              @endswitch
                            </td>
                            <td class="margin_right_5">
                                @if($user->email_verified_at)
                                    <span> Ativo</span>
                                @else
                                    <span class="vermelho">Inativo</span>
                                @endif
                            </td>
                            <td>
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$user->id.'/usuario_editar'])!!}
                            {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                            </td>
                            <td>
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$user->id.'/usuario_confirmar_deletar'])!!}
                            {!! Form::submit('Deletar', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            </td>                   
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  @endif
                  </div>
                </div>


