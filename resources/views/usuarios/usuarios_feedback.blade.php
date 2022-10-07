      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Usuários</h1>
            <p>Bem-vindo(a):  {{ Auth::user()->name }} </p>
          </div>


          <div class="margem_cima_baixo">

          @include('flash-message')
  
          	<h3>Feedback</h3> 

      		  {!! Form::open(['url' => 'painel_de_controle/usuarios/feedback_enviar']) !!}
            {!! Form::input('text', 'assunto', '', ['class' => 'form-control', 'placeholder' =>'Assunto']) !!}
            {!! Form::textarea('mensagem','', ['class' => 'form-control', 'placeholder' =>'Mensagem']) !!}

            <input type="hidden" value= {{ Auth::user()->id }} name="de_user_id"/>
            <input type="hidden" value= {{ Auth::user()->name }} name="nome"/>
            <input type="hidden" value= {{ Auth::user()->nivel }} name="nivel"/>
            <input type="hidden" value= {{ Auth::user()->status }} name="status"/>
            <select name="para_user_id" class="form-control">
              @foreach($admin as $ad)
                <option name="para_user_id" value="{{ $ad->id }}">{{ $ad->name }}</option>
              @endforeach
            </select>

	        {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
	        {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
	        {!! Form::close() !!}


          </div>


   <div class="margem_cima_baixo">
                <div class="table-responsive">

                    <table class="table table-striped table-sm">
                      <thead>
                        <tr> <h3>Lista de Mensagens Cadastrados</h3>
                          <th>ID</th>
                          <th>Assunto</th>
                          <th>Mensagem</th>
                          <th>Autor</th>
                          <th >Data</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach($feedback as $feed)
                          <tr>
                            <td calss="col">{{$feed->feedback_id}}</td>
                            <td class="col">{{$feed->assunto}}</td>
                            <td class="col">{{$feed->mensagem}}</td>
                            <td class="col">{{$feed->nome}}</td>
                            <td class="col">
                              <a href="">
                                {{ date( 'd/m/Y' , strtotime($feed->created_at)) }}
                              </a>
                            </td>
                            <td ></td>
                            <td class="col">
                            @if($feed->status != 1)

                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/'.$feed->feedback_id.'/feedback_resposta'])!!}
                              {!! Form::submit('Resposta', ['class'=>'btn btn-primary']) !!}
                              {!! Form::close() !!}

                              @else
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/'.$feed->feedback_id.'/feedback_resposta'])!!}
                              {!! Form::submit('Respondido', ['class'=>'btn btn-info']) !!}
                              {!! Form::close() !!}
                            @endif
                            </td>
                            <td>
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/usuarios/'.$feed->feedback_id.'/eventos_confirmar_deletar'])!!}
                              {!! Form::submit('DELETAR', ['class'=>'btn btn-danger ']) !!}
                              {!! Form::close() !!}
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>

                </div>
            </div>



