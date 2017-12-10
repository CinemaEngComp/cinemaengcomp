//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

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
import android.widget.RadioGroup;
import android.widget.Toast;

public class Cadastro extends AppCompatActivity {

    /* Declarando variaveis de acordo com layout criado*/
    EditText editCadastroNome, editCadastroCPF, editCadastroDia, editCadastroMes, editCadastroAno, editCadastroEndereco, editCadastroNumero, editCadastroBairro, editCadastroCidade, editCadastroUF, editCadastroCEP, editCadastroEmail, editCadastroSenha, editCadastroConfirmaSenha;
    RadioGroup radioSexoopcao;
    Button btFinalizarCadastro, btVoltarLogin;

    /* variaveis para montagem do link*/
    String url = "";
    String parametros = "";

    /* inicializando activity*/
    protected void onCreate(Bundle savedInstanceState) { /*guardar o estado da activity*/
        super.onCreate(savedInstanceState);              /*chamando implementacao onCreate da classe mae*/
        setContentView(R.layout.cadastro);               /*configurar o layout XML na activity */

        /*atribuindo variaveis onde buscar / recuperar os dados no layout*/
        editCadastroNome           = (EditText) findViewById(R.id.cadastro_nome);
        editCadastroCPF            = (EditText) findViewById(R.id.cadastro_cpf);
        editCadastroCPF.addTextChangedListener(Mask.insert("###.###.###-##", editCadastroCPF));
        editCadastroDia            = (EditText) findViewById(R.id.cadastro_dia);
        editCadastroMes            = (EditText) findViewById(R.id.cadastro_mes);
        editCadastroAno            = (EditText) findViewById(R.id.cadastro_ano); 
        radioSexoopcao             = (RadioGroup) findViewById(R.id.cadastro_sexoopcao);
        editCadastroEndereco       = (EditText) findViewById(R.id.cadastro_endereco);
        editCadastroNumero         = (EditText) findViewById(R.id.cadastro_numero);
        editCadastroBairro         = (EditText) findViewById(R.id.cadastro_bairro);
        editCadastroCidade         = (EditText) findViewById(R.id.cadastro_cidade);
        editCadastroUF             = (EditText) findViewById(R.id.cadastro_uf);
        editCadastroUF.addTextChangedListener(Mask.insert("##", editCadastroUF));
        editCadastroCEP            = (EditText) findViewById(R.id.cadastro_cep);
        editCadastroCEP.addTextChangedListener(Mask.insert("#####-###", editCadastroCEP));
        editCadastroEmail          = (EditText) findViewById(R.id.cadastro_email);
        editCadastroSenha          = (EditText) findViewById(R.id.cadastro_senha);
        editCadastroConfirmaSenha  = (EditText) findViewById(R.id.cadastro_confirmarsenha);

        btFinalizarCadastro = (Button) findViewById(R.id.botao_finalizarcadastro);
        btVoltarLogin       = (Button) findViewById(R.id.botao_voltarlogin);

        /*metodo de clique criado para o botao "voltar" */
        btVoltarLogin.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                //intencao criada para que ao clicar no botao voltar, deve ser chamada a activity de login
                Intent telalogin = new Intent(Cadastro.this, Login.class);
                startActivity(telalogin);
            }

        });

        /*metodo de clique criado para o botao "finalizar cadastrar" */
        btFinalizarCadastro.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){

                /*Comando para verificar o estado da conectividade de rede*/
                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);

                /*Comando para verificar a rede de dados padrão ativo no momento*/
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

                /*so permite cadastrar caso houver conectividade*/
                if (networkInfo != null && networkInfo.isConnected()){

                    /*verificando se os campos foram preenchidos, utilizando o metodo verificacampo da classe Verifica*/
                    Verifica.verificacampo(editCadastroNome,"Preencha o nome");
                    Verifica.verificacampo(editCadastroCPF,"Preencha o CPF");
                    Verifica.verificacampo(editCadastroDia,"Preencha o dia");
                    Verifica.verificacampo(editCadastroMes,"Preencha o mês");
                    Verifica.verificacampo(editCadastroAno,"Preencha o ano");
                    Verifica.verificacampo(editCadastroEndereco,"Preencha o endereço");
                    Verifica.verificacampo(editCadastroNumero,"Preencha o numero");
                    Verifica.verificacampo(editCadastroBairro,"Preencha o bairro");
                    Verifica.verificacampo(editCadastroCidade,"Preencha o cidade");
                    Verifica.verificacampo(editCadastroUF,"Preencha a UF");
                    Verifica.verificacampo(editCadastroCEP,"Preencha o CEP");
                    Verifica.verificacampo(editCadastroEmail,"Preencha o email");
                    Verifica.verificacampo(editCadastroSenha,"Preencha a senha");
                    Verifica.verificacampo(editCadastroConfirmaSenha,"Preencha a confirmação de senha");

                    boolean cpf_valido = Verifica.verificacpf(editCadastroCPF.getText().toString());

                    //caso a validacao do CPF retorne false, apresentara a mensagem de cpf invalido para o usuario
                    if(!cpf_valido){
                        editCadastroCPF.setError("CPF inválido");
                        editCadastroCPF.setFocusable(true);
                        editCadastroCPF.requestFocus();
                    }

                    boolean email_valido = Verifica.verificaemail(editCadastroEmail.getText().toString());

                    //caso a validacao do email retorne false, apresentara a mensagem de email invalido para o usuario
                    if(!email_valido){
                        editCadastroEmail.setError("Email inválido");
                        editCadastroEmail.setFocusable(true);
                        editCadastroEmail.requestFocus();
                    }

                    //criando variaveis que serao utilizadas como parametros no link http e que recebem o dado informado nos campos do layout
                    String nome           = editCadastroNome.getText().toString();
                    String cpf            = editCadastroCPF.getText().toString();
                    String dia            = editCadastroDia.getText().toString();
                    String mes            = editCadastroMes.getText().toString();
                    String ano            = editCadastroAno.getText().toString();
                    int opcao             = radioSexoopcao.getCheckedRadioButtonId();
                    String endereco       = editCadastroEndereco.getText().toString();
                    String numero         = editCadastroNumero.getText().toString();
                    String bairro         = editCadastroBairro.getText().toString();
                    String cidade         = editCadastroCidade.getText().toString();
                    String uf             = editCadastroUF.getText().toString();
                    String cep            = editCadastroCEP.getText().toString();
                    String email          = editCadastroEmail.getText().toString();
                    String senha          = editCadastroSenha.getText().toString();
                    String confirmasenha = editCadastroConfirmaSenha.getText().toString();

                    String datnascimento = null;

                    String sexo;

                    //validacao para identificar qual radio button foi escolhido
                    if(opcao==R.id.radioButton_feminino)
                        sexo = "Feminino";
                    else
                    if(opcao==R.id.radioButton_masculino)
                        sexo = "Masculino";
                    else
                        sexo = "";

                    // reforçando a validacao se todos os campos foram preenchidos
                    if(nome.isEmpty() || !cpf_valido || dia.isEmpty() || mes.isEmpty() || ano.isEmpty() || sexo.isEmpty() || endereco.isEmpty() || numero.isEmpty() || bairro.isEmpty() || cidade.isEmpty()
                            || uf.isEmpty() || cep.isEmpty() || !email_valido || senha.isEmpty() || confirmasenha.isEmpty()) {
                        Toast.makeText(getApplicationContext(), "Campos não preenchidos", Toast.LENGTH_LONG).show();
                    }
                    //validacao para detectar se as senha e confirmacao de senha foram digitadas diferentes e assim apresentar mensagem de erro caso a condiçao retorne false
                    else if (!senha.equals(confirmasenha)){

                        editCadastroConfirmaSenha.setError("Senha diferente da informada");
                        editCadastroConfirmaSenha.setFocusable(true);
                        editCadastroConfirmaSenha.requestFocus();

                    }
                    //entrara neste else caso todos os campos estejam preenchidos corretamente
                    else{
                        //variavel que recebera a data de nascimento no formato AAAA-MM-DD para que a informacao seja gravada corretamento no banco de dado
                        datnascimento = ano+mes+dia;

                       //variavel de url que sera executada chamando o script de cadastro
                       //url = "http://172.20.10.2:80/login/cadastro.php";
                         url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/cadastro.php";

                        //variavel que recebera as demais variaveis que obtiveram as informacoes do layout de cadastro para montagem do link
                        parametros = "nome=" + nome + "&cpf=" + cpf + "&datnascimento=" + datnascimento + "&sexo=" + sexo + "&endereco=" + endereco +
                                     "&numero=" + numero + "&bairro=" + bairro + "&cidade=" + cidade + "&uf=" + uf + "&cep=" + cep + "&email=" + email +
                                     "&senha=" + senha + "&confirmasenha=" + confirmasenha;

                        //chamada da classe Solicita dados passando como parametro a url
                        new Cadastro.SolicitaDados().execute(url);
                    }

                }
                // caso nao encontre conexao com a rede, sera retornado a mensagem para o usuario
                else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }

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

            if(resultado.contains("email_erro")){
                Toast.makeText(getApplicationContext(), "Email já cadastrado!", Toast.LENGTH_LONG).show();

            }else if(resultado.contains("cpf_erro")){
                Toast.makeText(getApplicationContext(), "CPF já cadastrado!", Toast.LENGTH_LONG).show();

            }else if(resultado.contains("cadastro_ok")){
                Toast.makeText(getApplicationContext(), "Cadastrado com Sucesso!", Toast.LENGTH_LONG).show();

                Intent telalogin = new Intent(Cadastro.this, Login.class);
                startActivity(telalogin);

            }else {
                Toast.makeText(getApplicationContext(), "Falha no Cadastro, tente novamente!", Toast.LENGTH_LONG).show();
            }

        }

    }

    //metodo utilizado quando uma activity esta em modo de espera
    //como por exemplo: o usuario sair da tela do aplicativo, para fazer outra operaçao no celular
    protected void onPause() {
        super.onPause();
    }

}
