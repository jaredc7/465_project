function validateForm() {
  var x = document.forms["myForm"]["username"].value;
  var y = document.forms["myForm"]["password"].value;

  if (x == "") {
    alert("Username must be filled out");
    return false;
    }

  if (y == "") {
    alert("Password must be filled out");
    return false;
  }
}  




/*


// Toggle with button onclick
function toggle(){
	
	var ob = document.getElementById("togglePara");
	
	if (ob.innerHTML=="0"){
		ob.style.color="red";
		ob.innerHTML="1";
	} else {
		ob.style.color="blue";
		ob.innerHTML="0";}}

//E10 - adding, subtracting, resetting with button onclick
function addOne(){
	var zero = document.getElementById("counter");
	zero.innerHTML++;}

function subtractOne(){
	var zero = document.getElementById("counter");
	zero.innerHTML--;}
	
function reset(){
	var zero = document.getElementById("counter");
	zero.innerHTML=0;}

//E11 - onmouseover changes paragraph color

function firstPara() {
	var firstP = document.getElementById("first");
	firstP.style.backgroundColor = "#66ffff";}

function secondPara() {
	var firstP = document.getElementById("first");
	var secondP = document.getElementById("second");
    firstP.style.backgroundColor = "#ff33cc";
	secondP.style.backgroundColor = "#ff33cc";}

function thirdPara() {
	var firstP = document.getElementById("first");
	var secondP = document.getElementById("second");
    firstP.style.backgroundColor = "white";
	secondP.style.backgroundColor = "white";}
//E13
// <figure onclick="pictureChange1()" ondblclick="pictureChange2()">
//visible & invisible linked to css
function pictureChange1() {
    var element = document.getElementById("image1");
    var element2 = document.getElementById("image2");
    var elemcap = document.getElementById("caption1");
    var elemcap2 = document.getElementById("caption2");
    
    element.className = "image invisible";
    element2.className = "image visible";
    elemcap.className = "caption invisible";
    elemcap2.className = "caption visible";}

function pictureChange2() {
    var element = document.getElementById("image2");
    var element2 = document.getElementById("image1");
    var elemcap = document.getElementById("caption2");
    var elemcap2 = document.getElementById("caption1");
    
    element.className = "image invisible";
    element2.className = "image visible";
    elemcap.className = "caption invisible";
    elemcap2.className = "caption visible";}

//E14

function e14colchange() {
    var number = document.getElementById("e14num").value;
    var colour = document.getElementById("e14col").value;
    
    if(number == 1) {
        document.getElementById("e14first").style.color = colour;}
    if(number == 2) {
        document.getElementById("e14second").style.color = colour;}
    if(number == 3) {
        document.getElementById("e14third").style.color = colour;}
    if(number == 4) {
        document.getElementById("e14fourth").style.color = colour;}
    if(number == 5) {
        document.getElementById("e14fifth").style.color = colour;}}
/* <section>
    <h2>Entry 14 - Colouring </h2>  
    <ol>
        <li id="e14first">first item</li>
        <li id="e14second">second item</li>
        <li id="e14third">third item</li>
        <li id="e14fourth">fourth item</li>
        <li id="e14fifth">fifth item</li>
    </ol>
	
    <p>Pick a number and colour and the list item will be coloured.</p>
    <input id="e14num" type="number" min="1" max="5" value="1">
    <input id="e14col" type="color" value="#ff0000">
    <br>
    <button onclick="e14colchange()" id="e14button">paint the list item</button>
	</section>*/

