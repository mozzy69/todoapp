<?php

class Items
{
    // Class properties and other methods omitted to save space
 
 
    /**
     * Loads all list items associated with a user ID
     *
     * This function both outputs <li> tags with list items and returns an
     * array with the list ID, list URL, and the order number for a new item.
     *
     * @return array    an array containing list ID, list URL, and next order
     */
    public function loadListItems()
    {
        $sql = "SELECT
                    list_items.ListID, ListText, ListItemID, ListItemDone, ListURL
                FROM list_items
                LEFT JOIN lists
                USING (ListID)
                WHERE list_items.ListID=(
                    SELECT lists.ListID
                    FROM lists
                    WHERE lists.UserID=(
                        SELECT users.UserID
                        FROM users
                        WHERE users.Username=:user
                    )
                )
                ORDER BY ListItemPosition";
        if($stmt = $this->_db->prepare($sql))
        {
            $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
            $stmt->execute();
            $order = 0;
            while($row = $stmt->fetch())
            {
                $LID = $row['ListID'];
                $URL = $row['ListURL'];
                echo $this->formatListItems($row,   $order);
            }
            $stmt->closeCursor();
 
            // If there aren't any list items saved, no list ID is returned
            if(!isset($LID))
            {
                $sql = "SELECT ListID, ListURL
                        FROM lists
                        WHERE UserID = (
                            SELECT UserID
                            FROM users
                            WHERE Username=:user
                        )";
                if($stmt = $this->_db->prepare($sql))
                {
                    $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $LID = $row['ListID'];
                    $URL = $row['ListURL'];
                    $stmt->closeCursor();
                }
            }
        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
 
        return array($LID, $URL, $order);
    }
}

?>
