<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Insert a Product</h1>
    <form method = "post" action="">
    <div class = "category_dropdown">
         <select name="category_id" id="category_id">
       <!-- backend retrieval on sql -->
         <option value="default" selected>Category ID</option>
         </select>
    </div>
    <div class = "brand_dropdown">
        <select name="brand_id" id="brand_id">
            <!-- backend retrieval on sql -->
            <option value="default" selected>Brand ID</option>
         </select>
    </div>
    <div class = "product_name">
        <label>Product Name</label>
        <input type = "text" name = "product_name" placeholder="Product Name">
    </div>
    <div class = "quantity">
        <label>Quantity</label>
        <input type = "number" name = "quantity" placeholder="Quantity">
    </div>
    <div class = "date">
        <label>Date</label>
        <input type = "date" name = "date" value="2024-12-01">
    </div>
    <div class = "status_dropdown">
        <select name="status" id="status">
            <option value="option1">Available</option>
            <option value="option2">Low Stock</option>
            <option value="option3" selected>Out Of Stock</option>
         </select>
    </div>
    <div class = "notes">
        <label>Product Name</label>
        <input type = "text" name = "notes" placeholder="Notes">
    </div>
    <div class = "submit">
        <input type = "submit" value = "Save Product">
    </div>


  <!-- ... -->
</select>


    </form>
</body>
</html>