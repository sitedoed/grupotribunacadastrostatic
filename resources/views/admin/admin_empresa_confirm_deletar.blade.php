

    <div class="margem_cima_baixo">
        
      @include('flash-message')


            <h3>Deletar Empresa</h3>

          @foreach($empresa as $row)
            {!! Form::model('$empresa',['method' => 'DELETE','url' => 'painel_de_controle/admin/'.$row->id.'/empresa_deletar']) !!}

            <input type="text" class="form-control" name="name" value="{{ $row->name }}">
          @endforeach
          {!! Form::submit('SIM', ['class'=>'btn btn-primary btn-danger']) !!}
          {!! Form::close() !!}          


    </div>

    @if(count($empresas)>=1) 


    <div class="margem_cima_baixo">
      <h3>Empresas Cadastradas</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Nome</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($empresas as $empresa)
             <tr>
              <td class="linha_cheia">{{ $empresa->name }}</td>
              <td><a href="{{ $empresa->id}}/empresa_estatisticas/" >Estatísticas</a></td>

              <td>
                {!! Form::open(['method' =>'GET', 'url' =>'painel_de_controle/admin/'.$empresa->id.'/empresa_confirmar_deletar'])!!}
                {!! Form::submit('DELETAR', ['class'=>'btn btn-danger floatright']) !!}
                {!! Form::close() !!}
                
                {!! Form::open(['method' =>'PATCH', 'url' =>'painel_de_controle/admin/'.$empresa->id.'/empresa_editar'])!!}
                {!! Form::submit('Editar', ['class'=>'btn btn-primary floatright']) !!}
                {!! Form::close() !!}
              </td>
            </tr>  
            @endforeach()
            </tbody>
          </table>
        </div>
      @endif    
      </div>



