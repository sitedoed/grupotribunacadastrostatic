     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Painel de Controle - Usuários</h1>
            <p>Bem-vindo(a):  {{ Auth::user()->name }} </p>
          </div>


          <div class="margem_cima_baixo">

          @include('flash-message')
  
          	<h3>Feedback</h3> 

             @foreach($responder as $feed)

              <ul>
                <li><label for="assunto"><strong>Assunto: </strong></label>
                  <span id="assunto">{{$feed->assunto}}</span>
                </li>
                <li><label for="mensagem"><strong>Mensagem: </strong></label>
                  <span id="mensagem">{{$feed->mensagem}}</span>
                </li>
                <li><label for="nome"><strong>Autor: </strong></label>
                  <span id="nome">{{$feed->nome}}</span>
                </li>
                <li><label for="date"><strong>Data: </strong></label>
                  <span id="date">{{ date( 'd/m/Y' , strtotime($feed->created_at)) }}</span>
                </li>
                <br />    
                  @if($resposta)
                    @foreach($resposta as $resp)
                <li><label for="resposta"><strong>Resposta: </strong></label>
                      {{  $resp->resposta }}
                </li>
                <li><label for="nome"><strong>Autor: </strong></label>
                  <span id="nome">{{$resp->nome}}</span>
                </li>
                <li><label for="date"><strong>Data: </strong></label>
                  <span id="date">{{ date( 'd/m/Y' , strtotime($resp->created_at)) }}</span>
                </li>
                <br />
                    @endforeach
                  @endif
              </ul>



              {!! Form::open(['url' => 'painel_de_controle/usuarios/'.$feed->feedback_id.'/feedback_responder']) !!}
              {!! Form::textarea('resposta','', ['class' => 'form-control', 'placeholder' =>'Resposta']) !!}

                <input type="hidden" value= {{ Auth::user()->id }} name="user_id"/>
                <input type="hidden" value= {{ $feed->feedback_id }} name="feedback_id"/>
                <input type="hidden" value= {{ Auth::user()->id }} name="users_id"/>
                <input type="hidden" value="1" name="status"/>


              {!! Form::submit('Responder', ['class'=>'btn btn-primary']) !!}
              {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}


            @endforeach



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
