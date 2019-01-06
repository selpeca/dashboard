function cargarDiv(div,url){
    $(div).empty().load(url);
}
$('[data-toggle=tooltip]').tooltip();
function hoy() {
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1; //hoy es 0!
    var yyyy = hoy.getFullYear();

    if(dd<10) {
        dd='0'+dd
    } 

    if(mm<10) {
        mm='0'+mm
    } 

    hoy = yyyy+'-'+mm+'-'+dd;
    return hoy;
} 
var fNumber = {
    sepMil: ".", // separador para los miles
    sepDec: ',', // separador para los decimales
    formatear: function (num) {
        num += '';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDec + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
        while (regx.test(splitLeft)) {
            splitLeft = splitLeft.replace(regx, '$1' + this.sepMil + '$2');
        }
        return this.simbol + splitLeft + splitRight;
    },
    go: function (id, num, simbol='$') {
        this.simbol = simbol || '';
        $("."+id).html(this.formatear(num)); 
    }
}