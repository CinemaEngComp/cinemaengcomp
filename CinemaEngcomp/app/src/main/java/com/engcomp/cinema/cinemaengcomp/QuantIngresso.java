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
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

public class QuantIngresso extends AppCompatActivity {

    TextView editQuantInteira,editQuantEstudante,editQuantIdoso;
    TextView totalingressos,valortotalingressos;

    Button menosinteira,maisinteira,menosestudante, maisestudante,menosidoso,maisidoso;

    Button btnvoltar, btnconfirmar;

    double valor_ingresso=35;

    String codigo_sessao="";
    String email="";

    String url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/busca_cadeira_sala.php";
    String parametros = "";

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.quant_ing);

        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        codigo_sessao = bundle.getString("cod_sessao");
        email = bundle.getString("email");

        editQuantInteira    = (TextView) findViewById(R.id.quant_inteira);
        editQuantEstudante  = (TextView) findViewById(R.id.quant_estudante);
        editQuantIdoso      = (TextView) findViewById(R.id.quant_idoso);
        editQuantInteira.setText("0");
        editQuantEstudante.setText("0");
        editQuantIdoso.setText("0");

        totalingressos      = (TextView) findViewById(R.id.total_ingressos);
        valortotalingressos = (TextView) findViewById(R.id.valor_totalingressos);
        totalingressos.setText("0");
        valortotalingressos.setText("R$ 00,00");

        menosinteira   = (Button) findViewById(R.id.menos_inteira);
        maisinteira    = (Button) findViewById(R.id.mais_inteira);
        menosestudante = (Button) findViewById(R.id.menos_estudante);
        maisestudante  = (Button) findViewById(R.id.mais_estudante);
        menosidoso     = (Button) findViewById(R.id.menos_idoso);
        maisidoso      = (Button) findViewById(R.id.mais_idoso);

        btnvoltar    = (Button) findViewById(R.id.botao_voltarsessao);
        btnconfirmar = (Button) findViewById(R.id.botao_confirmaringresso);

      menosinteira.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                if(Integer.parseInt(editQuantInteira.getText().toString())>0){
                    int valorinteira = Integer.parseInt(editQuantInteira.getText().toString())-1;
                    editQuantInteira.setText(""+valorinteira);

                    int valorestudante = Integer.parseInt(editQuantEstudante.getText().toString());
                    int valoridoso = Integer.parseInt(editQuantIdoso.getText().toString());

                    int quantingressos = valorinteira+valorestudante+valoridoso;
                    totalingressos.setText(""+quantingressos);
                    double valoringressos =  valor_ingresso*valorinteira + valor_ingresso*valorestudante/2 + valor_ingresso*valoridoso/2;
                    valortotalingressos.setText("R$ " + valoringressos+"0");
                }
            }
        });

     menosestudante.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                if(Integer.parseInt(editQuantEstudante.getText().toString())>0){
                    int valorestudante = Integer.parseInt(editQuantEstudante.getText().toString())-1;
                    editQuantEstudante.setText(""+valorestudante);

                    int valorinteira = Integer.parseInt(editQuantInteira.getText().toString());
                    int valoridoso = Integer.parseInt(editQuantIdoso.getText().toString());

                    int quantingressos = valorinteira+valorestudante+valoridoso;
                    totalingressos.setText(""+quantingressos);
                    double valoringressos =  valor_ingresso*valorinteira + valor_ingresso*valorestudante/2 + valor_ingresso*valoridoso/2;
                    valortotalingressos.setText("R$ " + valoringressos+"0");
                }
            }
        });

        menosidoso.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                if(Integer.parseInt(editQuantIdoso.getText().toString())>0){
                    int valoridoso = Integer.parseInt(editQuantIdoso.getText().toString())-1;
                    editQuantIdoso.setText(""+valoridoso);

                    int valorinteira = Integer.parseInt(editQuantInteira.getText().toString());
                    int valorestudante = Integer.parseInt(editQuantEstudante.getText().toString());

                    int quantingressos = valorinteira+valorestudante+valoridoso;
                    totalingressos.setText(""+quantingressos);
                    double valoringressos =  valor_ingresso*valorinteira + valor_ingresso*valorestudante/2 + valor_ingresso*valoridoso/2;
                    valortotalingressos.setText("R$ " + valoringressos+"0");
                }
            }
        });

        maisinteira.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                    int valorinteira = Integer.parseInt(editQuantInteira.getText().toString())+1;
                    editQuantInteira.setText(""+valorinteira);

                 int valorestudante = Integer.parseInt(editQuantEstudante.getText().toString());
                    int valoridoso = Integer.parseInt(editQuantIdoso.getText().toString());

                    int quantingressos = valorinteira+valorestudante+valoridoso;
                    totalingressos.setText(""+quantingressos);
                    double valoringressos =  valor_ingresso*valorinteira + valor_ingresso*valorestudante/2 + valor_ingresso*valoridoso/2;
                    valortotalingressos.setText("R$ " + valoringressos+"0");
            }
        });

        maisestudante.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                    int valorestudante = Integer.parseInt(editQuantEstudante.getText().toString())+1;
                    editQuantEstudante.setText(""+valorestudante);

                    int valorinteira = Integer.parseInt(editQuantInteira.getText().toString());
                    int valoridoso = Integer.parseInt(editQuantIdoso.getText().toString());

                    int quantingressos = valorinteira+valorestudante+valoridoso;
                    totalingressos.setText(""+quantingressos);
                    double valoringressos =  valor_ingresso*valorinteira + valor_ingresso*valorestudante/2 + valor_ingresso*valoridoso/2;
                    valortotalingressos.setText("R$ " + valoringressos+"0");
            }
        });

        maisidoso.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                    int valoridoso = Integer.parseInt(editQuantIdoso.getText().toString())+1;
                    editQuantIdoso.setText(""+valoridoso);

                    int valorinteira = Integer.parseInt(editQuantInteira.getText().toString());
                    int valorestudante = Integer.parseInt(editQuantEstudante.getText().toString());

                    int quantingressos = valorinteira+valorestudante+valoridoso;
                    totalingressos.setText(""+quantingressos);
                    double valoringressos =  valor_ingresso*valorinteira + valor_ingresso*valorestudante/2 + valor_ingresso*valoridoso/2;
                    valortotalingressos.setText("R$ " + valoringressos+"0");
            }
        });

        btnvoltar.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                Intent telainicio = new Intent(QuantIngresso.this, MenuCliente.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telainicio.putExtras(bundle);
                startActivity(telainicio);
            }
        });

        btnconfirmar.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                if(Integer.valueOf(totalingressos.getText().toString())==0){
                    Toast.makeText(getApplicationContext(), "O número mínimo de ingressos é 1.", Toast.LENGTH_LONG).show();
                }else if (Integer.valueOf(totalingressos.getText().toString())<7){
                    ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                    NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
                    if (networkInfo != null && networkInfo.isConnected()){
                        parametros = "codigo_sessao=" + codigo_sessao;
                        new QuantIngresso.SolicitaCadeiras().execute(url);
                    }
                    else {
                        Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                    }
                }else{
                    Toast.makeText(getApplicationContext(), "O número máximo de ingressos é 6.", Toast.LENGTH_LONG).show();
                }

            }

        });
    }

    private class SolicitaCadeiras extends AsyncTask<String, Void, String> {
        protected String doInBackground(String...urls){
            return Conexao.postDados(urls[0], parametros);
        }
        protected void onPostExecute(String resultado){
            Intent intent = new Intent(QuantIngresso.this, SelPoltronas.class);
            Bundle bundle = new Bundle();
            bundle.putString("cod_sessao", codigo_sessao);
            bundle.putString("quant_ingressos", totalingressos.getText().toString());
            bundle.putString("valor_ingressos", valortotalingressos.getText().toString());
            bundle.putString("quant_cadeiras", resultado);
            bundle.putString("email", email);
            intent.putExtras(bundle);
            startActivity(intent);

        }

    }

}
