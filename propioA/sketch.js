var increment = 0.0015;
var start = 0;

function setup(){
    createCanvas(windowWidth, windowHeight);
}

function windowResized() {
    resizeCanvas(windowWidth, windowHeight);
}

function drawL(i){
    stroke(255);
    noFill();
    beginShape();  
    var xoff = start;
    for (var x = 0; x < windowWidth; x++){
        var y = noise(xoff) * windowHeight;
        // vertex(x, y + i);
        ellipse(x - i, y + i, 5, 5);
        xoff += increment;
    }
    start += 0.00015;
    endShape();
}

function draw(){
    var yoff = 100;
    background(0);
    for (var i = 0; i < windowHeight; i += yoff){
        drawL(i);
    }
}