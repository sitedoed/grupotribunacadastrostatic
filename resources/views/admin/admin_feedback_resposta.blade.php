  <div class="margem_cima_baixo">




      @if(Request::is('painel_de_controle/admin/*/feedback_confirmar_deletar'))
          
            <h3>Deletar Feedback</h3>

              @include('flash-message')

          @foreach($feedback as $row)
            {!! Form::model('$feedback',['method' => 'DELETE','url' => 'painel_de_controle/admin/'.$row->feedback_id.'/feedback_deletar']) !!}

          @endforeach
          {!! Form::submit('SIM', ['class'=>'btn btn-primary btn-danger']) !!}
          {!! Form::close() !!}     
          



      @elseif(Request::is('painel_de_controle/admin/*/feedback_resposta_editar'))

        <h1>Responder</h1>



      @else
            <h3>Feedback</h3>
            
            @include('flash-message')

      @endif



          @foreach($responder as $feed)
                  <li><label for='assunto'><strong>Assunto: </strong></label>
                    <span id='assunto'>{!! $feed->assunto !!}</span>
                  </li>
                  <li><label for='mensagem'><strong>Mensagem: </strong></label>
                    <span id='mensagem'>{!! $feed->mensagem !!}</span>
                  </li>
                  <li><label for='nome'><strong>Autor: </strong></label>
                    <span id='nome'>{!! $feed->nome !!}</span>
                  </li>
                  <li><label for='date'><strong>Data: </strong></label>
                    <span id='date'>{!! date( 'd/m/Y' , strtotime($feed->created_at)) !!}</span>
                  </li>
                </ul>
                <br />
          @endforeach

  </div><!---Fim margem_cima_baixo-->

          @if($resposta->count()>=1)
            @foreach($resposta as $resp)
              <div class="margem_cima_baixo">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Resposta</th>
                          <th>Autor</th>
                          <th >Data</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="col">{!! strip_tags($resp->resposta) !!}</td>
                          <td class="col">{!! $resp->nome !!}</td>
                          <td class="col">
                            <a href="">
                              {!! date( 'd/m/Y' , strtotime($resp->created_at)) !!}
                            </a>
                          </td>
                          <td ></td>
                          <td class="col">

                          @foreach($feedback as $feed)
                            @if($feed->status != 1)
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$resp->resposta_id.'/feedback_resposta'])!!}



                              {!! Form::hidden('feedback_id', $feedback_id) !!}



                              {!! Form::submit('Responder', ['class'=>'btn btn-primary']) !!}
                              {!! Form::close() !!}
                            @else
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$resp->resposta_id.'/feedback_resposta_editar'])!!}
                              {!! Form::hidden('feedback_id', $resp->feedback_id ) !!}
                              {!! Form::submit('Editar', ['class'=>'btn btn-primary']) !!}
                              {!! Form::close() !!}
                            @endif
                          @endforeach


                          </td>
                          <td>
                            {!! Form::open(['url' => 'painel_de_controle/admin/'.$resp->resposta_id.'/feedback_resposta_confirmar_deletar']) !!}
                            {!! Form::submit('DELETAR', ['class'=>'btn btn-danger ']) !!}
                            {!! Form::close() !!}
                          </td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                @endforeach
             
          @else

              <h2>Formulário para resposta</h2>
              {!! Form::open(['url' => 'painel_de_controle/admin/'.$feed->feedback_id.'/feedback_responder']) !!}
              {!! Form::textarea('resposta','', ['class' => 'form-control', 'placeholder' =>'Resposta']) !!}

                <input type="hidden" value= "{!! Auth::user()->id !!}" name="de_user_id"/>
              @foreach ($feedbacks_recebidos as $recebidos)

                {!! Form::hidden('para_user_id', $recebidos->de_user_id) !!}

              @endforeach
                <input type="hidden" value= "{!! $feed->feedback_id !!}" name="feedback_id"/>
                <input type="hidden" value= "{!! Auth::user()->id !!}" name="users_id"/>
                <input type="hidden" value="1" name="status"/>

              {!! Form::submit('Responder', ['class'=>'btn btn-primary']) !!}
              {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}

            </div>

          @endif

          <div class="margem_cima_baixo">
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr> <h3>Lista de Mensagens Recebidas</h3>
                    <th>ID</th>
                    <th>De</th>
                    <th>Mensagem</th>
                    <th>De</th>
                    <th>Para</th>
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
                    <td calss="col">{!! $feed->feedback_id !!}</td>
                    <td class="col">{!! $feed->assunto !!}</td>
                    <td class="col">{!! strip_tags($feed->mensagem) !!}</td>
                    <td class="col">{!! $feed->de !!}</td>
                    <td class="col">{!! Auth::User()->name !!}</td>
                    <td class="col">
                      <a href="">
                        {!! date( 'd/m/Y' , strtotime($feed->created_at)) !!}
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


