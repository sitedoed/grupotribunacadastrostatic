

        <div class="margem_cima_baixo">
            @include('flash-message')
    

        @if(Request::is('painel_de_controle/admin/*/feedback_confirmar_deletar'))
          
            <h3>Deletar Feedback</h3>

              
                <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr> <h3></h3>
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
                          <td class="col">{!! $feed->assunto !!}</td>
                          <td class="col">{!! strip_tags($feed->mensagem) !!}</td>
                          <td class="col">{!! $feed->nome !!}</td>
                          <td class="col">
                            <a href="">
                              {!! date( 'd/m/Y' , strtotime($feed->created_at)) !!}
                            </a>
                          </td>
                          <td ></td>
                          <td class="col">

                            @if($feed->status != 1)

                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_resposta'])!!}
                              {!! Form::submit('Responder', ['class'=>'btn btn-primary']) !!}
                              {!! Form::close() !!}

                              @else
                              {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_resposta'])!!}
                              {!! Form::submit('Respondido', ['class'=>'btn btn-info']) !!}
                              {!! Form::close() !!}
                            @endif

                          </td>
                          <td>
                            {!! Form::model('$feedback',['method' => 'DELETE','url' => 'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_deletar']) !!}
                            {!! Form::submit('SIM', ['class'=>'btn btn-danger ']) !!}
                            {!! Form::close() !!}
                          </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                  </div>
              </div>    
          
        @else
          <div class="margem_cima_baixo">

              <h3>Feedback</h3> 

              {!! Form::open(['url' => 'painel_de_controle/admin/feedback_enviar']) !!}
              {!! Form::input('text', 'assunto', '', ['class' => 'form-control', 'placeholder' =>'Assunto', 'required']) !!}
              {!! Form::textarea('mensagem','', ['class' => 'form-control', 'placeholder' =>'Mensagem', 'required']) !!}

                <input type="hidden" value= {!! Auth::user()->id !!} name="de_user_id"/>
                <input type="hidden" value= {!! Auth::user()->name !!} name="nome"/>
                <input type="hidden" value= {!! Auth::user()->nivel !!} name="nivel"/>
                <input type="hidden" value= {!! Auth::user()->status !!} name="status"/>
                <select name="para_user_id" class="form-control">
                @foreach($admin as $ad)
                  <option name="para_user_id" value="{!! $ad->id !!}">{!! $ad->name !!}</option>
                @endforeach
                </select>

              {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
              {!! Form::reset('Limpar', ['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
          </div>

        @endif

          

        @if($feedbacks_recebidos->count() >=1)

          <div class="margem_cima_baixo">
              <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr> <h3>Lista de Mensagens Recebidas</h3>
                        <th>ID</th>
                        <th>Assunto</th>
                        <th>Mensagem</th>
                        <th></th>
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
                          <td calss="col">{!! $feed['feedback_id'] !!}</td>
                          <td class="col">{!! $feed['assunto'] !!}</td>
                          <td class="col">{!! strip_tags($feed['mensagem']) !!}</td>
                          <td class="col"><span class="invisible"></span></td>
                          <td class="col">
                            {!! $feed['de'] !!}
                          </td>
                          <td class="col">
                          {!! Auth::user()->name !!}
                          </td>
                          <td class="col">
                            <a href="">
                              {!! date( 'd/m/Y' , strtotime($feed['created_at'])) !!}
                            </a>
                          </td>
                          <td ></td>
                          <td class="col">
                          @if($feed['status'] != 1)
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_resposta'])!!}
                            {!! Form::submit('Responder', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                          @else
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_resposta'])!!}
                            {!! Form::submit('Respondido', ['class'=>'btn btn-info']) !!}
                            {!! Form::close() !!}
                          @endif
                          </td>
                          <td>
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_confirmar_deletar'])!!}
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

        @if($feedbacks_enviados->count() >=1)

          <div class="margem_cima_baixo">
              <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr> <h3>Lista de Mensagens Enviadas</h3>
                        <th>ID</th>
                        <th>Assunto</th>
                        <th>Mensagem</th>
                        <th></th>
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
                       @foreach($feedbacks_enviados as $feed)
                        <tr>
                          <td calss="col">{!! $feed['feedback_id'] !!}</td>
                          <td class="col">{!! $feed['assunto'] !!}</td>
                          <td class="col">{!! strip_tags($feed['mensagem']) !!}</td>
                          <td class="col"><span class="invisible"></span></td>
                          <td class="col">
                            {!! Auth::user()->name !!}
                          </td>
                          <td class="col">
                            {!! $feed['para'] !!}
                          </td>
                          <td class="col">
                            <a href="">
                              {!! date( 'd/m/Y' , strtotime($feed['created_at'])) !!}
                            </a>
                          </td>
                          <td ></td>
                          <td class="col">
                          @if($feed['status'] != 1)
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_resposta'])!!}
                            {!! Form::submit('Responder', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                          @else
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_resposta'])!!}
                            {!! Form::submit('Respondido', ['class'=>'btn btn-info']) !!}
                            {!! Form::close() !!}
                          @endif
                          </td>
                          <td>
                            {!! Form::open(['method' =>'POST', 'url' =>'painel_de_controle/admin/'.$feed['feedback_id'].'/feedback_confirmar_deletar'])!!}
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