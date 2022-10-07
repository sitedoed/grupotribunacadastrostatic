<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', 'AdminController@logout');

Route::get('/', 'Login_edController@index');

Route::get('/painel', 'Login_edController@painel');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');


//Admin
Route::get('/painel_de_controle/admin', 'AdminController@index')->name('home');

Route::get('/painel_de_controle/admin/config', 'AdminController@config');
Route::get('/painel_de_controle/admin/{id}/config_edit', 'AdminController@config_edit');
Route::patch('/painel_de_controle/admin/{id}/config_atualizar', 'AdminController@config_atualizar');


Route::get('/painel_de_controle/admin/{id}/senha_alterar', 'AdminController@senha_alterar');



Route::patch('painel_de_controle/admin/{id}/senha_atualizar', 'AdminController@senha_atualizar');




Route::get('/painel_de_controle/admin/{id}/edit_user', 'AdminController@edit_user');

//admin/empresas
Route::get('/painel_de_controle/admin/empresas', 'AdminController@empresas');
Route::get('/painel_de_controle/admin/{id}/empresas', 'AdminController@empresas');
Route::post('/painel_de_controle/admin/empresas_criar', 'AdminController@empresas_criar');
Route::patch('/painel_de_controle/admin/{id}/empresas_editar', 'AdminController@empresas_editar');
Route::patch('/painel_de_controle/admin/{id}/empresas_salvar', 'AdminController@empresas_salvar');
Route::get('/painel_de_controle/admin/{id}/empresas_confirmar_deletar', 'AdminController@empresas_confirmar_deletar');
Route::delete('/painel_de_controle/admin/{id}/empresas_deletar', 'AdminController@empresas_deletar');


//admin/departamentos
Route::get('/painel_de_controle/admin/departamentos', 'AdminController@departamentos');
Route::get('/painel_de_controle/admin/{id}/departamentos', 'AdminController@departamentos');
Route::post('/painel_de_controle/admin/departamentos_criar', 'AdminController@departamentos_criar');
Route::post('/painel_de_controle/admin/{id}/departamentos_editar', 'AdminController@departamentos_editar');
Route::patch('/painel_de_controle/admin/{id}/departamentos_atualizar', 'AdminController@departamentos_atualizar');
Route::post('/painel_de_controle/admin/{id}/departamentos_confirmar_deletar', 'AdminController@departamentos_confirmar_deletar');
Route::post('/painel_de_controle/admin/{id}/departamentos_deletar', 'AdminController@departamentos_deletar');


//admin/eventos
Route::get('/painel_de_controle/admin/eventos', 'AdminController@eventos');
Route::get('/painel_de_controle/admin/{id}/evento_estatisticas', 'AdminController@evento_estatisticas');
Route::get('/painel_de_controle/admin/{id}/evento_clientes', 'AdminController@evento_clientes');
Route::get('/painel_de_controle/admin/{id}/eventos', 'AdminController@eventos');
Route::post('/painel_de_controle/admin/eventos_criar', 'AdminController@eventos_criar');
Route::patch('/painel_de_controle/admin/{id}/eventos_editar', 'AdminController@eventos_editar');
Route::get('/painel_de_controle/admin/{id}/eventos_editar', 'AdminController@eventos_editar');
Route::patch('/painel_de_controle/admin/{id}/eventos_atualizar', 'AdminController@eventos_atualizar');
Route::any('/painel_de_controle/admin/{id}/eventos_confirmar_deletar', 'AdminController@eventos_confirmar_deletar');
Route::delete('/painel_de_controle/admin/{id}/eventos_deletar', 'AdminController@painel_eventos_deletar');


//admin/clientes
Route::get('/painel_de_controle/admin/clientes', 'AdminController@clientes');
Route::post('/painel_de_controle/admin/clientes_cadastrar', 'AdminController@clientes_cadastrar');

Route::patch('/painel_de_controle/admin/{id}/clientes_editar', 'AdminController@clientes_editar');


Route::get('/painel_de_controle/admin/{id}/clientes_editar', 'AdminController@clientes_editar');


Route::patch('/painel_de_controle/admin/{id}/cliente_salvar', 'AdminController@cliente_salvar');
Route::post('/painel_de_controle/admin/{id}/cliente_salvar_dados_especificos', 'AdminController@cliente_salvar_dados_especificos');



Route::any('/painel_de_controle/admin/{id}/cliente_confirmar_deletar', 'AdminController@cliente_confirmar_deletar');
Route::delete('/painel_de_controle/admin/{id}/cliente_deletar', 'AdminController@cliente_deletar');
Route::get('/painel_de_controle/admin/cliente_deletado', 'AdminController@cliente_deletado');



//admin/pesquisa
Route::post('/painel_de_controle/admin/pesquisar', 'AdminController@pesquisar');



//admin/campos_adicionais
Route::any('/painel_de_controle/admin/campos_adicionais', 'AdminController@campos_adicionais');
Route::any('/painel_de_controle/admin/campos_adicionais_cadastrar', 'AdminController@campos_adicionais_cadastrar');
Route::any('/painel_de_controle/admin/{id}/campos_adicionais_editar', 'AdminController@campos_adicionais_editar');
Route::post('/painel_de_controle/admin/{id}/campos_adicionais_atualizar', 'AdminController@campos_adicionais_atualizar');
Route::patch('/painel_de_controle/admin/{id}/campos_adicionais_atualizar', 'AdminController@campos_adicionais_atualizar');
Route::any('/painel_de_controle/admin/{id}/campos_adicionais_confirmar_deletar', 'AdminController@campos_adicionais_confirmar_deletar');
Route::delete('/painel_de_controle/admin/{id}/campos_adicionais_deletar', 'AdminController@campos_adicionais_deletar');



//admin/usuários
Route::get('/painel_de_controle/admin/usuarios', 'AdminController@usuarios');
Route::post('/painel_de_controle/admin/usuario_criar', 'AdminController@usuario_criar');
Route::post('/painel_de_controle/admin/{id}/usuario_editar', 'AdminController@usuario_editar');
Route::patch('/painel_de_controle/admin/{id}/usuario_atualizar', 'AdminController@usuario_atualizar');
Route::post('/painel_de_controle/admin/{id}/usuario_confirmar_deletar', 'AdminController@usuario_confirmar_deletar');
Route::get('/painel_de_controle/admin/{id}/usuarios', 'AdminController@usuarios');
Route::delete('/painel_de_controle/admin/{id}/usuario_deletar', 'AdminController@usuario_deletar');


//admin/feedback
Route::get('painel_de_controle/admin/feedback', 'AdminController@feedback');
Route::post('painel_de_controle/admin/feedback_enviar', 'AdminController@feedback_enviar');
Route::any('painel_de_controle/admin/{id}/feedback_resposta', 'AdminController@feedback_resposta');
Route::post('painel_de_controle/admin/{id}/feedback_responder', 'AdminController@feedback_responder');
Route::any('painel_de_controle/admin/{id}/feedback_confirmar_deletar', 'AdminController@feedback_confirmar_deletar');
Route::delete('painel_de_controle/admin/{id}/feedback_deletar', 'AdminController@feedback_deletar');

//Admin Setores
Route::get('/painel_de_controle/admin/setores', 'RamalController@setores');
Route::post('/painel_de_controle/admin/setor_cadastrar', 'RamalController@setor_cadastrar');
Route::post('/painel_de_controle/admin/{id}/setor_editar', 'RamalController@setor_editar');
Route::post('/painel_de_controle/admin/{id}/setor_atualizar', 'RamalController@setor_atualizar');
Route::post('/painel_de_controle/admin/{id}/setor_aviso_deletar', 'RamalController@setor_aviso_deletar');
Route::delete('/painel_de_controle/admin/{id}/setor_deletar', 'RamalController@setor_deletar');

//Admin Mailings
Route::get('/painel_de_controle/admin/mailings', 'MailingController@index');
Route::get('/painel_de_controle/admin/{id}/mailing_listar', 'MailingController@mailing_listar');
Route::any('/painel_de_controle/admin/mailing_pesquisar', 'MailingController@mailing_pesquisar');

//admin/testes
Route::post('{id}/teste', 'AdminController@teste');





//usuarios/usuarios
Route::get('/painel_de_controle/usuarios', 'UserController@index');
Route::get('/painel_de_controle/usuarios/config', 'UserController@config');
Route::get('/painel_de_controle/usuarios/{id}/config_edit', 'UserController@config_edit');
Route::patch('/painel_de_controle/usuarios/{id}/config_atualizar', 'UserController@config_atualizar');


Route::get('/painel_de_controle/usuarios/{id}/senha_alterar', 'UserController@senha_alterar');
Route::patch('painel_de_controle/usuarios/{id}/senha_atualizar', 'UserController@senha_atualizar');




Route::post('/painel_de_controle/usuarios/usuario_criar', 'PainelController@usuario_criar');
Route::post('/painel_de_controle/usuarios/{id}/usuario_editar', 'PainelController@usuario_editar');
Route::patch('/painel_de_controle/usuarios/{id}/usuario_atualizar', 'PainelController@usuario_atualizar');


//usuarios/Eventos
Route::get('/painel_de_controle/usuarios/eventos', 'UserController@eventos');
Route::get('/painel_de_controle/usuarios/{id}/eventos', 'UserController@eventos');
Route::get('/painel_de_controle/usuarios/{id}/evento_estatisticas', 'UserController@evento_estatisticas');


Route::post('/painel_de_controle/usuarios/eventos_criar', 'UserController@eventos_criar');
Route::patch('/painel_de_controle/usuarios/{id}/eventos_editar', 'UserController@eventos_editar');
Route::get('/painel_de_controle/usuarios/{id}/eventos_editar', 'UserController@eventos_editar');
Route::patch('/painel_de_controle/usuarios/{id}/eventos_atualizar', 'UserController@eventos_atualizar');
Route::post('/painel_de_controle/usuarios/{id}/eventos_confirmar_deletar', 'UserController@eventos_confirmar_deletar');
Route::delete('/painel_de_controle/usuarios/{id}/eventos_deletar', 'UserController@painel_eventos_deletar');

Route::get('/painel_de_controle/usuarios/{id}/evento_clientes', 'UserController@evento_clientes');


//usuarios/clientes
Route::get('/painel_de_controle/usuarios/clientes', 'UserController@clientes');
Route::patch('/painel_de_controle/usuarios/clientes', 'UserController@clientes');
Route::post('/painel_de_controle/usuarios/clientes_cadastrar', 'UserController@clientes_cadastrar');
Route::any('/painel_de_controle/usuarios/{id}/clientes_editar', 'UserController@clientes_editar');
Route::patch('/painel_de_controle/usuarios/{id}/cliente_salvar', 'UserController@cliente_salvar');
Route::any('/painel_de_controle/usuarios/{id}/cliente_confirmar_deletar', 'UserController@cliente_confirmar_deletar');
Route::delete('/painel_de_controle/usuarios/{id}/cliente_deletar', 'UserController@cliente_deletar');

Route::get('/painel_de_controle/usuarios/cliente_deletado', 'UserController@cliente_deletado');

//usuarios/pesquisa
Route::post('/painel_de_controle/usuarios/pesquisar', 'UserController@pesquisar');

//usuarios/campos adicionais
Route::get('/painel_de_controle/usuarios/campos_adicionais', 'UserController@campos_adicionais');
Route::any('/painel_de_controle/usuarios/campos_adicionais_cadastrar', 'UserController@campos_adicionais_cadastrar');
Route::any('/painel_de_controle/usuarios/{id}/campos_adicionais_editar', 'UserController@campos_adicionais_editar');
Route::patch('/painel_de_controle/usuarios/{id}/campos_adicionais_atualizar', 'UserController@campos_adicionais_atualizar');
Route::any('/painel_de_controle/usuarios/{id}/campos_adicionais_confirmar_deletar', 'UserController@campos_adicionais_confirmar_deletar');
Route::delete('/painel_de_controle/usuarios/{id}/campos_adicionais_deletar', 'UserController@campos_adicionais_deletar');


//usuarios/feedback
Route::get('painel_de_controle/usuarios/feedback', 'UserController@feedback');
Route::post('painel_de_controle/usuarios/feedback_enviar', 'UserController@feedback_enviar');
Route::any('painel_de_controle/usuarios/{id}/feedback_resposta', 'UserController@feedback_resposta');
Route::post('painel_de_controle/usuarios/{id}/feedback_responder', 'UserController@feedback_responder');


//Usuarios Ramais
Route::any('/ramais', 'PublicoController@index');
Route::any('/ramais/pesquisar', 'PublicoController@pesquisar_publico');
Route::get('/painel_de_controle/usuarios/ramais', 'UserController@ramais');
Route::any('/painel_de_controle/usuarios/usuarios_pesquisar_ramal', 'RamalController@usuarios_pesquisar_ramal');
Route::post('/painel_de_controle/usuarios/ramal_cadastrar', 'UserController@ramal_cadastrar');
Route::any('/painel_de_controle/usuarios/{id}/ramal_editar', 'UserController@ramal_editar');
Route::any('/painel_de_controle/usuarios/{id}/ramal_atualizar', 'UserController@ramal_atualizar');
Route::any('/painel_de_controle/usuarios/{id}/ramal_aviso_deletar', 'UserController@ramal_aviso_deletar');
Route::delete('/painel_de_controle/usuarios/{id}/ramal_deletar', 'UserlController@ramal_deletar');

//Usuarios Setores
Route::get('/painel_de_controle/usuarios/setores', 'UserController@setores');
Route::post('/painel_de_controle/usuarios/setor_cadastrar', 'UserController@setor_cadastrar');
Route::post('/painel_de_controle/usuarios/{id}/setor_editar', 'UserController@setor_editar');
Route::post('/painel_de_controle/usuarios/{id}/setor_atualizar', 'UserController@setor_atualizar');
Route::post('/painel_de_controle/usuarios/{id}/setor_aviso_deletar', 'UserController@setor_aviso_deletar');
Route::delete('/painel_de_controle/usuarios/{id}/setor_deletar', 'UserController@setor_deletar');


//clientes/clientes
Route::get('painel_de_controle/clientes', 'ClienteController@index');
Route::get('painel_de_controle/clientes/home', 'ClienteController@index');
Route::get('/painel_de_controle/clientes/config', 'ClienteController@config');
Route::get('/painel_de_controle/clientes/{id}/config_edit', 'ClienteController@config_edit');
Route::patch('/painel_de_controle/clientes/{id}/config_atualizar', 'ClienteController@config_atualizar');
Route::get('/painel_de_controle/clientes/{id}/senha_alterar', 'ClienteController@senha_alterar');
Route::patch('painel_de_controle/clientes/{id}/senha_atualizar', 'ClienteController@senha_atualizar');
Route::get('/painel_de_controle/clientes/{id}/edit_user', 'ClienteController@edit_user');

//clientes/pesquisa
Route::any('/painel_de_controle/clientes/pesquisar', 'ClienteController@pesquisar');

//clientes/eventos
Route::get('/painel_de_controle/clientes/eventos', 'ClienteController@eventos');
Route::get('/painel_de_controle/clientes/{id}/evento_estatisticas', 'ClienteController@evento_estatisticas');
Route::post('/painel_de_controle/clientes/{id}/inscrever', 'ClienteController@inscrever');





//Acesso Restrito
Route::get('/acesso_restrito', 'AdminController@acesso_restrito');

//Ramais
Route::any('/ramais', 'PublicoController@index');
Route::get('/ramais/faq', 'PublicoController@faq');
Route::get('/ramais/login', 'PublicoController@login');
Route::get('/ramais/cadastro', 'PublicoController@cadastro');



Route::any('/ramais/pesquisar', 'PublicoController@pesquisar_publico');
Route::get('/painel_de_controle/admin/ramais', 'RamalController@ramais');
Route::any('/painel_de_controle/admin/admin_pesquisar_ramal', 'RamalController@admin_pesquisar_ramal');
Route::post('/painel_de_controle/admin/ramal_cadastrar', 'RamalController@ramal_cadastrar');
Route::any('/painel_de_controle/admin/{id}/ramal_editar', 'RamalController@ramal_editar');
Route::any('/painel_de_controle/admin/{id}/ramal_atualizar', 'RamalController@ramal_atualizar');
Route::post('/painel_de_controle/admin/{id}/ramal_aviso_deletar', 'RamalController@ramal_aviso_deletar');
Route::delete('/painel_de_controle/admin/{id}/ramal_deletar', 'RamalController@ramal_deletar');

