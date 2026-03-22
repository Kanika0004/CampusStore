console.log("ADMIN JS LOADED")

/* LOAD PRODUCTS */

function loadProducts(){

fetch("/CampusStore/backend/get_products.php")

.then(res => res.json())

.then(data => {

let html=""

data.forEach(p=>{

html+=`

<tr>

<td>${p.id}</td>

<td>
<img src="/CampusStore/public/${p.image}" width="50">
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

fetch("/CampusStore/admin/backend/delete_product.php",{

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

fetch("/CampusStore/admin/backend/edit_product.php",{

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

fetch("/CampusStore/admin/backend/add_product.php",{

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

fetch("/CampusStore/backend/get_sales_daywise.php")
.then(res => res.json())
.then(data => {

let labels = []
let revenue = []

data.forEach(row=>{
labels.push(row.date)
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

options: {
    responsive: true,
    

    plugins: {
        legend: {
            display: true,
            position: "top"
        }
    },

    scales: {
        y: {
            beginAtZero: true
        }
    }
}

})

})

}

function loadCategoryChart(){

fetch("/CampusStore/backend/get_category_products.php")

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
"#818cf8",  // pastel indigo
    "#4ade80",  // pastel green
    "#fcd34d",  // pastel yellow
    "#fb7185",  // pastel pink-red
    "#c4b5fd"   // pastel lavender
],
borderWidth: 0,
hoverOffset: 8
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

fetch("/CampusStore/backend/get_orders.php")

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

fetch("/CampusStore/backend/update_order_status.php",{

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

fetch(`/CampusStore/backend/get_order_details.php?id=${id}`)

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

fetch("/CampusStore/admin/backend/get_customers.php")

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



// VIeW CUST ORDERS

function viewCustomerOrders(userId){

fetch(`/CampusStore/admin/backend/get_customer_orders.php?user_id=${userId}`)

.then(res=>res.json())

.then(data=>{

let html=""

if(data.length===0){

html="<p>No orders found</p>"

}else{

data.forEach(o=>{

html+=`

<p>
<strong>Order ID:</strong> ${o.id}<br>
<strong>Total:</strong> ₹${o.total}<br>
<strong>Status:</strong> ${o.status}
</p>

<hr>

`

})

}

document.getElementById("ordersContent").innerHTML=html

new bootstrap.Modal(document.getElementById("ordersModal")).show()

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
<td>${e.admin_reply ? e.admin_reply : "-"}
<td>
<span class="badge ${e.status === 'Pending' ? 'bg-warning' : 'bg-success'}">
${e.status}
</span>
</td>

<td>

<button class="btn btn-success btn-sm reply-btn" data-id="${e.id}">
Reply
</button>

<button class="btn btn-danger btn-sm delete-btn" data-id="${e.id}">
Delete
</button>

</td>

</tr>

`

})

document.getElementById("enquiryTable").innerHTML = html

// attach events AFTER rendering

document.querySelectorAll(".reply-btn").forEach(btn=>{
btn.addEventListener("click", function(){
    let id = this.getAttribute("data-id")
    openReplyModal(id)
})
})

document.querySelectorAll(".delete-btn").forEach(btn=>{
btn.addEventListener("click", function(){
    let id = this.getAttribute("data-id")
    openDeleteModal(id)
})
})

})

}





//delete enquiry
function openDeleteModal(id){
    document.getElementById("deleteId").value = id
    new bootstrap.Modal(document.getElementById("deleteModal")).show()
}


//confirm delete

function confirmDelete(){

    console.log("DELETE CLICKED")

let id = document.getElementById("deleteId").value

fetch("/CampusStore/admin/backend/delete_enquiry.php",{
method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},
body:`id=${id}`
})
.then(res=>res.json())
.then(data=>{

if(data.status==="success"){

// close modal
bootstrap.Modal.getInstance(document.getElementById("deleteModal")).hide()

// refresh table
loadEnquiries()

// show success message (reuse same box)
let msg = document.getElementById("successMsg")
if(msg){
    msg.innerText = "Enquiry deleted successfully"
    msg.classList.remove("d-none")

    setTimeout(()=>{
        msg.classList.add("d-none")
    },2000)
}

}else{
    alert("Delete failed")
}

})

}


//Modal Open Function

function openReplyModal(id){

let replyId = document.getElementById("replyId")
let replyText = document.getElementById("replyText")

// 🔴 check if modal exists
if(!replyId || !replyText){
    console.error("Modal not loaded")
    return
}

replyId.value = id
replyText.value = ""

new bootstrap.Modal(document.getElementById("replyModal")).show()
}




// send reply

function sendReply(){

let id = document.getElementById("replyId").value
let reply = document.getElementById("replyText").value

if(!reply){
    alert("Please enter reply")
    return
}

let btn = document.querySelector("#replyModal .btn-primary")
btn.disabled = true
btn.innerText = "Sending..."

fetch("/CampusStore/admin/backend/reply_enquiry.php",{
method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},
body:`id=${id}&reply=${encodeURIComponent(reply)}`
})
.then(res=>res.json())
.then(data=>{

if(data.status==="success"){

// close modal
bootstrap.Modal.getInstance(document.getElementById("replyModal")).hide()

// refresh table
loadEnquiries()

// show success message safely
let msg = document.getElementById("successMsg")
if(msg){
    msg.classList.remove("d-none")
    setTimeout(()=>{
        msg.classList.add("d-none")
    },2000)
}

}else{
    alert("Failed to send reply")
}

btn.disabled = false
btn.innerText = "Send Reply"

})

}


// LOAD ADMIN PROFILE
function loadAdminProfile(){

fetch("/CampusStore/admin/backend/get_admin_profile.php")
.then(res=>res.json())
.then(data=>{

if(data.status === "unauthorized"){
    window.location.href = "login.html"
    return
}

document.getElementById("adminName").value = data.name
document.getElementById("adminEmail").value = data.email

})

}


//LOAD WEBSITE SETTINGS

function loadWebsiteSettings(){

let site = document.getElementById("siteName")
let email = document.getElementById("supportEmail")
let phone = document.getElementById("contactPhone")

if(!site || !email || !phone){
    console.log("Settings elements not ready")
    return
}

fetch("/CampusStore/admin/backend/get_settings.php")

.then(res=>res.json())

.then(data=>{

site.value = data.website_name
email.value = data.support_email
phone.value = data.contact_phone

})

}

// SAVE WEBSITE SETTINGS

function saveWebsiteSettings(){

let name = document.getElementById("siteName").value
let email = document.getElementById("supportEmail").value
let phone = document.getElementById("contactPhone").value

fetch("/CampusStore/admin/backend/update_settings.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:`website_name=${name}&support_email=${email}&contact_phone=${phone}`

})

.then(res=>res.json())

.then(data=>{

if(data.status==="success"){
showSuccess("Website settings updated")
}else{
alert("Failed")
}

})

}



//show success msg

function showSuccess(message){

let msg = document.getElementById("successMsg")

if(!msg) return

msg.innerText = message
msg.classList.remove("d-none")

setTimeout(()=>{
msg.classList.add("d-none")
},2000)

}



// UPDATE PROFILE

function updateProfile(){

let name = document.getElementById("adminName").value
let email = document.getElementById("adminEmail").value

fetch("/CampusStore/admin/backend/update_admin_profile.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:`name=${name}&email=${email}`

})
.then(res=>res.json())
.then(data=>{

if(data.status==="success"){
showSuccess("Profile updated successfully")
}else{
alert("Update failed")
}

})

}



//LOAD PAYMENT SETTINGS

function loadPaymentSettings(){

fetch("/CampusStore/admin/backend/get_payment_settings.php")

.then(res=>res.json())

.then(data=>{

document.getElementById("cod").value = data.cod
document.getElementById("upi").value = data.upi
document.getElementById("gateway").value = data.gateway

})

}


//SAVE PAYMENT SETTINGS

function savePaymentSettings(){

let cod = document.getElementById("cod").value
let upi = document.getElementById("upi").value
let gateway = document.getElementById("gateway").value

fetch("/CampusStore/admin/backend/update_payment_settings.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:`cod=${cod}&upi=${upi}&gateway=${gateway}`

})
.then(res=>res.json())
.then(data=>{

if(data.status==="success"){
showSuccess("Payment settings updated")
}else{
alert("Failed")
}

})

}






// CHANGE PASSWORD 

function changePassword(){

let password = document.getElementById("newPassword").value
let confirm = document.getElementById("confirmPassword").value

// validation
if(!password || !confirm){
    alert("Please fill all fields")
    return
}

if(password.length < 6){
    alert("Password must be at least 6 characters")
    return
}

if(password !== confirm){
    alert("Passwords do not match")
    return
}

// disable button (UX)
let btn = document.querySelector("button.btn-danger")
btn.disabled = true
btn.innerText = "Updating..."

fetch("/CampusStore/admin/backend/update_admin_password.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:`password=${encodeURIComponent(password)}`

})
.then(res=>res.json())
.then(data=>{

if(data.status==="success"){

showSuccess("Password updated successfully")

document.getElementById("newPassword").value = ""
document.getElementById("confirmPassword").value = ""

}else{
alert("Failed to update password")
}

btn.disabled = false
btn.innerText = "Change Password"

})

}

function handleTopSearch(e){
  if(e.key === "Enter"){
    let query = document.getElementById("topSearch").value.toLowerCase()

    if(query.includes("product")){
      loadPage("products.html")
    }
    else if(query.includes("order")){
      loadPage("orders.html")
    }
    else if(query.includes("customer")){
      loadPage("customers.html")
    }
    else if(query.includes("setting")){
      loadPage("settings.html")
    }
    else{
      alert("No results found")
    }
  }
}


function triggerSearch(){
  let query = document.getElementById("topSearch").value.toLowerCase()

  if(query.includes("product")){
    loadPage("products.html")
  }
  else if(query.includes("order")){
    loadPage("orders.html")
  }
  else if(query.includes("customer")){
    loadPage("customers.html")
  }
  else if(query.includes("setting")){
    loadPage("settings.html")
  }
  else{
    alert("No results found")
  }
}

function toggleNotifications(){
  let box = document.getElementById("notifBox")
  box.classList.toggle("d-none")
}