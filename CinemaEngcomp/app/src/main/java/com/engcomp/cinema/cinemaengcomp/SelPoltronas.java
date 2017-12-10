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
import android.os.Build;
import android.os.Bundle;
import android.support.annotation.RequiresApi;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;

@RequiresApi(api = Build.VERSION_CODES.LOLLIPOP)

public class SelPoltronas extends Activity {

    ImageView a1, a2, a3, a4, a5, a6, a7, a8, a9, a10;
    ImageView b1, b2, b3, b4, b5, b6, b7, b8, b9, b10;
    ImageView c1, c2, c3, c4, c5, c6, c7, c8, c9, c10;
    ImageView d1, d2, d3, d4, d5, d6, d7, d8, d9, d10;
    ImageView e1, e2, e3, e4, e5, e6, e7, e8, e9, e10;
    ImageView f1, f2, f3, f4, f5, f6, f7, f8, f9, f10;
    ImageView g1, g2, g3, g4, g5, g6, g7, g8, g9, g10;
    ImageView h1, h2, h3, h4, h5, h6, h7, h8, h9, h10;
    ImageView i1, i2, i3, i4, i5, i6, i7, i8, i9, i10;
    ImageView j1, j2, j3, j4, j5, j6, j7, j8, j9, j10;

    Button btnconfirmar, btnvoltar;

    int contadorselecionadas=0;
    String selecionadas="";

    String codigo_sessao="",totalingressos="",valortotalingressos="",quantidade_cadeiras="",email="", codigos_cadeiras="";

    String url = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/busca_cadeiras_ingressos.php";
    String url2 = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/busca_codigo_cadeira.php";
    String url3 = "http://cinemaengcomp.nucci.com.br/cinemaengcomp/PHP/verifica_ingressos.php";
    String parametros = "", parametros2 = "", parametros3 = "";

    JSONObject jsonobject;
    JSONArray jsonarray;
    ArrayList<HashMap<String, String>> arraylist;
    HashMap<String, String> map;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sel_polt);

        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        codigo_sessao = bundle.getString("cod_sessao");
        totalingressos = bundle.getString("quant_ingressos");
        valortotalingressos = bundle.getString("valor_ingressos");
        email = bundle.getString("email");
        quantidade_cadeiras = bundle.getString("quant_cadeiras");
        a1         = (ImageView) findViewById(R.id.a1);
        a2         = (ImageView) findViewById(R.id.a2);
        a3         = (ImageView) findViewById(R.id.a3);
        a4         = (ImageView) findViewById(R.id.a4);
        a5         = (ImageView) findViewById(R.id.a5);
        a6         = (ImageView) findViewById(R.id.a6);
        a7         = (ImageView) findViewById(R.id.a7);
        a8         = (ImageView) findViewById(R.id.a8);
        a9         = (ImageView) findViewById(R.id.a9);
        a10        = (ImageView) findViewById(R.id.a10);
        b1         = (ImageView) findViewById(R.id.b1);
        b2         = (ImageView) findViewById(R.id.b2);
        b3         = (ImageView) findViewById(R.id.b3);
        b4         = (ImageView) findViewById(R.id.b4);
        b5         = (ImageView) findViewById(R.id.b5);
        b6         = (ImageView) findViewById(R.id.b6);
        b7         = (ImageView) findViewById(R.id.b7);
        b8         = (ImageView) findViewById(R.id.b8);
        b9         = (ImageView) findViewById(R.id.b9);
        b10        = (ImageView) findViewById(R.id.b10);
        c1         = (ImageView) findViewById(R.id.c1);
        c2         = (ImageView) findViewById(R.id.c2);
        c3         = (ImageView) findViewById(R.id.c3);
        c4         = (ImageView) findViewById(R.id.c4);
        c5         = (ImageView) findViewById(R.id.c5);
        c6         = (ImageView) findViewById(R.id.c6);
        c7         = (ImageView) findViewById(R.id.c7);
        c8         = (ImageView) findViewById(R.id.c8);
        c9         = (ImageView) findViewById(R.id.c9);
        c10        = (ImageView) findViewById(R.id.c10);
        d1         = (ImageView) findViewById(R.id.d1);
        d2         = (ImageView) findViewById(R.id.d2);
        d3         = (ImageView) findViewById(R.id.d3);
        d4         = (ImageView) findViewById(R.id.d4);
        d5         = (ImageView) findViewById(R.id.d5);
        d6         = (ImageView) findViewById(R.id.d6);
        d7         = (ImageView) findViewById(R.id.d7);
        d8         = (ImageView) findViewById(R.id.d8);
        d9         = (ImageView) findViewById(R.id.d9);
        d10        = (ImageView) findViewById(R.id.d10);
        e1         = (ImageView) findViewById(R.id.e1);
        e2         = (ImageView) findViewById(R.id.e2);
        e3         = (ImageView) findViewById(R.id.e3);
        e4         = (ImageView) findViewById(R.id.e4);
        e5         = (ImageView) findViewById(R.id.e5);
        e6         = (ImageView) findViewById(R.id.e6);
        e7         = (ImageView) findViewById(R.id.e7);
        e8         = (ImageView) findViewById(R.id.e8);
        e9         = (ImageView) findViewById(R.id.e9);
        e10        = (ImageView) findViewById(R.id.e10);
        f1         = (ImageView) findViewById(R.id.f1);
        f2         = (ImageView) findViewById(R.id.f2);
        f3         = (ImageView) findViewById(R.id.f3);
        f4         = (ImageView) findViewById(R.id.f4);
        f5         = (ImageView) findViewById(R.id.f5);
        f6         = (ImageView) findViewById(R.id.f6);
        f7         = (ImageView) findViewById(R.id.f7);
        f8         = (ImageView) findViewById(R.id.f8);
        f9         = (ImageView) findViewById(R.id.f9);
        f10        = (ImageView) findViewById(R.id.f10);
        g1         = (ImageView) findViewById(R.id.g1);
        g2         = (ImageView) findViewById(R.id.g2);
        g3         = (ImageView) findViewById(R.id.g3);
        g4         = (ImageView) findViewById(R.id.g4);
        g5         = (ImageView) findViewById(R.id.g5);
        g6         = (ImageView) findViewById(R.id.g6);
        g7         = (ImageView) findViewById(R.id.g7);
        g8         = (ImageView) findViewById(R.id.g8);
        g9         = (ImageView) findViewById(R.id.g9);
        g10        = (ImageView) findViewById(R.id.g10);
        h1         = (ImageView) findViewById(R.id.h1);
        h2         = (ImageView) findViewById(R.id.h2);
        h3         = (ImageView) findViewById(R.id.h3);
        h4         = (ImageView) findViewById(R.id.h4);
        h5         = (ImageView) findViewById(R.id.h5);
        h6         = (ImageView) findViewById(R.id.h6);
        h7         = (ImageView) findViewById(R.id.h7);
        h8         = (ImageView) findViewById(R.id.h8);
        h9         = (ImageView) findViewById(R.id.h9);
        h10        = (ImageView) findViewById(R.id.h10);
        i1         = (ImageView) findViewById(R.id.i1);
        i2         = (ImageView) findViewById(R.id.i2);
        i3         = (ImageView) findViewById(R.id.i3);
        i4         = (ImageView) findViewById(R.id.i4);
        i5         = (ImageView) findViewById(R.id.i5);
        i6         = (ImageView) findViewById(R.id.i6);
        i7         = (ImageView) findViewById(R.id.i7);
        i8         = (ImageView) findViewById(R.id.i8);
        i9         = (ImageView) findViewById(R.id.i9);
        i10        = (ImageView) findViewById(R.id.i10);
        j1         = (ImageView) findViewById(R.id.j1);
        j2         = (ImageView) findViewById(R.id.j2);
        j3         = (ImageView) findViewById(R.id.j3);
        j4         = (ImageView) findViewById(R.id.j4);
        j5         = (ImageView) findViewById(R.id.j5);
        j6         = (ImageView) findViewById(R.id.j6);
        j7         = (ImageView) findViewById(R.id.j7);
        j8         = (ImageView) findViewById(R.id.j8);
        j9         = (ImageView) findViewById(R.id.j9);
        j10        = (ImageView) findViewById(R.id.j10);

        btnvoltar    = (Button) findViewById(R.id.botao_voltaringresso);
        btnconfirmar = (Button) findViewById(R.id.botao_confirmarassento);

        for(int i=1;i<=Integer.parseInt(quantidade_cadeiras.trim());i++){
            if (i==1){
                a1.setVisibility(View.VISIBLE);
                a1.setEnabled(true);
            } else if(i==2){
                a2.setVisibility(View.VISIBLE);
                a2.setEnabled(true);
            } else if(i==3){
                a3.setVisibility(View.VISIBLE);
                a3.setEnabled(true);
            } else if(i==4){
                a4.setVisibility(View.VISIBLE);
                a4.setEnabled(true);
            } else if(i==5){
                a5.setVisibility(View.VISIBLE);
                a5.setEnabled(true);
            } else if(i==6){
                a6.setVisibility(View.VISIBLE);
                a6.setEnabled(true);
            }  else if(i==7){
                a7.setVisibility(View.VISIBLE);
                a7.setEnabled(true);
            } else if(i==8){
                a8.setVisibility(View.VISIBLE);
                a8.setEnabled(true);
            } else if(i==9){
                a9.setVisibility(View.VISIBLE);
                a9.setEnabled(true);
            } else if(i==10){
                a10.setVisibility(View.VISIBLE);
                a10.setEnabled(true);
            } else if(i==11){
                b1.setVisibility(View.VISIBLE);
                b1.setEnabled(true);
            } else if(i==12){
                b2.setVisibility(View.VISIBLE);
                b2.setEnabled(true);
            } else if(i==13){
                b3.setVisibility(View.VISIBLE);
                b3.setEnabled(true);
            } else if(i==14){
                b4.setVisibility(View.VISIBLE);
                b4.setEnabled(true);
            } else if(i==15){
                b5.setVisibility(View.VISIBLE);
                b5.setEnabled(true);
            } else if(i==16){
                b6.setVisibility(View.VISIBLE);
                b6.setEnabled(true);
            } else if(i==17){
                b7.setVisibility(View.VISIBLE);
                b7.setEnabled(true);
            } else if(i==18){
                b8.setVisibility(View.VISIBLE);
                b8.setEnabled(true);
            } else if(i==19){
                b9.setVisibility(View.VISIBLE);
                b9.setEnabled(true);
            } else if(i==20){
                b10.setVisibility(View.VISIBLE);
                b10.setEnabled(true);
            } else if(i==21){
                c1.setVisibility(View.VISIBLE);
                c1.setEnabled(true);
            } else if(i==22){
                c2.setVisibility(View.VISIBLE);
                c2.setEnabled(true);
            } else if(i==23){
                c3.setVisibility(View.VISIBLE);
                c3.setEnabled(true);
            } else if(i==24){
                c4.setVisibility(View.VISIBLE);
                c4.setEnabled(true);
            } else if(i==25){
                c5.setVisibility(View.VISIBLE);
                c5.setEnabled(true);
            } else if(i==26){
                c6.setVisibility(View.VISIBLE);
                c6.setEnabled(true);
            } else if(i==27){
                c7.setVisibility(View.VISIBLE);
                c7.setEnabled(true);
            } else if(i==28){
                c8.setVisibility(View.VISIBLE);
                c8.setEnabled(true);
            } else if(i==29){
                c9.setVisibility(View.VISIBLE);
                c9.setEnabled(true);
            } else if(i==30){
                c10.setVisibility(View.VISIBLE);
                c10.setEnabled(true);
            } else if(i==31){
                d1.setVisibility(View.VISIBLE);
                d1.setEnabled(true);
            } else if(i==32){
                d2.setVisibility(View.VISIBLE);
                d2.setEnabled(true);
            } else if(i==33){
                d3.setVisibility(View.VISIBLE);
                d3.setEnabled(true);
            } else if(i==34){
                d4.setVisibility(View.VISIBLE);
                d4.setEnabled(true);
            } else if(i==35){
                d5.setVisibility(View.VISIBLE);
                d5.setEnabled(true);
            } else if(i==36){
                d6.setVisibility(View.VISIBLE);
                d6.setEnabled(true);
            } else if(i==37){
                d7.setVisibility(View.VISIBLE);
                d7.setEnabled(true);
            } else if(i==38){
                d8.setVisibility(View.VISIBLE);
                d8.setEnabled(true);
            } else if(i==39){
                d9.setVisibility(View.VISIBLE);
                d9.setEnabled(true);
            } else if(i==40){
                d10.setVisibility(View.VISIBLE);
                d10.setEnabled(true);
            } else if(i==41){
                e1.setVisibility(View.VISIBLE);
                e1.setEnabled(true);
            } else if(i==42){
                e2.setVisibility(View.VISIBLE);
                e2.setEnabled(true);
            } else if(i==43){
                e3.setVisibility(View.VISIBLE);
                e3.setEnabled(true);
            } else if(i==44){
                e4.setVisibility(View.VISIBLE);
                e4.setEnabled(true);
            } else if(i==45){
                e5.setVisibility(View.VISIBLE);
                e5.setEnabled(true);
            } else if(i==46){
                e6.setVisibility(View.VISIBLE);
                e6.setEnabled(true);
            } else if(i==47){
                e7.setVisibility(View.VISIBLE);
                e7.setEnabled(true);
            } else if(i==48){
                e8.setVisibility(View.VISIBLE);
                e8.setEnabled(true);
            } else if(i==49){
                e9.setVisibility(View.VISIBLE);
                e9.setEnabled(true);
            } else if(i==50){
                e10.setVisibility(View.VISIBLE);
                e10.setEnabled(true);
            } else if(i==51){
                f1.setVisibility(View.VISIBLE);
                f1.setEnabled(true);
            } else if(i==52){
                f2.setVisibility(View.VISIBLE);
                f2.setEnabled(true);
            } else if(i==53){
                f3.setVisibility(View.VISIBLE);
                f3.setEnabled(true);
            } else if(i==54){
                f4.setVisibility(View.VISIBLE);
                f4.setEnabled(true);
            } else if(i==55){
                f5.setVisibility(View.VISIBLE);
                f5.setEnabled(true);
            } else if(i==56){
                f6.setVisibility(View.VISIBLE);
                f6.setEnabled(true);
            } else if(i==57){
                f7.setVisibility(View.VISIBLE);
                f7.setEnabled(true);
            } else if(i==58){
                f8.setVisibility(View.VISIBLE);
                f8.setEnabled(true);
            } else if(i==59){
                f9.setVisibility(View.VISIBLE);
                f9.setEnabled(true);
            } else if(i==60){
                f10.setVisibility(View.VISIBLE);
                f10.setEnabled(true);
            } else if(i==61){
                g1.setVisibility(View.VISIBLE);
                g1.setEnabled(true);
            } else if(i==62){
                g2.setVisibility(View.VISIBLE);
                g2.setEnabled(true);
            } else if(i==63){
                g3.setVisibility(View.VISIBLE);
                g3.setEnabled(true);
            } else if(i==64){
                g4.setVisibility(View.VISIBLE);
                g4.setEnabled(true);
            } else if(i==65){
                g5.setVisibility(View.VISIBLE);
                g5.setEnabled(true);
            } else if(i==66){
                g6.setVisibility(View.VISIBLE);
                g6.setEnabled(true);
            } else if(i==67){
                g7.setVisibility(View.VISIBLE);
                g7.setEnabled(true);
            } else if(i==68){
                g8.setVisibility(View.VISIBLE);
                g8.setEnabled(true);
            } else if(i==69){
                g9.setVisibility(View.VISIBLE);
                g9.setEnabled(true);
            } else if(i==70){
                g10.setVisibility(View.VISIBLE);
                g10.setEnabled(true);
            } else if(i==71){
                h1.setVisibility(View.VISIBLE);
                h1.setEnabled(true);
            } else if(i==72){
                h2.setVisibility(View.VISIBLE);
                h2.setEnabled(true);
            } else if(i==73){
                h3.setVisibility(View.VISIBLE);
                h3.setEnabled(true);
            } else if(i==74){
                h4.setVisibility(View.VISIBLE);
                h4.setEnabled(true);
            } else if(i==75){
                h5.setVisibility(View.VISIBLE);
                h5.setEnabled(true);
            } else if(i==76){
                h6.setVisibility(View.VISIBLE);
                h6.setEnabled(true);
            } else if(i==77){
                h7.setVisibility(View.VISIBLE);
                h7.setEnabled(true);
            } else if(i==78){
                h8.setVisibility(View.VISIBLE);
                h8.setEnabled(true);
            } else if(i==79){
                h9.setVisibility(View.VISIBLE);
                h9.setEnabled(true);
            } else if(i==80){
                h10.setVisibility(View.VISIBLE);
                h10.setEnabled(true);
            } else if(i==81){
                i1.setVisibility(View.VISIBLE);
                i1.setEnabled(true);
            } else if(i==82){
                i2.setVisibility(View.VISIBLE);
                i2.setEnabled(true);
            } else if(i==83){
                i3.setVisibility(View.VISIBLE);
                i3.setEnabled(true);
            } else if(i==84){
                i4.setVisibility(View.VISIBLE);
                i4.setEnabled(true);
            } else if(i==85){
                i5.setVisibility(View.VISIBLE);
                i5.setEnabled(true);
            } else if(i==86){
                i6.setVisibility(View.VISIBLE);
                i6.setEnabled(true);
            } else if(i==87){
                i7.setVisibility(View.VISIBLE);
                i7.setEnabled(true);
            } else if(i==88){
                i8.setVisibility(View.VISIBLE);
                i8.setEnabled(true);
            } else if(i==89){
                i9.setVisibility(View.VISIBLE);
                i9.setEnabled(true);
            } else if(i==90){
                i10.setVisibility(View.VISIBLE);
                i10.setEnabled(true);
            } else if(i==91){
                j1.setVisibility(View.VISIBLE);
                j1.setEnabled(true);
            } else if(i==92){
                j2.setVisibility(View.VISIBLE);
                j2.setEnabled(true);
            } else if(i==93){
                j3.setVisibility(View.VISIBLE);
                j3.setEnabled(true);
            } else if(i==94){
                j4.setVisibility(View.VISIBLE);
                j4.setEnabled(true);
            } else if(i==95){
                j5.setVisibility(View.VISIBLE);
                j5.setEnabled(true);
            } else if(i==96){
                j6.setVisibility(View.VISIBLE);
                j6.setEnabled(true);
            } else if(i==97){
                j7.setVisibility(View.VISIBLE);
                j7.setEnabled(true);
            } else if(i==98){
                j8.setVisibility(View.VISIBLE);
                j8.setEnabled(true);
            } else if(i==99){
                j9.setVisibility(View.VISIBLE);
                j9.setEnabled(true);
            } else if(i==100){
                j10.setVisibility(View.VISIBLE);
                j10.setEnabled(true);
            }
        }

        new montagemsala().onPostExecute();

        a1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(a1.getTransitionName().equals("verde")){
                    a1.setTransitionName("cinza");
                    a1.setImageResource(R.mipmap.cinza);
                }else{
                    a1.setTransitionName("verde");
                    a1.setImageResource(R.mipmap.verde);
                }
            }
        });
        a2.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                if(a2.getTransitionName().equals("verde")){
                    a2.setTransitionName("cinza");
                    a2.setImageResource(R.mipmap.cinza);
                }else{
                    a2.setTransitionName("verde");
                    a2.setImageResource(R.mipmap.verde);
                }
            }
        });
        a3.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                if(a3.getTransitionName().equals("verde")){
                    a3.setTransitionName("cinza");
                    a3.setImageResource(R.mipmap.cinza);
                }else{
                    a3.setTransitionName("verde");
                    a3.setImageResource(R.mipmap.verde);
                }
            }
        });
        a4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(a4.getTransitionName().equals("verde")){
                    a4.setTransitionName("cinza");
                    a4.setImageResource(R.mipmap.cinza);
                }else{
                    a4.setTransitionName("verde");
                    a4.setImageResource(R.mipmap.verde);
                }
            }
        });
        a5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(a5.getTransitionName().equals("verde")){
                    a5.setTransitionName("cinza");
                    a5.setImageResource(R.mipmap.cinza);
                }else{
                    a5.setTransitionName("verde");
                    a5.setImageResource(R.mipmap.verde);
                }
            }
        });
        a6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(a6.getTransitionName().equals("verde")){
                    a6.setTransitionName("cinza");
                    a6.setImageResource(R.mipmap.cinza);
                }else{
                    a6.setTransitionName("verde");
                    a6.setImageResource(R.mipmap.verde);
                }
            }
        });
        a7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(a7.getTransitionName().equals("verde")){
                    a7.setTransitionName("cinza");
                    a7.setImageResource(R.mipmap.cinza);
                }else{
                    a7.setTransitionName("verde");
                    a7.setImageResource(R.mipmap.verde);
                }
            }
        });
        a8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(a8.getTransitionName().equals("verde")){
                    a8.setTransitionName("cinza");
                    a8.setImageResource(R.mipmap.cinza);
                }else{
                    a8.setTransitionName("verde");
                    a8.setImageResource(R.mipmap.verde);
                }
            }
        });
        a9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(a9.getTransitionName().equals("verde")){
                    a9.setTransitionName("cinza");
                    a9.setImageResource(R.mipmap.cinza);
                }else{
                    a9.setTransitionName("verde");
                    a9.setImageResource(R.mipmap.verde);
                }
            }
        });
        a10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(a10.getTransitionName().equals("verde")){
                    a10.setTransitionName("cinza");
                    a10.setImageResource(R.mipmap.cinza);
                }else{
                    a10.setTransitionName("verde");
                    a10.setImageResource(R.mipmap.verde);
                }
            }
        });
        b1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b1.getTransitionName().equals("verde")){
                    b1.setTransitionName("cinza");
                    b1.setImageResource(R.mipmap.cinza);
                }else{
                    b1.setTransitionName("verde");
                    b1.setImageResource(R.mipmap.verde);
                }
            }
        });
        b2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b2.getTransitionName().equals("verde")){
                    b2.setTransitionName("cinza");
                    b2.setImageResource(R.mipmap.cinza);
                }else{
                    b2.setTransitionName("verde");
                    b2.setImageResource(R.mipmap.verde);
                }
            }
        });
        b3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b3.getTransitionName().equals("verde")){
                    b3.setTransitionName("cinza");
                    b3.setImageResource(R.mipmap.cinza);
                }else{
                    b3.setTransitionName("verde");
                    b3.setImageResource(R.mipmap.verde);
                }
            }
        });
        b4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b4.getTransitionName().equals("verde")){
                    b4.setTransitionName("cinza");
                    b4.setImageResource(R.mipmap.cinza);
                }else{
                    b4.setTransitionName("verde");
                    b4.setImageResource(R.mipmap.verde);
                }
            }
        });
        b5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b5.getTransitionName().equals("verde")){
                    b5.setTransitionName("cinza");
                    b5.setImageResource(R.mipmap.cinza);
                }else{
                    b5.setTransitionName("verde");
                    b5.setImageResource(R.mipmap.verde);
                }
            }
        });
        b6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b6.getTransitionName().equals("verde")){
                    b6.setTransitionName("cinza");
                    b6.setImageResource(R.mipmap.cinza);
                }else{
                    b6.setTransitionName("verde");
                    b6.setImageResource(R.mipmap.verde);
                }
            }
        });
        b7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b7.getTransitionName().equals("verde")){
                    b7.setTransitionName("cinza");
                    b7.setImageResource(R.mipmap.cinza);
                }else{
                    b7.setTransitionName("verde");
                    b7.setImageResource(R.mipmap.verde);
                }
            }
        });
        b8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b8.getTransitionName().equals("verde")){
                    b8.setTransitionName("cinza");
                    b8.setImageResource(R.mipmap.cinza);
                }else{
                    b8.setTransitionName("verde");
                    b8.setImageResource(R.mipmap.verde);
                }
            }
        });
        b9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b9.getTransitionName().equals("verde")){
                    b9.setTransitionName("cinza");
                    b9.setImageResource(R.mipmap.cinza);
                }else{
                    b9.setTransitionName("verde");
                    b9.setImageResource(R.mipmap.verde);
                }
            }
        });
        b10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(b10.getTransitionName().equals("verde")){
                    b10.setTransitionName("cinza");
                    b10.setImageResource(R.mipmap.cinza);
                }else{
                    b10.setTransitionName("verde");
                    b10.setImageResource(R.mipmap.verde);
                }
            }
        });
        c1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c1.getTransitionName().equals("verde")){
                    c1.setTransitionName("cinza");
                    c1.setImageResource(R.mipmap.cinza);
                }else{
                    c1.setTransitionName("verde");
                    c1.setImageResource(R.mipmap.verde);
                }
            }
        });
        c2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c2.getTransitionName().equals("verde")){
                    c2.setTransitionName("cinza");
                    c2.setImageResource(R.mipmap.cinza);
                }else{
                    c2.setTransitionName("verde");
                    c2.setImageResource(R.mipmap.verde);
                }
            }
        });
        c3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c3.getTransitionName().equals("verde")){
                    c3.setTransitionName("cinza");
                    c3.setImageResource(R.mipmap.cinza);
                }else{
                    c3.setTransitionName("verde");
                    c3.setImageResource(R.mipmap.verde);
                }
            }
        });
        c4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c4.getTransitionName().equals("verde")){
                    c4.setTransitionName("cinza");
                    c4.setImageResource(R.mipmap.cinza);
                }else{
                    c4.setTransitionName("verde");
                    c4.setImageResource(R.mipmap.verde);
                }
            }
        });
        c5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c5.getTransitionName().equals("verde")){
                    c5.setTransitionName("cinza");
                    c5.setImageResource(R.mipmap.cinza);
                }else{
                    c5.setTransitionName("verde");
                    c5.setImageResource(R.mipmap.verde);
                }
            }
        });
        c6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c6.getTransitionName().equals("verde")){
                    c6.setTransitionName("cinza");
                    c6.setImageResource(R.mipmap.cinza);
                }else{
                    c6.setTransitionName("verde");
                    c6.setImageResource(R.mipmap.verde);
                }
            }
        });
        c7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c7.getTransitionName().equals("verde")){
                    c7.setTransitionName("cinza");
                    c7.setImageResource(R.mipmap.cinza);
                }else{
                    c7.setTransitionName("verde");
                    c7.setImageResource(R.mipmap.verde);
                }
            }
        });
        c8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c8.getTransitionName().equals("verde")){
                    c8.setTransitionName("cinza");
                    c8.setImageResource(R.mipmap.cinza);
                }else{
                    c8.setTransitionName("verde");
                    c8.setImageResource(R.mipmap.verde);
                }
            }
        });
        c9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c9.getTransitionName().equals("verde")){
                    c9.setTransitionName("cinza");
                    c9.setImageResource(R.mipmap.cinza);
                }else{
                    c9.setTransitionName("verde");
                    c9.setImageResource(R.mipmap.verde);
                }
            }
        });
        c10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(c10.getTransitionName().equals("verde")){
                    c10.setTransitionName("cinza");
                    c10.setImageResource(R.mipmap.cinza);
                }else{
                    c10.setTransitionName("verde");
                    c10.setImageResource(R.mipmap.verde);
                }
            }
        });
        d1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d1.getTransitionName().equals("verde")){
                    d1.setTransitionName("cinza");
                    d1.setImageResource(R.mipmap.cinza);
                }else{
                    d1.setTransitionName("verde");
                    d1.setImageResource(R.mipmap.verde);
                }
            }
        });
        d2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d2.getTransitionName().equals("verde")){
                    d2.setTransitionName("cinza");
                    d2.setImageResource(R.mipmap.cinza);
                }else{
                    d2.setTransitionName("verde");
                    d2.setImageResource(R.mipmap.verde);
                }
            }
        });
        d3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d3.getTransitionName().equals("verde")){
                    d3.setTransitionName("cinza");
                    d3.setImageResource(R.mipmap.cinza);
                }else{
                    d3.setTransitionName("verde");
                    d3.setImageResource(R.mipmap.verde);
                }
            }
        });
        d4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d4.getTransitionName().equals("verde")){
                    d4.setTransitionName("cinza");
                    d4.setImageResource(R.mipmap.cinza);
                }else{
                    d4.setTransitionName("verde");
                    d4.setImageResource(R.mipmap.verde);
                }
            }
        });
        d5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d5.getTransitionName().equals("verde")){
                    d5.setTransitionName("cinza");
                    d5.setImageResource(R.mipmap.cinza);
                }else{
                    d5.setTransitionName("verde");
                    d5.setImageResource(R.mipmap.verde);
                }
            }
        });
        d6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d6.getTransitionName().equals("verde")){
                    d6.setTransitionName("cinza");
                    d6.setImageResource(R.mipmap.cinza);
                }else{
                    d6.setTransitionName("verde");
                    d6.setImageResource(R.mipmap.verde);
                }
            }
        });
        d7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d7.getTransitionName().equals("verde")){
                    d7.setTransitionName("cinza");
                    d7.setImageResource(R.mipmap.cinza);
                }else{
                    d7.setTransitionName("verde");
                    d7.setImageResource(R.mipmap.verde);
                }
            }
        });
        d8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d8.getTransitionName().equals("verde")){
                    d8.setTransitionName("cinza");
                    d8.setImageResource(R.mipmap.cinza);
                }else{
                    d8.setTransitionName("verde");
                    d8.setImageResource(R.mipmap.verde);
                }
            }
        });
        d9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d9.getTransitionName().equals("verde")){
                    d9.setTransitionName("cinza");
                    d9.setImageResource(R.mipmap.cinza);
                }else{
                    d9.setTransitionName("verde");
                    d9.setImageResource(R.mipmap.verde);
                }
            }
        });
        d10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(d10.getTransitionName().equals("verde")){
                    d10.setTransitionName("cinza");
                    d10.setImageResource(R.mipmap.cinza);
                }else{
                    d10.setTransitionName("verde");
                    d10.setImageResource(R.mipmap.verde);
                }
            }
        });
        e1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e1.getTransitionName().equals("verde")){
                    e1.setTransitionName("cinza");
                    e1.setImageResource(R.mipmap.cinza);
                }else{
                    e1.setTransitionName("verde");
                    e1.setImageResource(R.mipmap.verde);
                }
            }
        });
        e2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e2.getTransitionName().equals("verde")){
                    e2.setTransitionName("cinza");
                    e2.setImageResource(R.mipmap.cinza);
                }else{
                    e2.setTransitionName("verde");
                    e2.setImageResource(R.mipmap.verde);
                }
            }
        });
        e3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e3.getTransitionName().equals("verde")){
                    e3.setTransitionName("cinza");
                    e3.setImageResource(R.mipmap.cinza);
                }else{
                    e3.setTransitionName("verde");
                    e3.setImageResource(R.mipmap.verde);
                }
            }
        });
        e4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e4.getTransitionName().equals("verde")){
                    e4.setTransitionName("cinza");
                    e4.setImageResource(R.mipmap.cinza);
                }else{
                    e4.setTransitionName("verde");
                    e4.setImageResource(R.mipmap.verde);
                }
            }
        });
        e5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e5.getTransitionName().equals("verde")){
                    e5.setTransitionName("cinza");
                    e5.setImageResource(R.mipmap.cinza);
                }else{
                    e5.setTransitionName("verde");
                    e5.setImageResource(R.mipmap.verde);
                }
            }
        });
        e6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e6.getTransitionName().equals("verde")){
                    e6.setTransitionName("cinza");
                    e6.setImageResource(R.mipmap.cinza);
                }else{
                    e6.setTransitionName("verde");
                    e6.setImageResource(R.mipmap.verde);
                }
            }
        });
        e7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e7.getTransitionName().equals("verde")){
                    e7.setTransitionName("cinza");
                    e7.setImageResource(R.mipmap.cinza);
                }else{
                    e7.setTransitionName("verde");
                    e7.setImageResource(R.mipmap.verde);
                }
            }
        });
        e8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e8.getTransitionName().equals("verde")){
                    e8.setTransitionName("cinza");
                    e8.setImageResource(R.mipmap.cinza);
                }else{
                    e8.setTransitionName("verde");
                    e8.setImageResource(R.mipmap.verde);
                }
            }
        });
        e9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e9.getTransitionName().equals("verde")){
                    e9.setTransitionName("cinza");
                    e9.setImageResource(R.mipmap.cinza);
                }else{
                    e9.setTransitionName("verde");
                    e9.setImageResource(R.mipmap.verde);
                }
            }
        });
        e10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(e10.getTransitionName().equals("verde")){
                    e10.setTransitionName("cinza");
                    e10.setImageResource(R.mipmap.cinza);
                }else{
                    e10.setTransitionName("verde");
                    e10.setImageResource(R.mipmap.verde);
                }
            }
        });
        f1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f1.getTransitionName().equals("verde")){
                    f1.setTransitionName("cinza");
                    f1.setImageResource(R.mipmap.cinza);
                }else{
                    f1.setTransitionName("verde");
                    f1.setImageResource(R.mipmap.verde);
                }
            }
        });
        f2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f2.getTransitionName().equals("verde")){
                    f2.setTransitionName("cinza");
                    f2.setImageResource(R.mipmap.cinza);
                }else{
                    f2.setTransitionName("verde");
                    f2.setImageResource(R.mipmap.verde);
                }
            }
        });
        f3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f3.getTransitionName().equals("verde")){
                    f3.setTransitionName("cinza");
                    f3.setImageResource(R.mipmap.cinza);
                }else{
                    f3.setTransitionName("verde");
                    f3.setImageResource(R.mipmap.verde);
                }
            }
        });
        f4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f4.getTransitionName().equals("verde")){
                    f4.setTransitionName("cinza");
                    f4.setImageResource(R.mipmap.cinza);
                }else{
                    f4.setTransitionName("verde");
                    f4.setImageResource(R.mipmap.verde);
                }
            }
        });
        f5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f5.getTransitionName().equals("verde")){
                    f5.setTransitionName("cinza");
                    f5.setImageResource(R.mipmap.cinza);
                }else{
                    f5.setTransitionName("verde");
                    f5.setImageResource(R.mipmap.verde);
                }
            }
        });
        f6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f6.getTransitionName().equals("verde")){
                    f6.setTransitionName("cinza");
                    f6.setImageResource(R.mipmap.cinza);
                }else{
                    f6.setTransitionName("verde");
                    f6.setImageResource(R.mipmap.verde);
                }
            }
        });
        f7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f7.getTransitionName().equals("verde")){
                    f7.setTransitionName("cinza");
                    f7.setImageResource(R.mipmap.cinza);
                }else{
                    f7.setTransitionName("verde");
                    f7.setImageResource(R.mipmap.verde);
                }
            }
        });
        f8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f8.getTransitionName().equals("verde")){
                    f8.setTransitionName("cinza");
                    f8.setImageResource(R.mipmap.cinza);
                }else{
                    f8.setTransitionName("verde");
                    f8.setImageResource(R.mipmap.verde);
                }
            }
        });
        f9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f9.getTransitionName().equals("verde")){
                    f9.setTransitionName("cinza");
                    f9.setImageResource(R.mipmap.cinza);
                }else{
                    f9.setTransitionName("verde");
                    f9.setImageResource(R.mipmap.verde);
                }
            }
        });
        f10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(f10.getTransitionName().equals("verde")){
                    f10.setTransitionName("cinza");
                    f10.setImageResource(R.mipmap.cinza);
                }else{
                    f10.setTransitionName("verde");
                    f10.setImageResource(R.mipmap.verde);
                }
            }
        });
        g1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g1.getTransitionName().equals("verde")){
                    g1.setTransitionName("cinza");
                    g1.setImageResource(R.mipmap.cinza);
                }else{
                    g1.setTransitionName("verde");
                    g1.setImageResource(R.mipmap.verde);
                }
            }
        });
        g2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g2.getTransitionName().equals("verde")){
                    g2.setTransitionName("cinza");
                    g2.setImageResource(R.mipmap.cinza);
                }else{
                    g2.setTransitionName("verde");
                    g2.setImageResource(R.mipmap.verde);
                }
            }
        });
        g3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g3.getTransitionName().equals("verde")){
                    g3.setTransitionName("cinza");
                    g3.setImageResource(R.mipmap.cinza);
                }else{
                    g3.setTransitionName("verde");
                    g3.setImageResource(R.mipmap.verde);
                }
            }
        });
        g4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g4.getTransitionName().equals("verde")){
                    g4.setTransitionName("cinza");
                    g4.setImageResource(R.mipmap.cinza);
                }else{
                    g4.setTransitionName("verde");
                    g4.setImageResource(R.mipmap.verde);
                }
            }
        });
        g5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g5.getTransitionName().equals("verde")){
                    g5.setTransitionName("cinza");
                    g5.setImageResource(R.mipmap.cinza);
                }else{
                    g5.setTransitionName("verde");
                    g5.setImageResource(R.mipmap.verde);
                }
            }
        });
        g6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g6.getTransitionName().equals("verde")){
                    g6.setTransitionName("cinza");
                    g6.setImageResource(R.mipmap.cinza);
                }else{
                    g6.setTransitionName("verde");
                    g6.setImageResource(R.mipmap.verde);
                }
            }
        });
        g7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g7.getTransitionName().equals("verde")){
                    g7.setTransitionName("cinza");
                    g7.setImageResource(R.mipmap.cinza);
                }else{
                    g7.setTransitionName("verde");
                    g7.setImageResource(R.mipmap.verde);
                }
            }
        });
        g8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g8.getTransitionName().equals("verde")){
                    g8.setTransitionName("cinza");
                    g8.setImageResource(R.mipmap.cinza);
                }else{
                    g8.setTransitionName("verde");
                    g8.setImageResource(R.mipmap.verde);
                }
            }
        });
        g9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g9.getTransitionName().equals("verde")){
                    g9.setTransitionName("cinza");
                    g9.setImageResource(R.mipmap.cinza);
                }else{
                    g9.setTransitionName("verde");
                    g9.setImageResource(R.mipmap.verde);
                }
            }
        });
        g10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(g10.getTransitionName().equals("verde")){
                    g10.setTransitionName("cinza");
                    g10.setImageResource(R.mipmap.cinza);
                }else{
                    g10.setTransitionName("verde");
                    g10.setImageResource(R.mipmap.verde);
                }
            }
        });
        h1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h1.getTransitionName().equals("verde")){
                    h1.setTransitionName("cinza");
                    h1.setImageResource(R.mipmap.cinza);
                }else{
                    h1.setTransitionName("verde");
                    h1.setImageResource(R.mipmap.verde);
                }
            }
        });
        h2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h2.getTransitionName().equals("verde")){
                    h2.setTransitionName("cinza");
                    h2.setImageResource(R.mipmap.cinza);
                }else{
                    h2.setTransitionName("verde");
                    h2.setImageResource(R.mipmap.verde);
                }
            }
        });
        h3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h3.getTransitionName().equals("verde")){
                    h3.setTransitionName("cinza");
                    h3.setImageResource(R.mipmap.cinza);
                }else{
                    h3.setTransitionName("verde");
                    h3.setImageResource(R.mipmap.verde);
                }
            }
        });
        h4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h4.getTransitionName().equals("verde")){
                    h4.setTransitionName("cinza");
                    h4.setImageResource(R.mipmap.cinza);
                }else{
                    h4.setTransitionName("verde");
                    h4.setImageResource(R.mipmap.verde);
                }
            }
        });
        h5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h5.getTransitionName().equals("verde")){
                    h5.setTransitionName("cinza");
                    h5.setImageResource(R.mipmap.cinza);
                }else{
                    h5.setTransitionName("verde");
                    h5.setImageResource(R.mipmap.verde);
                }
            }
        });
        h6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h6.getTransitionName().equals("verde")){
                    h6.setTransitionName("cinza");
                    h6.setImageResource(R.mipmap.cinza);
                }else{
                    h6.setTransitionName("verde");
                    h6.setImageResource(R.mipmap.verde);
                }
            }
        });
        h7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h7.getTransitionName().equals("verde")){
                    h7.setTransitionName("cinza");
                    h7.setImageResource(R.mipmap.cinza);
                }else{
                    h7.setTransitionName("verde");
                    h7.setImageResource(R.mipmap.verde);
                }
            }
        });
        h8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h8.getTransitionName().equals("verde")){
                    h8.setTransitionName("cinza");
                    h8.setImageResource(R.mipmap.cinza);
                }else{
                    h8.setTransitionName("verde");
                    h8.setImageResource(R.mipmap.verde);
                }
            }
        });
        h9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h9.getTransitionName().equals("verde")){
                    h9.setTransitionName("cinza");
                    h9.setImageResource(R.mipmap.cinza);
                }else{
                    h9.setTransitionName("verde");
                    h9.setImageResource(R.mipmap.verde);
                }
            }
        });
        h10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(h10.getTransitionName().equals("verde")){
                    h10.setTransitionName("cinza");
                    h10.setImageResource(R.mipmap.cinza);
                }else{
                    h10.setTransitionName("verde");
                    h10.setImageResource(R.mipmap.verde);
                }
            }
        });
        i1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i1.getTransitionName().equals("verde")){
                    i1.setTransitionName("cinza");
                    i1.setImageResource(R.mipmap.cinza);
                }else{
                    i1.setTransitionName("verde");
                    i1.setImageResource(R.mipmap.verde);
                }
            }
        });
        i2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i2.getTransitionName().equals("verde")){
                    i2.setTransitionName("cinza");
                    i2.setImageResource(R.mipmap.cinza);
                }else{
                    i2.setTransitionName("verde");
                    i2.setImageResource(R.mipmap.verde);
                }
            }
        });
        i3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i3.getTransitionName().equals("verde")){
                    i3.setTransitionName("cinza");
                    i3.setImageResource(R.mipmap.cinza);
                }else{
                    i3.setTransitionName("verde");
                    i3.setImageResource(R.mipmap.verde);
                }
            }
        });
        i4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i4.getTransitionName().equals("verde")){
                    i4.setTransitionName("cinza");
                    i4.setImageResource(R.mipmap.cinza);
                }else{
                    i4.setTransitionName("verde");
                    i4.setImageResource(R.mipmap.verde);
                }
            }
        });
        i5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i5.getTransitionName().equals("verde")){
                    i5.setTransitionName("cinza");
                    i5.setImageResource(R.mipmap.cinza);
                }else{
                    i5.setTransitionName("verde");
                    i5.setImageResource(R.mipmap.verde);
                }
            }
        });
        i6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i6.getTransitionName().equals("verde")){
                    i6.setTransitionName("cinza");
                    i6.setImageResource(R.mipmap.cinza);
                }else{
                    i6.setTransitionName("verde");
                    i6.setImageResource(R.mipmap.verde);
                }
            }
        });
        i7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i7.getTransitionName().equals("verde")){
                    i7.setTransitionName("cinza");
                    i7.setImageResource(R.mipmap.cinza);
                }else{
                    i7.setTransitionName("verde");
                    i7.setImageResource(R.mipmap.verde);
                }
            }
        });
        i8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i8.getTransitionName().equals("verde")){
                    i8.setTransitionName("cinza");
                    i8.setImageResource(R.mipmap.cinza);
                }else{
                    i8.setTransitionName("verde");
                    i8.setImageResource(R.mipmap.verde);
                }
            }
        });
        i9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i9.getTransitionName().equals("verde")){
                    i9.setTransitionName("cinza");
                    i9.setImageResource(R.mipmap.cinza);
                }else{
                    i9.setTransitionName("verde");
                    i9.setImageResource(R.mipmap.verde);
                }
            }
        });
        i10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(i10.getTransitionName().equals("verde")){
                    i10.setTransitionName("cinza");
                    i10.setImageResource(R.mipmap.cinza);
                }else{
                    i10.setTransitionName("verde");
                    i10.setImageResource(R.mipmap.verde);
                }
            }
        });
        j1.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j1.getTransitionName().equals("verde")){
                    j1.setTransitionName("cinza");
                    j1.setImageResource(R.mipmap.cinza);
                }else{
                    j1.setTransitionName("verde");
                    j1.setImageResource(R.mipmap.verde);
                }
            }
        });
        j2.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j2.getTransitionName().equals("verde")){
                    j2.setTransitionName("cinza");
                    j2.setImageResource(R.mipmap.cinza);
                }else{
                    j2.setTransitionName("verde");
                    j2.setImageResource(R.mipmap.verde);
                }
            }
        });
        j3.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j3.getTransitionName().equals("verde")){
                    j3.setTransitionName("cinza");
                    j3.setImageResource(R.mipmap.cinza);
                }else{
                    j3.setTransitionName("verde");
                    j3.setImageResource(R.mipmap.verde);
                }
            }
        });
        j4.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j4.getTransitionName().equals("verde")){
                    j4.setTransitionName("cinza");
                    j4.setImageResource(R.mipmap.cinza);
                }else{
                    j4.setTransitionName("verde");
                    j4.setImageResource(R.mipmap.verde);
                }
            }
        });
        j5.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j5.getTransitionName().equals("verde")){
                    j5.setTransitionName("cinza");
                    j5.setImageResource(R.mipmap.cinza);
                }else{
                    j5.setTransitionName("verde");
                    j5.setImageResource(R.mipmap.verde);
                }
            }
        });
        j6.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j6.getTransitionName().equals("verde")){
                    j6.setTransitionName("cinza");
                    j6.setImageResource(R.mipmap.cinza);
                }else{
                    j6.setTransitionName("verde");
                    j6.setImageResource(R.mipmap.verde);
                }
            }
        });
        j7.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j7.getTransitionName().equals("verde")){
                    j7.setTransitionName("cinza");
                    j7.setImageResource(R.mipmap.cinza);
                }else{
                    j7.setTransitionName("verde");
                    j7.setImageResource(R.mipmap.verde);
                }
            }
        });
        j8.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j8.getTransitionName().equals("verde")){
                    j8.setTransitionName("cinza");
                    j8.setImageResource(R.mipmap.cinza);
                }else{
                    j8.setTransitionName("verde");
                    j8.setImageResource(R.mipmap.verde);
                }
            }
        });
        j9.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j9.getTransitionName().equals("verde")){
                    j9.setTransitionName("cinza");
                    j9.setImageResource(R.mipmap.cinza);
                }else{
                    j9.setTransitionName("verde");
                    j9.setImageResource(R.mipmap.verde);
                }
            }
        });
        j10.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                if(j10.getTransitionName().equals("verde")){
                    j10.setTransitionName("cinza");
                    j10.setImageResource(R.mipmap.cinza);
                }else{
                    j10.setTransitionName("verde");
                    j10.setImageResource(R.mipmap.verde);
                }
            }
        });

        btnvoltar.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                Intent telainicio = new Intent(SelPoltronas.this, MenuCliente.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telainicio.putExtras(bundle);
                startActivity(telainicio);
            }

        });

        btnconfirmar.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                if(a1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a1;";
                    contadorselecionadas++;
                }
                if(a2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a2;";
                    contadorselecionadas++;
                }
                if(a3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a3;";
                    contadorselecionadas++;
                }
                if(a4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a4;";
                    contadorselecionadas++;
                }
                if(a5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a5;";
                    contadorselecionadas++;
                }
                if(a6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a6;";
                    contadorselecionadas++;
                }
                if(a7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a7;";
                    contadorselecionadas++;
                }
                if(a8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a8;";
                    contadorselecionadas++;
                }
                if(a9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a9;";
                    contadorselecionadas++;
                }
                if(a10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"a10;";
                    contadorselecionadas++;
                }
                if(b1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b1;";
                    contadorselecionadas++;
                }
                if(b2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b2;";
                    contadorselecionadas++;
                }
                if(b3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b3;";
                    contadorselecionadas++;
                }
                if(b4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b4;";
                    contadorselecionadas++;
                }
                if(b5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b5;";
                    contadorselecionadas++;
                }
                if(b6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b6;";
                    contadorselecionadas++;
                }
                if(b7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b7;";
                    contadorselecionadas++;
                }
                if(b8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b8;";
                    contadorselecionadas++;
                }
                if(b9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b9;";
                    contadorselecionadas++;
                }
                if(b10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"b10;";
                    contadorselecionadas++;
                }
                if(c1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c1;";
                    contadorselecionadas++;
                }
                if(c2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c2;";
                    contadorselecionadas++;
                }
                if(c3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c3;";
                    contadorselecionadas++;
                }
                if(c4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c4;";
                    contadorselecionadas++;
                }
                if(c5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c5;";
                    contadorselecionadas++;
                }
                if(c6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c6;";
                    contadorselecionadas++;
                }
                if(c7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c7;";
                    contadorselecionadas++;
                }
                if(c8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c8;";
                    contadorselecionadas++;
                }
                if(c9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c9;";
                    contadorselecionadas++;
                }
                if(c10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"c10;";
                    contadorselecionadas++;
                }
                if(d1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d1;";
                    contadorselecionadas++;
                }
                if(d2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d2;";
                    contadorselecionadas++;
                }
                if(d3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d3;";
                    contadorselecionadas++;
                }
                if(d4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d4;";
                    contadorselecionadas++;
                }
                if(d5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d5;";
                    contadorselecionadas++;
                }
                if(d6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d6;";
                    contadorselecionadas++;
                }
                if(d7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d7;";
                    contadorselecionadas++;
                }
                if(d8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d8;";
                    contadorselecionadas++;
                }
                if(d9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d9;";
                    contadorselecionadas++;
                }
                if(d10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"d10;";
                    contadorselecionadas++;
                }
                if(e1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e1;";
                    contadorselecionadas++;
                }
                if(e2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e2;";
                    contadorselecionadas++;
                }
                if(e3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e3;";
                    contadorselecionadas++;
                }
                if(e4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e4;";
                    contadorselecionadas++;
                }
                if(e5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e5;";
                    contadorselecionadas++;
                }
                if(e6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e6;";
                    contadorselecionadas++;
                }
                if(e7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e7;";
                    contadorselecionadas++;
                }
                if(e8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e8;";
                    contadorselecionadas++;
                }
                if(e9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e9;";
                    contadorselecionadas++;
                }
                if(e10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"e10;";
                    contadorselecionadas++;
                }
                if(f1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f1;";
                    contadorselecionadas++;
                }
                if(f2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f2;";
                    contadorselecionadas++;
                }
                if(f3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f3;";
                    contadorselecionadas++;
                }
                if(f4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f4;";
                    contadorselecionadas++;
                }
                if(f5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f5;";
                    contadorselecionadas++;
                }
                if(f6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f6;";
                    contadorselecionadas++;
                }
                if(f7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f7;";
                    contadorselecionadas++;
                }
                if(f8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f8;";
                    contadorselecionadas++;
                }
                if(f9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f9;";
                    contadorselecionadas++;
                }
                if(f10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"f10;";
                    contadorselecionadas++;
                }
                if(g1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g1;";
                    contadorselecionadas++;
                }
                if(g2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g2;";
                    contadorselecionadas++;
                }
                if(g3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g3;";
                    contadorselecionadas++;
                }
                if(g4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g4;";
                    contadorselecionadas++;
                }
                if(g5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g5;";
                    contadorselecionadas++;
                }
                if(g6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g6;";
                    contadorselecionadas++;
                }
                if(g7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g7;";
                    contadorselecionadas++;
                }
                if(g8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g8;";
                    contadorselecionadas++;
                }
                if(g9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g9;";
                    contadorselecionadas++;
                }
                if(g10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"g10;";
                    contadorselecionadas++;
                }
                if(h1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h1;";
                    contadorselecionadas++;
                }
                if(h2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h2;";
                    contadorselecionadas++;
                }
                if(h3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h3;";
                    contadorselecionadas++;
                }
                if(h4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h4;";
                    contadorselecionadas++;
                }
                if(h5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h5;";
                    contadorselecionadas++;
                }
                if(h6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h6;";
                    contadorselecionadas++;
                }
                if(h7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h7;";
                    contadorselecionadas++;
                }
                if(h8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h8;";
                    contadorselecionadas++;
                }
                if(h9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h9;";
                    contadorselecionadas++;
                }
                if(h10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"h10;";
                    contadorselecionadas++;
                }
                if(i1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i1;";
                    contadorselecionadas++;
                }
                if(i2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i2;";
                    contadorselecionadas++;
                }
                if(i3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i3;";
                    contadorselecionadas++;
                }
                if(i4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i4;";
                    contadorselecionadas++;
                }
                if(i5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i5;";
                    contadorselecionadas++;
                }
                if(i6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i6;";
                    contadorselecionadas++;
                }
                if(i7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i7;";
                    contadorselecionadas++;
                }
                if(i8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i8;";
                    contadorselecionadas++;
                }
                if(i9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i9;";
                    contadorselecionadas++;
                }
                if(i10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"i10;";
                    contadorselecionadas++;
                }
                if(j1.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j1;";
                    contadorselecionadas++;
                }
                if(j2.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j2;";
                    contadorselecionadas++;
                }
                if(j3.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j3;";
                    contadorselecionadas++;
                }
                if(j4.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j4;";
                    contadorselecionadas++;
                }
                if(j5.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j5;";
                    contadorselecionadas++;
                }
                if(j6.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j6;";
                    contadorselecionadas++;
                }
                if(j7.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j7;";
                    contadorselecionadas++;
                }
                if(j8.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j8;";
                    contadorselecionadas++;
                }
                if(j9.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j9;";
                    contadorselecionadas++;
                }
                if(j10.getTransitionName().equals("cinza")){
                    selecionadas= selecionadas +"j10;";
                    contadorselecionadas++;
                }


                if(contadorselecionadas!=Integer.parseInt(totalingressos.trim())){
                    contadorselecionadas=0;
                    selecionadas="";
                    Toast.makeText(getApplicationContext(), "Você deve selecionar "+totalingressos.trim()+" cadeira(s).", Toast.LENGTH_LONG).show();
                }else{
                    ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
                    NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
                    if (networkInfo != null && networkInfo.isConnected()){
                        parametros2 = "codigo_sessao=" + codigo_sessao + "&nome_selecionadas=" + selecionadas;
                        new SelPoltronas.SolicitaCodigos().execute(url2);
                    }
                    else {
                        Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
                    }

                }
            }
        });


    }


    private class montagemsala{
        protected void onPostExecute(){
            ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
            if (networkInfo != null && networkInfo.isConnected()) {
                parametros = "codigo_sessao=" + codigo_sessao;
                new SelPoltronas.SolicitaDados().execute(url);

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

            if (resultado.trim().equals("sem_cadeiras") == false) {

                try {
                    jsonobject = new JSONObject(resultado);
                    jsonarray = jsonobject.getJSONArray("cadeiras");
                    for (int i = 0; i < jsonarray.length(); i++) {
                        map = new HashMap<>();
                        jsonobject = jsonarray.getJSONObject(i);
                        map.put("codigo", jsonobject.getString("codigo"));
                        map.put("nome", jsonobject.getString("nome_cadeira"));
                        arraylist.add(map);
                    }
                } catch (JSONException e) {
                    Log.e("Error", e.getMessage());
                    e.printStackTrace();
                }



                for (int i = 0; i < jsonarray.length(); i++) {
                    try {
                        jsonobject = jsonarray.getJSONObject(i);
                        if (jsonobject.getString("nome_cadeira").trim().equals("a1")) {
                            a1.setImageResource(R.mipmap.vermelha);
                            a1.setTransitionName("vermelha");
                            a1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("a2")){
                            a2.setImageResource(R.mipmap.vermelha);
                            a2.setTransitionName("vermelha");
                            a2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("a3")){
                            a3.setImageResource(R.mipmap.vermelha);
                            a3.setTransitionName("vermelha");
                            a3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("a4")){
                            a4.setImageResource(R.mipmap.vermelha);
                            a4.setTransitionName("vermelha");
                            a4.setEnabled(false);
                        }
                        else if(jsonobject.getString("nome_cadeira").trim().equals("a5")){
                            a5.setImageResource(R.mipmap.vermelha);
                            a5.setTransitionName("vermelha");
                            a5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("a6")){
                            a6.setImageResource(R.mipmap.vermelha);
                            a6.setTransitionName("vermelha");
                            a6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("a7")){
                            a7.setImageResource(R.mipmap.vermelha);
                            a7.setTransitionName("vermelha");
                            a7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("a8")){
                            a8.setImageResource(R.mipmap.vermelha);
                            a8.setTransitionName("vermelha");
                            a8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("a9")){
                            a9.setImageResource(R.mipmap.vermelha);
                            a9.setTransitionName("vermelha");
                            a9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("a10")){
                            a10.setImageResource(R.mipmap.vermelha);
                            a10.setTransitionName("vermelha");
                            a10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b1")){
                            b1.setImageResource(R.mipmap.vermelha);
                            b1.setTransitionName("vermelha");
                            b1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b2")){
                            b2.setImageResource(R.mipmap.vermelha);
                            b2.setTransitionName("vermelha");
                            b2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b3")){
                            b3.setImageResource(R.mipmap.vermelha);
                            b3.setTransitionName("vermelha");
                            b3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b4")){
                            b4.setImageResource(R.mipmap.vermelha);
                            b4.setTransitionName("vermelha");
                            b4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b5")){
                            b5.setImageResource(R.mipmap.vermelha);
                            b5.setTransitionName("vermelha");
                            b5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b6")){
                            b6.setImageResource(R.mipmap.vermelha);
                            b6.setTransitionName("vermelha");
                            b6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b7")){
                            b7.setImageResource(R.mipmap.vermelha);
                            b7.setTransitionName("vermelha");
                            b7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b8")){
                            b8.setImageResource(R.mipmap.vermelha);
                            b8.setTransitionName("vermelha");
                            b8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b9")){
                            b9.setImageResource(R.mipmap.vermelha);
                            b9.setTransitionName("vermelha");
                            b9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("b10")){
                            b10.setImageResource(R.mipmap.vermelha);
                            b10.setTransitionName("vermelha");
                            b10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c1")){
                            c1.setImageResource(R.mipmap.vermelha);
                            c1.setTransitionName("vermelha");
                            c1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c2")){
                            c2.setImageResource(R.mipmap.vermelha);
                            c2.setTransitionName("vermelha");
                            c2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c3")){
                            c3.setImageResource(R.mipmap.vermelha);
                            c3.setTransitionName("vermelha");
                            c3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c4")){
                            c4.setImageResource(R.mipmap.vermelha);
                            c4.setTransitionName("vermelha");
                            c4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c5")){
                            c5.setImageResource(R.mipmap.vermelha);
                            c5.setTransitionName("vermelha");
                            c5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c6")){
                            c6.setImageResource(R.mipmap.vermelha);
                            c6.setTransitionName("vermelha");
                            c6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c7")){
                            c7.setImageResource(R.mipmap.vermelha);
                            c7.setTransitionName("vermelha");
                            c7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c8")){
                            c8.setImageResource(R.mipmap.vermelha);
                            c8.setTransitionName("vermelha");
                            c8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c9")){
                            c9.setImageResource(R.mipmap.vermelha);
                            c9.setTransitionName("vermelha");
                            c9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("c10")){
                            c10.setImageResource(R.mipmap.vermelha);
                            c10.setTransitionName("vermelha");
                            c10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d1")){
                            d1.setImageResource(R.mipmap.vermelha);
                            d1.setTransitionName("vermelha");
                            d1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d2")){
                            d2.setImageResource(R.mipmap.vermelha);
                            d2.setTransitionName("vermelha");
                            d2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d3")){
                            d3.setImageResource(R.mipmap.vermelha);
                            d3.setTransitionName("vermelha");
                            d3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d4")){
                            d4.setImageResource(R.mipmap.vermelha);
                            d4.setTransitionName("vermelha");
                            d4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d5")){
                            d5.setImageResource(R.mipmap.vermelha);
                            d5.setTransitionName("vermelha");
                            d5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d6")){
                            d6.setImageResource(R.mipmap.vermelha);
                            d6.setTransitionName("vermelha");
                            d6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d7")){
                            d7.setImageResource(R.mipmap.vermelha);
                            d7.setTransitionName("vermelha");
                            d7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d8")){
                            d8.setImageResource(R.mipmap.vermelha);
                            d8.setTransitionName("vermelha");
                            d8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d9")){
                            d9.setImageResource(R.mipmap.vermelha);
                            d9.setTransitionName("vermelha");
                            d9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("d10")){
                            d10.setImageResource(R.mipmap.vermelha);
                            d10.setTransitionName("vermelha");
                            d10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e1")){
                            e1.setImageResource(R.mipmap.vermelha);
                            e1.setTransitionName("vermelha");
                            e1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e2")){
                            e2.setImageResource(R.mipmap.vermelha);
                            e2.setTransitionName("vermelha");
                            e2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e3")){
                            e3.setImageResource(R.mipmap.vermelha);
                            e3.setTransitionName("vermelha");
                            e3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e4")){
                            e4.setImageResource(R.mipmap.vermelha);
                            e4.setTransitionName("vermelha");
                            e4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e5")){
                            e5.setImageResource(R.mipmap.vermelha);
                            e5.setTransitionName("vermelha");
                            e5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e6")){
                            e6.setImageResource(R.mipmap.vermelha);
                            e6.setTransitionName("vermelha");
                            e6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e7")){
                            e7.setImageResource(R.mipmap.vermelha);
                            e7.setTransitionName("vermelha");
                            e7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e8")){
                            e8.setImageResource(R.mipmap.vermelha);
                            e8.setTransitionName("vermelha");
                            e8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e9")){
                            e9.setImageResource(R.mipmap.vermelha);
                            e9.setTransitionName("vermelha");
                            e9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("e10")){
                            e10.setImageResource(R.mipmap.vermelha);
                            e10.setTransitionName("vermelha");
                            e10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f1")){
                            f1.setImageResource(R.mipmap.vermelha);
                            f1.setTransitionName("vermelha");
                            f1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f2")){
                            f2.setImageResource(R.mipmap.vermelha);
                            f2.setTransitionName("vermelha");
                            f2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f3")){
                            f3.setImageResource(R.mipmap.vermelha);
                            f3.setTransitionName("vermelha");
                            f3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f4")){
                            f4.setImageResource(R.mipmap.vermelha);
                            f4.setTransitionName("vermelha");
                            f4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f5")){
                            f5.setImageResource(R.mipmap.vermelha);
                            f5.setTransitionName("vermelha");
                            f5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f6")){
                            f6.setImageResource(R.mipmap.vermelha);
                            f6.setTransitionName("vermelha");
                            f6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f7")){
                            f7.setImageResource(R.mipmap.vermelha);
                            f7.setTransitionName("vermelha");
                            f7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f8")){
                            f8.setImageResource(R.mipmap.vermelha);
                            f8.setTransitionName("vermelha");
                            f8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f9")){
                            f9.setImageResource(R.mipmap.vermelha);
                            f9.setTransitionName("vermelha");
                            f9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("f10")){
                            f10.setImageResource(R.mipmap.vermelha);
                            f10.setTransitionName("vermelha");
                            f10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g1")){
                            g1.setImageResource(R.mipmap.vermelha);
                            g1.setTransitionName("vermelha");
                            g1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g2")){
                            g2.setImageResource(R.mipmap.vermelha);
                            g2.setTransitionName("vermelha");
                            g2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g3")){
                            g3.setImageResource(R.mipmap.vermelha);
                            g3.setTransitionName("vermelha");
                            g3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g4")){
                            g4.setImageResource(R.mipmap.vermelha);
                            g4.setTransitionName("vermelha");
                            g4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g5")){
                            g5.setImageResource(R.mipmap.vermelha);
                            g5.setTransitionName("vermelha");
                            g5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g6")){
                            g6.setImageResource(R.mipmap.vermelha);
                            g6.setTransitionName("vermelha");
                            g6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g7")){
                            g7.setImageResource(R.mipmap.vermelha);
                            g7.setTransitionName("vermelha");
                            g7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g8")){
                            g8.setImageResource(R.mipmap.vermelha);
                            g8.setTransitionName("vermelha");
                            g8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g9")){
                            g9.setImageResource(R.mipmap.vermelha);
                            g9.setTransitionName("vermelha");
                            g9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("g10")){
                            g10.setImageResource(R.mipmap.vermelha);
                            g10.setTransitionName("vermelha");
                            g10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h1")){
                            h1.setImageResource(R.mipmap.vermelha);
                            h1.setTransitionName("vermelha");
                            h1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h2")){
                            h2.setImageResource(R.mipmap.vermelha);
                            h2.setTransitionName("vermelha");
                            h2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h3")){
                            h3.setImageResource(R.mipmap.vermelha);
                            h3.setTransitionName("vermelha");
                            h3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h4")){
                            h4.setImageResource(R.mipmap.vermelha);
                            h4.setTransitionName("vermelha");
                            h4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h5")){
                            h5.setImageResource(R.mipmap.vermelha);
                            h5.setTransitionName("vermelha");
                            h5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h6")){
                            h6.setImageResource(R.mipmap.vermelha);
                            h6.setTransitionName("vermelha");
                            h6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h7")){
                            h7.setImageResource(R.mipmap.vermelha);
                            h7.setTransitionName("vermelha");
                            h7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h8")){
                            h8.setImageResource(R.mipmap.vermelha);
                            h8.setTransitionName("vermelha");
                            h8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h9")){
                            h9.setImageResource(R.mipmap.vermelha);
                            h9.setTransitionName("vermelha");
                            h9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("h10")){
                            h10.setImageResource(R.mipmap.vermelha);
                            h10.setTransitionName("vermelha");
                            h10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i1")){
                            i1.setImageResource(R.mipmap.vermelha);
                            i1.setTransitionName("vermelha");
                            i1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i2")){
                            i2.setImageResource(R.mipmap.vermelha);
                            i2.setTransitionName("vermelha");
                            i2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i3")){
                            i3.setImageResource(R.mipmap.vermelha);
                            i3.setTransitionName("vermelha");
                            i3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i4")){
                            i4.setImageResource(R.mipmap.vermelha);
                            i4.setTransitionName("vermelha");
                            i4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i5")){
                            i5.setImageResource(R.mipmap.vermelha);
                            i5.setTransitionName("vermelha");
                            i5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i6")){
                            i6.setImageResource(R.mipmap.vermelha);
                            i6.setTransitionName("vermelha");
                            i6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i7")){
                            i7.setImageResource(R.mipmap.vermelha);
                            i7.setTransitionName("vermelha");
                            i7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i8")){
                            i8.setImageResource(R.mipmap.vermelha);
                            i8.setTransitionName("vermelha");
                            i8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i9")){
                            i9.setImageResource(R.mipmap.vermelha);
                            i9.setTransitionName("vermelha");
                            i9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("i10")){
                            i10.setImageResource(R.mipmap.vermelha);
                            i10.setTransitionName("vermelha");
                            i10.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j1")){
                            j1.setImageResource(R.mipmap.vermelha);
                            j1.setTransitionName("vermelha");
                            j1.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j2")){
                            j2.setImageResource(R.mipmap.vermelha);
                            j2.setTransitionName("vermelha");
                            j2.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j3")){
                            j3.setImageResource(R.mipmap.vermelha);
                            j3.setTransitionName("vermelha");
                            j3.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j4")){
                            j4.setImageResource(R.mipmap.vermelha);
                            j4.setTransitionName("vermelha");
                            j4.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j5")){
                            j5.setImageResource(R.mipmap.vermelha);
                            j5.setTransitionName("vermelha");
                            j5.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j6")){
                            j6.setImageResource(R.mipmap.vermelha);
                            j6.setTransitionName("vermelha");
                            j6.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j7")){
                            j7.setImageResource(R.mipmap.vermelha);
                            j7.setTransitionName("vermelha");
                            j7.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j8")){
                            j8.setImageResource(R.mipmap.vermelha);
                            j8.setTransitionName("vermelha");
                            j8.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j9")){
                            j9.setImageResource(R.mipmap.vermelha);
                            j9.setTransitionName("vermelha");
                            j9.setEnabled(false);
                        }else if(jsonobject.getString("nome_cadeira").trim().equals("j10")){
                            j10.setImageResource(R.mipmap.vermelha);
                            j10.setTransitionName("vermelha");
                            j10.setEnabled(false);
                        }

                    } catch (JSONException e) {
                        Log.e("Error", e.getMessage());
                        e.printStackTrace();
                    }


                }
            }
        }

    }

    private class SolicitaCodigos extends AsyncTask<String, Void, String> {
        protected String doInBackground(String...urls){
            return Conexao.postDados(urls[0], parametros2);
        }
        protected void onPostExecute(String resultado){
            ConnectivityManager connMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();
            if (networkInfo != null && networkInfo.isConnected()){
                codigos_cadeiras = resultado.trim();
                parametros3 = "codigo_sessao=" + codigo_sessao + "&codigos_cadeiras=" + resultado.trim();
                new SelPoltronas.VerificaIngressos().execute(url3);
            }
            else {
                Toast.makeText(getApplicationContext(), "Nenhuma conexão foi encontrada", Toast.LENGTH_LONG).show();
            }
        }
    }

    private class VerificaIngressos extends AsyncTask<String, Void, String> {
        protected String doInBackground(String...urls){
            return Conexao.postDados(urls[0], parametros3);
        }
        protected void onPostExecute(String resultado){
            if(resultado.trim().equals("ok")==false){
                Toast.makeText(getApplicationContext(), resultado, Toast.LENGTH_LONG).show();
                new montagemsala().onPostExecute();
            }else{
                Intent intent = new Intent(SelPoltronas.this, Pagamento.class);
                Bundle bundle = new Bundle();
                bundle.putString("codigo_sessao", codigo_sessao);
                bundle.putString("codigo_cadeiras", codigos_cadeiras);
                bundle.putString("email", email);
                bundle.putString("valoringressos", valortotalingressos);
                bundle.putString("cadeiras_selecionadas", selecionadas);
                intent.putExtras(bundle);
                contadorselecionadas=0;
                selecionadas="";
                startActivity(intent);
            }

        }
    }

}