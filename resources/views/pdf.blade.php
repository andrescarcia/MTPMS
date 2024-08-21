<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Despacho</title>
    <style>
        .b {
            border: 1px solid rgb(62, 87, 170);
            border-radius: 2%
        }

        <td>{{ $event->total_price }}</td>.shop-info {
            display: block;
            padding: 3px;
            font-size: 13px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            color: black;
            font-weight: bold;           
        }

        .badge-alta {
            background-color: red;
        }

        .badge-media {
            background-color: orange;
        }

        .badge-baja {
            background-color: green;
        }

        .dispatch-info {
            color: gray;
            display: block;
            padding: 3px;
            font-size: 13px;
        }

        .partes {
            text-align: center;
            margin-top: 1rem;
        }

        .partes thead {
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
        }

        .partes tr:nth-child(even) {
            background-color: #6b7bad;

        }

        th,
        td {
            padding: 7px;
            vertical-align: middle;
        }

        /* .badge {
            background-color: #3f3f3f;
            color: white;
            padding: 3px;
            border-radius: 40%;
            font-weight: 800;
            width: 30px;
            margin: 0 auto;
        } */
    </style>
</head>

<body>
    <table class="b" width="100%">
        <tr>
            <td width="25%">
                <img src="{{ public_path('images/mtlogo.png') }}" alt="Logo" width="150px">
            </td>
            <td width="50%" style="text-align: center">
                <h1>
                    MT Solutions
                </h1>
                <p>
                    Conectando éxitos, transformando realidades
                </p>
            </td>
            <td width="25%">
                <span class="shop-info">
                    <b>Tlf:</b> +58 2122436023
                </span>
                <span class="shop-info">
                    <b>Email:</b> soporte_HPSC@mtsolutions.com
                </span>
                <span class="shop-info">
                    <b>Dirección:</b>Zona Rental U.
                    Metropolitana, Edif. Andrés
                    Germán Otero, Piso 4, Ofic. 1.
                    Urb. Terrazas del Ávila
                </span>
                <span class="shop-info">
                    <b>Ciudad:</b>Caracas

                </span>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="33%">

                <h2 style="color: rgb(0, 0, 0);">Datos del despacho:</h2>
                <span class="dispatch-info">
                    <b style="color: blue;">Numero de Caso: </b><span
                        style="color: black;">{{ $event->case_number }}</span>
                </span>
                <span class="dispatch-info">
                    <b style="color: blue;">Cliente: </b><span style="color: black;">{{ $event->client->name }}</span>
                </span>
                {{-- <span class="dispatch-info">
                    <b style="color: blue;">Total: </b><span style="color: black;">{{ $dispatch->total }}</span>
                </span> --}}
                {{-- <span class="dispatch-info">
                    <b style="color: blue;">Pago: </b><span style="color: black;">{{ $dispatch->pago }}</span>
                </span> --}}
                <span class="dispatch-info">
                    <b style="color: blue;">Centro de Costo: </b><span style="color: black;">{{ $event->CC }}</span>
                </span>
                {{-- <span class="dispatch-info">
                    <b style="color: blue;">Localidad: </b><span style="color: black;">{{ $dispatch->estado }}</span>
                </span> --}}
            </td>
            <td width="33%">
                <h2 style="margin-bottom: 0.5rem">Detalles:</h2>
                <span class="shop-info">
                    <b>Empresa: </b>{{ $event->OC }}
                </span>
                <span class="shop-info">
                    <b>Ubicación: </b>{{ $event->ETA }}
                </span>
            </td>
            <td width="33%">
                <h2 style="margin-bottom: 0.5rem">Fecha:</h2>
                <span class="dispatch-info">
                    <b style="color: blue;"></b><span style="color: black;">{{ $event->date }}</span>
                </span>
            </td>
        </tr>
    </table>
    <table width="100%" class="partes" style="border: 1px solid black;">
        <thead>
            <th style="border: 1px solid black;">#</th>
            <th style="border: 1px solid black;">Pais</th>
            <th style="border: 1px solid black;">Número de Parte</th>
            <th style="border: 1px solid black;">Descripción</th>
            <th style="border: 1px solid black;">Cantidad</th>
            {{-- categoryid --}}
            <th style="border: 1px solid black;">Proveedor</th>
            <th style="border: 1px solid black;">Precio Unitario</th>
            <th style="border: 1px solid black;">Total</th>
            <th style="border: 1px solid black;">Prioridad</th>

        </thead>
        <tbody>
            {{-- no se si es part --}}
            <tr style="border: 1px solid black;" style="font-size: 0.8em;">
                {{-- <td>{{ ++$loop->index }}</td> --}}
                <td>{{ $event->id }}</td>
                <td>
                    {{ $event->part_number }}
                </td>
                <td>
                    {{ $event->description }} {{-- Aquí es donde accedes a la categoría --}}
                </td>
                <td>
                    {{-- aqui se accede a la relacion entre item y parte --}}
                    {{ $event->quantity }}
                    {{-- alternativamente se puede acceder a la ubicacion guardada en item --}}
                    {{-- {{$item->ubicacion }} --}}
                </td>
                <td>{{ $event->pais }}</td>
                <td>{{ $event->provider }}</td>
                <td>{{ $event->unitary_price }}</td>
                <td>{{ $event->total_price }}</td>
                <td style="text-align: center; vertical-align: middle;">
                @if ($event->priority == 'alta')
                    <span class="align-middle badge" >Alta</span>
                @elseif ($event->priority == 'media')
                    <span class="badge badge-media ">Media</span>
                @elseif ($event->priority == 'baja')
                    <span class="badge badge-baja ">Baja</span>
                @else
                    <span class="badge">Sin Prioridad</span>
                @endif
                </td>
            </tr>
            {{-- @empty
                <tr>
                    <td colspan="7">Sin Partes</td>
                </tr> --}}
            {{-- <tr>
                
                <td colspan="6">

                </td>
                <td>Total:</td>
                <td>
                    <b>{{moneyFormat($dispatch->total)}}</b>
                </td>
            </tr> --}}
        </tbody>
    </table>
    <table width="100%" style="text-align: center; margin-top: 7rem">
        <tr>
            <td>
                ______________________________________________<br>
                {{-- <br> Ingeniero encargado:
                <b>{{ $dispatch->engineer->name }}</b> --}}
            </td>
        </tr>
    </table>
</body>

</html>
