<tr>
	<td>Nome</td>
	<td><input class="form-control" type="text" name="nome" value="<?=$produto->getNome()?>" /></td>
</tr>
<tr>
	<td>Preço</td>
	<td><input class="form-control" type="number" name="preco" value="<?=$produto->getPreco()?>" /></td>
</tr>
<tr>
	<td>Descrição</td>
	<td><textarea class="form-control" name="descricao"><?=$produto->getDescricao()?></textarea></td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="checkbox" name="usado" value="true" <?=$usado?> >Usado
	</td>
</tr>
<tr>
	<td>Categorias</td>
	<td>
		<select name="categoria_id" class="form-control">
		<?php
			foreach($categorias as $categoria):
			$essaCategoria = $categoria->getId() == $produto->getCategoria()->getId();
			$selecao = $essaCategoria ? "selected='selected'" : "";
		?>
			<option  value="<?=$categoria->getId()?>" <?=$selecao?> ><?=$categoria->getNome()?></option>
		<?php endforeach ?>
		</select>
	</td>
</tr>
<tr>
	<td>Tipo do Produto</td>
	<td>
		<select name="tipoProduto" class="form-control">
		<?php
		$tipos = array("Produto", "Livro");
		foreach($tipos as $tipo):
			$essaTipo = get_class($produto) == $tipo;
			$selecao = $essaTipo ? "selected='selected'" : "";
		?>
			<option  value="<?=$tipo?>" <?=$selecao?> ><?=$tipo?></option>
		<?php endforeach ?>
		</select>
	</td>
</tr>
<tr>
	<td>Isbn (Caso seja um livro)</td>
	<td>
		<input type="text" name="isbn" class="form-control" value="<?php if($produto->temIsbn()) echo $produto->getIsbn()?>">
	</td>
</tr>