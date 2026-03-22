fetch("backend/get_cart.php")

.then(res => res.json())

.then(data => {

let cartBody = document.getElementById("cartItems")

let total = 0

data.forEach(item => {

let row = document.createElement("tr")

let itemTotal = item.price * item.quantity

row.innerHTML = `
<td>${item.name}</td>
<td>₹${item.price}</td>
<td>${item.quantity}</td>
<td>₹${itemTotal}</td>
`

cartBody.appendChild(row)

total += itemTotal

})

document.getElementById("cartTotal").innerText = total

})