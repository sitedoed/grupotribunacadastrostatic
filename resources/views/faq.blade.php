@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="flex-center position-ref full-height">
                {!! Form::open(['method' => 'POST','url' => 'ramais/pesquisar', 'class' => 'form-inline']) !!}
                  <div class="col-md-9">
                    <input type="text" class="caixa_de_texto_pesquisa_publica" id="ramal" aria-describedby="ramal" placeholder="Digite o setor que você procura" name="pesquisar_publico">
                  </div>
                  <div class="col-">
                {!! Form::submit('Pesquisar', ['class'=>'btn btn-primary']) !!}
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


      <h3>Perguntas Frequentes - FAQ (Frequent Asked Questions)</h3>


      <p>
        
        <h4>Como transferir chamadas?</h4>

      <strong>No Ramal analógico:</strong> Tecle “flash” + o numero do ramal desejado. <br />
      <strong>No Ramal digital ou IP:</strong> Selecionar a Opção “Consulta ?” no visor + o numero do ramal. 

      </p>

      <p>
        <h4>Como criar conferencias?</h4> 
      *Conferencia: adicionar uma ou mais partes a uma conversa. <br />

      <strong>No Ramal analógico:</strong> Durante a primeira chamada efetuada ou recebida teclar “flash” + o numero de destino após o atendimento teclar “flash” + 3. <br />
      <strong>No Ramal digital ou IP:</strong> Durante a primeira chamada efetuada ou recebida Selecionar a Opção “Conferencia ?” no visor + o numero de destino após o atendimento Selecionar a Opção “Conferencia ?” no visor.


      </p>




      <p>
        <h4>Como habilitar desvio de chamadas?</h4> 
        <strong>No Ramal analógico:</strong> Teclar “14” + o numero do ramal <br /> 
        <strong>No Ramal digital ou IP:</strong> Teclar “14” + o numero do ramal + “OK”. 
      </p>


      <p>
        <h4>Como cancelar o desvio de chamadas?</h4> 
       <strong>No Ramal Analógico:</strong>Teclar “104”. <br />
       <strong>No Ramal digital ou IP:</strong> Teclar “104” + “OK”. . 
      </p>



      <p>
        <h4>Como capturar uma chamada</h4> 
       <strong>Em grupo:</strong>Teclar “*”. <br />
       <strong>Especifica:</strong> Teclar “#59” + o numero do ramal. 
      </p>

















            </div>
            <div class="col"></div>
          </div>
        </div>
      </div>



<div class="margem_cima_baixo">
</div>

@endsection
