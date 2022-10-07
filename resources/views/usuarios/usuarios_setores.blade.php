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
                    </td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>
        {{ $setores->links() }}     

      @endif
    </div>





