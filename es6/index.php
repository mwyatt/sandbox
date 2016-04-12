<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <script>
    
    class Point {
        constructor(x, y) {
            this.x = x;
            this.y = y;
        }
        toString() {
            return '(' + this.x + ', ' + this.y + ')';
        }
    }
    
    class ColorPoint extends Point {
        constructor(x, y, color) {
            super(x, y);
            this.color = color;
        }
        toString() {
            return super.toString() + ' in ' + this.color;
        }
    }
    
    let cp = new ColorPoint(25, 8, 'green');
    console.log(cp.toString());
    
    console.log(cp instanceof ColorPoint); // true
    console.log(cp instanceof Point); // true

    </script>
</body>
</html>
