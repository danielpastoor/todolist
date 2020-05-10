
const search = () => {
    let filter = document.getElementById('myInput').value.toUpperCase();

    let myul = document.getElementById('myUL');

    let li = myul.getElementsByTagName('li');

    for (var i = 0; i < li.length; i++) {
        let catinput = li[i].getElementsByTagName('input');

        if (catinput) {
            let firsttextvalue = catinput[0].value;
            let sectextvalue = catinput[1].value;
            let datevalue = catinput[2].value;

            if (firsttextvalue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else if (sectextvalue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none"
            }
        }
    }
}
const finishedsearch = () => {
    let filter = document.getElementById('finishedInput').value.toUpperCase();
    console.log("test");

    let myul = document.getElementById('finishedul');

    let li = myul.getElementsByTagName('li');
    let datesearch = 0;

    for (var i = 0; i < li.length; i++) {
        let catinput = li[i].getElementsByTagName('input');

        if (catinput) {
            let firsttextvalue = catinput[0].value;
            let sectextvalue = catinput[1].value;

            if (firsttextvalue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else if (sectextvalue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none"
                datesearch++;
            }
        }
    }
    if (datesearch == i) {
        var s_future = document.getElementById("showfuture");
        var s_past = document.getElementById("showpast");
        var s_today = document.getElementById("showtoday");
        var s_tomorrow = document.getElementById("showtomorrow");

        if (s_future) {
            s_future.style.display = "none";
        }
        if (s_past) {
            s_past.style.display = "none";
        }
        if (s_today) {
            s_today.style.display = "none";
        }
        if (s_tomorrow) {
            s_tomorrow.style.display = "none";
        }
    }
}
const datesearch = () => {
    let datepicker = document.getElementById('selecteddate').value;
    let myul = document.getElementById('myUL');
    let fUl = document.getElementById('finishedul');
    let fLi = fUl.getElementsByTagName('li');

    let li = myul.getElementsByTagName('li');

    let searchs = 0;
    for (var i = 0; i < li.length; i++) {
        let catinput = li[i].getElementsByTagName('input');

        if (catinput) {
            let datevalue = catinput[2].value;

            if (datevalue == datepicker) {
                li[i].style.display = "";
            } else if (datepicker == "") {
                li[i].style.display = ""
            } else {
                li[i].style.display = "none";
                searchs++;
            }
        }
    }
    for (var a = 0; a < fLi.length; a++) {
        let catinput = fLi[a].getElementsByTagName('input');

        if (catinput) {
            let datevalue = catinput[2].value;

            if (datevalue == datepicker) {
                fLi[a].style.display = "";
            } else if (datepicker == "") {
                fLi[a].style.display = ""
            } else {
                fLi[a].style.display = "none";
                searchs++;
            }
        }
    }
    if (searchs == a) {
        var s_future = document.getElementById("showfuture");
        var s_past = document.getElementById("showpast");
        var s_today = document.getElementById("showtoday");
        var s_tomorrow = document.getElementById("showtomorrow");

        if (s_future) {
            s_future.style.display = "none";
        }
        if (s_past) {
            s_past.style.display = "none";
        }
        if (s_today) {
            s_today.style.display = "none";
        }
        if (s_tomorrow) {
            s_tomorrow.style.display = "none";
        }
    }
}

function cleardate() {
    var s_future = document.getElementById("showfuture");
    var s_past = document.getElementById("showpast");
    var s_today = document.getElementById("showtoday");
    var s_tomorrow = document.getElementById("showtomorrow");

    if (s_future) {
        s_future.style.display = "";
    }
    if (s_past) {
        s_past.style.display = "";
    }
    if (s_today) {
        s_today.style.display = "";
    }
    if (s_tomorrow) {
        s_tomorrow.style.display = "";
    }
    let myul = document.getElementById('myUL');
    let li = myul.getElementsByTagName('li');
    for (var i = 0; i < li.length; i++) {
        let catinput = li[i].getElementsByTagName('input');

        if (catinput) {
            li[i].style.display = "";
        }
    }
    let fUl = document.getElementById('finishedul');
    let fLi = fUl.getElementsByTagName('li');
    for (var a = 0; a < fLi.length; a++) {
        let catinput = fLi[a].getElementsByTagName('input');

        if (catinput) {

                fLi[a].style.display = "";
        
        }
    }
}
