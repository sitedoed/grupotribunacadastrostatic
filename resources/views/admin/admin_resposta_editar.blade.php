
  <div class="margem_cima_baixo">

              @include('flash-message')

    @if(Request::is('painel_de_controle/admin/*/feedback_resposta_confirmar_deletar'))


          @if($resposta_editar->count()>=1)   
              <div class="margem_cima_baixo">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
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
                      @foreach($resposta_editar as $respo)
                        <tr>           
                          <td class="col">{!! strip_tags($respo->resposta) !!}</td>
                          <td class="col">{!! $respo->nome !!}</td>
                          <td class="col">
                            <a href="">
                              {!! date( 'd/m/Y' , strtotime($respo->created_at)) !!}
                            </a>
                          </td>
                          <td ></td>
                          <td class="col">

                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$respo->resposta_id.'/feedback_resposta_editar'])!!}

                              {!! Form::hidden('feedback_id', $respo->feedback_id ) !!}

                              {!! Form::submit('Editar', ['class'=>'btn btn-info']) !!}
                              {!! Form::close() !!}

                          </td>
                          <td>
                            {!! Form::open(['url' => 'painel_de_controle/admin/'.$respo->resposta_id.'/feedback_resposta_deletar', 'method' => 'POST']) !!}
                            {!! Form::hidden('feedback_id', $respo->feedback_id ) !!}
                            {!! Form::submit('SIM', ['class'=>'btn btn-danger ']) !!}
                            {!! Form::close() !!}
                          </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
          @endif


    @else




          @foreach($feedback as $feed)
                <ul>
                  <li><label for='assunto'><strong>Assunto: </strong></label>
                    <span id='assunto'>{!! $feed->assunto !!}</span>
                  </li>
                  <li><label for='mensagem'><strong>Mensagem: </strong></label>
                    {!! $feed->mensagem !!}
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




          <h2>Editar resposta</h2>

          @foreach($resposta_editar as $resp)

            {!! Form::open(['url' => 'painel_de_controle/admin/'.$resp->resposta_id.'/feedback_resposta_atualizar']) !!}
            {!! Form::textarea('resposta', $resp->resposta, ['class' => 'form-control', 'placeholder' =>'Resposta']) !!}
            {!! Form::hidden('feedback_id', $resp->feedback_id ) !!}
            {!! Form::submit('Atualizar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}

          @endforeach

    @endif      


      <div class="margem_cima_baixo">
          @if($resposta->count()>=1)   
              <div class="margem_cima_baixo">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr> <h3>Respostas</h3>
                          <th>ID</th>
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
                      @foreach($resposta as $res)
                        <tr>
                          <td class="col">{!! $res->resposta_id !!}</td>           
                          <td class="col">{!! strip_tags($res->resposta) !!}</td>
                          <td class="col">{!! $res->nome !!}</td>
                          <td class="col">
                            <a href="">
                              {!! date( 'd/m/Y' , strtotime($res->created_at)) !!}
                            </a>
                          </td>
                          <td ></td>
                          <td class="col">

                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$res->resposta_id.'/feedback_resposta_editar'])!!}

                              {!! Form::hidden('feedback_id', $res->feedback_id ) !!}

                              {!! Form::submit('Editar', ['class'=>'btn btn-info']) !!}
                              {!! Form::close() !!}

                          </td>
                          <td>
                            {!! Form::open(['url' => 'painel_de_controle/admin/'.$res->resposta_id.'/feedback_resposta_confirmar_deletar']) !!}
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

 








