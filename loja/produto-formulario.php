<?php
require_once("cabecalho.php");
require_once("banco-categoria.php");
require_once("logica-usuario.php");

verificaUsuario();

$categoria = new Categoria("","","");
$categoria->setId(1);

$produtoDAO = new ProdutoDAO($conexao);
$produto = new Produto("", "", "", $categoria, "");

$categoriaDAO = new CategoriaDAO($conexao);
$categorias = $categoriaDAO->listaCategorias();
?>
	<h1>Adiciona Produto</h1>
    <form action="adiciona-produto.php" method="post">
    	<table class="table">
			<?php require_once("produto-formulario-base.php"); ?>
			<tr>
				<td>
        			<input class="btn btn-primary" type="submit" value="Cadastrar" />
				</td>
			</tr>
    	</table>

    </form>
</html>
<?php require_once("rodape.php"); ?>
