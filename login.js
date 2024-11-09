document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("loginForm").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.getElementById("loginUsername").value;
        loginUser(username);
    });

    document.getElementById("registerForm").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.getElementById("registerUsername").value;
        registerUser(username);
    });
 
    document.getElementById("logoutButton").addEventListener("click", logoutUser);
    document.getElementById('inputForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const type = document.getElementById('type').value;
        const source = document.getElementById('source').value;
        const amount = parseFloat(document.getElementById('amount').value);
        const date = document.getElementById('date').value;

        if (document.getElementById('expenseId').value) {
            updateExpense(document.getElementById('expenseId').value, type, source, amount, date);
        } else {
            addExpense(type, source, amount, date);
        }    
        document.getElementById('inputForm').reset();
    });
});


function loginUser(username) {
    fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ username }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "success") {
                console.log(username)
                window.location.href="index.html";
                fetchExpenses();

            } else {
                alert(data.message);
            }
        });
}

function registerUser(username) {
    fetch("register.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ username }),
    })
        .then((response) => response.json())
        .then((data) => alert(data.message));
}

function logoutUser() {
    fetch("logout.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "success") {
                document.getElementById("authSection").style.display = "block";
                document.getElementById("expenseSection").style.display = "none";
                document.getElementById("transactionTable").getElementsByTagName("tbody")[0].innerHTML = "";
            }
        });
}

function checkLoginStatus() {
    fetch("check_login.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.logged_in) {
                fetchExpenses();
            } else {
                alert('error');
            }
        });
}
