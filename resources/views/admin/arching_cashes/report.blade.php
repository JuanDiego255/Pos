<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Arqueo de Caja</title>
    <style>
        #cabecera {
            text-align: center;
            text-decoration: underline;
        }

        body {
            font-family: sans-serif;
        }

        .th_informacion {
            text-align: left;
            width: 200px;
        }

        .td_informacion {
            text-align: left;
        }

        .th_items,
        .td_items {
            text-align: center;
        }

        #table_items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        #thead_items {
            width: 100%;
        }

        .border-solid {
            border: 1px solid #dee2e6
        }

        .text-right {
            text-align: right;
        }

        .text-danger {
            color: rgb(234, 84, 85);
        }

        .pay_mode {
            margin-bottom: 0px;
            margin-top: 0px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="cabecera">
        <h4>REPORTE DE ARQUEO DE CAJA</h4>
    </div>

    <div id="informacion">
        <table style="font-size: 15px;">
            <tr>
                <th class="th_informacion">RUC</th>
                <td class="td_informacion">{{ $business->ruc }}</td>
            </tr>

            <tr>
                <th class="th_informacion">EMPRESA</th>
                <td class="td_informacion">{{ $business->nombre_comercial }}</td>
            </tr>

            <tr>
                <th class="th_informacion">FECHA</th>
                <td class="td_informacion">{{ date('d-m-Y', strtotime($cash->fecha_inicio)) }}</td>
            </tr>

            <tr>
                <th class="th_informacion">MONTO INICIAL</th>
                <td class="td_informacion">{{ number_format($cash->monto_inicial, 2, '.', '') }}</td>
            </tr>
        </table>
    </div>

    <div id="items">
        <table id="table_items">
            <thead id="thead_items" style="font-size: 12px;">
                <tr>
                    <th colspan="3" class="th_items border-solid">Documento</th>
                    <th colspan="2" class="th_items border-solid">Cliente</th>
                    <th colspan="5" class="th_items border-solid">Colones</th>
                </tr>
                <tr>
                    <th class="th_items border-solid">Fecha</th>
                    <th class="th_items border-solid">Documento</th>
                    <th class="th_items border-solid">Pago</th>
                    <th class="th_items border-solid">RUC / DNI</th>
                    <th class="th_items border-solid">Razón Social</th>
                    <th class="th_items border-solid">Exonerada</th>
                    <th class="th_items border-solid">Gravada</th>
                    <th class="th_items border-solid">Inafecta</th>
                    <th class="th_items border-solid">IGV</th>
                    <th class="th_items border-solid">Importe</th>
                    <th class="th_items border-solid">Cambio</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $acumulados = []; // Inicializar un array para los acumulados por tipo de pago
                    $monto_pago = 0;
                @endphp
                @foreach ($billings as $item)
                    <tr style="font-size: 12px;">
                        <td class="td_items border-solid">{{ date('d-m-Y', strtotime($item['fecha_emision'])) }}</td>
                        <td class="td_items border-solid">{{ $item['serie'] . '-' . $item['correlativo'] }}</td>
                        <td class="td_items border-solid">

                            @foreach ($pagos as $pago)
                                @foreach ($pago as $item_pago)
                                    @if ($item_pago->idfactura == $item['id'] && $item['idtipo_comprobante'] == $item_pago->idtipo_comprobante)
                                        <p class="pay_mode">
                                            {{ $item_pago->tipo_pago }}: {{ $item_pago->monto }}
                                        </p>
                                        @php
                                            $monto_pago = $item_pago->monto;
                                            if (!isset($acumulados[$item_pago->tipo_pago])) {
                                                $acumulados[$item_pago->tipo_pago] = 0;
                                            }
                                            $acumulados[$item_pago->tipo_pago] += $item['total'];
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td class="td_items border-solid">{{ $item['dni_ruc'] }}</td>
                        <td class="text-left border-solid">{{ $item['nombre_cliente'] }}</td>
                        <td class="td_items border-solid">{{ $item['exonerada'] }}</td>
                        <td class="td_items border-solid">{{ $item['gravada'] }}</td>
                        <td class="td_items border-solid">{{ $item['inafecta'] }}</td>
                        <td class="td_items border-solid">{{ $item['igv'] }}</td>
                        <td class="td_items border-solid">{{ $item['total'] }}</td>
                        <td class="td_items border-solid">
                            {{ $monto_pago > $item['total'] ? $monto_pago - $item['total'] : 0 }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="9" class="text-right border-solid text-danger">Gastos</td>
                    <td class="td_items border-solid text-danger">-{{ number_format($sum_bills, 2, '.', '') }}</td>
                </tr>
                <tr>
                    <td colspan="9" class="text-right border-solid">Total Ventas</td>
                    <td class="td_items border-solid">{{ number_format($monto_ventas, 2, '.', '') }}</td>
                </tr>
                <tr>
                    <td colspan="9" class="text-right border-solid">Total</td>
                    <td class="td_items border-solid">{{ number_format($total, 2, '.', '') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="gastos" style="margin-top: 20px; font-size: 14px;">
        <h4 style="text-align: center; text-decoration: underline;">Detalles de Gastos</h4>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px;">
            <thead>
                <tr>
                    <th style="border: 1px solid #dee2e6; text-align: left;">Descripción</th>
                    <th style="border: 1px solid #dee2e6; text-align: right;">Monto</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalGastos = 0;
                @endphp
                @foreach ($gastos as $gasto)
                    <tr>
                        <td style="border: 1px solid #dee2e6;">{{ $gasto->detalle }}</td>
                        <td style="border: 1px solid #dee2e6; text-align: right;">
                            {{ number_format($gasto->monto, 2, '.', '') }}
                        </td>
                    </tr>
                    @php
                        $totalGastos += $gasto->monto;
                    @endphp
                @endforeach
                <tr>
                    <td style="border: 1px solid #dee2e6; text-align: right; font-weight: bold;">Total Gastos</td>
                    <td style="border: 1px solid #dee2e6; text-align: right; font-weight: bold;">
                        {{ number_format($totalGastos, 2, '.', '') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="resumen" style="margin-top: 20px; font-size: 14px;">
        <h4 style="text-align: center; text-decoration: underline;">Resumen de Pagos</h4>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px;">
            <thead>
                <tr>
                    <th style="border: 1px solid #dee2e6; text-align: center;">Tipo de Pago</th>
                    <th style="border: 1px solid #dee2e6; text-align: center;">Monto Pagado</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalGeneral = 0; // Inicializar total general
                @endphp
                @foreach ($acumulados as $tipoPago => $monto)
                    <tr>
                        <td style="border: 1px solid #dee2e6; text-align: center;">{{ $tipoPago }}</td>
                        <td style="border: 1px solid #dee2e6; text-align: right;">
                            {{ number_format($monto, 2, '.', '') }}
                        </td>
                    </tr>
                    @php
                        $totalGeneral += $monto; // Calcular total general
                    @endphp
                @endforeach
                <tr>
                    <td style="border: 1px solid #dee2e6; text-align: right; font-weight: bold;">Total General</td>
                    <td style="border: 1px solid #dee2e6; text-align: right; font-weight: bold;">
                        {{ number_format($totalGeneral, 2, '.', '') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
