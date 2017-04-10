<?php
require_once("cabecalho.php");

$categoriaDAO = new CategoriaDAO($conexao);

$categorias = $categoriaDAO->listaCategorias();

$id = $_GET['id'];

$produtoDAO = new ProdutoDAO($conexao);

$produto = $produtoDAO->busca_produto($id);

$usado = $produto->getUsado() ? "checked='checked'" : "";
?>
	<h1>Alterando produto</h1>
    <form action="altera-produto.php" method="post">
    	<table class="table">
    	 	<input type="hidden" name="id" value="<?=$produto->getId()?>">
			<?php include("produto-formulario-base.php"); ?>
			<tr>
				<td>
        			<input class="btn btn-primary" type="submit" value="Alterar" />
				</td>
			</tr>
    	</table>

    </form>
</html>
<?php include("rodape.php"); ?>
