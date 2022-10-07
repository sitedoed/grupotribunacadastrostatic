
      <div class="margem_cima_baixo">
        @if(Request::is('painel_de_controle/admin/*/clientes_editar'))
            <h3>Editar Cliente</h3>
            @if(Session::has('retorno'))
              <div class="alert alert-success">{{Session::get('retorno') }}
              </div>
            @endif
          @foreach($cliente as $row)
            {!! Form::model('$cliente',['method' => 'PATCH','url' => 'painel_de_controle/admin/'.$row->cliente_id.'/cliente_salvar']) !!}


                <input type="text" name="name" class="modelo form-control" value="{{ $row->name}}" placeholder="Nome">
                <input type="email1" name="email1" class="modelo form-control" value="{{ $row->email1}}" placeholder="E-mail1">
                <input type="email2" name="email2" class="modelo form-control" value="{{ $row->email2}}" placeholder="E-mail2">
                <input type="tel1" name="tel1" class="modelo form-control" value="{{ $row->tel1}}" placeholder="Tel1">
                <input type="tel2" name="tel2" class="modelo form-control" value="{{ $row->tel2}}" placeholder="Tel2">
                <input type="data" name="data_de_nascimento" class="modelo form-control" value="{{ $row->data_de_nascimento}}" placeholder="Tel2">
                <input type="text" name="endereco" class="modelo form-control" value="{{ $row->endereco}}" placeholder="Endereço">
                <input type="text" name="bairro" class="modelo form-control" value="{{ $row->bairro}}" placeholder="Bairro">
                <input type="text" name="cidade" class="modelo form-control" value="{{ $row->cidade}}" placeholder="Cidade">
                <select name="estado" class="modelo form-control">
                    <option value="">Selecine o Estado</option>
                      <option value="AC">Acre</option>
                      <option value="AL">Alagoas</option>
                      <option value="AP">Amapá</option>
                      <option value="AM">Amazonas</option>
                      <option value="BA">Bahia</option>
                      <option value="CE">Ceará</option>
                      <option value="DF">Distrito Federal</option>
                      <option value="ES">Espírito Santo</option>
                      <option value="GO">Goiás</option>
                      <option value="MA">Maranhão</option>
                      <option value="MT">Mato Grosso</option>
                      <option value="MS">Mato Grosso do Sul</option>
                      <option value="MG">Minas Gerais</option>
                      <option value="PA">Pará</option>
                      <option value="PB">Paraíba</option>
                      <option value="PR">Paraná</option>
                      <option value="PE">Pernambuco</option>
                      <option value="PI">Piauí</option>
                      <option value="RJ">Rio de Janeiro</option>
                      <option value="RN">Rio Grande do Norte</option>
                      <option value="RS">Rio Grande do Sul</option>
                      <option value="RO">Rondônia</option>
                      <option value="RR">Roraima</option>
                      <option value="SC">Santa Catarina</option>
                      <option value="SP">São Paulo</option>
                      <option value="SE">Sergipe</option>
                      <option value="TO">Tocantins</option>
                </select>
                <input type="text" name="cep" class="modelo form-control" value="{{ $row->cep}}" placeholder="CEP">
                <input type="text" name="rg" class="modelo form-control" value="{{ $row->rg}}" placeholder="RG">
                <input type="text" name="cpf" class="modelo form-control" value="{{ $row->cpf}}" placeholder="CPF">
                <select name="sexo" class="modelo form-control">
                    <option value="0" disabled selected >{{ $row->sexo}}</option>
                    <option value="0">Feminino</option>
                    <option value="1">Masculino</option>
                </select>          
                <select name="eventos_id" class="form-control">
                    <option value={{ $row->evento_id }}>{{ $row->evento }}</option>
          @endforeach <!--$cliente as $row-->
                </select>


              {!! Form::submit('Atualizar Dados Gerais', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
        </div>   


          @if($extra_campos->count()>=1)
              <h5>Campos Adicionais: </h5>

              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($extra_conteudos as $conteudo)


                    {!! Form::open(array('method'=>'put','url' =>'painel_de_controle/admin/'.$conteudo->extra_conteudos_id.'/cliente_salvar_dado_especifico'  )) !!}
                   <tr>    
                    <td class=""><span class="capitalize"><h5>{{ $conteudo->campo }}:</h5></span></td>
                    <td class="col-3"> 
                      <input type="hidden"  name="extra_conteudos_id][]"
                      value="" class="form-control">
                       <input type="text"  name="conteudo"
                      value="{{ $conteudo->conteudo }}" class="form-control">
                    </td>
                    <td class="col-3">
                      {!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
                    </td>
                   
                  </tr>
                   {!! Form::close() !!}
                   @endforeach  
                </tbody>
              </table>


            @else
                <h5><strong>Sem Campos Adicionais</strong></h5>
            @endif


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
                        <td id="{{$cliente->cliente_id}}"> {{$cliente->cliente_id}} </td>
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
                   {{ $clientes->links() }} 
                  @endif
                </div>
             </div><!-- Margem_cima_baixo-->   




          @elseif(Request::is('painel_de_controle/admin/*/cliente_confirmar_deletar'))
              <h3>Deletar Cliente</h3>
                  @if(Session::has('danger'))
                    <div class="alert alert-danger">{{Session::get('danger') }}
                    </div>
                  @endif
                  @foreach($cliente as $row)
                    {!! Form::model('$cliente',['method' => 'DELETE','url' => 'painel_de_controle/admin/'.$row->id.'/cliente_deletar']) !!}
                        <input type="text" name="name" class="form-control modelo" value="{{ $row->name}}" placeholder="Nome">
                        <input type="email1" name="email1" class="form-control modelo" value="{{ $row->email1}}" placeholder="E-mail1">
                        <input type="email2" name="email2" class="form-control modelo" value="{{ $row->email2}}" placeholder="E-mail2">
                        <input type="tel1" name="tel1" class="form-control modelo" value="{{ $row->tel1}}" placeholder="Tel1">
                        <input type="tel2" name="tel2" class="form-control modelo" value="{{ $row->tel2}}" placeholder="Tel2">
                        <input type="text" name="endereco" class="form-control" value="{{ $row->endereco}}" placeholder="Endereço">
                        <input type="text" name="bairro" class="form-control modelo" value="{{ $row->bairro}}" placeholder="Bairro">
                        <input type="text" name="cidade" class="form-control modelo" value="{{ $row->cidade}}" placeholder="Cidade">
                        <select name="estado" class="form-control modelo">
                            <option value="">Selecine o Estado</option>
                              <option value="AC">Acre</option>
                              <option value="AL">Alagoas</option>
                              <option value="AP">Amapá</option>
                              <option value="AM">Amazonas</option>
                              <option value="BA">Bahia</option>
                              <option value="CE">Ceará</option>
                              <option value="DF">Distrito Federal</option>
                              <option value="ES">Espírito Santo</option>
                              <option value="GO">Goiás</option>
                              <option value="MA">Maranhão</option>
                              <option value="MT">Mato Grosso</option>
                              <option value="MS">Mato Grosso do Sul</option>
                              <option value="MG">Minas Gerais</option>
                              <option value="PA">Pará</option>
                              <option value="PB">Paraíba</option>
                              <option value="PR">Paraná</option>
                              <option value="PE">Pernambuco</option>
                              <option value="PI">Piauí</option>
                              <option value="RJ">Rio de Janeiro</option>
                              <option value="RN">Rio Grande do Norte</option>
                              <option value="RS">Rio Grande do Sul</option>
                              <option value="RO">Rondônia</option>
                              <option value="RR">Roraima</option>
                              <option value="SC">Santa Catarina</option>
                              <option value="SP">São Paulo</option>
                              <option value="SE">Sergipe</option>
                              <option value="TO">Tocantins</option>
                        </select>
                        <input type="text" name="cep" class="form-control modelo" value="{{ $row->cep}}" placeholder="CEP">
                        <input type="text" name="rg" class="form-control modelo" value="{{ $row->rg}}" placeholder="RG">
                        <input type="text" name="cpf" class="form-control modelo" value="{{ $row->cpf}}" placeholder="CPF">
                        <select name="sexo" class="form-control modelo">
                            <option value="0" disabled selected >Sexo</option>
                            <option value="0">Feminino</option>
                            <option value="1">Masculino</option>
                        </select>          
                        <select name="eventos_id" class="form-control">
                            <option value="0" disabled selected >Selecione o Evento</option>
                            @foreach($eventos as $evento)
                            <option value={{$evento->evento_id}}>{{$evento->nome}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="eventos_departamentos_id" value="{{$evento->eventos_departamento_id}}">
                        <input type="hidden" name="eventos_departamentos_empresas_id" value="{{$evento->eventos_departamentos_empresas_id}}">
                        {!! Form::submit('CONFIRMAR', ['class'=>'btn btn-primary btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>           
                  @endforeach



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
                   </div><!-- Margem_cima_baixo-->

        @else

              <h2>Cadastrar Cliente</h2>
              @if(Session::has('retorno'))
                <div class="alert alert-success">{{Session::get('retorno') }}
                </div>
              @endif

                {!! Form::open(['url' => 'painel_de_controle/admin/clientes_cadastrar']) !!}
                {!! Form::input('text', 'name', '', ['class' => 'form-control', 'placeholder' =>'Nome do Cliente']) !!}
                {!! Form::input('email', 'email1', '', ['class' => 'form-control modelo', 'placeholder' =>'E-mail 1']) !!}
                {!! Form::input('email', 'email2', '', ['class' => 'form-control modelo', 'placeholder' =>'E-mail 3']) !!}           
                {!! Form::input('tel', 'tel1', '', ['class' => 'form-control modelo', 'placeholder' =>'Telefone 1']) !!}                
                {!! Form::input('tel', 'tel2', '', ['class' => 'form-control modelo', 'placeholder' =>'Telefone 2']) !!}
                {!! Form::input('text', 'data_de_nascimento', '', ['class' => 'form-control modelo', 'placeholder' =>'Data de Nascimento']) !!}
                {!! Form::input('text', 'endereco', '', ['class' => 'form-control modelo', 'placeholder' =>'Endereço']) !!}
                {!! Form::input('text', 'bairro', '', ['class' => 'form-control modelo', 'placeholder' =>'Bairro']) !!}
                {!! Form::input('text', 'cidade', '', ['class' => 'form-control modelo', 'placeholder' =>'Cidade']) !!}
                <select name="cidade" class="form-control modelo">
                    <option value="">Selecine o Estado</option>
                      <option value="AC">Acre</option>
                      <option value="AL">Alagoas</option>
                      <option value="AP">Amapá</option>
                      <option value="AM">Amazonas</option>
                      <option value="BA">Bahia</option>
                      <option value="CE">Ceará</option>
                      <option value="DF">Distrito Federal</option>
                      <option value="ES">Espírito Santo</option>
                      <option value="GO">Goiás</option>
                      <option value="MA">Maranhão</option>
                      <option value="MT">Mato Grosso</option>
                      <option value="MS">Mato Grosso do Sul</option>
                      <option value="MG">Minas Gerais</option>
                      <option value="PA">Pará</option>
                      <option value="PB">Paraíba</option>
                      <option value="PR">Paraná</option>
                      <option value="PE">Pernambuco</option>
                      <option value="PI">Piauí</option>
                      <option value="RJ">Rio de Janeiro</option>
                      <option value="RN">Rio Grande do Norte</option>
                      <option value="RS">Rio Grande do Sul</option>
                      <option value="RO">Rondônia</option>
                      <option value="RR">Roraima</option>
                      <option value="SC">Santa Catarina</option>
                      <option value="SP">São Paulo</option>
                      <option value="SE">Sergipe</option>
                      <option value="TO">Tocantins</option>
                </select>
                {!! Form::input('text', 'cep', '', ['class' => 'form-control modelo', 'placeholder' =>'CEP']) !!}
                {!! Form::input('text', 'rg', '', ['class' => 'form-control modelo', 'placeholder' =>'RG']) !!}
                {!! Form::input('text', 'cpf', '', ['class' => 'form-control modelo', 'placeholder' =>'CPF']) !!}
                <select name="sexo" class="form-control modelo">
                    <option value="0" disabled selected >Sexo</option>
                    <option value="0">Feminino</option>
                    <option value="1">Masculino</option>
                </select>
                  

               <select name="eventos_id" class="form-control modelo">
                    <option value="0" disabled selected >Selecione o Evento</option>
                    @foreach($eventos as $evento)
                    <option value={{$evento->evento_id}}>{{$evento->nome}}</option>

                    @endforeach
                </select>


                    @foreach($eventos as $evento)
                      <input type="hidden" name="eventos_departamentos_id" value="{{$evento->eventos_departamento_id}}">
                      <input type="hidden" name="eventos_departamentos_empresas_id" value="{{$evento->eventos_departamentos_empresas_id}}">
                    @endforeach


                {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
                {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>

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

         </div><!-- Margem_cima_baixo-->            

      @endif
