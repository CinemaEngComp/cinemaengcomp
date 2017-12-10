//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

/* *************************************************************************************************************************************************************************************************
* - Classe criada e adaptada, atraves do codigo de exemplo extraido da referencia abaixo:
*
* KHAN, B. Android QR Code Scanner Tutorial using Zxing Library. Disponível em: <https://www.simplifiedcoding.net/android-qr-code-scanner-tutorial/> Acesso em 12 de agosto de 2017.
*
************************************************************************************************************************************************************************************************* */

package com.engcomp.cinema.cinemaengcomp;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.res.Configuration;
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
import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;

public class LeitorQRCode extends AppCompatActivity implements View.OnClickListener {

    //View Objects
    private Button buttonScan;
    private TextView textViewIngresso, textViewNomeFilme, textViewTipoSala, textViewNomeCadeira, textViewHorarioSessao, textViewDataSessao, textViewCodigoSala;

    String  status_mensagem = "", codigo_ingresso = "";

    JSONObject jsonobject;
    JSONArray jsonarray;
    ArrayList<HashMap<String, String>> arraylist;

    ProgressDialog mProgressDialog;

    //qr code scanner object
    private IntentIntegrator qrScan;

    String url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/valida_ingresso.php";
    String parametros = "";

    @Override
    public void onConfigurationChanged(Configuration newConfig) {
        super.onConfigurationChanged(newConfig);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.leitor_qrcode);

        //View objects
        buttonScan = (Button) findViewById(R.id.buttonScan);
        textViewIngresso = (TextView) findViewById(R.id.codigo_ingresso);
        textViewNomeFilme = (TextView) findViewById(R.id.nome_filme);
        textViewTipoSala = (TextView) findViewById(R.id.tipo_sala);
        textViewNomeCadeira = (TextView) findViewById(R.id.nome_cadeira);
        textViewHorarioSessao = (TextView) findViewById(R.id.horario_sessao);
        textViewDataSessao = (TextView) findViewById(R.id.data_sessao);
        textViewCodigoSala = (TextView) findViewById(R.id.codigo_sala);

        //intializing scan object
        qrScan = new IntentIntegrator(this);
        qrScan.setBeepEnabled(false);

        //attaching onclick listener
        buttonScan.setOnClickListener(this);

    }

    //Getting the scan results
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        IntentResult result = IntentIntegrator.parseActivityResult(requestCode, resultCode, data);
        if (result != null) {
            //if qrcode has nothing in it
            if (result.getContents() == null) {
                Toast.makeText(this, "Nenhum resultado encontrado", Toast.LENGTH_LONG).show();
            } else {
                //if qr contains data
                try {
                    //converting the data to json
                    JSONObject obj = new JSONObject(result.getContents());
                    codigo_ingresso = (String) obj.get("Ingresso");

                } catch (JSONException e) {
                    e.printStackTrace();
                    //if control comes here
                    //that means the encoded format not matches
                    //in this case you can display whatever data is available on the qrcode
                    //to a toast
                    Toast.makeText(this, result.getContents(), Toast.LENGTH_LONG).show();
                }

                new validaingressos().onPostExecute();
            }
        } else {
            super.onActivityResult(requestCode, resultCode, data);
        }
    }

    @Override
    public void onClick(View view) {
        //initiating the qr code scan
        qrScan.initiateScan();
    }

    private class validaingressos {
        protected void onPostExecute() {
            ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
            if (networkInfo != null && networkInfo.isConnected()) {
                parametros = "codigo_ingresso=" + codigo_ingresso;
                new LeitorQRCode.SolicitaDados().execute(url);

            } else {
                Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
            }

        }
    }

    private class SolicitaDados extends AsyncTask<String, Void, String> {

        // metodo que captura a url enviada atraves do comando execute(url)
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }

        protected void onPostExecute(String resultado) {

            try {
                jsonobject = new JSONObject(resultado);
                jsonarray = jsonobject.getJSONArray("ingresso");

                for (int i = 0; i < jsonarray.length(); i++) {

                    jsonobject = jsonarray.getJSONObject(i);
                    textViewNomeFilme.setText(jsonobject.getString("nome_filme"));
                    textViewNomeCadeira.setText(jsonobject.getString("nome_cadeira"));
                    textViewTipoSala.setText(jsonobject.getString("tipo_sala"));
                    textViewIngresso.setText(jsonobject.getString("codigo_ingresso"));
                    textViewHorarioSessao.setText(jsonobject.getString("horario_sessao"));
                    textViewDataSessao.setText(jsonobject.getString("data_sessao"));
                    textViewCodigoSala.setText(jsonobject.getString("codigo_sala"));

                    if (jsonobject.getString("status_mensagem").trim().equals("ingresso_poltrona_ok")) {
                        Toast.makeText(getApplicationContext(), "Ingresso validado...Utilize o Botão " + "DESTRAVAR POLTRONA " +  "disponível na opção de menu: Meu Ingresso.", Toast.LENGTH_LONG).show();
                    } else if (jsonobject.getString("status_mensagem").trim().equals("sessao_encerrada")) {
                        Toast.makeText(getApplicationContext(), "Ingresso não validado!...Sessão já encerrada!", Toast.LENGTH_LONG).show();
                    } else if (jsonobject.getString("status_mensagem").trim().equals("sessao_nao_iniciada")) {
                        Toast.makeText(getApplicationContext(), "Ingresso não validado! A liberação é realizada 15 minutos antes do horário da sessão! Favor, verifique o horário e data da sessão do ingresso adquirido!", Toast.LENGTH_LONG).show();
                    }else{
                        Toast.makeText(getApplicationContext(), "Ocorreu um erro na validação. Favor, tentar mais tarde", Toast.LENGTH_LONG).show();

                    }
                }
            } catch (JSONException e) {
                Log.e("Error", e.getMessage());
                e.printStackTrace();
            }

        }

    }

}
