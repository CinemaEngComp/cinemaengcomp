/**
 * @author M�rcio d'�vila
 * @version 1.01, 2004
 *
 * PROT�TIPOS:
 * m�todo String.lpad(int pSize, char pCharPad)
 * m�todo String.trim()
 *
 * String unformatNumber(String pNum)
 * String formatCpfCnpj(String pCpfCnpj, boolean pUseSepar, boolean pIsCnpj)
 * String dvCpfCnpj(String pEfetivo, boolean pIsCnpj)
 * boolean isCpf(String pCpf)
 * boolean isCnpj(String pCnpj)
 * boolean isCpfCnpj(String pCpfCnpj)
 */


NUM_DIGITOS_CPF  = 11;
NUM_DIGITOS_CNPJ = 14;
NUM_DGT_CNPJ_BASE = 8;


/**
 * Adiciona m�todo lpad() � classe String.
 * Preenche a String � esquerda com o caractere fornecido,
 * at� que ela atinja o tamanho especificado.
 */
String.prototype.lpad = function(pSize, pCharPad)
{
	var str = this;
	var dif = pSize - str.length;
	var ch = String(pCharPad).charAt(0);
	for (; dif>0; dif--) str = ch + str;
	return (str);
} //String.lpad


/**
 * Adiciona m�todo trim() � classe String.
 * Elimina brancos no in�cio e fim da String.
 */
String.prototype.trim = function()
{
	return this.replace(/^\s*/, "").replace(/\s*$/, "");
} //String.trim


/**
 * Elimina caracteres de formata��o e zeros � esquerda da string
 * de n�mero fornecida.
 * @param String pNum
 * 	String de n�mero fornecida para ser desformatada.
 * @return String de n�mero desformatada.
 */
function unformatNumber(pNum)
{
	return String(pNum).replace(/\D/g, "").replace(/^0+/, "");
} //unformatNumber


/**
 * Formata a string fornecida como CNPJ ou CPF, adicionando zeros
 * � esquerda se necess�rio e caracteres separadores, conforme solicitado.
 * @param String pCpfCnpj
 * 	String fornecida para ser formatada.
 * @param boolean pUseSepar
 * 	Indica se devem ser usados caracteres separadores (. - /).
 * @param boolean pIsCnpj
 * 	Indica se a string fornecida � um CNPJ.
 * 	Caso contr�rio, � CPF. Default = false (CPF).
 * @return String de CPF ou CNPJ devidamente formatada.
 */
function formatCpfCnpj(pCpfCnpj, pUseSepar, pIsCnpj)
{
	if (pIsCnpj==null) pIsCnpj = false;
	if (pUseSepar==null) pUseSepar = true;
	var maxDigitos = pIsCnpj? NUM_DIGITOS_CNPJ: NUM_DIGITOS_CPF;
	var numero = unformatNumber(pCpfCnpj);

	numero = numero.lpad(maxDigitos, '0');
	if (!pUseSepar) return numero;

	if (pIsCnpj)
	{
		reCnpj = /(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/;
		numero = numero.replace(reCnpj, "$1.$2.$3/$4-$5");
	}
	else
	{
		reCpf  = /(\d{3})(\d{3})(\d{3})(\d{2})$/;
		numero = numero.replace(reCpf, "$1.$2.$3-$4");
	}
	return numero;
} //formatCpfCnpj


/**
 * Calcula os 2 d�gitos verificadores para o n�mero-efetivo pEfetivo de
 * CNPJ (12 d�gitos) ou CPF (9 d�gitos) fornecido. pIsCnpj � booleano e
 * informa se o n�mero-efetivo fornecido � CNPJ (default = false).
 * @param String pEfetivo
 * 	String do n�mero-efetivo (SEM d�gitos verificadores) de CNPJ ou CPF.
 * @param boolean pIsCnpj
 * 	Indica se a string fornecida � de um CNPJ.
 * 	Caso contr�rio, � CPF. Default = false (CPF).
 * @return String com os dois d�gitos verificadores.
 */
function dvCpfCnpj(pEfetivo, pIsCnpj)
{
	if (pIsCnpj==null) pIsCnpj = false;
	var i, j, k, soma, dv;
	var cicloPeso = pIsCnpj? NUM_DGT_CNPJ_BASE: NUM_DIGITOS_CPF;
	var maxDigitos = pIsCnpj? NUM_DIGITOS_CNPJ: NUM_DIGITOS_CPF;
	var calculado = formatCpfCnpj(pEfetivo, false, pIsCnpj);
	calculado = calculado.substring(2, maxDigitos);
	var result = "";

	for (j = 1; j <= 2; j++)
	{
		k = 2;
		soma = 0;
		for (i = calculado.length-1; i >= 0; i--)
		{
			soma += (calculado.charAt(i) - '0') * k;
			k = (k-1) % cicloPeso + 2;
		}
		dv = 11 - soma % 11;
		if (dv > 9) dv = 0;
		calculado += dv;
		result += dv
	}

	return result;
} //dvCpfCnpj


/**
 * Testa se a String pCpf fornecida � um CPF v�lido.
 * Qualquer formata��o que n�o seja algarismos � desconsiderada.
 * @param String pCpf
 * 	String fornecida para ser testada.
 * @return <code>true</code> se a String fornecida for um CPF v�lido.
 */
function isCpf(pCpf)
{

	if (pCpf.length != 11) {
		return false;
	}
	var i; 
  	s = pCpf; 
  	var c = s.substr(0,9); 
  	var dv = s.substr(9,2); 
  	var d1 = 0; 
  
	for (i = 0; i < 9; i++){
		d1 += c.charAt(i)*(10-i); 
  	} 
  
	if (d1 == 0){ 
  		return false; 
  	} 
  
	d1 = 11 - (d1 % 11); 
  	if (d1 > 9) d1 = 0; 
  	if (dv.charAt(0) != d1){ 
  		return false; 
  	} 
  	d1 *= 2; 
  	for (i = 0; i < 9; i++){ 
  		d1 += c.charAt(i)*(11-i); 
  	} 
  
	d1 = 11 - (d1 % 11); 
  
	if (d1 > 9) d1 = 0; 
 	
 	if (dv.charAt(1) != d1){ 
  		return false; 
  	} 
  
	return true; 
  
	
	
	
} //isCpf


/**
 * Testa se a String pCnpj fornecida � um CNPJ v�lido.
 * Qualquer formata��o que n�o seja algarismos � desconsiderada.
 * @param String pCnpj
 * 	String fornecida para ser testada.
 * @return <code>true</code> se a String fornecida for um CNPJ v�lido.
 */
function isCnpj(pCnpj)
{
	
	// verifica o tamanho
	pcgc=pCnpj;
	if (pcgc.length != 14) {
 		sim=false;
 		//alert ("Tamanho Invalido de CGC");
		return false;
	}else{
		sim=true;
	}

	if (sim ){  // verifica se e numero
   		for (i=0;((i<=(pcgc.length-1))&& sim); i++){
  			val = pcgc.charAt(i);
       		// alert (val);
   			if((val!="9")&&(val!="0")&&(val!="1")&&(val!="2")&&(val!="3")&&(val!="4") && (val!="5")&&(val!="6")&&(val!="7")&&(val!="8")){
				sim=false;
				return false;
			}
   		}
   		if (sim){  // se for numero continua
   
    		m2 = 2;
    		soma1 = 0;
    		soma2 = 0;
    		for (i=11;i>=0;i--){
    
     			val = eval(pcgc.charAt(i));
       		// alert ("Valor do Val: "+val);
     			m1 = m2;
  				if (m2<9) { 
					m2 = m2+1;
				}else{
  					m2 = 2;
				}
  				soma1 = soma1 + (val * m1);
  				soma2 = soma2 + (val * m2);
    		}  // fim do for de soma
	
  			soma1 = soma1 % 11;
  			if (soma1 < 2) {  
				d1 = 0;
			}else{ 
				d1 = 11- soma1;
			}
			soma2 = (soma2 + (2 * d1)) % 11;
  			if (soma2 < 2) { 
				d2 = 0;
			}else{ 
				d2 = 11- soma2;
			}
        		// alert (d1);
       		// alert (d2);
    		if ((d1==pcgc.charAt(12)) && (d2==pcgc.charAt(13))){ 
				//alert("Valor Valido de CCG");
				return true;
			} else{
				//alert("Valor invalido de CCG");
				return false;
   			}
		}

	}
	
	
	
	
} //isCnpj


/**
 * Testa se a String pCpfCnpj fornecida � um CPF ou CNPJ v�lido.
 * Se a String tiver uma quantidade de d�gitos igual ou inferior
 * a 11, valida como CPF. Se for maior que 11, valida como CNPJ.
 * Qualquer formata��o que n�o seja algarismos � desconsiderada.
 * @param String pCpfCnpj
 * 	String fornecida para ser testada.
 * @return <code>true</code> se a String fornecida for um CPF ou CNPJ v�lido.
 */
function isCpfCnpj(pCpfCnpj)
{
	var numero = pCpfCnpj.replace(/\D/g, "");
	if (numero.length > NUM_DIGITOS_CPF)
		return isCnpj(pCpfCnpj)
	else
		return isCpf(pCpfCnpj);
} //isCpfCnpj

function isINSS(pINSS){
	Fcamp=pINSS;
	if(isInteger(Fcamp)==false){
		return false;
	}
	if(0==Fcamp){
		return false;
	}
	if(Fcamp.length!=11){
		return false;
	}
	
	FTAB = "3298765432";
	TOT = 0;
	for(I=0;I<10;I++){
		TOT = TOT + Fcamp.substring(I,I+1) * FTAB.substring(I,I+1);
	}

	RESTO = TOT % 11;
	if(RESTO!=0){
		RESTO = 11 - RESTO;
	}
	if(10==RESTO){RESTO=0;}
	if(RESTO!=Fcamp.substring(10,11)){
		return false;
	}
	return true;

}

