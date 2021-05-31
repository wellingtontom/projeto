<?php
	require_once 'CLASSES/usuarios.php';
	$u = new  Usuario;
?>

<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Projeto Login Leonardo</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
<div id="corpo-form-Cad">
	<h1>Ola Cadastrar-se</h1>
		<form method="POST">
			<input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
			<input type="text" name="telefone" placeholder="Telefone" maxlength="30">
			<input type="email" name="email" placeholder="usuario" maxlength="50">
			<input type="password" name="senha" placeholder="Senha" maxlength="15">
			<input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
			<input type="submit" value="Cadastrar">
		</form>
</div>
<?php
//verificar se clicou
if(isset($_POST['nome']))
{
	$nome = $_POST['nome'];
	$telefone = $_POST['telefone'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$ConfirmarSenha = $_POST['confSenha'];
	// verificar se esta preenchido 
	if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
	{
		$u->conectar("projeto_login","localhost","root","");
		if($u->msgErro =="") // se estiver ok 
		{
			if($senha == $confirmarSenha)
			{
				if($u->cadastrar($nome,$telefone,$email,$senha))
				{
					echo "Cadastrado com sucesso!";
				}
				else
				{
					echo "Email ja cadastrado!";
				}	
			}
			else	
			{
				echo "Senha e confirmar senha não conside!";
			}	
		}
		else
		{
			echo "Erro: ".$u->msgErro;
		}
		}
		else
		{
			echo "Preencha todos campos!";
		} 
		
}	
			


	?>	
</body>
</html>