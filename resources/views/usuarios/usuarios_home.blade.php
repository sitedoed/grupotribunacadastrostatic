      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Usuários</h1>
            <p>Bem-vindo(a):  {{ Auth::user()->name}}</p>
          </div>


          <div class="margem_cima_baixo">
          	<table class="table table-striped table-sm">
                <thead>
                  <tr><h3>Página Inicial GRUPO-TRIBUNA</h3> 
                    <th>Empresas</th>
                    <th>Departamentos</th>
                    <th>Quantidade de eventos</th>
                    <th>Número de Inscritos</th>
                  </tr>
                </thead>
                  <tbody>
                  @foreach($tabela_inicial as $row)
                     <tr>
                      <td class="col3"><span class="capitalize">{{ $row['empresa'] }}</span></td>
                      <td class="col3">{{ $row['departamento'] }}</td>
                      <td class="col3">{{ $row['quantidade_de_eventos'] }}</td>
                      <td class="col3">{{ $row['numero_de_inscritos'] }}</td>
                    </tr>
                  @endforeach
                  </tbody>
              </table>



          </div>
