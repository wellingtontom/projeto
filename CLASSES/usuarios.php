<?php
Class usuario
{	
	
	private $pdo;
	public $msgErro = ""; // ok
	public function conectar($nome, $host, $usuario, $senha)
	{
		
		global $pdo;
try
		{

			$pdo = new PDO("mysql:dbname=".$nome.";root".$host,$usuario,$senha);
		
		} catch(PDOException $e){
			$msgErro = $e->getMessage();
		}
	}

	public function cadastrar($nome, $telefone, $email, $senha)
	{
		global $pdo;
		//verificar se é cadastrado
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e",$email);
		$sql->execute();

		if ($sql->rowCount() > 0)
			{
				return false; // ja esta cadastrado 
			}
			else
			{	
				// caso nao cadastrar
				$sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)"); 
				$sql->bindValue(":n",$nome);
				$sql->bindValue(":t",$telefone);
				$sql->bindValue(":e",$email);
				$sql->bindValue(":s",md5($senha));
				$sql->execute();
				return true;	//tudo ok
			}

		}

		public function logar($email, $senha)
		{
			global $pdo;
			// verificar se o email e senha sta cadastrado
			$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
			$sql->bindValue(":e",$email);
			$sql->bindValue(":s",md5($senha));
			$sql->execute();
			if($sql->rowCount() > 0)
			{
				// entrar no sistema 
				$dado = $sql->fetch();
				session_start();
				$_SESSION['id_usuario'] = $dado['id_usuario'];
				return true; // cadastrado com sucesso
			}
			else
			{
				return false; // nao esta logado
			}	
		}

	}
?>