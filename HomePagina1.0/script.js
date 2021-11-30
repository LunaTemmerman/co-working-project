
//<---!rowslider code!--->
var rowSliderSrc = new Array(4);
rowSliderSrc[0] = ["fotos/red.png","fotos/green.png","fotos/yellow.png","fotos/grey.png","fotos/red.png","fotos/green.png","fotos/yellow.png","fotos/blue.png","fotos/grey.png","fotos/blue.png"];
rowSliderSrc[1] = ["fotos/red.png","fotos/green.png","fotos/yellow.png","fotos/grey.png","fotos/red.png","fotos/green.png","fotos/yellow.png","fotos/blue.png","fotos/grey.png","fotos/blue.png"];
rowSliderSrc[2] = ["fotos/red.png","fotos/green.png","fotos/yellow.png","fotos/grey.png","fotos/red.png","fotos/green.png","fotos/yellow.png","fotos/blue.png","fotos/grey.png","fotos/blue.png"];

function sliderow1(richtingL, sliderNummer) {
    imgsrc = rowSliderSrc[sliderNummer];

    if (richtingL){
        imgsrc.push(imgsrc[0]);  //copier 1ste element naar vanachter
        imgsrc.shift();          //verwijder 1ste element
    }else{
        imgsrc.unshift(imgsrc[imgsrc.length-1]);  //copier laatste element naar vanvoor
        imgsrc.pop();                             //verwijder laatste element
    }

    for (i = 0; i <= imgsrc.length; i++){    //pas toe de doorgeschoven afbeelding src
        document.getElementById("img" + (sliderNummer+1) + "." + (i+1)).src = imgsrc[i];
    }
}