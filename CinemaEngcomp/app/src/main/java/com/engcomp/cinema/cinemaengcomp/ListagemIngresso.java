//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

/* *************************************************************************************************************************************************************************************************
* - Classe criada e adaptada, atraves do codigo de exemplo extraido da referencia abaixo:
*
* ANDROIDBEGIN. Android JSON Parse Images and Texts Tutorial. Disponível em: <http://www.androidbegin.com/tutorial/android-json-parse-images-and-texts-tutorial/> Acesso em 05 de agosto de 2017.
*
************************************************************************************************************************************************************************************************* */

package com.engcomp.cinema.cinemaengcomp;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.ListView;
import android.widget.Toast;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;

public class ListagemIngresso extends Activity {

    // Declarando variaveis
    JSONObject jsonobject;
    JSONArray jsonarray;
    ListView listview;
    ListViewAdapterIngresso adapter;
    ProgressDialog mProgressDialog;
    ArrayList<HashMap<String, String>> arraylist;
    HashMap<String, String> map;

    static String CODIGO_INGRESSO = "codigo_ingresso";
    static String QRCODE_INGRESSO = "qrcode_ingresso";
    static String CPF_CLIENTE = "cpf_cliente";
    static String NOME_CADEIRA = "nome_cadeira";
    static String DATA_SESSAO = "data_sessao";
    static String HORARIO_SESSAO = "horario_sessao";
    static String CODIGO_SALA = "codigo_sala";
    static String TIPO_SALA = "tipo_sala";
    static String NOME_FILME = "nome_filme";
    String email = "";

    String url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/listagem_ingressos.php";
    String parametros = "";

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.lista_ingresso_main);
        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        email = bundle.getString("email");
        new buscaingressos().onPostExecute();
    }

    private class buscaingressos {
        protected void onPostExecute() {
            ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
            if (networkInfo != null && networkInfo.isConnected()) {
                parametros = "email=" + email;
                new ListagemIngresso.SolicitaDados().execute(url);

            } else {
                Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
            }

        }
    }

    private class SolicitaDados extends AsyncTask<String, Void, String> {


        protected void onPreExecute() {
            super.onPreExecute();
            mProgressDialog = new ProgressDialog(ListagemIngresso.this);
            mProgressDialog.setTitle("Buscando Ingressos...");
            mProgressDialog.setMessage("Carregando...");
            mProgressDialog.setIndeterminate(false);
            mProgressDialog.show();
        }

        // metodo que captura a url enviada atraves do comando execute(url)
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }


        protected void onPostExecute(String resultado) {

            if (resultado.contains("sem_ingresso")) {
                Toast.makeText(getApplicationContext(), "Não há ingressos comprados!", Toast.LENGTH_LONG).show();
                Intent telainicio = new Intent(ListagemIngresso.this, MenuCliente.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telainicio.putExtras(bundle);
                startActivity(telainicio);


            } else {

                try {
                    // criando array
                    arraylist = new ArrayList<>();

                    jsonobject = new JSONObject(resultado);
                    jsonarray = jsonobject.getJSONArray("lista_ingressos");

                    for (int i = 0; i < jsonarray.length(); i++) {
                        map = new HashMap<>();
                        jsonobject = jsonarray.getJSONObject(i);

                        map.put("codigo_ingresso", jsonobject.getString("codigo_ingresso"));
                        map.put("qrcode_ingresso", jsonobject.getString("qrcode_ingresso"));
                        map.put("cpf_cliente", jsonobject.getString("cpf_cliente"));
                        map.put("nome_cadeira", jsonobject.getString("nome_cadeira"));
                        map.put("data_sessao", jsonobject.getString("data_sessao"));
                        map.put("horario_sessao", jsonobject.getString("horario_sessao"));
                        map.put("codigo_sala", jsonobject.getString("codigo_sala"));
                        map.put("tipo_sala", jsonobject.getString("tipo_sala"));
                        map.put("nome_filme", jsonobject.getString("nome_filme"));

                        arraylist.add(map);
                    }

                } catch (JSONException e) {
                    Log.e("Error", e.getMessage());
                    e.printStackTrace();
                }

                // Localizando layout do listview
                listview = (ListView) findViewById(R.id.listview_ingresso);
                // Passando os resultados para a classe ListViewAdapterIngresso
                adapter = new ListViewAdapterIngresso(ListagemIngresso.this, arraylist);
                // Setando o adapter para a listview
                listview.setAdapter(adapter);
                // Fechando o ProgressDialog da tela
                mProgressDialog.dismiss();


            }
        }

    }

}
