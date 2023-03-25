// Check User
$('#active').click(function () {
    if ($("#active").prop("checked") == true) {
        $(".strong-active").remove();
        $(".activelabel").append("<strong class='strong-active'>Ativo</strong>");
    } else {
        $(".strong-active").remove();
        $(".activelabel").append("<strong class='strong-active'>Inativo</strong>");
    }
});
$('#user').click(function () {
    if ($("#user").prop("checked") == true) {
        $(".strong-user").remove();
        $(".userlabel").append("<strong class='strong-user'>Sim</strong>");
    } else {
        $(".strong-user").remove();
        $(".userlabel").append("<strong class='strong-user'>Não</strong>");
    }
});
$('#admin').click(function () {
    if ($("#admin").prop("checked") == true) {
        $(".strong-admin").remove();
        $(".adminlabel").append("<strong class='strong-admin'>Sim</strong>");
    } else {
        $(".strong-admin").remove();
        $(".adminlabel").append("<strong class='strong-admin'>Não</strong>");

    }
});
$('#super_admin').click(function () {
    if ($("#super_admin").prop("checked") == true) {
        $(".strong-super-admin").remove();
        $(".superadminlabel").append("<strong class='strong-super-admin'>Sim</strong>");
    } else {
        $(".strong-super-admin").remove();
        $(".superadminlabel").append("<strong class='strong-super-admin'>Não</strong>");
    }
});
$('#tech').click(function () {
    if ($("#tech").prop("checked") == true) {
        $(".strong-tech").remove();
        $(".techlabel").append("<strong class='strong-tech'>Sim</strong>");
    } else {
        $(".strong-tech").remove();
        $(".techlabel").append("<strong class='stron-gtech'>Não</strong>");
    }
});


//Ajax

// New User
$(document).on('click','#button-new-user', function() {
    $('#form_new_user').submit(function (e) {
        e.preventDefault()
        var url = $(this).attr("action");
        var formData = new FormData($(this)[0])
        var form = formData
        $.ajax({
            data: form,
            url: url,
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,

            success: function (response) {

                $('[data-name="new-user"]').val('');
                $('#new-user').modal('hide');
                $("#load-section").load(location.href + " #load-section");

            },

            error: function (response) {

                if (response.responseJSON.errors.name) {
                    let name = response.responseJSON.errors.name
                    let error_name = '<p class="text-danger" role="alert"><i>' + name + '</i></p>'
                    $("#name p").empty()
                    $('#name').append(error_name)
                    $('#name .input-group input').addClass( " is-invalid" )
                }

                if(response.responseJSON.errors.phone) {
                    let phone = response.responseJSON.errors.phone
                    let error_phone = '<p class="text-danger" role="alert"><i>' + phone + '</i></p>'
                    $("#phone p").empty()
                    $('#phone').append(error_phone)
                    $('#phone .input-group input').addClass( " is-invalid" )
                }
                if(response.responseJSON.errors.photo_perfil) {
                    let photo = response.responseJSON.errors.photo_perfil
                    let error_photo = '<p class="text-danger" role="alert"><i>' + photo + '</i></p>'
                    $("#photo p").empty()
                    $('#photo').append(error_photo)
                    $('#photo .input-group input').addClass( " is-invalid" )
                }

                if(response.responseJSON.errors.email) {
                    let email = response.responseJSON.errors.email
                    let error_email = '<p class="text-danger" role="alert"><i>' + email + '</i></p>'
                    $("#email p").empty()
                    $('#email').append(error_email)
                    $('#email .input-group input').addClass( " is-invalid" )
                }

                if(response.responseJSON.errors.password) {
                    let password = response.responseJSON.errors.password
                    let error_password = '<p class="text-danger" role="alert"><i>' + password + '</i></p>'
                    $("#password p").empty()
                    $('#password').append(error_password)
                    $('#password .input-group input').addClass( " is-invalid" )
                }

            }
        })
    })
});

$("#clean-form-new-user").click(function () {
    $('[data-name="new-user"]').val('');
    $("#password p").empty()
});



// New password
$(document).on('click','#button-new-password', function() {
    $('#form_new_password').submit(function (e) {
        e.preventDefault()
        var url = $(this).attr("action");
        $.ajax({
            data: $(this).serialize(),
            url: url,
            type: 'post',
            dataType: 'json',

            success: function (response) {

                $('[data-name="new-password"]').val('');

                title = ' <i class="bi bi-check2-square"></i> '
                message = 'Senha Alterada com Sucesso!'
                template =
                    '<div class="alert alert-success" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                    notification(title, message, template)
                    $("#formNewPassword").load(location.href + " #formNewPassword");
            },

            error: function (response) {

                title = ' <i class="bi bi-exclamation-circle"> </i> '
                message = response.responseJSON.message
                template =
                    '<div class="alert alert-danger" role="alert">' +
                    '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                    '</div>'

                notification(title, message, template)
                $("#formNewPassword").load(location.href + " #formNewPassword");

            }
        })
    })
});

$("#cancel_alter_password").click(function () {
    $('[data-name="new-password"]').val('');
});
