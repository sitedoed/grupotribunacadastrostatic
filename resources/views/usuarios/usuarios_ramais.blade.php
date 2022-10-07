
    <div class="margem_cima_baixo">
      <h3>Pesquisa de Ramais</h3>


        




    @if(isset($resultado))
        <div class="margem_cima_baixo">
          @if(count($resultado)>1)
            <h4>{{ $resultado->count() }} Ramais Encontrados  </h4>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Ramal</th>
                  <th>Setor</th>
                  <th>Responsável</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($resultado as $resultado)
                 <tr>
                  <td>{{ $resultado->ramal }}</td>
                  <td>{{ $resultado->setor }}</td>
                  <td>{{ $resultado->responsavel }}</td>
                  <td>@if($resultado->status == 1)
                        Ativo
                      @else
                        Inativo
                      @endif</td>
                  <td>
                  </td>
                </tr>  
                @endforeach
              </tbody>
            </table>

          @elseif(count($resultado)==1)
            <h4>{{ $resultado->count() }} Ramal Encontrado  </h4>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Ramal</th>
                  <th>Setor</th>
                  <th>Responsável</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($resultado as $resultado)
                 <tr>
                  <td>{{ $resultado->ramal }}</td>
                  <td>{{ $resultado->setor }}</td>
                  <td>{{ $resultado->responsavel }}</td>
                  <td>@if($resultado->status == 1)
                        Ativo
                      @else
                        Inativo
                      @endif</td>
                  <td>
                  </td>
                </tr>  
                @endforeach
              </tbody>
            </table>

          @else
            <h4>Nenhum Ramal Encontrado  </h4>
          @endif



         </div>
    @endif


      <div class="margem_cima_baixo">
        <div class="container">
          <div class="row">
              <div class="col-sm">
                {{ $ramais->links() }}   
              </div>

               {!! Form::open(['method' => 'POST','url' => 'painel_de_controle/usuarios/usuarios_pesquisar_ramal', 'class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0']) !!}
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Pesquisar Ramal" aria-label="Search" aria-describedby="basic-addon2" name="pesquisar_ramal">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            {!! Form::close() !!} 
          </div>

              <h4>Lista de Ramais Cadastrados</h4>

                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Ramal</th>
                        <th>Setor</th>
                        <th>Responsável</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ramais as $ramal)
                       <tr>
                        <td>{{ $ramal->ramal }}</td>
                        <td>{{ $ramal->setor }}</td>
                        <td>{{ $ramal->responsavel }}</td>
                        <td>@if($ramal->status == 1)
                              Ativo
                            @else
                              Inativo
                            @endif</td>
                        <td>
                        </td>
                      </tr>  
                      @endforeach
                    </tbody>
                  </table>
            {{ $ramais->links() }}      

          </div>
        </div><!--Fim DIV margem_cima_baixo-->




