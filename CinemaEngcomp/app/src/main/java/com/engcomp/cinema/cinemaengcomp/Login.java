//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

/* *************************************************************************************************************************************************************************************************
* - Classe criada e adaptada, atraves do codigo de exemplo extraido da referencia abaixo:
*
* SILVA, E. Login - Android Studio e MySQL. Disponível em: <https://www.youtube.com/playlist?list=PLssIKrX2yyQGjL81jrPx09c8IeMEUD1wB> Acesso em 29 de novembro de 2017.
*
************************************************************************************************************************************************************************************************* */

package com.engcomp.cinema.cinemaengcomp;

import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.*;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Login extends AppCompatActivity {

    /* Declarando variaveis de acordo com layout criado*/
    EditText editLoginEmail, editLoginSenha;
    Button btCadastrar, btEntrar;

    /* variaveis para montagem do link*/
    String url = "";
    String parametros = "";

    /* inicializando activity*/
    protected void onCreate(Bundle savedInstanceState) {   /*guardar o estado da activity*/
        super.onCreate(savedInstanceState);                /*chamando implementacao onCreate da classe mae*/
        setContentView(R.layout.login);                    /*configurar o layout XML na activity */

        /*atribuindo variaveis onde buscar / recuperar os dados no layout*/
        editLoginEmail   = (EditText) findViewById(R.id.login_email);
        editLoginSenha   = (EditText) findViewById(R.id.login_senha);

        btCadastrar      = (Button) findViewById(R.id.botao_cadastrar);
        btEntrar         = (Button) findViewById(R.id.botao_entrar);

        /*metodo de clique criado para o botao "entrar" */
        btEntrar.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {

                /*Comando para verificar o estado da conectividade de rede*/
                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);

                /*Comando para verificar a rede de dados padrão ativo no momento*/
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

                /*so permite cadastrar caso houver conectividade*/
                if (networkInfo != null && networkInfo.isConnected()){

                    //criando variaveis que serao utilizadas como parametros no link http e que recebem o dado informado nos campos do layout
                    String email = editLoginEmail.getText().toString();
                    String senha = editLoginSenha.getText().toString();

                    //validacao se os campos foram preenchidos
                    if(email.isEmpty() || senha.isEmpty()){
                        Toast.makeText(getApplicationContext(), "Campos não preenchidos", Toast.LENGTH_LONG).show();
                    }
                    //entrara neste else caso todos os campos estejam preenchidos corretamente
                    else {

                        //variavel de url que sera executada chamando o script de login
                        url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/login.php";

                        //variavel que recebera as demais variaveis que obtiveram as informacoes do layout de cadastro para montagem do link
                        parametros = "email=" + email + "&senha=" + senha;

                        //chamada da classe Solicita dados passando como parametro a url
                        new SolicitaDados().execute(url);
                    }

                }
                // caso nao encontre conexao com a rede, sera retornado a mensagem para o usuario
                else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }

            }
        });

        /*metodo de clique criado para o botao "Cadastrar" */
        btCadastrar.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                //intencao criada para que ao clicar no botao voltar, deve ser chamada a activity de cadastro
                Intent telacadastro = new Intent(Login.this, Cadastro.class);
                startActivity(telacadastro);
                finish();
            }
        });

    }

    // classe criada extendendo AsyncTask para fazer processamentos mais longos assim nao comprometendo a activity
    private class SolicitaDados extends AsyncTask<String, Void, String> {

        // metodo que captura a url enviada atraves do comando execute(url)
        protected String doInBackground(String...urls){
            return Conexao.postDados(urls[0], parametros);
        }

        //retorna os dados da conexao
        //este metodo recebe o retorno do onInBackground para que possamos trabalhar com os dados
        protected void onPostExecute(String resultado){

            if(resultado.contains("login_cliente")) {
                Intent telainicio = new Intent(Login.this, MenuCliente.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", editLoginEmail.getText().toString());
                telainicio.putExtras(bundle);
                startActivity(telainicio);
                finish();
            }else if(resultado.contains("login_funcionario")){
                Intent telaleitorqrcode = new Intent(Login.this, LeitorQRCode.class);
                startActivity(telaleitorqrcode);
                finish();
            }else {
                Toast.makeText(getApplicationContext(), "Usuário ou Senha estão incorretos", Toast.LENGTH_LONG).show();
            }
        }

    }

    //metodo utilizado quando uma activity esta em modo de espera
    //como por exemplo: o usuario sair da tela do aplicativo, para fazer outra operaçao no celular
    protected void onPause() {
        super.onPause();
    }

}