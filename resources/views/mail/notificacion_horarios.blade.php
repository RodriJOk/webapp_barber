<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="https://webappbarber-56b0944e3615.herokuapp.com/icons/cuidado.png" type="image/x-icon">
    <title>Notificación de reestablecimiento de contraseña</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
        .body{
            background-color: #cfcfcf;
            backdrop-filter: blur(5px);
        }
        .table{
            width: 100%; 
            max-width: 700px; 
            margin: 0 auto; 
            padding: 20px; 
            border-collapse: collapse; 
            font-family: 'Open Sans', sans-serif; 
            color: #333; 
            background-color: #f9f9f9;
            border-top: #012e46;
            border-bottom: #012e46;
            user-select: none;
        }
        .header{
            padding: 0px; 
            border-collapse: collapse; 
            display: table; 
            width: 100%;
            height: 100%; 
            background-color: #012e46;
        }
        .header .container_logo{
            overflow-wrap:break-word;
            word-break:break-word;
            padding:20px 0px 0px 20px; 
            width: 0px;
        }
        .header .container{
            overflow-wrap:break-word;
            word-break:break-word;
            padding: 23px 10px 0px 25px
        }
        .header .container h1{
            margin: 0px; 
            color: #ffffff; 
            line-height: 120%; 
            text-align: left; 
            word-wrap: break-word; 
            font-size: 26px; 
            font-family: 'Raleway', sans-serif; 
            font-optical-sizing: auto; 
            font-weight: 400; 
            font-style: normal;
        }
        .text{
            color: #000; 
            font-size: 14px;
        }
        .image{
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
            border:none;
        }
        .title_company{
            line-height: 45.1px;
        }
        .alert_image{
            width: 70px; 
            height: 70px;
        }
        .bold{
            font-weight: 600; 
            color: #000; 
            font-size: 14px;
        }
        .container{
            background-color: #012e46; 
            border-bottom: #012e46;
            text-align: center;
        }
        .title{
            color: #fff; 
            margin: 0px;
        }
        .container_title{
            padding: 20px 0px 0px;
        }
        .container_date{
            text-align: center; 
            background-color: #012e46;
        }
        .container_date td{
            padding: 15px 0px;
        }
        .container_description{
            border-bottom: #fff; 
            background-color: #f9f9f9;
        }
        .container_description td{
            padding: 20px 20px 0px 20px; 
            color: #444;
        }
        .container_information{
            list-style: none;
            padding: 0px;
            font-size: 20px;
            border-bottom: #fff; 
            border-top: none;
            background-color: #f9f9f9;
        }
        .container_information td div{
            padding: 0px; 
            border-collapse: collapse; 
            display: table; 
            width: 100%; 
            height: 100%;
        }
        .container_table_information{
            width: 70%; 
            padding: 20px 0px 30px 20px; 
            color: #444
        }
        .table_information{
            padding: 0px; 
            border-collapse: collapse; 
            display: table; 
            width: 100%;
            height: 100%;
        }
        .text_date{
            margin: 20px;
            color: #fff; 
            font-size: 12px;
        }
        .title_description{
            font-size: 18px;
            font-weight: 600; 
            color: #000;
        }
        .container_image{
            width: 30%; 
            padding:0px;
            text-align: center;
        }
        .footer{
            background-color: #012e46; 
            font-family: 'Raleway', sans-serif; 
            font-optical-sizing: auto; 
            font-weight: 400; 
            font-style: normal;
        }
        .footer_container{
            padding: 30px 0px; 
            text-align: center;
        }
        .footer_text{
            color: #f9f9f9;
        }
    </style>
</head>
<body class="body">
    <table class="table" cellspacing="0" cellpadding="0">
        <tr class="container">
            <td>
                <img
                    src="{{ $message->embed(asset('images/scissors.jpg')) }}"
                    alt="Header - Email para restablecer contraseña"
                    class="image">
            </td>
        </tr>
        <tr class="container">
            <td class="container_title">
                <h1 class="title">Solicitud de reestablecimiento de contraseña</h1>
            </td>
        </tr>
        <tr class="container_date">
            <td>
                <span class="text_date">
                    Fecha: <?php echo $date ?? date('d/m/Y'); ?>
                </span>
                <br/><?php 
                if(isset($browser) && $browser != null) { ?>
                    <span class="text_date">
                        Navegador: <?php echo $browser ?? ''; ?>
                    </span><?php
                } ?>
            </td>
        </tr>
        <tr class="container_description">
            <td>
                <p>¡Hola <?php echo $name ?? 'estimad@ usuari@'; ?>!</p>
                <p>Se han realizado cambios en tu esquema de horarios de trabajo. </br> 
                   Por favor, pulse <strong><a style="color:#000;" href="<?php echo $resetLink ?? '/login'; ?>">aqui</a></strong> para poder visualizarlos.
                </p>

                <p>Gracias por confiar en nosotros.</p>
            </td>
        </tr>
        <tr class="footer">
            <td class="footer_container">
                <span class="footer_text">
                    &copy;
                </span>
                <strong>
                    <span class="footer_text">
                        <?php echo date('Y'); ?> - Todos los derechos reservados
                    </span>
                </strong>
            </td>
        </tr>
    </table>
</body>
</html>