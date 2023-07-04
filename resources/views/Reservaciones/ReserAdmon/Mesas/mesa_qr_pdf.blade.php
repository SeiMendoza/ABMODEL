<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <style>
        h1{
            font-weight: bolder;
            text-align: center;
            color: #051c34;
        }
        /* Establece el ancho máximo de la imagen */
        img {
            width: 50%;
            height: 40%;
        }
    </style>
</head>
<body>
<h1>{{$Titulo}} </h1><br>
<div style="text-align:center;">
    <img src="{{ $Qr }}" />
</div>
</div>
</body>
</html>
 