//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

package com.engcomp.cinema.cinemaengcomp;

import android.text.Editable;
import android.text.TextUtils;
import android.view.View;
import android.widget.EditText;

public class Verifica {

    //Método desenvolvido para fazer a verificação dos campos, se está preenchido ou não
    public static boolean verificacampo(View janela, String campo) {
        //Faz a verificação se a view que foi transmitida é uma EditText
        if (janela instanceof EditText) {
            //Cria variavéis para receber a mensagem que consta dentro da EditText
            EditText caixatexto = (EditText) janela;
            Editable texto = caixatexto.getText();
            //Verifica se o texto não é nulo
            if (texto != null) {
                //Recebe o texto em uma variável do tipo String
                String palavra = texto.toString();
                //Verifica se o texto recebido não é vazio
                if (!TextUtils.isEmpty(palavra)) {
                    return true;
                }
            }
            //Comando utilizado para informar aonde ocorre o problema
            caixatexto.setError(campo);
            //Comando utilizado para dar a caixa de texto o foco para um dispositivo de entrada
            caixatexto.setFocusable(true);
            //Comando utilizado para pedir o foco a caixa de texto
            caixatexto.requestFocus();
            return false;
        }
        return false;
    }

    //Método desenvolvido para fazer a verificação do CPF
    public static boolean verificacpf(String CPF) {
        //Comando utilizado para retirar a máscara do CPF, utilizando o método unmask, da classe Mask
        CPF = Mask.unmask(CPF);
        if (CPF.equals("00000000000") || CPF.equals("11111111111")
                || CPF.equals("22222222222") || CPF.equals("33333333333")
                || CPF.equals("44444444444") || CPF.equals("55555555555")
                || CPF.equals("66666666666") || CPF.equals("77777777777")
                || CPF.equals("88888888888") || CPF.equals("99999999999")) {
            return false;
        }
        char dig10, dig11;
        int sm, i, r, num, peso;

        //Comando utilizado para tentar fazer o cálculo de verificação do CPF
        try {
            sm = 0;
            peso = 10;
            for (i = 0; i < 9; i++) {
                num = (int) (CPF.charAt(i) - 48);
                sm = sm + (num * peso);
                peso = peso - 1;
            }
            r = 11 - (sm % 11);
            if ((r == 10) || (r == 11))
                dig10 = '0';
            else
                dig10 = (char) (r + 48);
            sm = 0;
            peso = 11;
            for (i = 0; i < 10; i++) {
                num = (int) (CPF.charAt(i) - 48);
                sm = sm + (num * peso);
                peso = peso - 1;
            }
            r = 11 - (sm % 11);
            if ((r == 10) || (r == 11))
                dig11 = '0';
            else
                dig11 = (char) (r + 48);
            if ((dig10 == CPF.charAt(9)) && (dig11 == CPF.charAt(10)))
                return (true);
            else
                return (false);
        } catch (Exception erro) {
            return (false);
        }
    }

    //Método desenvolvido para fazer a verificação do email
    public final static boolean verificaemail(String email) {
        //Verifica se o e-mail está vazio
        if (TextUtils.isEmpty(email)) {
            return false;
        } else {
            //Faz a validação do e-mail e retorna se a verificação está Ok ou não
            return android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches();
        }
    }

}
