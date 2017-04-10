<?php 

/**
* 
*/
class ProdutoDAO {
	
	private $conexao;

	function __construct($conexao)
	{
		$this->conexao = $conexao;
	}

	function insereProduto(Produto $produto) {
		$isbn = "";
		echo "string";
		print_r($produto);
		if ($produto->temIsbn()) {
			$isbn = $produto->getIsbn();
		}
		$tipoProduto = get_class($produto);
		echo "$tipoProduto";
		$query = "INSERT INTO 
				  	  produtos (nome,
				  	  			preco, 
				  	  			descricao, 
				  	  			categoria_id, 
				  	  			usado,
				  	  			isbn,
				  	  			tipoProduto) 
				  	  	VALUES ('{$produto->getNome()}',
				  	  			 {$produto->getPreco()},
				  	  			'{$produto->getDescricao()}',
				  	  			 {$produto->getCategoria()->getId()},
				  	  			 {$produto->getUsado()},
				  	  			 '{$isbn}',
				  	  			 '{$tipoProduto}')";

		return mysqli_query($this->conexao, $query);
	}

	function listaProdutos() {
		$produtos = array();

		$resultado = mysqli_query($this->conexao, "SELECT p.*,c.nome AS categoria_nome FROM produtos AS p JOIN categorias AS c ON p.categoria_id = c.id");

		while($produto_array = mysqli_fetch_assoc($resultado)) {
			
			$categoria = new Categoria();
			$categoria->setNome($produto_array['categoria_nome']);


			$nome        = $produto_array['nome'];
			$preco       = $produto_array['preco'];
			$descricao   = $produto_array['descricao'];
			$usado       = $produto_array['usado'];
			// $isbn        = $produto_array['isbn'];
			// $tipoProduto = $produto_array['tipoProduto'];
			if ($tipoProduto == "Livro") {
				$livro = new Livro($nome, $preco, $descricao, $categoria, $usado);
				$livro->setIsbn($isbn);
			} else {
				$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);	
			}

			$produto->setId($produto_array['id']);
			array_push($produtos, $produto);
		}

		return $produtos;
	}

	function busca_produto($id) {

		$query = "SELECT * FROM produtos WHERE id={$id}";
		
		$resultado = mysqli_query($this->conexao, $query);
		$produto_buscado = mysqli_fetch_assoc($resultado);
		
		$categoria = new Categoria();
	    $categoria->setId($produto_buscado['categoria_id']);

	    $nome      = $produto_buscado['nome'];
		$preco     = $produto_buscado['preco'];
		$descricao = $produto_buscado['descricao'];
		$usado     = $produto_buscado['usado'];

		$produto = new Produto($nome, $preco, $descricao, $categoria, $usado);

		$produto->setId($produto_buscado['id']);

		return $produto;
	}

	function alteraProduto(Produto $produto) {

		$isbn = "";
		if ($produto->temIsbn()) {
			$isbn = $produto->getIsbn();
		}
		$tipoProduto = get_class($produto);

		$query = "UPDATE 
					  produtos 
				  SET 
				  	  nome         = '{$produto->getNome()}', 
				  	  preco        =  {$produto->getPreco()}, 
				  	  descricao    = '{$produto->getDescricao()}', 
				  	  categoria_id =  {$produto->getCategoria()->getId()}, 
				  	  usado        =  {$produto->getUsado()}, 
				  	  isbn         = '{$isbn}', 
				  	  tipoProduto  = '{$tipoProduto}' 
				  WHERE 
				   	  id = {$produto->getId()}";

		return mysqli_query($this->conexao, $query);
	}

	function removeProduto($id)
	{
		$query = "DELETE FROM produtos WHERE id={$id}";
		return mysqli_query($this->conexao, $query);
	}
}