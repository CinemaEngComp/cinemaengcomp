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
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.HashMap;

class ListViewAdapter3 extends BaseAdapter {

    // Declare Variables
    private Context context;
    private ArrayList<HashMap<String, String>> data;
    private ImageLoader imageLoader;
    private HashMap<String, String> resultp = new HashMap<>();

    ListViewAdapter3(Context context,
                     ArrayList<HashMap<String, String>> arraylist) {
        this.context = context;
        data = arraylist;
        imageLoader = new ImageLoader(context);
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
        // Declare Variables
        TextView nome_filme;
        TextView genero_filme;
        TextView duracao_filme;
        TextView classificacao_filme;
        TextView sinopse_filme;
        ImageView caminho;

        LayoutInflater inflater = (LayoutInflater) context
                .getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        View itemView1 = inflater.inflate(R.layout.listview_item, parent, false);
        View itemView2 = inflater.inflate(R.layout.singleitemview, parent, false);
        // Get the position
        resultp = data.get(position);

        // Locate the TextViews in listview_item.xml
        nome_filme = (TextView) itemView1.findViewById(R.id.nome_filme);
        genero_filme = (TextView) itemView2.findViewById(R.id.genero_filme);
        duracao_filme = (TextView) itemView2.findViewById(R.id.duracao_filme);
        classificacao_filme = (TextView) itemView2.findViewById(R.id.classificacao_filme);
        sinopse_filme = (TextView) itemView2.findViewById(R.id.sinopse_filme);


        // Locate the ImageView in listview_item.xml
        caminho = (ImageView) itemView1.findViewById(R.id.caminho);


        // Capture position and set results to the TextViews
        nome_filme.setText(resultp.get(Lancamentos.NOME_FILME));
        genero_filme.setText(resultp.get(Lancamentos.GENERO_FILME));
        duracao_filme.setText(resultp.get(Lancamentos.DURACAO_FILME));
        classificacao_filme.setText(resultp.get(Lancamentos.CLASSIFICACA0_FILME));
        sinopse_filme.setText(resultp.get(Lancamentos.SINOPSE_FILME));

        // Capture position and set results to the ImageView
        // Passes flag images URL into ImageLoader.class
        imageLoader.DisplayImage(resultp.get(Lancamentos.CAMINHO), caminho);
        // Capture ListView item click
        itemView1.setOnClickListener(new OnClickListener() {

            @Override
            public void onClick(View arg0) {
                // Get the position

                resultp = data.get(position);
                Intent intent = new Intent(context, SingleItemView.class);
                // Pass all data rank

                intent.putExtra("nome_filme", resultp.get(Lancamentos.NOME_FILME));
                intent.putExtra("genero_filme", resultp.get(Lancamentos.GENERO_FILME));
                intent.putExtra("duracao_filme", resultp.get(Lancamentos.DURACAO_FILME));
                intent.putExtra("classificacao_filme", resultp.get(Lancamentos.CLASSIFICACA0_FILME));
                intent.putExtra("sinopse_filme", resultp.get(Lancamentos.SINOPSE_FILME));
                intent.putExtra("email", resultp.get("email"));
                // Pass all data flag
                intent.putExtra("caminho", resultp.get(Lancamentos.CAMINHO));
                intent.putExtra("codigo_filme", resultp.get(Lancamentos.CODIGO_FILME));
                // Start SingleItemView Class
                context.startActivity(intent);

            }
        });
        return itemView1;
    }
}