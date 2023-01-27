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

//user page menu
function menuselect(page) {
    //make all hidden
    document.getElementById("cart").classList.add("hide");
    document.getElementById("booked").classList.add("hide");
    document.getElementById("info").classList.add("hide");
    //get all pages
    var page0 = document.getElementById("cart");
    var page1 = document.getElementById("booked");
    var page2 = document.getElementById("info");
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
        default:
            break;
    }
}

//password modif
function enablepass() {
    var actpass = document.getElementById("passact").value;
    var strHash = md5(document.getElementById("actpass").value);
    if(actpass!==strHash) { 
        document.getElementById('newp').disabled = true; 
        document.getElementById('confnewp').disabled = true; 
    } else { 
        document.getElementById('newp').disabled = false;
        document.getElementById('confnewp').disabled = false;
    }
}



//the md5 decryption function url: https://gist.github.com/blackout314/8c948179359a3be09cb1f40a85e8e404
function md5(inputString) {
    var hc="0123456789abcdef";
    function rh(n) {var j,s="";for(j=0;j<=3;j++) s+=hc.charAt((n>>(j*8+4))&0x0F)+hc.charAt((n>>(j*8))&0x0F);return s;}
    function ad(x,y) {var l=(x&0xFFFF)+(y&0xFFFF);var m=(x>>16)+(y>>16)+(l>>16);return (m<<16)|(l&0xFFFF);}
    function rl(n,c)            {return (n<<c)|(n>>>(32-c));}
    function cm(q,a,b,x,s,t)    {return ad(rl(ad(ad(a,q),ad(x,t)),s),b);}
    function ff(a,b,c,d,x,s,t)  {return cm((b&c)|((~b)&d),a,b,x,s,t);}
    function gg(a,b,c,d,x,s,t)  {return cm((b&d)|(c&(~d)),a,b,x,s,t);}
    function hh(a,b,c,d,x,s,t)  {return cm(b^c^d,a,b,x,s,t);}
    function ii(a,b,c,d,x,s,t)  {return cm(c^(b|(~d)),a,b,x,s,t);}
    function sb(x) {
        var i;var nblk=((x.length+8)>>6)+1;var blks=new Array(nblk*16);for(i=0;i<nblk*16;i++) blks[i]=0;
        for(i=0;i<x.length;i++) blks[i>>2]|=x.charCodeAt(i)<<((i%4)*8);
        blks[i>>2]|=0x80<<((i%4)*8);blks[nblk*16-2]=x.length*8;return blks;
    }
    var i,x=sb(inputString),a=1732584193,b=-271733879,c=-1732584194,d=271733878,olda,oldb,oldc,oldd;
    for(i=0;i<x.length;i+=16) {olda=a;oldb=b;oldc=c;oldd=d;
        a=ff(a,b,c,d,x[i+ 0], 7, -680876936);d=ff(d,a,b,c,x[i+ 1],12, -389564586);c=ff(c,d,a,b,x[i+ 2],17,  606105819);
        b=ff(b,c,d,a,x[i+ 3],22,-1044525330);a=ff(a,b,c,d,x[i+ 4], 7, -176418897);d=ff(d,a,b,c,x[i+ 5],12, 1200080426);
        c=ff(c,d,a,b,x[i+ 6],17,-1473231341);b=ff(b,c,d,a,x[i+ 7],22,  -45705983);a=ff(a,b,c,d,x[i+ 8], 7, 1770035416);
        d=ff(d,a,b,c,x[i+ 9],12,-1958414417);c=ff(c,d,a,b,x[i+10],17,     -42063);b=ff(b,c,d,a,x[i+11],22,-1990404162);
        a=ff(a,b,c,d,x[i+12], 7, 1804603682);d=ff(d,a,b,c,x[i+13],12,  -40341101);c=ff(c,d,a,b,x[i+14],17,-1502002290);
        b=ff(b,c,d,a,x[i+15],22, 1236535329);a=gg(a,b,c,d,x[i+ 1], 5, -165796510);d=gg(d,a,b,c,x[i+ 6], 9,-1069501632);
        c=gg(c,d,a,b,x[i+11],14,  643717713);b=gg(b,c,d,a,x[i+ 0],20, -373897302);a=gg(a,b,c,d,x[i+ 5], 5, -701558691);
        d=gg(d,a,b,c,x[i+10], 9,   38016083);c=gg(c,d,a,b,x[i+15],14, -660478335);b=gg(b,c,d,a,x[i+ 4],20, -405537848);
        a=gg(a,b,c,d,x[i+ 9], 5,  568446438);d=gg(d,a,b,c,x[i+14], 9,-1019803690);c=gg(c,d,a,b,x[i+ 3],14, -187363961);
        b=gg(b,c,d,a,x[i+ 8],20, 1163531501);a=gg(a,b,c,d,x[i+13], 5,-1444681467);d=gg(d,a,b,c,x[i+ 2], 9,  -51403784);
        c=gg(c,d,a,b,x[i+ 7],14, 1735328473);b=gg(b,c,d,a,x[i+12],20,-1926607734);a=hh(a,b,c,d,x[i+ 5], 4,    -378558);
        d=hh(d,a,b,c,x[i+ 8],11,-2022574463);c=hh(c,d,a,b,x[i+11],16, 1839030562);b=hh(b,c,d,a,x[i+14],23,  -35309556);
        a=hh(a,b,c,d,x[i+ 1], 4,-1530992060);d=hh(d,a,b,c,x[i+ 4],11, 1272893353);c=hh(c,d,a,b,x[i+ 7],16, -155497632);
        b=hh(b,c,d,a,x[i+10],23,-1094730640);a=hh(a,b,c,d,x[i+13], 4,  681279174);d=hh(d,a,b,c,x[i+ 0],11, -358537222);
        c=hh(c,d,a,b,x[i+ 3],16, -722521979);b=hh(b,c,d,a,x[i+ 6],23,   76029189);a=hh(a,b,c,d,x[i+ 9], 4, -640364487);
        d=hh(d,a,b,c,x[i+12],11, -421815835);c=hh(c,d,a,b,x[i+15],16,  530742520);b=hh(b,c,d,a,x[i+ 2],23, -995338651);
        a=ii(a,b,c,d,x[i+ 0], 6, -198630844);d=ii(d,a,b,c,x[i+ 7],10, 1126891415);c=ii(c,d,a,b,x[i+14],15,-1416354905);
        b=ii(b,c,d,a,x[i+ 5],21,  -57434055);a=ii(a,b,c,d,x[i+12], 6, 1700485571);d=ii(d,a,b,c,x[i+ 3],10,-1894986606);
        c=ii(c,d,a,b,x[i+10],15,   -1051523);b=ii(b,c,d,a,x[i+ 1],21,-2054922799);a=ii(a,b,c,d,x[i+ 8], 6, 1873313359);
        d=ii(d,a,b,c,x[i+15],10,  -30611744);c=ii(c,d,a,b,x[i+ 6],15,-1560198380);b=ii(b,c,d,a,x[i+13],21, 1309151649);
        a=ii(a,b,c,d,x[i+ 4], 6, -145523070);d=ii(d,a,b,c,x[i+11],10,-1120210379);c=ii(c,d,a,b,x[i+ 2],15,  718787259);
        b=ii(b,c,d,a,x[i+ 9],21, -343485551);a=ad(a,olda);b=ad(b,oldb);c=ad(c,oldc);d=ad(d,oldd);
    }
    return rh(a)+rh(b)+rh(c)+rh(d);
}