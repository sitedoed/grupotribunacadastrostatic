@include('clientes.clientes_sidebar');


 <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Painel de Controle - Clientes</h1>
      {{ Auth::user()->name }} 
    </div>

    <div class="margem_cima_baixo">
                  
 <?php
echo "<pre>";
print_r($relacionamento);
echo "</pre>";

 ?>           

      @if($campos_adicionais->count()<1)
                <h3>Modelo do formulário para o cadastro (Padrão)</h3>
              @else
                <h3>Modelo do formulário para o cadastro (Com campos adicionais)</h3>
              @endif

                  <input type="text" name="name" class="form-control" placeholder="Nome">
                  <input type="email1" name="email1" class="form-control form_col2" placeholder="E-mail1">
                  <input type="email2" name="email2" class="form-control form_col2"  placeholder="E-mail2">
                  <input type="tel1" name="tel1" class="form-control form_col2"  placeholder="Tel1">
                  <input type="tel2" name="tel2" class="form-control form_col2"  placeholder="Tel2">
                  <input type="text" name="endereco" class="form-control"  placeholder="Endereço">
                  <input type="text" name="bairro" class="form-control form_col3"  placeholder="Bairro">
                  <input type="text" name="cidade" class="form-control form_col3" placeholder="Cidade">
                  <select name="estado" class="form-control form_col4">
                      <option value="">Selecine o Estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                  </select>
                  <input type="text" name="cep" class="form-control form_col4"  placeholder="CEP">
                  <input type="text" name="rg" class="form-control form_col3" placeholder="RG">
                  <input type="text" name="cpf" class="form-control form_col2"  placeholder="CPF">
                  <select name="sexo" class="form-control form_col4">
                      <option value="0" disabled selected >Sexo</option>
                      <option value="0">Feminino</option>
                      <option value="1">Masculino</option>
                  </select>          
                  <select name="eventos_id" class="form-control">
                      <option value="0" disabled selected >Selecione o Evento</option>
                      <option value=></option>
                  </select>
                  <input type="text" name="empresa" class="form-control" placeholder="Empresa">

                  @if($campos_adicionais->count()>=1)
                    <h5>Campos Adicionais: </h5>
                    @foreach($campos_adicionais as $campo_adicional)                    
                     <input type="text" name="cep" class="form-control form_col3"  placeholder="{{ $campo_adicional->name}}">
                     @endforeach
                  @else
                       <h5><strong>Sem Campos Adicionais</strong></h5>
                  @endif

                    <input type="submit" name="Cadastrar" class="btn btn-primary" value="Cadastrar">
                    <input type="reset" name="Limpar" class="btn btn-primary" value="Limpar">

    </div>   

        </main>
  </div>
</div>
