//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

/* *************************************************************************************************************************************************************************************************
* - Classe obtida atraves da referencia abaixo:
*
* FLAILTON. Aplicação de Máscaras em Formulários. Disponível em: <https://nuvemandroid.wordpress.com/2013/12/13/aplicacao-de-mascaras-em-formularios/> Acesso em 29 de novembro de 2017.
*
************************************************************************************************************************************************************************************************* */

package com.engcomp.cinema.cinemaengcomp;

import android.text.Editable;
import android.text.TextWatcher;
import android.widget.EditText;

public abstract class Mask {
    //método utilizado para retirar a mascara das variaveis
    public static String unmask(String s) {
        //retorna a variável retirando os caracteres especificados.
        return s.replaceAll("[.]", "").replaceAll("[-]", "")
                .replaceAll("[/]", "").replaceAll("[(]", "")
                .replaceAll("[)]", "");
    }

    //Método utilizado para fazer a inserção de uma máscara em uma determinada EditText
    public static TextWatcher insert(final String mask, final EditText ediTxt) {
        return new TextWatcher() {
            boolean isUpdating;
            String old = "";
            public void onTextChanged(CharSequence s, int start, int before,int count) {
                //Retira a máscara do texto
                String str = Mask.unmask(s.toString());
                String mascara = "";
                if (isUpdating) {
                    //armazena o valor do texto em outra variavel
                    old = str;
                    isUpdating = false;
                    return;
                }
                int i = 0;
                //Faz uma verificação de caracter em caracter em toda a mascara passada
                for (char m : mask.toCharArray()) {
                    //Faz a verificação se o caracter for diferente de um digito e se o texto já chegou ao fim
                    if (m != '#' && str.length() > old.length()) {
                        mascara += m;
                        continue;
                    }
                    //Comando tenta adicionar o valor do texto a máscara
                    try {
                        mascara += str.charAt(i);
                    } catch (Exception e) {
                        break;
                    }
                    i++;
                }
                isUpdating = true;
                //Insere as informações da máscara na caixa de texto
                ediTxt.setText(mascara);
                //Insere as informações do tamanho da máscara na caixa de texto
                ediTxt.setSelection(mascara.length());
            }
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}
            public void afterTextChanged(Editable s) {}
        };
    }
}