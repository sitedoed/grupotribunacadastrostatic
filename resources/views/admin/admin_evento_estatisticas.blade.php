

          <div class="margem_cima_baixo">
            <div class="container">
              <div class="row">
                @foreach($evento as $campo)
                  <div class="col-sm-4">
                    <h3>Estatísticas do Evento: </h3>
                  </div>
                  <div class="col-sm-8">
                   <h4> {{ $campo-> nome }} </h4>
                  </div>
                  <div class="col-sm-4">
                    <h5>Descrição: </h5>
                  </div>
                  <div class="col-sm-8">
                    {{ $campo->descricao }}
                  </div>
                  <div class="col-sm-4">
                    <h5>Empresa: </h5>
                  </div>
                  <div class="col-sm-8">
                    {{ $campo->empresa }}
                  </div>
                  <div class="col-sm-4">
                    <h5>Departamento: </h5>
                  </div>
                  <div class="col-sm-8">
                    {{ $campo->departamento }}
                  </div>
                  <div class="col-sm-4">
                    <h5>Número de Inscritos: </h5>
                  </div>
                  <div class="col-sm-8">
                    {{ $inscritos }}
                  </div>
                  <div class="col-sm-4">
                    <h5>Data: </h5>
                  </div>
                  <div class="col-sm-8">
                    {{ date( 'd/m/Y' , strtotime($campo->data)) }}
                  </div>

                @endforeach
                  <div class="col-sm-4">
                    <h5>Lista de Inscritos: </h5>
                  </div>
                  <div class="col-sm-8"> 
                    <a href=/painel_de_controle/admin/{{ $campo->id }}/evento_clientes>Acessar-></a>
                  </div>
                </div>
              </div>
          </div>            

          <div class="margem_cima_baixo">
              
            @if($campos_adicionais->count()<1)
              <h3>Modelo do formulário para o cadastro (Padrão)</h3>
            @else
              <h3>Modelo do formulário para o cadastro (Com campos adicionais)</h3>
            @endif

              <input type="text" name="name" class="modelo form-control" placeholder="Nome">
              <input type="email1" name="email1" class="modelo form-control" placeholder="E-mail1">
              <input type="email2" name="email2" class="modelo form-control"  placeholder="E-mail2">
              <input type="tel1" name="tel1" class="modelo form-control"  placeholder="Tel1">
              <input type="tel2" name="tel2" class="modelo form-control"  placeholder="Tel2">
              <input type="text" name="endereco" class="modelo form-control"  placeholder="Endereço">
              <input type="text" name="bairro" class="modelo form-control"  placeholder="Bairro">
              <input type="text" name="cidade" class="modelo form-control" placeholder="Cidade">
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
              <input type="text" name="cep" class="form-control modelo"  placeholder="CEP">
              <input type="text" name="rg" class="form-control modelo" placeholder="RG">
              <input type="text" name="cpf" class="form-control modelo"  placeholder="CPF">
              <select name="sexo" class="form-control modelo">
                  <option value="0" disabled selected >Sexo</option>
                  <option value="0">Feminino</option>
                  <option value="1">Masculino</option>
              </select>          
              <input type="text" name="empresa" class="form-control modelo" placeholder="Empresa">
       </div>


       <div class="margem_cima_baixo">
          @if($campos_adicionais->count()>=1)
            <p><h5>Campos Adicionais: </h5></p>
            @foreach($campos_adicionais as $campo_adicional)                    
             <input type="text" name="cep" class="form-control modelo"  placeholder="{{ $campo_adicional->name}}">
             @endforeach
          @else
               <h5><strong>Sem Campos Adicionais</strong></h5>
          @endif
            <input type="submit" name="Cadastrar" class="btn btn-primary" value="Cadastrar">
      </div>           


            <div class="margem_cima_baixo">
                <div class="table-responsive">
                    @if(count($eventos)>=1)
                    {{ $eventos->links() }}      
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr> <h3>Lista de Eventos Cadastrados</h3>
                          <th>ID</th>
                          <th>Evento</th>
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
                            <td>{{$evento->id}}</td>
                            <td>{{$evento->nome}}</td>
                            <td>{{$evento->empresa}}</td>
                            <td>{{$evento->departamento}}</td>
                            <td><a href=\painel_de_controle/admin/{{ $evento->id }}/evento_estatisticas>Estatísticas</a>
                            </td>
                            <td></td>
                            <td>
                              {!! Form::open(['method' =>'PATCH', 'url' =>'painel_de_controle/admin/'.$evento->id.'/eventos_editar'])!!}
                              {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                              {!! Form::close() !!}
                            </td>
                            <td>
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$evento->id.'/eventos_confirmar_deletar'])!!}
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
