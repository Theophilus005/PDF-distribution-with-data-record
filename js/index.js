document.addEventListener('click', (e) => {
    var downloadMenu = document.getElementsByClassName("download-menu")[0];

    //alert(e.target.className);
    if (e.target.className == "download-menu") {
        downloadMenu.style.display = "none";
    }
})

function showMenu() {
    var downloadMenu = document.getElementsByClassName("download-menu")[0];
    downloadMenu.style.display = "flex";
}

function validatePin() {
    var pin = document.getElementById("pin").value;

    if (pin == "") {
        toastr.error("Pin field is empty");
    } else {
        var loadingScreen = document.getElementById("loading");
        loadingScreen.style.display = "flex";
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                loadingScreen.style.display = "none";
                if (response == "success") {
                    toastr.success("success");
                    window.location = "admin.php";
                } else {
                    toastr.error("Invalid pin");
                }
            }
        }
        xhr.open("GET", "../php/backend.php?pin=" + pin);
        xhr.send();
    }
}

function submitForm() {
    var name = document.getElementsByClassName("username-field")[0].value;
    var email = document.getElementsByClassName("email-field")[0].value;
    var download_link = document.getElementById("get_file");

    if (name == "" || email == "") {
        toastr.info("Please fill all fields");
    } else {
        var loadingScreen = document.getElementById("loading");
        loadingScreen.style.display = "flex";
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                loadingScreen.style.display = "none";
                var response = xhr.responseText;
                if (response == "success") {
                    document.getElementsByClassName("menu-content")[0].innerHTML = "<p class='thanks'>Thanks for downloading...</p>";
                    toastr.success("Download started...");
                    download_link.click();
                } else {
                    toastr.error("An error occured");
                }
            }
        }

        xhr.open("GET", "php/backend.php?name=" + name + "&email=" + email);
        xhr.send();
    }
}