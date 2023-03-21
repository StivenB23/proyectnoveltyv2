<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @font-face {
            font-family: "Ubuntu";
            src: url({{ asset('/assets/fonts/Ubuntu/Ubuntu-Bold.ttf') }});
        }

        html {
            font-family: "Ubuntu", system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            color: #39A900;
        }

        :root {
            --color-green: #39A900;
            --color-gray: #717171;
        }

        h1,
        h2,
        h3 {
            color: var(--color-green);
        }

        p {
            color: var(--color-gray);
        }

        .content-email {
            background-color: #fff;
            border-radius: 10px;
            margin: 9px;
            padding: 5px;
        }
    </style>
</head>

<body>
    @yield('contentEmail')
</body>

</html>
