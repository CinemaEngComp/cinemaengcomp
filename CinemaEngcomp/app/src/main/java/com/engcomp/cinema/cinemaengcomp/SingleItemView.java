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
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;

public class SingleItemView extends Activity {
    // Declarado variaveis
    String nome_filme;
    String genero_filme;
    String duracao_filme;
    String classificacao_filme;
    String sinopse_filme;
    String codigo_filme;
    String email = "";
    String dia1, dia2, dia3, dia4;
    String cod1, cod2, cod3, cod4, cod5;

    String caminho;
    ImageLoader imageLoader = new ImageLoader(this);

    Button btDia, btDia24, btDia48, btDia72;
    Button btsessao1, btsessao2, btsessao3, btsessao4, btsessao5;
    TextView sessoes;

    JSONObject jsonobject;
    JSONArray jsonarray;
    ArrayList<HashMap<String, String>> arraylist;
    HashMap<String, String> map;
    Context context;


    /* variaveis para montagem do link*/
    String url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/busca_sessoes.php";
    String parametros = "";

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // Get the view from singleitemview.xml
        setContentView(R.layout.singleitemview);

        Intent i = getIntent();
        // Get the result of nome_filme
        nome_filme = i.getStringExtra("nome_filme");
        genero_filme = i.getStringExtra("genero_filme");
        duracao_filme = i.getStringExtra("duracao_filme");
        classificacao_filme = i.getStringExtra("classificacao_filme");
        sinopse_filme = i.getStringExtra("sinopse_filme");
        caminho = i.getStringExtra("caminho");
        codigo_filme = i.getStringExtra("codigo_filme");
        email = i.getStringExtra("email");

        btDia = (Button) findViewById(R.id.botao_dia);
        btDia24 = (Button) findViewById(R.id.botao_dia_24);
        btDia48 = (Button) findViewById(R.id.botao_dia_48);
        btDia72 = (Button) findViewById(R.id.botao_dia_72);

        btsessao1 = (Button) findViewById(R.id.sessao_1);
        btsessao2 = (Button) findViewById(R.id.sessao_2);
        btsessao3 = (Button) findViewById(R.id.sessao_3);
        btsessao4 = (Button) findViewById(R.id.sessao_4);
        btsessao5 = (Button) findViewById(R.id.sessao_5);


        sessoes = (TextView) findViewById(R.id.sessoes);

        // Locate the TextViews in singleitemview.xml
        TextView txtnome_filme = (TextView) findViewById(R.id.nome_filme);
        TextView txtgenero_filme = (TextView) findViewById(R.id.genero_filme);
        TextView txtduracao_filme = (TextView) findViewById(R.id.duracao_filme);
        TextView txtclassificacao_filme = (TextView) findViewById(R.id.classificacao_filme);
        TextView txtsinopse_filme = (TextView) findViewById(R.id.sinopse_filme);
        ImageView imgcaminho = (ImageView) findViewById(R.id.caminho);

        // Set results to the TextViews
        txtnome_filme.setText(nome_filme);
        txtgenero_filme.setText(genero_filme);
        txtduracao_filme.setText(duracao_filme);
        txtclassificacao_filme.setText(classificacao_filme);
        txtsinopse_filme.setText(sinopse_filme);

        Calendar calendar = Calendar.getInstance();
        java.util.Date data = new Date();
        java.util.Date datanova;

        SimpleDateFormat sdf1 = new SimpleDateFormat("yyyyMMdd");
        for (int j = 0; j <= 3; j++) {
            calendar.setTime(data);
            if (j == 0) {
                btDia.setText(java.text.DateFormat.getDateInstance(DateFormat.MEDIUM).format(data));
                dia1 = sdf1.format(data);
            } else {
                calendar.add(Calendar.DAY_OF_MONTH, 1 * j);
                datanova = calendar.getTime();
                if (j == 1) {
                    btDia24.setText(java.text.DateFormat.getDateInstance(DateFormat.MEDIUM).format(datanova));
                    dia2 = sdf1.format(datanova);
                } else if (j == 2) {
                    btDia48.setText(java.text.DateFormat.getDateInstance(DateFormat.MEDIUM).format(datanova));
                    dia3 = sdf1.format(datanova);
                } else if (j == 3) {
                    btDia72.setText(java.text.DateFormat.getDateInstance(DateFormat.MEDIUM).format(datanova));
                    dia4 = sdf1.format(datanova);
                }
            }

        }


        btDia.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                sessoes.setVisibility(View.INVISIBLE);
                btsessao1.setEnabled(false);
                btsessao1.setVisibility(View.INVISIBLE);
                btsessao2.setEnabled(false);
                btsessao2.setVisibility(View.INVISIBLE);
                btsessao3.setEnabled(false);
                btsessao3.setVisibility(View.INVISIBLE);
                btsessao4.setEnabled(false);
                btsessao4.setVisibility(View.INVISIBLE);
                btsessao5.setEnabled(false);
                btsessao5.setVisibility(View.INVISIBLE);
                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
                if (networkInfo != null && networkInfo.isConnected()) {
                    parametros = "codigo_filme=" + codigo_filme + "&data_sessao=" + dia1;
                    new SingleItemView.SolicitaDados().execute(url);
                } else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }
            }
        });

        btDia24.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                sessoes.setVisibility(View.INVISIBLE);
                btsessao1.setEnabled(false);
                btsessao1.setVisibility(View.INVISIBLE);
                btsessao2.setEnabled(false);
                btsessao2.setVisibility(View.INVISIBLE);
                btsessao3.setEnabled(false);
                btsessao3.setVisibility(View.INVISIBLE);
                btsessao4.setEnabled(false);
                btsessao4.setVisibility(View.INVISIBLE);
                btsessao5.setEnabled(false);
                btsessao5.setVisibility(View.INVISIBLE);
                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
                if (networkInfo != null && networkInfo.isConnected()) {
                    parametros = "codigo_filme=" + codigo_filme + "&data_sessao=" + dia2;
                    new SingleItemView.SolicitaDados().execute(url);
                } else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }
            }
        });


        btDia48.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                sessoes.setVisibility(View.INVISIBLE);
                btsessao1.setEnabled(false);
                btsessao1.setVisibility(View.INVISIBLE);
                btsessao2.setEnabled(false);
                btsessao2.setVisibility(View.INVISIBLE);
                btsessao3.setEnabled(false);
                btsessao3.setVisibility(View.INVISIBLE);
                btsessao4.setEnabled(false);
                btsessao4.setVisibility(View.INVISIBLE);
                btsessao5.setEnabled(false);
                btsessao5.setVisibility(View.INVISIBLE);
                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
                if (networkInfo != null && networkInfo.isConnected()) {
                    parametros = "codigo_filme=" + codigo_filme + "&data_sessao=" + dia3;
                    new SingleItemView.SolicitaDados().execute(url);
                } else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }
            }
        });

        btDia72.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                sessoes.setVisibility(View.INVISIBLE);
                btsessao1.setEnabled(false);
                btsessao1.setVisibility(View.INVISIBLE);
                btsessao2.setEnabled(false);
                btsessao2.setVisibility(View.INVISIBLE);
                btsessao3.setEnabled(false);
                btsessao3.setVisibility(View.INVISIBLE);
                btsessao4.setEnabled(false);
                btsessao4.setVisibility(View.INVISIBLE);
                btsessao5.setEnabled(false);
                btsessao5.setVisibility(View.INVISIBLE);
                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
                if (networkInfo != null && networkInfo.isConnected()) {
                    parametros = "codigo_filme=" + codigo_filme + "&data_sessao=" + dia4;
                    new SingleItemView.SolicitaDados().execute(url);
                } else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }
            }
        });

        imageLoader.DisplayImage(caminho, imgcaminho);
    }

    private class SolicitaDados extends AsyncTask<String, Void, String> {

        // metodo que captura a url enviada atraves do comando execute(url)
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }

        //retorna os dados da conexao
        //este metodo recebe o retorno do onInBackground para que possamos trabalhar com os dados
        protected void onPostExecute(String resultado) {
            //retorno = resultado;
            if (resultado.trim().equals("sem_sessoes") == false) {
                try {
                    jsonobject = new JSONObject(resultado);
                    jsonarray = jsonobject.getJSONArray("sessoes");
                    for (int i = 0; i < jsonarray.length(); i++) {
                        map = new HashMap<>();
                        jsonobject = jsonarray.getJSONObject(i);
                        // Retrive JSON Objects
                        map.put("codigo_sala", jsonobject.getString("codigo_sala"));
                        map.put("codigo_filme", jsonobject.getString("codigo_filme"));
                        map.put("data_sessao", jsonobject.getString("data_sessao"));
                        map.put("horario_sessao", jsonobject.getString("horario_sessao"));
                        map.put("codigo", jsonobject.getString("codigo"));
                        arraylist.add(map);
                    }
                } catch (JSONException e) {
                    Log.e("Error", e.getMessage());
                    e.printStackTrace();
                }


                if (jsonarray.length() == 0) {
                    Toast.makeText(getApplicationContext(), "Nenhuma sessão para este dia.", Toast.LENGTH_LONG).show();
                } else {

                    for (int i = 0; i < jsonarray.length(); i++) {
                        sessoes.setVisibility(View.VISIBLE);
                        try {
                            jsonobject = jsonarray.getJSONObject(i);
                            if (i == 0) {
                                btsessao1.setEnabled(true);
                                btsessao1.setVisibility(View.VISIBLE);
                                btsessao1.setText(jsonobject.getString("horario_sessao"));
                                cod1 = jsonobject.getString("codigo_sessao");
                            } else if (i == 1) {
                                btsessao2.setEnabled(true);
                                btsessao2.setVisibility(View.VISIBLE);
                                btsessao2.setText(jsonobject.getString("horario_sessao"));
                                cod2 = jsonobject.getString("codigo_sessao");
                            } else if (i == 2) {
                                btsessao3.setEnabled(true);
                                btsessao3.setVisibility(View.VISIBLE);
                                btsessao3.setText(jsonobject.getString("horario_sessao"));
                                cod3 = jsonobject.getString("codigo_sessao");
                            } else if (i == 3) {
                                btsessao4.setEnabled(true);
                                btsessao4.setVisibility(View.VISIBLE);
                                btsessao4.setText(jsonobject.getString("horario_sessao"));
                                cod4 = jsonobject.getString("codigo_sessao");
                            } else if (i == 4) {
                                btsessao5.setEnabled(true);
                                btsessao5.setVisibility(View.VISIBLE);
                                btsessao5.setText(jsonobject.getString("horario_sessao"));
                                cod5 = jsonobject.getString("codigo_sessao");
                            }

                        } catch (JSONException e) {
                            Log.e("Error", e.getMessage());
                            e.printStackTrace();
                        }

                    }


                    btsessao1.setOnClickListener(new View.OnClickListener() {
                        public void onClick(View v) {
                            Intent intent = new Intent(SingleItemView.this, QuantIngresso.class);
                            Bundle bundle = new Bundle();
                            bundle.putString("cod_sessao", cod1);
                            bundle.putString("email", email);
                            intent.putExtras(bundle);
                            startActivity(intent);
                        }
                    });


                    btsessao2.setOnClickListener(new View.OnClickListener() {
                        public void onClick(View v) {
                            Intent intent = new Intent(SingleItemView.this, QuantIngresso.class);
                            Bundle bundle = new Bundle();
                            bundle.putString("cod_sessao", cod2);
                            bundle.putString("email", email);
                            intent.putExtras(bundle);
                            startActivity(intent);
                        }
                    });


                    btsessao3.setOnClickListener(new View.OnClickListener() {
                        public void onClick(View v) {
                            Intent intent = new Intent(SingleItemView.this, QuantIngresso.class);
                            Bundle bundle = new Bundle();
                            bundle.putString("cod_sessao", cod3);
                            bundle.putString("email", email);
                            intent.putExtras(bundle);
                            startActivity(intent);
                        }
                    });


                    btsessao4.setOnClickListener(new View.OnClickListener() {
                        public void onClick(View v) {
                            Intent intent = new Intent(SingleItemView.this, QuantIngresso.class);
                            Bundle bundle = new Bundle();
                            bundle.putString("cod_sessao", cod4);
                            bundle.putString("email", email);
                            intent.putExtras(bundle);
                            startActivity(intent);
                        }
                    });


                    btsessao5.setOnClickListener(new View.OnClickListener() {
                        public void onClick(View v) {
                            Intent intent = new Intent(SingleItemView.this, QuantIngresso.class);
                            Bundle bundle = new Bundle();
                            bundle.putString("cod_sessao", cod5);
                            bundle.putString("email", email);
                            intent.putExtras(bundle);
                            startActivity(intent);
                        }
                    });

                }

                jsonobject = new JSONObject();
                jsonarray = new JSONArray();


            }
            else {
                Toast.makeText(getApplicationContext(), "Nenhuma sessão para este dia.", Toast.LENGTH_LONG).show();
            }

        }

    }
}