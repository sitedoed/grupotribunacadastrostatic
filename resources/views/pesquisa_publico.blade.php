 						<div class="container">
						    <div class="row">
						      <div class="col"></div>
						      <div class="col-sm-10">
						            @if(isset ($resultado))
						              @if(count($resultado)>=1)  
						                <h4>Lista de Ramais Encontrados</h4>
						                    {{ $resultado->links() }}    
						                    <table class="table table-striped table-sm">
						                      <thead>
						                        <tr>
						                          <th>Ramal</th>
						                          <th>Setor</th>
						                          <th>Responsável</th>
						                        </tr>
						                      </thead>
						                      <tbody>
						                        @foreach ($resultado as $resultado)
						                         <tr>
						                          <td>{{ $resultado->ramal }}</td>
						                          <td>{{ $resultado->setor }}</td>
						                          <td>{{ $resultado->responsavel }}</td>
						                          <td>
						                          </td>
						                        </tr>  
						                        @endforeach
						                      </tbody>
						                    </table>
						                    @else
						                    <div class="margem_cima_baixo">
						                      <p>
						                        Nenhum Ramal Encontrado com os critérios inseridos. Por favor, pesquise novamente com outros termos.
						                      </p>
						                  </div>
						              @endif
						            @endif
						      </div>
						      <div class="col"></div>
						    </div>
						 </div>