<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Nota {{ strtoupper($nota->tipo_nota) }}</title>


<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #222;
    }

    .header{
        width:100%;
        border-bottom:2px solid #000;
        margin-bottom:15px;
        padding-bottom:10px;
    }

    .empresa{
        text-align:center;
    }

    .empresa h2{
        margin:0;
    }

    .titulo{
        text-align:center;
        margin-top:10px;
        margin-bottom:15px;
    }

    .titulo h3{
        margin:0;
        padding:0;
    }

    .info{
        width:100%;
        margin-bottom:15px;
    }

    .info td{
        padding:4px;
        vertical-align:top;
    }

    .detalle{
        width:100%;
        border-collapse:collapse;
        margin-top:10px;
    }

    .detalle th{
        background:#f2f2f2;
        border:1px solid #000;
        padding:6px;
    }

    .detalle td{
        border:1px solid #000;
        padding:6px;
    }

    .text-right{
        text-align:right;
    }

    .text-center{
        text-align:center;
    }

    .footer{
        margin-top:50px;
    }

    .firma{
        width:45%;
        display:inline-block;
        text-align:center;
    }

    .linea{
        margin-top:50px;
        border-top:1px solid #000;
        width:80%;
        margin-left:auto;
        margin-right:auto;
    }

    .observaciones{
        margin-top:15px;
        padding:10px;
        border:1px solid #ccc;
    }

    .totales{
        margin-top:10px;
        width:40%;
        float:right;
    }

    .totales table{
        width:100%;
        border-collapse:collapse;
    }

    .totales td{
        border:1px solid #000;
        padding:5px;
    }
</style>


</head>
<body>

<div class="header">
    <div class="empresa">
        <h2>MI EMPRESA S.R.L.</h2>
        <p>Sistema de Inventario</p>
    </div>
</div>

<div class="titulo">
    <h3>
        NOTA DE {{ strtoupper($nota->tipo_nota) }}
    </h3>
    <strong>N° {{ str_pad($nota->id, 6, '0', STR_PAD_LEFT) }}</strong>
</div>

<table class="info">
    <tr>
        <td width="50%">
            <strong>Fecha:</strong>
            {{ \Carbon\Carbon::parse($nota->fecha)->format('d/m/Y H:i') }}
        </td>

        <td width="50%">
            <strong>Estado:</strong>
            {{ $nota->estado ? 'ACTIVO' : 'ANULADO' }}
        </td>
    </tr>

    <tr>
        <td>
            <strong>{{ $nota->tipo_nota == 'compra' ? 'Proveedor' : 'Cliente' }}:</strong>
            {{ $nota->clienteproveedor->razon_social }}
        </td>

        <td>
            <strong>Documento:</strong>
            {{ $nota->clienteproveedor->nro_identificacion }}
        </td>
    </tr>

    <tr>
        <td>
            <strong>Teléfono:</strong>
            {{ $nota->clienteproveedor->telefono }}
        </td>

        <td>
            <strong>Correo:</strong>
            {{ $nota->clienteproveedor->correo }}
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <strong>Dirección:</strong>
            {{ $nota->clienteproveedor->direccion }}
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <strong>Registrado por:</strong>
            {{ $nota->user->name }}
        </td>
    </tr>
</table>

<table class="detalle">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th width="20%">Almacén</th>
            <th width="10%">Producto ID</th>
            <th width="10%">Cantidad</th>
            <th width="15%">Tipo Mov.</th>
            <th width="15%">P. Compra</th>
            <th width="15%">P. Venta</th>
            <th width="10%">Subtotal</th>
        </tr>
    </thead>

    <tbody>
        @php
            $total = 0;
        @endphp

        @foreach($nota->movimientos as $index => $mov)
            @php
                $subtotal = $mov->pivot->cantidad * (
                    $nota->tipo_nota == 'compra'
                        ? $mov->pivot->precio_compra
                        : $mov->pivot->precio_venta
                );

                $total += $subtotal;
            @endphp

            <tr>
                <td class="text-center">
                    {{ $index + 1 }}
                </td>

                <td>
                    {{ $mov->nombre }}
                </td>

                <td class="text-center">
                    {{ $mov->pivot->producto_id }}
                </td>

                <td class="text-center">
                    {{ $mov->pivot->cantidad }}
                </td>

                <td class="text-center">
                    {{ strtoupper($mov->pivot->tipo_movimiento) }}
                </td>

                <td class="text-right">
                    {{ number_format($mov->pivot->precio_compra,2) }}
                </td>

                <td class="text-right">
                    {{ number_format($mov->pivot->precio_venta,2) }}
                </td>

                <td class="text-right">
                    {{ number_format($subtotal,2) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="totales">
    <table>
        <tr>
            <td><strong>TOTAL</strong></td>
            <td class="text-right">
                Bs. {{ number_format($total,2) }}
            </td>
        </tr>
    </table>
</div>

<div style="clear:both"></div>

<div class="observaciones">
    <strong>Observaciones:</strong><br>
    {{ $nota->observaciones }}
</div>

<div class="footer">

    <div class="firma">
        <div class="linea"></div>
        Responsable
    </div>

    <div class="firma" style="float:right;">
        <div class="linea"></div>
        {{ $nota->tipo_nota == 'compra' ? 'Proveedor' : 'Cliente' }}
    </div>

</div>


</body>
</html>
