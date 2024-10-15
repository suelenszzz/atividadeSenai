<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contador de Números</title>
</head>
<body>
    <h1>Contador de Números</h1>

    <form action="" method="post">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <label for="numero<?php echo $i; ?>">Número <?php echo $i; ?>:</label>
            <input type="number" id="numero<?php echo $i; ?>" name="numeros[]" required><br><br>
        <?php endfor; ?>

        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function contarNumeros($numeros) {
            $contagem = [
                'negativos' => 0,
                'positivos' => 0,
                'pares' => 0,
                'impares' => 0
            ];

            foreach ($numeros as $numero) {
                if ($numero < 0) {
                    $contagem['negativos']++;
                } elseif ($numero > 0) {
                    $contagem['positivos']++;
                }

                if ($numero % 2 == 0) {
                    $contagem['pares']++;
                } else {
                    $contagem['impares']++;
                }
            }

            return $contagem;
        }

        $numeros = array_map('floatval', $_POST['numeros']); 

        $resultado = contarNumeros($numeros);

        echo "<h2>Resultados:</h2>";
        echo "<p>Números negativos: {$resultado['negativos']}</p>";
        echo "<p>Números positivos: {$resultado['positivos']}</p>";
        echo "<p>Números pares: {$resultado['pares']}</p>";
        echo "<p>Números ímpares: {$resultado['impares']}</p>";
    }
    ?>
</body>
</html>