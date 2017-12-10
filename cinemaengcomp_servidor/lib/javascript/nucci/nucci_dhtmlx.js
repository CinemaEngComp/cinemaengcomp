/*
Modificações no DHTMLX

Historico de Alteração
	Feito por: JB
	Data: 08/12/2010
	Descrição: Criação de função para trocar . (ponto) por , (vírgula) do separador de decimal de determiando número
	Função criada: ajustVALUEFROM2
*/
// FCV - 10/12/2015 - Novas funcoes

//function eXcell_nucci_double(cell){                                    //excell name is defined here
function eXcell_nucci_double(cell){                                    //excell name is defined here
      if (cell){                                                     //default pattern, just copy it
          this.cell = cell;
          this.grid = this.cell.parentNode.grid;
		  this.cell._rval=0;
//          eXcell_ed.call(this);                                //use methods of "ed" excell
      }
		this.edit = function(){
			this.cell.innerHTML = "";
			this.cell.atag="INPUT";
			this.val = this.getValue();
//			this.val=this.val.toString().replace(".",","); // << this line added			
			this.obj = document.createElement(this.cell.atag);
			this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
			this.obj.className="dhx_combo_edit";
			this.obj.type = "text";
			this.obj.wrap = "soft";
			this.obj.style.textAlign = this.cell.align;
			this.obj.onclick = function(e){(e||event).cancelBubble = true};
			this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
			
			this.obj.onkeypress = function(e){
				strCheck = '0123456789,';
				if (window.event) whichCode = window.event.keyCode;
				else if (e) whichCode = e.which;			
				
				if (whichCode == 0) return true;  // TECLA Enter
				if (whichCode == 13) return true;  // TECLA Enter
				if (whichCode == 8) return true;   // TECLA BkSpace
				key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
				if (strCheck.indexOf(key) == -1) {
					return false;  // NAUM EH UMA TECLA VALIDA
				}			
			}
			var val=this.cell._rval;
//			val=val.toString().replace(".","");
		
			this.obj.value = this.formatCurrency3(val)||"";
//			this.val=this.val.toString().replace(".",","); // << this line added			
			
			this.cell.appendChild(this.obj);
			if (_isFF){this.obj.style.overflow="visible";
				if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
					this.obj.style.height="36px";
					this.obj.style.overflow="scroll";
				}
			};
			this.obj.onselectstart=function(e){
				if (!e)e=event;e.cancelBubble=true;
				return true
			};
			this.obj.focus();
			this.obj.focus();
			this.obj.select();

		 };	  
	 this.getValue = function(){

		return this.cell._rval;
	};
	this.setValue = function(val){

		val=val.toString().replace(".",",");
		this.cell.innerHTML = this.formatCurrency2(this.Fix_Float_Valor(val),'');
		val=val.toString().replace(",",".");
		if (""!=val) {
	        this.cell._clearCell=false;
		} else {
	        this.cell._clearCell=true;
		}
		this.cell._rval=val;

		this.grid.callEvent("onCellChanged", [
			this.cell.parentNode.idd,
			this.cell._cellIndex,
			(arguments.length > 1 ? val2 : val)
		]);
	};
	this.detach = function(){
		this.setValue(this.obj.value);
		return this.val!=this.getValue();
	}
	this.Fix_Float_Valor=function (valor) {
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
	}	  
	this.formatCurrency2=function(num) {
		if ('undefined'==num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
	this.formatCurrency3=function(num) {
//		if ('undefined'==num) { return ''; }
		if (undefined===num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+''+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
  }
  eXcell_nucci_double.prototype = new eXcell;  
function eXcell_nucci_percentual(cell){ 
 //excell name is defined here
      if (cell){                                                     //default pattern, just copy it
          this.cell = cell;
          this.grid = this.cell.parentNode.grid;
//          eXcell_ed.call(this);                                //use methods of "ed" excell
      }
		this.edit = function(){
			this.cell.innerHTML = "";
			this.cell.atag="INPUT";
			this.val = this.getValue();
//			this.val=this.val.toString().replace(".",","); // << this line added			
			this.obj = document.createElement(this.cell.atag);
			this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
			this.obj.className="dhx_combo_edit";
			this.obj.type = "text";
			this.obj.wrap = "soft";
			this.obj.style.textAlign = this.cell.align;
			this.obj.onclick = function(e){(e||event).cancelBubble = true};
			this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
			
			this.obj.onkeypress = function(e){
				strCheck = '0123456789,';
				if (window.event) whichCode = window.event.keyCode;
				else if (e) whichCode = e.which;			
				
				if (whichCode == 0) return true;  // TECLA Enter
				if (whichCode == 13) return true;  // TECLA Enter
				if (whichCode == 8) return true;   // TECLA BkSpace
				key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
				if (strCheck.indexOf(key) == -1) {
					return false;  // NAUM EH UMA TECLA VALIDA
				}			
			}
			var val=this.cell._rval;
//			val=val.toString().replace(".","");
		
			this.obj.value = accounting.formatMoney((val),{symbol: "",  format: "%v", decimal: ",", thousand: "",precision:2  },2,".",",")||"";
//			this.val=this.val.toString().replace(".",","); // << this line added			
			
			this.cell.appendChild(this.obj);
			if (_isFF){this.obj.style.overflow="visible";
				if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
					this.obj.style.height="36px";
					this.obj.style.overflow="scroll";
				}
			};
			this.obj.onselectstart=function(e){
				if (!e)e=event;e.cancelBubble=true;
				return true
			};
			this.obj.focus();
			this.obj.focus();
			this.obj.select();

		 };	  
	 this.getValue = function(){
//		alert(this.cell._rval);
		return this.cell._rval;
	};
	this.setValue = function(val){

		if (""==val) {val=0;}
		val=val.toString().replace(".",",");

		val=val.toString().replace(",",".");
		val=parseFloat(val);

		this.cell.innerHTML = accounting.formatMoney((val),{ symbol: "%",  format: "%v%s", decimal: ",", thousand: ".",precision:2 },2,".",",");
		if (""!=val) {
	        this.cell._clearCell=false;
		} else {
	        this.cell._clearCell=true;
		}

		this.cell._rval=parseFloat(val);

		this.grid.callEvent("onCellChanged", [
			this.cell.parentNode.idd,
			this.cell._cellIndex,
			(arguments.length > 1 ? val2 : val)
		]);
	};
	this.detach = function(){
		this.setValue(this.obj.value);
		return this.val!=this.getValue();
	}
	this.Fix_Float_Valor=function (valor) {
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace('%', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
	}	  
	this.formatCurrency2=function(num) {
		if ('undefined'==num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
	this.roundToTwo=function(value) {
    	return(Math.round(value * 100) / 100);
	}	
	this.formatCurrency3=function(num) {
		if ('undefined'==num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+''+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
  }
  eXcell_nucci_percentual.prototype = new eXcell;

//function eXcell_nucci_percentual(cell){                                    //excell name is defined here
//      if (cell){                                                     //default pattern, just copy it
//          this.cell = cell;
//          this.grid = this.cell.parentNode.grid;
////          eXcell_ed.call(this);                                //use methods of "ed" excell
//      }
//		this.edit = function(){
//			this.cell.innerHTML = "";
//			this.cell.atag="INPUT";
//			this.val = this.getValue();
////			this.val=this.val.toString().replace(".",","); // << this line added			
//			this.obj = document.createElement(this.cell.atag);
//			this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
//			this.obj.className="dhx_combo_edit";
//			this.obj.type = "text";
//			this.obj.wrap = "soft";
//			this.obj.style.textAlign = this.cell.align;
//			this.obj.onclick = function(e){(e||event).cancelBubble = true};
//			this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
//			
//			this.obj.onkeypress = function(e){
//				strCheck = '0123456789,';
//				if (window.event) whichCode = window.event.keyCode;
//				else if (e) whichCode = e.which;			
//				
//				if (whichCode == 0) return true;  // TECLA Enter
//				if (whichCode == 13) return true;  // TECLA Enter
//				if (whichCode == 8) return true;   // TECLA BkSpace
//				key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
//				if (strCheck.indexOf(key) == -1) {
//					return false;  // NAUM EH UMA TECLA VALIDA
//				}			
//			}
//			var val=this.cell._rval;
////			val=val.toString().replace(".","");
//		
//			this.obj.value = this.formatCurrency3(val)||"";
////			this.val=this.val.toString().replace(".",","); // << this line added			
//			
//			this.cell.appendChild(this.obj);
//			if (_isFF){this.obj.style.overflow="visible";
//				if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
//					this.obj.style.height="36px";
//					this.obj.style.overflow="scroll";
//				}
//			};
//			this.obj.onselectstart=function(e){
//				if (!e)e=event;e.cancelBubble=true;
//				return true
//			};
//			this.obj.focus();
//			this.obj.focus();
//			this.obj.select();
//
//		 };	  
//	 this.getValue = function(){
////		alert(this.cell._rval);
//		return this.cell._rval;
//	};
//	this.setValue = function(val){
////		this.cell.innerHTML = formatCurrency2(val,'');
////		this.cell._rval=parseFloat(Fix_Float_Valor(val));
//		if (""==val) {val=0;}
//		val=val.toString().replace(".",",");
//		this.cell.innerHTML = this.formatCurrency2(this.Fix_Float_Valor(val),'')+'%';
//		val=val.toString().replace(",",".");
//		if (""!=val) {
//	        this.cell._clearCell=false;
//		} else {
//	        this.cell._clearCell=true;
//		}
//		this.cell._rval=val;
//		this.grid.callEvent("onCellChanged", [
//			this.cell.parentNode.idd,
//			this.cell._cellIndex,
//			(arguments.length > 1 ? val2 : val)
//		]);
//	};
//	this.detach = function(){
//		this.setValue(this.obj.value);
//		return this.val!=this.getValue();
//	}
//	this.Fix_Float_Valor=function (valor) {
//		valor1 = valor.replace('.', '');
//		valor1 = valor1.replace('.', '');
//		valor1 = valor1.replace('.', '');
//		valor1 = valor1.replace('.', '');
//		valor1 = valor1.replace('.', '');
//		valor1 = valor1.replace('R', '');
//		valor1 = valor1.replace('$', '');
//		valor1 = valor1.replace(',', '.');
//		return valor1;
//	}	  
//	this.formatCurrency2=function(num) {
//		if ('undefined'==num) { return ''; }
//		num = num.toString().replace(/\$|\,/g,'');
//		if(isNaN(num))
//		num = "0";
//		sign = (num == (num = Math.abs(num)));
//		num = Math.floor(num*100+0.50000000001);
//		cents = num%100;
//		num = Math.floor(num/100).toString();
//		if(cents<10)
//		cents = "0" + cents;
//		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
//		num = num.substring(0,num.length-(4*i+3))+'.'+
//		num.substring(num.length-(4*i+3));
//		return (((sign)?'':'-') + '' + num + ',' + cents);
//	}	
//	this.formatCurrency3=function(num) {
//		if ('undefined'==num) { return ''; }
//		num = num.toString().replace(/\$|\,/g,'');
//		if(isNaN(num))
//		num = "0";
//		sign = (num == (num = Math.abs(num)));
//		num = Math.floor(num*100+0.50000000001);
//		cents = num%100;
//		num = Math.floor(num/100).toString();
//		if(cents<10)
//		cents = "0" + cents;
//		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
//		num = num.substring(0,num.length-(4*i+3))+''+
//		num.substring(num.length-(4*i+3));
//		return (((sign)?'':'-') + '' + num + ',' + cents);
//	}	
//  }
//  eXcell_nucci_percentual.prototype = new eXcell;  

function eXcell_nucci_double_4casas(cell){                                    //excell name is defined here
      if (cell){                                                     //default pattern, just copy it
          this.cell = cell;
          this.grid = this.cell.parentNode.grid;
//          eXcell_ed.call(this);                                //use methods of "ed" excell
      }
		this.edit = function(){
			this.cell.innerHTML = "";
			this.cell.atag="INPUT";
			this.val = this.getValue();
//			this.val=this.val.toString().replace(".",","); // << this line added			
			this.obj = document.createElement(this.cell.atag);
			this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
			this.obj.className="dhx_combo_edit";
			this.obj.type = "text";
			this.obj.wrap = "soft";
			this.obj.style.textAlign = this.cell.align;
			this.obj.onclick = function(e){(e||event).cancelBubble = true};
			this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
			
			this.obj.onkeypress = function(e){
				strCheck = '0123456789,';
				if (window.event) whichCode = window.event.keyCode;
				else if (e) whichCode = e.which;			
				
				if (whichCode == 0) return true;  // TECLA Enter
				if (whichCode == 13) return true;  // TECLA Enter
				if (whichCode == 8) return true;   // TECLA BkSpace
				key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
				if (strCheck.indexOf(key) == -1) {
					return false;  // NAUM EH UMA TECLA VALIDA
				}			
			}
			var val=this.cell._rval;
//			val=val.toString().replace(".","");
		
			this.obj.value = this.formatCurrency3(val)||"";
//			this.val=this.val.toString().replace(".",","); // << this line added			
			
			this.cell.appendChild(this.obj);
			if (_isFF){this.obj.style.overflow="visible";
				if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
					this.obj.style.height="36px";
					this.obj.style.overflow="scroll";
				}
			};
			this.obj.onselectstart=function(e){
				if (!e)e=event;e.cancelBubble=true;
				return true
			};
			this.obj.focus();
			this.obj.focus();
			this.obj.select();

		 };	  
	 this.getValue = function(){
//		alert(this.cell._rval);
		return this.cell._rval;
	};
	this.setValue = function(val){
//		this.cell.innerHTML = formatCurrency2(val,'');
//		this.cell._rval=parseFloat(Fix_Float_Valor(val));
		val=val.toString().replace(".",",");
		this.cell.innerHTML = this.formatCurrency2(this.Fix_Float_Valor(val),'');
		val=val.toString().replace(",",".");
		if (""!=val) {
	        this.cell._clearCell=false;
		} else {
	        this.cell._clearCell=true;
		}
		this.cell._rval=val;
		this.grid.callEvent("onCellChanged", [
			this.cell.parentNode.idd,
			this.cell._cellIndex,
			(arguments.length > 1 ? val2 : val)
		]);
	};
	this.detach = function(){
		this.setValue(this.obj.value);
		return this.val!=this.getValue();
	}
	this.Fix_Float_Valor=function (valor) {
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
	}	  
	this.formatCurrency2=function(num) {
		if ('undefined'==num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*10000+0.50000000001);
		cents = num%10000;
		num = Math.floor(num/10000).toString();
		if(cents<10)
		cents = "0" + cents;
		if(cents<100)
		cents = "0" + cents;
		if(cents<1000)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
	this.formatCurrency3=function(num) {
//		if ('undefined'==num) { return ''; }
		if (undefined===num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*10000+0.50000000001);
		cents = num%10000;
		num = Math.floor(num/10000).toString();
		if(cents<10)
		cents = "0" + cents;
		if(cents<100)
		cents = "0" + cents;
		if(cents<1000)
		cents = "0" + cents;

		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+''+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
  }
  eXcell_nucci_double_4casas.prototype = new eXcell;  
  
function eXcell_nucci_double_3casas(cell){                                    //excell name is defined here
      if (cell){                                                     //default pattern, just copy it
          this.cell = cell;
          this.grid = this.cell.parentNode.grid;
//          eXcell_ed.call(this);                                //use methods of "ed" excell
      }
		this.edit = function(){
			this.cell.innerHTML = "";
			this.cell.atag="INPUT";
			this.val = this.getValue();
//			this.val=this.val.toString().replace(".",","); // << this line added			
			this.obj = document.createElement(this.cell.atag);
			this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
			this.obj.className="dhx_combo_edit";
			this.obj.type = "text";
			this.obj.wrap = "soft";
			this.obj.style.textAlign = this.cell.align;
			this.obj.onclick = function(e){(e||event).cancelBubble = true};
			this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
			
			this.obj.onkeypress = function(e){
				strCheck = '0123456789,';
				if (window.event) whichCode = window.event.keyCode;
				else if (e) whichCode = e.which;			
				
				if (whichCode == 0) return true;  // TECLA Enter
				if (whichCode == 13) return true;  // TECLA Enter
				if (whichCode == 8) return true;   // TECLA BkSpace
				key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
				if (strCheck.indexOf(key) == -1) {
					return false;  // NAUM EH UMA TECLA VALIDA
				}			
			}
			var val=this.cell._rval;
//			val=val.toString().replace(".","");
		
			this.obj.value = this.formatCurrency3(val)||"";
//			this.val=this.val.toString().replace(".",","); // << this line added			
			
			this.cell.appendChild(this.obj);
			if (_isFF){this.obj.style.overflow="visible";
				if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
					this.obj.style.height="36px";
					this.obj.style.overflow="scroll";
				}
			};
			this.obj.onselectstart=function(e){
				if (!e)e=event;e.cancelBubble=true;
				return true
			};
			this.obj.focus();
			this.obj.focus();
			this.obj.select();

		 };	  
	 this.getValue = function(){
//		alert(this.cell._rval);
		return this.cell._rval;
	};
	this.setValue = function(val){
//		this.cell.innerHTML = formatCurrency2(val,'');
//		this.cell._rval=parseFloat(Fix_Float_Valor(val));
		val=val.toString().replace(".",",");
		this.cell.innerHTML = this.formatCurrency2(this.Fix_Float_Valor(val),'');
		val=val.toString().replace(",",".");
		if (""!=val) {
	        this.cell._clearCell=false;
		} else {
	        this.cell._clearCell=true;
		}
		this.cell._rval=val;
		this.grid.callEvent("onCellChanged", [
			this.cell.parentNode.idd,
			this.cell._cellIndex,
			(arguments.length > 1 ? val2 : val)
		]);
	};
	this.detach = function(){
		this.setValue(this.obj.value);
		return this.val!=this.getValue();
	}
	this.Fix_Float_Valor=function (valor) {
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
	}	  
	this.formatCurrency2=function(num) {
		if ('undefined'==num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*10000+0.50000000001);
		cents = num%10000;
		num = Math.floor(num/10000).toString();
		if(cents<10)
		cents = "0" + cents;
		if(cents<100)
		cents = "0" + cents;
		if(cents<1000)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
	this.formatCurrency3=function(num) {
//		if ('undefined'==num) { return ''; }
		if (undefined===num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*10000+0.50000000001);
		cents = num%10000;
		num = Math.floor(num/10000).toString();
		if(cents<10)
		cents = "0" + cents;
		if(cents<100)
		cents = "0" + cents;
		if(cents<1000)
		cents = "0" + cents;

		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+''+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
  }
  eXcell_nucci_double_3casas.prototype = new eXcell;  
  
function eXcell_nuccinumber_simple(cell){                                    //excell name is defined here
	if (cell){                                                     //default pattern, just copy it
          this.cell = cell;
          this.grid = this.cell.parentNode.grid;
//          eXcell_ed.call(this);                                //use methods of "ed" excell
    }
	this.edit = function(){
		this.cell.innerHTML = "";
		this.cell.atag="INPUT";
		this.val = this.getValue();
		this.obj = document.createElement(this.cell.atag);
		this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
		this.obj.className="dhx_combo_edit";
		this.obj.type = "text";
		this.obj.wrap = "soft";
		this.obj.style.textAlign = this.cell.align;
		this.obj.onclick = function(e){(e||event).cancelBubble = true};
		this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
			
		this.obj.onkeypress = function(e){
			strCheck = '0123456789';
			if (window.event) whichCode = window.event.keyCode;
			else if (e) whichCode = e.which;			
				
			if (whichCode == 0) return true;  // TECLA Enter
			if (whichCode == 13) return true;  // TECLA Enter
			if (whichCode == 8) return true;   // TECLA BkSpace
			key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
			if (strCheck.indexOf(key) == -1) {
				return false;  // NAUM EH UMA TECLA VALIDA
			}			
		}				
		this.obj.value = this.cell._rval||"0";
		this.cell.appendChild(this.obj);
		if (_isFF){
			this.obj.style.overflow="visible";
			if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
					this.obj.style.height="36px";
				this.obj.style.overflow="scroll";
			}
		};
		this.obj.onselectstart=function(e){
			if (!e)e=event;e.cancelBubble=true;
			return true
		};
		this.obj.focus();
		this.obj.focus();
		this.obj.select();

	};	  
	this.getValue = function(){
//		console.log('simple getValue');
//		console.log('val='+this.cell._rval);
		if (this.isEmpty(this.cell._rval)) {
			this.cell._rval=0;	
		}
	 	return this.cell._rval;
	};
	this.setValue = function(val){
//		console.log('simple setValue');
//		console.log('val='+val);
		if (this.isEmpty(val)) {
			val=0;	
		}
 		this.cell.innerHTML = val;
		this.cell._rval=val;
	};
	this.detach = function(){
		this.setValue(this.obj.value);
		return this.val!=this.getValue();
	}
 	this.isEmpty = function(val){
    	return (val === undefined || val == null || val.length <= 0) ? true : false;
	}
};
eXcell_nuccinumber_simple.prototype = new eXcell;  
  
  
function eXcell_nucci_percentual3casas (cell){                                    //excell name is defined here
      if (cell){                                                     //default pattern, just copy it
          this.cell = cell;
          this.grid = this.cell.parentNode.grid;
//          eXcell_ed.call(this);                                //use methods of "ed" excell
      }
		this.edit = function(){
			this.cell.innerHTML = "";
			this.cell.atag="INPUT";
			this.val = this.getValue();
//			this.val=this.val.toString().replace(".",","); // << this line added			
			this.obj = document.createElement(this.cell.atag);
			this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
			this.obj.className="dhx_combo_edit";
			this.obj.type = "text";
			this.obj.wrap = "soft";
			this.obj.style.textAlign = this.cell.align;
			this.obj.onclick = function(e){(e||event).cancelBubble = true};
			this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
			
			this.obj.onkeypress = function(e){
				strCheck = '0123456789,';
				if (window.event) whichCode = window.event.keyCode;
				else if (e) whichCode = e.which;			
				
				if (whichCode == 0) return true;  // TECLA Enter
				if (whichCode == 13) return true;  // TECLA Enter
				if (whichCode == 8) return true;   // TECLA BkSpace
				key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
				if (strCheck.indexOf(key) == -1) {
					return false;  // NAUM EH UMA TECLA VALIDA
				}			
			}
			var val=this.cell._rval;
//			val=val.toString().replace(".","");
		
			this.obj.value = accounting.formatMoney((val),{symbol: "",  format: "%v", decimal: ",", thousand: "",precision:3  },3,".",",")||"";
//			this.val=this.val.toString().replace(".",","); // << this line added			
			
			this.cell.appendChild(this.obj);
			if (_isFF){this.obj.style.overflow="visible";
				if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
					this.obj.style.height="36px";
					this.obj.style.overflow="scroll";
				}
			};
			this.obj.onselectstart=function(e){
				if (!e)e=event;e.cancelBubble=true;
				return true
			};
			this.obj.focus();
			this.obj.focus();
			this.obj.select();

		 };	  
	 this.getValue = function(){
//		alert(this.cell._rval);
		return this.cell._rval;
	};
	this.setValue = function(val){
//		this.cell.innerHTML = formatCurrency2(val,'');
//		this.cell._rval=parseFloat(Fix_Float_Valor(val));
		val=val.toString().replace(".",",");
//		this.cell.innerHTML = numeral(this.Fix_Float_Valor(val)).format('0.000%'); //this.formatCurrency3(this.Fix_Float_Valor(val),'')+"%";
		val=val.toString().replace(",",".");
		val=parseFloat(val);
//		this.cell.innerHTML = accounting.formatMoney((val),{ symbol: "%1",  format: "%v%s" },3,".",",");
		this.cell.innerHTML = accounting.formatMoney((val),{ symbol: "%",  format: "%v%s", decimal: ",", thousand: ".",precision:3 },3,".",",");
		if (""!=val) {
	        this.cell._clearCell=false;
		} else {
	        this.cell._clearCell=true;
		}
//		this.cell._rval=this.roundToTwo(val);
		this.cell._rval=parseFloat(val);
//		this.cell._rval=accounting.toFixed(parseFloat(val), 3);
//		console.log("this.cell._rval="+this.cell._rval);
		this.grid.callEvent("onCellChanged", [
			this.cell.parentNode.idd,
			this.cell._cellIndex,
			(arguments.length > 1 ? val2 : val)
		]);
	};
	this.detach = function(){
		this.setValue(this.obj.value);
		return this.val!=this.getValue();
	}
	this.Fix_Float_Valor=function (valor) {
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace('%', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
	}	  
	this.formatCurrency2=function(num) {
		if ('undefined'==num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
	this.roundToTwo=function(value) {
    	return(Math.round(value * 100) / 100);
	}	
	this.formatCurrency3=function(num) {
//		if ('undefined'==num) { return ''; }
		if (undefined===num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<100) cents = "0" + cents;
		if(cents<10) cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+''+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
  }
  eXcell_nucci_percentual3casas.prototype = new eXcell;  

function eXcell_nucci_fin_double(cell){                                    //excell name is defined here
      if (cell){                                                     //default pattern, just copy it
          this.cell = cell;
          this.grid = this.cell.parentNode.grid;
//          eXcell_ed.call(this);                                //use methods of "ed" excell
      }
		this.edit = function(){
			this.cell.innerHTML = "";
			this.cell.atag="INPUT";
			this.val = this.getValue();
//			this.val=this.val.toString().replace(".",","); // << this line added			
			this.obj = document.createElement(this.cell.atag);
			this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
			this.obj.className="dhx_combo_edit";
			this.obj.type = "text";
			this.obj.wrap = "soft";
			this.obj.style.textAlign = this.cell.align;
			this.obj.onclick = function(e){(e||event).cancelBubble = true};
			this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
			
			this.obj.onkeypress = function(e){
				strCheck = '0123456789,';
				if (window.event) whichCode = window.event.keyCode;
				else if (e) whichCode = e.which;			
				
				if (whichCode == 0) return true;  // TECLA Enter
				if (whichCode == 13) return true;  // TECLA Enter
				if (whichCode == 8) return true;   // TECLA BkSpace
				key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
				if (strCheck.indexOf(key) == -1) {
					return false;  // NAUM EH UMA TECLA VALIDA
				}			
			}
			var val=this.cell._rval;
//			val=val.toString().replace(".","");
		
			this.obj.value = this.formatCurrency3(val)||"";
//			this.val=this.val.toString().replace(".",","); // << this line added			
			
			this.cell.appendChild(this.obj);
			if (_isFF){this.obj.style.overflow="visible";
				if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
					this.obj.style.height="36px";
					this.obj.style.overflow="scroll";
				}
			};
			this.obj.onselectstart=function(e){
				if (!e)e=event;e.cancelBubble=true;
				return true
			};
			this.obj.focus();
			this.obj.focus();
			this.obj.select();

		 };	  
	 this.getValue = function(){
//		alert(this.cell._rval);
//		dhtmlx.message("_rval="+this.cell._rval);
		return this.cell._rval;
	};
	this.setValue = function(val){
//		this.cell.innerHTML = formatCurrency2(val,'');
//		this.cell._rval=parseFloat(Fix_Float_Valor(val));
		val=val.toString().replace(".",",");
		this.cell.innerHTML = this.formatCurrency2(this.Fix_Float_Valor(val),'');
		val=val.toString().replace(",",".");
		if (""!=val) {
	        this.cell._clearCell=false;
		} else {
	        this.cell._clearCell=true;
		}
		this.cell._rval=this.roundToTwo(val);
		this.grid.callEvent("onCellChanged", [
			this.cell.parentNode.idd,
			this.cell._cellIndex,
			(arguments.length > 1 ? val2 : val)
		]);
	};
	this.detach = function(){
		this.setValue(this.obj.value);
		return this.val!=this.getValue();
	}
	this.roundToTwo=function(value) {
    	return(Math.round(value * 100) / 100);
	}
	this.Fix_Float_Valor=function (valor) {
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
	}	  
	this.formatCurrency2=function(num) {
		if ('undefined'==num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
	this.formatCurrency3=function(num) {
//		if ('undefined'==num) { return ''; }
		if (undefined===num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+''+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
  }
  eXcell_nucci_fin_double.prototype = new eXcell;    


 
function eXcell_nucci_percentual4casas (cell){                                    //excell name is defined here
      if (cell){                                                     //default pattern, just copy it
          this.cell = cell;
          this.grid = this.cell.parentNode.grid;
//          eXcell_ed.call(this);                                //use methods of "ed" excell
      }
		this.edit = function(){
			this.cell.innerHTML = "";
			this.cell.atag="INPUT";
			this.val = this.getValue();
//			this.val=this.val.toString().replace(".",","); // << this line added			
			this.obj = document.createElement(this.cell.atag);
			this.obj.style.height = (this.cell.offsetHeight-(_isIE?6:4))+"px";
			this.obj.className="dhx_combo_edit";
			this.obj.type = "text";
			this.obj.wrap = "soft";
			this.obj.style.textAlign = this.cell.align;
			this.obj.onclick = function(e){(e||event).cancelBubble = true};
			this.obj.onmousedown = function(e){(e||event).cancelBubble = true};
	
			this.obj.onkeypress = function(e){
				strCheck = '0123456789,';
				if (window.event) whichCode = window.event.keyCode;
				else if (e) whichCode = e.which;			
				
				if (whichCode == 0) return true;  // TECLA Enter
				if (whichCode == 13) return true;  // TECLA Enter
				if (whichCode == 8) return true;   // TECLA BkSpace
				key = String.fromCharCode(whichCode);  // PEGA TECLA DIGITADA
				if (strCheck.indexOf(key) == -1) {
					return false;  // NAUM EH UMA TECLA VALIDA
				}			
			}
			var val=this.cell._rval;
//			val=val.toString().replace(".","");
	
			this.obj.value = accounting.formatMoney((val),{symbol: "",  format: "%v", decimal: ",", thousand: "",precision:4  },4,".",",")||"";
//			this.val=this.val.toString().replace(".",","); // << this line added			
			
			this.cell.appendChild(this.obj);
			if (_isFF){this.obj.style.overflow="visible";
				if ((this.grid.multiLine)&&(this.obj.offsetHeight>=18)&&(this.obj.offsetHeight<40)){
					this.obj.style.height="36px";
					this.obj.style.overflow="scroll";
				}
			};
			this.obj.onselectstart=function(e){
				if (!e)e=event;e.cancelBubble=true;
				return true
			};
			this.obj.focus();
			this.obj.focus();
			this.obj.select();

		 };	  
	 this.getValue = function(){
//		alert(this.cell._rval);
	
		return this.cell._rval;
	};
	this.setValue = function(val){
//		this.cell.innerHTML = formatCurrency2(val,'');
//		this.cell._rval=parseFloat(Fix_Float_Valor(val));
		val=val.toString().replace(".",",");
//		this.cell.innerHTML = numeral(this.Fix_Float_Valor(val)).format('0.000%'); //this.formatCurrency3(this.Fix_Float_Valor(val),'')+"%";
		val=val.toString().replace(",",".");
		val=parseFloat(val);

//		this.cell.innerHTML = accounting.formatMoney((val),{ symbol: "%1",  format: "%v%s" },3,".",",");
		this.cell.innerHTML = accounting.formatMoney((val),{ symbol: "%",  format: "%v%s", decimal: ",", thousand: ".",precision:4 },4,".",",");
		if (""!=val) {
	        this.cell._clearCell=false;
		} else {
	        this.cell._clearCell=true;
		}
//		this.cell._rval=this.roundToTwo(val);
		this.cell._rval=parseFloat(val);

//		this.cell._rval=accounting.toFixed(parseFloat(val), 3);
//		console.log("this.cell._rval="+this.cell._rval);
		this.grid.callEvent("onCellChanged", [
			this.cell.parentNode.idd,
			this.cell._cellIndex,
			(arguments.length > 1 ? val2 : val)
		]);
	};
	this.detach = function(){
		this.setValue(this.obj.value);
		return this.val!=this.getValue();
	}
	this.Fix_Float_Valor=function (valor) {
		valor1 = valor.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('.', '');
		valor1 = valor1.replace('R', '');
		valor1 = valor1.replace('$', '');
		valor1 = valor1.replace('%', '');
		valor1 = valor1.replace(',', '.');
		return valor1;
	}	  
	this.formatCurrency2=function(num) {
		if ('undefined'==num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+'.'+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
	this.roundToTwo=function(value) {
    	return(Math.round(value * 100) / 100);
	}	
	this.formatCurrency3=function(num) {
//		if ('undefined'==num) { return ''; }
		if (undefined===num) { return ''; }
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<1000) cents = "0" + cents;
		if(cents<100) cents = "0" + cents;
		if(cents<10) cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+''+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '' + num + ',' + cents);
	}	
  }
  eXcell_nucci_percentual4casas.prototype = new eXcell;  
  

function eXcell_nucci_simnao(cell){try{this.cell = cell;this.grid = this.cell.parentNode.grid;this.cell.obj = this}catch(er){};this.changeState = function(){if ((!this.grid.isEditable)||(this.cell.parentNode._locked)||(this.isDisabled())) return;if(this.grid.callEvent("onEditCell",[0,this.cell.parentNode.idd,this.cell._cellIndex])!=false){this.val = this.getValue()
 if(this.val=="1")this.setValue("<checkbox state='false'>")
 else
 this.setValue("<checkbox state='true'>")
 
 this.cell.wasChanged=true;this.grid.callEvent("onEditCell",[1,this.cell.parentNode.idd,this.cell._cellIndex]);this.grid.callEvent("onCheckbox",[this.cell.parentNode.idd,this.cell._cellIndex,(this.val!='1')])}else{this.editor=null}};this.getValue = function(){try{return this.cell.chstate.toString()}catch(er){return null}};this.isCheckbox = function(){return true};this.isChecked = function(){if(this.getValue()=="1")
 return true;else
 return false};this.setChecked = function(fl){this.setValue(fl.toString())
 };this.detach = function(){return this.val!=this.getValue()};this.drawCurrentState=function(){if (this.cell.chstate==1)return "<div onclick='(new eXcell_nucci_simnao(this.parentNode)).changeState();(arguments[0]||event).cancelBubble=true;' style='cursor:pointer;font-weight:bold;text-align:center;'><img height='13px' src='"+this.grid.imgURL+"green.gif'>&nbsp;Sim</div>";else
 return "<div onclick='(new eXcell_nucci_simnao(this.parentNode)).changeState();(arguments[0]||event).cancelBubble=true;' style='cursor:pointer;text-align:center;'><img height='13px' src='"+this.grid.imgURL+"red.gif'>&nbsp;Não</div>"}};eXcell_nucci_simnao.prototype = new eXcell;eXcell_nucci_simnao.prototype.setValue = function(val){val=(val||"").toString();if(val.indexOf("1")!=-1 || val.indexOf("true")!=-1){val = "1";this.cell.chstate = "1"}else{val = "0";this.cell.chstate = "0"
 };var obj = this;this.setCValue(this.drawCurrentState(),this.cell.chstate)};//(c)dhtmlx ltd. www.dhtmlx.com  

 if (typeof console === "undefined") console = {log: function() {}};