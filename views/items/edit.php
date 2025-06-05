<?php include_once "views/components/nav.php"; ?>
<?php include_once "views/partials/alert.php"; ?>

<div class="max-w-lg mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
    <h4 class="text-3xl font-bold text-gray-800 mb-6">Edit Item</h4>
    <form action="?action=items/update&id=<?php echo htmlspecialchars($item['id']); ?>" method="post" enctype="multipart/form-data" class="space-y-5">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($item['name']); ?>"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity <span class="text-red-500">*</span></label>
            <input type="number" name="quantity" id="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price <span class="text-red-500">*</span></label>
            <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($item['price']); ?>"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
            <select name="category" id="category"
                class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"
                        <?php echo $category['id'] == $item['category_id'] ? 'selected' : ''; ?>>
                        <?php echo $category['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <img src="<?php echo $item['file']; ?>" alt="file" class="h-20">
            <label class="block text-sm font-medium text-gray-700">Add Image <span class="text-red-500">*</span> </label>
            <input type="file" name="file" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <button type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-200">
                Update
            </button>
        </div>
    </form>
</div>