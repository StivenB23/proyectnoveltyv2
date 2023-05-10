<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        h1{
            color: #39A900;
        }
        p{
            color: rgb(180, 180, 180);
            font-size: 1rem;
        }
    </style>
    
</head>

<body>
    <main>
        <h1>ASISQUICK TE DA LA BIENVENIDA</h1>
        <img src="http://127.0.0.1:8000/assets/images/banner_email.jpg" alt="">
        <img src="https://cdn.superaficionados.com/imagenes/1-kimetsu-no-yaiba-personajes-tanjiro-kamado-1-cke.jpg" alt="">
        <p>Su cuenta en asisquick fue creada de forma exitosa, para ingresar a la plataforma tenga en cuenta que su
            usuario y contraseña son su número de documento.</p>
        <a href="{{ route('/login') }}">Iniciar sesión</a>
    </main>
</body>

</html>
