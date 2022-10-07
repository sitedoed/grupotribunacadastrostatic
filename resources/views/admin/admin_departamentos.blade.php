
    <div class="margem_cima_baixo">

          @if(Session::has('retorno'))
            <div class="alert alert-success">{{Session::get('retorno') }}
            </div>
          @endif


          @if(Session::has('danger'))
            <div class="alert alert-danger">{{Session::get('danger') }}
            </div>
          @endif



        @if(Request::is('painel_de_controle/admin/*/departamentos_editar'))
          <h3>Editar Departamento</h3>
          @foreach($departamento as $row)
            {!! Form::model('$departamento',['method' => 'PATCH','url' => 'painel_de_controle/admin/'.$row->id.'/departamentos_atualizar']) !!}
            <input type="text" class="form-control" name="name" value="{{ $row->name }}">
          @endforeach
            <select name="empresas_id" class="form-control">
              <option value=0>Por favor, selecione uma empresa</option>
              @foreach($empresas as $empresa)
              <option value={{$empresa->id}}>{{$empresa->name}}</option>
              @endforeach
            </select>
          {!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}



          @elseif(Request::is('painel_de_controle/admin/*/departamentos_confirmar_deletar'))
          <h3>Deletar Departamento</h3>
          @foreach($departamento as $row)
            {!! Form::model('$departamento',['method' => 'POST','url' => 'painel_de_controle/admin/'.$row->id.'/departamentos_deletar']) !!}

          <input type="text" class="form-control" name="name" value="{{ $row->name }}">

           <input type="text" class="form-control" name="empresa" value="{{ $row->empresa }}">

          @endforeach
          {!! Form::submit('SIM', ['class'=>'btn btn-primary btn-danger']) !!}
          {!! Form::close() !!}



          @else

          <h3>Cadastrar Departamento</h3>
          {!! Form::open(['url' => 'painel_de_controle/admin/departamentos_criar']) !!}

          {!! Form::input('text', 'name', '', ['class' => 'form-control', 'placeholder' =>'Nome do Departamento', 'required' => 'required']) !!}
           
           <select name="empresas_id" required class="form-control">
                <option value="0">Por favor, selecione uma empresa</option>
                @foreach($empresas as $empresa)
                <option value={{$empresa->id}}>{{$empresa->name}}</option>
                @endforeach
            </select>

          {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
          {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}

          @endif

          </div>

          <div class="margem_cima_baixo">
          @if(count($departamentos)>=1)    
          <h3>Departamentos Cadastrados</h3>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Departamento</th>
                  <th class="linha_cheia">Empresa</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach($departamentos as $departamento)
                  <tr>
                    <td class="margin_right_5">{{ $departamento->name }}</td>
                    <td class="col">{{ $departamento->empresa }}</td>
                    <td class="col"><a href="\painel_de_controle/admin/{{ $departamento->id }}/departamento_estatisticas">Estatísticas</a></td>
                    <td class="col"></td>
                    <td class="col"><span class="invisible"></span></td>
                    <td class="col"><span class="invisible"></span></td>
                    <td class="col"><span class="invisible"></span></td>
                    <td class="col"><span class="invisible"></span></td>
                    <td class="col"><span class="invisible"></span></td>
                    <td>
                    {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$departamento->id.'/departamentos_editar'])!!}
                    {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                    </td>
                    <td>
                    {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$departamento->id.'/departamentos_confirmar_deletar'])!!}
                    {!! Form::submit('Deletar', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </td>                   
                  </tr>
                  @endforeach
              </tbody>
            </table>
          @endif
          </div>
          </div>

