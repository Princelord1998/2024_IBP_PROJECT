// pop up message display
function displayMessage(message) {
    alert(message);
}

function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    if (sidebar.classList.contains("hide-sidebar")) {
        sidebar.classList.remove("hide-sidebar");
    } else {
        sidebar.classList.add("hide-sidebar");
    }
}

function confirmDelete() {
    // Display a confirmation dialog
    if (confirm("Are you sure you want to delete?")) {
        // If user confirms, proceed with deletion
    } else {
        // If user cancels, do nothing
        return;
    }
}

function search_books(){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myBooks");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}