$(document).ready(function(){
    $('#banner').bjqs({
        'animationDuration' : 500,
        'centerMarkers' : true,
        'centerControls' : true,
        'nextText': '<img src="/modules/slider/assets/images/arr-right.png">',
        'prevText': '<img src="/modules/slider/assets/images/arr-left.png">',
        'useCaptions' : false,
        'keyboardNav' : false,
        'width' : 920,
        'height' : 300,
        'animation' : 'slide',
        'rotationSpeed' : 4000
    });
});