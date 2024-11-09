
function addExpense(type, source, amount, date) {
    const data = new FormData();
    data.append("type", type);
    data.append("source", source);
    data.append("amount", amount);
    data.append("date", date);

    fetch('insert_expense.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            fetchExpenses();  
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function fetchExpenses() {
    fetch('fetch_expenses.php')
        .then(response => response.json())
        .then(data => buildTable(data))
        .catch(error => console.error('Error:', error));
}

function buildTable(transactions) {
    const tableBody = document.getElementById('expenseTableBody');
    tableBody.innerHTML = '';  

    transactions.forEach(transaction => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${transaction.id}</td>
            <td>${transaction.type}</td>
            <td>${transaction.source}</td>
            <td>${transaction.amount}</td>
            <td>${transaction.date}</td>
            <td>
                <button onclick="editExpense(${transaction.id}, '${transaction.type}', '${transaction.source}', ${transaction.amount}, '${transaction.date}')">✎</button>
                <button onclick="deleteExpense(${transaction.id})">🗑️</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function editExpense(id, type, source, amount, date) {
    document.getElementById('expenseId').value = id;
    document.getElementById('type').value = type;
    document.getElementById('source').value = source;
    document.getElementById('amount').value = amount;
    document.getElementById('date').value = date;
}

function updateExpense(id, type, source, amount, date) {
    const data = new FormData();
    data.append("id", id);
    data.append("type", type);
    data.append("source", source);
    data.append("amount", amount);
    data.append("date", date);

    fetch('update_expense.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            fetchExpenses();
        } else {
            alert("Error");
        }
    })
    .catch(error => console.error('Error:', error));
}

function deleteExpense(id) {
    const data = new FormData();
    data.append("id", id);

    fetch('delete_expense.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            fetchExpenses();
        } else {
            alert("Error");
        }
    })
    .catch(error => console.error('Error:', error));
}
let logout_btn=document.getElementById('logoutButton');
logout_btn.addEventListener('click',()=>{
    window.location.href="login.html";
})

window.onload = fetchExpenses;
