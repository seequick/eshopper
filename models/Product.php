<?php
class Product{
    const SHOW_BY_DEFAULT = 1;
    const SHOW_BY_RECOMMENDED = 3;
    /**
     * Returns an array of products
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT){
        $count = intval($count);
        $db = Db::getConnection();
        $productsList = [];
        $sql = 'SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1"'
            . ' ORDER BY id DESC '
            . 'LIMIT ' . $count;
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            //$productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }
    public  static function getRecommendedProducts($count = self::SHOW_BY_RECOMMENDED){
        $db = Db::getConnection();
        $recommendedList = [];
        $sql = 'SELECT id, name, price, is_new FROM product '
            .  'WHERE status = 1 AND is_recommended = 1 '
            .  'ORDER BY id DESC '
            .  'LIMIT ' . $count;
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch()) {
            $recommendedList[$i]['id'] = $row['id'];
            $recommendedList[$i]['name'] = $row['name'];
            $recommendedList[$i]['price'] = $row['price'];
            $recommendedList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $recommendedList;
        }

    /**
     * Returns an array of products
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1){
        if ($categoryId) {
			$page = intval($page);
			$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
			
            $db = Db::getConnection();
            $products = [];
            $sql = "SELECT id, name, price, is_new FROM product " // image
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id ASC "
                . "LIMIT ".self::SHOW_BY_DEFAULT
				. " OFFSET ". $offset;
            //echo $sql;
            $result = $db->query($sql);
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                //$products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }
            return $products;
        }
    }
    /**
     * Returns product item by id
     * @param integer $id
     */
    public static function getProductById($id){
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();
            $result = $db->query('SELECT * FROM product WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();
        }
    }
	public static function getProductByIds($idsArray){
		$products = [];
		$db = Db::getConnection();
		$idsString = implode(',', $idsArray); 
		$sql = "SELECT * FROM product WHERE status=1 AND id IN ($idsString)";
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$i = 0;
		while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                //$products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['code'] = $row['code'];
                $i++;
            } 
			return $products;
	}
	public static function getTotalProductsInCategory($categoryId){
        $db = Db::getConnection();
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();
        return $row['count'];
    }
}