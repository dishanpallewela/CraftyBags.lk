function changeView() {

    var signInBox = document.getElementById("signInBox");
    var signUpBox = document.getElementById("signUpBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");

}

function signUp() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {

                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                gender.value = "";
                document.getElementById("msg").innerHTML = "";

                changeView();
            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    }
    r.open("POST", "signUpProcess.php", true);
    r.send(f);

}

function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var remember = document.getElementById("remember");
    // alert(remember.value);
    // alert(remember.checked);

    var formData = new FormData();
    formData.append("email", email.value);
    formData.append("password", password.value);
    formData.append("remember", remember.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }

        }
    };

    r.open("POST", "signInProcess.php", true);
    r.send(formData);

}

var bm;

function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {

                alert("Verification email sent. Please check your inbox.");

                var m = document.getElementById("forgetPasswordModel");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(text);
            }

        }
    };

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function showPassword1() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.innerHTML == "Show") {
        np.type = "text";
        npb.innerHTML = "Hide";
    } else {
        np.type = "password";
        npb.innerHTML = "Show";
    }

}

function showPassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnpb.innerHTML == "Show") {
        rnp.type = "text";
        rnpb.innerHTML = "Hide";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "Show";
    }

}

function resetPassword() {

    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var formData = new FormData();
    formData.append("e", e.value);
    formData.append("np", np.value);
    formData.append("rnp", rnp.value);
    formData.append("vc", vc.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (r.readyState == 4) {
                if (text == "Success") {
                    alert("Password reset success");
                    bm.hide();
                } else {
                    alert(text);
                }
            }
        }
    };
    r.open("POST", "resetPassword.php", true);
    r.send(formData);

}

function goToAddProduct() {
    window.location = "addproduct.php";
}

function changeImg() {

    var image = document.getElementById("imguploader"); //file chooser
    var view = document.getElementById("prev"); //image tag

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }

}

function addProduct() {

    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    // var model = document.getElementById("mo");
    var title = document.getElementById("ti");

    var colour;

    if (document.getElementById("clr1").checked) {
        colour = 1;
    } else if (document.getElementById("clr2").checked) {
        colour = 2;
    } else if (document.getElementById("clr3").checked) {
        colour = 3;
    } else if (document.getElementById("clr4").checked) {
        colour = 4;
    } else if (document.getElementById("clr5").checked) {
        colour = 5;
    } else if (document.getElementById("clr6").checked) {
        colour = 6;
    }

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delevery_within_colombo = document.getElementById("dwc");
    var delevery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploader");

    var form = new FormData();
    form.append("c", category.value);
    form.append("b", brand.value);
    // form.append("m", model.value);
    form.append("t", title.value);
    // form.append("co", condition);
    form.append("col", colour);
    form.append("qty", qty.value);
    form.append("p", price.value);
    form.append("dwc", delevery_within_colombo.value);
    form.append("doc", delevery_outof_colombo.value);
    form.append("desc", description.value);
    form.append("i1", image.files[0]);
    form.append("i2", image.files[1]);
    form.append("i3", image.files[2]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    };

    r.open("POST", "addProductProcess.php", true);
    r.send(form);

}

function goToSignOut() {
    window.location = "signOut.php";
}

function goToHome() {
    window.location = "home.php";
}

function goToIndex() {
    window.location = "index.php";
}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;

            if (t == "Success") {
                window.location = "home.php";
            }

        }
    };

    r.open("GET", "signOut.php", true);
    r.send();

}

function changeProductView() {

    var add = document.getElementById("addProductBox");
    var update = document.getElementById("updateProductBox");

    add.classList.toggle("d-none");
    update.classList.toggle("d-none");

}

function updateProfile() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var img = document.getElementById("profileimg");

    var form = new FormData();

    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("l1", line1.value);
    form.append("l2", line2.value);
    form.append("c", city.value);
    form.append("i", img.files[0]);

    // alert("ok");
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {
                alert("User Profile Update Successfully");
                window.location = "userProfile.php";
            } else {
                alert(text);

            }

        }

    };

    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

}

// change status

function changeStatus(id) {

    var productid = id;
    var statuscheck = document.getElementById("check");
    var statuslabel = document.getElementById("checklabel" + productid);

    // var status;

    // if (statuscheck.checked) {
    //     status = 1;
    // } else {
    //     status = 0;
    // }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactive") {
                statuslabel.innerHTML = "Make Your Product Active";
            } else if (t == "active") {
                statuslabel.innerHTML = "Make Your Product Deactive";
            }
        }
    };

    r.open("GET", "statusChangeProcess.php?p=" + productid, true);
    r.send();

}

var k;

function deleteModel(id) {

    var dm = document.getElementById("deleteModel" + id);
    k = new bootstrap.Modal(dm);
    k.show();

}

// delete product

function deleteProduct(id) {

    var productid = id;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "Success") {
                alert("Product Deleted Successfully");
                k.hide();
                window.location = "sellerProductView.php";
            }
        }
    };

    request.open("GET", "deleteproductprocess.php?id=" + productid, true);
    request.send();

}

// filters

function addFilters() {
    // alert("ok");

    var search = document.getElementById("s");

    var age;
    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }

    var qty;
    if (document.getElementById("l").checked) {
        qty = 1;
    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("a", age);
    f.append("q", qty);
    f.append("c", condition);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            var arr = JSON.parse(t);
            for (let i = 0; i < arr.length; i++) {

                var row = arr[i];
                alert(row["title"]);
                alert(arr["img"]);

            }

        }
    };

    r.open("POST", "filterProcess.php", true);
    r.send(f);

}

// search to update

function searchtoupdate() {

    var id = document.getElementById("searchToUpdate").value;
    var title = document.getElementById("ti");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            var object = JSON.parse(text);
            // alert(object["title"]);

            title.value = object["title"];

        }

    };

    r.open("GET", "searchToUpdateProcess.php?id=" + id, true);
    r.send();

}


// update product

function sendid(id) {

    var id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location = "updateProduct.php";
            } else {

            }

        }
    };

    r.open("GET", "sendProductProcess.php?id=" + id, true);
    r.send();

}

///////////////////////////////load main img/////////////////////

function loadmainimg(id) {

    alert(id);
    var pid = id;

    var img = document.getElementById("pimg" + pid).src;
    var mainimg = document.getElementById("mainimg");

    mainimg.style.backgroundImage = "url(" + img + ")";

    // alert(img);
}

// qty update

function qty_inc(qty) {

    var qty = qty;

    var input = document.getElementById("qtyinput");

    if (input.value < qty) {
        var newvalue = parseInt(input.value) + 1;

        input.value = newvalue.toString();
    } else {
        alert("Maximum quantity count has been achived");
    }



}

function qty_dec(qty) {

    var qty = qty;

    var input = document.getElementById("qtyinput");

    if (input.value > 1) {
        var newvalue = parseInt(input.value) - 1;

        input.value = newvalue.toString();
    } else {
        alert("Minimum quantity count has been achived");
    }

}

// Basic search
function basicSearch(x) {
    var page = x;
    var searchText = document.getElementById("basic_search_text").value;
    var searchSelect = document.getElementById("basic_search_category").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "empty") {
                window.location = "home.php";
            } else {
                document.getElementById("product_view_div").innerHTML = t;
            }
        }
    }

    r.open("GET", "basicSearchProccess.php?t=" + searchText + "&s=" + searchSelect + "&p=" + page, true);
    r.send();
}

// addToWatchlist

function addToWatchlist(id) {

    var pid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "watchlist.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "addToWatchlistProcess.php?id=" + pid, true);
    r.send();

}

// deletefromwarchlist

function deletefromwarchlist(id) {

    var wid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                window.location = "watchlist.php";
            }
        }
    };

    r.open("GET", "removeWatchlistItemProcess.php?id=" + wid, true);
    r.send();

}

function goToCart() {
    window.location = "cart.php";
}

// updateProduct

function updateProduct(id) {

    var pid = id;

    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("desc");

    var form = new FormData();
    form.append("id", pid);
    form.append("title", title.value);
    form.append("qty", qty.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("description", description.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Product Updated Successfully");
            } else {
                alert(text);
            }
        }
    };

    r.open("POST", "updateProductProcess.php", true);
    r.send(form);

}

// addToCart

function addToCart(id) {

    var pid = id;

    var qtytxt = document.getElementById("qtytxt" + pid).value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "cart.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "addToCartProcess.php?id=" + pid + "&txt=" + qtytxt, true);
    r.send();

}

//add to cart from single view page

function addToCart2(id) {

    var pid = id;

    var qtytxt = document.getElementById("qtyinput").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "cart.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "addToCartProcess.php?id=" + pid + "&txt=" + qtytxt, true);
    r.send();

}

// deletefromCart

function deletefromCart(id) {

    var cid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "cart.php";
            }
        }
    };

    r.open("GET", "deleteFromCartProcess.php?id=" + cid, true);
    r.send();

}

// paynow
function paynow(id) {

    var qty = document.getElementById("qtyinput").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["email"];
            var amount = obj["amount"];


            if (t == "1") {

                alert("Please Sign In first");
                window.location = "index.php";

            } else if (t == "2") {

                alert("Please Update your Profile First");
                window.location = "userProfile.php";

            } else {

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);

                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218123", // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/singleproductview.php?id=" + id, // Important
                    "cancel_url": "http://localhost/eshop/singleproductview.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById('payhere-payment').onclick = function(e) {
                    payhere.startPayment(payment);
                };

            }

        }
    };

    r.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

//buy from cart single product

function paynow1(id) {

    var qty = document.getElementById("qtyinput").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["email"];
            var amount = obj["amount"];


            if (t == "1") {

                alert("Please Sign In first");
                window.location = "index.php";

            } else if (t == "2") {

                alert("Please Update your Profile First");
                window.location = "userProfile.php";

            } else {

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);

                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218123", // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/cart.php?id=" + id, // Important
                    "cancel_url": "http://localhost/eshop/cart.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById('payhere-payment' + id).onclick = function(e) {
                    payhere.startPayment(payment);
                };

            }

        }
    };

    r.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

//cart checkout
// function checkout(email) {
//     alert("ccc");

//     var r = new XMLHttpRequest();

//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             var t = r.responseText;
//             // alert(t);
//             var obj = JSON.parse(t);





//         }
//     };

//     r.open("GET", "cartqty.php?email=" + email, true);
//     r.send();


// }


// saveInvoice

function saveInvoice(orderId, id, mail, amount, qty) {

    var orderid = orderId;
    var pid = id;
    var email = mail;
    var total = amount;
    var pqty = qty;

    var f = new FormData();
    f.append("oid", orderid);
    f.append("pid", pid);
    f.append("email", email);
    f.append("total", total);
    f.append("pqty", pqty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderid;

            }
        }
    }

    r.open("POST", "saveinvoice.php", true);
    r.send(f);

}

// print

function printDiv() {

    var restorepage = document.body.innerHTML;
    var page = document.getElementById("GFG").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

// feedback
var k;

function addFeedback(id) {

    var feedmodel = document.getElementById("feddBackModal" + id);

    k = new bootstrap.Modal(feedmodel);
    k.show();

}

// saveFeedBack

function saveFeedBack(id) {

    var pid = id;
    var feedtxt = document.getElementById("feedtxt").value;

    var f = new FormData();

    f.append("i", pid);
    f.append("ft", feedtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                alert("Thanks for the feedback");
            }
        }
    };

    r.open("POST", "saveFeedBackProcess.php", true);
    r.send(f);

}

// adminVerification

function adminVerification() {

    var e = document.getElementById("e").value;

    var f = new FormData();

    f.append("e", e);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {


                var verificationModal = document.getElementById("verificationmodal");

                k = new bootstrap.Modal(verificationModal);
                k.show();

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificarionProcess.php", true);
    r.send(f);

}

function verify() {

    var varificationcode = document.getElementById("v").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                k.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "verifyProcess.php?v=" + varificationcode, true);
    r.send();

}

// blockuser

function blockuser(email) {

    var mail = email;

    var blockbtn = document.getElementById("blockbtn" + mail);

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t = "2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            }
        }
    }

    r.open("POST", "userBlockProcess.php", true);
    r.send(f);

}

// searchUser

function searchUser() {

    var text = document.getElementById("searchtxt").value;
    var userView = document.getElementById("userView");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            userView.innerHTML = t;
        }
    }

    r.open("GET", "searchUser.php?s=" + text, true);
    r.send();
}

// searchProduct

function searchProduct() {

    var text = document.getElementById("searchtxt").value;
    var viewProduct = document.getElementById("viewProduct");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            viewProduct.innerHTML = t;
        }
    }

    r.open("GET", "searchProduct.php?s=" + text, true);
    r.send();
}

// blockProduct

function blockProduct(id) {

    var pid = id;

    var blockbtn = document.getElementById("blockbtn" + id);

    var f = new FormData();
    f.append("pid", pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t = "2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            }
        }
    }

    r.open("POST", "productBlockProcess.php", true);
    r.send(f);

}

// advancedSearch

function advancedSearch(x) {
    // alert(x);
    // var x = 1;
    var s = document.getElementById("s1").value;
    var ca = document.getElementById("ca1").value;
    var br = document.getElementById("br1").value;
    // var mo = document.getElementById("mo1").value;
    // var co = document.getElementById("co1").value;
    var col = document.getElementById("col1").value;
    var prif = document.getElementById("prif1").value;
    var prit = document.getElementById("prit2").value;
    var sort = document.getElementById("sort").value;

    // alert(s);
    // alert(ca);
    // alert(br);
    // alert(mo);
    // alert(co);
    // alert(col);
    // alert(prif);
    // alert(prit);

    var form = new FormData();
    form.append("page", x);
    form.append("s", s);
    form.append("c", ca);
    form.append("b", br);
    // form.append("m", mo);
    // form.append("co", co);
    form.append("col", col);
    form.append("prif", prif);
    form.append("prit", prit);
    form.append("sort", sort);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // 
            document.getElementById("filter").innerHTML = text;
        }
    };
    r.open("POST", "advancedSearchpro.php", true);
    r.send(form);

}

// function advancedSearch() {

//     var viewResults = document.getElementById("viewResults");

//     var keyword = document.getElementById("k").value;
//     var category = document.getElementById("c").value;
//     var brand = document.getElementById("b").value;
//     var model = document.getElementById("m").value;
//     var condition = document.getElementById("con").value;
//     var colour = document.getElementById("clr").value;
//     var pricefrom = document.getElementById("pf").value;
//     var priceto = document.getElementById("pt").value;

//     var f = new FormData();
//     f.append("k", keyword);
//     f.append("c", category);
//     f.append("b", brand);
//     f.append("m", model);
//     f.append("con", condition);
//     f.append("clr", colour);
//     f.append("pf", pricefrom);
//     f.append("pt", priceto);

//     var r = new XMLHttpRequest();

//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             var t = r.responseText;

//             viewResults.innerHTML = t;

//         }
//     }

//     r.open("POST", "advancedSearchProcess.php", true);
//     r.send(f);

// }

// dailySellings

function dailySellings() {

    var from = document.getElementById("fromdate").value;
    var to = document.getElementById("todate").value;
    var link = document.getElementById("historylink");

    link.href = "sellinghistory.php?f=" + from + "&t=" + to;


}

// sendmessage

function sendmessage(mail) {
    // alert("111");
    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                alert("Message Sent Successfully");

            } else {
                alert("t");
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);

}

// refresher

function refresher(email) {

    setInterval(refreshmsgare(email), 500);
    setInterval(refreshrecentarea, 500);
}

// refres msg view area

function refreshmsgare(mail) {

    var chatrow = document.getElementById("chatrow");

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            chatrow.innerHTML = t;

        }
    }

    r.open("POST", "refreshmsgareaprocess.php", true);
    r.send(f);

}

// refreshrecentarea

function refreshrecentarea() {

    var rcv = document.getElementById("rcv");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
        }
    }

    r.open("POST", "refreshrecentareaprocess.php", true);
    r.send();

}

// viewmsgmodal

function viewmsgmodal() {

    var pop = document.getElementById("msgmodal");

    k = new bootstrap.Modal(pop);
    k.show();

}

// addnewmodal

function addnewmodal() {

    var pop = document.getElementById("addnewmodal");

    k = new bootstrap.Modal(pop);
    k.show();

}

// saveCategory

function saveCategory() {

    var ctxt = document.getElementById("categorytxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                alert("Category added successfully");
                window.location = "manageproducts.php";
            } else {
                alert(t);
            }
        }

    }


    r.open("GET", "saveCategoryProcess.php?c=" + ctxt, true);
    r.send();

}

// singleviewmodal

function singleviewmodal(id) {

    var pop = document.getElementById("singleproductview" + id);

    k = new bootstrap.Modal(pop);
    k.show();

}

//user details model

function details(id) {
    var dm = document.getElementById("detailModel" + id);
    k = new bootstrap.Modal(dm);
    k.show();
}

//confirm order

function confirmoder1(id) {
    var feedmodel = document.getElementById("confirmoder" + id);
    k = new bootstrap.Modal(feedmodel);
    k.show();
}

//confirmoder process

function confirmOder(invoiceid) {
    // alert(invoiceid);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Thankyou. Time to give a feedback");
                window.location = "purchaseHistory.php";
            } else {
                alert("already Recieved");
            }
        }
    }
    r.open("GET", "completeOrderProcess.php?id=" + invoiceid, true);
    r.send();
}

//accepting

function acceptOder(email, id, code) {
    var btn = document.getElementById("acbtn" + email)

    // alert(email);
    // alert(id);
    // alert(code);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert(t);
                btn.className = "btn btn-success"
                btn.innerHTML = "Accepted"
                if (btn.innerHTML = "Accepted") {
                    btn.disabled;
                }
            }
        }
    }
    r.open("GET", "acceptemail.php?email=" + email + "&id=" + id + "&code=" + code, true);
    r.send();
}

// checkout

function checkout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            var obj = JSON.parse(text);

            var mail = obj["email"];

            if (text == "1") {
                alert("Please Sign In First");
                window.location = "index.php";
            } else if (text == "2") {
                alert("Please Update your Profile First");
                window.location = "userprofile.php";
            } else {
                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    savefullInvoice(orderId);
                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    sandbox: true,
                    merchant_id: "1218123", // Replace your Merchant ID
                    return_url: "http://localhost/eshop/cart.php", // Important
                    cancel_url: "http://localhost/eshop/cart.php", // Important
                    notify_url: "http://sample.com/notify",
                    order_id: obj["id"],
                    items: obj["item"],
                    amount: obj["amount"] + ".00",
                    currency: "LKR",
                    first_name: obj["fname"],
                    last_name: obj["lname"],
                    email: mail,
                    phone: obj["mobile"],
                    address: obj["address"],
                    city: obj["city"],
                    country: "Sri Lanka",
                    delivery_address: obj["address"],
                    delivery_city: obj["city"],
                    delivery_country: "Sri Lanka",
                    custom_1: "",
                    custom_2: "",
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById("payhere-payment").onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }
        }
    };
    r.open("GET", "checkout.php", true);
    r.send();
}

function savefullInvoice(orderId) {
    var orderid = orderId;

    var f = new FormData();
    f.append("oid", orderid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "1") {
                window.location = "invoice.php?id=" + orderid;
            }
        }
    };

    r.open("POST", "checkoutinvoiceprocess.php", true);
    r.send(f);
}

// <!-- category slde -->

$(document).ready(function() {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function() {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function() {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function() {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            } else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            } else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            } else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function() {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        } else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});

// <!-- category slde -->

function allcategory(id) {

    window.location = "allcategories.php?id=" + id;

}