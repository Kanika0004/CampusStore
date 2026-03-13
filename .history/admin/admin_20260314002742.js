/* LOAD PRODUCTS */

function loadProducts(){

fetch("/campusstore/backend/get_products.php")

.then(res => res.json())

.then(data => {

let html=""

data.forEach(p=>{

html+=`

<tr>

<td>${p.id}</td>

<td>
<img src="/campusstore/public/${p.image}" width="50">
</td>

<td>${p.name}</td>

<td>${p.category}</td>

<td>₹${p.price}</td>

<td>

<button class="btn btn-warning btn-sm" onclick="editProduct(${p.id})">
Edit
</button>

<button class="btn btn-danger btn-sm" onclick="deleteProduct(${p.id})">
Delete
</button>

</td>

</tr>

`

})

document.getElementById("productTable").innerHTML=html

})

}



/* DELETE PRODUCT */

function deleteProduct(id){

if(!confirm("Delete this product?")) return

fetch("/campusstore/admin/backend/delete_product.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"id="+id

})

.then(res=>res.json())
.then(data=>{
if(data.status==="success"){
loadProducts()
}
})

}



/* EDIT PRODUCT */

function editProduct(id){

let name=prompt("Enter new name")
let price=prompt("Enter new price")

fetch("/campusstore/admin/backend/edit_product.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:`id=${id}&name=${name}&price=${price}`

})

.then(res=>res.json())
.then(data=>{
if(data.status==="success"){
loadProducts()
}
})

}



/* ADD PRODUCT */

function addProduct(){

let name=document.getElementById("name").value
let price=document.getElementById("price").value
let image=document.getElementById("image").value
let category=document.getElementById("category").value
let subcategory=document.getElementById("subcategory").value

fetch("/campusstore/admin/backend/add_product.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:`name=${name}&price=${price}&image=${image}&category=${category}&subcategory=${subcategory}`

})

.then(res=>res.json())
.then(data=>{

if(data.status==="success"){

alert("Product Added")

loadProducts()

}

})

}

let salesChartInstance = null;

function loadSalesChart(){

fetch("/campusstore/backend/get_sales_daywise.php")
.then(res => res.json())
.then(data => {

let labels = []
let revenue = []

data.forEach(row=>{
labels.push(row.day)
revenue.push(row.revenue)
})

// get canvas context
const ctx = document.getElementById("salesChart").getContext("2d")

// destroy old chart if exists
if(salesChartInstance){
salesChartInstance.destroy()
}

salesChartInstance = new Chart(ctx,{

type:"line",

data:{
labels:labels,

datasets:[{
label:"Revenue",
data:revenue,
borderColor:"#0d6efd",
backgroundColor:"rgba(13,110,253,0.15)",
pointBackgroundColor:"#0d6efd",
pointRadius:5,
tension:0.4,
fill:true
}]
},

options:{
responsive:true,

plugins:{
legend:{
display:true,
position:"top"
}
},

scales:{
y:{
beginAtZero:true
}
}

}

})

})

}

function loadCategoryChart(){

fetch("/campusstore/backend/get_category_products.php")

.then(res=>res.json())

.then(data=>{

let labels=[]
let values=[]

data.forEach(row=>{
labels.push(row.category)
values.push(row.total)
})

new Chart(document.getElementById("categoryChart"),{

type:"doughnut",

data:{
labels:labels,

datasets:[{
data:values,

backgroundColor:[
"#0d6efd",
"#20c997",
"#ffc107",
"#dc3545",
"#6f42c1"
]
}]
},

options:{
plugins:{
legend:{
position:"bottom"
}
}
}

})

})

}

function loadOrders(){

fetch("/campusstore/backend/get_orders.php")

.then(res=>res.json())

.then(data=>{

let html=""

data.forEach(o=>{

html+=`

<tr>

<td>${o.id}</td>

<td>${o.name}</td>

<td>₹${o.total}</td>

<td>${o.payment_method}</td>

<td>

<select class="form-select form-select-sm"
onchange="updateStatus(${o.id}, this.value)">

<option ${o.status=="Pending"?"selected":""}>Pending</option>
<option ${o.status=="Processing"?"selected":""}>Processing</option>
<option ${o.status=="Shipped"?"selected":""}>Shipped</option>
<option ${o.status=="Delivered"?"selected":""}>Delivered</option>

</select>

</td>

<td>${o.created_at}</td>

<td>
<button class="btn btn-sm btn-primary"
onclick="viewOrder(${o.id})">
View
</button>
</td>

</tr>
`
})

document.getElementById("ordersTable").innerHTML=html

})

}

function searchOrders(){

let input=document.getElementById("searchOrders").value.toLowerCase()
let rows=document.querySelectorAll("#ordersTable tr")

rows.forEach(row=>{

let id=row.cells[0].innerText.toLowerCase()
let user=row.cells[1].innerText.toLowerCase()

if(id.includes(input) || user.includes(input)){
row.style.display=""
}else{
row.style.display="none"
}

})

}

function updateStatus(id,status){

fetch("/campusstore/backend/update_order_status.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:`id=${id}&status=${status}`

})
.then(res=>res.json())
.then(data=>{

if(data.status==="success"){
alert("Status updated")
}

})

}

function viewOrder(id){

fetch(`/campusstore/backend/get_order_details.php?id=${id}`)

.then(res=>res.json())

.then(data=>{

let html=`

<p><strong>Order ID:</strong> ${data.id}</p>

<p><strong>Customer:</strong> ${data.name}</p>

<p><strong>Email:</strong> ${data.email}</p>

<p><strong>Address:</strong> ${data.address}</p>

<p><strong>Total:</strong> ₹${data.total}</p>

<p><strong>Payment:</strong> ${data.payment_method}</p>

`

document.getElementById("orderDetails").innerHTML=html

new bootstrap.Modal(document.getElementById("orderModal")).show()

})

}



/* LOAD CUSTOMERS */

function loadCustomers(){

fetch("/campusstore/admin/backend/get_customers.php")

.then(res=>res.json())

.then(data=>{

let html=""

data.forEach(c=>{

html+=`

<tr>

<td>${c.id}</td>
<td>${c.name}</td>
<td>${c.email}</td>

<td>
<button class="btn btn-primary btn-sm"
onclick="viewCustomerOrders(${c.id})">
View Orders
</button>
</td>

<td>
<button class="btn btn-danger btn-sm"
onclick="deleteCustomer(${c.id})">
Delete
</button>
</td>

</tr>

`

})

document.getElementById("customerTable").innerHTML=html

})

}



/* DELETE CUSTOMER */

function deleteCustomer(id){

if(!confirm("Delete this customer?")) return

fetch("/CampusStore/admin/backend/delete_customer.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"id="+id

})

.then(res=>res.json())
.then(data=>{

if(data.status==="success"){

alert("Customer deleted")
loadCustomers()

}else{

alert(data.message || "Delete failed")

}

})

}






/* LOAD ENQUIRIES */

function loadEnquiries(){

fetch("/CampusStore/admin/backend/get_enquiries.php")

.then(res=>res.json())

.then(data=>{

let html=""

data.forEach(e=>{

html+=`

<tr>

<td>${e.id}</td>
<td>${e.name}</td>
<td>${e.email}</td>
<td>${e.message}</td>
<td>${e.admin_reply ?? "-"}</td>
<td>${e.status}</td>

<td>

<button class="btn btn-success btn-sm"
onclick="replyEnquiry(${e.id})">
Reply
</button>

<button class="btn btn-danger btn-sm"
onclick="deleteEnquiry(${e.id})">
Delete
</button>

</td>

</tr>

`

})

document.getElementById("enquiryTable").innerHTML = html

})

}