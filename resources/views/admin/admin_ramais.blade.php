
    <div class="margem_cima_baixo">
      <h3>Cadastro de Ramais</h3>

          @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success') }}
            </div>
          @endif

          @if(Session::has('danger'))
            <div class="alert alert-danger">{{Session::get('danger') }}
            </div>
          @endif


          @if(Request::is('painel_de_controle/admin/*/ramal_editar'))
          <div class="container">
            <div class="row">
              <div class="col-sm-4">
                @foreach($ramal as $row)
                {!! Form::open(['method' => 'POST','url' => '/painel_de_controle/admin/'.$row->ramal_id.'/ramal_atualizar', 'class' => 'form-control-dark w-100']) !!}
                <input type="text" class="form-control" name="ramal" required placeholder="Ramal" value="{{ $row->ramal }}">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="nome" required placeholder="Nome" value="{{ $row->nome }}">
              </div>
              <div class="form-group col-md-4">
                <select name="setor_id" class="form-control">
                  <option value="{{ $row->setor_id }}">{{ $row->setor }}</option>
                  @endforeach
                    @foreach($setores as $setor)
                      <option value="{{ $setor->id }}">{{ $setor->setor }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="status" value="1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline1">Ativo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name="status" value="0" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline2">Inativo</label>
                </div>
              </div>
              <div class="col-sm-12">
                {!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
              </div>
            </div><!--FIm Div Row-->
          </div><!--FIm Div Container-->


          @elseif(Request::is('painel_de_controle/admin/*/ramal_aviso_deletar'))
          <div class="container">
            <div class="row">
              <div class="col-sm-4">
                @foreach($ramal as $row)
                {!! Form::open(['method' => 'DELETE','url' => '/painel_de_controle/admin/'.$row->ramal_id.'/ramal_deletar', 'class' => 'form-control-dark w-100']) !!}
                <input type="text" class="form-control" name="ramal" placeholder="Ramal" value="{{ $row->ramal }}">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control"  name="nome" placeholder="Nome" value="{{ $row->nome }}">
              </div>
              <div class="form-group col-md-4">
                <select name="setor_id" class="form-control">
                  <option value="{{ $row->setor_id }}">{{ $row->setor }}</option>
                  @endforeach
                    @foreach($setores as $setor)
                      <option value="{{ $setor->id }}">{{ $setor->setor }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4">
              </div>
              <div class="col-sm-4">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="status" value="1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline1">Ativo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name="status" value="0" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline2">Inativo</label>
                </div>
                </div>
              <div class="col-sm-12">
                {!! Form::submit('Deletar', ['class'=>'direita btn btn-danger primary']) !!}
                {!! Form::close() !!}
              </div>
            </div><!--FIm Div Row-->
          </div><!--FIm Div Container-->



          @else


          {!! Form::open(['method' => 'POST','url' => '/painel_de_controle/admin/ramal_cadastrar', 'class' => 'form-control-dark w-100']) !!}
          <div class="container">
            <div class="row">
              <div class="margin_top col-sm-4">
                <input type="text" class="form-control" required name="ramal" placeholder="Ramal" value="">
              </div>
              <div class="margin_top col-sm-4">
                <input type="text" class="form-control" required name="nome" placeholder="Nome" value="">
              </div>
              <div class="margin_top form-group col-md-4">
                <select name="setor_id" class="form-control">
                    @foreach($setores as $setor)
                      <option value="{{ $setor->id }}">{{ $setor->setor }}</option>
                    @endforeach
                </select>
              </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="status" value="1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Ativo</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="status" value="0" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Inativo</label>
                  </div>
                </div>
                <div class="col-sm-12">
                  {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
                  {!! Form::close() !!}
                </div>
              </div><!--FIm Div Row-->
            </div><!--Fim da DIV Container-->
         
          @endif
    </div><!--Fim margem_cima_baixo-->




    <div class="margem_cima_baixo">
        <div class="container">
          <div class="row">
            <div class="col-sm">
            </div>
          {!! Form::open(['method' => 'POST','url' => 'painel_de_controle/admin/admin_pesquisar_ramal', 'class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0']) !!}
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Pesquisar Ramal" aria-label="Search" aria-describedby="basic-addon2" name="pesquisar_ramal">
              <div class="input-group-append">
                <input type="submit" class="btn btn-primary" value="Pesquisar">
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="pesquisar_ativo" name="status" value="1" class="custom-control-input">
                <label class="custom-control-label" for="pesquisar_ativo">Ativo</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="pesquisar_inativo" name="status" value="0" class="custom-control-input">
                <label class="custom-control-label" for="pesquisar_inativo">Inativo</label>
              </div>
               <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="pesquisar_todos" name="status" value="*" disabled class="custom-control-input">
                <label class="custom-control-label" for="pesquisar_inativo">Todos</label>
              </div>   
            </div>
          </div>
        </div>
           {!! Form::close() !!} 

   </div><!--Fim DIV Margem_cima_baixo-->



















    @if(isset($resultado))
        <div class="margem_cima_baixo">
          @if(count($resultado)>1)
            {{ $resultado->appends(['status' => isset($status) ? $status : ''])->links() }}
            <h4>{{ $total }} Ramais Encontrados  </h4>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Ramal</th>
                  <th>Setor</th>
                  <th>Respons??vel</th>
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
                    {!! Form::open(['method' =>'POST', 'url' =>'/painel_de_controle/admin/'.$resultado->ramal_id.'/ramal_aviso_deletar'])!!}
                    {!! Form::submit('DELETAR', ['class'=>'btn btn-danger floatright']) !!}
                    {!! Form::close() !!}
                    {!! Form::open(['method' =>'POST', 'url' =>'/painel_de_controle/admin/'.$resultado->ramal_id.'/ramal_editar'])!!}
                    {!! Form::submit('Editar', ['class'=>'btn btn-primary floatright']) !!}
                    {!! Form::close() !!}
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
                  <th>Respons??vel</th>
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
                    {!! Form::open(['method' =>'POST', 'url' =>'/painel_de_controle/admin/'.$resultado->ramal_id.'/ramal_aviso_deletar'])!!}
                    {!! Form::submit('DELETAR', ['class'=>'btn btn-danger floatright']) !!}
                    {!! Form::close() !!}
                    {!! Form::open(['method' =>'POST', 'url' =>'/painel_de_controle/admin/'.$resultado->ramal_id.'/ramal_editar'])!!}
                    {!! Form::submit('Editar', ['class'=>'btn btn-primary floatright']) !!}
                    {!! Form::close() !!}
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
          {{ $ramais->links() }}   
              <h4>Lista de Ramais Cadastrados</h4>

                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Ramal</th>
                        <th>Setor</th>
                        <th>Respons??vel</th>
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
                          {!! Form::open(['method' =>'POST', 'url' =>'/painel_de_controle/admin/'.$ramal->ramal_id.'/ramal_aviso_deletar'])!!}
                          {!! Form::submit('DELETAR', ['class'=>'btn btn-danger floatright']) !!}
                          {!! Form::close() !!}
                          {!! Form::open(['method' =>'POST', 'url' =>'/painel_de_controle/admin/'.$ramal->ramal_id.'/ramal_editar'])!!}
                          {!! Form::submit('Editar', ['class'=>'btn btn-primary floatright']) !!}
                          {!! Form::close() !!}
                        </td>
                      </tr>  
                      @endforeach
                    </tbody>
                  </table>
            {{ $ramais->links() }}      
          </div>
        </div><!--Fim DIV margem_cima_baixo-->




