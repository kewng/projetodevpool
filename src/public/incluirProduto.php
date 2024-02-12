<?php
	include('../app/cfg/cfgProduto.php');
?>

<!DOCTYPE html>
<html lang="PT-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ERP da Kew</title>
		<link rel="stylesheet" type="text/css" href="assets/css/incluir.css">
        <script src="https://kit.fontawesome.com/fca9e7075b.js" crossorigin="anonymous"></script>
	</head>

    <body>
        <div class="container">
            <header class="header">
                <div class="header-content">
                    <h1 class="title">ERP!</h1>

                    <nav class="menu">
                        <div class="menu-nav">
                            <ul>
                                <li><a href="index.php">home</a></li>
                                <li><a href="produtos.php">produtos</a></li>
                                <li><a href="vendas.php">vendas</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>

            <main>
                <h1 class="incluir-cadastro">... > cadastro de produtos</h1>   
            
                <div class="incluir-container">
                    <div class="dados-produtos">
                        
                        <div class="1">

                            <form class="buttons">
                                <button class="salvar-button" type="button" name="salvar-button">Salvar</button>
                                <button class="cancelar-button" type="button"  name="cancelar-button">Cancelar</button>
                            </form>
                        

                            <form>
                                <label for="nome">nome<span class="red">*</span></label>
                                <input type="text" class="nome" id="nome" name="nome" placeholder="digite o nome do produto...">
                            
                                <label for="situacao">situação<span class="red">*</span></label>
                                <select name="situacao" id="situacao" class="situacao">
                                    <option value="">Selecionar</option>
                                    <option value="ative">Ativo</option>
                                    <option value="inative">Inativo</option>
                                </select>
                            </form>

                            <form>
                                <label for="descricao">descrição</label>
                                <input type="text" class="descricao" id="descricao" name="descricao" placeholder="digite a descrição do produto...">
                            </form>

                            <form>
                                <label for="unidade">unidade</label>
                                <input type="text" class="unidade" id="unidade" name="unidade" placeholder="un, pç, kg, ...">
                            
                                <label for="preco">preço<span class="red">*</span></label>
                                <input type="text" class="preco" id="preco" name="preco">
                            </form>

                        </div>
                    </div>
                </div>
            </main>

            <footer class="footer">
                    Portfolio pessoal &copy Kellen 2022. 
                </footer>
            </div>
        </div>
	</body>

	<script type="text/javascript" src="assets/js/incluirProduto.js"></script>
	
</html>