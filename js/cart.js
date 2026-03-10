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
            updateCartCount();  
        }
    })
    .catch(error => console.log(error));

}
function updateCartCount(){

    fetch("backend/get_cart.php")
    .then(res => res.json())
    .then(data => {

        document.getElementById("cart-count").innerText = data.total_items;

    })
    .catch(error => console.log(error));

}
document.addEventListener("DOMContentLoaded", function(){
    updateCartCount();
});