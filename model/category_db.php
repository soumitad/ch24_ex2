<?php
function get_categories() {
    global $db;
    $query = 'SELECT *,
                (SELECT COUNT(*)
                 FROM products_guitar_shop1
                 WHERE products_guitar_shop1.categoryID = categories_guitar_shop1.categoryID)
                 AS productCount
              FROM categories_guitar_shop1
              ORDER BY categoryID';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_category($category_id) {
    global $db;
    $query = '
        SELECT *
        FROM categories_guitar_shop1
        WHERE categoryID = :category_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_category($name) {
    global $db;
    $query = 'INSERT INTO categories_guitar_shop1
                 (categoryName)
              VALUES
                 (:name)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $category_id = $db->lastInsertId();
        return $category_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_category($category_id, $name) {
    global $db;
    $query = '
        UPDATE categories_guitar_shop1
        SET categoryName = :name
        WHERE categoryID = :category_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_category($category_id) {
    global $db;
    $query = 'DELETE FROM categories_guitar_shop1 WHERE categoryID = :category_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>
