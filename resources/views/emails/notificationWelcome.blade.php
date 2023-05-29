<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
           
        }
        a{
            background-color:#39A900;
            color: #FFF;
            display: inline-block;
            font-size: 1.1rem;
            padding: 10px;
            text-align: center;
            text-decoration: none;
        }
        .container{
            width: 100%;
            height: 100vh;
            background-color: #e0e0e0;
        }
        .banner{
            background-color: #39A900;
            height: 100px;
            width: 100%;
        }
        img{
            width: auto;
        }
        .card{
            background-color: #FFF;
            border-radius: 3px;
            font-family: 'Ubuntu', sans-serif,Arial, Helvetica, sans-serif;
            left: 22%;
            top: 50px;
            position: absolute;
            width: 60%;
            margin: 0 auto;
        }
        .cardHeading{
            font-size: 1.7rem;
            text-align: center;
            margin: 20px 8px;
        }
        .cardBody{
            padding:0 5%;
            color: rgb(147, 139, 139);
            font-size: 1.2rem;
            text-align: justify;
        }
        .links{
            display: flex;
            margin: 20px 0;
            justify-content: center;
        }
        .cardFooter{
            margin: 10px 0;
        }
        .cardFooter p{
            color: #39A900;
            text-align: center;
            font-size: 1rem;
        }
    </style>

</head>

<body>
    <main>
        <section class="container">
            <article class="banner"></article>
            <article class="card" >
                <div class="cardHeading">
                    <h1>ASISQUICK TE DA LA BIENVENIDA</h1>
                </div>
                <div class="cardBody">
                    <!-- <img src="http://127.0.0.1:8000/assets/images/banner_email.jpg" alt=""> -->
                    <p>Su cuenta en asisquick fue creada de forma exitosa, para ingresar a la plataforma tenga en cuenta que su
                        usuario y contraseña son su número de documento.</p>
                    <div class="links">
                        <a href="{{ route('home') }}">Iniciar sesión</a>
                    </div>
                </div>
                <div class="cardFooter">
                        <p>Este mensaje es informativo, por favor, no responda el correo.</p>
                </div>
                
                
            </article>
        </section>
    </main>
</body>

</html>