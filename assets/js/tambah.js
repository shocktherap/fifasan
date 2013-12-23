var xmlHttp = createXmlHttpRequestObject();
function createXmlHttpRequestObject()
{
var xmlHttp;
if(window.ActiveXObject)
{
try
{
xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
xmlHttp = false;
}
}
else
{
try
{
xmlHttp = new XMLHttpRequest();
}
catch (e)
{
xmlHttp = false;
}
}
if (!xmlHttp) alert("Obyek XMLHttpRequest gagal dibuat");
else
return xmlHttp;
}
function hitung()
{
if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
{
// mengambil data input dari elemen bernama bil1 dan dikonversi
// ke float / riil supaya dapat dioperasikan secara aritmatika
bil1 = parseFloat(encodeURIComponent(document.getElementById("bil1").value));
// mengambil data input dari elemen bernama bil2 dan dikonversi
// ke float / riil supaya dapat dioperasikan secara aritmatika
bil2 = parseFloat(encodeURIComponent(document.getElementById("bil2").value));
// mengambil data input dari elemen bernama operasi
operasi = encodeURIComponent(document.getElementById("operasi").value);
// proses perhitungan operasi dilakukan di script kalkulator.php
xmlHttp.open("GET", "kalkulator.php?bil1=" + bil1 + "&bil2=" + bil2 + "&op=" + operasi, true);
xmlHttp.onreadystatechange = handleServerResponse;
xmlHttp.send(null);
}
else
setTimeout('hitung()', 1000);
}

function handleServerResponse()
{
if (xmlHttp.readyState == 4)
{
if (xmlHttp.status == 200)
{
xmlResponse = xmlHttp.responseXML;
xmlDocumentElement = xmlResponse.documentElement;
hasil = xmlDocumentElement.firstChild.data;
document.getElementById("output").innerHTML = hasil;
// setTimeout('process()', 1000);
}
else
{
alert("Ada masalah dalam koneksi ke server: " +
xmlHttp.statusText);
}
}
}
