	function get_toplists($category){
		global $db;
		$query = "SELECT image_id, filename, user_id, timestamp FROM images WHERE category = :category AND vote = 1 ORDER BY average DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':category', $category);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$toplists = array();
		$filepaths = array();
		$toplist1 = array();
		$toplist3 = array();
		$toplist10 = array();
		$toplist30 = array();
		$toplist90 = array();
		$toplistAll = array();
		$arrayLength = count($result) - 1;
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) < 86400 )){
				array_push($toplist1, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist1) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 86401) && ((time() - strtotime($result[$i]['timestamp'])) < 432000)){
				array_push($toplist3, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist3) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 432001) && ((time() - strtotime($result[$i]['timestamp'])) < 864000)){
				array_push($toplist10, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist10) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 864001) && ((time() - strtotime($result[$i]['timestamp'])) < 1641600)){
				array_push($toplist30, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist30) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 1641601) && ((time() - strtotime($result[$i]['timestamp'])) < 5097600)){
				array_push($toplist90, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist90) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 5097601) && ((time() - strtotime($result[$i]['timestamp'])) < time())){
				array_push($toplistAll, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplistAll) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			array_push($filepaths, 'member/'.$result[$i]['user_id'].'/files/'.$result[$i]['filename']);
		}
		array_push($toplists, $filepaths); array_push($toplists, $toplist1); array_push($toplists, $toplist3); array_push($toplists, $toplist10);
		array_push($toplists, $toplist30); array_push($toplists, $toplist90); array_push($toplists, $toplistAll);
		return $toplists;
	}
	
	
	function get_toplists_subcategory($category, $subcategory){
		global $db;
		$query = "SELECT image_id, filename, user_id, timestamp FROM images WHERE category = :category AND vote = 1 AND subcategory = :subcategory ORDER BY average DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':category', $category);
		$statement->bindValue(':subcategory', $subcategory);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$toplists = array();
		$filepaths = array();
		$toplist1 = array();
		$toplist3 = array();
		$toplist10 = array();
		$toplist30 = array();
		$toplist90 = array();
		$toplistAll = array();
		$arrayLength = count($result) - 1;
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) < 86400 )){
				array_push($toplist1, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist1) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 86401) && ((time() - strtotime($result[$i]['timestamp'])) < 432000)){
				array_push($toplist3, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist3) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 432001) && ((time() - strtotime($result[$i]['timestamp'])) < 864000)){
				array_push($toplist10, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist10) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 864001) && ((time() - strtotime($result[$i]['timestamp'])) < 1641600)){
				array_push($toplist30, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist30) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 1641601) && ((time() - strtotime($result[$i]['timestamp'])) < 5097600)){
				array_push($toplist90, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplist90) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			if(((time() - strtotime($result[$i]['timestamp'])) > 5097601) && ((time() - strtotime($result[$i]['timestamp'])) < time())){
				array_push($toplistAll, 'member/'.$result[$i]['user_id'].'/thumbnail/'.$result[$i]['filename']);
			}
			if(count($toplistAll) >= 20){
				break;
			}
		}
		
		for($i = 0; $i <= $arrayLength; $i++){
			array_push($filepaths, 'member/'.$result[$i]['user_id'].'/files/'.$result[$i]['filename']);
		}
		array_push($toplists, $filepaths); array_push($toplists, $toplist1); array_push($toplists, $toplist3); array_push($toplists, $toplist10);
		array_push($toplists, $toplist30); array_push($toplists, $toplist90); array_push($toplists, $toplistAll);
		return $toplists;
	}