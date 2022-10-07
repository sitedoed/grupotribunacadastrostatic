          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">Ramais</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="http://atdigital.com.br/cadastro/painel_de_controle/admin/ramais">
                  <span class="float-left">Saiba Mais</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-info o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">Feedback</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="http://atdigital.com.br/cadastro/painel_de_controle/admin/feedback">
                  <span class="float-left">Saiba Mais</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">{{ $total_de_clientes_cadastrados->count() }} Clientes Cadastrados</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="http://atdigital.com.br/cadastro/painel_de_controle/admin/clientes">
                  <span class="float-left">Saiba Mais</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-secondary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">{{ $eventos }} Eventos</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="http://atdigital.com.br/cadastro/painel_de_controle/admin/eventos">
                  <span class="float-left">Saiba Mais</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <!-- Icon Cards-->


          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p>Bem-vindo(a):  {{ Auth::user()->name }} </p>
          </div>

            <div class="margem_cima_baixo">
              <table class="table table-striped table-sm">
                  <thead>
                    <tr>
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

