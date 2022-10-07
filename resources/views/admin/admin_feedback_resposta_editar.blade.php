

  <div class="margem_cima_baixo">


              @include('flash-message')


      @if(Request::is('painel_de_controle/admin/*/feedback_resposta_confirmar_deletar'))
          
            <h3>Deletar Feedback</h3>


          @foreach($feedback as $row)
            {!! Form::model('$feedback',['method' => 'DELETE','url' => 'painel_de_controle/admin/'.$row->feedback_id.'/feedback_deletar']) !!}

          @endforeach
          {!! Form::submit('SIM', ['class'=>'btn btn-primary btn-danger']) !!}
          {!! Form::close() !!}     
          




      @elseif(Request::is('painel_de_controle/admin/*/feedback_resposta_editar'))


          @foreach($responder as $feed)
                <ul>
                  <li><label for='assunto'><strong>Assunto: </strong></label>
                    <span id='assunto'>{{ $feed->assunto }}</span>
                  </li>
                  <li><label for='mensagem'><strong>Mensagem: </strong></label>
                    {{ $feed->mensagem }}
                  </li>
                  <li><label for='nome'><strong>Autor: </strong></label>
                    <span id='nome'>{{ $feed->nome }}</span>
                  </li>
                  <li><label for='date'><strong>Data: </strong></label>
                    <span id='date'>{{ date( 'd/m/Y' , strtotime($feed->created_at)) }}</span>
                  </li>
                </ul>
                <br />
          @endforeach


          <h2>Editar resposta</h2>

          @foreach($resposta_editar as $resp)

            {!! Form::open(['url' => 'painel_de_controle/admin/'.$resp->resposta_id.'/feedback_resposta_atualizar']) !!}
            {!! Form::textarea('resposta', $resp->resposta, ['class' => 'form-control', 'placeholder' =>'Resposta']) !!}
            {!! Form::submit('Responder', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}

          @endforeach


      <div class="margem_cima_baixo">
          @if($resposta->count()>=1)   
              <div class="margem_cima_baixo">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr> <h3>Respostas</h3>
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
                      @foreach($resposta as $resp)
                        <tr>           
                          <td class="col">{{ strip_tags($resp->resposta) }}</td>
                          <td class="col">{{$resp->nome}}</td>
                          <td class="col">
                            <a href="">
                              {{ date( 'd/m/Y' , strtotime($resp->created_at)) }}
                            </a>
                          </td>
                          <td ></td>
                          <td class="col">

                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$resp->resposta_id.'/feedback_resposta_editar'])!!}
                              {!! Form::submit('Editar', ['class'=>'btn btn-info']) !!}
                              {!! Form::close() !!}

                          </td>
                          <td>
                            {!! Form::open(['url' => 'painel_de_controle/admin/'.$resp->resposta_id.'/feedback_resposta_confirmar_deletar']) !!}
                            {!! Form::submit('DELETAR', ['class'=>'btn btn-danger ']) !!}
                            {!! Form::close() !!}
                          </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
          @endif
      </div>



      @else


              <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr> <h3>Lista de Mensagens Cadastradas</h3>
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
                       @foreach($feedbacks_recebidos as $feed)
                        <tr>
                          <td calss="col">{{$feed->feedback_id}}</td>
                          <td class="col">{{$feed->assunto}}</td>
                          <td class="col">{{ strip_tags($feed->mensagem) }}</td>
                          <td class="col">{{$feed->nome}}</td>
                          <td class="col">
                            <a href="">
                              {{ date( 'd/m/Y' , strtotime($feed->created_at)) }}
                            </a>
                          </td>
                          <td ></td>
                          <td class="col">

                            @if($feed->status != 1)

                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed->feedback_id.'/feedback_resposta'])!!}
                              {!! Form::submit('Responder', ['class'=>'btn btn-primary']) !!}
                              {!! Form::close() !!}

                              @else
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed->feedback_id.'/feedback_resposta'])!!}
                              {!! Form::submit('Respondido', ['class'=>'btn btn-info']) !!}
                              {!! Form::close() !!}
                            @endif


           
                          </td>
                          <td>
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed->feedback_id.'/feedback_confirmar_deletar'])!!}
                            {!! Form::submit('DELETAR', ['class'=>'btn btn-danger ']) !!}
                            {!! Form::close() !!}
                          </td>
                        </tr>
                        @endforeach
                            </tbody>
                          </table>
                      </div>
                  </div>



      @endif







 








