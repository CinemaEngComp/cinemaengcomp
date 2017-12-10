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

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;
import java.util.ArrayList;
import java.util.HashMap;

class ListViewAdapterIngresso extends BaseAdapter {

    private Context context;
    private ArrayList<HashMap<String, String>> data;
    private HashMap<String, String> resultp = new HashMap<>();

    ListViewAdapterIngresso(Context context,
                    ArrayList<HashMap<String, String>> arraylist) {
        this.context = context;
        data = arraylist;
    }

    @Override
    public int getCount() {
        return data.size();
    }

    @Override
    public Object getItem(int position) {
        return null;
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    public View getView(final int position, View convertView, ViewGroup parent) {
        String codigo_ingresso;
        TextView qrcode_ingresso;
        TextView nome_cadeira;
        TextView data_sessao;
        TextView horario_sessao;
        TextView codigo_sala;
        TextView tipo_sala;
        TextView nome_filme;

        LayoutInflater inflater = (LayoutInflater) context
                .getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        View itemView1 = inflater.inflate(R.layout.lista_ingresso, parent, false);
        View itemView2 = inflater.inflate(R.layout.lista_ingresso_individual, parent, false);

        // Get the position
        resultp = data.get(position);

        nome_cadeira = (TextView) itemView2.findViewById(R.id.nome_cadeira);
        qrcode_ingresso = (TextView) itemView2.findViewById(R.id.qrcode_ingresso);
        data_sessao = (TextView) itemView1.findViewById(R.id.data_sessao);
        horario_sessao = (TextView) itemView1.findViewById(R.id.horario_sessao);
        codigo_sala = (TextView) itemView1.findViewById(R.id.codigo_sala);
        tipo_sala = (TextView) itemView1.findViewById(R.id.tipo_sala);
        nome_filme = (TextView) itemView1.findViewById(R.id.nome_filme);

        // Capture position and set results to the TextViews
        codigo_ingresso = resultp.get(ListagemIngresso.CODIGO_INGRESSO);
        nome_cadeira.setText(resultp.get(ListagemIngresso.NOME_CADEIRA));
        qrcode_ingresso.setText(resultp.get(ListagemIngresso.QRCODE_INGRESSO));
        qrcode_ingresso.setText(resultp.get(ListagemIngresso.QRCODE_INGRESSO));
        data_sessao.setText(resultp.get(ListagemIngresso.DATA_SESSAO));
        horario_sessao.setText(resultp.get(ListagemIngresso.HORARIO_SESSAO));
        codigo_sala.setText(resultp.get(ListagemIngresso.CODIGO_SALA));
        tipo_sala.setText(resultp.get(ListagemIngresso.TIPO_SALA));
        nome_filme.setText(resultp.get(ListagemIngresso.NOME_FILME));

        // Capture ListView item click
        itemView1.setOnClickListener(new OnClickListener() {

            @Override
            public void onClick(View arg0) {
                // Get the position
                resultp = data.get(position);
                Intent intent = new Intent(context, ListagemIngressoIndividual.class);
                intent.putExtra("codigo_ingresso", resultp.get(ListagemIngresso.CODIGO_INGRESSO));
                intent.putExtra("nome_cadeira", resultp.get(ListagemIngresso.NOME_CADEIRA));
                intent.putExtra("qrcode_ingresso", resultp.get(ListagemIngresso.QRCODE_INGRESSO));
                intent.putExtra("data_sessao", resultp.get(ListagemIngresso.DATA_SESSAO));
                intent.putExtra("horario_sessao", resultp.get(ListagemIngresso.HORARIO_SESSAO));
                intent.putExtra("codigo_sala", resultp.get(ListagemIngresso.CODIGO_SALA));
                intent.putExtra("tipo_sala", resultp.get(ListagemIngresso.TIPO_SALA));
                intent.putExtra("nome_filme", resultp.get(ListagemIngresso.NOME_FILME));
                intent.putExtra("email", resultp.get("email"));
                // Start ListagemIngressoIndividual Class
                context.startActivity(intent);

            }
        });
        return itemView1;
    }
}