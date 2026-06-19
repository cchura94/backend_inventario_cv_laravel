<table>
    <thead>
        <tr style="background-color: #42e706; font-weight: bold;">
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio Venta Actual</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th>Categoria ID</th>
            <th>Created At</th>
            <th>Updated At</th>

            <th>Categoria.ID</th>
            <th>Categoria.Nombre</th>
            <th>Categoria.Descripción</th>
            <th>Categoria.Deleted At</th>
            <th>Categoria.Created At</th>
            <th>Categoria.Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto['id'] }}</td>
                <td>{{ $producto['nombre'] }}</td>
                <td>{{ $producto['descripcion'] }}</td>
                <td>{{ $producto['precio_venta_actual'] }}</td>
                <td>{{ $producto['imagen'] }}</td>
                <td>{{ $producto['estado'] ? 'Activo' : 'Inactivo' }}</td>
                <td>{{ $producto['categoria_id'] }}</td>
                <td>{{ $producto['created_at'] }}</td>
                <td>{{ $producto['updated_at'] }}</td>

                <td>{{ $producto['categoria']['id'] ?? '' }}</td>
                <td>{{ $producto['categoria']['nombre'] ?? '' }}</td>
                <td>{{ $producto['categoria']['descripcion'] ?? '' }}</td>
                <td>{{ $producto['categoria']['deleted_at'] ?? '' }}</td>
                <td>{{ $producto['categoria']['created_at'] ?? '' }}</td>
                <td>{{ $producto['categoria']['updated_at'] ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>