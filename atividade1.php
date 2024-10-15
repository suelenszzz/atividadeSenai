<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Preços de Produtos</title>
</head>
<body>
    <h1>Calculadora de Preços de Produtos</h1>

    <form action="" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome[]" required><br><br>
        
        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco[]" step="0.01" min="0" required><br><br>

        <label for="nome2">Nome:</label>
        <input type="text" id="nome2" name="nome[]" required><br><br>
        
        <label for="preco2">Preço:</label>
        <input type="number" id="preco2" name="preco[]" step="0.01" min="0" required><br><br>

        <label for="nome3">Nome:</label>
        <input type="text" id="nome3" name="nome[]" required><br><br>
        
        <label for="preco3">Preço:</label>
        <input type="number" id="preco3" name="preco[]" step="0.01" min="0" required><br><br>

        <label for="nome4">Nome:</label>
        <input type="text" id="nome4" name="nome[]" required><br><br>
        
        <label for="preco4">Preço:</label>
        <input type="number" id="preco4" name="preco[]" step="0.01" min="0" required><br><br>

        <label for="nome5">Nome:</label>
        <input type="text" id="nome5" name="nome[]" required><br><br>
        
        <label for="preco5">Preço:</label>
        <input type="number" id="preco5" name="preco[]" step="0.01" min="0" required><br><br>

        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        function contarProdutosInferior50($produtos) {
            $contagem = 0;
            foreach ($produtos as $preco) {
                if ($preco < 50) {
                    $contagem++;
                }
            }
            return $contagem;
        }

        function listarProdutosEntre50E100($produtos) {
            $nomes = [];
            foreach ($produtos as $nome => $preco) {
                if ($preco >= 50 && $preco <= 100) {
                    $nomes[] = $nome;
                }
            }
            return $nomes;
        }

        function calcularMediaAcima100($produtos) {
            $soma = 0;
            $quantidade = 0;
            foreach ($produtos as $preco) {
                if ($preco > 100) {
                    $soma += $preco;
                    $quantidade++;
                }
            }
            return $quantidade > 0 ? $soma / $quantidade : 0;
        }

        $produtos = [];
        foreach ($_POST['nome'] as $key => $value) {
            if (!empty($value) && is_numeric($_POST['preco'][$key])) {
                $produtos[$value] = (float) $_POST['preco'][$key];
            }
        }

        $quantidadeBaixo50 = contarProdutosInferior50($produtos);
        $nomesEntre50E100 = listarProdutosEntre50E100($produtos);
        $mediaAcima100 = calcularMediaAcima100($produtos);

        echo "<h2>Resultados:</h2>";
        echo "<p>Quantidade de produtos abaixo de R$50,00: $quantidadeBaixo50</p>";
        echo "<p>Nomes dos produtos entre R$50,00 e R$100,00: ";
        echo !empty($nomesEntre50E100) ? implode(', ', $nomesEntre50E100) : "Nenhum";
        echo "</p>";
        echo "<p>Média dos preços dos produtos acima de R$100,00: R$".number_format($mediaAcima100, 2, ',', '.')."</p>";
    }
    ?>
</body>
</html>