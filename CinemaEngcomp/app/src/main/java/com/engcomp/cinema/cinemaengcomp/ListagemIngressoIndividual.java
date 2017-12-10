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
import android.graphics.Bitmap;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.google.zxing.BarcodeFormat;
import com.google.zxing.MultiFormatWriter;
import com.google.zxing.WriterException;
import com.google.zxing.common.BitMatrix;
import com.journeyapps.barcodescanner.BarcodeEncoder;

public class ListagemIngressoIndividual extends Activity {

    String codigo_ingresso;
    String nome_cadeira;
    String qrcode_ingresso;
    String data_sessao;
    String horario_sessao;
    String codigo_sala;
    String tipo_sala;
    String nome_filme;
    ImageView ivQRCode;

    Button btdestravarpoltrona;

    String url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/botao_desbloquear.php";
    String parametros = "";

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.lista_ingresso_individual);

        ivQRCode = (ImageView) findViewById(R.id.ivQRCode);

        Intent i = getIntent();
        codigo_ingresso = i.getStringExtra("codigo_ingresso");
        nome_cadeira = i.getStringExtra("nome_cadeira");
        qrcode_ingresso = i.getStringExtra("qrcode_ingresso");
        data_sessao = i.getStringExtra("data_sessao");
        horario_sessao = i.getStringExtra("horario_sessao");
        codigo_sala = i.getStringExtra("codigo_sala");
        tipo_sala = i.getStringExtra("tipo_sala");
        nome_filme = i.getStringExtra("nome_filme");
        btdestravarpoltrona = (Button) findViewById(R.id.btdestravarpoltrona);

        TextView txtnome_cadeira = (TextView) findViewById(R.id.nome_cadeira);
        TextView txtdata_sessao = (TextView) findViewById(R.id.data_sessao);
        TextView txthorario_sessao = (TextView) findViewById(R.id.horario_sessao);
        TextView txtcodigo_sala = (TextView) findViewById(R.id.codigo_sala);
        TextView txttipo_sala = (TextView) findViewById(R.id.tipo_sala);
        TextView txtnome_filme = (TextView) findViewById(R.id.nome_filme);

        // Set results to the TextViews
        txtnome_cadeira.setText(nome_cadeira);
        txtdata_sessao.setText(data_sessao);
        txthorario_sessao.setText(horario_sessao);
        txtcodigo_sala.setText(codigo_sala);
        txttipo_sala.setText(tipo_sala);
        txtnome_filme.setText(nome_filme);


        MultiFormatWriter multiFormatWriter = new MultiFormatWriter();

        try{
            BitMatrix bitMatrix = multiFormatWriter.encode(qrcode_ingresso, BarcodeFormat.QR_CODE,650,650);
            BarcodeEncoder barcodeEncoder = new BarcodeEncoder();
            Bitmap bitmap = barcodeEncoder.createBitmap(bitMatrix);
            ivQRCode.setImageBitmap(bitmap);

        }catch(WriterException e){
            e.printStackTrace();
        }

        btdestravarpoltrona.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {

                ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
                if (networkInfo != null && networkInfo.isConnected()) {
                    parametros = "codigo_ingresso=" + codigo_ingresso;
                    new ListagemIngressoIndividual.SolicitaDados().execute(url);

                } else {
                    Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                }

            }
        });
    }

    private class SolicitaDados extends AsyncTask<String, Void, String> {

        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }

        protected void onPostExecute(String resultado) {

            Toast.makeText(getApplicationContext(), resultado, Toast.LENGTH_LONG).show();


        }

    }

}

