function togglemenu() {
    document.getElementById("menu").classList.toggle("showmen");
}

function menuselect(page) {
    //make all hidden
    document.getElementById("dash").classList.add("hide");
    document.getElementById("showf").classList.add("hide");
    document.getElementById("showc").classList.add("hide");
    document.getElementById("showa").classList.add("hide");
    document.getElementById("addf").classList.add("hide");
    document.getElementById("addc").classList.add("hide");
    document.getElementById("adda").classList.add("hide");
    document.getElementById("message").classList.add("hide");
    document.getElementById("showbooked").classList.add("hide");
    //get all pages
    var page0 = document.getElementById("dash");
    var page1 = document.getElementById("showf");
    var page2 = document.getElementById("showc");
    var page3 = document.getElementById("showa");
    var page4 = document.getElementById("addf");
    var page5 = document.getElementById("addc");
    var page6 = document.getElementById("adda");
    var page7 = document.getElementById("message");
    var page8 = document.getElementById("showbooked");

    switch (page) {
        case 0:
            page0.classList.remove("hide");
            break;
        case 1:
            page1.classList.remove("hide");
            break;
        case 2:
            page2.classList.remove("hide");
            break;
        case 3:
            page3.classList.remove("hide");
            break;
        case 4:
            page4.classList.remove("hide");
            break;
        case 5:
            page5.classList.remove("hide");
            break;
        case 6:
            page6.classList.remove("hide");
            break;
        case 7:
            page7.classList.remove("hide");
            break
        case 8:
            page8.classList.remove("hide");
            break;
        default:
            break;
    }
}

function hidestopmenu() {
    document.getElementById("stopo").classList.add("hide");
}

function showstopmenu() {
    document.getElementById("stopo").classList.remove("hide");
}