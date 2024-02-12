<?php
	include('../app/cfg/cfgVenda.php');
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
                <h1 class="incluir-cadastro">... > cadastro de vendas</h1>   
            
                <div class="incluir-container">
                    <div class="dados-produtos">
                        
                        <div class="1">
                            <form class="buttons">
                                <button class="salvar-button" type="button" name="salvar-button">Salvar</button>
                                <button class="cancelar-button" type="button"  name="cancelar-button">Cancelar</button>
                            </form>

                            <form>
                                <label for="nome">nome do cliente<span class="red">*</span></label>
                                <input type="text" class="nome" id="nome" name="nome" placeholder="digite o nome do cliente...">
                            
                                <label for="data">data</label>
                                <input type="date" class="data" id="data" name="data">
                            </form>

                            <form>
                                <label for="subtotal">subtotal</label>  
                                <input type="text" class="subtotal" id="subtotal" value="0" name="subtotal" readonly>

                                <label for="desconto">desconto (%)</label>  
                                <input type="text" class="desconto" id="desconto" value="0" name="desconto">

                                <label for="total">total venda</label>  
                                <input type="text" class="total" id="total" value="0" name="total" readonly>
                            </form>


                            <form>
                                <label for="produtos">produtos</label>
                                <select name="produtos" id="produtos" class="incluir-item">
                                    
                                </select><br>
                                <button type="button" id="incluir">+ incluir</button>
                            </form>
                            
                            <table class="table-produtos" id="table-produtos">
                                <thead class="listagem-produtos">
                                    <th>produto</th>
                                    <th>valor individual</th>
                                    <th>quantidade</th>
                                    <th><i class="fa fa-trash"></i></th>
                                </thead>

                                <tbody class="table-body" id="table-body"> 
                            </table>
                            
                            
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

    <script type="text/javascript" src="assets/js/incluirVendas.js"></script>
	
</html>