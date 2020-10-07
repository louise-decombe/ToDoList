$(document).ready(function () {

    /**SHOW CONNECT FROM */

    async function showConnect() {
        const result = $('main').load("connexion.php #connect_section")

        return result;
    }

    $('#connect').click(function () {
        showConnect();

    })

    /** SHOW REGISTER FORM */

    async function showRegister() {
        const result = $('main').load("register.php #register_section")

        return result;
    }

    $('#register').click(function () {
        showRegister();
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

                                $('body').html(data);
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

    /**PROCESS ADD LIST FORM */
    $('#new_list').click(function(){
        $('#addform').css("display", "block");
    })

    $('#add_list_form').submit(function (event) {
        event.preventDefault();
        let name = $('#list_name').val();
        let user_name = $('#add_user').val();

        $.ajax({
            url: 'traitement/addlist_process.php',
            type: "POST",
            data: {
                name: name,
                user_name: user_name,
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.erreur) {
                    console.log("error")
                    $('#error').empty();
                    $('#error').removeClass("alert alert-danger");
                    $('#error').html(data.erreur);
                    $('#error').addClass("alert alert-danger");
                } else {
                    window.location = "todolist.php";

                    console.log(data.msg);
                }


            },
            error: function (data) {
                console.log(data)
            }
        })
    })




})



function test() {
    return (`

    <form action="" method="post">

<div class="form-group">
  <label for="">${toto}</label>
  <input type="text" name="" id="" class="form-control">
</div>
<div class="form-group">
  <label for="">fff</label>
  <input type="text" name="" id="" class="form-control">
</div>
</form>

    `).trim();

}
