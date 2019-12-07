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