<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

        table {
            width: 100%
        }

        .page-break {
            page-break-after: always;
        }

        th {
            text-align: center;
        }

        .bolded {
            font-weight: bold;
        }

        /** Define the margins of your page **/
        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: center;
            line-height: 35px;
        }

        footer {
            position: fixed;
            bottom: -70px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: center;
            line-height: 0px;
        }

        /* Create two equal columns that floats next to each other */
        .column-header {
            float: left;
            width: 50%;
            padding: 0px;
            height: 50px; /* Should be removed. Only for demonstration */
        }


        /* Create four equal columns that floats next to each other */
        .column-footer {
            float: left;
            width: 21%;
            padding: 0px;
            margin-right: 2%;
            margin-left: 2%;
            height: 50px; /* Should be removed. Only for demonstration */
            border-top: 1px solid black;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        p {
            font-size: 12px;
        }

        .sin-bordes {
            margin-top: 20px;
        }

        .happy {
            margin-top: 20px;
            margin-left: 0px;
            margin-bottom: 45px;
        }

        .happy > tbody > tr > td,
        .happy > tbody > tr > th,
        .happy > thead > tr > td,
        .happy > thead > tr > th,
        .happy{
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
            padding-top: 0.2em;
            padding-bottom: 0.2em;
        }

        /*table, th, td {*/
        /*    border: 1px solid black;*/
        /*    border-collapse: collapse;*/
        /*    padding-top: 0.2em;*/
        /*    padding-bottom: 0.2em;*/
        /*}*/


        .sin-bordes > tr > th,
        .sin-bordes > tr > td,
        .sin-bordes {
            text-align: left;
            border-collapse: collapse;
        }

        /*table {*/
        /*    page-break-before: auto;*/
        /*    page-break-after: auto;*/
        /*}*/

        div {
            page-break-inside: avoid;
        }

        /* This is the key */
        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }
    </style>
</head>

<body>
<!-- Define header and footer blocks before your content -->
<header>
    <strong style="font-size:20px;">REPORTE DE INVENTARIO - {{strtoupper(now()->monthName)}} {{now()->year}}</strong>
    <img src="{{asset('sepulveda-black.png')}}" width="5%" style="position: fixed;  top: -60px;" alt="logo"/>
</header>

<footer>
    <div class="row">
        <div class="column-footer">
            <p>LIC JORGE LUIS SANCHES EUSCATE</p>
            <p>DIRECTOR</p>
            <p>IEP J. B. SEPÚLVEDA</p>
        </div>
        <div class="column-footer">
            <p>PROF MARIO LARA DE LA CRUZ</p>
            <p>SUB DIRECTOR ADMINISTRATIVO</p>
            <p>IEP J. B. SEPÚLVEDA</p>
        </div>
        <div class="column-footer">
            <p>PROF BERNABE DIAZ SAAVEDRA</p>
            <p>REP. ANTE LOS DOCENTES</p>
            <p>IEP J. B. SEPÚLVEDA</p>
        </div>
        <div class="column-footer">
            <p>T.A.II. MIGUEL MENDIETA ESPINOZA</p>
            <p>REPRESENTANTE ADMINISTRATIVO</p>
            <p>IEP J. B. SEPÚLVEDA</p>
        </div>
    </div>
</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    @foreach ($warehouses as $warehouse)
        <table style="width:100%; font-size: 12px;" class="sin-bordes">
        <tr>
            <th>AREA INVENTARIADO:</th>
            <td>{{$warehouse->description}}</td>
            <th>BIENES PATRIMONIALES</th>
            <td></td>
        </tr>
        <tr>

            <th>USUARIO RESPONSABLE:</th>
            <td>{{$warehouse->users[0]->first_name}} {{$warehouse->users[0]->last_name}}</td>
            <th>FECHA DE INVENTARIO:</th>
            <td>{{now()}}</td>
        </tr>
        </table>

        <table style="font-size:11px" class="happy">
            <thead>
            <tr style="text-align: center;">
                <th style="width:2%;">N ORDEN</th>
                <th style="width:9%;">CODIGO PATRIMONIAL</th>
                <th style="width:7%">CODIGO INVENTARIO</th>
                <th style="width:32%">DESCRIPCIÓN DEL BIEN</th>
                <th style="width:5%;">MARCA</th>
                <th style="width:5%;">MODELO</th>
                <th style="width:5%;">TIPO</th>
                <th style="width:5%;">COLOR</th>
                <th style="width:5%;">SERIE</th>
                <th style="width:5%;">ESTADO CONSERV</th>
                <th style="width:9%;">FECHA ADQ.</th>
                <th style="width:9%;">VALOR</th>
                <th style="width:5%;">OBSERV.</th>
            </tr>
            </thead>
            {{$counter = 1}}
            <tbody>
            @foreach($warehouse->goods as $good)
                <tr style="text-align: center">
                    <td>{{$counter++}}</td>
                    <td>{{$good->goodsCatalog->code}}</td>
                    <td>{{$good->code}}</td>
                    <td style="text-align: left;">{{$good->description}}</td>
                    <td>{{$good->trademark}}</td>
                    <td>{{$good->model}}</td>
                    <td>{{$good->type}}</td>
                    <td>{{$good->color}}</td>
                    <td>{{$good->series}}</td>
                    <td>{{$good->state_of_conservation}}</td>
                    <td>{{$good->date_acquired}}</td>
                    <td>{{$good->value}}</td>
                    <td>{{$good->observations}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

{{--        <p style="page-break-after: always;">--}}
{{--        </p>--}}

    @endforeach

</main>

</body>
</html>

