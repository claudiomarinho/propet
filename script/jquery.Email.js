/**
 * Validação de e-mail
 */
jQuery.validator.addMethod("Email", function(value,element) {
    var verifyEmail=/^[\w-]+(\.[\w-]+)*@(([\w-]{2,63}\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
    return this.optional(element)||verifyEmail.test(value);
    }, "Informe um e-mail válido");