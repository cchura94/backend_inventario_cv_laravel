<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 11px;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        img {
            width: 60px;
            height: auto;
        }
    </style>
</head>
<body>

    <h2>REPORTE DE PRODUCTOS</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td class="text-right">
                        Bs {{ number_format($producto->precio_venta_actual, 2) }}
                    </td>
                    <td class="text-center">
                        {{ $producto->estado ? 'Activo' : 'Inactivo' }}
                    </td>
                    <td class="text-center">
                        @if($producto->imagen)
                            <img src="{{ public_path($producto->imagen) }}" alt="Imagen">
                        @else
                            Sin imagen
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>