var increment = 0.001;
var start = 0;
var i = 50; // Adjust this value to control the spacing between lines

function setup() {
    createCanvas(windowWidth, windowHeight);
    background(255);
    stroke(0);
    noFill();
    
    // Loop to create multiple lines in the y-axis
    for (var y = 0; y < height; y += i) {
        drawLine(y);
    }
    
}

function windowResized() {
    resizeCanvas(windowWidth, windowHeight);
    setup();
}

function drawLine(i) {
    var xoff = start;
    beginShape();
    for (var x = 0; x < windowWidth; x++) {
        var y = noise(xoff) * windowHeight;
        // vertex(x, y + i);
        // ellipse(x, y + i, 0.01, 0.01);
        ellipse(x, y + i, 5, 5);
        xoff += increment;
    }
    endShape();
}
