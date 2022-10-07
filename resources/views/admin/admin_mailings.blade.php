          @if(Session::has('retorno'))
            <div class="alert alert-success">{{Session::get('retorno') }}
            </div>
          @endif




    <div class="margem_cima_baixo">
        <div class="container">
          <div class="row">
            <div class="col-sm">
            @if(count($mailings)>=1)   
            <h2>{{ $mailings->total() }} Mailings Cadastrados</h2> 
            {{ $mailings->links() }}

            </div>
             {!! Form::open(['method' => 'POST','url' => 'painel_de_controle/admin/mailing_pesquisar', 'class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0']) !!}
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Pesquisar E-mail" aria-label="Search" aria-describedby="basic-addon2" name="mailing_pesquisar">
              <div class="input-group-append">
                <input type="submit" class="btn btn-primary" value="Pesquisar">
              </div>
            </div>
          </div>
        </div>
           {!! Form::close() !!} 





			       <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                   @foreach($mailings as $mailing)
                   <tr>
                    <td>{{ $mailing->titulo }}</td>
                    <td>{{ $mailing->descricao }}</td>
                    <td><a href="\painel_de_controle/admin/{{ $mailing->id }}/mailing_listar">Listar</a></td>
                    <td>
                    </td>
                    <td>
                    </td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>         
            {{ $mailings->links() }}     
          @endif


      </div><!--Fim DIV Margem_cima_baixo-->