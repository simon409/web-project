function test(withimg) {
    var scroll =document.documentElement.scrollTop;
    var header = document.getElementById("header");
    console.log(scroll)
    if(withimg == 0)
    {
        if (scroll > 0) {
            header.classList.add("active");
        }
        else {
            header.classList.remove("active")
        }
    }
    else
    {
        if (scroll > 900) {
            header.classList.add("active");
        }
        else {
            header.classList.remove("active")
        }
    }
}

/*get today's date */
$(document).ready( function() {
    $('.today').val(getToday());
  });
  
  function getToday(){
	const local = new Date();
    local.setMinutes(local.getMinutes() - local.getTimezoneOffset());
	return local.toJSON().slice(0,10);
}

function incrpers(incdec) {
    var person = document.getElementById("person");
    var adlt = document.getElementById("adlt");
    var counter = parseInt(person.value[0]);
    if(incdec == 0)
    {
        counter ++;
        person.value = counter+" Adults"
        adlt.value = counter;
        updatetotalprice();
    }
    else if(incdec == 1)
    {
        if(counter == 1)
        {

        }
        else{
            counter--;
            person.value = counter+" Adults"
            adlt.value = counter;
            updatetotalprice();
        }
    }
}

function incrchild(incdec) {
    var person = document.getElementById("child");
    var chld = document.getElementById("chld");
    var counter = parseInt(person.value[0]);
    if(incdec == 0)
    {
        counter ++;
        person.value = counter+" Children"
        chld.value = counter;
        updatetotalprice();
    }
    else if(incdec == 1)
    {
        if(counter == 0)
        {

        }
        else{
            counter--;
            person.value = counter+" Children"
            chld.value = counter;
            updatetotalprice();
        }
    }
}

function updatetotalprice(){
    //the numbers of adult and children
    var adlt = parseInt(document.getElementById("adlt").value);
    var chld = parseInt(document.getElementById("chld").value);
    //getting the prices
    var priadlt = parseInt(document.getElementById("pradt").innerHTML);
    var pricld = parseInt(document.getElementById("pracld").innerHTML);

    console.log(adlt);
    console.log(chld);
    console.log(priadlt);
    console.log(pricld);

    var result = (adlt*priadlt)+(chld*pricld);
    console.log(result);
    document.getElementById("totalp").value = "Calculating ...";
    //calcule part
    var limitedInterval = setInterval(function(){
        document.getElementById("totalp").value = result;
        clearInterval(limitedInterval);
    }, 1500);
}

/*Auto complete */

function getText(event, index) {
    if (index == 0) {
        var text = event.innerText;
        console.log(text)
        document.getElementsByName('departure')[0].value = text.trim();
        document.getElementById('search_result').innerHTML = '';
    }
    else {
        var text = event.textContent;
        document.getElementsByName('arrival')[0].value = text.trim();
        document.getElementById('search_result2').innerHTML = '';
    }
}

function load_data(query, index) {
    if(query.length > 1){
        var form_data = new FormData();
        form_data.append('query', query);
        var ajax_request = new XMLHttpRequest();
        ajax_request.open('POST', 'process_data.php');
        ajax_request.send(form_data);
        ajax_request.onreadystatechange = function()
        {
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                var response = JSON.parse(ajax_request.responseText);
                var html = '<div class="list-group">';
                if(index == 0){
                    if (response.length > 0) {
                        for(var count = 0; count < response.length; count++){
                            html += '<a href="#form" onclick="getText(this, 0);" class="list-group-item list-group-item-action p-3 text-start"> <i class="fa-solid fa-location-dot"></i> &nbsp'+
                            response[count].couname
                            +'</a>'
                        }
                    }
                    else{
                        html += '<a href="#form" class="list-group-item list-group-item-action disabled">No Data Found</a>';
                    }
                    html += '</div>';
                    document.getElementById('search_result').innerHTML = html;
                }
                else{
                    if (response.length > 0) {
                        for(var count = 0; count < response.length; count++){
                            html += '<a href="#form" onclick="getText(this, 1);" class="list-group-item list-group-item-action p-3 text-start"> <i class="fa-solid fa-location-dot"></i> &nbsp'+
                            response[count].couname
                            +'</a>'
                        }
                    }
                    else{
                        html += '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found</a>';
                    }
                    html += '</div>';
                    document.getElementById('search_result2').innerHTML = html;
                }
            }
        }
    }
    else{
        if(index == 0){
            document.getElementById('search_result').innerHTML = '';
        }
        else{
            document.getElementById('search_result2').innerHTML = '';
        }
    }
}

$('#adlt').change(function() {
    updateprice();
 });

 $('#cld').change(function() {
    updateprice();
 });

 
function togglemenu() {
    document.getElementById("menu").classList.toggle("showmen");
    document.getElementById("menucard").classList.remove("showmen");
}

function togglemenucard() {
    document.getElementById("menucard").classList.toggle("showmen");
    document.getElementById("menu").classList.remove("showmen");
}
