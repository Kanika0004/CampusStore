function addToCart(productId) {

    console.log("Product added:", productId);

    fetch("backend/add_to_cart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })

    .then(res => res.json())
    .then(data => {
        if(data.status === "success"){
            alert("Product added to cart!");
        }
    })
    .catch(error => console.log(error));

}