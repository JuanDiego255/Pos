<!DOCTYPE html>
<html lang="en">
@php
    $cantArticulos = 0;
    $total_pagado = 0;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $name }}</title>
    <style>
        html {
            margin: 0px;
            font-family: 'ticketing';
        }

        .cabecera {
            text-align: center;
        }

        .informacion {
            text-align: left;
            margin-left: 15px;
            margin-right: 15px;
        }

        .payments {
            text-align: right;
            margin-left: 15px;
            margin-right: 15px;
        }

        .informacion_caja {
            text-align: right;
            margin-left: 15px;
            margin-right: 15px;
        }

        .tabla_detalle {
            margin-left: 15px;
            margin-right: 15px;
            margin-top: 5px;
        }

        .text-center {
            text-align: center;
        }

        .informacion_representacion {
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Estilos extra personales **/
            background-color: white;
            color: black;
            text-align: center;
            line-height: 1.5cm;
        }
    </style>
</head>

<body>
    <div class="cabecera">
        {{-- <img src="{{ public_path('assets/img/branding/logo__mytems.jpg') }}" style="margin-top: 9px;" width="35%"
            height="7%"> --}}
        <p style="font-size: 16px; font-weight: bold; margin-bottom: 0; margin-top: 10px;">
            {{ $business->nombre_comercial }}</p>
        <p style="font-size: 14px; font-weight: bold; margin-bottom: 0; margin-top: 10px;">FACTURA</p>
        <p style="font-size: 10px; margin-top:0; margin-bottom: 0;">{{ $business->direccion }}</p>
    </div>

    <div class="informacion" style="margin-top:5px;">
        <p style="font-size: 12px; margin-top:0; margin-bottom: 0;">ALICE ZAMORA MATAMOROS - CED:
            {{ $business->ruc }}</p>
        <p style="font-size: 12px; margin-top:0; margin-bottom: 0;">TELEFONO: {{ $business->telefono }} </p>
        <p style="font-size: 12px; margin-top:0; margin-bottom: 0;">CAJERO: {{ $vendedor }} </p>
        <p style="font-size: 12px; margin-top:0; font-weight: bold; margin-bottom: 0;">Factura #:
            {{ $factura->serie }}{{ $factura->correlativo }}
        </p>
        <p style="font-size: 10px; margin-top:0; margin-bottom: 0;">CLIENTE: {{ $cliente->nombres }}</p>
        <p style="font-size: 10px; margin-top:0; margin-bottom: 0; text-transform: uppercase">-
        </p>
        <p style="font-size: 11px; margin-top:0; font-weight: bold; margin-bottom: 0;">
            Fecha:{{ date('d/m/Y', strtotime($factura->fecha_emision)) }} Hora: {{ $factura->hora }}</p>

        <p style="font-size: 12px; margin-top:0; font-weight: bold; margin-bottom: 0;">Moneda: {{ $moneda->codigo }}
        </p>
        <p style="font-size: 12px; margin-top:0; margin-bottom: 0;">Forma de Pago: CONTADO </p>
    </div>

    <div class="tabla_detalle">
        <table style="border-top: 1px solid #c2c2c2;" width="100%">
            <thead style="border-bottom: 1px solid #c2c2c2" style="width: 100%">
                <tr>
                    <th style="font-size: 12px;">[CANT]</th>
                    <th style="font-size: 12px; text-align: left;">DESCRIPCION</th>
                    <th style="font-size: 12px;">TOTAL</th>
                    <th style="font-size: 12px; text-align:right;">IVA</th>
                </tr>
            </thead>

            <tbody style="border-bottom: 1px solid #c2c2c2">
                @foreach ($detalle as $product)
                    @php
                        $cantArticulos += round($product['cantidad']);
                    @endphp
                    <tr style="border-bottom: 1px solid #c2c2c2">
                        <td style="font-size: 10px; text-align:center; vertical-align: top">[
                            {{ round($product['cantidad']) }} ]</td>
                        <td style="font-size: 10px; text-align:left; vertical-align: top">{{ $product['producto'] }}
                        </td>
                        <td style="font-size: 10px; text-align:center; vertical-align: top">
                            {{ $product['precio_unitario'] }}</td>
                        <td style="font-size: 10px; text-align:right; vertical-align: top">
                            {{ '0%' }}</td>
                    </tr>
                @endforeach
                <tr style="border-bottom: 1px solid #c2c2c2">
                    <td style="font-size: 12px; text-align:center; font-weight: bold; vertical-align: top"
                        colspan="4">----------> Ultima Linea <---------- </td>
                </tr>
            </tbody>
            <tbody style="border-bottom: 1px solid #c2c2c2">
                <tr style="border-bottom: 1px solid #c2c2c2">
                    <td style="font-size: 12px; text-align:left; font-weight: bold; vertical-align: top" colspan="4">
                        Cant de Articulos:
                        {{ $cantArticulos }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #c2c2c2">
                    <td style="font-size: 12px; text-align:center; font-weight: bold; vertical-align: top"
                        colspan="4">Desglose del IVA</td>
                </tr>
            </tbody>
            <tbody style="border-bottom: 1px solid #c2c2c2">
                <tr style="border-bottom: 1px solid #c2c2c2">
                    <td style="font-size: 10px; text-align:center; font-weight: bold; vertical-align: top">IMPUESTO</td>
                    <td style="font-size: 10px; text-align:center; font-weight: bold; vertical-align: top">IVA %</td>
                    <td style="font-size: 10px; text-align:center; font-weight: bold; vertical-align: top">TOTAL</td>
                </tr>
                <tr style="border-bottom: 1px solid #c2c2c2">
                    <td style="font-size: 10px; text-align:center; vertical-align: top">IVA</td>
                    <td style="font-size: 10px; text-align:center; vertical-align: top">0 %</td>
                    <td style="font-size: 10px; text-align:center; vertical-align: top">+0,00</td>
                </tr>

            </tbody>
            <tbody style="border-bottom: 1px solid #c2c2c2">
                <tr>
                    <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">Sub Total:</td>
                    <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">
                        {{ $factura->exonerada }}</td>
                </tr>

                <tr>
                    <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">Total de IVA %:
                    </td>
                    <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">
                        0</td>
                </tr>
                @if ($factura->otros_cargos)
                    <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">Envio:</td>
                    <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">
                        {{ $factura->otros_cargos }}</td>
                @endif
            </tbody>

            <tbody style="border-top: 1px solid #c2c2c2; margin-bottom: 20px;">
                <tr>
                    <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">Total A Pagar:
                    </td>
                    <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">
                        {{ $factura->total }}</td>
                </tr>
            </tbody>

            <tbody style="border-top: 1px solid #c2c2c2;">
                <tr style="">
                    <td style="font-size: 12px; font-weight: bold; text-align: center;" colspan="4">
                        Son: {{ $numero_letras }} {{ $descripcion_moneda_pais }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($count_payment != 0)
        <div class="payments">
            <p style="font-size: 11px; margin-top:7px; font-weight: bold; margin-bottom: 0;">METODOS DE PAGO</p>
            @foreach ($payment_modes as $pay_mode)
                @php
                    $total_pagado += $pay_mode['monto'];
                @endphp
                <p style="font-size: 10px; margin-top:0; margin-bottom: 0;">{{ $pay_mode['modo_pago'] }}:
                    {{ $pay_mode['monto'] }}</p>
            @endforeach
            @if ($total_pagado > $factura->total)
                <p style="font-size: 11px; margin-top:7px; font-weight: bold; margin-bottom: 0;">CAMBIO</p>
                <p style="font-size: 10px; margin-top:0; margin-bottom: 0;">Total:
                    {{ $total_pagado - $factura->total }}</p>
            @endif
        </div>
    @endif

    <div class="" style="">
        <p style="font-size: 12px; text-align: center; padding: 0px 18px;">** Muchas gracias por su compra **</p>
        <p style="font-size: 10px; text-align: center; padding: 0px 18px;">Acogido a regimen simplificado</p>
    </div>
</body>

</html>
