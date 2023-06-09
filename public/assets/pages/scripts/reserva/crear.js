$(document).ready(function () {
    Intranet.validacionGeneral('form-general');

    $('.nuevo').hide();

    $("#nuevo_cliente").change(function(){
        if($(this).is(':checked')){
            $('.nuevo').show();
            $('#cliente_id').removeAttr('required');
            $('label[for=cliente_id]').removeClass('requerido');


            $('#nombre').attr('required', true);
            $('label[for=nombre]').addClass('requerido');

            $('#apellidos').attr('required', true);
            $('label[for=apellidos]').addClass('requerido');

            $('#dni').attr('required', true);
            $('label[for=dni]').addClass('requerido');

            $('#email').attr('required', true);
            $('label[for=email]').addClass('requerido');

        }else{
            $('.nuevo').hide();

            $('#cliente_id').attr('required');
            $('label[for=cliente_id]').addClass('requerido');

            $('#nombre').removeAttr('required');
            $('label[for=nombre]').removeClass('requerido');

            $('#apellidos').removeAttr('required');
            $('label[for=apellidos]').removeClass('requerido');

            $('#dni').removeAttr('required');
            $('label[for=dni]').removeClass('requerido');

            $('#email').removeAttr('required');
            $('label[for=email]').removeClass('requerido');
        }
    });
});
