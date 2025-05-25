// Loop through the products array
for (var i = 0; i < products.length; i++) {
// Add line break after every 4 products
    if (i % 4 === 0) {
        if (i !== 0) {
            document.write('<br>');
        }
        document.write('<br> <br>');
        }
    var product = products[i];
    document.write(`
                <div class="card">
                <img src="${product.image}" alt="Image ${i + 1}">
                <div class="card-content">
                <h3 style="font-family: Arial, Helvetica, sans-serif;">Price</h3><br>
                <p style="font-family: Arial, Helvetica, sans-serif;">${product.id}</p>
                <div class="btn-container">
                    <button class="btn btn-buy" onclick="addToCart('${product.id}', ${product.price}, 1)">Buy Now</button>
                    <button class="btn btn-cart" onclick="addToCart('${product.id}', ${product.price}, 0)">Add to Cart</button>
                </div>
                </div>
                </div>
            `);
}