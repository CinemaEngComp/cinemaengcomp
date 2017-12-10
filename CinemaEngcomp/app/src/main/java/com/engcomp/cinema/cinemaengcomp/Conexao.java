//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

/* *************************************************************************************************************************************************************************************************
* - Classe criada e adaptada, atraves do codigo de exemplo extraido da referencia abaixo:
*
* SILVA, E. Login - Android Studio e MySQL. Disponível em: <https://www.youtube.com/playlist?list=PLssIKrX2yyQGjL81jrPx09c8IeMEUD1wB> Acesso em 29 de novembro de 2017.
*
************************************************************************************************************************************************************************************************* */

package com.engcomp.cinema.cinemaengcomp;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;

class Conexao {

    /* criando funcao para enviar os dados que o usuario solicitara  */
    static String postDados(String urlUsuario, String parametrosUsuario) {

        URL url; //definindo variavel do tipo url
        HttpURLConnection connection = null; //variavel responsavel pela conexao

        try{

            //variavel que recebera a url informada pelo usuario
            url = new URL(urlUsuario);

            /* abrindo conexao atraves do endereco informado */
            connection = (HttpURLConnection) url.openConnection();

            //definindo propriedades para seguranca de comunicacao
            //definindo o metodo POST para envio de informaçoes
            connection.setRequestMethod("POST");
            //definindo como os dados serao codificados - utilizando formulario
            connection.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
            //definindo o numero de byte que sera enviado pela conexao atraves dos parametros do usuario
            connection.setRequestProperty("Content-Lenght", "" + Integer.toString(parametrosUsuario.getBytes().length));
            //definindo compatibilidade em portugues - Brasil
            connection.setRequestProperty("Content-Language", "pt-BR");

            //nao amarzenar dados em cache para funcionalidade em tempo real da conexao */
            connection.setUseCaches(false);

            //habilitando entrada e saida de dados da aplicacao onde eu possa fazer solicitacao e receber dados da mesma
            connection.setDoInput(true);
            connection.setDoOutput(true);

            //armazenar os dados de saida da conexao
            OutputStreamWriter outputStreamWriter = new OutputStreamWriter(connection.getOutputStream(), "UTF-8");
            outputStreamWriter.write(parametrosUsuario);
            outputStreamWriter.flush();

            /* obter os dados retornados da conexao*/
            InputStream inputStream = connection.getInputStream();

            /* armazena os dados em buffer e defino a codificacao como UTF-8 */
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "UTF-8"));
            String linha; //variavel para diluir os dados

            StringBuilder resposta = new StringBuilder();

            //comando para pegar linha por linha para juntar os dados
            // ou seja, enquanto tiver informaçao deve-se continuar lendo
            while((linha = bufferedReader.readLine()) != null){
                resposta.append(linha);
                resposta.append('\r');
            }

            //fechando buffer
            bufferedReader.close();

            //retornando resposta como string
            return resposta.toString();

        } catch (Exception erro){
            return null;
        } finally {
            //se a conexao for diferente de nulo, desconectara para evitar algum tipo de erro
            if(connection!= null) {
                connection.disconnect();
            }
        }
    }

}
