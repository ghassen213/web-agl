let productID = 0
let newdeleted = 0
let edited = 0
let newadded = 0


let task_name = document.getElementById('task_name')
let dashboard = document.getElementById('dashboard')
let addproduct = document.getElementById('addproduct')
let deletedrender = document.getElementById('deletedrender')
let updateproduct = document.getElementById('updateproduct')
let userdetails = document.getElementById('userdetails')

let dashbutton = document.getElementById('dashbutton')
let addbutton = document.getElementById('addbutton')
let editbutton = document.getElementById('editbutton')
let deletebutton = document.getElementById('deletebutton')
let userbutton = document.getElementById('userbutton')
let logout = document.getElementById('logout')


dashbutton.addEventListener('click', () => {
    showdashboardpage()
    showdetails()
})

addbutton.addEventListener('click', () => {
    showaddpage()
})
deletebutton.addEventListener('click', () => {
    deletepageproduct()
})
editbutton.addEventListener('click', () => {
    editbuttonpage()
})

showdashboardpage()

logout.addEventListener('click', () => {
    window.location.href = "signIn.html";
});


// to show dashbooard
function showdashboardpage() {
    dashbutton.style.backgroundColor = 'rgb(254, 203, 203)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    deletebutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    dashboard.style.display = 'block'
    addproduct.style.display = 'none'
    deletedrender.style.display = 'none'
    updateproduct.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Dashboard'
}

// to show addpage
function showaddpage() {
    addbutton.style.backgroundColor = 'rgb(254, 203, 203)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    deletebutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    addproduct.style.display = 'grid'
    dashboard.style.display = 'none'
    deletedrender.style.display = 'none'
    updateproduct.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Add Product'
    fetchAddData()
}



// edit data
function editbuttonpage() {
    editbutton.style.backgroundColor = 'rgb(254, 203, 203)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    deletebutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    updateproduct.style.display = 'grid'
    deletedrender.style.display = 'none'
    addproduct.style.display = 'none'
    dashboard.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Edit Product'
    fetchEditData()
}





// delete product
async function deletepageproduct() {
    deletebutton.style.backgroundColor = 'rgb(254, 203, 203)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    deletedrender.style.display = 'grid'
    addproduct.style.display = 'none'
    dashboard.style.display = 'none'
    updateproduct.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Delete Product'


}


function showdetails() {
    let newtotal = document.querySelector('#newtotal')
    newtotal.innerText = 40 - newdeleted + newadded
    let newadd = document.querySelector('#newadd')
    newadd.innerText = newadded
    let newedit = document.querySelector('#newedit')
    newedit.innerText = edited
    let newdelete = document.querySelector('#newdelete')
    newdelete.innerText = newdeleted
}



userbutton.addEventListener('click', () => {
    userbuttonpage()
})

function userbuttonpage(params) {
    userbutton.style.backgroundColor = 'rgb(254, 203, 203)'
    deletebutton.style.backgroundColor = 'rgb(252, 242, 242)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    userdetails.style.display = 'block'
    deletedrender.style.display = 'none'
    addproduct.style.display = 'none'
    dashboard.style.display = 'none'
    updateproduct.style.display = 'none'
    task_name.innerText = 'User Details'


    showUsersDetails()
}

function showUsersDetails() {
    let tbody = document.querySelector('tbody')
    let userData = JSON.parse(localStorage.getItem("userDatabase")) || [];
    tbody.innerHTML=''
    userData.forEach((element) => {
        let tempdata=element.name.split(' ')
        let [username,lastname]=tempdata
        let tr = document.createElement('tr')
        let name = document.createElement('td')
        name.innerText=username
        let last = document.createElement('td')
        last.innerText=lastname
        let email = document.createElement('td')
        email.innerText=element.email
        let del = document.createElement('td')
        del.innerText = 'Delete'
        del.addEventListener('click', () => {
            let check = confirm("Confirm to delete User")
            // console.log(check)
            if (check) {
                let newdata = userData.filter((ele) => {
                    if (ele.email == element.email && ele.password==element.password) {
                        return false
                    }
                    return true
                })
                // console.log(newdata)
                userData=newdata
                localStorage.setItem("userDatabase",JSON.stringify(userData))
                showUsersDetails()
            }
        })
        tr.append(name, last, email, del)
        tbody.append(tr)
    });
}
