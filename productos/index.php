<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Botón de regreso */
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #e7b85c 0%, #f4d03f 100%);
            color: #1a2236;
            border: none;
            border-radius: 50px;
            padding: 12px 20px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(231, 184, 92, 0.3);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 1000;
        }
        
        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 184, 92, 0.4);
            background: linear-gradient(135deg, #f4d03f 0%, #e7b85c 100%);
        }
        
        .back-button::before {
            content: '←';
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .back-button {
                top: 15px;
                left: 15px;
                padding: 10px 16px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Botón de regreso -->
    <a href="../index.html" class="back-button">Volver al Inicio</a>

<div class="container">
    <h2>Crear Nuevo Producto</h2>
    <form action="create.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre del producto" required>
        <input type="text" name="descripcion" placeholder="Descripción" required>
        <input type="number" name="precio" placeholder="Precio" step="0.01" required>
        <input type="number" name="stock" placeholder="Stock" required>
        <button type="submit">Crear Producto</button>
    </form>

    <h2>Productos Existentes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
        <?php include 'read.php'; ?>
    </table>
</div>
</body>
</html> 