$(document).ready(function () {


    /** GET ID LIST FROM URL */
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };
    var id_list = getUrlParameter('idlist');

    /** FORMS TEMPLATES */

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

    /**CHANGE BUTTONS */
    $('#new_list').click(function () {
        $('#addform').css("display", "block");
        $(this).css("display", "none");
        $('#cancel').css("display", "block")
        $('#error').empty();

        $("#cancel").click(function () {
            $('#addform').css("display", "none");
            $(this).css("display", "none");
            $('#new_list').css("display", "block");

        })

    })
    $('#add_user_btn').click(function () {
        $('#add_user_tolist').css("display", "block");
        $(this).css("display", "none");
        $('#cancel_adduser').css("display", "block")
        $('#error_user').empty();

        $("#cancel_adduser").click(function () {
            $('#add_user_tolist').css("display", "none");
            $(this).css("display", "none");
            $('#add_user_btn').css("display", "block");

        })

    })

    /**PROCESS ADD LIST FORM */
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
                    $('#addform').css("display", "none");
                    $('#cancel').css("display", "none");
                    $('#new_list').css("display", "block");

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

    function displaymylists() {

        $.ajax({

            url: "traitement/displaylists.php",

            dataType: "json",

            success: function (data) {

                $('.list_container').empty();
                for (let i = 0; i < data.length; i++) {

                    $('.list_container').append(templatelists(data[i].id, data[i].nom));

                }

            },
            error: function (data) {

            }
        })



    }
    setInterval(displaymylists, 500)

    /** DISPLAY OPTION SELECT */

    function optionTemplate(username) {
        return (`<option value =${username}>${username}</option>`).trim();
    }


    function selectuser() {

        $.ajax({
            url: "traitement/select_user.php",
            type: "post",
            dataType: "json",
            data: {
                id_list: id_list,
            },
            success: function (data) {
                $('#select_user').empty();
                $('#select_user').append("<option id='select_user_opt' value=''>Attribuer cette tâche à:</option>")
                for (let i = 0; i < data.length; i++) {

                    $('#select_user').append(optionTemplate(data[i].login))
                }
            },
            error: function (data) {
                console.log(data)
            }
        })

    }
    selectuser();

    /** SHOW LIST NAME */

    $.ajax({
        url: "traitement/displaylistinfo.php",
        type: "post",
        data: {
            id_list: id_list,
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data)
        }
    })

    /** ADD USER TO AN EXISTING LIST */

    $("#add_user_tolist").submit(function (event) {
        event.preventDefault();
        let username = $('#add_username').val();
        console.log(username);

        $.ajax({
            url: "traitement/add_usertolist.php",
            type: "post",
            data: {
                user_name: username,
                id_list: id_list,

            },
            success: function (data) {
                data = JSON.parse(data)
                console.log(data);
                if (data.erreur) {
                    $('#error_user').empty();
                    $('#error_user').removeClass("alert alert-danger")
                    $('#error_user').append("<p>" + data.erreur + "</p>")
                    $('#error_user').addClass("alert alert-danger")

                } else {
                    $('#error_user').empty();
                    $('#error_user').removeClass("alert alert-danger")

                    $('#success_user').append("<p>" + data.msg + "</p>")
                    $('#success_user').addClass("alert alert-success")
                    $('#add_user_btn').css("display", "block");
                    $('#cancel_adduser').css("display", "none");
                    $('#add_user_tolist').css("display", "none");

                    selectuser();
                }


            },
            error: function (data) {
                console.log(data)
                console.log("erreur");
            }

        })

    })

    /** DELETE LIST */

    $('#delete_list').click(function(){

        $.ajax({
            url: "traitement/delete_list.php",
            type: "post",
            data:{
                idlist : id_list,
            },
            success: function(data){
                if(data.msg != ""){
                    console.log("ok");
                    window.location = "todolist.php";
                }
                

            },
            error: function (data) {
                console.log(data)
                
            }
        })
    })







})