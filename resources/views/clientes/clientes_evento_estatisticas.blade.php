        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Clientes</h1>
            {{ Auth::user()->name }} 
          </div>

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
                 @endforeach

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
                </div>
              </div>
          </div>                   
