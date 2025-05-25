function addToCart(productName, price, skipValue) {
        // var cartItem = {
        //     name: productName,
        //     price: price
        // };
        // var cart = JSON.parse(localStorage.getItem('cart')) || [];
        // cart.push(cartItem);
        // localStorage.setItem('cart', JSON.stringify(cart));
    checkLoginStatus(productName,price, skipValue);

    function addToTempCart(productName, price, skipValue){
        console.log(productName);
        console.log(price)
        $.ajax({
            url: 'tempItem.php',
            type: 'POST',
            data: {
                dataState: 0,
                ProductName: productName,
                skipValue: skipValue,
                Price: price
                },
                success: function(response) {
                    console.log("Done");
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert("An Error Occured ! :"+error);
                    window.location.href = 'index.html';
                }
        });
    }

    function checkLoginStatus(productName, price, skipValue) {
        $.ajax({
            url: 'AuthCheck.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.loggedIn) {
                    addToTempCart(productName, price, skipValue);
                    window.location.href = 'cart.html';
                } else {
                    window.location.href = 'login.html';
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert("An Error Occured with Authorization :"+error);
                window.location.href = 'login.html';
            }
        });
    }
}