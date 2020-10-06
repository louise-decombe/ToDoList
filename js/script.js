$(document).ready(function () {

    /**SHOW CONNECT FROM */
    $('#connect').click(function () {
        $.get(
            'connexion.php',
            $('#connect_form'),
            function (data) {

                $('main').html(data);
                console.log("ok")

            }
        )


    })
    /** SHOW REGISTER FORM */
    $('#register').click(function () {
        $.get(
            'register.php',
            $('#register_form'),
            function (data) {

                $('main').html(data);
                console.log("ok")

            }
        )
    })
    /**PROCESS REGISTER FORM */
    $('#register_form').submit(function (event) {

        event.preventDefault();
        let login = $("#login").val();
        let password = $("#password").val();
        let pwd_confirm = $("#pwd_confirm").val();
        console.log('ok');

        if (login != "" && password != "" && pwd_confirm != "") {
            console.log("ok2")
            $.ajax({

                url: "traitement/register_process.php",
                type: "POST",
                data: {
                    login: login,
                    password: password,
                    pwd_confirm: pwd_confirm,

                },

                success: function (data) {

                    data = JSON.parse(data)
                    console.log(data)
                    if (data.erreur) {
                        $('#error').empty();
                        $('#error').removeClass("alert alert-danger")
                        $('#error').html(data.erreur)
                        $('#error').addClass("alert alert-danger")
                    } else if (data.msg == "registered") {
                        $.get(
                            'connexion.php',
                            $('#connect_form'),
                            function (data) {
                
                                $('main').html(data);
                                console.log("ok")
                
                            }
                        )

                        console.log(data.msg);
                    }



                },
                error: function (data) {
                    console.log(data)
                }
            });
        } else {
            alert('Veuillez remplir tous les champs !');
        }




    })

/** PROCESS CONNECT FORM */

    $('#connect_form').submit(function (event) {

        event.preventDefault();
        let login = $("#login").val();
        let password = $("#password").val();

        console.log('ok');

        if (login != "" && password != "") {
            console.log("ok2")
            $.ajax({

                url: "traitement/connect_process.php",
                type: "POST",
                data: {
                    login: login,
                    password: password,


                },

                success: function (data) {

                    data = JSON.parse(data)
                    console.log(data)
                    if (data.erreur) {
                        console.log("error")
                        $('#error').empty();
                        $('#error').removeClass("alert alert-danger")
                        $('#error').html(data.erreur)
                        $('#error').addClass("alert alert-danger")
                    } else {
                        window.location = "todolist.php";

                        console.log(data.msg);
                    }



                },
                error: function (data) {
                    console.log(data)
                }
            });
        } else {
            alert('Veuillez remplir tous les champs !');
        }




    })




})