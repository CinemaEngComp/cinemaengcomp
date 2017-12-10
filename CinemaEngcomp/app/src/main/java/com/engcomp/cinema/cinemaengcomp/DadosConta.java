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
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;

public class DadosConta extends AppCompatActivity {

    TextView textview_contanome, textview_contacpf, textview_contadatanascimento, textview_contasexo, textview_contaendereco, textview_contabairro, textview_contacep, textview_contacidade, textview_contauf, textview_contaemail;
    Button btnvoltar;

    /* variaveis para montagem do link*/
    String url = "";
    String parametros = "";
    String email="";

    JSONObject jsonobject;
    JSONArray jsonarray;
    ArrayList<HashMap<String, String>> arraylist;
    HashMap<String, String> map;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.minhaconta);

        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        email = bundle.getString("email");

        /* inicializando variaveis*/
        textview_contanome           = (TextView) findViewById(R.id.textview_conta_nome);
        textview_contacpf            = (TextView) findViewById(R.id.textview_conta_cpf);
        textview_contadatanascimento = (TextView) findViewById(R.id.textview_conta_datanascimento);
        textview_contasexo           = (TextView) findViewById(R.id.textview_conta_sexo);
        textview_contaendereco       = (TextView) findViewById(R.id.textview_conta_endereco);
        textview_contabairro         = (TextView) findViewById(R.id.textview_conta_bairro);
        textview_contacep            = (TextView) findViewById(R.id.textview_conta_cep);
        textview_contacidade         = (TextView) findViewById(R.id.textview_conta_cidade);
        textview_contauf             = (TextView) findViewById(R.id.textview_conta_uf);
        textview_contaemail          = (TextView) findViewById(R.id.textview_conta_email);
        btnvoltar                    = (Button) findViewById(R.id.botao_voltar_inicio);

        new DadosConta.informacoesconta().onPostExecute();

        btnvoltar.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                Intent telainicio = new Intent(DadosConta.this, MenuCliente.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telainicio.putExtras(bundle);
                startActivity(telainicio);
            }
        });
    }

    private class informacoesconta{

        protected void onPostExecute(){
            ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
            if (networkInfo != null && networkInfo.isConnected()) {
                parametros = "email=" + email;
                url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/busca_cadastro.php";
                new DadosConta.SolicitaDados().execute(url);

            } else {
                Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
            }
        }
    }

    private class SolicitaDados extends AsyncTask<String, Void, String> {

        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }

        protected void onPostExecute(String resultado) {
                try {
                    jsonobject = new JSONObject(resultado);
                    jsonarray = jsonobject.getJSONArray("dadosconta");

                  for (int i = 0; i < jsonarray.length(); i++) {

                      jsonobject = jsonarray.getJSONObject(i);
                      textview_contanome.setText(jsonobject.getString("nome"));
                      textview_contacpf.setText(jsonobject.getString("cpf"));
                      textview_contadatanascimento.setText(jsonobject.getString("dat_nascimento"));
                      textview_contasexo.setText(jsonobject.getString("sexo"));
                      textview_contaendereco.setText(jsonobject.getString("endereco")+", "+ jsonobject.getString("numero"));
                      textview_contabairro.setText(jsonobject.getString("bairro"));
                      textview_contacep.setText(jsonobject.getString("cep"));
                      textview_contacidade.setText(jsonobject.getString("cidade"));
                      textview_contauf.setText(jsonobject.getString("uf"));
                      textview_contaemail.setText(jsonobject.getString("email"));
                    }
                } catch (JSONException e) {
                    Log.e("Error", e.getMessage());
                    e.printStackTrace();
                }



        }

    }



}
