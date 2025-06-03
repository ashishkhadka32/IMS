<?php include 'views/components/header.php'; ?>
<?php
if (isset($_SESSION['alert']) && $_SESSION['alert']['type'] === 'success') {
    include 'views/partials/alert.php';
}
?>
<div class="max-w-4xl mx-auto mt-8">
    <h4 class="text-xl font-bold mb-4">Inventory Items List</h4>
    <a href="?action=create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Add New Item</a>

    <form method="GET" class="mb-4">
    <input type="hidden" name="action" value="index">
    <label for="category_id" class="font-semibold mr-2">Filter by Category:</label>
    <select name="category_id" id="category_id" onchange="this.form.submit()" class="border px-3 py-2 rounded">
        <option value="">All Categories</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id']; ?>" <?= isset($_GET['category_id']) && $_GET['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($cat['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">SN</th>
                <th class="border border-gray-300 p-2">Image</th>
                <th class="border border-gray-300 p-2">Name</th>
                <th class="border border-gray-300 p-2">Quantity</th>
                <th class="border border-gray-300 p-2">Price</th>
                <th class="border border-gray-300 p-2">Category</th>
                <th class="border border-gray-300 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
                <?php
                $count = 1;
                foreach ($items as $item): ?>

                    <tr <?php echo $item['quantity'] < 10 ? 'class="bg-red-100"' : ''; ?>>
                        <td class="border border-gray-300 p-2"><?= $count++; ?></td>
                        <td class="border border-gray-300 p-2"><img src="<?php echo $item['file']; ?>" alt="image" class="h-12"></td>
                        <td class="border border-gray-300 p-2"><?= htmlspecialchars($item['name']); ?></td>
                        <td class="border border-gray-300 p-2"><?= htmlspecialchars($item['quantity']); ?></td>
                        <td class="border border-gray-300 p-2">Rs.&nbsp<?= htmlspecialchars($item['price']); ?></td>
                        <td class="border border-gray-300 p-2"><?= htmlspecialchars($item['category']); ?></td>
                        <td class="border border-gray-300 p-2">
                            <a href="index.php?action=update&id=<?php echo $item['id']; ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <a href="index.php?action=delete&id=<?php echo $item['id']; ?>" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="border border-gray-300 p-2 text-center">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'views/components/footer.php'; ?>