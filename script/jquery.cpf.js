jQuery.validator.addMethod("cpf", function(value, element) {
        value = value.replace('.','');
        value = value.replace('.','');
        nro = value.replace('-','');

        while(nro.length < 11) nro = "0"+ nro;

        var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
        var a = [];
        var b = new Number;
        var c = 11;

        for (i=0; i<11; i++){
            a[i] = nro.charAt(i);
            if (i < 9) b += (a[i] * --c);
        }

        if ((x = b % 11) < 2) {
            a[9] = 0
        }
        else {
            a[9] = 11-x
        }

        b = 0;
        c = 11;

        for (y=0; y<10; y++) b += (a[y] * c--);

        if ((x = b % 11) < 2) {
            a[10] = 0;
        }
        else {
            a[10] = 11-x;
        }

        if ((nro.charAt(9) != a[9]) || (nro.charAt(10) != a[10]) || nro.match(expReg)) return false;

        return true;
    },

    "Informe um CPF válido."
);
