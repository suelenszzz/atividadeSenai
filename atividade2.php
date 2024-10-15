<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Notas dos Alunos</title>
</head>
<body>
    <h1>Cadastro de Notas dos Alunos</h1>

    <form action="" method="post">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <label for="nome<?php echo $i; ?>">Nome do Aluno <?php echo $i; ?>:</label>
            <input type="text" id="nome<?php echo $i; ?>" name="nome[]" required><br><br>
            
            <label for="nota<?php echo $i; ?>">Nota do Aluno <?php echo $i; ?>:</label>
            <input type="number" id="nota<?php echo $i; ?>" name="nota[]" step="0.01" min="0" max="10" required><br><br>
        <?php endfor; ?>

        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function calcularMediaNotas($notas) {
            $soma = array_sum($notas);
            return $soma / count($notas);
        }

        function alunoComMaiorNota($alunos, $notas) {
            $indiceMaiorNota = array_search(max($notas), $notas);
            return $alunos[$indiceMaiorNota];
        }

        $alunos = $_POST['nome'];
        $notas = array_map('floatval', $_POST['nota']); 

        $mediaNotas = calcularMediaNotas($notas);
        $alunoMaiorNota = alunoComMaiorNota($alunos, $notas);
        $maiorNota = max($notas);

        echo "<h2>Resultados:</h2>";
        echo "<p>Média da turma: " . number_format($mediaNotas, 2, ',', '.') . "</p>";
        echo "<p>Aluno com a maior nota: $alunoMaiorNota (Nota: " . number_format($maiorNota, 2, ',', '.') . ")</p>";
    }
    ?>
</body>
</html>