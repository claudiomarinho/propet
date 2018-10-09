jQuery.validator.addMethod("dateBR", function(value, element, param) {
    //contando chars

    if(param==false)return true;
    if(value.length!=10) return false;
    // verificando data
    var data = value;
    var dia = data.substr(0,2);
    var barra1 = data.substr(2,1);
    var mes = data.substr(3,2);
    var barra2 = data.substr(5,1);
    var ano = data.substr(6,4);
    if(data.length!=10||barra1!="/"||barra2!="/"||isNaN(dia)||isNaN(mes)||isNaN(ano)||dia>31||mes>12)return false;
    if((mes==4||mes==6||mes==9||mes==11)&&dia==31)return false;
    if(mes==2 && (dia>29||(dia==29&&ano%4!=0)))return false;
    if(ano < 1900)return false;
    return true;

    
}, "Informe uma data válida");

jQuery.validator.addMethod("timeBR", function (value, element, param){
    if(param==false)return true;
    if (value.length!=5) return false;
    var horas = value;
    var hora = horas.substr(0,2);
    var pontos = horas.substr(2,1);
    var minutos = horas.substr(3,2);
    
    if (horas.length!=5 || hora > 24 || minutos > 59) return false;
    return true;

}, "Informe um horário válido (HH:MM)");