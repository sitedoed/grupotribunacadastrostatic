
    <div class="margem_cima_baixo">


        @if(Session::has('success'))
          <div class="alert alert-success">{{Session::get('success') }}
          </div>
        @endif

        @if(Session::has('danger'))
          <div class="alert alert-danger">{{Session::get('danger') }}
          </div>
        @endif


        @if(Request::is('*/setor_editar'))
          <h3>Editar Setor</h3>
            @foreach($setor as $row)
              {!! Form::open(['method' => 'POST','url' => 'painel_de_controle/admin/'.$row->id.'/setor_atualizar', 'class' => 'form-control-dark w-100']) !!}
                  <input type="text" class="form-control" name="setor" value="{{ $row->setor}}">
              @endforeach
            {!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}


        @elseif(Request::is('*/setor_aviso_deletar'))
          <h3>Editar Setor</h3>
            @foreach($setor as $row)
              {!! Form::open(['method' => 'DELETE','url' => 'painel_de_controle/admin/'.$row->id.'/setor_deletar', 'class' => 'form-control-dark w-100']) !!}
                  <input type="text" class="form-control" name="setor" value="{{ $row->setor}}">
              @endforeach
            {!! Form::submit('Deletar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}



          @else

        <h3>Cadastro de Setores</h3>
      
            {!! Form::open(['method' => 'POST','url' => 'setor_cadastrar', 'class' => 'form-control-dark w-100']) !!}

              <input type="text" class="form-control" name="setor" value="">

            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}

        @endif


    </div>

    <div class="margem_cima_baixo">
      @if(count($setores)>=1)  

        {{ $setores->links() }}     
          <h4>Lista de Setores Cadastrados</h4>

              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>Setor</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($setores as $setor)
                   <tr>
                    <td>{{ $setor->setor }}</td>
                    <td>
                      {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$setor->id.'/setor_aviso_deletar'])!!}
                      {!! Form::submit('DELETAR', ['class'=>'btn btn-danger floatright']) !!}
                      {!! Form::close() !!}
                      {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$setor->id.'/setor_editar'])!!}
                      {!! Form::submit('Editar', ['class'=>'btn btn-primary floatright']) !!}
                      {!! Form::close() !!}                   
                    </td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>
        {{ $setores->links() }}     

      @endif
    </div>





