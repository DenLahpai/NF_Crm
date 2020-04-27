//function to check six fields
function checkSixFields (f1,f2,f3,f4,f5,f6) {
    var f1 = document.getElementById(f1);
    var f2 = document.getElementById(f2);
    var f3 = document.getElementById(f3);
    var f4 = document.getElementById(f4);
    var f5 = document.getElementById(f5);
    var f6 = document.getElementById(f6);

    if (f1.value == null || f1.value == 0 || f1.value == " ") {
        f1.style.background = '#A52B2A';
        f1.style.color = 'white';
        var x = 0;
    }

    if (f2.value == null || f2.value == 0 || f2.value == " ") {
        f2.style.background = '#A52B2A';
        f2.style.color = 'white';
        var x = 0;
    }

    if (f3.value == null || f3.value == 0 || f3.value == " ") {
        f3.style.background = '#A52B2A';
        f3.style.color = 'white';
        var x = 0;
    }

    if (f4.value == null || f4.value == 0 || f4.value == " ") {
        f4.style.background = '#A52B2A';
        f4.style.color = 'white';
        var x = 0;
    }

    if (f5.value == null || f5.value == 0 || f5.value == " ") {
        f5.style.background = '#A52B2A';
        f5.style.color = 'white';
        var x = 0;
    }

    if (f6.value == null || f6.value == 0 || f6.value == " ") {
        f6.style.background = '#A52B2A';
        f6.style.color = 'white';
        var x = 0;
    }

    if (x == 0) {
        document.getElementsByClassName('error')[0].innerHTML = 'Please check the field(s) in red!';
    }
    else {
        document.getElementById('buttonSubmit').type = 'submit';
    }
}

//function to compare if 2 passwords are same
function twoPasswords (password, repassword) {
	var password = document.getElementById(password);
	var repassword = document.getElementById(repassword);

	if (password.value != repassword.value) {
		password.background = 'red';
		repassword.background = 'red';
		document.getElementsByClassName('error')[0].innerHTML = "Two passwords don't match!";
		window.die();
	}
}

//function to select and option
function selectOption (value, select) {
	var value = document.getElementById(value).innerHTML;
	var select = document.getElementById(select);
	for (var i = 0; i <= select.options.length; i++) {
		if (select.options[i].value == value) {
			select.options[i].selected = 'selected';
		}
	}
}

//function to load from table Clients
function loadClients (file, destinationId) {
    var limit = 30;
    var job = 'select_all';
    var sorting = 'ORDER BY Id ASC';
    var Search = $("#Search").val();

    $(destinationId).load(file, {
        limit: limit,
        job: job,
        sorting: sorting,
        Search: Search
    });
    $("#Search").val("");
}

//fucntion to update table Clients
function updateTableClients () {
    var limit = $("#limit").val();
    var Search = $("#Search").val();

    if (Search == "") {
        var job = 'select_all';
    }
    else {
        var job = 'search';
    }

    var sorting = $("#sorting").val();

    $("#clients-table").load("table_clientsphp.php", {
        limit: limit,
        job: job,
        sorting: sorting,
        Search: Search
    });

}

//sorting functions //
function sortTableClients(column, order) {
    var limit = $("#limit").val();
    var Search = $("#Search").val();
    if (Search == "") {
        var job = 'select_all';
    }
    else {
        var job = 'search';
    }

    var sorting = 'ORDER BY '+ column + ' '+ order;


    $("#clients-table").load("table_clientsphp.php?sorting=$sorting", {
        limit: limit,
        job: job,
        sorting: sorting,
        Search: Search
    });
}
// function to clear search and call another function
function clearSearch(page) {
    document.getElementById('Search').value = "";
    alert(page);
}

//function to load Passport Expiry
function loadPassportExpiry () {
    if ($("#sorting").val() == "") {
        var sorting = "ORDER BY Expiry ASC ";
    }
    else {
        var sorting = $("#sorting").val();
    }
    var Search = $("#Search").val();
    if (Search == "") {
        var job = 'passport_expiry';
    }
    else {
        var job = 'search_passport_expiry';;
    }
    $("#passport-expiry-table").load("table_passportexpiryphp.php", {
        job: job,
        sorting: sorting,
        Search: Search
    });
}


//function to show all reminder
function openAllReminders () {
    var allDivs = document.getElementsByClassName('reminder-form');
    var i = 0;
    var btnToggle = document.getElementById('btnToggle');

    while (i < allDivs.length) {
        $(allDivs[i]).slideToggle(500);
        i++;
    }
}

// function to open one reminder
function openReminder(ClientsId) {
    var divOpen = '#reminder'+ClientsId;
    $(divOpen).slideToggle(500);
}


//function to sort table Passport Expiry
function sortTablePassportExpiry (column, order) {

    var Search = $("#Search").val();
    if (Search == "") {
        var job = 'passport_expiry';
    }
    else {
        var job = 'search_passport_expiry';
    }

    var sorting = 'ORDER BY '+ column + ' '+ order;

    $("#passport-expiry-table").load("table_passportexpiryphp.php", {
        job: job,
        sorting: sorting,
        Search: Search
    });
}

//function to insert passport expiry reminder
function insertReminder(Id) {
    var job = 'insert';
    var ClientsId = document.getElementById('ClientsId'+Id).value;
    var Method = document.getElementById('Method'+Id).value;

    $("#passport-expiry-table").load("table_passportexpiryphp.php", {
        job: job,
        ClientsId: ClientsId,
        Method: Method
    });
}

//function to export data to a cvs file
function exportData (file) {
    var limit = $("#limit").val();
    var Search = $("#Search").val();
    var sorting = $("#sorting").val();

    if (file == 'export_table_passport_expiry.php') {
        if (Search == "") {
            var job = 'passport_expiry'
        }
        else {
            var job = 'search_passport_expiry';
        }
    }
    else if (file == 'export_table_clients.php') {
        if (Search == "") {
            var job = 'select_all';
        }
        else {
            var job = 'search';
        }
    }

    window.location.href = file+'?job='+job+'&limit='+limit+'&Search='+Search+'&sorting='+sorting;
}
