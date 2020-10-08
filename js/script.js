$(document).ready(function () {

    function templateFormConnect() {
        return (`     
        <h1 class="text-center">Se connecter</h1>
        <div id="error"></div>
        <form action="" method="post" id="connect_form">
            <div class="form-group">
                <label for="login">Votre Login</label>
                <input type="text" id="login" name="login" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Votre mot de passe</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>


            <button type="submit" id="btn_connect" class="btn btn-success w-50">Valider</button>



        </form>
        <p class="text-center" id="not_registered">Pas de compte? <a href="#" id="register">S'incrire</a></p>
        
        `)
    }

    function templateFormRegister() {
        return (`            
        <h1 class="text-center">S'incrire</h1>
        <div id="error"></div>
        <form method="post" id="register_form">
            
            <div class="form-group">
                <label for="login">Votre Login</label>
                <input type="text" id="login" name="login" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Votre mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" >
            </div>
            <div class="form-group">
                <label for="pwd_confirm">Confirmation mot de passe</label>
                <input type="password" id="pwd_confirm" name="pwd_confirm" class="form-control">
            </div>
            <button type="submit" id="btn_register" class="btn btn-success">S'incrire</button>
        </form>
        <p class="text-center">Déja inscrit ? <a href="#" id="connect" >Connectez vous</a></p>`)
    }

    $('#section_index').append(templateFormConnect())

    $('#register').click(function () {
        $('#section_index').empty();
        $('#section_index').append(templateFormRegister());
        $("#connect").click(function () {
            window.location = "index.php";
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
                            window.location = "index.php";


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

    /**PROCESS ADD LIST FORM */
    $('#new_list').click(function () {
        $('#addform').css("display", "block");
    })


    $('#add_list_form').submit(function (event) {

        event.preventDefault();
        var name = $("#name").val();
        var username = $("#username").val();
        var iduser = $('#iduser').val();

        console.log('ok');

        $.ajax({

            url: "traitement/addlist_process.php",
            type: "POST",
            data: {
                name: name,
                username: username,
                iduser: iduser,
            },

            success: function (data) {
                console.log(data)
                data = JSON.parse(data)
                console.log(data)
                if (data.erreur) {
                    $('#error').empty();
                    $('#error').removeClass("alert alert-danger")
                    $('#error').html(data.erreur)
                    $('#error').addClass("alert alert-danger")
                } else {
                    $('#error').empty();
                    $('#error').removeClass("alert alert-danger")

                    $('#success').append("<p>Votre liste a bien été créee</p>")
                    $('#success').addClass("alert alert-success")
                    console.log(data.result2);
                }



            },
            error: function (data) {
                console.log(data)
            }
        });






    })

    /**DISPLAY LISTS */

    function templatelists(id, name) {
        return (`
        <div class="lists">
        <a href='todolist.php?idlist=${id}' >${name}</a>
        </div>
        `).trim();
    }
    // $('.list_container').html(templatelists(1, "tests")[0]);

    $.ajax({

        url: "traitement/displaylists.php",

        dataType: "json",

        success: function (data) {
            console.log(data[0].id)
            for (let i = 0; i < data.length; i++) {

                $('.list_container').append(templatelists(data[i].id, data[i].nom));
                console.log(data[i].id)
            }
        },
        error: function (data) {
            console.log(data)
        }
    })




})