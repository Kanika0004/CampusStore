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
<td><img src="/CampusStore/public/${p.image}" width="50"></td>
<td>${p.name}</td>
<td>${p.category}</td>
<td>₹${p.price}</td>
<td>
<button class="btn btn-warning btn-sm" onclick="editProduct(${p.id})">Edit</button>
<button class="btn btn-danger btn-sm" onclick="deleteProduct(${p.id})">Delete</button>
</td>
</tr>`
})

document.getElementById("productTable").innerHTML=html
})
}

/* DELETE PRODUCT */
function deleteProduct(id){
if(!confirm("Delete this product?")) return

fetch("backend/delete_product.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:"id="+id
})
.then(res=>res.json())
.then(data=>{
if(data.status==="success") loadProducts()
})
}

/* EDIT PRODUCT */
function editProduct(id){
let name=prompt("Enter new name")
let price=prompt("Enter new price")

fetch("backend/edit_product.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`id=${id}&name=${name}&price=${price}`
})
.then(res=>res.json())
.then(data=>{
if(data.status==="success") loadProducts()
})
}

/* ADD PRODUCT */
function addProduct(){
let name=document.getElementById("name").value
let price=document.getElementById("price").value
let image=document.getElementById("image").value
let category=document.getElementById("category").value
let subcategory=document.getElementById("subcategory").value

fetch("backend/add_product.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
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

/* LOAD ADMIN PROFILE */
function loadAdminProfile(){
fetch("backend/get_admin_profile.php")
.then(res=>res.json())
.then(data=>{
let name = document.getElementById("adminName")
let email = document.getElementById("adminEmail")
if(!name || !email) return
name.value = data.name || ""
email.value = data.email || ""
})
}

/* UPDATE PROFILE */
function updateProfile(){
let name = document.getElementById("adminName").value
let email = document.getElementById("adminEmail").value

fetch("backend/update_admin_profile.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}`
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

/* LOAD WEBSITE SETTINGS */
function loadWebsiteSettings(){
let site = document.getElementById("siteName")
let email = document.getElementById("supportEmail")
let phone = document.getElementById("contactPhone")

if(!site || !email || !phone) return

fetch("backend/get_settings.php")
.then(res=>res.json())
.then(data=>{
site.value = data.website_name || ""
email.value = data.support_email || ""
phone.value = data.contact_phone || ""
})
}

/* SAVE WEBSITE SETTINGS */
function saveWebsiteSettings(){
let name = document.getElementById("siteName").value
let email = document.getElementById("supportEmail").value
let phone = document.getElementById("contactPhone").value

fetch("backend/update_settings.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`website_name=${encodeURIComponent(name)}&support_email=${encodeURIComponent(email)}&contact_phone=${encodeURIComponent(phone)}`
})
.then(res=>res.json())
.then(data=>{
if(data.status==="success"){
showSuccess("Website settings updated")
}else{
alert("Failed")
}
})
.catch(()=>alert("Error saving settings"))
}

/* LOAD PAYMENT SETTINGS */
function loadPaymentSettings(){
fetch("backend/get_payment_settings.php")
.then(res=>res.json())
.then(data=>{
let cod = document.getElementById("cod")
let upi = document.getElementById("upi")
let gateway = document.getElementById("gateway")

if(!cod || !upi || !gateway) return

cod.value = data.cod || ""
upi.value = data.upi || ""
gateway.value = data.gateway || ""
})
}

/* SAVE PAYMENT SETTINGS */
function savePaymentSettings(){
let cod = document.getElementById("cod").value
let upi = document.getElementById("upi").value
let gateway = document.getElementById("gateway").value

fetch("backend/update_payment_settings.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`cod=${encodeURIComponent(cod)}&upi=${encodeURIComponent(upi)}&gateway=${encodeURIComponent(gateway)}`
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

/* CHANGE PASSWORD */
function changePassword(){

let password = document.getElementById("newPassword").value
let confirm = document.getElementById("confirmPassword").value

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

let btn = document.querySelector("button.btn-danger")
btn.disabled = true
btn.innerText = "Updating..."

fetch("backend/update_admin_password.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`password=${encodeURIComponent(password)}`
})
.then(res=>{
if(!res.ok) throw new Error("Request failed")
return res.json()
})
.then(data=>{
if(data.status==="success"){
showSuccess("Password updated successfully")
document.getElementById("newPassword").value = ""
document.getElementById("confirmPassword").value = ""
}else{
alert("Failed to update password")
}
})
.catch(()=>{
alert("Something went wrong")
})
.finally(()=>{
btn.disabled = false
btn.innerText = "Change Password"
})
}

/* SUCCESS MESSAGE */
function showSuccess(message){
let msg = document.getElementById("successMsg")
if(!msg) return

msg.innerText = message
msg.classList.remove("d-none")

setTimeout(()=>{
msg.classList.add("d-none")
},2000)
}