//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

package com.engcomp.cinema.cinemaengcomp;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;

public class MenuCliente extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    Button btCartaz, btEstreias, btLancamentos;
    String email="";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.menu);

        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        email = bundle.getString("email");

        /*atribuindo variaveis onde buscar / recuperar os dados no layout*/
        btCartaz = (Button) findViewById(R.id.botao_cartaz);
        btEstreias = (Button) findViewById(R.id.botao_estreia);
        btLancamentos = (Button) findViewById(R.id.botao_lancamentos);

        btCartaz.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent telacartaz = new Intent(MenuCliente.this, Cartaz.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telacartaz.putExtras(bundle);
                startActivity(telacartaz);

            }
        });

        btEstreias.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent telaestreias = new Intent(MenuCliente.this, Estreias.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telaestreias.putExtras(bundle);
                startActivity(telaestreias);

            }
        });

        btLancamentos.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent telalancamentos = new Intent(MenuCliente.this, Lancamentos.class);
                Bundle bundle = new Bundle();
                bundle.putString("email", email);
                telalancamentos.putExtras(bundle);
                startActivity(telalancamentos);

            }
        });

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);

        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        int id = item.getItemId();

        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        int id = item.getItemId();

        if (id == R.id.minha_conta) {
            Intent dadosconta = new Intent(MenuCliente.this, DadosConta.class);
            Bundle bundle = new Bundle();
            bundle.putString("email", email);
            dadosconta.putExtras(bundle);
            startActivity(dadosconta);

        }else if(id == R.id.meus_ingressos){
            Intent telalistagemingresso = new Intent(MenuCliente.this, ListagemIngresso.class);
            Bundle bundle = new Bundle();
            bundle.putString("email", email);
            telalistagemingresso.putExtras(bundle);
            startActivity(telalistagemingresso);

        }else if (id == R.id.sair_aplicativo){
            finish();
            System.exit(0);

        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    @Override
    protected void onResume() {
        super.onResume();
    }

}
