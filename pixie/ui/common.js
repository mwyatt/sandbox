var rect = new PIXI.Graphics();
var log = console.log
var timeThen = Date.now()
var timeNow
var timeDelta

var rectO = {
  x: 30,
  y: 20,
  w: 20,
  h: 20,
  vX: .1,
}

var app = new PIXI.Application(800, 600, {backgroundColor : 0x1099bb});
document.body.appendChild(app.view);
var stage = new PIXI.Container();

renderGame()

app.ticker.add(function(delta) {
    update()

    timeNow = Date.now()
    timeDelta = timeNow - timeThen
    timeThen = timeNow

    //Render the stage to see the animation
    app.render(stage);
});

//Start the game loop

function renderGame() {
  rect.clear()
  rect.beginFill(0x709FE9, 1);
  rect.drawRect(rectO.x, rectO.y, rectO.w, rectO.h);
  rect.endFill();
  stage.addChild(rect);
}

function update() {
  var movementVal = Math.round(rectO.vX * timeDelta)
  if (!isNaN(movementVal)) {
    rect.position.x += movementVal
  }
}
