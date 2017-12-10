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
import android.content.Intent;
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

public class Estreias extends Activity {
    // Declarando variaveis
    JSONObject jsonobject;
    JSONArray jsonarray;
    ListView listview;
    ListViewAdapter2 adapter;
    ProgressDialog mProgressDialog;
    ArrayList<HashMap<String, String>> arraylist;
    static String NOME_FILME = "nome_filme";
    static String GENERO_FILME = "genero_filme";
    static String DURACAO_FILME = "duracao_filme";
    static String CLASSIFICACA0_FILME = "classificacao_filme";
    static String SINOPSE_FILME = "sinopse_filme";
    static String CAMINHO = "caminho";
    static String CODIGO_FILME = "codigo_filme";
    String email = "";

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.listview_main);
        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        email = bundle.getString("email");
        new DownloadJSON().execute();
    }

    // classe criada extendendo AsyncTask para fazer download do JSNON sem comprometer a activity
    private class DownloadJSON extends AsyncTask<Void, Void, Void> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            // Criando um ProgressDialog
            mProgressDialog = new ProgressDialog(Estreias.this);
            // Setando titulo ao ProgressDialog
            mProgressDialog.setTitle("Buscando Filmes...");
            // Setando mensagem ap ProgressDialog
            mProgressDialog.setMessage("Carregando...");
            mProgressDialog.setIndeterminate(false);
            // Apresentando em tela o ProgressDialog
            mProgressDialog.show();
        }

        @Override
        protected Void doInBackground(Void... params) {
            Intent intent = getIntent();
            Bundle bundle = intent.getExtras();
            email = bundle.getString("email");

            // criando array
            arraylist = new ArrayList<>();
            // Recupera objetos do JSON da url informada
            jsonobject = JSONfunctions
                    .getJSONfromURL("http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/busca_filmes_estreia.php");

            try {
                // Passando nome do array do json
                jsonarray = jsonobject.getJSONArray("filmes_estreias");

                for (int i = 0; i < jsonarray.length(); i++) {
                    HashMap<String, String> map = new HashMap<>();
                    jsonobject = jsonarray.getJSONObject(i);

                    // Recebendo os objetos do json
                    map.put("nome_filme", jsonobject.getString("nome_filme"));
                    map.put("genero_filme", jsonobject.getString("genero_filme"));
                    map.put("duracao_filme", jsonobject.getString("duracao_filme"));
                    map.put("classificacao_filme", jsonobject.getString("classificacao_filme"));
                    map.put("sinopse_filme", jsonobject.getString("sinopse_filme"));
                    map.put("caminho", jsonobject.getString("caminho"));
                    map.put("codigo_filme", jsonobject.getString("codigo_filme"));
                    map.put("email", email);
                    // Setando os objetos no array
                    arraylist.add(map);
                }
            } catch (JSONException e) {
                Log.e("Error", e.getMessage());
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void args) {
            if(arraylist.isEmpty()){
                Toast.makeText(getApplicationContext(), "Não existe nenhuma estréia hoje.", Toast.LENGTH_LONG).show();
                Intent telainicio = new Intent(Estreias.this, MenuCliente.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telainicio.putExtras(bundle);
                startActivity(telainicio);

            }else {
                // Localizando layout do listview
                listview = (ListView) findViewById(R.id.listview);
                // Passando os resultados para a classe ListViewAdapter2
                adapter = new ListViewAdapter2(Estreias.this, arraylist);
                // Setando o adapter para a listview
                listview.setAdapter(adapter);
                // Setando o adapter para a listview
                mProgressDialog.dismiss();


            }

        }
    }
}
