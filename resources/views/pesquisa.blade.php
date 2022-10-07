@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="flex-center position-ref full-height">
                {!! Form::open(['method' => 'POST','url' => 'ramais/pesquisar', 'class' => 'form-inline']) !!}
                     {!! csrf_field() !!}
                  <div class="col-md-9">
                    <div class="input-group">
                      <input type="text" class="form-control" id="ramal"  placeholder="Digite o ramal que você procura" aria-label="Search" aria-describedby="basic-addon2" name="pesquisar_publico">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


<div class="margem_cima_baixo">
</div>

<div class="margem_cima_baixo">
  <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col-sm-8">
            @if(isset ($resultado))

              @if(count($resultado)>=1)  
                <h4>Lista de Ramais Encontrados</h4>
                    {{ $resultado->links() }}    
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Ramal</th>
                          <th>Setor</th>
                          <th>Responsável</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($resultado as $resultado)
                         <tr>
                          <td>{{ $resultado->ramal }}</td>
                          <td>{{ $resultado->setor }}</td>
                          <td>{{ $resultado->responsavel }}</td>
                          <td>
                          </td>
                        </tr>  
                        @endforeach
                      </tbody>
                    </table>

                    @else
                    <div class="margem_cima_baixo">
                      <p>
                        Nenhum Ramal Encontrado com os critérios inseridos. Por favor, pesquise novamente com outros termos.
                      </p>
                  </div>
              @endif

            @endif
      </div>
      <div class="col"></div>
    </div>
  </div>
</div>





@endsection
