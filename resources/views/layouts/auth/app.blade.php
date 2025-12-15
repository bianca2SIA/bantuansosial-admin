<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | SIBANSOS</title>
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon1.png') }}" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            width: 100vw;
            overflow: hidden;

            display: flex;
            justify-content: center;
            align-items: center;

            background: url('{{ asset('assets-admin/images/bansos.jpg') }}') center/cover no-repeat fixed;
            position: relative;
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .card {
            position: relative;
            z-index: 3;

            width: 92%;
            max-width: 420px;

            background: rgba(255, 255, 255, 0.28);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.4);

            padding: 10px 25px 30px;


            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }

        .title {
            font-size: 26px;
            text-align: center;
            font-weight: 700;
            color: #7b2cbf;
            margin-top: 0;
            /* sebelumnya 10px */
            margin-bottom: 6px;
        }

        .desc {
            text-align: center;
            font-size: 12px;
            color: black;
            opacity: 0.85;
            margin: 6px 0 14px;
            line-height: 1.35;
        }

        .auth-logo {
            text-align: center;
            margin-top: 12px;

        }

        .auth-logo img {
            width: 120px;
            height: auto;
        }




        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #5a189a;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #d1b3ff;
            font-size: 14px;
            margin-bottom: 10px;
        }

        input:focus {
            outline: none;
            border-color: #7b2cbf;
            box-shadow: 0 0 8px rgba(123, 44, 191, 0.25);
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, #9b5de5, #7b2cbf);
            color: white;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            margin-top: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
            color: #7b2cbf;
        }

        .error-box {
            background: #fdebec;
            border: 1px solid #f3b4b4;
            padding: 10px;
            color: #a3000f;
            font-size: 13px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="overlay"></div>
    @yield('content')

</body>

</html>
