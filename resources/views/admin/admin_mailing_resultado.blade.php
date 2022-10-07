   
    <div class="margem_cima_baixo">
        <div class="container">
          <div class="row">
            <div class="col-sm">
         @if($resultado)


          {{ $resultado->appends(['termo' => $termo])->links() }}

            </div>


             {!! Form::open(['method' => 'POST','url' => 'painel_de_controle/admin/mailing_pesquisar', 'class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0']) !!}
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Pesquisar E-mail" aria-label="Search" aria-describedby="basic-addon2" name="mailing_pesquisar">
              <div class="input-group-append">
                <input type="submit" class="btn btn-primary" value="Pesquisar">
              </div>
            </div>
               {!! Form::close() !!} 
          </div>
        </div>
        




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
                   @foreach($resultado as $row)
                   <tr>
                    <td>{!! $row->nome !!}</td>
                    <td>{!! $row->email !!}</td>
                    <td></td>
                    <td>
                    </td>
                    <td>
                    </td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>  
          @endif
    </div>