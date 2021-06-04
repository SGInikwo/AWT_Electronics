<!-- Using bootstrap for the form to add products-->
<div class="container">
    <h1>Create new Post</h1>
    <form action="/product/add" method="post">
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="">
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" id="price" value="">
        </div>
        <div class="form-group">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category" id="category">
                <option selected>Choose...</option>
                <option value="Laptop">Laptop</option>
                <option value="Mobile Phone">Mobile Phone</option>
            </select>
        </div>
        <div class="form-group">
            <label for="brand" class="form-label">Brand</label>
            <select class="form-select" name="brand" id="brand">
                <option selected>Choose...</option>
                <option value="Lenovo">Lenovo</option>
                <option value="HP">HP</option>
                <option value="Dell">Dell</option>
                <option value="Samsung">Samsung</option>
                <option value="iPhone">iPhone</option>
                <option value="Huawei">Huawei</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="">
        </div>
        <div class="form-group">
            <label for="image" class="form-label">Default file input example</label>
            <input class="form-control" type="file" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="image" class="form-label">Image</label>
            <input type="text" class="form-control" name="image" id="image" value="">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>
