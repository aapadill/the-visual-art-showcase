var incrementX = 0.0013;
var incrementS = 0.0001;
var start = 0;

function setup(){
    var canvasWidth = document.body.offsetWidth;
    var canvasHeight = document.body.offsetHeight;
    var cnv = createCanvas(canvasWidth, canvasHeight-100);
    cnv.id('p5-canvas');
}

function windowResized() {
    var canvasHeight = document.body.offsetHeight;

    resizeCanvas(windowWidth, canvasHeight);
}

function drawL(i){
    var canvasWidth = document.body.offsetWidth;
    var canvasHeight = document.body.offsetHeight;
    stroke(0);
    noFill();
    beginShape();  
    var xoff = start;
    for (var x = 0; x < canvasWidth; x++){
        var y = noise(xoff) * canvasHeight;
        // vertex(x, y + i);
        ellipse(x, y + i, 5, 5);
        xoff += incrementX;
    }
    start += incrementS;
    endShape();
}

function draw(){
    var canvasHeight = document.body.offsetHeight;
    var yoff = 80;
    background(255, 150);
    for (var i = 0; i < canvasHeight; i += yoff){
        drawL(i);
    }
}