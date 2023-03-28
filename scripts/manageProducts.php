  <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';

    if ($conn) {
        if (isset($_GET["action"]) && $_GET["action"] == "delete") {
            $id = $_GET["id"];
            $query = "DELETE FROM products WHERE product_id = $id";
            $result = mysqli_query($conn, $query);
            if (!empty($result))
                showProducts(0);
        }

        if (isset($_GET["action"]) && $_GET["action"] == "edit") {
            $id = $_GET["id"];
            showProducts($id);
        }

        if (isset($_GET["action"]) && $_GET["action"] == "update") {
            $id = $_GET["id"];
            $name = ucwords($_GET["name"]);
            $description = strtoupper($_GET["description"]);
            $price = ucwords($_GET["price"]);
            $quantity = ucwords($_GET["quantity"]);
            $expiryDate = $_GET["expiryDate"];
            $categoryId = $_GET["categoryId"];
            updateProducts($id, $name, $description, $price, $quantity, $expiryDate, $categoryId);
        }

        if (isset($_GET["action"]) && $_GET["action"] == "cancel")
            showProducts(0);

        if (isset($_GET["action"]) && $_GET["action"] == "search")
            searchProduct(strtoupper($_GET["text"]));

        if (isset($_GET["action"]) && $_GET["action"] == "searchUpdate")
            searchUpdatedProduct(strtoupper($_GET["text"]));
    }

    function showProducts($id)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
        if ($conn) {
            $seq_no = 0;
            $query = "SELECT * FROM products";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $seq_no++;
                if ($row['product_id'] == $id)
                    showEditOptionsRow($seq_no, $row);
                else
                    showProductRow($seq_no, $row);
            }
        }
    }

    function showEditedProducts($id)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
        if ($conn) {
            $seq_no = 0;
            $query = "SELECT * FROM product_updates";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $seq_no++;
                if ($row['product_id'] == $id)
                    showEditOptionsRow($seq_no, $row);
                else
                    showEditedProductRow($seq_no, $row);
            }
        }
    }

    function showProductRow($seq_no, $row)
    {
    ?>
      <tr>
          <td><?php echo $seq_no; ?></td>
          <td><?php echo $row['product_name']; ?></td>
          <td><?php echo $row['description']; ?></td>
          <td><?php echo $row['price']; ?></td>
          <td><?php echo $row['stock_quantity']; ?></td>
          <td><?php echo $row['expiry_date']; ?></td>
          <td><?php echo $row['category_id']; ?></td>
          <td>
              <button href="" class="btn btn-info btn-sm" onclick="editProduct(<?php echo $row['product_id']; ?>);">
                  <i class="fa fa-pencil"></i>
              </button>
              <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?php echo $row['product_id']; ?>);">
                  <i class="fa fa-trash"></i>
              </button>
          </td>
      </tr>
  <?php
    }

    function showEditedProductRow($seq_no, $row)
    {
    ?>
      <tr>
          <td><?php echo $seq_no; ?></td>
          <td><?php echo $row['updated_by']; ?></td>
          <td class="<?php echo ($row['old_product_name'] !== $row['new_product_name']) ? 'bg-danger text-white' : ''; ?>"><?php echo $row['old_product_name']; ?></td>
          <td class="<?php echo ($row['old_product_name'] !== $row['new_product_name']) ? 'bg-success text-white' : ''; ?>"><?php echo $row['old_product_name']; ?><?php echo $row['new_product_name']; ?></td>
          <td class="<?php echo ($row['old_price'] !== $row['new_price']) ? 'bg-danger text-white' : ''; ?>"><?php echo $row['old_price']; ?><?php echo $row['old_price']; ?></td>
          <td class="<?php echo ($row['old_price'] !== $row['new_price']) ? 'bg-success text-white' : ''; ?>"><?php echo $row['new_price']; ?></td>
          <td class="<?php echo ($row['old_description'] !== $row['new_description']) ? 'bg-danger text-white' : ''; ?>"><?php echo $row['old_description']; ?></td>
          <td class="<?php echo ($row['old_description'] !== $row['new_description']) ? 'bg-success text-white' : ''; ?>"><?php echo $row['new_description']; ?></td>
          <td class="<?php echo ($row['old_stock_quantity'] !== $row['new_stock_quantity']) ? 'bg-danger text-white' : ''; ?>"><?php echo $row['old_stock_quantity']; ?></td>
          <td class="<?php echo ($row['old_stock_quantity'] !== $row['new_stock_quantity']) ? 'bg-success text-white' : ''; ?>"><?php echo $row['new_stock_quantity']; ?></td>
          <td class="<?php echo ($row['old_expiry_date'] !== $row['new_expiry_date']) ? 'bg-danger text-white' : ''; ?>"><?php echo $row['old_expiry_date']; ?></td>
          <td class="<?php echo ($row['old_expiry_date'] !== $row['new_expiry_date']) ? 'bg-success text-white' : ''; ?>"><?php echo $row['new_expiry_date']; ?></td>
          <td class="<?php echo ($row['old_category_id'] !== $row['new_category_id']) ? 'bg-danger text-white' : ''; ?>"><?php echo $row['new_category_id']; ?></td>
          <td class="<?php echo ($row['old_category_id'] !== $row['new_category_id']) ? 'bg-success text-white' : ''; ?>"><?php echo $row['old_category_id']; ?></td>
      </tr>
  <?php
    }


    function showEditOptionsRow($seq_no, $row)
    {
    ?>
      <tr>
          <td><?php echo $seq_no; ?></td>
          <td>
              <input type="text" class="form-control" value="<?php echo $row['product_name']; ?>" placeholder="Product Name" id="product_name" required>
          </td>
          <td>
              <input type="text" class="form-control" value="<?php echo $row['description']; ?>" placeholder="Description" id="description" required>
          </td>
          <td>
              <input type="text" class="form-control" value="<?php echo $row['price']; ?>" placeholder="Price" id="price" required>
          </td>
          <td>
              <input type="text" class="form-control" value="<?php echo $row['stock_quantity']; ?>" placeholder="Quantity In Stock" id="quantity" required>
          </td>
          <td>
              <input type="date" class="form-control" value="<?php echo $row['expiry_date']; ?>" placeholder="Expiry Date" id="expiryDate" required>
          </td>
          <td>
              <input type="text" class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="Category Id" id="categoryId" required>
          </td>
          <td>
              <button href="" class="btn btn-success btn-sm" onclick="updateProducts(<?php echo $row['product_id']; ?>);">
                  <i class="fa fa-edit"></i>
              </button>
              <button class="btn btn-danger btn-sm" onclick="cancel();">
                  <i class="fa fa-close"></i>
              </button>
          </td>
      </tr>
  <?php
    }

    function updateProducts($id, $name, $description, $price, $quantity, $expiryDate, $categoryId)
    {
        session_start();
        $current_email = $_SESSION['email'];
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
        $query = "UPDATE products SET product_name = '$name', description = '$description', price = '$price', stock_quantity = '$quantity', expiry_date = '$expiryDate' , category_id = '$categoryId' WHERE product_id = $id";
        $result = mysqli_query($conn, $query);
        if (!empty($result)) {
            showProducts(0);
            $update_query = "UPDATE product_updates SET updated_by = '$current_email' WHERE product_id = $id";
            $result = mysqli_query($conn, $update_query);
        }
    }

    function searchProduct($text)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
        if ($conn) {
            $seq_no = 0;
            $query = "SELECT * FROM products WHERE product_name LIKE '%$text%'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $seq_no++;
                showProductRow($seq_no, $row);
            }
        }
    }

    function searchUpdatedProduct($text)
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
        if ($conn) {
            $seq_no = 0;
            $query = "SELECT * FROM product_updates WHERE old_product_name LIKE '%$text%'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $seq_no++;
                showEditedProductRow($seq_no, $row);
            }
        }
    }

    ?>