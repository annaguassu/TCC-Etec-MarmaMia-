<?php 

	function getProductsByIds($pdo, $ids) {
		$sql = "SELECT * FROM produtos WHERE id_produto IN (".$ids.")";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

?>
