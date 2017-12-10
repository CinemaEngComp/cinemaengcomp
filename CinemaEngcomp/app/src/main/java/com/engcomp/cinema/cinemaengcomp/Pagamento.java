//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

package com.engcomp.cinema.cinemaengcomp;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;


public class Pagamento extends Activity {

    TextView selecionadas, valor;
    EditText editnumero, editdigito, edittitular, editmes, editano;
    RadioGroup radiobandeira;
    Button btFinalizarCompra, btVoltarInicio;
    String codigo_sessao="", codigo_cadeiras="",email="",valor_ingressos="",cadeiras_selecionadas="";

    String url = "";
    String parametros = "";

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.pagamento);

        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        codigo_sessao = bundle.getString("codigo_sessao");
        codigo_cadeiras = bundle.getString("codigo_cadeiras");
        email = bundle.getString("email");
        valor_ingressos = bundle.getString("valoringressos");
        cadeiras_selecionadas = bundle.getString("cadeiras_selecionadas");

        selecionadas   = (TextView) findViewById(R.id.cadeiras_selecionadas);
        valor          = (TextView) findViewById(R.id.valor_ingressos);
        editnumero     = (EditText) findViewById(R.id.numero_cartao);
        editdigito     = (EditText) findViewById(R.id.numero_digito);
        edittitular    = (EditText) findViewById(R.id.nome_titular);
        editmes        = (EditText) findViewById(R.id.mes);
        editano        = (EditText) findViewById(R.id.ano);
        radiobandeira  = (RadioGroup) findViewById(R.id.radio_bandeira);

        btFinalizarCompra = (Button) findViewById(R.id.botao_finalizarcompra);
        btVoltarInicio    = (Button) findViewById(R.id.botao_voltarinicio);

        selecionadas.setText(cadeiras_selecionadas.trim().toUpperCase());
        valor.setText(valor_ingressos.trim());

        btVoltarInicio.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                Intent telainicio = new Intent(Pagamento.this, MenuCliente.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telainicio.putExtras(bundle);
                startActivity(telainicio);
            }
        });

        btFinalizarCompra.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){

                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

                if (networkInfo != null && networkInfo.isConnected()){

                    Verifica.verificacampo(editnumero,"Preencha o número do cartão.");
                    Verifica.verificacampo(editdigito,"Preencha o digito de segurança.");
                    Verifica.verificacampo(edittitular,"Preencha o nome do titular.");
                    Verifica.verificacampo(editmes,"Preencha o mês");
                    Verifica.verificacampo(editano,"Preencha o ano");

                    int opcao             = radiobandeira.getCheckedRadioButtonId();

                    String bandeira;

                    //validacao para identificar qual radio button foi escolhido
                    if(opcao==R.id.radioButton_master){
                        bandeira = "Master";
                    } else if (opcao==R.id.radioButton_visa){
                        bandeira = "Visa";
                    } else if (opcao==R.id.radioButton_elo){
                        bandeira = "Elo";
                    } else if (opcao==R.id.radioButton_american){
                        bandeira = "American";
                    } else{
                        bandeira = "";
                    }

                    if(editnumero.getText().toString().isEmpty() || editdigito.getText().toString().isEmpty() ||
                            edittitular.getText().toString().isEmpty() || editmes.getText().toString().isEmpty() ||
                            editano.getText().toString().isEmpty() || bandeira.isEmpty()) {
                        Toast.makeText(getApplicationContext(), "Campos não preenchidos", Toast.LENGTH_LONG).show();
                    } else{
                        url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/verifica_ingressos.php";
                        parametros = "codigo_sessao=" + codigo_sessao + "&codigos_cadeiras=" + codigo_cadeiras;
                        new Pagamento.VerificaCadeiras().execute(url);
                    }
                } else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }

            }
        });

    }

    private class VerificaCadeiras extends AsyncTask<String, Void, String> {
        protected String doInBackground(String...urls){
            return Conexao.postDados(urls[0], parametros);
        }
        protected void onPostExecute(String resultado){
            if(resultado.trim().equals("ok")==false){
                Toast.makeText(getApplicationContext(), resultado.trim(), Toast.LENGTH_LONG).show();
            }else {
                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
                if (networkInfo != null && networkInfo.isConnected()){

                        url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/efetua_compra.php";
                        parametros = "codigo_sessao=" + codigo_sessao.trim() + "&codigos_cadeiras=" + codigo_cadeiras.trim()+ "&email=" + email.trim();
                        new Pagamento.EfetuaCompra().execute(url);

                } else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }
            }

        }

    }

    private class EfetuaCompra extends AsyncTask<String, Void, String> {
        protected String doInBackground(String...urls){
            return Conexao.postDados(urls[0], parametros);
        }
        protected void onPostExecute(String resultado){
            if(resultado.trim().equals("compra_ok")==false){
                Toast.makeText(getApplicationContext(), "Ocorreu em sua compra, tente novamente.", Toast.LENGTH_LONG).show();
            }else {
                Toast.makeText(getApplicationContext(), "Compra realizada com sucesso.", Toast.LENGTH_LONG).show();
                Intent telainicio = new Intent(Pagamento.this, MenuCliente.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telainicio.putExtras(bundle);
                startActivity(telainicio);
            }

        }

    }

    protected void onPause() {
        super.onPause();
    }

}
