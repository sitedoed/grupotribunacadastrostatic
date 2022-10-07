    <div class="margem_cima_baixo">

        @include('flash-message')

            <h3>Cadastrar Empresa</h3>

            {!! Form::model('$empresa',['url' => 'painel_de_controle/admin/empresa_criar']) !!}
            {!! Form::input('text', 'name', '', ['class' => 'form-control', 'placeholder' =>'Nome da Empresa', 'required' => 'required']) !!}
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}

    </div><!--Div class: margem_cima_baixo -->

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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($empresas as $empresa)
               <tr>
                <td class="linha_cheia">{{ $empresa->name }}</td>
                <td><a href="{{ $empresa->id}}/empresa_estatisticas/" >Estatísticas</a></td>
                <td><span class="invisible"></span></td>
                <td><span class="invisible"></span></td>
                <td><span class="invisible"></span></td>
                <td>
                  {!! Form::open(['method' =>'PATCH', 'url' =>'painel_de_controle/admin/'.$empresa->id.'/empresa_editar'])!!}
                  {!! Form::submit('Editar', ['class'=>'btn btn-primary floatright']) !!}
                  {!! Form::close() !!}
                </td>                
                <td>
                  {!! Form::open(['method' =>'GET', 'url' =>'painel_de_controle/admin/'.$empresa->id.'/empresa_confirmar_deletar'])!!}
                  {!! Form::submit('DELETAR', ['class'=>'btn btn-danger floatright']) !!}
                  {!! Form::close() !!}
                  </td>
              </tr>  
              @endforeach()
            </tbody>
          </table>
        </div><!--Div class: Table Responsive -->
      </div><!--Div class: margem_cima_baixo -->

    @endif    



    



